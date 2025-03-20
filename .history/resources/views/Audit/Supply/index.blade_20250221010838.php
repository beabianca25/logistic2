<table>
    <thead>
        <tr>
            <th>Report Title</th>
            <th>Supply Name</th>
            <th>Remaining Stock</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($supplyReports as $report)
        <tr>
            <td>{{ $report->report_title }}</td>
            <td>{{ $report->supply->name ?? 'N/A' }}</td>
            <td>{{ $report->supply->remaining_stock ?? 'N/A' }}</td> <!-- Displays remaining stock -->
            <td>{{ $report->status }}</td>
            <td>
                <a href="{{ route('supplyreport.show', $report->id) }}">View</a>
                <a href="{{ route('supplyreport.edit', $report->id) }}">Edit</a>
                <form action="{{ route('supplyreport.destroy', $report->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
