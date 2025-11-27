{{-- File: resources/views/welcome.blade.php
         Purpose: Landing page / welcome view. Main sections:
             - Header (app title and subtitle)
             - Features grid (high level product features)
            - Call-to-action (login/register or go to dashboard)
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Company Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .container {
                background: white;
                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
                max-width: 1000px;
                width: 100%;
                overflow: hidden;
            }

            header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                padding: 40px 30px;
                text-align: center;
                color: white;
            }

            header h1 {
                font-size: 2.5rem;
                font-weight: 600;
                margin-bottom: 10px;
            }

            header p {
                font-size: 1.1rem;
                opacity: 0.9;
                font-weight: 400;
            }

            .content {
                padding: 50px 40px;
            }

            .features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 30px;
                margin-bottom: 40px;
            }

            .feature {
                text-align: center;
                padding: 25px;
                background: #f8f9fa;
                border-radius: 8px;
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }

            .feature:hover {
                border-color: #667eea;
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15);
            }

            .feature-icon {
                font-size: 2.5rem;
                margin-bottom: 15px;
            }

            .feature h3 {
                font-size: 1.3rem;
                color: #333;
                margin-bottom: 10px;
                font-weight: 600;
            }

            .feature p {
                color: #666;
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .cta-section {
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
                border-radius: 8px;
                padding: 40px;
                text-align: center;
                margin-top: 50px;
            }

            .cta-section h2 {
                font-size: 1.8rem;
                color: #333;
                margin-bottom: 20px;
                font-weight: 600;
            }

            .btn-group {
                display: flex;
                gap: 15px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .btn {
                padding: 12px 30px;
                border-radius: 6px;
                font-size: 1rem;
                font-weight: 500;
                border: none;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            }

            .btn-secondary {
                background: white;
                color: #667eea;
                border: 2px solid #667eea;
            }

            .btn-secondary:hover {
                background: #667eea;
                color: white;
            }

            footer {
                background: #f8f9fa;
                padding: 30px;
                text-align: center;
                color: #666;
                font-size: 0.9rem;
                border-top: 1px solid #eee;
            }

            @media (max-width: 768px) {
                header h1 {
                    font-size: 1.8rem;
                }

                .content {
                    padding: 30px 20px;
                }

                .features {
                    gap: 20px;
                }

                .cta-section {
                    padding: 30px 20px;
                }

                .cta-section h2 {
                    font-size: 1.4rem;
                }

                .btn-group {
                    flex-direction: column;
                }

                .btn {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Company Management System</h1>
                <p>Organize, manage, and streamline your business operations</p>
            </header>

            <div class="content">
                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">🏢</div>
                        <h3>Manage Companies</h3>
                        <p>Keep track of all your companies with detailed information including contact details and web presence.</p>
                    </div>

                    <div class="feature">
                        <div class="feature-icon">👥</div>
                        <h3>Employee Directory</h3>
                        <p>View and manage employees across your organization with comprehensive contact information.</p>
                    </div>

                    <div class="feature">
                        <div class="feature-icon">📊</div>
                        <h3>Dashboard Analytics</h3>
                        <p>Get insights into your company structure with an intuitive and responsive dashboard.</p>
                    </div>

                    <div class="feature">
                        <div class="feature-icon">🔐</div>
                        <h3>Secure Access</h3>
                        <p>Protected authentication system ensures your data is safe and secure.</p>
                    </div>

                    <div class="feature">
                        <div class="feature-icon">⚡</div>
                        <h3>Fast & Reliable</h3>
                        <p>Built with Laravel for performance, scalability, and reliability.</p>
                    </div>

                    <div class="feature">
                        <div class="feature-icon">📱</div>
                        <h3>Responsive Design</h3>
                        <p>Works seamlessly on desktop, tablet, and mobile devices.</p>
                    </div>
                </div>

                <div class="cta-section">
                    <h2>Ready to Get Started?</h2>
                    <p style="color: #666; margin-bottom: 25px; font-size: 1.05rem;">Join thousands of businesses managing their operations efficiently</p>
                    <div class="btn-group">
                            @auth
                            <a href="{{ route('companies.index') }}" class="btn btn-primary">Go to Companies</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-secondary">Create Account</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            <footer>
                <p>&copy; 2025 Company Management System. All rights reserved.</p>
            </footer>
        </div>
    </body>
</html>
