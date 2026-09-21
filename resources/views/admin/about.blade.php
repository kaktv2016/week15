@extends('layout')
@section('title', 'Admin About')
@section('content')
    <div class="card shadow-sm border-0 rounded-4" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body p-5 text-center">
            <h1 class="card-title fw-bold mb-4">ข้อมูลส่วนตัวแอดมิน</h1>
            <div class="fs-5 mb-3 text-start">
                <strong>ชื่อ:</strong> {{ $about2['name'] }} ({{ $about2['nickname'] }})
            </div>
            <div class="fs-5 mb-3 text-start">
                <strong>อายุ:</strong> {{ $about2['age'] }} ปี
            </div>
            <div class="fs-5 mb-3 text-start">
                <strong>วันเกิด:</strong> {{ $about2['birthday'] }}
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill px-4 mt-4">
                กลับหน้า Dashboard
            </a>
        </div>
    </div>
@endsection
