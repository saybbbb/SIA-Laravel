<!DOCTYPE html>
<html>
<head>
    <title>Water Records PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Water Records Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pump Name</th>
                <th>Total Water Used (L)</th>
                <th>Last Maintenance</th>
                <th>Health Check</th>
            </tr>
        </thead>
        <tbody>
            @foreach($waters as $water)
                <tr>
                    <td>{{ $water->id }}</td>
                    <td>{{ $water->pump_name }}</td>
                    <td>{{ $water->total_water_used }}</td>
                    <td>{{ \Carbon\Carbon::parse($water->last_maintenance)->format('Y-m-d') }}</td>
                    <td>{{ $water->health_check }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
