<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Tickets</title>
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
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
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

        .nav-links a:hover,
        .nav-links a.active {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* Story Section */
        .story-section {
            padding: 80px 0;
        }

        .story-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .story-text h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #4ecdc4;
        }

        .story-text p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .story-image {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .story-image-placeholder {
            width: 100%;
            height: 300px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        /* Mission Section */
        .mission-section {
            padding: 80px 0;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 30px;
            margin: 60px 0;
        }

        .mission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .mission-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .mission-card:hover {
            transform: translateY(-10px);
        }

        .mission-icon {
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

        .mission-card h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #4ecdc4;
        }

        .mission-card p {
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Team Section */
        .team-section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 60px;
            color: #4ecdc4;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .team-member {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .team-member:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .member-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .member-name {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #4ecdc4;
        }

        .member-role {
            font-size: 1rem;
            opacity: 0.8;
            margin-bottom: 15px;
        }

        .member-bio {
            font-size: 0.9rem;
            opacity: 0.7;
            line-height: 1.5;
        }

        /* Values Section */
        .values-section {
            padding: 80px 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }

        .value-item {
            text-align: center;
            padding: 30px;
        }

        .value-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .value-item h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #4ecdc4;
        }

        .value-item p {
            opacity: 0.8;
            line-height: 1.5;
        }

        /* Timeline Section */
        .timeline-section {
            padding: 80px 0;
        }

        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            width: 4px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            top: 0;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            animation: fadeInUp 0.8s ease forwards;
        }

        .timeline-item:nth-child(odd) {
            left: 0;
        }

        .timeline-item:nth-child(even) {
            left: 50%;
        }

        .timeline-content {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            position: relative;
        }

        .timeline-year {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4ecdc4;
            margin-bottom: 10px;
        }

        .timeline-event {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .timeline-description {
            opacity: 0.8;
            line-height: 1.5;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            padding: 80px 0;
            background: radial-gradient(circle, rgba(76, 201, 196, 0.2) 0%, transparent 70%);
        }

        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .btn {
            padding: 15px 35px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-weight: bold;
            font-size: 1.1rem;
            margin: 0 10px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            color: white;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .story-content {
                grid-template-columns: 1fr;
            }
            
            .timeline-item {
                width: 100%;
                left: 0 !important;
            }
            
            .timeline::before {
                left: 20px;
            }
        }

        /* Animations */
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

        .timeline-item:nth-child(1) { animation-delay: 0.1s; }
        .timeline-item:nth-child(2) { animation-delay: 0.2s; }
        .timeline-item:nth-child(3) { animation-delay: 0.3s; }
        .timeline-item:nth-child(4) { animation-delay: 0.4s; }
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
                <li><a href="#about" class="active">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>About Tickets</h1>
                <p>We're on a mission to connect people with unforgettable experiences through seamless event discovery and booking</p>
            </div>
        </section>

        <section class="story-section">
            <div class="container">
                <div class="story-content">
                    <div class="story-text">
                        <h2>Our Story</h2>
                        <p>Founded in 2020, Tickets was born from a simple idea: make event discovery and booking as easy as ordering your morning coffee. We noticed that finding and booking tickets for events was often a frustrating experience filled with hidden fees, unreliable websites, and poor customer service.</p>
                        <p>Our founders, passionate event-goers themselves, decided to create a platform that puts the user experience first. Today, we've grown to serve over 50,000 active users and have facilitated more than 1 million ticket sales across hundreds of events.</p>
                        <p>We believe that great experiences shouldn't be hard to find or expensive to access. That's why we've built a platform that's transparent, reliable, and designed with both event-goers and organizers in mind.</p>
                    </div>
                    <div class="story-image">
                        <div class="story-image-placeholder">🎭</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mission-section">
            <div class="container">
                <div class="mission-grid">
                    <div class="mission-card">
                        <div class="mission-icon">🎯</div>
                        <h3>Our Mission</h3>
                        <p>To democratize access to amazing events by creating the world's most user-friendly ticketing platform that benefits both event-goers and organizers.</p>
                    </div>
                    <div class="mission-card">
                        <div class="mission-icon">👁️</div>
                        <h3>Our Vision</h3>
                        <p>A world where discovering and attending events is effortless, affordable, and accessible to everyone, everywhere.</p>
                    </div>
                    <div class="mission-card">
                        <div class="mission-icon">💎</div>
                        <h3>Our Values</h3>
                        <p>Transparency, reliability, innovation, and putting our users first in everything we do.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="values-section">
            <div class="container">
                <h2 class="section-title">What Drives Us</h2>
                <div class="values-grid">
                    <div class="value-item">
                        <div class="value-icon">🤝</div>
                        <h4>Trust</h4>
                        <p>Building lasting relationships through transparency and reliability</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">⚡</div>
                        <h4>Innovation</h4>
                        <p>Continuously improving and pioneering new solutions</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">🌟</div>
                        <h4>Excellence</h4>
                        <p>Delivering exceptional experiences in every interaction</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">🌍</div>
                        <h4>Accessibility</h4>
                        <p>Making events accessible to everyone, everywhere</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="team-section">
            <div class="container">
                <h2 class="section-title">Meet Our Team</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-avatar">👨‍💼</div>
                        <div class="member-name">Alex Johnson</div>
                        <div class="member-role">CEO & Co-founder</div>
                        <div class="member-bio">Former tech executive with 15 years of experience in building scalable platforms.</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">👩‍💻</div>
                        <div class="member-name">Sarah Chen</div>
                        <div class="member-role">CTO & Co-founder</div>
                        <div class="member-bio">Full-stack engineer passionate about creating seamless user experiences.</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">👨‍🎨</div>
                        <div class="member-name">Mike Rodriguez</div>
                        <div class="member-role">Head of Design</div>
                        <div class="member-bio">Award-winning designer focused on intuitive and beautiful interfaces.</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">👩‍📊</div>
                        <div class="member-name">Emma Thompson</div>
                        <div class="member-role">Head of Marketing</div>
                        <div class="member-bio">Marketing strategist with expertise in growth and community building.</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="timeline-section">
            <div class="container">
                <h2 class="section-title">Our Journey</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">2020</div>
                            <div class="timeline-event">Company Founded</div>
                            <div class="timeline-description">Tickets was founded with a vision to revolutionize event ticketing</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">2021</div>
                            <div class="timeline-event">First Million</div>
                            <div class="timeline-description">Reached our first million tickets sold milestone</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">2023</div>
                            <div class="timeline-event">Mobile App Launch</div>
                            <div class="timeline-description">Launched our native mobile applications for iOS and Android</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-year">2024</div>
                            <div class="timeline-event">Global Expansion</div>
                            <div class="timeline-description">Expanded to serve events in over 50 countries worldwide</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <h2>Join Our Journey</h2>
                <p>Be part of the future of event ticketing</p>
                <a href="#contact" class="btn btn-primary">Get In Touch</a>
            </div>
        </section>
    </main>
</body>
</html>