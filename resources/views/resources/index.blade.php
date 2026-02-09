<style>
    /* Professional Grid Layout */
    .resources-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
        gap: 1.5rem; 
        padding-top: 1rem;
    }

    /* Modern Glass-morphism Card */
    .resource-card { 
        background: #ffffff; 
        border: 1px solid #e2e8f0; 
        border-radius: 12px; 
        padding: 1.5rem; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .resource-card:hover { 
        transform: translateY(-4px); 
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); 
        border-color: #4f46e5;
    }

    /* Status Badges */
    .badge { 
        font-size: 0.7rem; 
        text-transform: uppercase; 
        letter-spacing: 0.05em; 
        padding: 4px 10px; 
        border-radius: 6px; 
        font-weight: 700;
    }
    .badge-active { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .badge-inactive { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    /* Category Tag */
    .resource-category {
        display: inline-block;
        background: #f1f5f9;
        color: #475569;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 4px;
        margin-top: 0.5rem;
    }

    /* Specification List */
    .spec-list {
        margin: 1.25rem 0;
        border-top: 1px solid #f1f5f9;
        padding-top: 1rem;
    }
    .spec-item {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        color: #64748b;
    }
    .spec-label { font-weight: 500; color: #1e293b; }

    /* Action Buttons */
    .btn-reserve { 
        background: #4f46e5; 
        color: white !important; 
        padding: 0.6rem; 
        border-radius: 8px; 
        text-align: center; 
        font-weight: 600; 
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-reserve:hover { background: #4338ca; }
</style>