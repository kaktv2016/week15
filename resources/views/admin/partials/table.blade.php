<div class="table-responsive">
    <table class="table-modern">
        <thead>
            <tr>
                <th style="width: 35%;">ชื่อบทความ</th>
                <th style="width: 35%;">เนื้อหาย่อ</th>
                <th style="width: 15%;">สถานะ</th>
                <th style="width: 15%;" class="text-end pe-4">จัดการ</th>
            </tr>
        </thead>
        <tbody id="articles-tbody">
            @forelse ($blog2 as $item)
                <tr id="article-row-{{ $item->id }}" class="article-row">
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="article-icon-box me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                    <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                                    <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                </svg>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark">{{ $item->title }}</h6>
                                <span class="badge bg-light text-secondary border font-monospace">ID: #ARTICLE-{{ sprintf('%03d', $item->id) }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-secondary mb-0 text-truncate" style="max-width: 320px; font-size: 0.9rem;">
                            {{ Str::words($item->content, 10) }}
                        </p>
                    </td>
                    <td>
                        @if ($item->status)
                            <span class="badge-status-published">
                                <span class="pulse-dot"></span>
                                เผยแพร่แล้ว
                            </span>
                        @else
                            <span class="badge-status-hidden">
                                <span class="gray-dot"></span>
                                ซ่อนอยู่
                            </span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-inline-flex gap-2">
                            <a href="{{ route('admin.edit', $item->id) }}" class="btn-action-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5h6a.5.5 0 0 0 0-1h-6A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                                แก้ไข
                            </a>
                            <button type="button" 
                                    class="btn-action-delete ajax-delete-btn" 
                                    data-id="{{ $item->id }}" 
                                    data-title="{{ $item->title }}"
                                    data-url="{{ route('admin.delete', $item->id) }}"
                                    title="ลบบทความ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <div class="py-4">
                            <div class="bg-light rounded-circle d-inline-flex p-3 text-muted mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-inbox" viewBox="0 0 16 16">
                                    <path d="M4.988 1.488A.5.5 0 0 1 5.242 1h5.516a.5.5 0 0 1 .254.488l-.34 2.621A.5.5 0 0 1 10.174 4.5H5.826a.5.5 0 0 1-.498-.391zM4.143 5.5l.34-2.621A1.5 1.5 0 0 1 5.966 1.5h4.068a1.5 1.5 0 0 1 1.483 1.379l.34 2.621H15a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1zM1 7.5v6.5h14V7.5H11.5a.5.5 0 0 0-.354.146l-.853.854a.5.5 0 0 1-.354.146H6.061a.5.5 0 0 1-.354-.146l-.853-.854A.5.5 0 0 0 4.5 7.5z"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-dark">ไม่พบบทความ</h6>
                            <p class="text-muted small mb-0">
                                @if(!empty($search))
                                    ไม่พบบทความที่ตรงกับคำค้นหา "<span class="fw-bold text-dark">{{ $search }}</span>" <br>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="window.clearSearch()">ดูบทความทั้งหมด</button>
                                @else
                                    กดปุ่ม "สร้างบทความใหม่" ด้านบนเพื่อเริ่มสร้างบทความแรกของคุณ
                                @endif
                            </p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Footer Pagination -->
<div class="px-4 py-3 border-top border-light d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
    <span class="text-muted small fw-medium" id="pagination-info">
        @if ($blog2->total() > 0)
            กำลังแสดงผลลำดับที่ {{ $blog2->firstItem() }} - {{ $blog2->lastItem() }} จากทั้งหมด {{ $blog2->total() }} รายการ
        @else
            ไม่มีรายการบทความ
        @endif
    </span>
    <div class="pagination-container d-flex align-items-center">
        {{ $blog2->links() }}
    </div>
</div>
