<!DOCTYPE html>
<html>

<head>
    <title>Transaction Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        header .title-section {
            text-align: left;
        }

        header h2 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        header p {
            font-size: 12px;
            color: #666;
            margin: 4px 0 0 0;
        }

        header .account-info {
            text-align: right;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 0;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        .account-details {
            font-size: 12px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #007BFF;
            color: white;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Optional page break for PDF generators */
        @media print {
            table {
                page-break-after: auto
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto
            }

            td {
                page-break-inside: avoid;
                page-break-after: auto
            }

            thead {
                display: table-header-group
            }

            tfoot {
                display: table-footer-group
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="title-section">
            <h2>Transaction Records Report</h2>
            <p>Generated on {{ \Carbon\Carbon::now()->format('F j, Y, g:i A') }}</p>
        </div>

        <div class="account-info">
            @if($account->avatar)
                <img src="{{ public_path('storage/' . $account->avatar) }}" alt="Avatar" class="avatar" />
            @else
                <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="avatar" />
            @endif
            <div class="account-details">
                <div><strong>{{ $account->name }}</strong></div>
                <div>{{ $account->email }}</div>
            </div>
        </div>
    </header>

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
                    <td>{{ number_format($transaction->total_water_used, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
