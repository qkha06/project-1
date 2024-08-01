<div class="card">
  <div class="card-header">
    <h3 class="card-title">Quản lí cấp độ</h3>
  </div>

  <div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap datatable">
      <thead>
        <tr>
          <th>Id.</th>
          <th>Tên cấp độ</th>
          <th>Giá trị</th>
          <th>Giới hạn</th>
          <th>Mô tả</th>
          <th>Ngày tạo</th>
          <th>Trạng thái</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @if($levels->isEmpty())
        <tr>
            <td>KHÔNG CÓ DỮ LIỆU</td>
            <td>KHÔNG CÓ DỮ LIỆU</td>
            <td>KHÔNG CÓ DỮ LIỆU</td>
            <td>KHÔNG CÓ DỮ LIỆU</td>
            <td>KHÔNG CÓ DỮ LIỆU</td>
            <td>KHÔNG CÓ DỮ LIỆU</td>
        </tr>
        @else
        @forEach($levels as $level)
        <tr>
          <td><span class="text-secondary">{{ $level->id }}</span></td>
          <td>{{ $level->name }}</td>
          <td>{{ $level->click_value }}</td>
          <td>{{ $level->click_limit }}</td>
          <td>##</td>
          <td>{{ $level->created_at }}</td>
          <td>
            @if ($level->status == 1)
            <span class="badge bg-green text-green-fg">Công khai</span>
            @else
            <span class="badge bg-red text-red-fg">Riêng tư</span>
            @endif
          </td>
          <td class="text-end">
            <a href="{{ route('admin.level.edit', $level->id) }}" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
            </a>
            <a href="{{ route('admin.level.editConfig', $level->id) }}" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Config">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments-alt"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8h4v4h-4z" /><path d="M6 4l0 4" /><path d="M6 12l0 8" /><path d="M10 14h4v4h-4z" /><path d="M12 4l0 10" /><path d="M12 18l0 2" /><path d="M16 5h4v4h-4z" /><path d="M18 4l0 1" /><path d="M18 9l0 11" /></svg>
            </a>
            <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
            </a>
           
          </td>
        </tr>
        @endforEach
        @endif
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex align-items-center">
    <ul class="pagination m-0 ms-auto">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
          <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>
          prev
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item active"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">4</a></li>
      <li class="page-item"><a class="page-link" href="#">5</a></li>
      <li class="page-item">
        <a class="page-link" href="#">
          next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>
        </a>
      </li>
    </ul>
  </div>
</div>