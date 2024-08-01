<form class="card" action="{{ route('admin.level.update', $level->id) }}" method="POST">
  @method('PUT')
  @csrf
  <div class="card-header">
    <h3 class="card-title">Chỉnh sửa: <b>{{ $level->name }}</b></h3>
    <div class="card-actions">
      <a href="{{ route('admin.level.index') }}" class="btn btn-primary">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
        Quay lại
      </a>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $level->name }}" @required(true)/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" name="status">
                <option value="-1" @selected($level->status == -1)>[--Chọn--]</option>
                <option value="0" @selected($level->status == 0)>Riêng tư - Private</option>
                <option value="1" @selected($level->status == 1)>Công khai - Public</option>
            </select>                        
        </div>
        <div class="col-md-6 mb-3">
            <label for="cpm" class="form-label">click_value</label>
            <input type="number" name="click_value" id="cpm" class="form-control" step="0.01" value="{{ $level->click_value }}"/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="limit" class="form-label">Giới hạn</label>
            <input type="number" name="click_limit" id="limit" class="form-control" value="{{ $level->click_limit }}"/>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Thành viên</label>
            <select class="form-select" name="icon" aria-label="Default select example">
                <option selected="">[--Chọn--]</option>
                <option value="member">Member</option>
                <option value="member-pro">MemberPro</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="limit" class="form-label">Test link</label>
            <input type="url" name="test_link" id="test_link" class="form-control" value="{{ $level->test_link }}"/>
        </div>
    
      <div class="col-md-6 mb-3">
          <label for="description" class="form-label">Mô tả</label>
          <textarea class="form-control" placeholder="Nhập mô tả..." name="description" id="description" style="min-height: 300px">{{ empty($level->description) ? '' : $level->description }}</textarea>
      </div>
      <div class="col-md-6 mb-3">
          <label for="redirect_url" class="form-label">Trang set cookie</label>
          <textarea class="form-control" placeholder="Nhập url..." name="redirect_url" id="redirect_url" style="min-height: 300px">{{ empty($level->redirect_url) ? '' : $level->redirect_url }}</textarea>
      </div>
    </div>
    <div class="mb-3 text-start">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
  </div>

  </form>