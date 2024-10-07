<link rel="stylesheet" href="{{asset('assets/css/contactus.css')}}"> 
<link rel="stylesheet" href="{{asset('assets/css/otherpages.css')}}">
@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="contact-form">
            <form>
                <div class="row">
                    <div class="input-group">
                        <label for="first-name">الاسم الأول</label>
                        <input type="text" id="first-name" name="first-name">
                    </div>
                    <div class="input-group">
                        <label for="last-name">اسم العائلة</label>
                        <input type="text" id="last-name" name="last-name">
                    </div>
                </div>
    
                <div class="row">
                    <div class="input-group">
                        <label for="phone">رقم الهاتف</label>
                        <input type="text" id="phone" name="phone">
                    </div>
                    <div class="input-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email">
                    </div>
                </div>
    
                <div class="input-group">
                    <label for="message">الرسالة</label>
                    <textarea id="message" name="message" placeholder="اكتب رسالتك هنا..."></textarea>
                </div>
    
                <button type="submit" class="send-button">إرسال الرسالة</button>
    
                <img src="{{asset('photo/sendimage.png')}}" alt="Send Image" class="send-image">
            </form>
        </div>
    
        <div class="contact-info">
            <h2>معلومات الاتصال</h2>
            <p>قل شيئا لبدء الدردشة المباشرة!</p>
            <ul>
                <li><img src="{{asset('photo/phone-call.png')}}"> +0000000000</li>
                <li><img src="{{asset('photo/email.png')}}"> nafitaha@gmail.com</li>
                <li><img src="{{asset('photo/linkedin.png')}}"> #LinkedIn URL</li>
            </ul>
          
    
            <div class="circle-big"></div>
            <div class="circle-small"></div>
        </div>
    </div>
    


@endsection
