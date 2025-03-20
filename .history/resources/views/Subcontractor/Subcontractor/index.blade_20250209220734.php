@extends('base')

@section('content')
<div class="container">
    <h1>Subcontractors</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Subcontractors Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcontractors as $subcontractor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subcontractor->subcontractor_name }}</td>
                    <td>{{ $subcontractor->contact_person }}</td>
                    <td>{{ $subcontractor->phone }}</td>
                    <td>{{ $subcontractor->email }}</td>
                    <td>
                        <a href="{{ route('subcontractor.show', $subcontractor->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('subcontractor.destroy', $subcontractor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
