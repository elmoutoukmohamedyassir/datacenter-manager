@extends('layouts.app')

@section('title', 'Browse Resources')

@section('styles')
<style>
    .resources-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .view-switcher {
        display: flex;
        gap: 0.5rem;
        background: white;
        padding: 0.375rem;
        border-radius: 10px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }

    .view-btn {
        padding: 0.625rem 1rem;
        border: none;
        background: transparent;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9375rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .view-btn:hover {
        background: rgba(79, 70, 229, 0.1);
    }

    .view-btn.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
    }

    .filters-bar {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    .filters-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 1rem;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filter-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--text-primary);
    }

    .search-input {
        position: relative;
    }

    .search-input input {
        padding-left: 2.75rem;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.25rem;
        color: var(--text-secondary);
    }

    .filter-tags {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .filter-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(67, 56, 202, 0.1) 100%);
        color: var(--primary-color);
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .filter-tag button {
        background: none;
        border: none;
        color: var(--primary-color);
        cursor: pointer;
        font-size: 1.125rem;
        line-height: 1;
        padding: 0;
        margin-left: 0.25rem;
    }

    .clear-filters {
        color: var(--danger-color);
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .resources-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .resource-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .resource-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--success-color));
    }

    .resource-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .resource-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .resource-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(67, 56, 202, 0.1) 100%);
    }

    .resource-status {
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    .resource-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .resource-category {
        display: inline-block;
        padding: 0.375rem 0.875rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 50px;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 1rem;
    }

    .resource-specs {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin: 1rem 0;
    }

    .spec-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .spec-icon {
        font-size: 1rem;
    }

    .resource-location {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin: 0.75rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .resource-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border-color);
    }

    .btn-reserve {
        flex: 1;
        padding: 0.75rem;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-reserve:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-details {
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        border: 2px solid var(--border-color);
        background: white;
        color: var(--text-primary);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-details:hover {
        border-color: var(--primary-color);
        background: rgba(79, 70, 229, 0.05);
    }

    .resources-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .resource-list-item {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        display: flex;
        gap: 1.5rem;
        align-items: center;
        transition: all 0.3s ease;
    }

    .resource-list-item:hover {
        box-shadow: var(--shadow-md);
        transform: translateX(5px);
    }

    .list-item-content {
        flex: 1;
    }

    .list-item-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.75rem;
        flex-wrap: wrap;
    }

    .list-item-name {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .list-item-specs {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .results-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 1rem 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }

    .results-count {
        font-weight: 600;
        color: var(--text-primary);
    }

    .sort-select {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }

    @media (max-width: 1024px) {
        .filters-row {
            grid-template-columns: 1fr 1fr;
        }

        .search-input {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 768px) {
        .resources-grid {
            grid-template-columns: 1fr;
        }

        .filters-row {
            grid-template-columns: 1fr;
        }

        .resource-specs {
            grid-template-columns: 1fr;
        }

        .list-item-specs {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Header -->
    <div class="resources-header">
        <div>
            <h1 class="page-title">💻 Browse Resources</h1>
        </div>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <a href="{{ url('/resources/create') }}" class="btn-reserve" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                ➕ Add New Resource
            </a>
            <div class="view-switcher">
                <button class="view-btn active" data-view="grid">
                    <span>⊞</span> Grid
                </button>
                <button class="view-btn" data-view="list">
                    <span>☰</span> List
                </button>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-bar">
        <div class="filters-row">
            <div class="filter-group">
                <label class="filter-label">🔍 Search</label>
                <div class="search-input">
                    <span class="search-icon">🔍</span>
                    <input type="text" placeholder="Search by name, type, or specification..." id="searchInput">
                </div>
            </div>

            <div class="filter-group">
                <label class="filter-label">📁 Category</label>
                <select id="categoryFilter">
                    <option value="">All Categories</option>
                    <option value="servers">Servers</option>
                    <option value="workstations">Workstations</option>
                    <option value="storage">Storage</option>
                    <option value="network">Network Equipment</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">🏷️ Status</label>
                <select id="statusFilter">
                    <option value="">All Status</option>
                    <option value="available">Available</option>
                    <option value="reserved">Reserved</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="disabled">Disabled</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">📍 Location</label>
                <select id="locationFilter">
                    <option value="">All Locations</option>
                    <option value="rack-a">Rack A</option>
                    <option value="rack-b">Rack B</option>
                    <option value="rack-c">Rack C</option>
                    <option value="room-1">Room 1</option>
                    <option value="room-2">Room 2</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label" style="opacity: 0;">Action</label>
                <button class="btn btn-primary" style="white-space: nowrap;">
                    Apply Filters
                </button>
            </div>
        </div>

        <div class="filter-tags" id="activeTags">
            <!-- Active filter tags will appear here -->
        </div>
    </div>

    <!-- Results Summary -->
    <div class="results-summary">
        <div class="results-count">
            Showing <strong>48</strong> resources
        </div>
        <div class="sort-select">
            <span style="font-weight: 600;">Sort by:</span>
            <select style="padding: 0.5rem; border-radius: 6px; border: 1px solid var(--border-color);">
                <option>Name (A-Z)</option>
                <option>Name (Z-A)</option>
                <option>Status</option>
                <option>Category</option>
                <option>Recently Added</option>
            </select>
        </div>
    </div>

    <!-- Resources Grid View -->
    <div class="resources-grid" id="gridView">
        <!-- Server Resources -->
        <div class="resource-card">
            <div class="resource-header">
                <div class="resource-icon">🖥️</div>
            </div>
            <div class="resource-status">
                <span class="badge badge-active">Available</span>
            </div>
            <h3 class="resource-name">Server-01</h3>
            <span class="resource-category">Production Server</span>
            <div class="resource-specs">
                <div class="spec-item">
                    <span class="spec-icon">⚡</span>
                    <span>16 CPU</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">💾</span>
                    <span>64 GB RAM</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">💿</span>
                    <span>2 TB SSD</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">🐧</span>
                    <span>Ubuntu 22.04</span>
                </div>
            </div>
            <div class="resource-location">
                📍 Rack A - Slot 12
            </div>
            <div class="resource-actions">
                <button class="btn-reserve">Reserve Now</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-card">
            <div class="resource-header">
                <div class="resource-icon">💻</div>
            </div>
            <div class="resource-status">
                <span class="badge badge-active">Available</span>
            </div>
            <h3 class="resource-name">Workstation-05</h3>
            <span class="resource-category">Development Machine</span>
            <div class="resource-specs">
                <div class="spec-item">
                    <span class="spec-icon">⚡</span>
                    <span>8 CPU</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">💾</span>
                    <span>32 GB RAM</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">💿</span>
                    <span>1 TB NVMe</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">🪟</span>
                    <span>Windows 11</span>
                </div>
            </div>
            <div class="resource-location">
                📍 Room 1 - Desk 5
            </div>
            <div class="resource-actions">
                <button class="btn-reserve">Reserve Now</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-card">
            <div class="resource-header">
                <div class="resource-icon">💽</div>
            </div>
            <div class="resource-status">
                <span class="badge badge-pending">Reserved</span>
            </div>
            <h3 class="resource-name">Storage-Array-02</h3>
            <span class="resource-category">Backup Storage</span>
            <div class="resource-specs">
                <div class="spec-item">
                    <span class="spec-icon">💿</span>
                    <span>100 TB</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">🔄</span>
                    <span>RAID 10</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">⚡</span>
                    <span>10 Gbps</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">🔒</span>
                    <span>Encrypted</span>
                </div>
            </div>
            <div class="resource-location">
                📍 Rack B - Slot 8
            </div>
            <div class="resource-actions">
                <button class="btn-reserve" disabled style="opacity: 0.6; cursor: not-allowed;">Reserved</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-card">
            <div class="resource-header">
                <div class="resource-icon">🌐</div>
            </div>
            <div class="resource-status">
                <span class="badge badge-active">Available</span>
            </div>
            <h3 class="resource-name">Network-Switch-03</h3>
            <span class="resource-category">Core Network</span>
            <div class="resource-specs">
                <div class="spec-item">
                    <span class="spec-icon">🔌</span>
                    <span>48 Ports</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">⚡</span>
                    <span>10 Gbps</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">🔧</span>
                    <span>Managed</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">⚙️</span>
                    <span>Layer 3</span>
                </div>
            </div>
            <div class="resource-location">
                📍 Rack C - Slot 2
            </div>
            <div class="resource-actions">
                <button class="btn-reserve">Reserve Now</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-card">
            <div class="resource-header">
                <div class="resource-icon">🗄️</div>
            </div>
            <div class="resource-status">
                <span class="badge badge-active">Available</span>
            </div>
            <h3 class="resource-name">Database-Server-01</h3>
            <span class="resource-category">MySQL Cluster</span>
            <div class="resource-specs">
                <div class="spec-item">
                    <span class="spec-icon">⚡</span>
                    <span>24 CPU</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">💾</span>
                    <span>128 GB RAM</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">💿</span>
                    <span>4 TB SSD</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">🐧</span>
                    <span>MySQL 8.0</span>
                </div>
            </div>
            <div class="resource-location">
                📍 Rack A - Slot 5
            </div>
            <div class="resource-actions">
                <button class="btn-reserve">Reserve Now</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-card">
            <div class="resource-header">
                <div class="resource-icon">🔧</div>
            </div>
            <div class="resource-status">
                <span class="badge badge-in_progress">Maintenance</span>
            </div>
            <h3 class="resource-name">Server-08</h3>
            <span class="resource-category">Application Server</span>
            <div class="resource-specs">
                <div class="spec-item">
                    <span class="spec-icon">⚡</span>
                    <span>12 CPU</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">💾</span>
                    <span>48 GB RAM</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">💿</span>
                    <span>1.5 TB SSD</span>
                </div>
                <div class="spec-item">
                    <span class="spec-icon">🐳</span>
                    <span>Docker</span>
                </div>
            </div>
            <div class="resource-location">
                📍 Rack B - Slot 15
            </div>
            <div class="resource-actions">
                <button class="btn-reserve" disabled style="opacity: 0.6; cursor: not-allowed;">Maintenance</button>
                <button class="btn-details">Details</button>
            </div>
        </div>
    </div>

    <!-- Resources List View (Hidden by default) -->
    <div class="resources-list" id="listView" style="display: none;">
        <div class="resource-list-item">
            <div class="resource-icon" style="font-size: 2.5rem;">🖥️</div>
            <div class="list-item-content">
                <div class="list-item-header">
                    <h3 class="list-item-name">Server-01</h3>
                    <span class="badge badge-active">Available</span>
                    <span class="resource-category">Production Server</span>
                </div>
                <div class="list-item-specs">
                    <span>⚡ 16 CPU</span>
                    <span>💾 64 GB RAM</span>
                    <span>💿 2 TB SSD</span>
                    <span>🐧 Ubuntu 22.04</span>
                    <span>📍 Rack A - Slot 12</span>
                </div>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button class="btn-reserve">Reserve</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-list-item">
            <div class="resource-icon" style="font-size: 2.5rem;">💻</div>
            <div class="list-item-content">
                <div class="list-item-header">
                    <h3 class="list-item-name">Workstation-05</h3>
                    <span class="badge badge-active">Available</span>
                    <span class="resource-category">Development Machine</span>
                </div>
                <div class="list-item-specs">
                    <span>⚡ 8 CPU</span>
                    <span>💾 32 GB RAM</span>
                    <span>💿 1 TB NVMe</span>
                    <span>🪟 Windows 11</span>
                    <span>📍 Room 1 - Desk 5</span>
                </div>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button class="btn-reserve">Reserve</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-list-item">
            <div class="resource-icon" style="font-size: 2.5rem;">💽</div>
            <div class="list-item-content">
                <div class="list-item-header">
                    <h3 class="list-item-name">Storage-Array-02</h3>
                    <span class="badge badge-pending">Reserved</span>
                    <span class="resource-category">Backup Storage</span>
                </div>
                <div class="list-item-specs">
                    <span>💿 100 TB</span>
                    <span>🔄 RAID 10</span>
                    <span>⚡ 10 Gbps</span>
                    <span>🔒 Encrypted</span>
                    <span>📍 Rack B - Slot 8</span>
                </div>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button class="btn-reserve" disabled style="opacity: 0.6; cursor: not-allowed;">Reserved</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-list-item">
            <div class="resource-icon" style="font-size: 2.5rem;">🌐</div>
            <div class="list-item-content">
                <div class="list-item-header">
                    <h3 class="list-item-name">Network-Switch-03</h3>
                    <span class="badge badge-active">Available</span>
                    <span class="resource-category">Core Network</span>
                </div>
                <div class="list-item-specs">
                    <span>🔌 48 Ports</span>
                    <span>⚡ 10 Gbps</span>
                    <span>🔧 Managed</span>
                    <span>⚙️ Layer 3</span>
                    <span>📍 Rack C - Slot 2</span>
                </div>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button class="btn-reserve">Reserve</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-list-item">
            <div class="resource-icon" style="font-size: 2.5rem;">🗄️</div>
            <div class="list-item-content">
                <div class="list-item-header">
                    <h3 class="list-item-name">Database-Server-01</h3>
                    <span class="badge badge-active">Available</span>
                    <span class="resource-category">MySQL Cluster</span>
                </div>
                <div class="list-item-specs">
                    <span>⚡ 24 CPU</span>
                    <span>💾 128 GB RAM</span>
                    <span>💿 4 TB SSD</span>
                    <span>🐧 MySQL 8.0</span>
                    <span>📍 Rack A - Slot 5</span>
                </div>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button class="btn-reserve">Reserve</button>
                <button class="btn-details">Details</button>
            </div>
        </div>

        <div class="resource-list-item">
            <div class="resource-icon" style="font-size: 2.5rem;">🔧</div>
            <div class="list-item-content">
                <div class="list-item-header">
                    <h3 class="list-item-name">Server-08</h3>
                    <span class="badge badge-in_progress">Maintenance</span>
                    <span class="resource-category">Application Server</span>
                </div>
                <div class="list-item-specs">
                    <span>⚡ 12 CPU</span>
                    <span>💾 48 GB RAM</span>
                    <span>💿 1.5 TB SSD</span>
                    <span>🐳 Docker</span>
                    <span>📍 Rack B - Slot 15</span>
                </div>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <button class="btn-reserve" disabled style="opacity: 0.6; cursor: not-allowed;">Maintenance</button>
                <button class="btn-details">Details</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // View switcher
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;

            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            if (view === 'grid') {
                document.getElementById('gridView').style.display = 'grid';
                document.getElementById('listView').style.display = 'none';
            } else {
                document.getElementById('gridView').style.display = 'none';
                document.getElementById('listView').style.display = 'flex';
            }
        });
    });

    // Mock filter functionality
    const filters = {
        search: document.getElementById('searchInput'),
        category: document.getElementById('categoryFilter'),
        status: document.getElementById('statusFilter'),
        location: document.getElementById('locationFilter')
    };

    // Update active tags when filters change
    function updateFilterTags() {
        const tagsContainer = document.getElementById('activeTags');
        const tags = [];

        if (filters.search.value) tags.push({ label: `Search: "${filters.search.value}"`, type: 'search' });
        if (filters.category.value) tags.push({ label: `Category: ${filters.category.options[filters.category.selectedIndex].text}`, type: 'category' });
        if (filters.status.value) tags.push({ label: `Status: ${filters.status.options[filters.status.selectedIndex].text}`, type: 'status' });
        if (filters.location.value) tags.push({ label: `Location: ${filters.location.options[filters.location.selectedIndex].text}`, type: 'location' });

        if (tags.length > 0) {
            tagsContainer.innerHTML = tags.map(tag => `
                <span class="filter-tag">
                    ${tag.label}
                    <button onclick="clearFilter('${tag.type}')">×</button>
                </span>
            `).join('') + '<a href="#" class="clear-filters" onclick="clearAllFilters(); return false;">✕ Clear all filters</a>';
            tagsContainer.style.display = 'flex';
        } else {
            tagsContainer.style.display = 'none';
        }
    }

    function clearFilter(type) {
        if (type === 'search') filters.search.value = '';
        else if (type === 'category') filters.category.value = '';
        else if (type === 'status') filters.status.value = '';
        else if (type === 'location') filters.location.value = '';
        updateFilterTags();
    }

    function clearAllFilters() {
        Object.values(filters).forEach(filter => filter.value = '');
        updateFilterTags();
    }

    // Listen for filter changes
    Object.values(filters).forEach(filter => {
        filter.addEventListener('change', updateFilterTags);
        filter.addEventListener('input', updateFilterTags);
    });

    // Reserve button functionality
    document.querySelectorAll('.btn-reserve:not([disabled])').forEach(btn => {
        btn.addEventListener('click', function() {
            const resourceName = this.closest('.resource-card').querySelector('.resource-name').textContent;
            if (confirm(`Reserve ${resourceName}?`)) {
                alert('Redirecting to reservation form... (Demo)');
            }
        });
    });

    // Details button functionality
    document.querySelectorAll('.btn-details').forEach(btn => {
        btn.addEventListener('click', function() {
            // Navigate to resource detail page
            window.location.href = "{{ url('/resources') }}/1";
        });
    });

    // List item detail button functionality
    document.querySelectorAll('.resource-list-item .btn-details').forEach(btn => {
        btn.addEventListener('click', function() {
            // Navigate to resource detail page
            window.location.href = "{{ url('/resources') }}/1";
        });
    });
</script>
@endsection
