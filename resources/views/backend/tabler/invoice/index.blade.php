<div class="card px-3 pt-3 mb-4">
  <form action="" method="GET">
      <div class="row">
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="keyword">Tìm kiếm</label>
              <input type="text" id="keyword" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="Nhập từ khoá..." class="form-control">
          </div>
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="amount">Số tiền</label>
              <input type="text" id="amount" name="amount" value="{{ request('amount') ?: old('amount') }}" placeholder="Nhập số tiền... (vd: >=10)" class="form-control">
          </div>
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="costs">Phí</label>
              <input type="text" id="costs" name="costs" value="{{ request('costs') ?: old('costs') }}" placeholder="Nhập phí rút... (vd: >=10)" class="form-control">
          </div>
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="type">Kiểu rút</label>
              <select name="type" id="type" class="form-control" value="{{ request('type') ?: old('type') }}" autoselection>
                  <option value="-1">[-- Chọn kiểu rút --]</option>
                  <option value="0">Thường</option>
                  <option value="1">Nhanh</option>
              </select>
          </div>
          <div class="col-sm-6 mb-3">
              <label class="form-label" for="created_at">Ngày tạo</label>
              <input type="date" id="created_at" name="created_at" value="{{ request('created_at') ?: old('created_at') }}" placeholder="created_at" class="form-control">
          </div>
          <div class="col-sm-6 mb-3">
              <label class="form-label" for="paid_at">Ngày thanh toán</label>
              <input type="date" id="paid_at" name="paid_at" value="{{ request('paid_at') ?: old('paid_at') }}" placeholder="paid_at" class="form-control">
          </div>
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="method">Phương thức thanh toán</label>
              <select name="method" id="method" class="form-control" value="{{ request('method') ?: old('method') }}" autoselection>
                <option value="-1">[-- Chọn --]</option>
                <option value="momo">Momo</option>
                <option value="banking">Banking</option>
            </select>
          </div>
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="status">Thông tin thanh toán</label>
              <input type="text" id="bill_info" name="bill_info" value="{{ request('bill_info') ?: old('bill_info') }}" placeholder="Nhập thông tin thanh toán..." class="form-control">
          </div>
          <div class="col-sm-3 mb-3">
              <label class="form-label" for="status">Trạng thái</label>
              <select name="status" id="status" class="form-control" value="{{ request('status') ?: old('status') }}" autoselection>
                <option value="-1">[-- Chọn trạng thái --]</option>
                <option value="pending">Đang xử lý</option>
                <option value="approved">Đã xem xét</option>
                <option value="completed">Thành công</option>
                <option value="cancelled">Từ chối</option>
                <option value="hold">Liên hệ</option>
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
    <h3 class="card-title">Quản lí hoá đơn</h3>
  </div>

  <div class="table-responsive">
    <table class="table table-vcenter table-mobile-md card-table">
      <thead>
        <tr>
          <th>Id.</th>
          <th>Người dùng</th>
          <th>Số tiền</th>
          <th>Phí rút</th>
          <th>Kiểu rút</th>
          <th>Ngày rút</th>
          <th>Ngày thanh toán</th>
          <th>Tài khoản rút</th>
          <th>Trạng thái</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
        @if($invoices->isEmpty())
        <tr>
            <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
        </tr>
        @else
        @forEach($invoices as $invoice)
        <tr>
          <td data-label="Id."><span class="text-secondary">{{ $invoice->id }}</span></td>
          <td data-label="Người dùng">{{ $invoice->user->name }}</td>
          <td data-label="Số tiền">${{ $invoice->amount - ($invoice->amount*$invoice->costs/100) }} {{ $invoice->costs > 0 ? $invoice->amount*$invoice->costs/100 .'$ (phí)' : ''}}</td>
          <td data-label="Phí rút">{{ $invoice->costs }}%</td>
          <td data-label="Kiểu rút">{!! $invoice->type == 0 ? '<span class="badge bg-muted text-muted-fg">Bình thường</span>' : '<span class="badge bg-blue text-blue-fg">Nhanh</span>' !!}</td>
          <td data-label="Ngày rút">{{ $invoice->created_at }}</td>
          <td data-label="Ngày thanh toán">{{ $invoice->status == 2 ? $invoice->paid_at : date('Y-m-d H:i:s', strtotime($invoice->created_at . ' +7 days')). ' (Dự kiến)' }}</td>
          <td data-label="Tài khoản rút">{{ ($invoice->payment_method == 'momo' ? 'Momo' : $invoice->payment_bank_name).' - '.$invoice->payment_account_number.' - '.$invoice->payment_account_name}}</td>
          <td data-label="Trạng thái">
            @if ($invoice->status == 'approved')
            <span class="badge bg-blue text-blue-fg">Đã xem xét</span>
            @elseif ($invoice->status == 'completed')
            <span class="badge bg-green text-green-fg">Thành công</span>
            @elseif ($invoice->status == 'cancelled')
            <span class="badge bg-red text-red-fg">Từ chối</span>
            @elseif ($invoice->status == 'hold')
            <span class="badge bg-dark text-dark-fg">Liên hệ</span>
            @elseif ($invoice->status == 'pending')
            <span class="badge bg-yellow text-yellow-fg">Đang xử lý</span>
            @endif
          </td>
          <td data-label="">
              <div class="btn-list flex-nowrap">
                  <a class="btn" href="{{ route('admin.users.show', $invoice->user_id) }}" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Kiểm tra người dùng" data-bs-original-title="Kiểm tra người dùng">
                    Kiểm tra
                  </a>
                  <div class="dropdown">
                  <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                      Actions
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" style="">
                      <a class="dropdown-item" href="{{ route('admin.invoices.pending', $invoice->id) }}">
                      Trạng thái: Đang xử lý
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.invoices.watched', $invoice->id) }}">
                      Trạng thái: Đã xem xét
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.invoices.success', $invoice->id) }}">
                      Trạng thái: Thành công
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.invoices.refuse', $invoice->id) }}">
                      Trạng thái: Từ chối
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.invoices.contact', $invoice->id) }}">
                      Trạng thái: Liên hệ
                      </a>
            
                  </div>
              </div>
          </td>
        </tr>
        @endforEach
        @endif
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex align-items-center">
    {{ $invoices->links('pagination.tabler') }}
  </div>
</div>