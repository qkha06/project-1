  <div class="card px-3 pt-3 mb-4">
      <form action="" method="GET">
          <div class="row">
              <div class="col-sm-2 mb-3">
                  <label class="form-label" for="keyword">Tìm kiếm</label>
                  <input type="text" id="keyword" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="Nhập từ khoá" class="form-control">
              </div>
              <div class="col-sm-2 mb-3">
                  <label class="form-label" for="created_at">Ngày tạo</label>
                  <input type="date" id="created_at" name="created_at" value="{{ request('created_at') ?: old('created_at') }}" placeholder="created_at" class="form-control">
              </div>
              <div class="col-sm-2 mb-3">
                  <label class="form-label" for="role">Vai trò</label>
                  <select name="role" id="role" class="form-control" value="">
                    <option value="-1">[-- Chọn vai trò --]</option>
                    <option value="0">Wibu</option>
                    <option value="1">Cấp độ 1</option>
                    <option value="2">Cấp độ 2</option>
                    <option value="3">Cấp độ 3</option>
                </select>
              </div>
              <div class="col-sm-2 mb-3">
                  <label class="form-label" for="order_by_col">Order by</label>
                  <select name="order_by_col" id="order_by_col" class="form-control" value="">
                    <option value="-1">[-- Chọn cột --]</option>
                    <option value="id" selected>Id</option>
                    <option value="name" @selected(request('order_by_col') == 'name')>Tên đăng nhập</option>
                    <option value="email" @selected(request('order_by_col') == 'email')>Địa chỉ Email</option>
                    <option value="created_at" @selected(request('order_by_col') == 'created_at')>Ngày tham gia</option>
                  </select>
              </div>
              <div class="col-sm-2 mb-3">
                  <label class="form-label" for="order_by_method">Order method</label>
                  <select name="order_by_method" id="order_by_method" class="form-control" value="">
                    <option value="-1">[-- Chọn method --]</option>
                    <option value="desc" selected>Giảm dần (DESC)</option>
                    <option value="asc" @selected(request('order_by_method') == 'asc')>Tăng dần (ASC)</option>
                  </select>
              </div>
              <div class="col-sm-2 d-flex align-items-end gap-1 mb-3">
                  <input type="submit" value="Tìm" class="button auto flex btn btn-w-m btn-primary">
                  <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default" onclick="(location.href = location.pathname)">
              </div>
          </div>
        </form>
  </div>

  <div class="card">
  <div class="card-header">
    <h3 class="card-title">Quản lý người dùng</h3>
    <div class="card-actions">
      <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
        Thêm mới
      </a>
    </div>
  </div>
  <div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter table-mobile-md card-table">
        <thead>
          <tr>
            <th>Id.</th>
            <th>Tên đăng nhập</th>
            <th>Tham gia</th>
            <th>Vai trò</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @forEach($users as $user)
          <tr>
            <td data-label="Id." ><span>#{{ $user->id }}</span></td>
            <td data-label="Tên đăng nhập">
              <div class="d-flex py-1 align-items-center">
                <span class="avatar me-2">{{ substr($user->name, 0, 1) }}</span>
                <div class="flex-fill">
                  <div class="font-weight-medium">{{ $user->name }}</div>
                  <div class="text-secondary"><a class="text-reset">{{ $user->email }}</a></div>
                </div>
              </div>
            </td>
            <td data-label="Tham gia">{{ date('H:i, d/m/Y', strtotime($user->created_at)) }}</td>
            <td class="text-secondary" data-label="Vai trò">
              @if (count($user->getRoleNames()))
              @foreach ($user->getRoleNames() as $rolename)
              <span class="badge bg-red text-red-fg">{{ $rolename }}</span>
              @endforeach
              @else
              <span class="badge bg-blue text-blue-fg">Member</span>
              @endif
            </td>
            <td>
              <div class="btn-list flex-nowrap">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn">
                  Edit
                </a>
                <div class="dropdown">
                  <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                    Actions
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" style="">
                    <a class="dropdown-item" href="{{ route('admin.users.show', $user->id) }}">
                      Statistic
                    </a>
                    <a class="dropdown-item" href="#">
                      Delete
                    </a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforEach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{ $users->links('pagination.tabler') }}
    </div>
  </div>

  </div>