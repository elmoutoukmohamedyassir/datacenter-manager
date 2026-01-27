@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
    .admin-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white;
        padding: 2.5rem;
        border-radius: 16px;
        margin-bottom: 2.5rem;
        box-shadow: var(--shadow-xl);
    }

    .admin-title {
        font-size: 2.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .admin-subtitle {
        font-size: 1.125rem;
        opacity: 0.9;
    }

    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .kpi-card {
        background: linear-gradient(135deg, var(--card-bg) 0%, #f8fafc 100%);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .kpi-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 120px;
        height: 120px;
        opacity: 0.08;
        font-size: 5rem;
    }

    .kpi-card.users::after { content: '👥'; }
    .kpi-card.reservations::after { content: '📊'; }
    .kpi-card.resources::after { content: '💻'; }
    .kpi-card.incidents::after { content: '⚠️'; }

    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .kpi-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 2rem;
    }

    .kpi-card.users .kpi-icon-wrapper {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .kpi-card.reservations .kpi-icon-wrapper {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .kpi-card.resources .kpi-icon-wrapper {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .kpi-card.incidents .kpi-icon-wrapper {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .kpi-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
    }

    .kpi-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        line-height: 1;
    }

    .kpi-change {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.375rem 0.75rem;
        border-radius: 50px;
    }

    .kpi-change.positive {
        background: #dcfce7;
        color: #166534;
    }

    .kpi-change.negative {
        background: #fee2e2;
        color: #991b1b;
    }

    .kpi-detail {
        font-size: 0.8125rem;
        color: var(--text-secondary);
        margin-top: 0.5rem;
    }

    .analytics-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .chart-section {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .activity-feed {
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .activity-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid var(--border-color);
    }

    .activity-item {
        padding: 1.25rem 2rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: all 0.2s ease;
    }

    .activity-item:hover {
        background: #f8fafc;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .activity-icon.success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
    }

    .activity-icon.warning {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .activity-icon.danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }

    .activity-icon.info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .activity-time {
        font-size: 0.8125rem;
        color: var(--text-secondary);
    }

    .system-health {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
    }

    .health-indicator {
        text-align: center;
        padding: 1rem;
        border-radius: 12px;
        background: var(--card-bg);
        border: 1px solid var(--border-color);
    }

    .health-indicator.healthy {
        border-color: var(--success-color);
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    }

    .health-indicator.warning {
        border-color: var(--warning-color);
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    }

    .health-status {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .health-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Table Styles */
    .table-container {
        overflow-x: auto;
        margin-top: 1rem;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table thead {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 2px solid var(--border-color);
    }

    .table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table td {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-primary);
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Button Styles */
    .btn {
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9375rem;
        cursor: pointer;
        border: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, #4338ca 100%);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        margin-right: 0.5rem;
    }

    .btn-sm:last-child {
        margin-right: 0;
    }

    .health-indicator {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.25rem;
        text-align: center;
        border: 2px solid;
        transition: all 0.3s ease;
    }

    .health-indicator:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .health-indicator.excellent {
        border-color: #10b981;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
    }

    .health-indicator.good {
        border-color: #3b82f6;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(37, 99, 235, 0.05) 100%);
    }

    .health-indicator.warning {
        border-color: #f59e0b;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(217, 119, 6, 0.05) 100%);
    }

    .health-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .health-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-secondary);
    }

    .quick-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }

    .quick-stat {
        background: #f8fafc;
        padding: 1rem;
        border-radius: 10px;
        border-left: 4px solid;
    }

    .quick-stat.primary { border-left-color: var(--primary-color); }
    .quick-stat.success { border-left-color: var(--success-color); }
    .quick-stat.warning { border-left-color: var(--warning-color); }
    .quick-stat.danger { border-left-color: var(--danger-color); }

    .quick-stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .quick-stat-label {
        font-size: 0.8125rem;
        color: var(--text-secondary);
        font-weight: 600;
    }

    @media (max-width: 1024px) {
        .analytics-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .admin-title {
            font-size: 2rem;
        }

        .kpi-grid {
            grid-template-columns: 1fr;
        }

        .stats-row {
            grid-template-columns: 1fr;
        }

        .quick-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Admin Header -->
    <div class="admin-header">
        <h1 class="admin-title">
            👑 Administration Dashboard
        </h1>
        <p class="admin-subtitle">
            Complete system overview and analytics • Last updated: {{ now()->format('M d, Y h:i A') }}
        </p>
    </div>

    <!-- KPI Cards -->
    <div class="kpi-grid">
        <div class="kpi-card users">
            <div class="kpi-icon-wrapper">👥</div>
            <div class="kpi-label">Total Users</div>
            <div class="kpi-value">1,247</div>
            <span class="kpi-change positive">↑ 12.5%</span>
            <div class="kpi-detail">+138 this month</div>
        </div>

        <div class="kpi-card reservations">
            <div class="kpi-icon-wrapper">📊</div>
            <div class="kpi-label">Total Reservations</div>
            <div class="kpi-value">3,894</div>
            <span class="kpi-change positive">↑ 8.3%</span>
            <div class="kpi-detail">+298 this month</div>
        </div>

        <div class="kpi-card resources">
            <div class="kpi-icon-wrapper">💻</div>
            <div class="kpi-label">Total Resources</div>
            <div class="kpi-value">175</div>
            <span class="kpi-change positive">↑ 5</span>
            <div class="kpi-detail">5 added recently</div>
        </div>

        <div class="kpi-card incidents">
            <div class="kpi-icon-wrapper">⚠️</div>
            <div class="kpi-label">Open Incidents</div>
            <div class="kpi-value">12</div>
            <span class="kpi-change negative">↑ 3</span>
            <div class="kpi-detail">Needs attention</div>
        </div>
    </div>

    <!-- System Health -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="section-title">🏥 System Health</div>
        <div class="system-health">
            <div class="health-indicator excellent">
                <div class="health-value" style="color: #10b981;">98%</div>
                <div class="health-label">Uptime</div>
            </div>
            <div class="health-indicator excellent">
                <div class="health-value" style="color: #10b981;">95%</div>
                <div class="health-label">Availability</div>
            </div>
            <div class="health-indicator good">
                <div class="health-value" style="color: #3b82f6;">78%</div>
                <div class="health-label">Utilization</div>
            </div>
            <div class="health-indicator excellent">
                <div class="health-value" style="color: #10b981;">2.1s</div>
                <div class="health-label">Avg Response</div>
            </div>
            <div class="health-indicator warning">
                <div class="health-value" style="color: #f59e0b;">12</div>
                <div class="health-label">Incidents</div>
            </div>
        </div>
    </div>

    <!-- Analytics -->
    <div class="analytics-grid">
        <div class="chart-section">
            <div class="section-title">📈 Monthly Reservations Trend</div>
            <canvas id="monthlyTrend"></canvas>
        </div>

        <div class="chart-section">
            <div class="section-title">📊 Quick Stats</div>
            <div class="quick-stats">
                <div class="quick-stat primary">
                    <div class="quick-stat-value">342</div>
                    <div class="quick-stat-label">Active Now</div>
                </div>
                <div class="quick-stat success">
                    <div class="quick-stat-value">89%</div>
                    <div class="quick-stat-label">Approval Rate</div>
                </div>
                <div class="quick-stat warning">
                    <div class="quick-stat-value">45</div>
                    <div class="quick-stat-label">Pending</div>
                </div>
                <div class="quick-stat danger">
                    <div class="quick-stat-value">12</div>
                    <div class="quick-stat-label">Incidents</div>
                </div>
            </div>
        </div>
    </div>

    <!-- More Charts -->
    <div class="stats-row">
        <div class="chart-section">
            <div class="section-title">🏷️ Resource Distribution</div>
            <canvas id="resourceDistribution"></canvas>
        </div>

        <div class="chart-section">
            <div class="section-title">👥 User Activity</div>
            <canvas id="userActivity"></canvas>
        </div>
    </div>

    <div class="stats-row">
        <div class="chart-section">
            <div class="section-title">📅 Reservation Status</div>
            <canvas id="reservationStatus"></canvas>
        </div>

        <div class="chart-section">
            <div class="section-title">⚡ Peak Usage Times</div>
            <canvas id="peakUsage"></canvas>
        </div>
    </div>

    <!-- Resource Management -->
    <div class="card" style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div class="section-title" style="margin-bottom: 0;">💻 Resource Management</div>
            <a href="{{ url('/resources/create') }}" class="btn btn-primary" style="text-decoration: none;">
                ➕ Add New Resource
            </a>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Resource</th>
                        <th>Category</th>
                        <th>Specifications</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="resourcesTable">
                    <tr>
                        <td>
                            <a href="{{ url('/resources/1') }}" style="text-decoration: none; color: inherit;">
                                <strong style="font-size: 1rem; color: var(--primary-color); cursor: pointer;">🖥️ Server-01</strong>
                                <div style="font-size: 0.8125rem; color: var(--text-secondary);">Production Server</div>
                            </a>
                        </td>
                        <td>Servers</td>
                        <td>
                            <div style="font-size: 0.875rem;">16 CPU • 64 GB RAM • 2 TB SSD</div>
                        </td>
                        <td>Rack A - Slot 12</td>
                        <td><span class="badge badge-active">Available</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="editResource(1)">✏️ Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteResource(1)">🗑️ Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong style="font-size: 1rem;">💻 Workstation-05</strong>
                            <div style="font-size: 0.8125rem; color: var(--text-secondary);">Development Machine</div>
                        </td>
                        <td>Workstations</td>
                        <td>
                            <div style="font-size: 0.875rem;">8 CPU • 32 GB RAM • 1 TB NVMe</div>
                        </td>
                        <td>Room 1 - Desk 5</td>
                        <td><span class="badge badge-active">Available</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="editResource(2)">✏️ Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteResource(2)">🗑️ Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong style="font-size: 1rem;">💽 Storage-Array-02</strong>
                            <div style="font-size: 0.8125rem; color: var(--text-secondary);">Backup Storage</div>
                        </td>
                        <td>Storage</td>
                        <td>
                            <div style="font-size: 0.875rem;">100 TB • RAID 10 • Encrypted</div>
                        </td>
                        <td>Rack B - Slot 8</td>
                        <td><span class="badge badge-pending">Reserved</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="editResource(3)">✏️ Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteResource(3)">🗑️ Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong style="font-size: 1rem;">🌐 Network-Switch-03</strong>
                            <div style="font-size: 0.8125rem; color: var(--text-secondary);">Core Network</div>
                        </td>
                        <td>Network</td>
                        <td>
                            <div style="font-size: 0.875rem;">48 Ports • 10 Gbps • Layer 3</div>
                        </td>
                        <td>Rack C - Slot 2</td>
                        <td><span class="badge badge-active">Available</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="editResource(4)">✏️ Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteResource(4)">🗑️ Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong style="font-size: 1rem;">🗄️ Database-Server-01</strong>
                            <div style="font-size: 0.8125rem; color: var(--text-secondary);">MySQL Cluster</div>
                        </td>
                        <td>Servers</td>
                        <td>
                            <div style="font-size: 0.875rem;">24 CPU • 128 GB RAM • 4 TB SSD</div>
                        </td>
                        <td>Rack A - Slot 5</td>
                        <td><span class="badge badge-active">Available</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="editResource(5)">✏️ Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteResource(5)">🗑️ Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong style="font-size: 1rem;">🔧 Server-08</strong>
                            <div style="font-size: 0.8125rem; color: var(--text-secondary);">Application Server</div>
                        </td>
                        <td>Servers</td>
                        <td>
                            <div style="font-size: 0.875rem;">12 CPU • 48 GB RAM • 1.5 TB SSD</div>
                        </td>
                        <td>Rack B - Slot 15</td>
                        <td><span class="badge badge-in_progress">Maintenance</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="editResource(6)">✏️ Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteResource(6)">🗑️ Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="activity-feed">
        <div class="activity-header">
            <div class="section-title" style="margin-bottom: 0;">
                🔔 Recent Activity
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon success">✓</div>
            <div class="activity-content">
                <div class="activity-title">New reservation approved</div>
                <div class="activity-time">John Smith reserved Server-05 • 5 minutes ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon info">👤</div>
            <div class="activity-content">
                <div class="activity-title">New user registered</div>
                <div class="activity-time">Sarah Johnson joined the system • 12 minutes ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon warning">⚠️</div>
            <div class="activity-content">
                <div class="activity-title">Incident reported</div>
                <div class="activity-time">Network connectivity issue on Switch-03 • 28 minutes ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon success">✓</div>
            <div class="activity-content">
                <div class="activity-title">Reservation completed</div>
                <div class="activity-time">Mike Chen returned Workstation-12 • 1 hour ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon danger">✕</div>
            <div class="activity-content">
                <div class="activity-title">Reservation rejected</div>
                <div class="activity-time">Request for Storage-Array-05 declined • 2 hours ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon success">🔧</div>
            <div class="activity-content">
                <div class="activity-title">Maintenance completed</div>
                <div class="activity-time">Server-08 is back online • 3 hours ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon info">📊</div>
            <div class="activity-content">
                <div class="activity-title">New resource added</div>
                <div class="activity-time">Database-Server-12 added to inventory • 5 hours ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon warning">⏰</div>
            <div class="activity-content">
                <div class="activity-title">Reservation ending soon</div>
                <div class="activity-time">Emily Davis's reservation ends in 2 hours • 6 hours ago</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    // Resource Management Functions
    function editResource(id) {
        // Navigate to edit form
        window.location.href = "{{ url('/resources') }}/" + id + "/edit";
    }

    function deleteResource(id) {
        if (confirm('⚠️ Are you sure you want to delete this resource?\n\nThis action cannot be undone.')) {
            alert(`✅ Resource #${id} deleted successfully!\n\nNote: This is a demo. Backend integration required.`);

            // In real implementation, this would make an AJAX call to backend
            // For demo, we just show success message
        }
    }

    Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';

    // Monthly Trend Chart
    new Chart(document.getElementById('monthlyTrend'), {
        type: 'line',
        data: {
            labels: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'],
            datasets: [{
                label: 'Reservations',
                data: [245, 289, 312, 356, 398, 421, 467],
                borderColor: 'rgb(79, 70, 229)',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3,
                pointRadius: 5,
                pointBackgroundColor: 'rgb(79, 70, 229)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Resource Distribution
    new Chart(document.getElementById('resourceDistribution'), {
        type: 'doughnut',
        data: {
            labels: ['Servers', 'Workstations', 'Storage', 'Network', 'Other'],
            datasets: [{
                data: [45, 32, 28, 24, 21],
                backgroundColor: [
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(100, 116, 139, 0.8)'
                ],
                borderColor: '#fff',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 13, weight: '600' },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            }
        }
    });

    // User Activity
    new Chart(document.getElementById('userActivity'), {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Active Users',
                data: [432, 498, 467, 512, 489, 234, 187],
                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                borderColor: 'rgb(16, 185, 129)',
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Reservation Status
    new Chart(document.getElementById('reservationStatus'), {
        type: 'pie',
        data: {
            labels: ['Active', 'Pending', 'Approved', 'Finished', 'Refused'],
            datasets: [{
                data: [342, 45, 128, 892, 34],
                backgroundColor: [
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(100, 116, 139, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: '#fff',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 13, weight: '600' },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            }
        }
    });

    // Peak Usage Times
    new Chart(document.getElementById('peakUsage'), {
        type: 'line',
        data: {
            labels: ['12am', '3am', '6am', '9am', '12pm', '3pm', '6pm', '9pm'],
            datasets: [{
                label: 'Usage',
                data: [12, 8, 15, 45, 78, 89, 76, 45],
                borderColor: 'rgb(245, 158, 11)',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: 'rgb(245, 158, 11)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endsection
