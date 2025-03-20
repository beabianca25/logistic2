@extends('base')

@section('content')
    <div class="container">
        <h1>Edit Booking</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('booking.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ $booking->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Scheduled" {{ $booking->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="Ongoing" {{ $booking->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select class="form-control" id="payment_status" name="payment_status">
                    <option value="Pending" {{ $booking->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Paid" {{ $booking->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Cancelled" {{ $booking->payment_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update Booking</button>
        </form>
    </div>
@endsection
