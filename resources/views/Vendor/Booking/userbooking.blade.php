@extends('base')

@section('content')
<div class="container">
    <h2>My Bookings</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Name</th>
                <th>Service Type</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ str_pad(strtoupper(dechex($booking->id)), 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->service_type }}</td>
                    <td>
                        <span class="badge 
                            @if($booking->status == 'Pending') bg-warning
                            @elseif($booking->status == 'Approved') bg-info
                            @elseif($booking->status == 'Scheduled') bg-primary
                            @elseif($booking->status == 'Ongoing') bg-success
                            @elseif($booking->status == 'Completed') bg-dark
                            @elseif($booking->status == 'Cancelled') bg-danger
                            @endif">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            @if($booking->payment_status == 'Pending') bg-warning
                            @elseif($booking->payment_status == 'Paid') bg-success
                            @elseif($booking->payment_status == 'Cancelled') bg-danger
                            @endif">
                            {{ $booking->payment_status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
