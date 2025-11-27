{{-- File: resources/views/companies/show.blade.php
         Purpose: Display a company's details and its employees. Main sections:
             - Navbar (auth + logout)
             - Page header (company title + actions)
             - Company info grid (ID, email, website, logo)
             - Employees section (table of employees)
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->name }} - Details</title>
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

        .company-info {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .info-item label {
            font-weight: 600;
            color: #667eea;
            display: block;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .info-item p {
            color: #555;
            word-break: break-word;
        }

        .employees-section h2 {
            font-size: 24px;
            color: #667eea;
            margin-bottom: 20px;
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

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    {{-- Navbar: shows app title, user name, and logout form --}}
    <div class="navbar">
        <h2>Company Details</h2>
        <div class="navbar-right">
            <span>Welcome, <strong>{{ Auth::user()->name }}</strong></span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        {{-- Page header: company name, add employee, back, delete actions --}}
        <div class="page-header" style="align-items:flex-start;gap:12px">
            <div>
                <h1>{{ $company->name }}</h1>
            </div>
            <div style="margin-left:auto;display:flex;gap:8px">
                <a href="{{ route('companies.employees.create', $company->id) }}" class="back-btn" style="background:#fff;color:#667eea;border:1px solid #e6e6e6">+ Add Employee</a>
                <a href="{{ route('companies.index') }}" class="back-btn">← Back to Companies</a>
                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Delete this company and all its employees?');" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="back-btn" style="background:#e05656;border:none">Delete Company</button>
                </form>
            </div>
        </div>

        {{-- Company info: displays ID, email, website, logo --}}
        <div class="company-info">
            <div class="info-grid">
                <div class="info-item">
                    <label>Company ID</label>
                    <p>#{{ $company->id }}</p>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <p>{{ $company->email }}</p>
                </div>
                <div class="info-item">
                    <label>Website</label>
                    <p>
                        @if ($company->website)
                            <a href="https://{{ $company->website }}" target="_blank" style="color: #667eea; text-decoration: none;">{{ $company->website }}</a>
                        @else
                            <span style="color: #ccc;">N/A</span>
                        @endif
                    </p>
                </div>
                <div class="info-item">
                    <label>Logo</label>
                    <p>
                        @if ($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} logo" style="max-width:160px;max-height:80px;border-radius:6px;object-fit:contain">
                        @else
                            <span style="color: #ccc;">N/A</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- Employees section: lists employees for this company and delete actions --}}
        <div class="employees-section">
            <h2>Employees ({{ $employees->count() }})</h2>

            @if ($employees->count() > 0)
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>#{{ $employee->id }}</td>
                                    <td>{{ $employee->firstname }}</td>
                                    <td>{{ $employee->lastname }}</td>
                                    <td>{{ $employee->employeeemail }}</td>
                                    <td>{{ $employee->employeephone }}</td>
                                    <td>
                                        <form action="{{ route('companies.employees.destroy', ['id' => $company->id, 'employeeId' => $employee->id]) }}" method="POST" onsubmit="return confirm('Delete this employee?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:transparent;border:none;color:#e05656;cursor:pointer;font-weight:600">Delete</button>
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
                        <p>No employees found for this company.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
