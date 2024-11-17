@extends('base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor Portal</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Vendor</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Vendor
                            <a href="{{ route('vendor.index') }}" class="btn btn-primary float-end">Back</a>
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
                    <form action="{{ route('vendor.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="vendor_name">Vendor Name</label>
                            <input type="text" name="vendor_name" id="vendor_name" class="form-control" required>
                        </div>
                
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com">
                        </div>
                
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" maxlength="15" placeholder="Phone Number">
                        </div>
                
                        <div class="form-group">
                            <label for="business_license">Business License</label>
                            <input type="text" name="business_license" id="business_license" class="form-control" placeholder="Business License Number">
                        </div>
                
                        <div class="form-group">
                            <label for="tax_information">Tax Information</label>
                            <input type="text" name="tax_information" id="tax_information" class="form-control" placeholder="Tax Information">
                        </div>
                
                        <div class="form-group">
                            <label for="service_category">Service Category</label>
                            <select name="service_category" id="service_category" class="form-control" required>
                                <option value="">Select a Category</option>
                                <option value="Airlines">Airlines</option>
                                <option value="Rail Companies">Rail Companies</option>
                                <option value="Bus/Coach Operators">Bus/Coach Operators</option>
                                <option value="Car Rental Agencies">Car Rental Agencies</option>
                                <option value="Cruise Lines">Cruise Lines</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label for="contract_start_date">Contract Start Date</label>
                            <input type="date" name="contract_start_date" id="contract_start_date" class="form-control">
                        </div>
                
                        <div class="form-group">
                            <label for="contract_end_date">Contract End Date</label>
                            <input type="date" name="contract_end_date" id="contract_end_date" class="form-control">
                        </div>
                
                        <button type="submit" class="btn btn-primary">Create Vendor</button>
                        <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
