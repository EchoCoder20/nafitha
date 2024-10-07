<link rel="stylesheet" href="{{asset('assets/css/auth.css')}}"> 
<link rel="stylesheet" href="{{asset('assets/css/otherpages.css')}}">
@extends('layouts.app')
@section('content')
    <section class="signup-section">
        <div class="login-shape">
    
            <!-- signup Form  -->
            <div class="login-form">
                <h2>إنشاء حساب جديد</h2>
                <form action="{{asset('submit_login.php')}}" method="POST">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" placeholder="ادخل بريدك الإلكتروني" required>
    
                    <label for="password">كلمة المرور</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="ادخل كلمة المرور" required>
                        <span class="toggle-password" onclick="togglePassword()">
                            <img src="{{asset('photo/eye-icon.png')}}" alt="Toggle Password Visibility">
                        </span>
                    </div>

                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder=" ادخل كلمة المرور مرة أخرى" required>
                        <span class="toggle-password" onclick="togglePassword()">
                            <img src="{{asset('photo/eye-icon.png')}}" alt="Toggle Password Visibility">
                        </span>
                    </div>
                    <label for="email">معلومات المدرسة</label>
                    <input type="email" id="email" name="email" placeholder="اختر مدرستك" required>

                    <label for="email">ادخل الكود الخاص بالمدرسة</label>
                    <input type="email" id="email" name="email" placeholder="ادخل الكود " required>

                    <button type="submit" class="login-btn">تسجيل حساب جديد</button>
                    <p class="create-account"> لديك حساب؟ <a href="login.html">قم بتسجيل الدخول</a></p>
                </form>
            </div>
    
            <!-- <div class="image-container">
                <img src="photo/auth_icon.PNG" class="icon-image" alt="Circle Icon Image">
                <img src="photo/auth.png" class="phone-image" alt="Phone Image">
            </div> -->
        </div>
    </section>
    
    

<!-- show/hide pass  -->
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
