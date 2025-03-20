@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vehicle_reservation') }}">Reservation</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle History</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Vehicle Release List</h3>
                    <a href="{{ route('release.create') }}" class="btn btn-sm btn-primary">
                        New Release
                    </a>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Contact</th>
                                    <th>Reservation Start</th>
                                    <th>Release Date</th>
                                    <th>Drop-Off Date</th>
                                    <th>Total Cost</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                    <tr>
                                        <td>{{ $history->customer_name }}</td>
                                        <td>{{ $history->customer_contact }}</td>
                                        <td>{{ $history->reservation_start_date }}</td>
                                        <td>{{ $history->release_date }}</td>
                                        <td>{{ $history->drop_off_date }}</td>
                                        <td>{{ $history->total_cost }}</td>
                                        <td>{{ $history->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>

                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}',
                                showConfirmButton: true,
                            });
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(releaseId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + releaseId).submit();
                }
            });
        }
    </script>
@endsection
