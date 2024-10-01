document.addEventListener('DOMContentLoaded', function () {
    const sendButton = document.getElementById('send-btn');
    const userInput = document.getElementById('user-input');
    const chatWindow = document.getElementById('chat-window');
    const typingAnimation = document.getElementById('typing-animation');
    let i = 0;

    function sendMessage() {
        const message = userInput.value.trim();

        if (message !== '') {
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
                    <button class="start-btn" id="start-test">ابدأ الاختبار الآن</button>
                </div></div>`;
                chatWindow.innerHTML += botMessage;
                chatWindow.scrollTop = chatWindow.scrollHeight;
            }, 2000);
        }
    }

    sendButton.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); 
            sendMessage();
        }
    });

    // Function to load the next question
    function sendInitQuestion() {
        $.ajax({
            type: 'GET',
            url: '/nextQuestion/' + i,
            success: function(data) {
                setTimeout(() => {
                    typingAnimation.style.display = 'none'; 
                    let optionsHtml = '';
        
                    data.options.forEach((option, index) => {
                        optionsHtml += `
                            <div>
                                <input type="radio" id="option${index}" name="options" value="${option}">
                                <label for="option${index}">${option}</label>
                            </div>
                        `;
                    });
                    const botMessage = `<div class="message murshid-message">
                        <div class="message-bubble murshid-bubble">
                            ${data.msg}<br> 
                            ${optionsHtml} 
                        </div>
                    </div>`;
                    chatWindow.innerHTML += botMessage;
                    chatWindow.scrollTop = chatWindow.scrollHeight;
                }, 2000);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    // Event delegation to handle dynamically created start button
    $(document).on('click', '#start-test', function() {
        sendInitQuestion(); // Start the test when the button is clicked
    });

    // Event delegation for dynamically created radio buttons
    $(document).on('click', 'input[name="options"]', function() {
        var selectedOption = $(this).val();  // Get the selected option
        
        $.ajax({
            type: 'POST',
            url: '/submitAnswer',
            data: {
                option: selectedOption,
                _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token from meta tag
            },
            success: function(response) {
                console.log(response);
                if(i<6){
                    i++;
                    sendInitQuestion();
                }
                  // Load next question
                else
                marks();
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    });
    function marks()
    {
        
    }
});
