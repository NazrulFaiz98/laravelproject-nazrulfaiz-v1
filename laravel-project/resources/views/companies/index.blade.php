{{-- File: resources/views/companies/index.blade.php
         Purpose: Shows list of companies with actions to view, add, and delete companies.
         Main sections:
             - Navbar (auth + logout)
             - Header (page title + add/back actions)
             - Flash messages (success/error)
             - Companies table or empty state
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar h2 {
            font-size: 24px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 16px;
            border: 1px solid white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 32px;
            color: #667eea;
        }

        .back-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #667eea;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .action-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .action-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    {{-- Navbar: app title and logout --}}
    <div class="navbar">
        <h2>Companies Management</h2>
        <div class="navbar-right">
            <span>Welcome, <strong>{{ Auth::user()->name }}</strong></span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        {{-- Page header: title and actions (add company, back) --}}
        <div class="page-header">
            <h1>Companies List</h1>
            <div style="display:flex;gap:12px;align-items:center">
                <a href="{{ route('companies.create') }}" class="back-btn" style="background:#fff;color:#667eea;border:1px solid #e6e6e6">+ Add Company</a>
            </div>
        </div>

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        @if ($companies->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>#{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    @if ($company->website)
                                        <a href="https://{{ $company->website }}" target="_blank" class="action-link">{{ $company->website }}</a>
                                    @else
                                        <span style="color: #ccc;">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('companies.show', $company->id) }}" class="action-link">View Details</a>
                                    |
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;margin-left:8px" onsubmit="return confirm('Delete this company and all its employees?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:transparent;border:none;color:#e05656;font-weight:600;cursor:pointer">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-container">
                <div class="empty-state">
                    <p>No companies found.</p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
