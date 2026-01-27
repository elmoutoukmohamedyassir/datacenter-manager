@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('styles')
<style>
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .filter-group {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.75rem 1.25rem;
        border: 2px solid var(--border-color);
        background: white;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.9375rem;
    }

    .filter-btn:hover {
        border-color: var(--primary-color);
        background: rgba(79, 70, 229, 0.05);
    }

    .filter-btn.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        border-color: var(--primary-color);
    }

    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .metric-card {
        background: linear-gradient(135deg, var(--card-bg) 0%, #f8fafc 100%);
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: var(--shadow-md);
        border-left: 4px solid;
        transition: all 0.3s ease;
        position: relative;
    }

    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .metric-card.primary {
        border-left-color: var(--primary-color);
    }

    .metric-card.success {
        border-left-color: var(--success-color);
    }

    .metric-card.warning {
        border-left-color: var(--warning-color);
    }

    .metric-card.danger {
        border-left-color: var(--danger-color);
    }

    .metric-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .metric-icon {
        font-size: 2.5rem;
        opacity: 0.9;
    }

    .metric-trend {
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.375rem 0.75rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .metric-trend.up {
        background: #dcfce7;
        color: #166534;
    }

    .metric-trend.down {
        background: #fee2e2;
        color: #991b1b;
    }

    .metric-label {
        color: var(--text-secondary);
        font-size: 0.9375rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .metric-value {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .metric-details {
        font-size: 0.8125rem;
        color: var(--text-secondary);
        margin-top: 0.5rem;
    }

    .charts-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .chart-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    .chart-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .pending-table {
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .pending-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pending-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .pending-count {
        background: linear-gradient(135deg, var(--warning-color) 0%, #f59e0b 100%);
        color: white;
        font-size: 0.875rem;
        font-weight: 700;
        padding: 0.375rem 0.875rem;
        border-radius: 50px;
    }

    .approval-item {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.2s ease;
    }

    .approval-item:hover {
        background: #f8fafc;
    }

    .approval-item:last-child {
        border-bottom: none;
    }

    .approval-info {
        flex: 1;
    }

    .approval-title {
        font-weight: 700;
        font-size: 1.0625rem;
        color: var(--text-primary);
        margin-bottom: 0.375rem;
    }

    .approval-meta {
        color: var(--text-secondary);
        font-size: 0.875rem;
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .approval-meta span {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .approval-actions {
        display: flex;
        gap: 0.75rem;
    }

    .action-icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .action-icon-btn.approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .action-icon-btn.approve:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: scale(1.1);
    }

    .action-icon-btn.reject {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .action-icon-btn.reject:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: scale(1.1);
    }

    .action-icon-btn.view {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .action-icon-btn.view:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: scale(1.1);
    }

    .resource-status-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .status-chip {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        text-align: center;
        transition: all 0.3s ease;
    }

    .status-chip:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-3px);
    }

    .status-chip-count {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .status-chip-label {
        font-size: 0.875rem;
        color: var(--text-secondary);
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .charts-row {
            grid-template-columns: 1fr;
        }

        .approval-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .approval-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>
@endsection

@section('content')
<div>
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">⚙️ Management Dashboard</h1>
            <p style="color: var(--text-secondary); font-size: 1.0625rem; margin-top: 0.5rem;">
                Manage resources and approve reservations
            </p>
        </div>
        <div class="filter-group">
            <button class="filter-btn active">Today</button>
            <button class="filter-btn">This Week</button>
            <button class="filter-btn">This Month</button>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="metrics-grid">
        <div class="metric-card primary">
            <div class="metric-header">
                <span class="metric-icon">⏳</span>
                <span class="metric-trend up">↑ 3</span>
            </div>
            <div class="metric-label">Pending Approvals</div>
            <div class="metric-value">8</div>
            <div class="metric-details">Requires immediate attention</div>
        </div>

        <div class="metric-card success">
            <div class="metric-header">
                <span class="metric-icon">✓</span>
                <span class="metric-trend up">↑ 12%</span>
            </div>
            <div class="metric-label">Active Reservations</div>
            <div class="metric-value">24</div>
            <div class="metric-details">Currently in use</div>
        </div>

        <div class="metric-card warning">
            <div class="metric-header">
                <span class="metric-icon">💻</span>
                <span class="metric-trend down">↓ 5%</span>
            </div>
            <div class="metric-label">Available Resources</div>
            <div class="metric-value">42</div>
            <div class="metric-details">Ready for reservation</div>
        </div>

        <div class="metric-card danger">
            <div class="metric-header">
                <span class="metric-icon">🔧</span>
                <span class="metric-trend up">↑ 2</span>
            </div>
            <div class="metric-label">Maintenance</div>
            <div class="metric-value">6</div>
            <div class="metric-details">Under maintenance</div>
        </div>
    </div>

    <!-- Resource Status Overview -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">📊 Resource Status Overview</div>
        <div class="resource-status-grid">
            <div class="status-chip">
                <div class="status-chip-count" style="color: var(--success-color);">42</div>
                <div class="status-chip-label">Available</div>
            </div>
            <div class="status-chip">
                <div class="status-chip-count" style="color: var(--primary-color);">24</div>
                <div class="status-chip-label">Reserved</div>
            </div>
            <div class="status-chip">
                <div class="status-chip-count" style="color: var(--warning-color);">6</div>
                <div class="status-chip-label">Maintenance</div>
            </div>
            <div class="status-chip">
                <div class="status-chip-count" style="color: var(--danger-color);">3</div>
                <div class="status-chip-label">Disabled</div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="charts-row">
        <div class="chart-card">
            <div class="chart-title">📈 Reservation Trends</div>
            <canvas id="reservationTrend"></canvas>
        </div>

        <div class="chart-card">
            <div class="chart-title">📊 Resource Utilization</div>
            <canvas id="utilizationChart"></canvas>
        </div>
    </div>

    <div class="charts-row">
        <div class="chart-card">
            <div class="chart-title">🏷️ Resources by Category</div>
            <canvas id="categoryBreakdown"></canvas>
        </div>

        <div class="chart-card">
            <div class="chart-title">📅 Weekly Activity</div>
            <canvas id="weeklyActivity"></canvas>
        </div>
    </div>

    <!-- Pending Approvals -->
    <div class="pending-table">
        <div class="pending-header">
            <div class="pending-title">
                ⏳ Pending Approvals
            </div>
            <span class="pending-count">8 Pending</span>
        </div>

        <div class="approval-item">
            <div class="approval-info">
                <div class="approval-title">Server-05 - Database Server</div>
                <div class="approval-meta">
                    <span>👤 John Smith</span>
                    <span>📅 Jan 20 - Jan 25, 2026</span>
                    <span>💬 "Need for production deployment"</span>
                </div>
            </div>
            <div class="approval-actions">
                <button class="action-icon-btn approve" title="Approve">✓</button>
                <button class="action-icon-btn reject" title="Reject">✕</button>
                <button class="action-icon-btn view" title="View Details">👁</button>
            </div>
        </div>

        <div class="approval-item">
            <div class="approval-info">
                <div class="approval-title">Workstation-12 - Development Machine</div>
                <div class="approval-meta">
                    <span>👤 Sarah Johnson</span>
                    <span>📅 Jan 18 - Jan 22, 2026</span>
                    <span>💬 "Frontend development project"</span>
                </div>
            </div>
            <div class="approval-actions">
                <button class="action-icon-btn approve" title="Approve">✓</button>
                <button class="action-icon-btn reject" title="Reject">✕</button>
                <button class="action-icon-btn view" title="View Details">👁</button>
            </div>
        </div>

        <div class="approval-item">
            <div class="approval-info">
                <div class="approval-title">Storage-Array-03 - Backup Storage</div>
                <div class="approval-meta">
                    <span>👤 Mike Chen</span>
                    <span>📅 Jan 16 - Jan 30, 2026</span>
                    <span>💬 "Data migration and backup"</span>
                </div>
            </div>
            <div class="approval-actions">
                <button class="action-icon-btn approve" title="Approve">✓</button>
                <button class="action-icon-btn reject" title="Reject">✕</button>
                <button class="action-icon-btn view" title="View Details">👁</button>
            </div>
        </div>

        <div class="approval-item">
            <div class="approval-info">
                <div class="approval-title">Network-Switch-07 - Core Network</div>
                <div class="approval-meta">
                    <span>👤 Emily Davis</span>
                    <span>📅 Jan 17 - Jan 20, 2026</span>
                    <span>💬 "Network infrastructure upgrade"</span>
                </div>
            </div>
            <div class="approval-actions">
                <button class="action-icon-btn approve" title="Approve">✓</button>
                <button class="action-icon-btn reject" title="Reject">✕</button>
                <button class="action-icon-btn view" title="View Details">👁</button>
            </div>
        </div>

        <div class="approval-item">
            <div class="approval-info">
                <div class="approval-title">Server-08 - Application Server</div>
                <div class="approval-meta">
                    <span>👤 David Wilson</span>
                    <span>📅 Jan 19 - Jan 24, 2026</span>
                    <span>💬 "Microservices deployment"</span>
                </div>
            </div>
            <div class="approval-actions">
                <button class="action-icon-btn approve" title="Approve">✓</button>
                <button class="action-icon-btn reject" title="Reject">✕</button>
                <button class="action-icon-btn view" title="View Details">👁</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    // Chart.js default configuration
    Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';

    // Reservation Trends Chart
    new Chart(document.getElementById('reservationTrend'), {
        type: 'line',
        data: {
            labels: ['Jan 1', 'Jan 5', 'Jan 10', 'Jan 15', 'Jan 20', 'Jan 25', 'Jan 30'],
            datasets: [{
                label: 'Approved',
                data: [12, 19, 15, 22, 18, 24, 20],
                borderColor: 'rgb(16, 185, 129)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
            }, {
                label: 'Pending',
                data: [5, 8, 6, 10, 7, 9, 8],
                borderColor: 'rgb(245, 158, 11)',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 15,
                        font: { size: 13, weight: '600' },
                        usePointStyle: true
                    }
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

    // Utilization Chart
    new Chart(document.getElementById('utilizationChart'), {
        type: 'bar',
        data: {
            labels: ['Servers', 'Workstations', 'Storage', 'Network'],
            datasets: [{
                label: 'In Use',
                data: [65, 45, 70, 55],
                backgroundColor: 'rgba(79, 70, 229, 0.8)',
                borderColor: 'rgb(79, 70, 229)',
                borderWidth: 2
            }, {
                label: 'Available',
                data: [35, 55, 30, 45],
                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                borderColor: 'rgb(16, 185, 129)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 15,
                        font: { size: 13, weight: '600' },
                        usePointStyle: true
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Category Breakdown
    new Chart(document.getElementById('categoryBreakdown'), {
        type: 'pie',
        data: {
            labels: ['Servers', 'Workstations', 'Storage', 'Network Equipment'],
            datasets: [{
                data: [28, 18, 12, 17],
                backgroundColor: [
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ],
                borderColor: [
                    'rgb(79, 70, 229)',
                    'rgb(16, 185, 129)',
                    'rgb(245, 158, 11)',
                    'rgb(59, 130, 246)'
                ],
                borderWidth: 2
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

    // Weekly Activity
    new Chart(document.getElementById('weeklyActivity'), {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Reservations',
                data: [45, 52, 38, 48, 40, 15, 12],
                backgroundColor: 'rgba(79, 70, 229, 0.8)',
                borderColor: 'rgb(79, 70, 229)',
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
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

    // Filter buttons functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Approval actions
    document.querySelectorAll('.action-icon-btn.approve').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Approve this reservation?')) {
                alert('Reservation approved! (Demo action)');
                this.closest('.approval-item').style.opacity = '0.5';
            }
        });
    });

    document.querySelectorAll('.action-icon-btn.reject').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Reject this reservation?')) {
                alert('Reservation rejected! (Demo action)');
                this.closest('.approval-item').style.opacity = '0.5';
            }
        });
    });

    document.querySelectorAll('.action-icon-btn.view').forEach(btn => {
        btn.addEventListener('click', function() {
            alert('Opening reservation details... (Demo action)');
        });
    });
</script>
@endsection
