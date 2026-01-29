<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>
<style>
    .notifications-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .notification-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .notification-tabs {
        display: flex;
        gap: 0.5rem;
        background: white;
        padding: 0.5rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        margin-bottom: 2rem;
        overflow-x: auto;
    }

    .notification-tab {
        padding: 0.75rem 1.5rem;
        border: none;
        background: transparent;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9375rem;
        transition: all 0.3s ease;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .notification-tab:hover {
        background: rgba(79, 70, 229, 0.1);
    }

    .notification-tab.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
    }

    .tab-badge {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        padding: 0.25rem 0.625rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .notification-tab:not(.active) .tab-badge {
        background: var(--danger-color);
        color: white;
    }

    .notifications-container {
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .notification-item {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
        transition: all 0.2s ease;
        position: relative;
    }

    .notification-item.unread {
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.03) 0%, rgba(67, 56, 202, 0.03) 100%);
    }

    .notification-item.unread::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    }

    .notification-item:hover {
        background: #f8fafc;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .notification-icon.success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
    }

    .notification-icon.info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }

    .notification-icon.warning {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .notification-icon.danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-weight: 700;
        font-size: 1.0625rem;
        color: var(--text-primary);
        margin-bottom: 0.375rem;
    }

    .notification-message {
        color: var(--text-secondary);
        font-size: 0.9375rem;
        margin-bottom: 0.625rem;
        line-height: 1.5;
    }

    .notification-meta {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        font-size: 0.8125rem;
        color: var(--text-secondary);
    }

    .notification-time {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .notification-type {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        background: #f1f5f9;
        border-radius: 50px;
        font-weight: 600;
    }

    .notification-actions-dropdown {
        position: relative;
    }

    .notification-menu-btn {
        background: none;
        border: none;
        color: var(--text-secondary);
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .notification-menu-btn:hover {
        background: rgba(79, 70, 229, 0.1);
        color: var(--primary-color);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .empty-message {
        font-size: 1rem;
    }

    .load-more {
        padding: 1.5rem;
        text-align: center;
        border-top: 1px solid var(--border-color);
    }

    @media (max-width: 768px) {
        .notification-item {
            padding: 1.25rem 1rem;
            flex-direction: column;
            gap: 1rem;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Header -->
    <div class="notifications-header">
        <h1 class="page-title">🔔 Notifications</h1>
        <div class="notification-actions">
            <button class="btn btn-secondary btn-sm">⚙️ Settings</button>
            <button class="btn btn-primary btn-sm" onclick="markAllRead()">✓ Mark All Read</button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="notification-tabs">
        <button class="notification-tab active" data-tab="all">
            All
            <span class="tab-badge">12</span>
        </button>
        <button class="notification-tab" data-tab="unread">
            Unread
            <span class="tab-badge">5</span>
        </button>
        <button class="notification-tab" data-tab="reservations">
            Reservations
        </button>
        <button class="notification-tab" data-tab="incidents">
            Incidents
        </button>
        <button class="notification-tab" data-tab="system">
            System
        </button>
    </div>

    <!-- Notifications List -->
    <div class="notifications-container">
        <!-- Unread Notification -->
        <div class="notification-item unread">
            <div class="notification-icon success">✓</div>
            <div class="notification-content">
                <div class="notification-title">Reservation Approved</div>
                <div class="notification-message">
                    Your reservation request for <strong>Server-05 (Production Server)</strong> has been approved by the manager. The reservation is scheduled from Jan 20, 2026 to Jan 25, 2026.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 2 hours ago</span>
                    <span class="notification-type">📊 Reservation</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Unread Notification -->
        <div class="notification-item unread">
            <div class="notification-icon warning">⏰</div>
            <div class="notification-content">
                <div class="notification-title">Reservation Ending Soon</div>
                <div class="notification-message">
                    Your reservation for <strong>Workstation-12</strong> will end in 2 days. Please return the resource on time or request an extension.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 5 hours ago</span>
                    <span class="notification-type">⏳ Reminder</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Unread Notification -->
        <div class="notification-item unread">
            <div class="notification-icon info">💬</div>
            <div class="notification-content">
                <div class="notification-title">New Comment on Incident</div>
                <div class="notification-message">
                    A manager has commented on your incident report <strong>#INC-2401</strong>: "We're investigating the network connectivity issue. Expected resolution in 24 hours."
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 1 day ago</span>
                    <span class="notification-type">⚠️ Incident</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="notification-item">
            <div class="notification-icon success">✓</div>
            <div class="notification-content">
                <div class="notification-title">Reservation Completed</div>
                <div class="notification-message">
                    Your reservation for <strong>Database-Server-01</strong> has been marked as completed. Thank you for returning the resource on time.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 2 days ago</span>
                    <span class="notification-type">📊 Reservation</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Unread Notification -->
        <div class="notification-item unread">
            <div class="notification-icon info">📢</div>
            <div class="notification-content">
                <div class="notification-title">System Maintenance Scheduled</div>
                <div class="notification-message">
                    Scheduled maintenance on Jan 18, 2026 from 2:00 AM to 6:00 AM. Some services may be temporarily unavailable during this period.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 3 days ago</span>
                    <span class="notification-type">⚙️ System</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="notification-item">
            <div class="notification-icon danger">✕</div>
            <div class="notification-content">
                <div class="notification-title">Reservation Request Declined</div>
                <div class="notification-message">
                    Your request for <strong>Storage-Array-03</strong> has been declined. Reason: Resource is scheduled for maintenance during the requested period.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 4 days ago</span>
                    <span class="notification-type">📊 Reservation</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="notification-item">
            <div class="notification-icon success">🎉</div>
            <div class="notification-content">
                <div class="notification-title">Welcome to the System!</div>
                <div class="notification-message">
                    Your account has been successfully created. You can now start making reservations and managing resources.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 1 week ago</span>
                    <span class="notification-type">⚙️ System</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="notification-item">
            <div class="notification-icon info">📋</div>
            <div class="notification-content">
                <div class="notification-title">New Resource Available</div>
                <div class="notification-message">
                    A new resource <strong>Server-15 (High Performance GPU Server)</strong> has been added to the inventory and is now available for reservations.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 1 week ago</span>
                    <span class="notification-type">💻 Resource</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="notification-item">
            <div class="notification-icon warning">⚠️</div>
            <div class="notification-content">
                <div class="notification-title">Incident Resolved</div>
                <div class="notification-message">
                    Your reported incident <strong>#INC-2398</strong> regarding Network-Switch-03 has been resolved. The issue was fixed and the resource is now fully operational.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 2 weeks ago</span>
                    <span class="notification-type">⚠️ Incident</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="notification-item">
            <div class="notification-icon success">✓</div>
            <div class="notification-content">
                <div class="notification-title">Reservation Auto-Approved</div>
                <div class="notification-message">
                    Your reservation for <strong>Workstation-08</strong> has been automatically approved as you are a trusted user with good history.
                </div>
                <div class="notification-meta">
                    <span class="notification-time">🕐 2 weeks ago</span>
                    <span class="notification-type">📊 Reservation</span>
                </div>
            </div>
            <div class="notification-actions-dropdown">
                <button class="notification-menu-btn" title="Actions">⋮</button>
            </div>
        </div>

        <!-- Load More -->
        <div class="load-more">
            <button class="btn btn-secondary">Load More Notifications</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tab switching
    document.querySelectorAll('.notification-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.notification-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const tabType = this.dataset.tab;
            console.log('Switching to tab:', tabType);
            // In real implementation, filter notifications based on tab
        });
    });

    // Mark all as read
    function markAllRead() {
        if (confirm('Mark all notifications as read?')) {
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
            });

            // Update badge counts
            document.querySelector('[data-tab="all"] .tab-badge').textContent = '12';
            document.querySelector('[data-tab="unread"] .tab-badge').textContent = '0';

            alert('All notifications marked as read! (Demo)');
        }
    }

    // Individual notification actions
    document.querySelectorAll('.notification-menu-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            alert('Notification actions menu (Demo)\n• Mark as read/unread\n• Delete\n• View details');
        });
    });

    // Click notification to mark as read
    document.querySelectorAll('.notification-item').forEach(item => {
        item.addEventListener('click', function() {
            if (this.classList.contains('unread')) {
                this.classList.remove('unread');
                // Update unread count
                const unreadBadge = document.querySelector('[data-tab="unread"] .tab-badge');
                const currentCount = parseInt(unreadBadge.textContent);
                unreadBadge.textContent = Math.max(0, currentCount - 1);
            }
        });
    });
</script>
</x-app-layout>
