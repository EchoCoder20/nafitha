document.addEventListener('DOMContentLoaded', function () {
    const sendButton = document.getElementById('send-btn');
    const userInput = document.getElementById('user-input');
    const chatWindow = document.getElementById('chat-window');
    const startNow = document.getElementById('start-test');
    const typingAnimation = document.getElementById('typing-animation');

    function sendMessage() {
        const message = userInput.value.trim();

        if (message == '') {
            const userMessage = `<div class="message user-message"><div class="message-bubble">${message}</div></div>`;
            chatWindow.innerHTML += userMessage;

            userInput.value = '';

            chatWindow.scrollTop = chatWindow.scrollHeight;

            typingAnimation.style.display = 'flex';

            setTimeout(() => {
                typingAnimation.style.display = 'none'; 
                
                const botMessage = `<div class="message murshid-message"><div class="message-bubble murshid-bubble">
                    مرحباً! 👋<br> 
                    أنا مرشد. مساعدك الشخصي في اكتشاف شغفك واختيار التخصص الأنسب لك. أنا هنا لمساعدتك في معرفة ميولك وإرشادك نحو مستقبلك المهني. دعنا نبدأ الاختبار لتحديد اهتماماتك وشغفك الحقيقي. هل أنت مستعد؟
                    <button class="start-btn">ابدأ الاختبار الآن</button>
                </div></div>`;
                chatWindow.innerHTML += botMessage;
                
                chatWindow.scrollTop = chatWindow.scrollHeight;
            }, 2000);
        }
    }

  
    startNow.addEventListener('click', sendMessage());
 

    // start-btn.addEventListener('click',function(){

    // });

});
