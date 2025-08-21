<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Tickets</title>
    <script src="{{ asset('assets/js/tailwindcss.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js')}}"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const size = 32; // حجم favicon
            const radius = 8; // نفس الـ border-radius
            const whiteSize = 12; // حجم المربع الأبيض الصغير

            // إنشاء canvas
            const canvas = document.createElement('canvas');
            canvas.width = size;
            canvas.height = size;
            const ctx = canvas.getContext('2d');

            // رسم الخلفية الزرقاء مع زوايا دائرية
            ctx.fillStyle = '#3b82f6';
            ctx.beginPath();
            ctx.moveTo(radius, 0);
            ctx.lineTo(size - radius, 0);
            ctx.quadraticCurveTo(size, 0, size, radius);
            ctx.lineTo(size, size - radius);
            ctx.quadraticCurveTo(size, size, size - radius, size);
            ctx.lineTo(radius, size);
            ctx.quadraticCurveTo(0, size, 0, size - radius);
            ctx.lineTo(0, radius);
            ctx.quadraticCurveTo(0, 0, radius, 0);
            ctx.closePath();
            ctx.fill();

            // رسم المربع الأبيض الصغير في المنتصف
            ctx.fillStyle = 'white';
            ctx.fillRect((size - whiteSize) / 2, (size - whiteSize) / 2, whiteSize, whiteSize);

            // إنشاء رابط الصورة للفافيكون
            const faviconURL = canvas.toDataURL('image/png');

            // إضافة link للفافيكون في head
            const link = document.createElement('link');
            link.rel = 'icon';
            link.type = 'image/png';
            link.href = faviconURL;
            document.head.appendChild(link);
        });
    </script>


    @include('layouts.partials.styles')
    @stack('styles')
</head>

<body>

    @include('layouts.partials.mobile_menu')

    @include('layouts.partials.sidebar')


    @include('layouts.partials.header')

    <!-- Main Content -->
    <main class="main-container">
        @yield('content')
    </main>

    <script>
        // Add scroll effect to header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.backdropFilter = 'blur(10px)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 1)';
                header.style.backdropFilter = 'none';
            }
        });

        // Animate dashboard cards on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.6s ease';

                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 150);
            });

            // Set active nav item
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });

        // Add click functionality to quick actions
        document.querySelectorAll('.quick-action').forEach(action => {
            action.addEventListener('click', function() {
                const title = this.querySelector('.quick-action-title').textContent;
                console.log(`Clicked: ${title}`);
                // Add your click handling logic here
            });
        });

        // Add hover effects to event cards
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');

        mobileMenuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 1024) {
                if (!event.target.closest('#sidebar') && !event.target.closest('#mobileMenuBtn')) {
                    document.getElementById('sidebar').classList.remove('active');
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
