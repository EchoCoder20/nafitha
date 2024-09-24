@extends('layouts.app')
@section('content')
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="login-section">
        <div class="login-shape">
    
            <!-- Login Form  -->
            <div class="login-form">
                <h2>أهلاً بك مجدداً</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" placeholder="ادخل البريد الإلكتروني" required>
    
                    <label for="password">كلمة المرور</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="ادخل كلمة المرور" required>
                        <span class="toggle-password" onclick="togglePassword()">
                            <img src="{{asset('photo/eye-icon.png')}}" alt="Toggle Password Visibility">
                        </span>
                    </div>
                    
                    <button type="submit" class="login-btn">تسجيل الدخول</button>
                    <p class="create-account">ليس لديك حساب؟ <a href="{{ route('register') }}">انشئ حساب جديد الآن</a></p>
                </form>
            </div>
    
            <div class="image-container">
                <img src="{{asset('photo/auth_icon.PNG')}}" class="icon-image" alt="Circle Icon Image">
                <img src="{{asset('photo/auth.png')}}" class="phone-image" alt="Phone Image">
            </div>
        </div>
    </section>
    
    


<!-- hide/show pass  -->
<script>
    function togglePassword() {
    const passwordField = document.getElementById("password");
    const toggleIcon = document.querySelector(".toggle-password img");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.src = "{{asset('photo/open-eye.png')}}"; 
    } else {
        passwordField.type = "password";
        toggleIcon.src = "{{asset('photo/eye-icon.png')}}"; 
    }
}

</script>

@endsection