{{-- File: resources/views/companies/create.blade.php
         Purpose: Provide a form to create a new company. Main sections:
             - Form (name, email, website, logo upload)
             - Validation error display
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Company</title>
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
    {{-- Container: create form card --}}
    <div class="container">
        <div class="card">
            <h2 style="margin-bottom:10px;color:#667eea">Create Company</h2>

            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom:12px">
                    <label>Company Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                </div>

                <div style="margin-bottom:12px">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div style="margin-bottom:12px">
                    <label>Website (https://...)</label>
                    <input type="text" name="website" value="{{ old('website') }}">
                </div>

                <div style="margin-bottom:12px">
                    <label>Logo (upload image)</label>
                    <input type="file" name="logo" accept="image/*">
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Create</button>
                    <a class="btn btn-cancel" href="{{ route('companies.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
