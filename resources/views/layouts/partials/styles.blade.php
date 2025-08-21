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
    }

    /* Sidebar */
    .sidebar {
        width: 280px;
        background: white;
        border-right: 1px solid #e5e7eb;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        padding: 20px;
        z-index: 90;
        transition: all 0.3s ease;
        overflow-y: auto;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .sidebar-logo {
        width: 40px;
        height: 40px;
        background: #3b82f6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .sidebar-logo::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 16px;
        height: 16px;
        background: white;
        border-radius: 3px;
        transform: translate(-50%, -50%);
    }

    .sidebar-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
    }

    .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        border-radius: 10px;
        text-decoration: none;
        color: #6b7280;
        transition: all 0.2s ease;
    }

    .nav-item:hover {
        background: #f8fafc;
        color: #3b82f6;
    }

    .nav-item.active {
        background: #3b82f6;
        color: white;
        border-left: 3px solid #3b82f6;
    }

    .nav-icon {
        font-size: 1.1rem;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-text {
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Dropdown */
    .dropdown-toggle {
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        border-radius: 10px;
        color: #6b7280;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
    }

    .dropdown-toggle:hover {
        background: #f8fafc;
        color: #3b82f6;
    }

    .dropdown-toggle.active {
        background: #3b82f6;
        color: white;
        border-left: 3px solid #3b82f6;
    }

    .dropdown-arrow {
        margin-left: auto;
        font-size: 10px;
        transition: transform 0.2s ease;
        margin-right: 10px;
    }

    .dropdown-toggle.active .dropdown-arrow {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        display: none;
        flex-direction: column;
        background: white;
        margin: 5px 0 0 0;
        padding: 10px 0;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu.show {
        display: flex;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
            max-height: 0;
        }

        to {
            opacity: 1;
            transform: translateY(0);
            max-height: 200px;
        }
    }

    .dropdown-item {
        color: #6b7280;
        padding: 8px 35px 8px 20px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
        display: block;
        border-radius: 8px;
        margin: 2px 10px;
        cursor: pointer;
        position: relative;
    }

    .dropdown-item:hover {
        background: #f8fafc;
        color: #3b82f6;
        transform: translateX(3px);
    }

    .dropdown-item:active {
        background: rgba(59, 130, 246, 0.1);
        transform: translateX(1px);
    }

    .sidebar-footer {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .logout-btn {
        background: none;
        border: none;
        color: #6b7280;
        width: 100%;
        text-align: left;
        padding: 12px 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.2s ease;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .logout-btn:hover {
        background: #f8fafc;
        color: #dc2626;
    }

    .sidebar-collapse-btn {
        position: absolute;
        top: 20px;
        right: -12px;
        width: 24px;
        height: 24px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .sidebar-collapse-btn:hover {
        background: #f8fafc;
        border-color: #3b82f6;
    }

    /* Header */
    .header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 16px 0;
        position: sticky;
        top: 0;
        z-index: 100;
        margin-left: 280px;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        text-decoration: none;
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
        overflow: hidden;
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

    .user-profile {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: #3b82f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.1rem;
        color: white;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .user-avatar:hover {
        transform: scale(1.05);
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: #1e293b;
    }

    .user-role {
        font-size: 0.8rem;
        color: #6b7280;
    }

    /* Main Layout */
    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
        margin-left: 280px;
        transition: all 0.3s ease;
    }

    /* Dashboard Cards */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .dashboard-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        position: relative;
        overflow: hidden;
    }

    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #06b6d4);
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: #3b82f6;
    }

    .dashboard-card:hover::before {
        opacity: 1;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .card-title {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .card-icon {
        width: 40px;
        height: 40px;
        background: #3b82f6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        transition: all 0.2s ease;
    }

    .dashboard-card:hover .card-icon {
        transform: scale(1.1);
    }

    .card-value {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        line-height: 1;
    }

    .card-subtitle {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 12px;
    }

    .card-trend {
        font-size: 0.75rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .trend-up {
        color: #059669;
    }

    .trend-down {
        color: #dc2626;
    }

    /* Content Sections */
    .content-section {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
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

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
        transform: translateY(-1px);
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

    /* Event Cards */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 16px;
    }

    .event-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .event-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: #3b82f6;
    }

    .event-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .event-title {
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .event-date {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .event-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-active {
        background: rgba(5, 150, 105, 0.1);
        color: #059669;
        border: 1px solid rgba(5, 150, 105, 0.2);
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-completed {
        background: rgba(107, 114, 128, 0.1);
        color: #6b7280;
        border: 1px solid rgba(107, 114, 128, 0.2);
    }

    .event-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
    }

    .event-attendees {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .event-price {
        font-weight: 600;
        color: #059669;
    }

    /* Recent Activity */
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: #f8fafc;
        border-radius: 8px;
        transition: all 0.2s ease;
        border: 1px solid #e5e7eb;
    }

    .activity-item:hover {
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border-color: #3b82f6;
    }

    .activity-icon {
        width: 32px;
        height: 32px;
        background: #3b82f6;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: white;
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 500;
        color: #1e293b;
        margin-bottom: 2px;
        font-size: 0.875rem;
    }

    .activity-time {
        color: #6b7280;
        font-size: 0.75rem;
    }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .quick-action {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.2s ease;
        cursor: pointer;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .quick-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: #3b82f6;
    }

    .quick-action-icon {
        width: 40px;
        height: 40px;
        background: #3b82f6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        margin: 0 auto 8px;
        transition: all 0.2s ease;
    }

    .quick-action:hover .quick-action-icon {
        transform: scale(1.1);
    }

    .quick-action-title {
        font-weight: 500;
        color: #1e293b;
        font-size: 0.875rem;
    }

    /* Mobile Responsive */
    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(-280px);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .header,
        .main-container {
            margin-left: 0;
        }

        .mobile-menu-btn {
            display: block;
        }
    }

    @media (max-width: 768px) {
        .nav-container {
            flex-direction: column;
            gap: 20px;
        }

        .user-profile {
            order: -1;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .events-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: repeat(2, 1fr);
        }

        .section-header {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .main-container {
            padding: 20px 15px;
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

    .dashboard-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .dashboard-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .dashboard-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .dashboard-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .dashboard-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    /* Mobile menu button */
    .mobile-menu-btn {
        display: none;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 110;
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #6b7280;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        transition: all 0.2s ease;
    }

    .mobile-menu-btn:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }

    @media (max-width: 1024px) {
        .mobile-menu-btn {
            display: flex;
        }
    }
</style>
