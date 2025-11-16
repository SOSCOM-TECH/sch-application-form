<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FormController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $school = Auth::user()->school;
        if (! $school) {
            return redirect()->route('client.dashboard')->with('status', 'Submit school registration first.');
        }
        $forms = Form::where('school_id', $school->id)->latest()->get();
        return view('representative/forms/index', compact('forms', 'school'));
    }

    public function create(): View|RedirectResponse
    {
        $school = Auth::user()->school;
        if (! $school) {
            return redirect()->route('client.dashboard')->with('status', 'Submit school registration first.');
        }
        return view('representative/forms/create', compact('school'));
    }

    public function store(Request $request): RedirectResponse
    {
        $school = Auth::user()->school;
        if (! $school) {
            return redirect()->route('client.dashboard');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'application_fee' => ['nullable', 'integer', 'min:0'],
        ]);

        $form = Form::create([
            'school_id' => $school->id,
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']).'-'.Str::random(6),
            'application_fee' => $validated['application_fee'] ?? 0,
            'is_active' => false,
        ]);

        return redirect()->route('rep.forms.builder', $form)->with('status', 'Form created. Add fields below.');
    }

    public function builder(Form $form): View
    {
        $this->authorizeForm($form);
        $form->load('fields');
        return view('representative/forms/builder', compact('form'));
    }

    public function addField(Request $request, Form $form): RedirectResponse
    {
        $this->authorizeForm($form);
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:text,number,textarea,select,file,date'],
            'required' => ['nullable', 'boolean'],
            'options' => ['nullable', 'string'], // comma-separated for select
        ]);

        $order = ($form->fields()->max('order') ?? 0) + 1;
        $options = null;
        if ($validated['type'] === 'select' && !empty($validated['options'])) {
            $options = array_values(array_filter(array_map('trim', explode(',', $validated['options']))));
        }

        FormField::create([
            'form_id' => $form->id,
            'label' => $validated['label'],
            'type' => $validated['type'],
            'required' => (bool) ($validated['required'] ?? false),
            'options' => $options,
            'order' => $order,
        ]);

        return back()->with('status', 'Field added.');
    }

    public function removeField(Form $form, FormField $field): RedirectResponse
    {
        $this->authorizeForm($form);
        abort_unless($field->form_id === $form->id, 404);
        $field->delete();
        return back()->with('status', 'Field removed.');
    }

    public function preview(Form $form): View
    {
        $this->authorizeForm($form);
        $form->load('fields', 'documents');
        return view('representative/forms/preview', compact('form'));
    }

    public function publish(Form $form): RedirectResponse
    {
        $this->authorizeForm($form);
        if ($form->fields()->count() === 0) {
            return back()->with('status', 'Add at least one field before publishing.');
        }
        $form->update(['is_active' => true]);
        return back()->with('status', 'Form published. Public link is now live.');
    }

    public function unpublish(Form $form): RedirectResponse
    {
        $this->authorizeForm($form);
        $form->update(['is_active' => false]);
        return back()->with('status', 'Form unpublished.');
    }

    protected function authorizeForm(Form $form): void
    {
        $school = Auth::user()->school;
        abort_unless($school && $form->school_id === $school->id, 403);
    }
}


