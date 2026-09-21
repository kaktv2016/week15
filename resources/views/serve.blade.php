@extends('layout')
@section('title', 'บริการระดับพรีเมียม')
@section('content')

<!-- Force Dark Mode and Custom Background for this page -->
<script>
    document.documentElement.setAttribute('data-bs-theme', 'dark');
    document.body.style.background = '#0a0a0a';
    document.body.style.color = '#e5e5e5';
</script>

<style>
    /* Custom CSS for "ตึงๆ" (Sleek/Stunning) Vibe */
    
    /* Background Glow Effects */
    .bg-glow-container {
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        z-index: -1;
        overflow: hidden;
        background-color: #050505;
    }
    .glow-blob-1 {
        position: absolute;
        top: -10%; left: -10%; width: 50vw; height: 50vw;
        background: radial-gradient(circle, rgba(62, 28, 168, 0.3) 0%, transparent 70%);
        animation: float 15s infinite ease-in-out alternate;
    }
    .glow-blob-2 {
        position: absolute;
        bottom: -10%; right: -10%; width: 60vw; height: 60vw;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
        animation: float 20s infinite ease-in-out alternate-reverse;
    }
    @keyframes float {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(5%, 10%) scale(1.1); }
    }

    /* Text Gradients */
    .text-gradient {
        background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Glass Card */
    .glass-card {
        background: rgba(20, 20, 20, 0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-left: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        position: relative;
    }
    .glass-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 30px rgba(79, 172, 254, 0.2);
        border-color: rgba(79, 172, 254, 0.4);
    }
    .glass-card::before {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.05), transparent);
        transform: skewX(-20deg);
        transition: 0.7s;
    }
    .glass-card:hover::before {
        left: 150%;
    }

    /* Neon Buttons */
    .btn-neon-primary {
        background: transparent;
        color: #00f2fe;
        border: 2px solid #00f2fe;
        box-shadow: 0 0 10px rgba(0, 242, 254, 0.2), inset 0 0 10px rgba(0, 242, 254, 0.2);
        transition: all 0.3s ease;
    }
    .btn-neon-primary:hover {
        background: #00f2fe;
        color: #000 !important;
        box-shadow: 0 0 20px rgba(0, 242, 254, 0.6), inset 0 0 10px rgba(0, 242, 254, 0.4);
    }

    /* Neon Badges */
    .badge-neon-success {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid #10b981;
        box-shadow: 0 0 8px rgba(16, 185, 129, 0.4);
    }
    .badge-neon-danger {
        background: rgba(244, 63, 94, 0.1);
        color: #f43f5e;
        border: 1px solid #f43f5e;
        box-shadow: 0 0 8px rgba(244, 63, 94, 0.4);
    }

    /* Icon Wrap */
    .icon-wrap {
        width: 80px; height: 80px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
        box-shadow: inset 0 0 20px rgba(255,255,255,0.02);
        margin-bottom: 1.5rem;
        transition: all 0.4s ease;
    }
    .glass-card:hover .icon-wrap {
        transform: scale(1.1) rotate(5deg);
    }
    
    /* Make navbar match dark theme dynamically */
    .navbar {
        background: rgba(5, 5, 5, 0.8) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
</style>

<div class="bg-glow-container">
    <div class="glow-blob-1"></div>
    <div class="glow-blob-2"></div>
</div>

<div class="position-relative z-1 py-5">
    <!-- Header Section -->
    <div class="text-center mb-5 pb-3">
        <h6 class="text-uppercase text-secondary mb-3" style="letter-spacing: 4px; font-weight: 600;">Our Expertise</h6>
        <h1 class="display-4 fw-bolder mb-3 text-gradient">บริการสุดพรีเมียม</h1>
        <p class="col-lg-6 mx-auto fs-5 text-secondary">
            ยกระดับธุรกิจของคุณด้วยการออกแบบและเทคโนโลยีล้ำสมัย<br> สัมผัสงานคุณภาพระดับมาสเตอร์พีซ
        </p>
    </div>

    <!-- Services Grid -->
    <div class="row row-cols-1 row-cols-md-3 g-5">
        @foreach ($serve as $item)
            <div class="col">
                <div class="glass-card h-100 d-flex flex-column p-4">
                    
                    <div class="card-body p-2 d-flex flex-column flex-grow-1">
                        <!-- Icon representation -->
                        <div class="icon-wrap">
                            @if ($item['id'] == 1 || stripos($item['name'], 'web') !== false)
                                <!-- Web Design Icon (Monitor) -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="#00f2fe" class="bi bi-laptop drop-shadow-glow" viewBox="0 0 16 16" style="filter: drop-shadow(0 0 8px rgba(0, 242, 254, 0.6));">
                                    <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5"/>
                                </svg>
                            @elseif ($item['id'] == 2 || stripos($item['name'], 'app') !== false)
                                <!-- App Design Icon (Phone) -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="#a18cd1" class="bi bi-phone" viewBox="0 0 16 16" style="filter: drop-shadow(0 0 8px rgba(161, 140, 209, 0.6));">
                                    <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                    <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                </svg>
                            @else
                                <!-- Graphic Design Icon (Palette) -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="#fbc2eb" class="bi bi-palette" viewBox="0 0 16 16" style="filter: drop-shadow(0 0 8px rgba(251, 194, 235, 0.6));">
                                    <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                    <path d="M16 8c0 3.15-1.866 2.585-3.567 2.07-1.077-.327-2.094-.635-3.18-.182-.132.054-.261.12-.386.196l-.879.537c-.1.061-.21.117-.325.167a3 3 0 1 1-4.248-2.916l.775-.388a3.5 3.5 0 0 1 1.777-.384c.78.03.784.04.784-.576 0-3.61 3.54-6.137 7.34-6.137 3.82 0 7.34 2.946 7.34 6.643zm-4.99 3.58c.845.256 1.72.52 2.607.786.996.3 2.383.727 2.383-1.366 0-3.006-2.907-5.643-6.34-5.643-3.105 0-6.34 2.007-6.34 5.137 0 .342.066.648.277.887a.9.9 0 0 0 .762.307c.502-.03.882-.225 1.174-.42l.81-.495c.29-.177.582-.358.92-.478 1.012-.36 2.093-.08 3.125.232z"/>
                                </svg>
                            @endif
                        </div>

                        <!-- Service Details -->
                        <h3 class="fw-bold mb-3 text-white">{{ $item['name'] }}</h3>
                        
                        <div class="mb-4">
                            <span class="fs-2 fw-bolder text-white">฿{{ number_format($item['price']) }}</span>
                            <span class="text-secondary ms-1">/ งาน</span>
                        </div>
                        
                        <p class="text-secondary" style="font-size: 0.95rem; line-height: 1.6;">
                            งานคุณภาพระดับไฮเอนด์ สำหรับบริการ <strong>{{ $item['name'] }}</strong> ส่งมอบตรงเวลา ดีไซน์โดดเด่นไม่ซ้ำใคร พร้อมตอบโจทย์ทุกความต้องการของคุณ
                        </p>
                    </div>

                    <!-- Footer & CTA -->
                    <div class="card-footer bg-transparent border-0 p-2 mt-auto">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-white-50 fs-6">Status</span>
                                @if ($item['status'] === 'available')
                                    <span class="badge badge-neon-success rounded-pill px-3 py-2 fs-6">
                                        <span class="spinner-grow spinner-grow-sm me-1" style="width: 0.5rem; height: 0.5rem;" role="status"></span>
                                        Available
                                    </span>
                                @else
                                    <span class="badge badge-neon-danger rounded-pill px-3 py-2 fs-6">
                                        <i class="bi bi-x-circle-fill me-1"></i> Not Available
                                    </span>
                                @endif
                            </div>
                            
                            @if ($item['status'] === 'available')
                                <a href="#" class="btn btn-neon-primary rounded-pill py-2 w-100 fw-bold mt-2">
                                    ดีลงานเลย 🚀
                                </a>
                            @else
                                <button class="btn btn-outline-secondary rounded-pill py-2 w-100 fw-bold mt-2" style="opacity: 0.5;" disabled>
                                    คิวเต็มแล้ว 🚫
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
