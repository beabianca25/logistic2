@extends('vendorbase')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    Vendor Dashboard
    
@endsection