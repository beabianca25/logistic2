@extends('base')

@section('content')
<div class="container">
    <h2>My Application</h2>
    <table class="table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Business Name</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($endors as $vendor)

                <td>{{ $vendor->id }}</td>
                <td>{{ $vendor->business_name }}</td>
                <td>{{ $vendor->email }}</td>
                <td>
                    <span class="badge badge-info">{{ $vendor->status }}</span>
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@endsection
