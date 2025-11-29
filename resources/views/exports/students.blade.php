<!DOCTYPE html>
<html>
<head>
    <title>Students Report</title>
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
    <h1>Students Report</h1>
    <p>Generated at: {{ date('Y-m-d H:i:s') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NIS</th>
                <th>Name</th>
                <th>Class</th>
                <th>Photo</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->nis }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->schoolClass ? $student->schoolClass->class_name : '' }}</td>
                <td>{{ $student->photo }}</td>
                <td>{{ $student->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>