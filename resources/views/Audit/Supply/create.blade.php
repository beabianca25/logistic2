@extends('base')

@section('content')
<div class="container" style="font-family: sans-serif; font-size: small;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Audit Management</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/supply') }}">Supply List</a></li>
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

                        <form action="{{ route('supply.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Supply Name:</label>
                                <input type="text" name="supply_name" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Category:</label>
                                <input type="text" name="category" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Quantity:</label>
                                <input type="number" name="quantity" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Audit Date:</label>
                                <input type="date" name="audit_date" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Location:</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Condition:</label>
                                <input type="text" name="condition" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Status:</label>
                                <input type="text" name="status" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Remarks:</label>
                                <textarea name="remarks" class="form-control"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Auditor Name:</label>
                                <input type="text" name="auditor_name" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Attachment:</label>
                                <input type="file" name="attachment" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
