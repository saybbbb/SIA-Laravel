<!DOCTYPE html>
<html>
<head>
    <title>Transaction Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Transaction Records Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Water Pump</th>
                <th>Supplier</th>
                <th>Date</th>
                <th>Total Water Used (L)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->water->pump_name }}</td>
                    <td>{{ $transaction->supplier->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d') }}</td>
                    <td>{{ $transaction->total_water_used }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
