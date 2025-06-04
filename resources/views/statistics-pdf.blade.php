<!DOCTYPE html>
<html>

<head>
    <title>Statistics Report</title>
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

        h1, h2 {
            margin-top: 0;
        }

        ul {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="title-section">
            <h2>Statistics Report</h2>
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

    <p><strong>Total Waters:</strong> {{ $totalWaters }}</p>
    <p><strong>Total Suppliers:</strong> {{ $totalSuppliers }}</p>
    <p><strong>Total Transactions:</strong> {{ $totalTransactions }}</p>

    <h2>Water Usage by Pump</h2>
    <ul>
        @foreach($waterUsage as $usage)
            <li>{{ $usage->water->pump_name ?? 'Unknown' }}: {{ number_format($usage->total, 2) }} L</li>
        @endforeach
    </ul>

    <h2>Water Usage by Supplier</h2>
    <ul>
        @foreach($supplierUsage as $usage)
            <li>{{ $usage->supplier->name ?? 'Unknown' }}: {{ number_format($usage->total, 2) }} L</li>
        @endforeach
    </ul>
</body>

</html>
