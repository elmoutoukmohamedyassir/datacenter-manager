@extends('layouts.app')

@section('title', 'Resource Details')

@section('styles')
<style>
    .resource-detail-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .resource-header {
        background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
        color: white;
        padding: 3rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-xl);
        position: relative;
        overflow: hidden;
    }

    .resource-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .resource-header-content {
        position: relative;
        z-index: 1;
    }

    .resource-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .resource-subtitle {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
    }

    .resource-meta {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 968px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }

    .detail-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    .detail-card-title {
        font-size: 1.375rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .spec-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .spec-item {
        padding: 1.25rem;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }

    .spec-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .spec-value {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-list li:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: var(--text-secondary);
    }

    .info-value {
        color: var(--text-primary);
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
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

    .btn-outline {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
    }

    .btn-outline:hover {
        background: var(--primary-color);
        color: white;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-block;
    }

    .badge-active {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #166534;
    }

    .badge-reserved {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
    }

    .badge-maintenance {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
    }

    .timeline {
        position: relative;
        padding-left: 2rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, var(--primary-color) 0%, #e0e7ff 100%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -2.5rem;
        top: 0.25rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 3px solid var(--card-bg);
    }

    .timeline-date {
        font-size: 0.8125rem;
        color: var(--text-secondary);
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .timeline-content {
        font-size: 0.9375rem;
        color: var(--text-primary);
    }

    .utilization-chart {
        margin-top: 1.5rem;
    }

    .utilization-bar {
        height: 30px;
        background: linear-gradient(135deg, #e0e7ff 0%, #f3f4f6 100%);
        border-radius: 15px;
        overflow: hidden;
        margin-top: 0.75rem;
        position: relative;
    }

    .utilization-fill {
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color) 0%, #4338ca 100%);
        border-radius: 15px;
        transition: width 0.5s ease;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 1rem;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        border-radius: 10px;
        border: 1px solid var(--border-color);
    }

    .feature-icon {
        font-size: 1.5rem;
    }

    .feature-text {
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--text-primary);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1.5rem;
        transition: all 0.2s ease;
    }

    .back-link:hover {
        gap: 0.75rem;
    }
</style>
@endsection

@section('content')
<div class="resource-detail-container">
    <a href="{{ url('/resources/browse') }}" class="back-link">
        ← Back to Resources
    </a>

    <!-- Resource Header -->
    <div class="resource-header">
        <div class="resource-header-content">
            <div class="resource-title">
                🖥️ Server-01
            </div>
            <div class="resource-subtitle">
                High-Performance Production Server
            </div>
            <div class="resource-meta">
                <div class="meta-item">
                    <span>📍</span>
                    <span>Rack A - Slot 12</span>
                </div>
                <div class="meta-item">
                    <span>🏷️</span>
                    <span>Category: Servers</span>
                </div>
                <div class="meta-item">
                    <span>⏰</span>
                    <span>Last Updated: 2 hours ago</span>
                </div>
                <div class="meta-item">
                    <span class="badge badge-active">Available</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="detail-grid">
        <!-- Left Column -->
        <div>
            <!-- Specifications Card -->
            <div class="detail-card" style="margin-bottom: 2rem;">
                <div class="detail-card-title">
                    ⚙️ Technical Specifications
                </div>
                <div class="spec-grid">
                    <div class="spec-item">
                        <div class="spec-label">Processor</div>
                        <div class="spec-value">
                            <span>💻</span>
                            <span>16 Cores</span>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">Memory</div>
                        <div class="spec-value">
                            <span>🧠</span>
                            <span>64 GB RAM</span>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">Storage</div>
                        <div class="spec-value">
                            <span>💾</span>
                            <span>2 TB SSD</span>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">Operating System</div>
                        <div class="spec-value">
                            <span>🐧</span>
                            <span>Ubuntu 22.04 LTS</span>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">Network</div>
                        <div class="spec-value">
                            <span>🌐</span>
                            <span>10 Gbps</span>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">Power Supply</div>
                        <div class="spec-value">
                            <span>⚡</span>
                            <span>Redundant PSU</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Card -->
            <div class="detail-card" style="margin-bottom: 2rem;">
                <div class="detail-card-title">
                    ✨ Features & Capabilities
                </div>
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">🔒</div>
                        <div class="feature-text">Hardware Encryption</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🔄</div>
                        <div class="feature-text">Hot Swap Support</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📊</div>
                        <div class="feature-text">Performance Monitoring</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🛡️</div>
                        <div class="feature-text">RAID Configuration</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🌡️</div>
                        <div class="feature-text">Temperature Sensors</div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🔌</div>
                        <div class="feature-text">Remote Management</div>
                    </div>
                </div>
            </div>

            <!-- Utilization Card -->
            <div class="detail-card">
                <div class="detail-card-title">
                    📊 Resource Utilization
                </div>
                <div class="utilization-chart">
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="font-weight: 600; color: var(--text-primary);">CPU Usage</span>
                            <span style="font-weight: 600; color: var(--primary-color);">45%</span>
                        </div>
                        <div class="utilization-bar">
                            <div class="utilization-fill" style="width: 45%;">45%</div>
                        </div>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="font-weight: 600; color: var(--text-primary);">Memory Usage</span>
                            <span style="font-weight: 600; color: var(--primary-color);">62%</span>
                        </div>
                        <div class="utilization-bar">
                            <div class="utilization-fill" style="width: 62%;">62%</div>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="font-weight: 600; color: var(--text-primary);">Storage Usage</span>
                            <span style="font-weight: 600; color: var(--primary-color);">38%</span>
                        </div>
                        <div class="utilization-bar">
                            <div class="utilization-fill" style="width: 38%;">38%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Information Card -->
            <div class="detail-card" style="margin-bottom: 2rem;">
                <div class="detail-card-title">
                    ℹ️ Information
                </div>
                <ul class="info-list">
                    <li>
                        <span class="info-label">Resource ID</span>
                        <span class="info-value">#SRV-001</span>
                    </li>
                    <li>
                        <span class="info-label">Serial Number</span>
                        <span class="info-value">SN-2024-001-ABC</span>
                    </li>
                    <li>
                        <span class="info-label">Purchase Date</span>
                        <span class="info-value">Jan 15, 2024</span>
                    </li>
                    <li>
                        <span class="info-label">Warranty</span>
                        <span class="info-value">3 Years (Active)</span>
                    </li>
                    <li>
                        <span class="info-label">Assigned To</span>
                        <span class="info-value">Production Team</span>
                    </li>
                    <li>
                        <span class="info-label">Manager</span>
                        <span class="info-value">John Smith</span>
                    </li>
                    <li>
                        <span class="info-label">Cost Center</span>
                        <span class="info-value">IT-PROD-001</span>
                    </li>
                </ul>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ url('/resources/1/edit') }}" class="btn btn-primary" style="text-decoration: none;">
                        ✏️ Edit Resource
                    </a>
                    <button class="btn btn-secondary" onclick="reserveResource()">
                        📅 Reserve Now
                    </button>
                    <button class="btn btn-outline" onclick="requestMaintenance()">
                        🔧 Maintenance
                    </button>
                </div>
            </div>

            <!-- Activity Timeline Card -->
            <div class="detail-card">
                <div class="detail-card-title">
                    📜 Activity History
                </div>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-date">2 hours ago</div>
                        <div class="timeline-content">
                            <strong>Status Update:</strong> Resource marked as available
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">Yesterday, 3:45 PM</div>
                        <div class="timeline-content">
                            <strong>Reservation Ended:</strong> Emily Davis completed reservation
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">Jan 10, 10:30 AM</div>
                        <div class="timeline-content">
                            <strong>Maintenance Completed:</strong> System upgraded to latest version
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">Jan 8, 2:15 PM</div>
                        <div class="timeline-content">
                            <strong>Reservation Started:</strong> Reserved by Michael Chen
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">Jan 5, 9:00 AM</div>
                        <div class="timeline-content">
                            <strong>Status Update:</strong> Resource added to inventory
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function reserveResource() {
        const startDate = prompt('Enter reservation start date:', '2026-01-20');
        if (startDate) {
            const endDate = prompt('Enter reservation end date:', '2026-01-25');
            const purpose = prompt('Enter purpose/reason:', 'Production deployment');

            if (endDate && purpose) {
                alert(`✅ Reservation request submitted!\n\nResource: Server-01\nStart: ${startDate}\nEnd: ${endDate}\nPurpose: ${purpose}\n\nStatus: Pending approval\n\nNote: This is a demo. Backend integration required.`);
            }
        }
    }

    function requestMaintenance() {
        const description = prompt('Describe the maintenance needed:', 'Regular system update');
        if (description) {
            const priority = prompt('Priority level (low/medium/high):', 'medium');
            const preferredDate = prompt('Preferred maintenance date:', '2026-01-18');

            if (priority && preferredDate) {
                alert(`✅ Maintenance request submitted!\n\nResource: Server-01\nDescription: ${description}\nPriority: ${priority}\nPreferred Date: ${preferredDate}\n\nStatus: Pending review\n\nNote: This is a demo. Backend integration required.`);
            }
        }
    }

    function downloadSpecs() {
        alert(`📄 Downloading specifications for Server-01...\n\nIn a real implementation, this would generate and download a PDF with:\n- Complete technical specifications\n- Configuration details\n- Usage history\n- Maintenance records\n\nNote: This is a demo. Backend integration required.`);
    }
</script>
@endsection
