<form class="card" action="{{ route('admin.users.update', $user->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="card-header">
    <h3 class="card-title">Chỉnh sửa: <b>{{ $user->name }}</b></h3>
    <div class="card-actions">
      <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
        Quay lại
      </a>
    </div>
  </div>
    <div class="card-body">
      <div class="row row-cards">
        <div class="col-sm-6 col-md-6">
          <div class="mb-3">
            <label class="form-label required">Tên người dùng</label>
            <input type="text" class="form-control" placeholder="Nhập tên người dùng.." name="name" value="{{ old('name', $user->name) }}">
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="mb-3">
            <label class="form-label required">Email</label>
            <input type="email" class="form-control" placeholder="Nhập địa chỉ email.." name="email" value="{{ old('email', $user->email) }}">
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="mb-3">
            <label class="form-label required">Mật khẩu</label>
            <input type="text" class="form-control" placeholder="Nhập mật khẩu.." name="password">
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="mb-3">
            <label class="form-label">Tham gia</label>
            <input type="datetime-local" class="form-control" placeholder="Chọn ngày tham gia.." name="created_at" value="{{ old('created_at', $user->created_at) }}">
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="mb-3">
            <label class="form-label">Tên đầy đủ</label>
            <input type="text" class="form-control" placeholder="Nhập tên đầy đủ..." name="fullname" value="{{ old('fullname', $user->address->fullname ?? null) }}">
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" placeholder="Nhập số điện thoại..." name="phone_number" value="{{ old('phone_number', $user->address->number_phone ?? null) }}">
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="mb-3">
            <label class="form-label">Địa chỉ 1</label>
            <input type="text" class="form-control" placeholder="Nhập địa chỉ 1..." name="address_1" value="{{ old('address_1', $user->address->address_1 ?? null) }}">
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="mb-3">
            <label class="form-label">Địa chỉ 2</label>
            <input type="text" class="form-control" placeholder="Nhập địa chỉ 2..." name="address_2" value="{{ old('address_2', $user->address->address_2 ?? null) }}">
          </div>
        </div>
        <div class="col-md-5">
          <div class="mb-3">
            <label class="form-label">Vùng (huyện)</label>
            <input type="text" class="form-control" placeholder="Nhập vùng (huyện)..." name="region" value="{{ old('region', $user->address->region ?? null) }}">
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="mb-3">
            <label class="form-label">Thành phố (tỉnh)</label>
            <input type="text" class="form-control" placeholder="Nhập thành phố (tỉnh)" name="city" value="{{ old('city', $user->address->city ?? null) }}">
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="mb-3">
            <label class="form-label">Zipcode</label>
            <input type="text" class="form-control" placeholder="Nhập mã code..." name="zipcode" value="{{ old('zipcode', $user->address->zipcode ?? null) }}">
          </div>
        </div>


        <div class="col-md-12">
          <div class="mb-3 mb-9">
            <div class="form-label">Vai trò</div>
            <select class="form-select" multiple="" style="height: 150px" name="role[]" value="{{ old('role') }}">
              @foreach ($roles as $role)
              <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected':'' }}>{{ $role }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-end">
      <button type="submit" class="btn btn-primary">Cập nhật lại</button>
    </div>

  </form>