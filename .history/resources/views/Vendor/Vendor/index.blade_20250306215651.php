@extends('base')

@section('content')     
    <div class="container">  

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/vendors') }}">Vendor Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vendors List</li>
            </ol>
        </nav>

        <h3 class="my-4">Vendors List</h3>         

        <table class="table table-sm">             
            <thead class="thead-dark">                 
                <tr>                     
                    <th style="width: 10%;">ID</th>                     
                    <th style="width: 60%;">Business Name</th>  
                    <th style="width: 30%;">Actions</th>               
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
                        <td>
                            @can('show vendors')
                                <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-info btn-sm">View</a>
                            @endcan

                            @can('edit vendors')
                                <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan

                            @can('delete vendors')
                                <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endcan
                        </td>                     
                    </tr>                 
                @endforeach             
            </tbody>         
        </table>     
    </div> 
@endsection  
