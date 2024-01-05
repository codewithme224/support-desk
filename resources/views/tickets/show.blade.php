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
                        <h6 class="text-white mb-0">{{ $ticket->created_at }}</h6>
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
            <h6 class="mb-0">Ticket Details</h6>
            <div class="col-6 text-end">
              {{-- <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a> --}}
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">Issue</h6>
                  <p>{{ $ticket->issue }}</p>
                </div>
                
              </li>
              <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">Status</h6>
                  <select disabled name="status_id" id="status_id" class="form-control">
                  @foreach ($issue_status as $status)
                                        <option value="{{ $status->id }}" {{ $status->id == $selectedStatusId ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                    @endforeach
                    </select>
                </div>
                
              </li>
              <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">Resolution</h6>
                  <p>{{ $ticket->resolution }}</p>
                </div>
                
              </li>

              <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">MOP</h6>
                  <a href="{{ route('mops.show', $ticket->mop) }}" class="mx-3">
                    <button type="button" class="btn btn-primary btn-sm mt-3">
                        <i style="font-size: 15px" class="fas fa-eye"></i> &nbsp; View MOP
                    </button>
                </a>
                </div>
                
              </li>
             
            </ul>
          </div>
        </div>
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

@endsection