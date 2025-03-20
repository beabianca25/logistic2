@extends('base')

@section('title', 'Product/Service Details')

@section('content')
    <div class="container">
        <h1 class="text-center">Product/Service Details</h1>
        <h4 class="text-center">Supplier: {{ $productService->supplier->company_name }}</h4>
        <hr>

        <!-- Product/Service Details Table -->
        <table class="table table-bordered">
            <tr>
                <td><strong>Category:</strong></td>
                <td>{{ $productService->category }}</td>
            </tr>
            <tr>
                <td><strong>Description:</strong></td>
                <td>{{ $productService->description }}</td>
            </tr>
            <tr>
                <td><strong>Price:</strong></td>
                <td>
                    @if($productService->price)
                        ${{ number_format($productService->price, 2) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Lead Time:</strong></td>
                <td>{{ $productService->lead_time }}</td>
            </tr>
            <tr>
                <td><strong>Minimum Order:</strong></td>
                <td>
                    @if($productService->minimum_order)
                        {{ $productService->minimum_order }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Created At:</strong></td>
                <td>{{ $productService->created_at->format('F d, Y h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Last Updated:</strong></td>
                <td>{{ $productService->updated_at->format('F d, Y h:i A') }}</td>
            </tr>
        </table>

        <!-- Buttons -->
        <div class="button-container mt-3">
            <a href="{{ route('productservice.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('productservice.edit', $productService->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
