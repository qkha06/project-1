@extends('layouts.member.auth')

@section('content')
<div class="container">
    <div class="auth-wrapper">
        <div class="auth-inner">
            <div class="form login">
                <div class="form-body">
                    <span class="title">Đặt lại mật khẩu</span>
                    @if ($errors->any())
                    <div class="message wr">
                        <p>{{ ($errors->all()[0]) }}</p>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="message sc">
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif
                    <form action method="post">
                        @csrf
                        <input type="text" class="hidden" name="token" value="{{ $token }}">

                        <div class="input-field">
                            <label>Email <span style="color: #f1416c">*</span></label>
                            <input type="email" name="email" value="{{ $email }}" readonly="true" required>
                        </div>

                        <div class="input-field">
                            <label>New password <span style="color: #f1416c">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="input-field">
                            <label>Re-password <span style="color: #f1416c">*</span></label>
                            <input type="password" name="password_confirmation" required>
                        </div>
                        <div class="input-field button">
                            <input type="submit" name="submit" value="Submit">
                        </div>
                    </form>
                    <div class="login-signup">
                        <span class="text">Nhớ mật khẩu? <a href="{{ URL('/') }}/login" class="text signup-link">Đăng nhập</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection