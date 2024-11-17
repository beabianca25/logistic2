@extends('base')

@section('content')
<nav aria-label="breadcrumb" style="font-size: 0.9rem; font-family: serif;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
    </ol>
</nav>

<div class="container" style="font-size: 0.9rem; font-family: serif;">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#editVendorModal">
                Edit Vendor
            </button>

            <!-- Modal -->
            <div class="container" style="font-size: 0.9rem; font-family: serif;">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Modal -->
                        <div class="modal fade" id="editVendorModal" tabindex="-1"
                            aria-labelledby="editVendorModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content" style="font-family: serif;">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="editVendorModalLabel" style="font-size: 1rem;">Edit
                                            Vendor</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    @if (isset($vendor))
                                        <form action="{{ route('vendor.update', $vendor->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="vendor_name" class="form-label">Vendor Name:</label>
                                                <input type="text" class="form-control" name="vendor_name"
                                                    value="{{ old('vendor_name', $vendor->vendor_name) }}" required>
                                                @error('vendor_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="contact_email" class="form-label">Email:</label>
                                                <input type="email" class="form-control" name="contact_email"
                                                    value="{{ old('contact_email', $vendor->contact_email) }}" required>
                                                @error('contact_email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="contact_phone" class="form-label">Phone:</label>
                                                <input type="text" class="form-control" name="contact_phone"
                                                    value="{{ old('contact_phone', $vendor->contact_phone) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="business_license" class="form-label">Business License:</label>
                                                <input type="text" class="form-control" name="business_license"
                                                    value="{{ old('business_license', $vendor->business_license) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="tax_information" class="form-label">Tax Information:</label>
                                                <input type="text" class="form-control" name="tax_information"
                                                    value="{{ old('tax_information', $vendor->tax_information) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="service_category" class="form-label">Service Category</label>
                                                <select name="service_category" id="service_category"
                                                    class="form-control" required>
                                                    <option value="{{ $vendor->service_category }}">
                                                        {{ $vendor->service_category }}</option>
                                                    <option value="Airlines">Airlines</option>
                                                    <option value="Rail Companies">Rail Companies</option>
                                                    <option value="Bus/Coach Operators">Bus/Coach Operators</option>
                                                    <option value="Car Rental Agencies">Car Rental Agencies</option>
                                                    <option value="Cruise Lines">Cruise Lines</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="contract_start_date" class="form-label">Contract Start
                                                    Date:</label>
                                                <input type="date" class="form-control" name="contract_start_date"
                                                    value="{{ old('contract_start_date', $vendor->contract_start_date) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="contract_end_date" class="form-label">Contract End
                                                    Date:</label>
                                                <input type="date" class="form-control" name="contract_end_date"
                                                    value="{{ old('contract_end_date', $vendor->contract_end_date) }}">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"
                                                    style="font-size: 0.9rem;">Update Vendor</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                    style="font-size: 0.9rem;">Cancel</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
            </div>
            <!-- End Modal -->
        </div>
    </div>
</div>

@endsection
