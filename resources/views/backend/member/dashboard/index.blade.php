@extends('layouts.member')

@section('title', __('overview.title'))

@section('content')
    <p class="note">Theo dõi kênh <b>Telegram</b> chính thức của <b>Link4Sub</b> để cập nhật thông tin mới nhất về những
        thay đổi trên trang web trong
        thời gian sắp tới! <a style="color: red" href='https://t.me/link4sub_official' target="_blank">[Tham gia]</a></p>

    <div class="container-anal">
        <div class="box-anal">
            <div class="box-anal-left">
                <i class="bi bi-eye-fill"></i>
            </div>
            <div class="box-anal-right">
                <div class="box-anal-body">
                    <div class="body-number">{{ $statistic['total_clicks'] }}</div>
                    <div class="box-anal-tilte">{{ __('overview.view') }}</div>
                </div>
            </div>
        </div>
        <div class="box-anal">
            <div class="box-anal-left">
                <i class="bi bi-wallet-fill"></i>
            </div>
            <div class="box-anal-right">
                <div class="box-anal-body">
                    <div class="body-number">${{ $statistic['total_revenue'] }}</div>
                    <div class="box-anal-tilte">{{ __('overview.revenue') }}</div>
                </div>
            </div>
        </div>
        <div class="box-anal">
            <div class="box-anal-left">
                <i class="bi bi-percent"></i>
            </div>
            <div class="box-anal-right">
                <div class="box-anal-body">
                    <div class="body-number">${{ $statistic['cpm'] }}</div>
                    <div class="box-anal-tilte">{{ __('overview.cpm') }}</div>
                </div>
            </div>
        </div>
        <div class="box-anal">
            <div class="box-anal-left">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="box-anal-right">
                <div class="box-anal-body">
                    <div class="body-number">0</div>
                    <div class="box-anal-tilte">{{ __('overview.ref_income') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-megaphone"></i></div>
                <div class="title">{{ __('overview.notification') }}</div>
            </div>
        </div>
        <div class="box-container">
            <div class="content">
                <style>
                    .notif-body-row {
                        display: flex;
                        flex-wrap: wrap;
                        border: 1px solid var(--border-color);
                        border-radius: 6px;
                        margin: 10px 0;
                    }

                    @media (min-width: 768px) {
                        .col-md-6 {
                            flex: 0 0 50%;
                        }

                        .notif-body-row {
                            margin: 10px;
                        }
                    }
                </style>
                <div class="notif-content-body">
                    <div class="notif-body-row">
                        <div class="col-12 mb-3">
                            <div class="bg-ymn-1 p-3 rounded">
                                <ul>
                                    <li>
                                        <p>
                                            <strong>Có gì mới ở Link4Sub vào tháng 6?</strong><br>
                                            Truy cập <a href="https://8link.io/" target="_blank">8link.io</a> để trải nghiệm
                                            website rút gọn link kiếm tiền mới.
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="notif-body-row">
                        <div class="col-12 col-md-6 mb-3 d-flex">
                            <div class="bg-ymn-1 p-3 rounded">
                                <ul>
                                    <li>
                                        <p>
                                            <strong>Khuyến mãi 🔥🔥🔥</strong><br>
                                            Chương trình đua TOP hàng tuần, hàng tháng &amp; quay thưởng ngẫu nhiên
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <strong>Top tuần</strong>
                                        </p>
                                        <ul class="mb-3">
                                            <li>Top 1️⃣ view: 2 triệu + 5% số view tuần</li>
                                            <li>Top 2️⃣ view: 1 triệu + 5% số view tuần</li>
                                            <li>Top 3️⃣ view: 500k + 5% số view tuần</li>
                                            <li>Top 4️⃣-&gt; 🔟: mỗi giải 300k</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <p>
                                            <strong>Top tháng</strong>
                                        </p>
                                        <ul>
                                            <li>Top 1️⃣ view: 5 triệu + 8% số view tháng</li>
                                            <li>Top 2️⃣ view: 3 triệu + 6% số view tháng</li>
                                            <li>Top 3️⃣ view: 2 triệu + 4% số view tháng</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3 d-flex">
                            <div class="bg-ymn-1 p-3 rounded">
                                <ul>
                                    <li>
                                        <p><strong>Quy định rút tiền</strong></p>
                                        <ul class="mb-3">
                                            <li>Hệ thống kiểm duyệt và thanh toán vào thứ 3 hàng tuần. Đặt lệnh trước 15h để
                                                được thanh toán trong ngày.</li>
                                            <li>Min rút là <strong>100.000₫</strong> về ví <strong>Ngân hàng</strong> hoặc
                                                <strong>Momo</strong>.
                                            </li>
                                            <li>Nếu bạn có 1 lệnh rút chưa thanh toán, và bạn tiếp tục rút thêm 1 lệnh mới
                                                thì sẽ cộng dồn vào lệnh cũ.</li>
                                            <li>Chúng tôi <strong>không giải quyết</strong> các vấn đề các bạn điền
                                                <strong>sai số tài khoản</strong>, nên hãy kiểm tra kỹ trước khi xác nhận.
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <p>
                                            <strong>Quy định và mức thưởng</strong>
                                        </p>
                                        <ul>
                                            <li>Chính sách hoa hồng hấp dẫn, người bạn giới thiệu có 1 lượt nhập mã thành
                                                công thì bạn được <strong>+50 đ</strong>, xem chi tiết <a
                                                    href="/quangly/?hoahong=349006dcb292d32b6c6f09e6866cbe13">TẠI ĐÂY</a>
                                            </li>
                                            <li>Mức thưởng hiện tại: <strong>600,000đ/1000</strong> view, 3 view / thiết bị
                                                / IP / ngày.</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="notif-body-row">
                        <div class="col-12 mb-3">
                            <div class="bg-ymn-1 p-3 rounded">
                                <ul>
                                    <li>
                                        <p><strong>Chính sách khóa tài khoản</strong></p>
                                        <ul>
                                            <li>Thành viên cố tình gian lận faker ip (1.1.1.1, vpn,.. v.v).</li>
                                            <li>Cố tình sử dụng nhiều thiết bị để tự vượt link.</li>
                                            <li>Không được để liên kết 18+.</li>
                                            <li>Tạo nhiều tài khoản để tự REF cho tài khoản chính.</li>
                                            <li>Nguồn truy cập vào liên kết mà bạn chia sẻ phải sạch.</li>
                                        </ul>
                                        <p>Các thành viên vi phạm, tuỳ vào trường hợp có thể bị cảnh cáo lần đầu hoặc sẽ bị
                                            xoá tài khoản vĩnh viễn.</p>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{ __('overview.notifcontent') }}
            </div>
        </div>
    </div>


    <div class="box">
        <div class="box-top">
            <div class="top-left">
                <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="title">{{ __('overview.report') }}</div>
            </div>
            <div class="top-right">
                <select class="select-month" id="month">
                    @foreach ($statistic['options'] as $option)
                        <option value="{{ $option['value'] }}" {{ $option['selected'] ? 'selected' : '' }}>
                            {{ $option['text'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="box-container">
            <div class="content">

                <div class="dataTable">

                    <div class="dataTable-table" style="max-height: 450px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('overview.dates') }}</th>
                                    <th>{{ __('overview.views') }}</th>
                                    <th>{{ __('overview.incomes') }}</th>
                                    <th>{{ __('overview.ref_incomes') }}</th>
                                    <th>{{ __('overview.cpms') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $time = $statistic['time'];
                                    $report = $statistic['report'];
                                @endphp

                                @if (count($report))
                                    @foreach (range(1, $time['total_days']) as $i)
                                        @php
                                            if ($i < 10) {
                                                $i = '0' . $i;
                                            }

                                        @endphp
                                        <tr>
                                            <td style="white-space: nowrap">
                                                {{ $time['year'] }}-{{ $time['month'] }}-{{ $i }}</td>
                                            @php
$key = "{$time['year']}-{$time['month']}-{$i}";
$data = isset($report[$key]) ? $report[$key] : null;
    @endphp
                                            @if ($data)
                                                @php
                                                    $cpm =
                                                        $data['clicks'] > 0 ? ($data['revenue'] / $data['clicks']) * 1000 : 0;
                                                @endphp
                                                <td>{{ $data['clicks'] }}</td>
                                                <td>${{ round($data['revenue'], 3) }}</td>
                                                <td>$0</td>
                                                <td>${{ round($cpm, 3) }}</td>
                                            @else
                                                <td>0</td>
                                                <td>$0</td>
                                                <td>$0</td>
                                                <td>$0</td>
                                            @endif
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
                    <?php
                    // echo Helper::pagination($curr_page, $total_pages, $total_records, $per_page, $offset)
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        const s = document.getElementById("month");
        s.addEventListener("change", function() {
            window.location.href = s.value;
        });
    </script>
@endsection
