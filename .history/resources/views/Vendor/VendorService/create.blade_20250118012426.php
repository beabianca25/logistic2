
@section('content')
<div class="container">
    <h1>Create Vendor Service</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendorservice.store', ['vendor' => $vendor->id]) }}" method="POST">
        @csrf
       
        <div class="form-group">
            <label for="service_category">Service Category</label>
            <select name="service_category" id="service_category" class="form-control" required>
                <option value="">-- Select Category --</option>
                <option value="Accommodation" {{ old('service_category') == 'Accommodation' ? 'selected' : '' }}>Accommodation</option>
                <option value="Transportation" {{ old('service_category') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                <option value="Tours & Packages" {{ old('service_category') == 'Tours & Packages' ? 'selected' : '' }}>Tours & Packages</option>
                <option value="Event Planning" {{ old('service_category') == 'Event Planning' ? 'selected' : '' }}>Event Planning</option>
                <option value="Catering" {{ old('service_category') == 'Catering' ? 'selected' : '' }}>Catering</option>
                <option value="Other" {{ old('service_category') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="service_description">Service Description</label>
            <textarea name="service_description" id="service_description" class="form-control" rows="4" required>{{ old('service_description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="areas_of_operation">Areas of Operation</label>
            <textarea name="areas_of_operation" id="areas_of_operation" class="form-control" rows="3" required>{{ old('areas_of_operation') }}</textarea>
        </div>

        <div class="form-group">
            <label for="price_range">Price Range (Optional)</label>
            <input type="text" name="price_range" id="price_range" class="form-control" value="{{ old('price_range') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create Vendor Service</button>
    </form>
</div>
@endsection
