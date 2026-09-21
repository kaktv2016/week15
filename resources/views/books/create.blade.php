@extends('layout')
@section('title', 'เพิ่มหนังสือใหม่ (ใบงานที่ 5)')
@section('content')
<style>
    /* ========== BACKGROUND ========== */
    .create-page {
        position: relative;
        min-height: 80vh;
    }
    .create-page::before {
        content: '';
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        z-index: -2;
    }

    /* Floating Orbs */
    .orb {
        position: fixed;
        border-radius: 50%;
        filter: blur(80px);
        z-index: -1;
        animation: orbFloat 20s infinite ease-in-out alternate;
    }
    .orb-1 { top: 10%; left: 5%; width: 400px; height: 400px; background: rgba(102,126,234,0.15); }
    .orb-2 { bottom: 10%; right: 5%; width: 350px; height: 350px; background: rgba(118,75,162,0.12); animation-delay: -5s; }
    @keyframes orbFloat {
        0%   { transform: translate(0,0) scale(1); }
        100% { transform: translate(30px, -30px) scale(1.1); }
    }

    /* ========== GLASS FORM CARD ========== */
    .glass-form-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 24px;
        overflow: hidden;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    .glass-form-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Form Inputs */
    .form-glass {
        background: rgba(255,255,255,0.06) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        color: #fff !important;
        border-radius: 14px !important;
        padding: 14px 18px !important;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    .form-glass::placeholder { color: rgba(255,255,255,0.3) !important; }
    .form-glass:focus {
        background: rgba(255,255,255,0.1) !important;
        border-color: rgba(102, 126, 234, 0.6) !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15) !important;
        color: #fff !important;
    }
    textarea.form-glass { min-height: 120px; resize: vertical; }

    /* Labels */
    .form-label-glass {
        color: rgba(255,255,255,0.6) !important;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    /* Switch */
    .switch-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 16px;
        padding: 1.2rem 1.5rem;
        transition: all 0.3s ease;
    }
    .switch-card:hover {
        background: rgba(255,255,255,0.07);
        border-color: rgba(255,255,255,0.15);
    }
    .switch-title { color: #fff !important; font-weight: 700; }
    .switch-desc { color: rgba(255,255,255,0.4) !important; font-size: 0.85rem; }
    .form-check-input:checked {
        background-color: #667eea !important;
        border-color: #667eea !important;
    }
    .form-switch .form-check-input {
        width: 3.5em !important;
        height: 1.75em !important;
        cursor: pointer;
        background-color: rgba(255,255,255,0.15) !important;
        border: none !important;
    }

    /* Gradient Button */
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff !important;
        padding: 14px 32px;
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

    .btn-ghost {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.6) !important;
        padding: 14px 28px;
        border-radius: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-ghost:hover {
        background: rgba(255,255,255,0.1);
        color: #fff !important;
        transform: translateY(-2px);
    }

    /* Header */
    .page-title-gradient {
        background: linear-gradient(135deg, #e0e7ff, #c4b5fd, #f0abfc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Back link */
    .back-link {
        color: rgba(255,255,255,0.4) !important;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }
    .back-link:hover {
        color: #818cf8 !important;
        transform: translateX(-4px);
    }

    /* Divider */
    .glass-divider {
        border: none;
        height: 1px;
        background: rgba(255,255,255,0.06);
    }

    /* Step number */
    .step-number {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .step-label { color: rgba(255,255,255,0.5) !important; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; }

    /* Input icon prefix */
    .input-icon-group {
        position: relative;
    }
    .input-icon-group .input-icon {
        position: absolute;
        left: 16px; top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.3);
        pointer-events: none;
        z-index: 2;
    }
    .input-icon-group .form-glass {
        padding-left: 48px !important;
    }

    /* Success animation */
    @keyframes successPulse {
        0% { box-shadow: 0 0 0 0 rgba(52,211,153,0.4); }
        70% { box-shadow: 0 0 0 20px rgba(52,211,153,0); }
        100% { box-shadow: 0 0 0 0 rgba(52,211,153,0); }
    }

    /* Override navbar */
    .navbar { background: rgba(15, 12, 41, 0.9) !important; backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    .navbar .nav-link { color: rgba(255,255,255,0.7) !important; }
    .navbar .nav-link:hover { color: #fff !important; }
    .navbar-brand { color: #fff !important; }
</style>

<div class="create-page">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">

                <!-- Back Link -->
                <a href="{{ route('books.index') }}" class="back-link mb-4 d-inline-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                    กลับไปหน้ารายการหนังสือ
                </a>

                <!-- Header -->
                <div class="mb-4 mt-3">
                    <h2 class="fw-bolder mb-2 page-title-gradient">เพิ่มข้อมูลหนังสือใหม่</h2>
                    <p style="color: rgba(255,255,255,0.4);">กรอกรายละเอียดเพื่อบันทึกหนังสือเข้าสู่ระบบคลัง (ใบงานที่ 5)</p>
                </div>

                <!-- Form Card -->
                <div class="glass-form-card" id="formCard">
                    <div class="p-4 p-md-5">
                        <form action="#" method="POST" id="bookForm">
                            @csrf

                            <!-- Step 1: Title -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="step-number">1</div>
                                    <span class="step-label">ข้อมูลหนังสือ</span>
                                </div>
                                <label class="form-label-glass" for="title">ชื่อหนังสือ</label>
                                <div class="input-icon-group">
                                    <div class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.156 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.596 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/></svg>
                                    </div>
                                    <input type="text" class="form-control form-glass" id="title" name="title" placeholder="เช่น Harry Potter" required>
                                </div>
                            </div>

                            <!-- Author -->
                            <div class="mb-4">
                                <label class="form-label-glass" for="author">ชื่อผู้แต่ง</label>
                                <div class="input-icon-group">
                                    <div class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/></svg>
                                    </div>
                                    <input type="text" class="form-control form-glass" id="author" name="author" placeholder="เช่น J.K. Rowling" required>
                                </div>
                            </div>

                            <hr class="glass-divider my-4">

                            <!-- Step 2: Details -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="step-number">2</div>
                                    <span class="step-label">รายละเอียดสินค้า</span>
                                </div>
                                <label class="form-label-glass" for="price">ราคา (บาท)</label>
                                <div class="input-icon-group">
                                    <div class="input-icon">
                                        <span style="font-size: 1.1rem; font-weight: 700;">฿</span>
                                    </div>
                                    <input type="number" class="form-control form-glass" id="price" name="price" placeholder="0.00" required min="0">
                                </div>
                                <div id="pricePreview" class="mt-2" style="color: rgba(255,255,255,0.3); font-size: 0.85rem; min-height: 20px;"></div>
                            </div>

                            <!-- Status -->
                            <div class="switch-card mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="switch-title">สถานะสินค้า</div>
                                        <div class="switch-desc" id="statusText">✅ สินค้าพร้อมจำหน่าย</div>
                                    </div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" checked>
                                    </div>
                                </div>
                            </div>

                            <hr class="glass-divider my-4">

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <a href="{{ route('books.index') }}" class="btn btn-ghost">ยกเลิก</a>
                                <button type="submit" class="btn btn-gradient d-flex align-items-center gap-2" id="submitBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z"/></svg>
                                    บันทึกข้อมูล
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Card entrance
    setTimeout(() => document.getElementById('formCard').classList.add('visible'), 200);

    // Focus animation on inputs
    document.querySelectorAll('.form-glass').forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.mb-4')?.querySelector('.input-icon')?.style && (this.closest('.mb-4').querySelector('.input-icon').style.color = '#818cf8');
        });
        input.addEventListener('blur', function() {
            this.closest('.mb-4')?.querySelector('.input-icon')?.style && (this.closest('.mb-4').querySelector('.input-icon').style.color = 'rgba(255,255,255,0.3)');
        });
    });

    // Price live preview
    const priceInput = document.getElementById('price');
    const pricePreview = document.getElementById('pricePreview');
    priceInput.addEventListener('input', function() {
        const val = parseFloat(this.value);
        if (!isNaN(val) && val > 0) {
            pricePreview.innerHTML = '💰 ราคา: <strong style="color: #fbbf24;">฿' + val.toLocaleString() + '</strong>';
        } else {
            pricePreview.textContent = '';
        }
    });

    // Status toggle text
    const statusCheckbox = document.getElementById('status');
    const statusText = document.getElementById('statusText');
    statusCheckbox.addEventListener('change', function() {
        if (this.checked) {
            statusText.textContent = '✅ สินค้าพร้อมจำหน่าย';
        } else {
            statusText.textContent = '❌ สินค้าหมดชั่วคราว';
        }
    });

    // Form submit animation
    document.getElementById('bookForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('submitBtn');
        const title = document.getElementById('title').value;

        // Disable & show loading
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> กำลังบันทึก...';

        // Simulate save
        setTimeout(() => {
            btn.style.background = 'linear-gradient(135deg, #34d399, #10b981)';
            btn.style.animation = 'successPulse 1s ease';
            btn.innerHTML = '✅ บันทึกสำเร็จ!';

            setTimeout(() => {
                alert('บันทึกหนังสือ "' + title + '" สำเร็จ! (Demo - ยังไม่ได้เชื่อมฐานข้อมูล)');
                btn.disabled = false;
                btn.style.background = '';
                btn.style.animation = '';
                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z"/></svg> บันทึกข้อมูล';
            }, 1500);
        }, 1200);
    });
});
</script>
@endsection
