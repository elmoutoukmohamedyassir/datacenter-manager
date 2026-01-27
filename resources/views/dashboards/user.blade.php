@extends('layouts.app')

@section('title', 'User Dashboard')

@section('styles')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, var(--card-bg) 0%, #f8fafc 100%);
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        opacity: 0.1;
        font-size: 4rem;
        line-height: 100px;
        text-align: center;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .stat-card.primary::before {
        content: '📊';
    }

    .stat-card.success::before {
        content: '✓';
    }

    .stat-card.warning::before {
        content: '⏳';
    }

    .stat-card.info::before {
        content: '📋';
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-change {
        font-size: 0.8125rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.625rem;
        border-radius: 50px;
    }

    .stat-change.positive {
        background-color: #dcfce7;
        color: #166534;
    }

    .stat-change.negative {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .chart-container {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
    }

    .chart-header {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: var(--card-bg);
        border: 2px solid var(--border-color);
        border-radius: 12px;
        text-decoration: none;
        color: var(--text-primary);
        transition: all 0.3s ease;
        font-weight: 600;
        box-shadow: var(--shadow-sm);
    }

    .action-btn:hover {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(67, 56, 202, 0.05) 100%);
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .action-icon {
        font-size: 2rem;
    }

    .recent-list {
        list-style: none;
    }

    .recent-item {
        padding: 1.25rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.2s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .recent-item:last-child {
        border-bottom: none;
    }

    .recent-item:hover {
        background-color: #f8fafc;
        padding-left: 1.5rem;
    }

    .recent-info {
        flex: 1;
    }

    .recent-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .recent-meta {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .notification-badge {
        background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.25rem 0.625rem;
        border-radius: 50px;
        min-width: 24px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .stat-value {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div>
    <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-primary);">
        👋 Welcome back, {{ Auth::user()->first_name }}!
    </h1>
    <p style="color: var(--text-secondary); font-size: 1.125rem; margin-bottom: 2rem;">
        Here's what's happening with your reservations today
    </p>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="{{ route('reservations.create') }}" class="action-btn">
            <span class="action-icon">➕</span>
            <span>New Reservation</span>
        </a>
        <a href="{{ route('reservations.history') }}" class="action-btn">
            <span class="action-icon">📜</span>
            <span>View History</span>
        </a>
        <a href="{{ route('incidents.create') }}" class="action-btn">
            <span class="action-icon">⚠️</span>
            <span>Report Incident</span>
        </a>
        <a href="#notifications" class="action-btn">
            <span class="action-icon">🔔</span>
            <span>Notifications</span>
            <span class="notification-badge">3</span>
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="dashboard-grid">
        <div class="stat-card primary">
            <span class="stat-icon">📊</span>
            <div class="stat-label">Active Reservations</div>
            <div class="stat-value">5</div>
            <span class="stat-change positive">↑ 2 this week</span>
        </div>

        <div class="stat-card success">
            <span class="stat-icon">✓</span>
            <div class="stat-label">Completed</div>
            <div class="stat-value">23</div>
            <span class="stat-change positive">↑ 15%</span>
        </div>

        <div class="stat-card warning">
            <span class="stat-icon">⏳</span>
            <div class="stat-label">Pending Approval</div>
            <div class="stat-value">2</div>
            <span class="stat-change negative">↓ 1 today</span>
        </div>

        <div class="stat-card info">
            <span class="stat-icon">📋</span>
            <div class="stat-label">Total Reservations</div>
            <div class="stat-value">30</div>
            <span class="stat-change positive">↑ All time</span>
        </div>
    </div>

    <!-- Charts Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
        <div class="chart-container">
            <div class="chart-header">
                📈 Reservation Trend
            </div>
            <canvas id="trendChart" style="max-height: 300px;"></canvas>
        </div>

        <div class="chart-container">
            <div class="chart-header">
                🥧 Resources by Category
            </div>
            <canvas id="categoryChart" style="max-height: 300px;"></canvas>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="card">
        <div class="card-header">
            📋 Recent Reservations
        </div>
        <ul class="recent-list">
            <li class="recent-item">
                <div class="recent-info">
                    <div class="recent-title">Server-01 (Production Server)</div>
                    <div class="recent-meta">Jan 10, 2026 - Jan 15, 2026</div>
                </div>
                <span class="badge badge-active">Active</span>
            </li>
            <li class="recent-item">
                <div class="recent-info">
                    <div class="recent-title">Workstation-05 (Development Machine)</div>
                    <div class="recent-meta">Jan 8, 2026 - Jan 12, 2026</div>
                </div>
                <span class="badge badge-pending">Pending</span>
            </li>
            <li class="recent-item">
                <div class="recent-info">
                    <div class="recent-title">Storage-Array-02 (Backup Storage)</div>
                    <div class="recent-meta">Jan 5, 2026 - Jan 10, 2026</div>
                </div>
                <span class="badge badge-finished">Finished</span>
            </li>
            <li class="recent-item">
                <div class="recent-info">
                    <div class="recent-title">Network-Switch-03 (Core Network)</div>
                    <div class="recent-meta">Jan 3, 2026 - Jan 7, 2026</div>
                </div>
                <span class="badge badge-approved">Approved</span>
            </li>
            <li class="recent-item">
                <div class="recent-info">
                    <div class="recent-title">Database-Server-01 (MySQL Cluster)</div>
                    <div class="recent-meta">Dec 28, 2025 - Jan 2, 2026</div>
                </div>
                <span class="badge badge-finished">Finished</span>
            </li>
        </ul>
    </div>

    <!-- Notifications Section -->
    <div class="card" id="notifications">
        <div class="card-header">
            🔔 Recent Notifications
        </div>
        <ul class="recent-list">
            <li class="recent-item">
                <div class="recent-info">
                    <div class="recent-title">Reservation Approved</div>
                    <div class="recent-meta">Your reservation for Server-01 has been approved • 2 hours ago</div>
                </div>
                <span style="color: var(--success-color); font-size: 1.5rem;">✓</span>
            </li>
            <li class="recent-item">
                <div class="recent-info">
                    <div class="recent-title">Reservation Ending Soon</div>
                    <div class="recent-meta">Workstation-05 reservation ends in 2 days • 5 hours ago</div>
                </div>
                <span style="color: var(--warning-color); font-size: 1.5rem;">⏰</span>
            </li>
            <li class="recent-item">
                <div class="recent-info">
                    <div class="recent-title">New Message</div>
                    <div class="recent-meta">Manager commented on your incident report • 1 day ago</div>
                </div>
                <span style="color: var(--info-color); font-size: 1.5rem;">💬</span>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    // Trend Chart
    const trendCtx = document.getElementById('trendChart');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
            datasets: [{
                label: 'Reservations',
                data: [3, 5, 4, 7, 6, 5],
                borderColor: 'rgb(79, 70, 229)',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
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
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 2,
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Servers', 'Workstations', 'Storage', 'Network'],
            datasets: [{
                data: [12, 8, 6, 4],
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
                        font: {
                            size: 13,
                            weight: '600'
                        },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            }
        }
    });
</script>
@endsection
