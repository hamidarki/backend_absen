<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Attendance Report</h1>
    <p>Date: {{ $date }}</p>
    <p>Generated at: {{ date('Y-m-d H:i:s') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student NIS</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->id }}</td>
                <td>{{ $attendance->student->nis }}</td>
                <td>{{ $attendance->student->student_name }}</td>
                <td>{{ $attendance->student->schoolClass ? $attendance->student->schoolClass->class_name : '' }}</td>
                <td>{{ $attendance->date }}</td>
                <td>{{ $attendance->time_in ?? '-' }}</td>
                <td>{{ $attendance->time_out ?? '-' }}</td>
                <td>{{ $attendance->status }}</td>
                <td>{{ $attendance->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>