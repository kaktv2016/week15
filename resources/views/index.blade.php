@extends('layout')
@section('title', 'หน้าแรก')
@section('content')
    <h1>หน้า Index eiei</h1>
    <div class="alert alert-primary" role="alert">
        This is a primary alert—check it out!
    </div>
    <p>บทความล่าสุด</p>
    <hr>
    @foreach ($blogs as $item)
        <h2>{{ $item->title }}</h2>
        <p>{{ Str::limit(strip_tags($item->content), 100) }}</p>
        <a href="/detail/{{ $item->id }}" class="btn btn-primary">อ่านเพิ่มเติม</a>
        <hr>
    @endforeach
@endsection
