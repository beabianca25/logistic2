@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: sans-serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vehicle_reservation') }}">Fleet Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Release History</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Vehicle Release History</h3>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" style="font-size: 0.9rem;">
                            <thead>
                                <tr>
                                    <th>ID</th>
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
                                        <td>{{ str_pad(strtoupper(dechex($history->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $history->customer_name }}</td>
                                        <td>{{ $history->customer_contact }}</td>
                                        <td>{{ $history->reservation_start_date }}</td>
                                        <td>{{ $history->release_date }}</td>
                                        <td>{{ $history->drop_off_date ?? 'N/A' }}</td>
                                        <td>${{ number_format($history->total_cost, 2) }}</td>
                                        <td><span class="badge badge-success">{{ $history->status }}</span></td>
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
@endsection
