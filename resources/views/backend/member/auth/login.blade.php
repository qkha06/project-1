@extends('layouts.member.auth')

@section('content')
<div class="container">
    <div class="auth-wrapper">
        <div class="auth-inner">
            <div class="form login">
                <div class="form-body">
                    <span class="title">Đăng nhập</span>
                    @if ($errors->any())
                        <div class="message">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if (session('success'))
                    <div class="message sc">
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif
                    <form action="{{ route('auth.login') }}" method="post">
                        @csrf
                        <div class="input-field">
                            <label>Tên tài khoản hoặc Email <span style="color: #f1416c">*</span></label>
                            <input type="text" name="name" placeholder="Vd: join123@gmail.com" value="{{ old('name') }}" required>
                        </div>
                        <div class="input-field">
                            <label>Mật khẩu <span style="color: #f1416c">*</span></label>
                            <input type="password" class="password" name="password" placeholder="Nhập mật khẩu của bạn.." required>
                            <i class="showHidePw bi bi-eye-fill"></i>
                        </div>
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input id="remember" accept=""type="checkbox" name="remember">
                                <label for="remember" class="text">Ghi nhớ</label>
                            </div>

                            <a href="{{ route('auth.password.request') }}" class="text">Quên mật khẩu?</a>
                        </div>
                        <div class="input-field button">
                            <input type="submit" name="submit" value="Đăng nhập">
                        </div>
                    </form>
                    <div class="login-signup">
                        <span class="text">Chưa có tài khoản? <a href="{{ route('auth.register') }}" class="text signup-link">Đăng ký</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<svg style="display: none;">
    <symbol id="user">
        <path d="M12.12 12.78C12.05 12.77 11.96 12.77 11.88 12.78C10.12 12.72 8.71997 11.28 8.71997 9.50998C8.71997 7.69998 10.18 6.22998 12 6.22998C13.81 6.22998 15.28 7.69998 15.28 9.50998C15.27 11.28 13.88 12.72 12.12 12.78Z"></path>
        <path d="M18.74 19.3801C16.96 21.0101 14.6 22.0001 12 22.0001C9.40001 22.0001 7.04001 21.0101 5.26001 19.3801C5.36001 18.4401 5.96001 17.5201 7.03001 16.8001C9.77001 14.9801 14.25 14.9801 16.97 16.8001C18.04 17.5201 18.64 18.4401 18.74 19.3801Z"></path>
        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"></path>
    </symbol>
</svg>
<script>
    
const pwdShowHide = document.querySelectorAll(".showHidePw");
const pwdField = document.querySelectorAll(".password");

pwdShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        pwdField.forEach(field => {
            const typePwd = field.type === "password";
            field.type = typePwd ? "text" : "password";
            eyeIcon.classList.toggle("bi-eye-fill", !typePwd);
            eyeIcon.classList.toggle("bi-eye-slash-fill", typePwd);
        });
    });
});

</script>
@endsection