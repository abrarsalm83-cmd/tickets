<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Support Tickets</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            color: #1e293b;
            line-height: 1.6;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Dark mode styles */
        body.dark {
            background: #0f172a;
            color: #e2e8f0;
        }

        body.dark .header {
            background: #1e293b;
            border-bottom: 1px solid #334155;
        }

        body.dark .logo {
            color: #e2e8f0;
        }

        body.dark .nav-link {
            color: #94a3b8;
        }

        body.dark .nav-link:hover {
            color: #3b82f6;
        }

        body.dark .nav-link.active {
            color: #3b82f6;
        }

        body.dark .btn-outline {
            color: #94a3b8;
            border: 1px solid #475569;
            background: #1e293b;
        }

        body.dark .btn-outline:hover {
            color: #3b82f6;
            border-color: #3b82f6;
        }

        body.dark .btn-primary {
            background: #3b82f6;
            color: white;
        }

        body.dark .btn-primary:hover {
            background: #2563eb;
        }

        body.dark .user-name {
            color: #e2e8f0;
        }

        body.dark .hero h1 {
            color: #e2e8f0;
        }

        body.dark .hero p {
            color: #94a3b8;
        }

        body.dark .features {
            background: #0f172a;
        }

        body.dark .features h2 {
            color: #e2e8f0;
        }

        body.dark .feature-card {
            background: #1e293b;
            border: 1px solid #334155;
        }

        body.dark .feature-card:hover {
            border-color: #3b82f6;
        }

        body.dark .feature-card h3 {
            color: #e2e8f0;
        }

        body.dark .feature-card p {
            color: #94a3b8;
        }

        body.dark .stats {
            background: #1e293b;
        }

        body.dark .stats h2 {
            color: #e2e8f0;
        }

        body.dark .stat-item {
            background: #334155;
            border: 1px solid #475569;
        }

        body.dark .stat-item:hover {
            border-color: #3b82f6;
        }

        body.dark .stat-label {
            color: #94a3b8;
        }

        body.dark .cta {
            background: #1e293b;
            border-top: 1px solid #334155;
        }

        body.dark .cta h2 {
            color: #e2e8f0;
        }

        body.dark .cta p {
            color: #94a3b8;
        }

        body.dark .about {
            background: #0f172a;
            border-top: 1px solid #334155;
        }

        body.dark .about h2 {
            color: #e2e8f0;
        }

        body.dark .about-text p {
            color: #94a3b8;
        }

        body.dark .about-stat {
            background: #1e293b;
            border: 1px solid #334155;
        }

        body.dark .about-stat-label {
            color: #94a3b8;
        }

        body.dark .contact {
            background: #1e293b;
        }

        body.dark .contact h2 {
            color: #e2e8f0;
        }

        body.dark .contact-info {
            background: #334155;
            border: 1px solid #475569;
        }

        body.dark .contact-info h3 {
            color: #e2e8f0;
        }

        body.dark .contact-item {
            color: #94a3b8;
        }

        body.dark .contact-form {
            background: #334155;
            border: 1px solid #475569;
        }

        body.dark .contact-form h3 {
            color: #e2e8f0;
        }

        body.dark .form-label {
            color: #e2e8f0;
        }

        body.dark .form-input {
            background: #1e293b;
            border: 1px solid #475569;
            color: #e2e8f0;
        }

        body.dark .form-input:focus {
            border-color: #3b82f6;
        }

        body.dark .contact-submit {
            background: #3b82f6;
        }

        body.dark .contact-submit:hover {
            background: #2563eb;
        }

        body.dark .footer {
            background: #0f172a;
            border-top: 1px solid #334155;
        }

        body.dark .footer p {
            color: #64748b;
        }

        body.dark .footer-link {
            color: #64748b;
        }

        body.dark .footer-link:hover {
            color: #3b82f6;
        }

        /* Dark mode toggle button */
        .dark-mode-toggle {
            background: none;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-left: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 36px;
        }

        .dark-mode-toggle:hover {
            border-color: #3b82f6;
            color: #3b82f6;
        }

        body.dark .dark-mode-toggle {
            border-color: #475569;
            color: #94a3b8;
        }

        body.dark .dark-mode-toggle:hover {
            border-color: #3b82f6;
            color: #3b82f6;
        }

        /* Header */
        .header {
            background: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 12px;
            height: 12px;
            background: white;
            border-radius: 2px;
            transform: translate(-50%, -50%);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 32px;
            align-items: center;
        }

        .nav-link {
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
            font-size: 0.875rem;
        }

        .nav-link:hover {
            color: #3b82f6;
        }

        .nav-link.active {
            color: #3b82f6;
            font-weight: 600;
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .btn-outline {
            color: #6b7280;
            border: 1px solid #d1d5db;
            background: white;
        }

        .btn-outline:hover {
            color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-primary {
            background: #1e293b;
            color: white;
        }

        .btn-primary:hover {
            background: #334155;
            transform: translateY(-1px);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-name {
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .logout-btn {
            color: #dc2626;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .logout-btn:hover {
            color: #b91c1c;
            background: rgba(220, 38, 38, 0.1);
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 80px 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: #1e293b;
            line-height: 1.2;
            transition: color 0.3s ease;
        }

        .hero p {
            font-size: 1.125rem;
            color: #6b7280;
            margin-bottom: 32px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
            transition: color 0.3s ease;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 8px;
        }

        /* Features Section */
        .features {
            padding: 80px 24px;
            max-width: 1200px;
            margin: 0 auto;
            transition: background-color 0.3s ease;
        }

        .features h2 {
            text-align: center;
            font-size: 2.25rem;
            margin-bottom: 48px;
            color: #1e293b;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .feature-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 32px 24px;
            text-align: center;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-color: #3b82f6;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: #3b82f6;
            border-radius: 12px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 12px;
            color: #1e293b;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.6;
            transition: color 0.3s ease;
        }

        /* Stats Section */
        .stats {
            padding: 80px 24px;
            text-align: center;
            background: #f8fafc;
            transition: background-color 0.3s ease;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .stats h2 {
            font-size: 2.25rem;
            margin-bottom: 48px;
            color: #1e293b;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
        }

        .stat-item {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px 16px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .stat-item:hover {
            transform: translateY(-2px);
            border-color: #3b82f6;
        }

        .stat-number {
            font-size: 2.25rem;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        /* CTA Section */
        .cta {
            padding: 80px 24px;
            text-align: center;
            background: white;
            border-top: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .cta h2 {
            font-size: 2.25rem;
            margin-bottom: 16px;
            color: #1e293b;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .cta p {
            font-size: 1.125rem;
            color: #6b7280;
            margin-bottom: 32px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            transition: color 0.3s ease;
        }

        /* Footer */
        .footer {
            background: #1e293b;
            padding: 48px 24px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer p {
            color: #9ca3af;
            margin-bottom: 16px;
            transition: color 0.3s ease;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s ease;
            font-size: 0.875rem;
        }

        .footer-link:hover {
            color: #3b82f6;
        }

        /* About Section */
        .about {
            padding: 80px 24px;
            background: white;
            border-top: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .about h2 {
            text-align: center;
            font-size: 2.25rem;
            margin-bottom: 48px;
            color: #1e293b;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
        }

        .about-text p {
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 1.125rem;
            transition: color 0.3s ease;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .about-stat {
            text-align: center;
            padding: 24px 16px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .about-stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 8px;
        }

        .about-stat-label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        /* Contact Section */
        .contact {
            padding: 80px 24px;
            background: #f8fafc;
            transition: background-color 0.3s ease;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact h2 {
            text-align: center;
            font-size: 2.25rem;
            margin-bottom: 48px;
            color: #1e293b;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: start;
        }

        .contact-info {
            background: white;
            padding: 32px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .contact-info h3 {
            font-size: 1.25rem;
            margin-bottom: 20px;
            color: #1e293b;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            color: #6b7280;
            transition: color 0.3s ease;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-icon {
            width: 20px;
            height: 20px;
            color: #3b82f6;
        }

        .contact-form {
            background: white;
            padding: 32px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .contact-form h3 {
            font-size: 1.25rem;
            margin-bottom: 20px;
            color: #1e293b;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .contact-submit {
            background: #3b82f6;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .contact-submit:hover {
            background: #2563eb;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-hero {
                width: 100%;
                max-width: 280px;
            }

            .features h2,
            .stats h2,
            .cta h2,
            .about h2,
            .contact h2 {
                font-size: 1.875rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 12px;
            }

            .nav-container {
                padding: 0 16px;
            }

            .hero,
            .features,
            .stats,
            .cta,
            .about,
            .contact {
                padding-left: 16px;
                padding-right: 16px;
            }

            .about-content {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .contact-content {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .about-stats {
                grid-template-columns: repeat(3, 1fr);
                gap: 16px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .feature-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .feature-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .feature-card:nth-child(3) {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon"></div>
                <span>Tickets</span>
            </a>

            <nav class="nav-menu">
                <a href="#home" class="nav-link">Home</a>
                <a href="#about" class="nav-link">About</a>
                <a href="#features" class="nav-link">Features</a>
                <a href="#contact" class="nav-link">Contact</a>
            </nav>

            @auth
                <div class="user-menu">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                    <button class="dark-mode-toggle" onclick="toggleDarkMode()">🌙</button>
                </div>
            @else
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    <button class="dark-mode-toggle" onclick="toggleDarkMode()">🌙</button>
                </div>
            @endauth
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <h1>Professional Technical Support System</h1>
        <p>Streamline your IT support operations with our comprehensive ticketing system. Manage, track, and resolve technical issues efficiently while maintaining excellent service quality.</p>
        <div class="hero-buttons">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-hero">Go to Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-hero">Get Started</a>
                <a href="#features" class="btn btn-outline btn-hero">Learn More</a>
            @endauth
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2>Why Choose Our Support System?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🎫</div>
                <h3>Smart Ticket Management</h3>
                <p>Create, assign, and track support tickets with intelligent routing and prioritization. Ensure no technical issue goes unresolved.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔧</div>
                <h3>Comprehensive Maintenance</h3>
                <p>Schedule preventive maintenance, track equipment status, and manage service requests all in one centralized platform.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Real-time Analytics</h3>
                <p>Monitor support metrics, track response times, and generate detailed reports to continuously improve service quality.</p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="about-container">
            <h2>About Our Support Platform</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>We specialize in providing robust technical support and maintenance solutions for businesses of all sizes. Our platform is designed to streamline IT operations, reduce downtime, and enhance productivity.</p>
                    <p>With years of experience in the IT support industry, we understand the challenges organizations face. Our system empowers support teams with the tools they need to deliver exceptional technical assistance and maintain optimal system performance.</p>
                </div>
                <div class="about-stats">
                    <div class="about-stat">
                        <div class="about-stat-number">5+</div>
                        <div class="about-stat-label">Years Experience</div>
                    </div>
                    <div class="about-stat">
                        <div class="about-stat-number">100+</div>
                        <div class="about-stat-label">Cities Covered</div>
                    </div>
                    <div class="about-stat">
                        <div class="about-stat-number">24/7</div>
                        <div class="about-stat-label">Customer Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <h2>Trusted by Thousands</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Events Hosted</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Partner Venues</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Ready to Get Started?</h2>
        <p>Join our community today and discover amazing events happening near you. Create your account and start
            booking tickets in minutes.</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-hero">Go to Dashboard</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-primary btn-hero">Create Account</a>
        @endauth
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="contact-container">
            <h2>Get Technical Support</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <h3>Support Information</h3>
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <span>Tech Support Center, IT District</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📧</span>
                        <span>support@techsupport.com</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <span>+1 (555) TECH-HELP</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">⏰</span>
                        <span>24/7 Emergency Support</span>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Submit a Support Ticket</h3>
                    <form>
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-input" placeholder="Your full name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-input" placeholder="your@company.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Issue Description</label>
                            <textarea class="form-input form-textarea" placeholder="Describe your technical issue or maintenance request"></textarea>
                        </div>
                        <button type="submit" class="contact-submit">Submit Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 Tickets. All rights reserved.</p>
            <div class="footer-links">
                <a href="#" class="footer-link">Privacy Policy</a>
                <a href="#" class="footer-link">Terms of Service</a>
                <a href="#" class="footer-link">Support</a>
                <a href="#" class="footer-link">Contact Us</a>
            </div>
        </div>
    </footer>

    <script>
        // Dark mode functionality
        function toggleDarkMode() {
            const body = document.body;
            const darkModeToggle = document.querySelector('.dark-mode-toggle');

            body.classList.toggle('dark');

            // Update button icon
            if (body.classList.contains('dark')) {
                darkModeToggle.textContent = '☀️';
                localStorage.setItem('darkMode', 'enabled');
            } else {
                darkModeToggle.textContent = '🌙';
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        // Load dark mode preference
        document.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('darkMode');
            const darkModeToggle = document.querySelector('.dark-mode-toggle');

            if (darkMode === 'enabled') {
                document.body.classList.add('dark');
                darkModeToggle.textContent = '☀️';
            } else {
                darkModeToggle.textContent = '🌙';
            }
        });

        // Enhanced smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerHeight = document.querySelector('.header').offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add active state to navigation links
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link[href^="#"]');

        window.addEventListener('scroll', () => {
            let current = '';
            const headerHeight = document.querySelector('.header').offsetHeight;

            sections.forEach(section => {
                const sectionTop = section.offsetTop - headerHeight - 100;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Animate stats on scroll
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statNumbers = entry.target.querySelectorAll('.stat-number');
                    statNumbers.forEach(stat => {
                        const finalNumber = stat.textContent;
                        const isPercentage = finalNumber.includes('%');
                        const isTime = finalNumber.includes('min');
                        
                        if (isTime) {
                            // Handle time format (30min)
                            const timeValue = parseFloat(finalNumber.replace(/[^\d.]/g, ''));
                            let currentTime = 0;
                            const timeIncrement = timeValue / 30;
                            const timeTimer = setInterval(() => {
                                currentTime += timeIncrement;
                                if (currentTime >= timeValue) {
                                    currentTime = timeValue;
                                    clearInterval(timeTimer);
                                }
                                stat.textContent = Math.floor(currentTime) + 'min';
                            }, 50);
                        } else {
                            const cleanNumber = parseFloat(finalNumber.replace(/[^\d.]/g, ''));
                            let currentNumber = 0;
                            const increment = cleanNumber / 50;
                            const timer = setInterval(() => {
                                currentNumber += increment;
                                if (currentNumber >= cleanNumber) {
                                    currentNumber = cleanNumber;
                                    clearInterval(timer);
                                }

                                if (isPercentage) {
                                    stat.textContent = currentNumber.toFixed(1) + '%';
                                } else if (cleanNumber >= 1000) {
                                    stat.textContent = Math.floor(currentNumber / 1000) + 'K+';
                                } else {
                                    stat.textContent = Math.floor(currentNumber) + '+';
                                }
                            }, 50);
                        }
                    });
                }
            });
        }, observerOptions);

        observer.observe(document.querySelector('.stats'));
    </script>
</body>

</html>