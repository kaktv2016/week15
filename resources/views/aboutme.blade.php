@extends('layout')
@section('title', 'เกี่ยวกับเรา')
@section('content')
    <h1>หน้า aboutme.blade.php</h1>
    <hr />
    <p>ชื่อ {{ $name }}</p>
    <p>ชื่อเล่น {{ $nickname }}</p>
    <p>อายุ {{ $age }}</p>
    <p>วันเกิด {{ $birthday }}</p>
@endsection
