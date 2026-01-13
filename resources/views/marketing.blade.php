<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WolfPaq Marketing | SMS Marketing Solutions</title>
    <meta name="vapi-public-key" content="{{ config('services.vapi.public_key') }}">
    <meta name="vapi-assistant-id" content="{{ config('services.vapi.assistant_id') }}">
    <meta name="vapi-metadata" content='@json(["source" => "marketing_page"])'>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 40px;
        }
        .btn-primary-custom {
            background-color: #ff4d4d;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .btn-primary-custom:hover {
            background-color: #e60000;
        }
        .feature-card {
            border: none;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: white;
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #ff4d4d;
            margin-bottom: 20px;
        }
        .marketing-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: -80px auto 0;
        }
        .footer {
            padding: 50px 0;
            background: #111;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">WOLFPAQ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#subscribe">Subscribe</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <h1 class="hero-title">Scale Your Business with SMS Marketing</h1>
            <p class="hero-subtitle">Connect with your customers instantly. 98% open rates that drive real results.</p>
            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <a href="#subscribe" class="btn btn-primary-custom">Get Started Now</a>
                <button type="button" id="vapi-start" class="btn btn-outline-light">Speak with an Agent</button>
                <button type="button" id="vapi-stop" class="btn btn-outline-light" disabled>End Call</button>
            </div>
            <div class="mt-3 small opacity-75">
                <span id="vapi-status">Loading voice assistant…</span>
            </div>
        </div>
    </header>

    <!-- Form Section -->
    <section id="subscribe" class="container">
        <div class="marketing-form">
            <h3 class="text-center mb-4 fw-bold">Join the WolfPaq</h3>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('marketing.subscribe') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="tel" name="phone_number" class="form-control" id="phone_number" placeholder="+1 (555) 000-0000" required value="{{ old('phone_number') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address (Optional)</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="john@example.com" value="{{ old('email') }}">
                </div>
                <button type="submit" class="btn btn-primary-custom w-100 mt-3">Start Marketing</button>
                <p class="text-muted small text-center mt-3">By clicking, you agree to receive marketing SMS from us. Msg & data rates may apply.</p>
            </form>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="container my-5 pt-5">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Why SMS Marketing?</h2>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon">🚀</div>
                    <h4 class="fw-bold">Instant Delivery</h4>
                    <p class="text-muted">Messages reach your audience in seconds, ensuring your offers are seen exactly when you want them to be.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon">📈</div>
                    <h4 class="fw-bold">High Engagement</h4>
                    <p class="text-muted">With 98% open rates, SMS outperforms email and social media marketing by a massive margin.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon">🎯</div>
                    <h4 class="fw-bold">Targeted Reach</h4>
                    <p class="text-muted">Reach your most loyal customers directly on the device they use most—their mobile phone.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 WolfPaq Marketing. All rights reserved.</p>
            <div class="mt-3">
                <a href="#" class="text-decoration-none text-muted me-3">Privacy Policy</a>
                <a href="#" class="text-decoration-none text-muted">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/marketing-vapi.js') }}"></script>
</body>
</html>
