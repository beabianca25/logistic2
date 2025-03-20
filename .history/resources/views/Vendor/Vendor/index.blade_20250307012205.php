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
                    <th style="width: 30%;">Business Name</th>
                    <th style="width: 30%;">Email</th>
                    <th style="width: 150%;">Status</th> <!-- Added Status Column -->
                    <th style="width: 15%;">Actions</th>
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
                                {{ $vendor->contact_email }}
                            </a>
                        </td>
                        <td>
                            <span
                                class="badge 
        @if ($vendor->status == 'Active') badge-success
        @elseif($vendor->status == 'Inactive') badge-secondary
        @elseif($vendor->status == 'Pending') badge-warning
        @elseif($vendor->status == 'Admin Review') badge-info
        @elseif($vendor->status == 'Manager Approved') badge-primary
        @else badge-dark @endif">
                                {{ $vendor->status }}
                            </span>
                        </td>

                        <td>
                            @can('manage vendors')
                                <!-- If user has 'manage vendors' permission, they can perform all actions -->
                                <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <!-- If user has specific permissions -->
                                @can('show vendors')
                                    <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                        
                                @can('edit vendors')
                                    <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                        
                                @can('delete vendors')
                                    <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            @endcan
                        </td>
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
