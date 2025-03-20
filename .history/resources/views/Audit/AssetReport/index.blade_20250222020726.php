@extends('base') {{-- Extend your main layout --}}

@section('content')
<div class="container" style="font-family: sans-serif; font-size: small;">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/assets') }}">Audit Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Asset Reports</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Asset Reports</h3>
                    <a href="{{ route('assetreport.create') }}" class="btn btn-sm btn-primary float-right">
                        <i class="fas fa-plus"></i> Add New Report
                    </a>                            
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    </script>
                @endif

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered small-font">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Asset</th>
                                    <th>Report Title</th>
                                    <th>Report Type</th>
                                    <th>Status</th>
                                    <th>Report Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assetReports as $report)
                                <tr>
                                    <td>{{ str_pad(strtoupper(dechex($report->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $report->asset->asset_name ?? 'N/A' }}</td> {{-- Show asset name --}}
                                    <td>{{ $report->report_title }}</td>
                                    <td>{{ $report->report_type }}</td>
                                    <td>
                                        @if($report->status === 'Pending Review')
                                            <span class="badge bg-warning">{{ $report->status }}</span>
                                        @elseif($report->status === 'Reviewed')
                                            <span class="badge bg-primary">{{ $report->status }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $report->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
                                    <td>
                                        {{-- View button --}}
                                        <a href="{{ route('assetreport.show', $report->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- Edit button --}}
                                        <a href="{{ route('assetreport.edit', $report->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete button with confirmation --}}
                                        <form action="{{ route('assetreport.destroy', $report->id) }}" method="POST" id="deleteForm{{ $report->id }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $report->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

        <!-- Right Panel (Stock Distribution Chart) -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stock Distribution</h3>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <canvas id="stockChart" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Delete Confirmation -->
<script>
    function confirmDelete(reportId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + reportId).submit();
            }
        });
    }

    $(document).ready(function() {
            var assetChartCanvas = $('#stockChart').get(0).getContext('2d');

            var assetChart = new Chart(assetChartCanvas, {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
                    }]
                },
                options: {
                    legend: {
                        display: true
                    }
                }
            });

            function fetchAssetData() {
                $.ajax({
                    url: "{{ url('/api/asset-distribution') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        assetChart.data.labels = response.labels;
                        assetChart.data.datasets[0].data = response.data;
                        assetChart.update();
                    },
                    error: function() {
                        console.error("Failed to fetch asset data.");
                    }
                });
            }

            // Fetch data immediately and refresh every 5 seconds
            fetchAssetData();
            setInterval(fetchAssetData, 5000);
        });
</script>

@endsection
