<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Statistics Report</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Statistics Report</h1>

    <p><strong>Total Waters:</strong> {{ $totalWaters }}</p>
    <p><strong>Total Suppliers:</strong> {{ $totalSuppliers }}</p>
    <p><strong>Total Transactions:</strong> {{ $totalTransactions }}</p>

    <h2>Water Usage by Pump</h2>
    <ul>
        @foreach($waterUsage as $usage)
            <li>{{ $usage->water->pump_name ?? 'Unknown' }}: {{ $usage->total }} L</li>
        @endforeach
    </ul>

    <h2>Water Usage by Supplier</h2>
    <ul>
        @foreach($supplierUsage as $usage)
            <li>{{ $usage->supplier->name ?? 'Unknown' }}: {{ $usage->total }} L</li>
        @endforeach
    </ul>
</body>
</html>
