<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Jiraphol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">HomBar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aboutme') }}">เกี่ยวกับเรา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('serve') }}">บริการ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.create') }}">สร้างบทความใหม่</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success fw-bold px-3 ms-2 bg-success bg-opacity-10 rounded-pill" href="{{ route('books.index') }}">จัดการหนังสือ (ใบงาน 5)</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<body>
    <div class="container py-4">
        @yield('content')
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Summernote Lite CSS & JS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#content').summernote({
                placeholder: 'เขียนเนื้อหาบทความที่นี่...',
                tabsize: 2,
                height: 250
            });
        });
    </script>
</body>

</html>
