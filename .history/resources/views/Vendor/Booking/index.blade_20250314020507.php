<!-- resources/views/bookings/index.blade.php -->

@extends('base')

@section('content')
    <h1>Bookings</h1>
    <a href="{{ route('booking.create') }}" class="btn btn-primary">Create Booking</a>
    <table class="table">
        <thead>
            <tr>
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
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->service_type }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>{{ $booking->payment_status }}</td>
                    <td>
                        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
