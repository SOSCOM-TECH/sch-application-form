<x-app-layout>

    <div class="row page-titles mx-0 border">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Create New Form</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('rep.forms.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Application Fee (TZS)</label>
                        <input type="number" name="application_fee" class="form-control" value="{{ old('application_fee', 0) }}" min="0">
                        <x-input-error :messages="$errors->get('application_fee')" class="mt-2" />
                    </div>
                </div>
                <div class="text-end">
                    <x-primary-button>Create</x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>


