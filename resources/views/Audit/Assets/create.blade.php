@extends('base')

@section('content')
<div class="container" style="font-family: sans-serif; font-size: small;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Audit Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Asset List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Supply List</li>
        </ol>
    </nav>

    <div class="container">
        <!-- Trigger button for the modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSupplyModal">
            Create New Supply
        </button>

        <!-- Modal Structure -->
        <div class="modal fade" id="createSupplyModal" tabindex="-1" aria-labelledby="createSupplyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSupplyModalLabel">Create Supply List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('asset.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="asset_name" class="form-label">Asset Name</label>
                                <input type="text" class="form-control" id="asset_name" name="asset_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="asset_type" class="form-label">Asset Type</label>
                                <input type="text" class="form-control" id="asset_type" name="asset_type" required>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <div class="mb-3">
                                <label for="condition" class="form-label">Condition</label>
                                <input type="text" class="form-control" id="condition" name="condition" required>
                            </div>
                            <div class="mb-3">
                                <label for="acquisition_date" class="form-label">Acquisition Date</label>
                                <input type="date" class="form-control" id="acquisition_date" name="acquisition_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Asset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
