@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/document') }}">Document Submission</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Document Request
                            <a href="{{ route('document.index') }}" class="btn btn-danger float-end">Back</a>
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

                        <form action="{{ route('document.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="vendor_id" class="form-label">Vendor</label>
                                <select name="vendor_id" id="vendor_id" class="form-control @error('vendor_id') is-invalid @enderror">
                                    <option value="">Select Vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ $document->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                                @error('vendor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="document_title" class="form-label">Document Title</label>
                                <input type="text" name="document_title" class="form-control @error('document_title') is-invalid @enderror" value="{{ old('document_title', $document->document_title) }}">
                                @error('document_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="file" class="form-label">Document File (Leave blank to keep current file)</label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department', $document->department) }}">
                                @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="current_holder" class="form-label">Current Holder (Optional)</label>
                                <input type="text" name="current_holder" class="form-control" value="{{ old('current_holder', $document->current_holder) }}">
                            </div>
                    
                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose (Optional)</label>
                                <textarea name="purpose" class="form-control">{{ old('purpose', $document->purpose) }}</textarea>
                            </div>
                    
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="active" {{ $document->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $document->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="archived" {{ $document->status == 'Archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                    
                            <button type="submit" class="btn btn-success">Update Document</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
