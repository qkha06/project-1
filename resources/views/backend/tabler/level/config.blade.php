<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cấu hình: {{ $lvData->name }}</h3>
        <div class="card-actions">
            <a href="{{ route('admin.level.index') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg>
                Quay lại
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.level.store') }}" id="cfForm" method="POST">
            @csrf
            <div class="tab-container">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="direct-ad-tab" data-bs-toggle="pill"
                            data-bs-target="#direct-ad" type="button" aria-controls="direct-ad"
                            aria-selected="true">Direct AD</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="ad-1-tab" data-bs-toggle="pill" data-bs-target="#ad-1"
                            type="button">CLICK AD</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="ad-2-tab" data-bs-toggle="pill" data-bs-target="#ad-2"
                            type="button">STEP AD</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="banner-ad-tab" data-bs-toggle="pill" data-bs-target="#banner-ad"
                            type="button">BANNER AD</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="next-step-tab" data-bs-toggle="pill" data-bs-target="#next-step"
                            type="button">NEXT STEP</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="sticky-ad-tab" data-bs-toggle="pill" data-bs-target="#sticky-ad"
                            type="button">STICKEY AD</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="direct-ad" aria-labelledby="direct-ad-tab">
                        <div class="mb-3">
                            <div class="form-label">Kích hoạt</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" name="show" type="checkbox">
                                <span class="form-check-label">Bật/ tắt</span>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Thời gian (mils)</label>
                            <input type="number" name="time" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Liên kết</label>
                            <textarea class="form-control" placeholder="example.com, example2.com, example3.com..." data-parse-url="true"
                                name="arrUnit" style="min-height: 300px"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ad-1" aria-labelledby="ad-1-tab">
                        <div class="mb-3">
                            <div class="form-label">Kích hoạt</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" name="show" type="checkbox">
                                <span class="form-check-label">Bật/ tắt</span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vị trí</label>
                                <select class="form-select" name="position" aria-label="Default select example">
                                    <option selected>--Chọn nơi xuất hiện--</option>
                                    <option value="first">Đầu CTN</option>
                                    <option value="last">Cuối CTN</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vị trí trang</label>
                                <input type="number" name="page" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Biểu tượng</label>
                                <select class="form-select" name="icon" aria-label="Default select example">
                                    <option selected>--Chọn icon--</option>
                                    <option value="ad">ad</option>
                                    <option value="ytb">ytb</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phần tử quảng cáo</label>
                                <input type="text" name="select" class="form-control" input-data-type="array" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nhà cung cấp quảng cáo</label>
                                <select class="form-select" name="type-ad" aria-label="Default select example">
                                    <option selected>--Chọn provider--</option>
                                    <option value="qknetwork">adsbyqknetwork</option>
                                    <option value="adsense">adsense</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tỷ lệ xuất hiện</label>
                                <input type="number" name="display-ratio" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thời gian tồn tại (s)</label>
                                <input type="number" name="exist-time" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số lần click tối đa</label>
                                <input type="number" name="click-limit" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thời gian reset click (s)</label>
                                <input type="number" name="reset-time" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ad-2" aria-labelledby="ad-2-tab">
                        <div class="mb-3">
                            <div class="form-label">Kích hoạt</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" name="show" type="checkbox">
                                <span class="form-check-label">Bật/ tắt</span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vị trí</label>
                                <select class="form-select" name="position" aria-label="Default select example">
                                    <option selected="">--Chọn nơi xuất hiện--</option>
                                    <option value="first">Đầu CTN</option>
                                    <option value="last">Cuối CTN</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vị trí trang</label>
                                <input type="number" name="page" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Biểu tượng</label>
                                <select class="form-select" name="icon" aria-label="Default select example">
                                    <option selected="">--Chọn icon--</option>
                                    <option value="ad">ad</option>
                                    <option value="ytb">ytb</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tỷ lệ xuất hiện</label>
                                <input type="number" name="display-ratio" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thời gian tồn tại (s)</label>
                                <input type="number" name="exist-time" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số lần click tối đa</label>
                                <input type="number" name="click-limit" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thời gian reset click (s)</label>
                                <input type="number" name="reset-time" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Liên kết <span class="text-danger">(*)</span></label>
                            <textarea class="form-control" placeholder="example.com, example2.com, example3.com..." data-parse-url="true"
                                name="adUnits" style="min-height: 300px"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="banner-ad" aria-labelledby="banner-ad-tab">
                        <div class="mb-3">
                            <div class="form-label">Kích hoạt</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" name="show" type="checkbox">
                                <span class="form-check-label">Bật/ tắt</span>
                            </label>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nhà cung cấp</label>
                            <select class="form-select" name="type-ad" aria-label="Default select example">
                                <option selected="">--Chọn provider--</option>
                                <option value="qknetwork">adsbyqknetwork</option>
                                <option value="adsense">adsense</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unit <span class="text-danger">(*)</span></label>
                            <textarea class="form-control" placeholder="example.com, example2.com, example3.com..." data-obj="true"
                                name="unit" style="min-height: 300px"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="next-step" aria-labelledby="next-step-tab">
                        <div class="mb-3">
                            <div class="form-label">Kích hoạt</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" name="show" type="checkbox">
                                <span class="form-check-label">Bật/ tắt</span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Liên kết <span class="text-danger">(*)</span></label>
                            <textarea class="form-control" placeholder="example.com, example2.com, example3.com..." data-parse-url="true"
                                name="arrPost" style="min-height: 300px"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sticky-ad" aria-labelledby="sticky-ad-tab">
                        <div class="mb-3">
                            <div class="form-label">Kích hoạt</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" name="show" type="checkbox">
                                <span class="form-check-label">Bật/ tắt</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mb-3 text-start">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    const dataConfig = JSON.parse(@json(json_decode($lvData->config)));
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ URL('/') }}/js/cf.js"></script>
