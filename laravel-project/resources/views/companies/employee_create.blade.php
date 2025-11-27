{{-- File: resources/views/companies/employee_create.blade.php
         Purpose: Form to add an employee for a specific company.
         Main sections:
             - Header with company name
             - Validation errors
             - Employee form fields
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        body{font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;background:#f5f7fa;color:#333}
        .container{max-width:800px;margin:40px auto;padding:20px}
        .card{background:#fff;padding:24px;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.06)}
        label{display:block;margin-bottom:6px;font-weight:600}
        input{width:100%;padding:10px;border:1px solid #e6e6e6;border-radius:6px}
        .actions{margin-top:18px;display:flex;gap:12px}
        .btn{padding:10px 16px;border-radius:6px;border:none;cursor:pointer}
        .btn-primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
        .btn-cancel{background:#fff;border:1px solid #ddd}
        .errors{background:#fdecea;color:#7a1b1b;padding:12px;border-radius:6px;margin-bottom:12px}
    </style>
</head>
<body>
    {{-- Container: employee form for the given company --}}
    <div class="container">
        <div class="card">
            <h2 style="margin-bottom:6px;color:#667eea">Add Employee to {{ $company->name }}</h2>
            <p style="color:#666;margin-bottom:16px">Company ID: #{{ $company->id }}</p>

            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('companies.employees.store', $company->id) }}" method="POST">
                @csrf

                <div style="margin-bottom:12px">
                    <label>First Name</label>
                    <input type="text" name="firstname" value="{{ old('firstname') }}" required>
                </div>

                <div style="margin-bottom:12px">
                    <label>Last Name</label>
                    <input type="text" name="lastname" value="{{ old('lastname') }}" required>
                </div>

                <div style="margin-bottom:12px">
                    <label>Email</label>
                    <input type="email" name="employeeemail" value="{{ old('employeeemail') }}">
                </div>

                <div style="margin-bottom:12px">
                    <label>Phone</label>
                    <input type="text" name="employeephone" value="{{ old('employeephone') }}">
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Add Employee</button>
                    <a class="btn btn-cancel" href="{{ route('companies.show', $company->id) }}">Back to Company</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
