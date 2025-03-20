@extends('base')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/release') }}">Vehicle Reservation</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/release') }}">Vehicle Release</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Vehicle Release
                            <a href="{{ route('release.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('release.update', $release->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $release->customer_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="customer_contact" class="form-label">Customer Contact</label>
                                <input type="text" class="form-control" id="customer_contact" name="customer_contact"
                                    value="{{ $release->customer_contact }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="reservation_date" class="form-label">Reservation Date</label>
                                <input type="datetime-local" class="form-control" id="reservation_date"
                                    name="reservation_date"
                                    value="{{ old('reservation_date', $release->reservation_date ? $release->reservation_date->format('Y-m-d\TH:i') : '') }}"
                                    required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="release_date" class="form-label">Release Date</label>
                                <input type="datetime-local" class="form-control" id="release_date"
                                    name="release_date"
                                    value="{{ old('release_date', $release->release_date ? $release->release_date->format('Y-m-d\TH:i') : '') }}"
                                    required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="drop_off_date" class="form-label">Drop-off Date</label>
                                <input type="datetime-local" class="form-control" id="drop_off_date"
                                    name="drop_off_date"
                                    value="{{ old('drop_off_date', $release->drop_off_date ? $release->drop_off_date->format('Y-m-d\TH:i') : '') }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="condition_report" class="form-label">Condition Report</label>
                                <textarea class="form-control" id="condition_report" name="condition_report">{{ $release->condition_report }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="total_cost" class="form-label">Total Cost</label>
                                <input type="number" class="form-control" id="total_cost" name="total_cost"
                                    value="{{ $release->total_cost }}" required step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-control" id="payment_status" name="payment_status">
                                    <option value="0" {{ $release->payment_status ? '' : 'selected' }}>Pending
                                    </option>
                                    <option value="1" {{ $release->payment_status ? 'selected' : '' }}>Paid</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes">{{ $release->notes }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                        @if ($release->status !== 'Completed')
                            <a href="{{ route('history.index', ['id' => $release->id]) }}">Complete Release</a>

                            <form action="{{ route('release.complete', ['id' => $release->id]) }}" method="POST"
                                class="mt-3">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Mark as Completed</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
