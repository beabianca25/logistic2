@extends('base')

@section('content')
    <div class="container">
        <h1 class="my-4">Subcontractors List</h1>
        <table class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 45%;">Subcontractor Name</th>
                    <th style="width: 45%;">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcontractors as $subcontractor)
                    <tr>
                        <td>{{ str_pad(strtoupper(dechex($subcontractor->id)), 4, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <a href="{{ route('subcontractor.show', $subcontractor->id) }}" class="text-primary">
                                {{ $subcontractor->subcontractor_name }}
                            </a>
                        </td>
                        <td>{{ $subcontractor->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
