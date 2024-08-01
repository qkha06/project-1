<div class="row row-deck row-cards">

  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Lọc</h3>
          <div class="row justify-content-between">
            <div class="col-8 d-flex">
              <div class="input-icon">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                </span>
                <input class="form-control pe-0" placeholder="Select a date" id="datepicker-start"/>
              </div>
              <div class="mx-5"></div>
              <div class="input-icon">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                </span>
                <input class="form-control pe-0" placeholder="Select a date" id="datepicker-end"/>
              </div>
            </div>
  
            <div class="col-4 col-lg-2 d-flex gap-2">
              <a href="#" class="btn btn-primary btn-square w-100">
                Reset
              </a>
              <a href="#" class="btn btn-primary btn-square w-100">
                Lọc
              </a>
              {{-- <select class="form-select">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select> --}}
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-5 align-items-center d-flex">
              Group by:
            </div>
            <div class="col-7">
              <div class="btn-group w-100" role="group">
                <input type="radio" class="btn-check" name="btn-radio-basic" id="btn-radio-basic-1" autocomplete="off" checked="">
                <label for="btn-radio-basic-1" type="button" class="btn">DATE</label>
                <input type="radio" class="btn-check" name="btn-radio-basic" id="btn-radio-basic-2" autocomplete="off">
                <label for="btn-radio-basic-2" type="button" class="btn">USER</label>
                <input type="radio" class="btn-check" name="btn-radio-basic" id="btn-radio-basic-3" autocomplete="off">
                <label for="btn-radio-basic-3" type="button" class="btn">Referral</label>
                <input type="radio" class="btn-check" name="btn-radio-basic" id="btn-radio-basic-4" autocomplete="off">
                <label for="btn-radio-basic-4" type="button" class="btn">Country</label>
                <input type="radio" class="btn-check" name="btn-radio-basic" id="btn-radio-basic-5" autocomplete="off">
                <label for="btn-radio-basic-5" type="button" class="btn">Device</label>
                <input type="radio" class="btn-check" name="btn-radio-basic" id="btn-radio-basic-5" autocomplete="off">
                <label for="btn-radio-basic-5" type="button" class="btn">Platform</label>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-flex">
          <h3 class="card-title">Số liệu thống kê</h3>
          {{-- <td>{{ dd($accessData) }}</td> --}}

        </div>
      </div>
      <div class="table-responsive border-top">
        <table class="table table-vcenter card-table table-striped">
          <thead>
            <tr>
              <th>Stt.</th>
              <th>Người dùng</th>
              <th>Lượt xem</th>
              <th>Thu nhập</th>
              <th>CRM</th>
              <th>Referral</th>
              <th class="w-1"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($accessData as $key=>$val)
            <tr>
              <td>{{ ++$key }}</td>
              <td>
                <span class="badge badge-outline text-blue">{{ $val->user->name ?? 'anonymous' }}</span></td>
              <td>{{ $val->clicks }}</td>
              <td>${{ round($val->revenue, 3) }}</td>
              <td>${{ round($val->revenue/$val->clicks*1000, 3) }}</td>
              <td>{{ $val->label }}</td>
              <td>
                <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Báo cáo chi tiết" data-bs-original-title="Báo cáo chi tiết">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path><path d="M18 14v4h4"></path><path d="M18 11v-4a2 2 0 0 0 -2 -2h-2"></path><path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M8 11h4"></path><path d="M8 15h3"></path></svg>
                </a>
              </td>
            </tr>
            @endforeach
          
          </tbody>
        </table>
      </div>

      <div class="card-footer d-flex align-items-center">
        {{ $accessData->links('pagination.tabler') }}
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

    document.getElementById('datepicker-start').value = startDate;
    document.getElementById('datepicker-end').value = endDate;

    window.Litepicker && (new Litepicker({
      element: document.getElementById('datepicker-start'),
      autoApply: false,
      buttonText: {
        apply: "Áp dụng",
        cancel: "Huỷ",
        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
      },
      plugins: ['keyboardnav', 'mobilefriendly'],
      ranges: {
        customRangesLabels: ["Hôm nay", "Hôm qua", "7 ngày qua", "30 ngày qua", "Tháng này", "Tháng trước"]
      },
      setup: (picker) => {
        picker.on('button:apply', (start) => {
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
      lang: 'vi'
    }));
    window.Litepicker && (new Litepicker({
      element: document.getElementById('datepicker-end'),
      autoApply: false,
      buttonText: {
        apply: "Áp dụng",
        cancel: "Huỷ",
        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
      },
      plugins: ['keyboardnav', 'mobilefriendly'],
      ranges: {
        customRangesLabels: ["Hôm nay", "Hôm qua", "7 ngày qua", "30 ngày qua", "Tháng này", "Tháng trước"]
      },
      setup: (picker) => {
        picker.on('button:apply', (start) => {
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
      lang: 'vi'
    }));
  });
  // @formatter:on
</script>