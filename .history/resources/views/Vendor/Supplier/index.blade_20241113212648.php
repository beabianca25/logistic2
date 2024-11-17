@extends('base')

@section('content')
    <nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Request List</li>
        </ol>
    </nav>


        <!-- Supplier Section -->
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Supplier Request List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createsupplierModal" style="font-size: 0.9rem; font-family: serif;">
                                Add New Request
                            </button>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" style="font-size: 0.9rem; font-family: serif;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Supplier Name</th>
                                            <th>Product/Service Description</th>
                                            <th>Price Quote</th>
                                            <th>Availability/Lead Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $supplier)
                                            <tr>
                                                <td>{{ $supplier->id }}</td>
                                                <td>{{ $supplier->supplier_name }}</td>
                                                <td>{{ $supplier->product_service_description }}</td>
                                                <td>{{ $supplier->price_quote }}</td>
                                                <td>{{ $supplier->availability_lead_time }}</td>
                                                <td>{{ $supplier->status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                         <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" id="deleteForm{{ $supplier->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $supplier->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Supplier Modal -->
            <div class="modal fade" id="createsupplierModal" tabindex="-1" aria-labelledby="createsupplierModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="createsupplierModalLabel" style="font-size: 0.9rem; font-family: serif;">Create Supplier Request</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="font-size: 0.9rem; font-family: serif;">
                            @if ($errors->any())
                                <div class="alert alert-danger" style="font-size: 0.9rem; font-family: serif;">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="supplier_name" class="form-label">Supplier Name</label>
                                    <input type="text" name="supplier_name" class="form-control" value="{{ old('supplier_name') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="product_service_description" class="form-label">Product/Service Description</label>
                                    <textarea name="product_service_description" class="form-control" required>{{ old('product_service_description') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="price_quote" class="form-label">Price/Quote</label>
                                    <input type="number" name="price_quote" step="0.01" class="form-control" value="{{ old('price_quote') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="availability_lead_time" class="form-label">Availability/Lead Time</label>
                                    <input type="text" name="availability_lead_time" class="form-control" value="{{ old('availability_lead_time') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="contact_information" class="form-label">Contact Information</label>
                                    <input type="text" name="contact_information" class="form-control" value="{{ old('contact_information') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="attachments" class="form-label">Attachments</label>
                                    <input type="file" name="attachments" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success" style="font-size: 0.9rem; font-family: serif;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session("success") }}',
                    showConfirmButton: true,
                });
            });
        </script>
        @endif
        
        
        <script>
        function confirmDelete(vendorId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33', // Red color for delete confirmation
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById('deleteForm' + vendorId).submit();
                }
            });
        }
        </script>
        <!-- Subcontractor Section -->
        <div class="col-md-12">
            <div class="card">
                <div class="row" style="font-size: 0.9rem; font-family: serif;">
                    <div class="col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Subcontractor Request List</h3>
                            <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createsubcontractorModal" style="font-size: 0.9rem; font-family: serif;">
                                Add New Request
                            </button>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" style="font-size: 0.9rem; font-family: serif;">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" style="font-size: 0.9rem; font-family: serif;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Subcontractor Name</th>
                                            <th>Project Scope</th>
                                            <th>Cost Estimate</th>
                                            <th>Timeline</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcontractors as $subcontractor)
                                            <tr>
                                                <td>{{ $subcontractor->id }}</td>
                                                <td>{{ $subcontractor->subcontractor_name }}</td>
                                                <td>{{ $subcontractor->project_scope }}</td>
                                                <td>{{ $subcontractor->cost_estimate }}</td>
                                                <td>{{ $subcontractor->timeline }}</td>
                                                <td>{{ $subcontractor->status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('subcontractor.show', $subcontractor->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('subcontractor.destroy', $subcontractor->id) }}" method="POST" id="deleteForm{{ $subcontractor->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $subcontractor->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subcontractor Modal -->
            <div class="modal fade" id="createsubcontractorModal" tabindex="-1" aria-labelledby="createsubcontractorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="createsubcontractorModalLabel" style="font-size: 0.9rem; font-family: serif;">Create Subcontractor Request</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="font-size: 0.9rem; font-family: serif;">
                            @if ($errors->any())
                                <div class="alert alert-danger" style="font-size: 0.9rem; font-family: serif;">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('subcontractor.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="subcontractor_name" class="form-label">Subcontractor Name</label>
                                    <input type="text" name="subcontractor_name" class="form-control" value="{{ old('subcontractor_name') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="project_scope" class="form-label">Project Scope</label>
                                    <textarea name="project_scope" class="form-control" required>{{ old('project_scope') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="cost_estimate" class="form-label">Cost Estimate</label>
                                    <input type="number" name="cost_estimate" step="0.01" class="form-control" value="{{ old('cost_estimate') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="timeline" class="form-label">Timeline</label>
                                    <input type="text" name="timeline" class="form-control" value="{{ old('timeline') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="resources_required" class="form-label">Resources Required</label>
                                    <textarea name="resources_required" class="form-control">{{ old('resources_required') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success" style="font-size: 0.9rem; font-family: serif;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
@endsection

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session("success") }}',
            showConfirmButton: true,
        });
    });
</script>
@endif


<script>
function confirmDelete(vendorId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33', // Red color for delete confirmation
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + vendorId).submit();
        }
    });
}
</script>
@endpush
