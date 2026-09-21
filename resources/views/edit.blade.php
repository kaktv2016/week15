@extends('layout')
@section('title', 'แก้ไขบทความ: ' . $blog->title)

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sarabun:wght@300;400;500;600;700&display=swap');

    .form-container {
        font-family: 'Plus Jakarta Sans', 'Sarabun', sans-serif;
        max-width: 700px;
        margin: 0 auto;
    }

    .glass-form-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 24px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.05);
        padding: 2.5rem;
    }

    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
    }

    .btn-gradient-submit {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1.8rem;
        font-weight: 600;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
        transition: all 0.25s ease;
    }

    .btn-gradient-submit:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #475569;
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1.4rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
</style>

<div class="form-container py-3">
    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-warning bg-opacity-15 text-warning-emphasis rounded-pill px-3 py-2 fw-semibold">
                    ✏️ Edit Article
                </span>
                <span class="badge bg-light text-secondary border font-monospace">
                    ID: #ARTICLE-{{ sprintf('%03d', $blog->id) }}
                </span>
            </div>
            <h2 class="fw-bold text-dark mb-1">แก้ไขบทความ</h2>
            <p class="text-muted small mb-0">แก้ไขข้อมูลบทความจากฐานข้อมูลแล้วกดบันทึกเพื่ออัปเดตระบบ</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn-cancel">
            ← ย้อนกลับ
        </a>
    </div>

    <!-- Form Card -->
    <div class="glass-form-card">
        <form method="POST" action="{{ route('admin.update', $blog->id) }}">
            @csrf
            
            <div class="mb-4">
                <label for="title" class="form-label fw-bold text-dark">ชื่อบทความ <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       placeholder="กรอกชื่อบทความ..." 
                       value="{{ old('title', $blog->title) }}">
                @error('title')
                    <div class="invalid-feedback fw-semibold mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="form-label fw-bold text-dark">เนื้อหาบทความ <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" 
                          rows="5" 
                          name="content" 
                          placeholder="กรอกรายละเอียดและเนื้อหาบทความ...">{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback fw-semibold mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="form-label fw-bold text-dark">สถานะบทความ <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="1" {{ old('status', (string)$blog->status) == '1' ? 'selected' : '' }}>🟢 เปิด (เผยแพร่ทันที)</option>
                    <option value="0" {{ old('status', (string)$blog->status) == '0' ? 'selected' : '' }}>⚪ ปิด (ซ่อนบทความ)</option>
                </select>
                @error('status')
                    <div class="invalid-feedback fw-semibold mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end gap-3 pt-3 border-top border-light">
                <a href="{{ route('admin.dashboard') }}" class="btn-cancel">ยกเลิก</a>
                <button type="submit" class="btn-gradient-submit">
                    ✨ บันทึกการแก้ไข
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
