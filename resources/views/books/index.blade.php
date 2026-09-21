@extends('layout')
@section('title', 'จัดการรายชื่อหนังสือ (ใบงานที่ 5)')
@section('content')

{{-- Force dark background on body and container --}}
<script>
    document.body.style.background = '#0f0c29';
    document.body.style.color = '#e0e0e0';
    document.querySelector('.container.py-4').style.background = 'transparent';
    document.querySelector('.container.py-4').style.maxWidth = '100%';
    document.querySelector('.container.py-4').style.padding = '0';
</script>

<style>
    /* ========== FORCE DARK OVERRIDES ========== */
    body, html {
        background: #0f0c29 !important;
        color: #e0e0e0 !important;
    }
    .container.py-4 {
        background: transparent !important;
        max-width: 100% !important;
        padding: 0 !important;
    }
    /* Kill all Bootstrap table white backgrounds */
    .table, .table > :not(caption) > * > * {
        --bs-table-bg: transparent !important;
        --bs-table-striped-bg: transparent !important;
        --bs-table-hover-bg: rgba(255,255,255,0.06) !important;
        --bs-table-color: #e0e0e0 !important;
        background-color: transparent !important;
        color: #e0e0e0 !important;
        border-color: rgba(255,255,255,0.04) !important;
    }
    .table > thead > tr > th {
        background-color: rgba(255,255,255,0.05) !important;
        color: rgba(255,255,255,0.5) !important;
    }

    /* ========== ANIMATED BACKGROUND ========== */
    .books-page {
        position: relative;
        min-height: 80vh;
        overflow: hidden;
    }
    .books-page::before {
        content: '';
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        z-index: -2;
    }

    /* Floating Particles */
    .particle {
        position: fixed;
        border-radius: 50%;
        pointer-events: none;
        z-index: -1;
        animation: particleFloat linear infinite;
        opacity: 0;
    }
    @keyframes particleFloat {
        0%   { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10%  { opacity: 1; }
        90%  { opacity: 1; }
        100% { transform: translateY(-10vh) rotate(720deg); opacity: 0; }
    }

    /* ========== STATS CARDS ========== */
    .stat-card {
        background: rgba(255,255,255,0.07);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 1.5rem 1.8rem;
        color: #fff !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        opacity: 0;
        transform: translateY(30px);
    }
    .stat-card.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        border-color: rgba(255,255,255,0.25);
    }
    .stat-icon {
        width: 56px; height: 56px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        color: #fff !important;
    }
    .stat-label {
        color: rgba(255,255,255,0.5) !important;
        font-size: 0.85rem;
    }

    /* ========== GLASS TABLE CARD ========== */
    .glass-table-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 24px;
        overflow: hidden;
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.6s ease;
    }
    .glass-table-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ========== TABLE ========== */
    .book-table {
        color: #e0e0e0 !important;
        margin-bottom: 0 !important;
    }
    .book-table thead th {
        background: rgba(255,255,255,0.05) !important;
        color: rgba(255,255,255,0.5) !important;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        border: none !important;
        padding: 1rem 1.2rem !important;
        white-space: nowrap;
    }
    .book-table tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.04) !important;
        transition: all 0.3s ease;
        cursor: pointer;
        background: transparent !important;
    }
    .book-table tbody tr:hover {
        background: rgba(255,255,255,0.06) !important;
    }
    .book-table td {
        padding: 1rem 1.2rem !important;
        vertical-align: middle !important;
        border: none !important;
        color: rgba(255,255,255,0.8) !important;
    }
    .book-title-text {
        font-weight: 700;
        color: #ffffff !important;
        font-size: 0.95rem;
        display: block;
    }
    .book-id-text {
        color: rgba(255,255,255,0.35) !important;
        font-size: 0.78rem;
        display: block;
    }
    .book-author-text {
        color: rgba(255,255,255,0.6) !important;
    }
    .book-price-text {
        font-weight: 700;
        color: #fbbf24 !important;
        font-size: 1rem;
    }

    /* Book Icon Wrapper */
    .book-icon-wrap {
        width: 48px; height: 48px;
        min-width: 48px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, rgba(251,191,36,0.15), rgba(245,158,11,0.1));
        transition: all 0.3s ease;
    }
    tr:hover .book-icon-wrap {
        transform: rotate(-5deg) scale(1.15);
    }

    /* Status Pills */
    .status-pill {
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }
    .status-available {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399 !important;
        border: 1px solid rgba(52, 211, 153, 0.3);
    }
    .status-unavailable {
        background: rgba(251, 113, 133, 0.15);
        color: #fb7185 !important;
        border: 1px solid rgba(251, 113, 133, 0.3);
    }
    .pulse-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse 2s infinite;
    }
    .pulse-dot.green { background: #34d399; }
    .pulse-dot.red   { background: #fb7185; }
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%      { opacity: 0.4; transform: scale(0.7); }
    }

    /* Action Buttons */
    .btn-glass {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        color: #e0e0e0 !important;
        border-radius: 12px;
        padding: 8px 18px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    .btn-glass:hover {
        background: rgba(255,255,255,0.15);
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .btn-glass-danger:hover {
        background: rgba(251, 113, 133, 0.2) !important;
        border-color: #fb7185 !important;
        color: #fb7185 !important;
    }
    .btn-glass-primary:hover {
        background: rgba(99, 102, 241, 0.2) !important;
        border-color: #818cf8 !important;
        color: #818cf8 !important;
    }

    /* Gradient CTA Button */
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff !important;
        padding: 12px 28px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        position: relative;
        overflow: hidden;
    }
    .btn-gradient::after {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: linear-gradient(transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        transition: 0.5s;
    }
    .btn-gradient:hover::after { left: 100%; }
    .btn-gradient:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        color: #fff !important;
    }

    /* Search */
    .search-glass {
        background: rgba(255,255,255,0.08) !important;
        border: 1px solid rgba(255,255,255,0.12) !important;
        color: #fff !important;
        border-radius: 14px !important;
    }
    .search-glass::placeholder { color: rgba(255,255,255,0.4) !important; }
    .search-glass:focus {
        background: rgba(255,255,255,0.12) !important;
        border-color: rgba(102, 126, 234, 0.6) !important;
        color: #fff !important;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15) !important;
    }

    /* Header */
    .page-title-gradient {
        background: linear-gradient(135deg, #e0e7ff, #c4b5fd, #f0abfc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .page-subtitle { color: rgba(255,255,255,0.4) !important; }
    .page-desc { color: rgba(255,255,255,0.5) !important; }

    /* No Results */
    .no-results {
        padding: 3rem;
        text-align: center;
        display: none;
    }

    /* Row entrance */
    .book-table tbody tr {
        opacity: 0;
        transform: translateX(-20px);
    }
    .book-table tbody tr.row-visible {
        opacity: 1;
        transform: translateX(0);
        transition: all 0.4s ease;
    }

    /* Toast */
    .toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
    .custom-toast {
        background: rgba(30, 30, 60, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 1rem 1.5rem;
        color: #fff !important;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        animation: toastSlideIn 0.4s ease, toastSlideOut 0.4s ease 2.5s forwards;
        min-width: 300px;
    }
    @keyframes toastSlideIn {
        from { transform: translateX(120%); opacity: 0; }
        to   { transform: translateX(0); opacity: 1; }
    }
    @keyframes toastSlideOut {
        from { transform: translateX(0); opacity: 1; }
        to   { transform: translateX(120%); opacity: 0; }
    }

    /* Override navbar */
    .navbar { background: rgba(15, 12, 41, 0.9) !important; backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    .navbar .nav-link { color: rgba(255,255,255,0.7) !important; }
    .navbar .nav-link:hover { color: #fff !important; }
    .navbar-brand { color: #fff !important; }
    .footer-text { color: rgba(255,255,255,0.3) !important; }
    .result-text { color: rgba(255,255,255,0.4) !important; }
    .card-header-title { color: rgba(255,255,255,0.9) !important; }
</style>

<div class="books-page">
    <div id="particles"></div>

    <div class="container py-5">
        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start mb-5">
            <div>
                <p class="page-subtitle text-uppercase mb-2" style="letter-spacing: 4px; font-size: 0.8rem; font-weight: 600;">📚 ใบงานที่ 5 &mdash; Book Management</p>
                <h2 class="display-5 fw-bolder mb-2 page-title-gradient">ระบบจัดการร้านหนังสือ</h2>
                <p class="page-desc" style="max-width: 500px;">พัฒนาโครงร่างระบบการจัดการร้านหนังสือโดยควบคุมผ่าน BookController แสดงรายการเป็นตาราง</p>
            </div>
            <a href="{{ route('books.create') }}" class="btn btn-gradient d-flex align-items-center gap-2 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>
                เพิ่มหนังสือใหม่
            </a>
        </div>

        <!-- STATS -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card" data-delay="0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(139,92,246,0.2));">📖</div>
                        <div>
                            <div class="stat-number" data-count="{{ count($books) }}">0</div>
                            <div class="stat-label">หนังสือทั้งหมด</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" data-delay="150">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(52,211,153,0.2), rgba(16,185,129,0.2));">✅</div>
                        <div>
                            <div class="stat-number" data-count="{{ collect($books)->where('status', true)->count() }}">0</div>
                            <div class="stat-label">มีสินค้าพร้อม</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" data-delay="300">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(251,191,36,0.2), rgba(245,158,11,0.2));">💰</div>
                        <div>
                            <div class="stat-number" data-count="{{ collect($books)->sum('price') }}" data-prefix="฿">0</div>
                            <div class="stat-label">มูลค่ารวมทั้งหมด</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLE CARD -->
        <div class="glass-table-card" id="tableCard">
            <div class="d-flex justify-content-between align-items-center p-4">
                <h5 class="fw-bold mb-0 card-header-title">คลังหนังสือ</h5>
                <div class="d-flex gap-3 align-items-center">
                    <input type="text" id="searchInput" class="form-control search-glass" placeholder="🔍 ค้นหาหนังสือ... (Ctrl+K)" style="width: 260px;">
                    <button class="btn btn-glass" id="sortBtn" onclick="toggleSort()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16"><path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5m0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3m0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1"/></svg>
                        เรียงราคา
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table book-table" id="bookTable">
                    <thead>
                        <tr>
                            <th class="ps-4" style="min-width: 280px;">ชื่อหนังสือ</th>
                            <th style="min-width: 180px;">ผู้แต่ง</th>
                            <th style="min-width: 100px;">ราคา</th>
                            <th style="min-width: 140px;">สถานะ</th>
                            <th class="text-end pe-4" style="min-width: 150px;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="bookTableBody">
                        @foreach ($books as $item)
                            <tr data-price="{{ $item['price'] }}" data-title="{{ $item['title'] }}" data-author="{{ $item['author'] }}">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="book-icon-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#fbbf24" viewBox="0 0 16 16"><path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.156 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.596 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/></svg>
                                        </div>
                                        <div>
                                            <span class="book-title-text">{{ $item['title'] }}</span>
                                            <span class="book-id-text">รหัส: B-00{{ $item['id'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="book-author-text">{{ $item['author'] }}</span>
                                </td>
                                <td>
                                    <span class="book-price-text">฿{{ number_format($item['price']) }}</span>
                                </td>
                                <td>
                                    @if ($item['status'])
                                        <span class="status-pill status-available">
                                            <span class="pulse-dot green"></span> มีสินค้า
                                        </span>
                                    @else
                                        <span class="status-pill status-unavailable">
                                            <span class="pulse-dot red"></span> หมดชั่วคราว
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button class="btn btn-glass btn-glass-primary btn-sm" onclick="showToast('📝 เปิดหน้าแก้ไข: {{ $item['title'] }}')">แก้ไข</button>
                                        <button class="btn btn-glass btn-glass-danger btn-sm" onclick="confirmDelete('{{ $item['title'] }}', this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="no-results" id="noResults">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                <h5 style="color: rgba(255,255,255,0.6) !important;">ไม่พบหนังสือที่ค้นหา</h5>
                <p style="color: rgba(255,255,255,0.3) !important;">ลองค้นหาด้วยคำค้นอื่นดูนะครับ</p>
            </div>

            <div class="d-flex justify-content-between align-items-center p-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <small class="result-text" id="resultCount">กำลังแสดง {{ count($books) }} รายการ</small>
                <small class="footer-text">Powered by BookController &bull; Laravel</small>
            </div>
        </div>
    </div>
</div>

<div class="toast-container" id="toastContainer"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Particles
    const pc = document.getElementById('particles');
    const colors = ['#667eea','#764ba2','#f093fb','#4facfe','#43e97b'];
    for (let i = 0; i < 25; i++) {
        const p = document.createElement('div');
        p.className = 'particle';
        const s = Math.random() * 6 + 2;
        p.style.width = s+'px'; p.style.height = s+'px';
        p.style.left = Math.random()*100+'%';
        p.style.background = colors[Math.floor(Math.random()*colors.length)];
        p.style.animationDuration = (Math.random()*15+10)+'s';
        p.style.animationDelay = (Math.random()*10)+'s';
        pc.appendChild(p);
    }

    // Stats entrance
    document.querySelectorAll('.stat-card').forEach(c => {
        setTimeout(() => c.classList.add('visible'), 200 + parseInt(c.dataset.delay || 0));
    });

    // Animated counter
    document.querySelectorAll('.stat-number').forEach(el => {
        const target = parseInt(el.dataset.count);
        const prefix = el.dataset.prefix || '';
        const duration = 1500;
        const start = Date.now();
        const tick = () => {
            const p = Math.min((Date.now()-start)/duration, 1);
            const eased = 1-(1-p)*(1-p);
            el.textContent = prefix + Math.floor(eased*target).toLocaleString();
            if (p < 1) requestAnimationFrame(tick);
        };
        setTimeout(tick, 600);
    });

    // Table card entrance
    setTimeout(() => document.getElementById('tableCard').classList.add('visible'), 500);

    // Row stagger
    document.querySelectorAll('#bookTableBody tr').forEach((row, i) => {
        setTimeout(() => row.classList.add('row-visible'), 700 + i*120);
    });

    // Live search
    const si = document.getElementById('searchInput');
    si.addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        let count = 0;
        document.querySelectorAll('#bookTableBody tr').forEach(row => {
            const match = (row.dataset.title||'').toLowerCase().includes(q) || (row.dataset.author||'').toLowerCase().includes(q);
            row.style.display = match ? '' : 'none';
            if (match) count++;
        });
        document.getElementById('resultCount').textContent = 'กำลังแสดง ' + count + ' รายการ';
        document.getElementById('noResults').style.display = count === 0 ? 'block' : 'none';
    });

    // Ctrl+K
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey||e.metaKey) && e.key === 'k') { e.preventDefault(); si.focus(); showToast('🔍 พิมพ์เพื่อค้นหาหนังสือ...'); }
    });
});

let sortAsc = true;
function toggleSort() {
    const tbody = document.getElementById('bookTableBody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    rows.sort((a,b) => sortAsc ? a.dataset.price - b.dataset.price : b.dataset.price - a.dataset.price);
    rows.forEach(r => tbody.appendChild(r));
    sortAsc = !sortAsc;
    showToast(sortAsc ? '📉 เรียงจากมากไปน้อย' : '📈 เรียงจากน้อยไปมาก');
}

function showToast(msg) {
    const c = document.getElementById('toastContainer');
    const t = document.createElement('div');
    t.className = 'custom-toast';
    t.innerHTML = msg;
    c.appendChild(t);
    setTimeout(() => t.remove(), 3000);
}

function confirmDelete(title, btn) {
    const row = btn.closest('tr');
    if (confirm('คุณแน่ใจว่าต้องการลบ "' + title + '"?')) {
        row.style.transition = 'all 0.5s ease';
        row.style.transform = 'translateX(100%)';
        row.style.opacity = '0';
        setTimeout(() => {
            row.remove();
            showToast('🗑️ ลบ "' + title + '" แล้ว');
            document.getElementById('resultCount').textContent = 'กำลังแสดง ' + document.querySelectorAll('#bookTableBody tr').length + ' รายการ';
        }, 500);
    }
}
</script>
@endsection
