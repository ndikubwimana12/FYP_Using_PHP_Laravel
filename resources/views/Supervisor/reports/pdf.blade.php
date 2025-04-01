<!DOCTYPE html>
<html>
<head>
    <title>Supervisor Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Supervisor Report</h1>
        <p>Generated on: {{ $generated_at }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Registration Number</th>
                <th>Project</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->FirstName }} {{ $student->LastName }}</td>
                <td>{{ $student->StudentRegNumber }}</td>
                <td>{{ $student->project->ProjectName ?? 'Not Assigned' }}</td>
                <td>{{ $student->supervision->status ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
