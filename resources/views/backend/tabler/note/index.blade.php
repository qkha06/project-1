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
                <h3 class="card-title">Quản lý liên kết</h3>
            </div>
          <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
              <thead>
                <tr>
                    <th style="white-space: nowrap">{{ __('links.no') }}</th>
                    <th style="white-space: nowrap">#Người dùng</th>
                    <th style="white-space: nowrap">{{ __('links.link') }}</th>
                    <th style="white-space: nowrap">{{ __('links.date_created') }}</th>
                    <th style="white-space: nowrap">{{ __('links.views') }}</th>
                    <th style="white-space: nowrap">{{ __('links.income') }}</th>
                    <th class="w-1"></th>
                </tr>
              </thead>
              <tbody>
                @if(!$user_stu_links->isEmpty())
                @foreach($user_stu_links as $key=>$value)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        @if (isset($value->user))
                        <td style="white-space: nowrap"><span class="badge badge-outline text-blue">{{ $value->user->name }}</span></td>
                        @else
                        <td style="white-space: nowrap"><span class="badge badge-outline text-red">Ẩn danh</span></td>
                        @endif
                        <td style="white-space: nowrap"><a href="{{ ($_settings['note_url'] ?? env('APP_URL')).'/'.$value->alias }}" target="__blank">{{ ($_settings['note_url'] ?? env('APP_URL')).'/'.$value->alias }}</a></td>
                        <td style="white-space: nowrap">{{ date('H:i, d/m/Y', strtotime($value->created_at)) }}</td>
                        <td>{{ $value->total_clicks }}</td>
                        <td>${{ round($value->total_revenue, 3) }}</td>

                        <td>
                            <div class="btn-list flex-nowrap">
                                <button onclick="editSTU(this)" data-alias="{{ $value->alias }}" data-param="{{ $value->data }}" class="btn" data-bs-toggle="modal" data-bs-target="#modal-large">
                                Edit
                                </button>
                                <div class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false" data-alias="{{ $value->alias }}">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a class="dropdown-item" href="#" data-alias="{{ $value->alias }}">
                                    Copy
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.stu.show', $value->id) }}">
                                    Report
                                    </a>
                                </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
            <tr>
                <td colspan="7">KHÔNG CÓ DỮ LIỆU</td>    
            </tr>
            @endif  
              </tbody>
            </table>
          </div>
    
          <div class="card-footer d-flex align-items-center">
            {{ $user_stu_links->links('pagination.tabler') }}
          </div>
        </div>
      </div>
</div>

<div class="modal modal-blur fade" id="modal-large" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Chỉnh sửa liên kết</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body stu_cnt"  id="eSCtn">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.</p>

        </div>

      </div>
    </div>
  </div>
<script>

function editSTU(e) {
    const alias = e.dataset.alias;
    const data = JSON.parse(e.dataset.param || '{}');
    const btn_STU = {};
    const input_STU = {};

    for (let category of ['btn', 'lnk', 'oth']) {
        for (let key in data[category]) {
            btn_STU['g_' + key] = true;
            input_STU[key] = decodeURIComponent(atob(data[category][key]));
        }
    }
    const editSTU2 = new STU({
        select: '#eSCtn',
        type: 'edit',
        data: {
            inp: input_STU,
            outp: btn_STU,
            alias: alias
        }
});
}
function cpLink(element) {
    const link = 'https://link4sub.com/' + element.dataset['alias'];
    const tempInput = document.createElement('input');
    document.body.appendChild(tempInput);
    tempInput.value = link;
    tempInput.select();
    document.execCommand('copy');
    tempInput.remove();
    Swal.fire({
        title: 'Sao chép liên kết thành công!',
        icon: 'success',
        confirmButtonText: 'Truy cập link',
        showCancelButton: true,
        cancelButtonText: 'Đóng'
    }).then((result) => {
        if (result.isConfirmed) {
            window.open(link, '_blank');
        };
    })
}

function rmLink(element) {
    var link = element.dataset.alias,
        idurl = link;

    Swal.fire({
        title: 'Bạn có chắc không?',
        html: `Nó không thể khôi phục nếu bạn xoá nó! Bạn chắc chắn muốn xoá liên kết <b>"${idurl}"</b> chứ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Chắc chắn!',
        cancelButtonText: 'Huỷ'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: 'Đang xử lý...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                fetch(`/stu/${idurl}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Xóa liên kết thất bại');
                    }
                }).then(data => {
                    if (data.status === 'success') {
                        setTimeout(() => {
                            Swal.close();
                            Swal.fire({
                                title: 'Xóa thành công!',
                                icon: 'success',
                            }).then((result) => {
                                window.location.href = window.location.href;
                            });
                        }, 1000);
                    } else {
                        Swal.fire({
                        title: 'Xóa thất bại!',
                        icon: 'error',
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: 'Xóa thất bại!',
                        text: error.message, // Provide specific error message
                        icon: 'error',
                    });
                });
            }
            });
        }
    });
}

</script>

