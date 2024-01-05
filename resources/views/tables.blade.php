@extends('layouts.user_type.auth')

@section('content')
    <div>


        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Tickets</h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            SPECILIST
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            REQUESTS/ISSUE
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            STATUS
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            RESOLUTION
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            MOP
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Creation Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($tickets as $ticket)
                                    <tbody>
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $ticket->id }}</p>
                                            </td>
                                            <td>
                                                <div class="mt-3">
                                                    <p>{{ auth()->user()->name }} </p>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($ticket->issue, 10, '...') }}</p>
                                            </td>

                                            @php
                                                if (!function_exists('getStatusButtonClasses')) {
                                                    function getStatusButtonClasses($statusName)
                                                    {
                                                        switch (strtolower($statusName)) {
                                                            case 'pending':
                                                                return 'btn-warning'; // Yellow
                                                            case 'closed':
                                                                return 'btn-success'; // Green
                                                            case 'unattended':
                                                                return 'btn-danger'; // Red
                                                            default:
                                                                return 'btn-light'; // Default color (light gray)
                                                        }
                                                    }
                                                }
                                            @endphp


                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn text-xs btn-sm font-weight-bold mb-0 {{ getStatusButtonClasses($ticket->status->name) }}">
                                                    {{ $ticket->status->name }}
                                                </button>
                                            </td>


                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($ticket->resolution, 10, '...') }}</p>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('mops.show', $ticket->mop) }}" class="mx-3">
                                                    <button type="button" class="btn btn-primary btn-sm mt-3">
                                                        <i style="font-size: 15px" class="fas fa-eye"></i> &nbsp; View MOP
                                                    </button>
                                                </a>

                                                

                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $ticket->created_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('tickets.show', $ticket->id) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="View">
                                                    <i class='far fa-eye'></i>
                                                </a>

                                                <a href="{{ route('tickets.edit',$ticket->id ) }}" class="mx-2"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                    <i class='far fa-edit '></i>
                                                </a>
                                                <span>
                                                    <form method="POST" action="{{ route('tickets.destroy', $ticket->id) }}" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" style="border:none; background:none; cursor:pointer;">
                                                            <i style="color: red" class='fas fa-trash-alt'></i>
                                                        </button>
                                                    </form>

                                                </span>
                                            </td>
                                        </tr>

                                    </tbody>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function getStatusColor(status) {
            switch (status.toLowerCase()) {
                case 'pending':
                    return '#ffc107'; // Yellow
                case 'closed':
                    return '#28a745'; // Green
                case 'unattended':
                    return '#dc3545'; // Red
                default:
                    return '#ffffff'; // Default color (white)
            }
        }
    </script>
@endsection

