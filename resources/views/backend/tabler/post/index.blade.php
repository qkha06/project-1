<style>
td img {
    width: 75px; /* Chiều rộng ảnh là 75px */
    height: auto; /* Chiều cao tự động điều chỉnh theo tỷ lệ */
    text-align: center; /* Căn chỉnh ảnh sang giữa */
    vertical-align: middle; /* Căn chỉnh ảnh theo chiều dọc */
    border: 2px solid #ddd; /* Thêm viền 2px màu xám nhạt */
    border-radius: 10px; /* Làm tròn các góc 10px */
    box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ */
    transition: transform 0.3s ease; /* Thêm hiệu ứng chuyển tiếp */
    scale: 1.3;
}
    
td img:hover {
    transform: scale(1.1); /* Phóng to ảnh khi di chuột */
}
</style>
<div class="row row-deck">
    <div class="col-12 mb-4">
        <div class="card p-3">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="keyword">Tìm kiếm</label>
                        <input type="text" id="keyword" name="keyword" value="" placeholder="Bí danh (alias).." class="form-control">
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="form-label" for="created_at">Ngày tạo</label>
                        <input type="date" id="created_at" name="created_at" value="" placeholder="created_at" class="form-control">
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="form-label" for="username">Người dùng</label>
                        <input type="text" id="username" name="username" value="" placeholder="Người dùng (username).." class="form-control">
                    </div>
                    <div class="col-sm-2 mb-2">
                        
                            <label class="form-label" for="level">Cấp độ</label>
                            <select name="level" id="level" class="form-control" value="">
                                <option value="-1">[-- Chọn cấp độ --]</option>
                                <option value="0">Cấp độ 0</option>
                                <option value="1">Cấp độ 1</option>
                                <option value="2">Cấp độ 2</option>
                                <option value="3">Cấp độ 3</option>
                            </select>
                        
                    </div>
                    <div class="col-sm-2 d-flex align-items-end gap-1 mb-2">
                        <input type="submit" value="Tìm" class="button auto flex btn btn-w-m btn-primary">
                        <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default" onclick="(location.href = location.pathname)">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quản lý bài đăng</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.post.create') }}" class="btn btn-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                      Thêm mới
                    </a>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
            <thead>
                <tr>
                    <th style="white-space: nowrap">{{ __('links.no') }}</th>
                    <th style="white-space: nowrap">#Ảnh</th>
                    <th style="white-space: nowrap">#Tiêu đề</th>
                    <th style="white-space: nowrap">#Slug</th>
                    <th style="white-space: nowrap">#Ngày đăng</th>
                    <th style="white-space: nowrap">{{ __('links.views') }}</th>
                    <th style="white-space: nowrap">#Status</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                @if(!$posts->isEmpty())
                    @foreach($posts as $key=>$value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img alt="{{ $value->title }}" src="{{ $value->image }}"/></td>
                            <td style="overflow: hidden;text-overflow: ellipsis;">{{ $value->title }}</td>
                            <td>{{ $value->slug }}
                                <a href="{{ route('blog.show', $value->slug) }}" target="_blank" class="ms-1" aria-label="Open website">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 15l6 -6"></path><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path></svg>
                                </a>
                            </td>
                            <td style="white-space: nowrap">{{ date('H:i, d/m/Y', strtotime($value->created_at)) }}</td>
                            <td>{{ $value->views->sum('views') }} views</td>
                            <td>Active</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('admin.post.edit', $value->id) }}" data-alias="rS11" class="btn">Edit</a>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false" data-alias="rS11">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item" data-url="{{ route('blog.show', $value->slug) }}">Copy</a>
                                            <a class="dropdown-item" href="{{ route('admin.post.edit', $value->id) }}">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>    
                </tr>
                @endif

            </tbody>
            </table>
        </div>
    
        <div class="card-footer d-flex align-items-center">
            {{ $posts->links('pagination.tabler') }}
        </div>
        </div>
    </div>
</div>
