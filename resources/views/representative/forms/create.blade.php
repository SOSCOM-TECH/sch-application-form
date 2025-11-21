<x-app-layout>



    <div class="row align-items-center mb-3 border-bottom no-gutters">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">
                        Create New Form
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('rep.forms.store') }}">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="col-md-4">
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
        </div>
    </div>

</x-app-layout>


