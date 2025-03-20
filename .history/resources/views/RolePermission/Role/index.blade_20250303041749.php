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
                    <h4>
                        Roles
                        <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a>
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
                            @forelse ($roles as $role)
                            <tr>
                               <td>{{ $role->id }}</td>
                               <td>{{ $role->name }}</td>
                               <td>
                                  <div class="btn-group">
                                     <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">Permissions</a>
                         
                                     <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">Edit</a>
                             
                         
                                     <form action="{{ route('roles.delete', $role->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                    
                                  </div>
                               </td>
                            </tr>
                            @empty
                            <tr>
                               <td colspan="3" class="text-center">No roles found.</td>
                            </tr>
                            @endforelse
                         </tbody>
                         
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection