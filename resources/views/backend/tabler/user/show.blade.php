<div class="row g-5">
  <div class="col-12 col-xxl-4">
    <div class="row g-3">
      <div class="col-12 col-md-7 col-xxl-12">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center text-center text-sm-start mb-3">
              <div class="col-12 col-sm-auto">
                <span class="avatar avatar-lg" style="background-image: url(https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg)"></span>
              </div>
              <div class="col-12 col-sm-auto flex-1">
                <h3 class="mb-1">{{ $user->name }}</h3>
                <span class="text-body-secondary">Joined: {{ (new DateTime($user->created_at))->format('Y/m/d H:i:s') }}</span>
              </div>
            </div>
            @php
            $_revenue = $user_metric['total_revenue'];
            $_balance = $user_metric['total_balance'];
            $_clicks = $user_metric['total_views'];
            $_wd = $user->withdraw->whereIn('status', [0, 1, 2])->sum('amount');
            $_cus_revenue = $ctSTUstats->sum('revenue');
            $_cus_clicks = $ctSTUstats->sum('clicks');
            @endphp
            <div class="d-flex justify-content-between align-items-center border-top border-dashed py-3">
              <div class="d-flex flex-column align-items-center">
                <div class="subheader">Tổng thu nhập</div>
                <p class="fs-7 text-body-secondary mb-0">${{ round($_revenue, 3) }}</p>
              </div>
              <div class="d-flex flex-column align-items-center">
                <div class="subheader">Tổng lượt xem</div>
                <p class="fs-7 text-body-secondary mb-0">{{ $_clicks }}</p>
              </div>
              <div class="d-flex flex-column align-items-center">
                <div class="subheader">Tổng số dư</div>
                <p class="fs-7 text-body-secondary mb-0">${{ round($_balance, 3) }}</p>
              </div>

            </div>
            <div class="d-flex justify-content-between align-items-center border-top border-dashed pt-3">
              <div class="d-flex flex-column align-items-center">
                <div class="subheader">Tổng liên kết</div>
                <p class="fs-7 text-body-secondary mb-0">{{ count($STUlinks) }}</p>
              </div>
              <div class="d-flex flex-column align-items-center">
                <div class="subheader">Tổng lệnh rút</div>
                <p class="fs-7 text-body-secondary mb-0">-- --</p>
              </div>
              <div class="d-flex flex-column align-items-center">
                <div class="subheader">Tổng ##</div>
                <p class="fs-7 text-body-secondary mb-0">-- --</p>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-5 col-xxl-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Default Address</h3>
          </div>
          <div class="card-body">
            @if ($user->address)
            <h5 class="text-body-secondary">Address</h5>
            <p class="text-body-secondary">{{ $user->address->address_1 }}<br>-- --</p>
            @endif
            <div class="mb-3">
              <h5 class="text-body-secondary">Email</h5><a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
            </div>
            @if ($user->address)
            <h5 class="text-body-secondary">Phone</h5><a class="text-body-secondary">+{{ $user->address->number_phone }}</a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h3 class="mb-4">Notes on Customer</h3><textarea class="form-control mb-3" rows="4"></textarea><button class="btn btn-phoenix-primary w-100 mb-4">Add Note</button>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-xxl-8 mb-3">
    <div class="row gy-5 mb-3">
      <div class="col-6 col-xl">
        <div class="card h-lg-100">
          <div class="card-body d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column align-items-center"><span class="h1 mb-0 me-2 me-2">
                {{ $_cus_clicks }}
              </span>
              <div class="m-0"><span class="subheader">LƯỢT XEM</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl">
        <div class="card h-lg-100">
          <div class="card-body d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column align-items-center"><span class="h1 mb-0 me-2 me-2">
                ${{ round($_cus_revenue, 3) }}
              </span>
              <div class="m-0"><span class="subheader">DOANH THU</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl">
        <div class="card h-lg-100">
          <div class="card-body d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column align-items-center"><span class="h1 mb-0 me-2 me-2">
                1
              </span>
              <div class="m-0"><span class="subheader">CPM</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl">
        <div class="card h-lg-100">
          <div class="card-body d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column align-items-center"><span class="h1 mb-0 me-2 me-2">
                {{ $ctSTUlinks->count() }}
              </span>
              <div class="m-0"><span class="subheader">STU MỚI</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl">
        <div class="card h-lg-100">
          <div class="card-body d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column align-items-center"><span class="h1 mb-0 me-2 me-2">
                0
              </span>
              <div class="m-0"><span class="subheader">NOTE MỚI</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs flex-row-reverse" data-bs-toggle="tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a href="#tabs-home-ex4" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
              <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                <path d="M9 7l6 0"></path>
                <path d="M9 11l6 0"></path>
                <path d="M9 15l4 0"></path>
              </svg>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="#tabs-profile-ex4" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
              <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                <path d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z"></path>
                <path d="M10 11v-2a2 2 0 1 1 4 0v2"></path>
              </svg>
            </a>
          </li>
          <li class="nav-item me-auto" role="presentation">
            <h3 class="card-title">Liên kết</h3>
          </li>
        </ul>
      </div>
      <div class="tab-content">
        <div class="tab-pane" id="tabs-home-ex4" role="tabpanel">
          <div class="table-responsive">
            <table class="table table-vcenter">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Liên kết</th>
                  <th>Lượt xem</th>
                  <th>Thu nhập</th>
                  <th>Trạng thái</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane active show" id="tabs-profile-ex4" role="tabpanel">
          <div id="table-ctSTUlinks" class="table-responsive">
            <table class="table table-vcenter">
              <thead>
                <tr>
                  <th><button class="table-sort" data-sort="sort-stt">STT</button></th>
                  <th><button class="table-sort" data-sort="sort-alias">Bí danh</button></th>
                  <th><button class="table-sort" data-sort="sort-views">Lượt xem</button></th>
                  <th><button class="table-sort" data-sort="sort-revenue">Thu nhập</button></th>
                  <th><button class="table-sort" data-sort="sort-created">Ngày tạo</button></th>
                </tr>

              </thead>
              <tbody class="table-tbody">
                @if (count($ctSTUlinks))
                @foreach ($ctSTUlinks as $key=>$val)
                @php
                  $stats = $val->stats
                @endphp
                <tr>
                  <td class="sort-stt">
                    {{ $key }}
                  </td>
                  <td class="sort-alias">
                    {{ $val->alias }}
                    <a href="{{ route('stu.show', $val->alias) }}" target="_blank" class="ms-1" aria-label="Open website">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 15l6 -6"></path><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path></svg>
                    </a>
                  </td>
                  <td class="sort-views">
                    {{ $stats->count() }}
                  </td>
                  <td class="sort-revenue">
                    ${{ $stats->sum('revenue') }}
                  </td>
                  <td class="sort-created">
                    {{ $val->created_at }}
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
            <div class="card-footer d-flex align-items-center">

            </div>
          </div>
          <script>

          </script>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="d-flex">
          <h3 class="card-title">Số liệu thống kê</h3>
        </div>
      </div>
      <div class="table-responsive border-top">
        <table  id="table-stats" class="table table-vcenter card-table table-striped">
          <thead>
            <tr>
              <th><button class="table-sort" data-sort="sort-date">Ngày</button></th>
              <th><button class="table-sort" data-sort="sort-views">Lượt xem</button></th>
              <th><button class="table-sort" data-sort="sort-revenue">Thu nhập</button></th>
              <th><button class="table-sort" data-sort="sort-cpm">CPM</button></th>
            </tr>
          </thead>
          <tbody class="table-tbody">
            @foreach ($ctStatsTable as $key=>$val)

            <tr>
              <td class="sort-date" style="white-space: nowrap">{{ $val['date'] }}</td>
              <td class="sort-views">{{ $val['views'] }}</td>
              <td class="sort-revenue">${{ $val['revenue'] }}</td>
              <td class="sort-cpm">${{ $val['cpm'] }}</td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>

      <div class="card-footer d-flex align-items-center">
        {{ $ctStatsTable->links('pagination.tabler') }}
      </div>
    </div>

  </div>

</div>

<div class="row g-5">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quản lí hoá đơn</h3>
      </div>

      <div class="table-responsive">
        <table class="table table-vcenter table-mobile-md card-table">
          <thead>
            <tr>
              <th>Id.</th>
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

            @if($ctWithdraw->isEmpty())
            <tr>
              <td colspan="20">KHÔNG CÓ DỮ LIỆU</td>
            </tr>
            @else
            @forEach($ctWithdraw->sortByDesc('created_at') as $level)
            <tr>
              <td data-label="Id."><span class="text-secondary">{{ $level->id }}</span></td>
              <td data-label="Số tiền">${{ $level->amount - ($level->amount*$level->costs/100) }} {{ $level->costs > 0 ? $level->amount*$level->costs/100 .'$ (phí)' : ''}}</td>
              <td data-label="Phí rút">{{ $level->costs }}%</td>
              <td data-label="Kiểu rút">{!! $level->type == 0 ? '<span class="badge bg-muted text-muted-fg">Bình thường</span>' : '<span class="badge bg-blue text-blue-fg">Nhanh</span>' !!}</td>
              <td data-label="Ngày rút">{{ $level->created_at }}</td>
              <td data-label="Ngày thanh toán">{{ $level->status == 2 ? $level->paid_at : date('Y-m-d H:i:s', strtotime($level->created_at . ' +7 days')). ' (Dự kiến)' }}</td>
              <td data-label="Tài khoản rút">{{ ($level->payment_method == 'momo' ? 'Momo' : $level->payment_bank_name).' - '.$level->payment_account_number.' - '.$level->payment_account_name}}</td>
              <td data-label="Trạng thái">
                @if ($level->status == 1)
                <span class="badge bg-blue text-blue-fg">Đã xem xét</span>
                @elseif ($level->status == 2)
                <span class="badge bg-green text-green-fg">Thành công</span>
                @elseif ($level->status == 3)
                <span class="badge bg-red text-red-fg">Từ chối</span>
                @elseif ($level->status == 4)
                <span class="badge bg-dark text-dark-fg">Liên hệ</span>
                @elseif ($level->status == 0)
                <span class="badge bg-yellow text-yellow-fg">Đang xử lý</span>
                @endif
              </td>
              <td data-label="">
                <div class="btn-list flex-nowrap">
                  <div class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                      Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                      <a class="dropdown-item" href="{{ route('admin.invoices.pending', $level->id) }}">
                        Trạng thái: Đang xử lý
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.invoices.watched', $level->id) }}">
                        Trạng thái: Đã xem xét
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.invoices.success', $level->id) }}">
                        Trạng thái: Thành công
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.invoices.refuse', $level->id) }}">
                        Trạng thái: Từ chối
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.invoices.contact', $level->id) }}">
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

      </div>
    </div>
  </div>
</div>


<script>
  // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();

    function dateYYYYMMDD(date) {
      return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
    }
    function paramExists(name) {
        const searchParams = new URLSearchParams(window.location.search);
        return searchParams.has(name);
    }
    function getQueryParams() {
          const params = {};
          window.location.search.substring(1).split('&').forEach(param => {
              const [key, value] = param.split('=');
              params[key] = decodeURIComponent(value);
          });
          return params;
      }

    const queryParams = getQueryParams();
    const startDate = queryParams.startDate || dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), 1));
    const endDate = queryParams.endDate || dateYYYYMMDD(today);

    window.Litepicker && (new Litepicker({
      element: document.getElementById('datepicker-stats-user'),
      autoApply: false,
      singleMode: false,
      buttonText: {
        apply: "Áp dụng",
        cancel: "Huỷ",
        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
      },
      plugins: ['keyboardnav', 'mobilefriendly', 'ranges'],
      ranges: {
        customRangesLabels: ["Hôm nay", "Hôm qua", "7 ngày qua", "30 ngày qua", "Tháng này", "Tháng trước"]
      },
      startDate: startDate,
      endDate: endDate,
      minDate: new Date('{{ $user->created_at }}'),
      setup: (picker) => {
        picker.on('button:apply', (start, end) => {
          const startDateSelected = start.format('YYYY-MM-DD');
          const endDateSelected = end.format('YYYY-MM-DD');
          const search = new URLSearchParams(window.location.search);

          if (paramExists('startDate')) {
              search.set('startDate', startDateSelected);
          } else {
              search.append('startDate', startDateSelected);
          }

          if (paramExists('endDate')) {
              search.set('endDate', endDateSelected);
          } else {
              search.append('endDate', endDateSelected);
          }

          window.location.href = `${window.location.pathname}?${search.toString()}`;
        });
      },
      format: 'YYYY/M/D',
      lang: 'vi'
    }));
  });
  // @formatter:on
</script> 