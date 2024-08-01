@extends('layouts.member.auth')

@section('content')
<div class="container">
        <div class="auth-wrapper">
            <div class="auth-inner">
                <div class="form signup">
                    <div class="form-body">
        <span class="title">Đăng ký</span>
        @if ($errors->any())
            <div class="message">
                <p>{{ ($errors->all()[0]) }}</p>
            </div>
        @endif
        <form action="{{ route('auth.register') }}" method="post">
            @csrf
            <div class="input-field">
                <label>Tên đăng nhập <span style="color: #f1416c">*</span></label>
                <input type="text" name="name" placeholder="Nhập tên đăng nhập.." value="{{ old('name') }}" required>
                <i class="uil uil-user"></i>
            </div>
            <div class="input-field">
                <label>Địa chỉ Email <span style="color: #f1416c">*</span></label>
                <input type="email" name="email" placeholder="Nhập địa chỉ Email.." value="{{ old('email') }}" required>
                <i class="uil uil-envelope icon"></i>
            </div>
            <div class="input-field">
                <label>Mật khẩu <span style="color: #f1416c">*</span></label>
                <input type="password" name="password" class="password" placeholder="Nhập mật khẩu.." required>
                <i class="uil uil-lock icon"></i>
            </div>
            <div class="input-field">
                <label>Xác nhận mật khẩu <span style="color: #f1416c">*</span></label>
                <input type="password" name="password_confirmation" class="password" placeholder="Nhập lại mật khẩu.." required>
                <i class="uil uil-lock icon"></i>
                <i class="uil uil-eye-slash showHidePw"></i>
            </div>
            <div class="checkbox-text">
                <div class="checkbox-content">
                    <input type="checkbox" name="confirm" id="confirm">
                    <label for="confirm" class="text">Tôi chấp nhận tất cả các điều khoản và điều kiện.</label>
                </div>
            </div>
            <div class="input-field button">
                <input type="submit" name="submit" value="Đăng ký">
            </div>
        </form>
        <div class="login-signup">
            <span class="text">Đã có tài khoản?
                <a href="{{ route('auth.login') }}" class="text login-link">Đăng nhập</a>
            </span>
        </div>
    </div>
    </div>
    </div>
    </div>
</div>

    
@endsection