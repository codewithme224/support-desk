@extends('layouts.user_type.auth')

@section('content')
    <div>


        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">MOPs</h5>
                            </div>
                            <a href="{{ route('mops.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                type="button">+&nbsp; Add MOP</a>
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
                                            CREATED BY
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            TITLE
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            DESCRIPTION
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            SCRIPT/QUERY
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
                                @foreach ($mops as $mop)
                                    <tbody>
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $mop->id }}</p>
                                            </td>
                                            <td>
                                                <div>
                                                    <p>{{ auth()->user()->name }} </p>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($mop->name, 10, '...') }}</p>
                                            </td>



                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($mop->description, 10, '...') }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($mop->script, 10, '...') }}</p>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $mop->created_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('mops.show', $mop->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="View">
                                                    <i class='far fa-eye'></i>
                                                </a>
                                                
                                                <a href="{{ route('mops.edit',$mop->id ) }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                    <i class='far fa-edit '></i>
                                                </a>
                                                <span>
                                                    <form method="POST" action="{{ route('mops.destroy', $mop->id) }}" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="border:none; background:none; cursor:pointer;">
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
