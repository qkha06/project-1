<form class="card" action="{{ route('admin.payment-methods.store') }}" method="POST">
    @csrf
    <div class="card-header">
      <h3 class="card-title">Thêm mới</h3>
      <div class="card-actions">
        <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-primary">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
          Quay lại
        </a>
      </div>
    </div>
      <div class="card-body">
        <div class="row row-cards">
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label required" for="name">Tên phương thức</label>
                    <input type="text" id="name" class="form-control" placeholder="Nhập tên phương thức..." name="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label required" for="fee">Phí thanh toán</label>
                    <input type="number" step="0.01" placeholder="Nhập phí thanh toán..." id="fee" class="form-control" name="fee" value="{{ old('fee') }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label required" for="minimum">Số tiền rút tối thiểu</label>
                    <input type="text" id="minimum" class="form-control" placeholder="Nhập số tiền rút tối thiểu.." name="minimum" value="{{ old('minimum') }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">Mô tả phương thức</label>
                <textarea placeholder="Nhập mô tả phương thức..." class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
            </div>

        </div>
      </div>
      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Thêm</button>
      </div>
  
    </form>