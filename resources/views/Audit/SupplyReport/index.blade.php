@extends('base')

@section('content')

    <div class="container" style="font-family: sans-serif; font-size: small;">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/reports') }}">Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Supply Reports</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Supply Reports</h3>

                            @if (session('success'))
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
                        </div>
                        
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0 small-font">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Supply Name</th>
                                            <th>Remaining Stock</th>
                                            <th>Report Title</th>
                                            <th>Status</th>
                                            <th>Submitted at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplyReports as $report)
                                            <tr>
                                                <td>{{ str_pad(strtoupper(dechex($report->id)), 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $report->supply ? $report->supply->supply_name : 'No Supply' }}</td>
                                                <td>{{ $report->supply ? $report->supply->remaining_stock : 'N/A' }}</td>
                                                <td>{{ $report->report_title }}</td>
                                                <td>
                                                    @if ($report->status === 'Pending Review')
                                                        <span class="badge bg-warning text-dark">{{ $report->status }}</span>
                                                    @elseif ($report->status === 'Reviewed')
                                                        <span class="badge bg-primary">{{ $report->status }}</span>
                                                    @elseif ($report->status === 'Approved')
                                                        <span class="badge bg-success">{{ $report->status }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $report->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $report->submitted_at }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('supplyreport.show', $report->id) }}" class="btn btn-info btn-sm mx-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('supplyreport.edit', $report->id) }}" class="btn btn-warning btn-sm mx-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('supplyreport.destroy', $report->id) }}" method="POST" id="deleteForm{{ $report->id }}" class="mx-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $report->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar for Reports Chart -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Report Submissions</h3>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="reportChart" height="400"></canvas>
                        </div>
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

        // Report Chart Initialization
        $(document).ready(function() {
        var reportChartCanvas = $('#reportChart').get(0).getContext('2d');
        var reportData = {
            labels: ['Pending Review', 'Reviewed', 'Approved', 'Other'],
            datasets: [{
                data: [{{ $pendingCount ?? 0 }}, {{ $reviewedCount ?? 0 }}, {{ $approvedCount ?? 0 }}, {{ $otherCount ?? 0 }}],
                backgroundColor: ['#f39c12', '#007bff', '#28a745', '#6c757d']
            }]
        };
        var reportOptions = { legend: { display: true } };
        new Chart(reportChartCanvas, { type: 'doughnut', data: reportData, options: reportOptions });
    });
    </script>
@endsection
