<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply Reports</title>
    <!-- Add your stylesheets here -->
</head>
<body>
<div class="container">
    <h2>Supply Reports</h2>
    <table class="table">
        <thead>
            <tr> 
                <th>ID</th>
                <th>Supply Name</th>
                <th>Report Title</th>
                <th>Status</th>
                <th>Location</th>
                <th>Report Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($supplyReports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>
                        <!-- Check if 'supply' exists, otherwise display 'No Supply' -->
                        {{ $report->supply ? $report->supply->supply_name : 'No Supply' }}
                    </td>  
                    <td>{{ $report->report_title }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->report_date }}</td>
                    <td>
                        <a href="{{ route('supplyreport.show', $report) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('supplyreport.edit', $report) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('supplyreport.destroy', $report) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
