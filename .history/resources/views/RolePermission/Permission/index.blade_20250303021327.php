@extends('base')

@section('content')
<div class="container mt-5">
    <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
    <a href="{{ url('permission') }}" class="btn btn-info mx-1">Permissions</a>
    <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
</div>

<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card mt-3">
                <div class="card-header">
                    <h4>Permissions
                       <a href="{{ url('permission/create') }}" class="btn btn-primary float-end">Add Permission</a>

                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th width="40%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                  
                                    <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-success">Edit</a>

                                    <form action="{{ route('permission.delete', $permission->id) }}"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"class="btn btn-danger mx-2">Delete</button>
                                    </form>
                                    
                                    
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
@endsection