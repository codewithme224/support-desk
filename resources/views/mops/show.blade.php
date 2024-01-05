@extends('layouts.user_type.auth')

@section('content')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xl-8 mb-xl-0 mb-4">
            <div class="card bg-transparent shadow-xl">
              <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="card-body position-relative z-index-1 p-3">
                  <i class="fas fa-wifi text-white p-2"></i>
                  <h5 class="text-white mt-4 mb-5 pb-2">Welcome Mr Programmer</h5>
                  <div class="d-flex">
                    <div class="d-flex">
                      <div class="me-4">
                        <p class="text-white text-sm opacity-8 mb-0">Created By</p>
                        <h6 class="text-white mb-0">{{ auth()->user()->name }}</h6>
                      </div>
                      <div>
                        <p class="text-white text-sm opacity-8 mb-0">Created At</p>
                        <h6 class="text-white mb-0">{{ $mop->created_at }}</h6>
                      </div>
                    </div>
                    <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                      <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
        </div>
        
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-12 mt-4">
        <div class="card">
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">MOP Details</h6>
            <div class="col-6 text-end">
              {{-- <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a> --}}
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">Title</h6>
                  <p>{{ $mop->name }}</p>
                </div>
                
              </li>
              <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">Description</h6>
                  <p>{{ $mop->description }}</p>
                </div>
                
              </li>
              <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">Script/Query</h6>
                  <textarea class="form-control" id="codeInput" rows="10" placeholder="Enter your query of script here" name="script" readonly style="height: 100px; width: 100%">{{$mop->script}}</textarea>

                  <button class="btn btn-sm btn-secondary position-absolute top-0 end-0 m-2" onclick="copyToClipboard()">
                    <i class="fas fa-copy"></i> Copy
                  </button>
                </div>
                
              </li>
            </ul>
          </div>
        </div>
      </div>
      
    </div>
  </div>
 

  <div id="toast-container" class="toast-container position-absolute top-0 end-0 p-3">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto">Copied!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Text copied to clipboard.
      </div>
    </div>
  </div>
  
  
  <script>
    function copyToClipboard() {
        const codeInput = document.getElementById("codeInput");
        const textToCopy = codeInput.value;

        if (navigator.clipboard) {
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    alert("Copied to clipboard!");
                })
                .catch(err => {
                    console.error("Failed to copy:", err);
                    alert("Failed to copy text. Please try again.");
                });
        } else {
            // Fallback for browsers that do not support navigator.clipboard
            const textArea = document.createElement("textarea");
            textArea.value = textToCopy;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);
            alert("Copied to clipboard!");
        }
    }
</script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize SimpleMDE
        // var simplemde = new SimpleMDE({
        //     element: document.getElementById("description"),
        //     // Other configuration options if needed
        // });

        // Refresh Prism.js to highlight code blocks added dynamically
        // Prism.highlightAllUnder(document.getElementById("script"));

        new ClipboardJS('#copyButton');


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

@endsection

