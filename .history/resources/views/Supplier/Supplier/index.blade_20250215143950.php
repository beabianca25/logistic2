@extends('base')

@section('title', 'Supplier List')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/suppliers') }}">Supplier Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Supplier List</li>
            </ol>
        </nav>

        <h3 class="my-4">Supplier List</h3>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 45%;">Company Name</th>
                    <th style="width: 45%;">Contact Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ str_pad(strtoupper(dechex($supplier->id)), 4, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <a href="{{ route('supplier.show', $supplier->id) }}" class="text-primary">
                                {{ $supplier->company_name }}
                            </a>
                        </td>
                        <td>{{ $supplier->contact_email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
