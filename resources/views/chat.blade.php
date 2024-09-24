@extends('layouts.app')
@section('content')

    <!-- Chat Section -->
    <div class="chat-container">
        <div id="chat-window">
            <!-- Murshid's initial message -->
            <div class="message murshid-message">
                <div class="message-bubble murshid-bubble">
                    <p>مرحباً! 👋<br> 
                    أنا مرشد. مساعدك الشخصي في اكتشاف شغفك واختيار التخصص الأنسب لك. أنا هنا لمساعدتك في معرفة ميولك وإرشادك نحو مستقبلك المهني. دعنا نبدأ الاختبار لتحديد اهتماماتك وشغفك الحقيقي. هل أنت مستعد؟</p>
                    <button class="start-btn" id="start-test">ابدأ الاختبار الآن</button>
                </div>
                <img src="{{asset('photo/murshid_icon.png')}}" alt="Murshid Icon" class="chat-icon">
            </div>
           
            <div id="typing-animation" style="display: none;">
                <div class="typing-indicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- Input Area -->
        <div class="input-area">
            <input type="text" id="user-input" placeholder="Type a reply..." />
            <button id="send-btn"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
<script src="{{asset('assets/js/chat.js')}}"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
@endsection

