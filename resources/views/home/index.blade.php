<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets - Your Gateway to Amazing Events</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 15px 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            margin-right: 10px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .btn-login {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-signup {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Hero Section */
        .hero {
            padding: 150px 0 100px;
            text-align: center;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><radialGradient id="grad1"><stop offset="0%" stop-color="rgba(255,255,255,0.1)"/><stop offset="100%" stop-color="rgba(255,255,255,0)"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23grad1)"/><circle cx="800" cy="400" r="150" fill="url(%23grad1)"/><circle cx="1000" cy="100" r="80" fill="url(%23grad1)"/></svg>') no-repeat center;
            background-size: cover;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 30px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient 3s ease-in-out infinite alternate;
        }

        @keyframes gradient {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(90deg); }
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
            font-size: 1.1rem;
            padding: 15px 35px;
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
            font-size: 1.1rem;
            padding: 15px 35px;
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .features h2 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        /* Stats Section */
        .stats {
            padding: 80px 0;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: #4ecdc4;
            margin-bottom: 10px;
        }

        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.3);
            padding: 50px 0 30px;
            text-align: center;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            color: #4ecdc4;
        }

        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #4ecdc4;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .features h2 {
                font-size: 2rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .feature-card:nth-child(1) { animation-delay: 0.1s; }
        .feature-card:nth-child(2) { animation-delay: 0.2s; }
        .feature-card:nth-child(3) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">
                <div class="logo-icon">🎟️</div>
                Tickets
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="#login" class="btn btn-login">Login</a>
                <a href="#signup" class="btn btn-signup">Sign Up</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero" id="home">
            <div class="container">
                <h1>Your Gateway to Amazing Events</h1>
                <p>Discover, book, and manage tickets for concerts, sports, theater, and more. Join thousands of users who trust Tickets for their event experiences.</p>
                <div class="cta-buttons">
                    <a href="#get-started" class="btn btn-primary">Get Started</a>
                    <a href="#learn-more" class="btn btn-secondary">Learn More</a>
                </div>
            </div>
        </section>

        <section class="features" id="features">
            <div class="container">
                <h2>Why Choose Tickets?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">🎭</div>
                        <h3>Diverse Events</h3>
                        <p>Concerts, sports games, theater shows, conferences, and much more to explore</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <h3>Secure Booking</h3>
                        <p>Safe and encrypted payment system with money-back guarantee for cancelled events</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📱</div>
                        <h3>Easy to Use</h3>
                        <p>Simple and user-friendly interface across all devices with digital tickets</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="stats">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">50K+</div>
                        <p>Active Users</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">1M+</div>
                        <p>Tickets Sold</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <p>Events Monthly</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">99%</div>
                        <p>Customer Satisfaction</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <a href="#home">Home</a>
                    <a href="#events">Events</a>
                    <a href="#help">Help</a>
                    <a href="#privacy">Privacy Policy</a>
                </div>
                <div class="footer-section">
                    <h3>Our Services</h3>
                    <a href="#book">Book Tickets</a>
                    <a href="#organize">Organize Events</a>
                    <a href="#corporate">Corporate Solutions</a>
                    <a href="#api">Developer API</a>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p>Email: info@tickets.com</p>
                    <p>Phone: +1-555-123-4567</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon">📘</a>
                        <a href="#" class="social-icon">📷</a>
                        <a href="#" class="social-icon">🐦</a>
                    </div>
                </div>
            </div>
            <p>&copy; 2025 Tickets. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>