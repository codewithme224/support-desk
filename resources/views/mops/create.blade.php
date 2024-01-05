@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('MOP Form') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('mops.store') }}" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">{{ __('TITLE') }}</label>
                                <div class="@error('name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Title of the MOP" id="name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="about">{{ 'DESCRIPTION' }}</label>
                        <div class="@error('description')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="description" rows="5" placeholder="Short description about the mop" name="description" data-language="markdown"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about">{{ 'Script/Query' }}</label>
                        <div  class="@error('script')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="codeInput" rows="10" placeholder="Enter your query of script here" name="script" style="height: 300px;"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Create MOP' }}</button>

                        &nbsp;&nbsp;
                        <a href="{{ route('mops.index') }}">
                            <button type="button" class="btn btn-danger btn-md mt-4 mb-4 ">{{ 'Cancel' }}</button>
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>




<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize SimpleMDE
        var simplemde = new SimpleMDE({
            element: document.getElementById("description"),
            // Other configuration options if needed
        });

        // Refresh Prism.js to highlight code blocks added dynamically
        // Prism.highlightAllUnder(document.getElementById("script"));


        var codeInput = document.getElementById("codeInput");
        var codeMirror = CodeMirror.fromTextArea(codeInput, {
            mode: "text/x-mysql",
            theme: "dracula", // Adjust the theme if needed
            lineNumbers: true,
            lineWrapping: true,
            matchBrackets: true,
            indentUnit: 4,
            indentWithTabs: true,
            tabSize: 4,
            extraKeys: { "tab": "autocomplete" }, // Enable Ctrl-Space for autocomplete
            hintOptions: { tables: {} },




        });


    });




</script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script> --}}


@endsection
