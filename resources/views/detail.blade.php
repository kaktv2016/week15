@extends('layout')
@section('title', $blog->title)
@section('content')
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <h1 class="card-title fw-bold mb-3">{{ $blog->title }}</h1>
            <p class="text-muted small">
                สถานะ: <span class="badge {{ $blog->status ? 'bg-success' : 'bg-secondary' }}">{{ $blog->status ? 'เผยแพร่' : 'ฉบับร่าง' }}</span>
                @if($blog->created_at)
                    | เผยแพร่เมื่อ: {{ $blog->created_at }}
                @endif
            </p>
            <hr>
            <div class="card-text py-2" style="font-size: 1.1rem; line-height: 1.8;">
                {!! $blog->content !!}
            </div>
            <hr>
            <a href="/" class="btn btn-secondary">กลับหน้าแรก</a>
        </div>
    </div>
@endsection
