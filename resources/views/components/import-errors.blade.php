@if(session('import_errors'))
    <div class="overflow-scroll h-150px alert alert-dismissible bg-white d-flex flex-column flex-sm-row p-5 mb-10">
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            @foreach (session('import_errors') as $errors)                
                @foreach ($errors->all() as $error)                
                    <span class="text-danger">{{ $error }}</span>
                @endforeach
            @endforeach
        </div>
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light">
                <i class="bi bi-x-lg"></i>
            </span>
        </button>
    </div>
@endif
@if(session('flash_message'))
    <div class="text-light-success bg-success alert alert-dismissible bg-white d-flex flex-column flex-sm-row p-5 mb-10">
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <span>{{ session('flash_message') }}</span>
        </div>
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light">
                <i class="bi bi-x-lg"></i>
            </span>
        </button>
    </div>
@endif