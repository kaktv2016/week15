@extends('layout')
@section('title', 'Admin Dashboard')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sarabun:wght@300;400;500;600;700&display=swap');

    .admin-dashboard {
        font-family: 'Plus Jakarta Sans', 'Sarabun', sans-serif;
    }

    /* Glassmorphism & Modern Cards */
    .glass-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 20px;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .glass-card:hover {
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.07);
    }

    /* Stat Cards */
    .stat-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 18px;
        padding: 1.25rem 1.5rem;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -8px rgba(37, 99, 235, 0.12);
        border-color: rgba(37, 99, 235, 0.25);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.25s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.08);
    }

    /* Buttons */
    .btn-gradient-primary {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.4rem;
        font-weight: 600;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
    }

    .btn-action-edit {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
        border-radius: 10px;
        padding: 0.4rem 0.9rem;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .btn-action-edit:hover {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    .btn-action-delete {
        background: #fef2f2;
        color: #ef4444;
        border: 1px solid #fee2e2;
        border-radius: 10px;
        padding: 0.4rem 0.65rem;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-action-delete:hover {
        background: #ef4444;
        color: #ffffff;
        border-color: #ef4444;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    /* Table Styling */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .table-modern thead th {
        background: #f8fafc;
        color: #64748b;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-modern tbody tr {
        transition: all 0.25s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f8fafc;
    }

    .table-modern tbody td {
        padding: 1.15rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    /* Status Badges */
    .badge-status-published {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        padding: 0.4rem 0.85rem;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
    }

    .badge-status-hidden {
        background-color: #f1f5f9;
        color: #64748b;
        border: 1px solid #cbd5e1;
        padding: 0.4rem 0.85rem;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
    }

    .pulse-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: #10b981;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulse-green 2s infinite;
    }

    .gray-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: #94a3b8;
    }

    @keyframes pulse-green {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }

    .article-icon-box {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #2563eb;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Pagination Styling */
    .pagination {
        margin-bottom: 0;
        gap: 4px;
    }

    .pagination .page-item .page-link {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        color: #475569;
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .pagination .page-item.active .page-link {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    }

    .pagination .page-item .page-link:hover:not(.active) {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        color: #1e293b;
        transform: translateY(-1px);
    }

    /* Smooth Progress Bar & Transitions */
    .table-progress-bar {
        position: absolute;
        top: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background: linear-gradient(90deg, #2563eb, #38bdf8, #2563eb);
        background-size: 200% 100%;
        animation: gradient-move 1.2s infinite linear;
        opacity: 0;
        transition: opacity 0.2s ease;
        z-index: 10;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .table-progress-bar.active {
        opacity: 1;
    }

    @keyframes gradient-move {
        0% { background-position: 100% 0; }
        100% { background-position: -100% 0; }
    }

    #table-wrapper {
        transition: opacity 0.25s cubic-bezier(0.4, 0, 0.2, 1), transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    #table-wrapper.loading {
        opacity: 0.45;
        pointer-events: none;
        transform: scale(0.998);
    }

    /* Row deletion animation */
    .row-deleting {
        background-color: #fef2f2 !important;
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.35s ease-out;
    }

    /* Toast Notification */
    .toast-container-custom {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 1055;
    }

    .custom-toast {
        background: #1e293b;
        color: #ffffff;
        padding: 0.9rem 1.3rem;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        font-weight: 500;
        animation: toast-slide 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes toast-slide {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .stat-number {
        transition: all 0.3s ease;
    }
</style>

<div class="admin-dashboard py-2">
    <!-- Header Banner Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 bg-primary bg-opacity-10 text-primary rounded-pill fw-semibold mb-2 fs-7">
                <span class="pulse-dot"></span> Admin Control Center
            </div>
            <h2 class="fw-extrabold mb-1 text-dark tracking-tight">ระบบจัดการบทความ</h2>
            <p class="text-muted mb-0">ภาพรวมและจัดการบทความทั้งหมดในระบบของคุณ (Admin Dashboard)</p>
        </div>
        <div>
            <a href="{{ route('admin.create') }}" class="btn-gradient-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                สร้างบทความใหม่
            </a>
        </div>
    </div>

    @if (session('success'))
        <div id="session-alert" class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l4.992-6a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <div class="fw-semibold">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Stat Overview Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold fs-7 text-uppercase tracking-wider">บทความทั้งหมด</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1 stat-number" id="stat-total">{{ $totalArticles }}</h3>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                            <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold fs-7 text-uppercase tracking-wider">เผยแพร่แล้ว</span>
                        <h3 class="fw-bold text-success mb-0 mt-1 stat-number" id="stat-published">{{ $publishedArticles }}</h3>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold fs-7 text-uppercase tracking-wider">ซ่อนอยู่ / รอดำเนินการ</span>
                        <h3 class="fw-bold text-secondary mb-0 mt-1 stat-number" id="stat-hidden">{{ $hiddenArticles }}</h3>
                    </div>
                    <div class="stat-icon bg-secondary bg-opacity-10 text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486z"/>
                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                            <path d="M3.35 5.47q-.27.242-.518.487C1.211 7.59 0 8 0 8s3 5.5 8 5.5c.86 0 1.688-.13 2.463-.367l-.767-.767a6 6 0 0 1-1.696.134c-2.12 0-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8q.086-.13.195-.287c.335-.48.83-1.12 1.465-1.755q.247-.248.517-.487z"/>
                            <path d="M13.646 14.354l-12-12-.708.708 12 12z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Glass Card -->
    <div class="glass-card overflow-hidden">
        <!-- Sleek Top Progress Bar -->
        <div id="table-loader-bar" class="table-progress-bar"></div>

        <div class="px-4 pt-4 pb-3 border-bottom border-light d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">รายการบทความทั้งหมด</h5>
                <p class="text-muted small mb-0">ตารางแสดงรายละเอียด สถานะ และเครื่องมือจัดการบทความ</p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <!-- Per Page Selector -->
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">แสดง:</span>
                    <select id="per-page-select" class="form-select form-select-sm bg-light border-0 shadow-none" style="width: 75px;">
                        <option value="5" {{ ($perPage ?? 5) == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ ($perPage ?? 5) == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ ($perPage ?? 5) == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ ($perPage ?? 5) == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>

                <!-- Instant Live Search Input -->
                <div class="input-group input-group-sm" style="max-width: 260px;">
                    <span class="input-group-text bg-light border-0 ps-3" id="search-icon-container">
                        <svg id="search-static-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-search text-muted" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        <div id="search-spinner-icon" class="spinner-border spinner-border-sm text-primary d-none" style="width: 14px; height: 14px;" role="status"></div>
                    </span>
                    <input type="text" id="live-search-input" value="{{ $search ?? '' }}" class="form-control bg-light border-0 shadow-none py-2" placeholder="ค้นหาบทความ..." autocomplete="off">
                    <button type="button" id="search-clear-btn" class="btn btn-sm btn-light border-0 text-muted px-2 {{ empty($search) ? 'd-none' : '' }}" title="ล้างการค้นหา">✕</button>
                </div>
            </div>
        </div>

        <!-- Dynamic Table & Pagination Wrapper -->
        <div id="table-wrapper">
            @include('admin.partials.table', ['blog2' => $blog2, 'search' => $search ?? ''])
        </div>
    </div>
</div>

<!-- Toast Container for Smooth Feedbacks -->
<div class="toast-container-custom" id="toast-container"></div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tableWrapper = document.getElementById('table-wrapper');
    const tableLoaderBar = document.getElementById('table-loader-bar');
    const searchInput = document.getElementById('live-search-input');
    const searchClearBtn = document.getElementById('search-clear-btn');
    const searchStaticIcon = document.getElementById('search-static-icon');
    const searchSpinnerIcon = document.getElementById('search-spinner-icon');
    const perPageSelect = document.getElementById('per-page-select');
    const statTotal = document.getElementById('stat-total');
    const statPublished = document.getElementById('stat-published');
    const statHidden = document.getElementById('stat-hidden');

    let currentUrl = new URL(window.location.href);
    let searchDebounceTimeout = null;
    let isFetching = false;

    // Toast message function
    function showToast(message, isError = false) {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = 'custom-toast';
        toast.style.borderLeft = isError ? '4px solid #ef4444' : '4px solid #10b981';
        toast.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="${isError ? '#ef4444' : '#10b981'}" viewBox="0 0 16 16">
                ${isError 
                    ? '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm-.93-9.5v3.5a.75.75 0 0 0 1.5 0V6.5a.75.75 0 0 0-1.5 0zm.93 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>' 
                    : '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l4.992-6a.75.75 0 0 0-.01-1.05z"/>'}
            </svg>
            <span>${message}</span>
        `;
        container.appendChild(toast);
        setTimeout(() => {
            toast.style.transition = 'all 0.3s ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(10px)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Smooth fetch function
    async function fetchData(url, pushHistory = true) {
        if (isFetching) return;
        isFetching = true;

        // UI Loading state
        tableLoaderBar.classList.add('active');
        tableWrapper.classList.add('loading');
        searchStaticIcon.classList.add('d-none');
        searchSpinnerIcon.classList.remove('d-none');

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Network error');

            const data = await response.json();

            // Update DOM with new HTML
            tableWrapper.innerHTML = data.table_html;

            // Update statistics
            if (data.total_articles !== undefined) statTotal.textContent = data.total_articles;
            if (data.published_articles !== undefined) statPublished.textContent = data.published_articles;
            if (data.hidden_articles !== undefined) statHidden.textContent = data.hidden_articles;

            // Update URL in browser history without reload
            if (pushHistory) {
                window.history.pushState({ path: url.toString() }, '', url.toString());
            }

            currentUrl = new URL(url, window.location.origin);
        } catch (error) {
            console.error('Error fetching data:', error);
            showToast('เกิดข้อผิดพลาดในการโหลดข้อมูล', true);
        } finally {
            // Remove loading state smoothly
            tableLoaderBar.classList.remove('active');
            tableWrapper.classList.remove('loading');
            searchStaticIcon.classList.remove('d-none');
            searchSpinnerIcon.classList.add('d-none');
            isFetching = false;
        }
    }

    // Intercept pagination clicks
    tableWrapper.addEventListener('click', (e) => {
        const link = e.target.closest('.pagination a');
        if (link) {
            e.preventDefault();
            const targetUrl = new URL(link.href);
            fetchData(targetUrl);
        }

        // Intercept AJAX delete button clicks
        const deleteBtn = e.target.closest('.ajax-delete-btn');
        if (deleteBtn) {
            e.preventDefault();
            const articleId = deleteBtn.dataset.id;
            const articleTitle = deleteBtn.dataset.title;
            const deleteUrl = deleteBtn.dataset.url;

            if (confirm(`คุณต้องการลบบทความ "${articleTitle}" ใช่หรือไม่?`)) {
                handleAjaxDelete(articleId, deleteUrl);
            }
        }
    });

    // Handle AJAX Delete with smooth row removal
    async function handleAjaxDelete(id, url) {
        const row = document.getElementById(`article-row-${id}`);
        if (row) {
            row.classList.add('row-deleting');
        }

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const data = await response.json();

            if (data.success) {
                showToast(data.message || 'ลบบทความสำเร็จ');
                // Refresh current page smoothly to keep pagination counters correct
                setTimeout(() => {
                    fetchData(currentUrl, false);
                }, 250);
            } else {
                if (row) row.classList.remove('row-deleting');
                showToast('ไม่สามารถลบบทความได้', true);
            }
        } catch (err) {
            if (row) row.classList.remove('row-deleting');
            showToast('เกิดข้อผิดพลาดในการลบข้อมูล', true);
        }
    }

    // Instant Live Search
    searchInput.addEventListener('input', (e) => {
        const val = e.target.value.trim();

        if (val.length > 0) {
            searchClearBtn.classList.remove('d-none');
        } else {
            searchClearBtn.classList.add('d-none');
        }

        clearTimeout(searchDebounceTimeout);
        searchDebounceTimeout = setTimeout(() => {
            const url = new URL(window.location.href);
            if (val) {
                url.searchParams.set('search', val);
            } else {
                url.searchParams.delete('search');
            }
            url.searchParams.delete('page'); // Reset to first page on search
            fetchData(url);
        }, 280);
    });

    // Clear search
    window.clearSearch = () => {
        searchInput.value = '';
        searchClearBtn.classList.add('d-none');
        const url = new URL(window.location.href);
        url.searchParams.delete('search');
        url.searchParams.delete('page');
        fetchData(url);
    };

    searchClearBtn.addEventListener('click', window.clearSearch);

    // Per page select change
    perPageSelect.addEventListener('change', (e) => {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', e.target.value);
        url.searchParams.delete('page'); // Reset to first page
        fetchData(url);
    });

    // Handle browser Back / Forward buttons seamlessly
    window.addEventListener('popstate', () => {
        fetchData(new URL(window.location.href), false);
    });
});
</script>
@endsection
