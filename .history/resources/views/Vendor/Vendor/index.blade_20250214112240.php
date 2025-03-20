@extends('base')  

@section('content')     
    <div class="container">  

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/vendors') }}">Vendor Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vendors List</li>
            </ol>
        </nav>

        <h1 class="my-4">Vendors List</h1>         
        <table class="table table-sm">             
            <thead class="thead-dark">                 
                <tr>                     
                    <th style="width: 10%;">ID</th>                     
                    <th style="width: 90%;">Business Name</th>                 
                </tr>             
            </thead>             
            <tbody>                 
                @foreach ($vendors as $vendor)                     
                    <tr>                         
                        <td>{{ str_pad(strtoupper(dechex($vendor->id)), 4, '0', STR_PAD_LEFT) }}</td>                         
                        <td>                             
                            <a href="{{ route('vendor.show', $vendor->id) }}" class="text-primary">                                 
                                {{ $vendor->business_name }}                             
                            </a>                         
                        </td>                     
                    </tr>                 
                @endforeach             
            </tbody>         
        </table>     
    </div> 
@endsection  
