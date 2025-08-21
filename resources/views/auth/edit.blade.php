<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .header {
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="40%" r="50%"><stop offset="0%" stop-color="white" stop-opacity="1"/><stop offset="100%" stop-color="white" stop-opacity="0"/></radialGradient></defs><circle cx="10" cy="10" r="8" fill="white" opacity="0.1"><animate attributeName="cx" dur="20s" values="10;90;10" repeatCount="indefinite"/></circle><circle cx="80" cy="5" r="5" fill="white" opacity="0.1"><animate attributeName="cx" dur="15s" values="80;20;80" repeatCount="indefinite"/></circle></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .profile-section {
            position: relative;
            padding: 0 40px;
            transform: translateY(-60px);
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: 6px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            font-weight: bold;
            margin: 0 auto;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .status-indicator {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 20px;
            height: 20px;
            background: #4ade80;
            border-radius: 50%;
            border: 3px solid white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(74, 222, 128, 0); }
            100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
        }

        .profile-info {
            text-align: center;
            margin-top: 20px;
            padding-bottom: 30px;
        }

        .name {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .title {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 16px;
        }

        .bio {
            font-size: 16px;
            color: #4b5563;
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 30px 0;
            padding: 0 20px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .stat-item:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            display: block;
        }

        .stat-label {
            font-size: 14px;
            color: #6b7280;
            margin-top: 4px;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
            margin: 0 40px;
        }

        .tab {
            flex: 1;
            padding: 16px 24px;
            text-align: center;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab:hover:not(.active) {
            color: #4b5563;
            background: rgba(102, 126, 234, 0.05);
        }

        .tab-content {
            padding: 40px;
            min-height: 300px;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }

        .skill-tag {
            padding: 8px 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .skill-tag:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateX(5px);
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .profile-section {
                padding: 0 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .tabs {
                margin: 0 20px;
            }

            .tab-content {
                padding: 20px;
            }

            .contact-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"></div>
        
        <div class="profile-section">
            <div class="avatar">
                AM
                <div class="status-indicator"></div>
            </div>
            
            <div class="profile-info">
                <h1 class="name">aswanMoustapha</h1>
                <p class="title">Senior Software Engineer & Product Designer</p>
                <p class="bio">Passionate about creating beautiful, functional digital experiences. Love working with cutting-edge technologies and solving complex problems through elegant design solutions.</p>
            </div>
        </div>

        <div class="stats">
            <div class="stat-item">
                <span class="stat-number">127</span>
                <span class="stat-label">Projects</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">45K</span>
                <span class="stat-label">Followers</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">1.2K</span>
                <span class="stat-label">Following</span>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active" onclick="showTab('about')">About</div>
            <div class="tab" onclick="showTab('skills')">Skills</div>
            <div class="tab" onclick="showTab('contact')">Contact</div>
        </div>

        <div class="tab-content">
            <div id="about-content">
                <h3 style="color: #1f2937; margin-bottom: 16px; font-size: 24px;">About Me</h3>
                <p style="color: #4b5563; line-height: 1.7; margin-bottom: 20px;">
                    I'm a creative professional with over 8 years of experience in software development and product design. 
                    I specialize in building user-centered applications that combine technical excellence with intuitive design.
                </p>
                <p style="color: #4b5563; line-height: 1.7; margin-bottom: 20px;">
                    When I'm not coding or designing, you can find me exploring new coffee shops, hiking mountain trails, 
                    or experimenting with the latest web technologies. I believe in continuous learning and staying curious 
                    about emerging trends in technology and design.
                </p>
                <p style="color: #4b5563; line-height: 1.7;">
                    I'm always open to exciting new opportunities and collaborations. Feel free to reach out if you'd like to connect!
                </p>
            </div>

            <div id="skills-content" class="hidden">
                <h3 style="color: #1f2937; margin-bottom: 16px; font-size: 24px;">Skills & Expertise</h3>
                <div class="skills">
                    <span class="skill-tag">JavaScript</span>
                    <span class="skill-tag">React</span>
                    <span class="skill-tag">Node.js</span>
                    <span class="skill-tag">Python</span>
                    <span class="skill-tag">UI/UX Design</span>
                    <span class="skill-tag">Figma</span>
                    <span class="skill-tag">TypeScript</span>
                    <span class="skill-tag">AWS</span>
                    <span class="skill-tag">MongoDB</span>
                    <span class="skill-tag">GraphQL</span>
                    <span class="skill-tag">Docker</span>
                    <span class="skill-tag">Product Strategy</span>
                </div>
            </div>

            <div id="contact-content" class="hidden">
                <h3 style="color: #1f2937; margin-bottom: 16px; font-size: 24px;">Get In Touch</h3>
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div>
                            <div style="font-weight: 600; color: #1f2937;">Email</div>
                            <div style="color: #6b7280;">john.doe@email.com</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">💼</div>
                        <div>
                            <div style="font-weight: 600; color: #1f2937;">LinkedIn</div>
                            <div style="color: #6b7280;">linkedin.com/in/johndoe</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🐙</div>
                        <div>
                            <div style="font-weight: 600; color: #1f2937;">GitHub</div>
                            <div style="color: #6b7280;">github.com/johndoe</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🐦</div>
                        <div>
                            <div style="font-weight: 600; color: #1f2937;">Twitter</div>
                            <div style="color: #6b7280;">@johndoe</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all content
            document.getElementById('about-content').classList.add('hidden');
            document.getElementById('skills-content').classList.add('hidden');
            document.getElementById('contact-content').classList.add('hidden');
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected content
            document.getElementById(tabName + '-content').classList.remove('hidden');
            
            // Add active class to clicked tab
            event.target.classList.add('active');
        }

        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            const statItems = document.querySelectorAll('.stat-item');
            statItems.forEach(item => {
                item.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(-3px)';
                    }, 150);
                });
            });

            // Animate skill tags on hover
            const skillTags = document.querySelectorAll('.skill-tag');
            skillTags.forEach(tag => {
                tag.addEventListener('mouseenter', function() {
                    this.style.animation = 'none';
                    setTimeout(() => {
                        this.style.animation = 'pulse 0.6s ease-in-out';
                    }, 10);
                });
            });
        });
    </script>
</body>
</html>