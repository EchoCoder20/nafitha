document.addEventListener('DOMContentLoaded', function () {
    const sendButton = document.getElementById('send-btn');
    const userInput = document.getElementById('user-input');
    const chatWindow = document.getElementById('chat-window');
    const typingAnimation = document.getElementById('typing-animation');
    const examBox = document.getElementById('exam-box');



/////////////////////////
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
                chatResponse(message);
               

                // const startButton = document.querySelector('.start-btn');
                // startButton.addEventListener('click', function() {
                //     examBox.style.display = 'block'; 
                // });
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
});

const userInput = document.getElementById('user-input');

function autoResize() {
    this.style.height = 'auto'; 
    this.style.height = Math.min(this.scrollHeight, parseFloat(getComputedStyle(this).maxHeight)) + 'px'; 
}

userInput.addEventListener('input', autoResize);







// الاختبار

const questions = [
    {
        question: "السؤال الأول: ما هو إختيارك لمسارك الدراسي في الصف الثاني عشر؟",
        options: [
            "علمي",
            "أدبي",
           
        ]
    },
    {
        question: "السؤال الثاني: ما هي المادة الدراسية التي تشعر بأنها الأسهل بالنسبة لك؟",
        options: [
            "الرياضيات أو الفيزياء.",
            "الأدب أو الفن.",
            "العلوم أو الأحياء.",
            "التاريخ أو الدراسات الاجتماعية."
        ]
    },
    {
        question: "السؤال الثالث: ما هو نوع النشاط الذي تفضل القيام به في وقت فراغك؟",
        options: [
            "ممارسة الرياضة أو التمارين البدنية",
            "القراءة أو الكتابة",
            "استخدام وسائل التواصل الاجتماعي",
            "اللعب أو تطوير ألعاب الفيديو",
            "العمل على مشاريع فنية أو يدوية"
        ]
    },
    {
        question: "السؤال الرابع: ما هو دورك المفضل في العمل الجماعي؟",
        options: [
            "قائد الفريق ومنسق المهام",
            "الباحث وجامع المعلومات",
            "المبدع وصاحب الأفكار الجديدة",
            "المنفذ والمسؤول عن إتمام العمل",
            "المقدم والعارض للمشروع النهائي"
        ]
    },
    {
        question: "السؤال الخامس: كيف تتعامل مع التحديات؟",
        options: [
            "أبحث عن حلول منطقية تستند إلى البيانات.",
            "أفكر في حلول جديدة ومبتكرة.",
            "أستعين بخبرات الآخرين وأعمل ضمن فريق.",
            "أقوم بالتخطيط بعناية وأحلل جميع الخيارات."
        ]
    },
    
    

    {
        question: "السؤال السادس: ما هو أسلوب العمل الذي تفضله؟",
        options: [
            "العمل بشكل مستقل مع مسؤولية فردية",
            "العمل ضمن فريق متعاون",
            "مزيج من العمل الفردي والجماعي",
            "العمل تحت إشراف وتوجيه مباشر",
            "العمل في بيئة تنافسية"
        ]
    },

    {
        question: "السؤال السابع: كيف تقيم مهاراتك في التواصل والتعبير عن الأفكار؟",
        options: [
            "ممتاز في التواصل الشفهي والكتابي",
            "جيد في التواصل الشفهي، أقل كفاءة في الكتابة",
            "أفضل في التعبير الكتابي عن الشفهي",
            "أجيد التواصل من خلال الوسائط المرئية والرقمية",
            "بحاجة إلى تطوير مهارات التواصل بشكل عام"
        ]
    },
    
    {
        question: "السؤال الثامن: ما الذي يجعلك تشعر بالإنجاز والرضا؟",
        options: [
            "حل مشكلة معقدة أو إكمال مشروع علمي",
            "إنتاج عمل فني أو أدبي يحظى بالتقدير",
            "تطوير تطبيق أو حل تقني مفيد",
            "مساعدة الآخرين وإحداث تأثير إيجابي في المجتمع",
            "تحقيق نجاح أكاديمي أو مهني ملموس"
        ]
    },
    {
        question: "السؤال التاسع: كيف تفضل التعلم عن موضوع جديد يهمك؟",
        options: [
            "مشاهدة فيديوهات تعليمية على الإنترنت",
            "قراءة كتب أو مقالات عن الموضوع",
            "التحدث مع خبراء أو أشخاص ذوي خبرة",
            "التجربة العملية والتعلم من خلال الممارسة",
            "حضور ورش عمل أو دورات تدريبية"
        ]
    },
    {
        question: "السؤال العاشر: ما هو نوع البيئة التي تتخيل نفسك تعمل فيها بعد التخرج؟",
        options: [
            "مكتب تقليدي في شركة كبيرة",
            "بيئة إبداعية مثل استوديو تصميم",
            "العمل الميداني والتنقل",
            "العمل من المنزل أو عن بعد",
            "مختبر علمي أو مركز أبحاث"
        ]
    },
    
];



let currentQuestion = 0;

    function loadQuestion(index) {
        if (index < questions.length) {
            document.querySelector(".question-text").innerText = questions[index].question;
            const choices = document.querySelector(".choices");
            choices.innerHTML = "";
            questions[index].options.forEach((answer) => {
                choices.innerHTML += `<label><input type="radio" id="user_answer" name="question${index + 1}" value="${answer}"> ${answer}</label><br>`;
            });
            document.getElementById("next-btn").disabled = true; 

            const progressPercent = ((index + 1) / questions.length) * 100;
            document.getElementById("progress").style.width = progressPercent + "%";
        } else {
            document.querySelector(".exam-container").innerHTML = `
                <div class="completion-container">
                    <i class="fas fa-check-circle check-icon"></i>
                    <h2>شكرًا لإتمامك الاختبار!</h2>
                    <p>لقد أنهيت من المرحلة الأولى . يرجى النقر على الزر أدناه للانتقال إلى المرحلة التالية وإدخال المواد والدرجات.</p>
                    <button id="next-stage-btn" class="start-btn">انتقل للمرحلة الثانية</button>
                </div>
            `;
        document.getElementById('next-stage-btn').addEventListener('click', function() {
            
            saveQuestions();
 // إخفاء شاشة الانتهاء من الاختبار
        document.querySelector('.completion-container').style.display = 'none';
        document.querySelector('.exam-container').style.display = 'none';


 // إظهار المرحلة الثانية
           document.getElementById('second-stage').style.display = 'block';     
           
        
        
                     });
                 }
              }
    
document.getElementById("next-btn").addEventListener("click", () => {
    const Question=questions[currentQuestion].question;
    const userInput =  document.querySelector(`input[name="question${currentQuestion + 1}"]:checked`);

    if (currentQuestion < questions.length - 1) {
        currentQuestion++;
        loadQuestion(currentQuestion);
        document.getElementById("back-btn").style.display = currentQuestion > 0 ? "inline" : "none";
    } else {
        loadQuestion(questions.length);
    }
    submitAnswer(Question,userInput.value);
});

document.getElementById("back-btn").addEventListener("click", () => {
    if (currentQuestion > 0) {
        removeAnswer(currentQuestion);
        currentQuestion--;
        loadQuestion(currentQuestion);
        document.getElementById("back-btn").style.display = currentQuestion > 0 ? "inline" : "none";
    }
    
});

document.querySelector(".choices").addEventListener("change", () => {
    document.getElementById("next-btn").disabled = false;
});

loadQuestion(currentQuestion);



///start exam 

    const startTestBtn = document.getElementById('start-test-btn');
    const murshidMessage = document.getElementById('murshid-message');
    const examBox = document.getElementById('exam-box');

    startTestBtn.addEventListener('click', function() {
        murshidMessage.style.display = 'none';
        
        examBox.style.display = 'block';
    });


function validateGrades() {
    const subjectRows = document.querySelectorAll('.subject-row');
    const selectedSubjects = new Set();

    for (let row of subjectRows) {
        const dropdown = row.querySelector('.subject-dropdown');
        const gradeInput = row.querySelector('.grade-input');

        const selectedSubject = dropdown.value;
        const grade = gradeInput.value;

        // التحقق من اختيار مادة
        if (!selectedSubject) {
            alert('يرجى اختيار مادة.');
            return false; 
        }

        // التحقق من عدم تكرار المواد
        if (selectedSubjects.has(selectedSubject)) {
            alert('يجب اختيار مواد مختلفة.');
            return false;
        }
        selectedSubjects.add(selectedSubject);

        // التحقق من أن الدرجة بين 0 و 100
        if (grade === '' || grade < 0 || grade > 100 || isNaN(grade)) {
            alert('يجب أن تكون الدرجة بين 0 و 100.');
            return false; 
        }
    }

    return true; 
}


   
//عرض النتيجة
document.getElementById('submit-info-btn').addEventListener('click', function() {
    $first_sub=document.getElementById("first_sub");
    $first_mark=document.getElementById("first_mark");
    $two_sub=document.getElementById("two_sub");
    $two_mark=document.getElementById("two_mark");
    $third_sub=document.getElementById("third_sub");
    $third_mark=document.getElementById("third_mark");
    $four_sub=document.getElementById("four_sub");
    $four_mark=document.getElementById("four_mark");
    $five_sub=document.getElementById("five_sub");
    $five_mark=document.getElementById("five_mark");
    $six_sub=document.getElementById("six_sub");
    $six_mark=document.getElementById("six_mark");
    $seven_sub=document.getElementById("seven_sub");
    $seven_mark=document.getElementById("seven_mark");
    $eight_sub=document.getElementById("eight_sub");
    $eight_mark=document.getElementById("eight_mark");
    $nine_sub=document.getElementById("nine_sub");
    $nine_mark=document.getElementById("nine_mark");
    marks = [
        {
         [$first_sub.value]: $first_mark.value
        },
        {
         [$two_sub.value]: $two_mark.value
        },
        {
         [$third_sub.value]: $third_mark.value
        },
        {
         [$four_sub.value]: $four_mark.value
        },
        {
         [$five_sub.value]: $five_mark.value
        },
        {
         [$six_sub.value]: $six_mark.value
        },
        {
         [$seven_sub.value]: $seven_mark.value
        },
        {
         [$eight_sub.value]: $eight_mark.value
        },
        {
         [$nine_sub.value]: $nine_mark.value
        }
     ];
   
    saveMarks(marks);

    if (validateGrades()) {
    document.querySelector('.subject-container').style.display = 'none';

    // const recommendationMessage = `
    //     <div class="recommendation" id="result" >

               
    //         </div>
    // `;
   

    getResult();
    
    
    // document.querySelector('#second-stage').innerHTML += recommendationMessage; 

    }
   
});
//save options
function submitAnswer(question,answer)
{
    $.ajax({
        type: 'POST',
        url: '/submitAnswer',
        data: {
            question: question,
            answer:answer,
            id:currentQuestion,
            _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token from meta tag
        },
        success: function(response) {
            console.log(response);
            // if(i<6){
            //     i++;
            //     sendInitQuestion();
            // }
            //   // Load next question
            // else
            // marks();
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}
function removeAnswer(currentQuestion)
{
   
    $.ajax({
        type: 'POST',
        url: '/removeAnswer',
        data: {
           
            id:currentQuestion,
            _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token from meta tag
        },
        success: function(response) {
            console.log(response);
          
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}
function saveQuestions()
{
    $.ajax({
        type: 'GET',
        url: '/saveQuestions',
        data: {
                     
            _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token from meta tag
        },
        success: function(response) {
            console.log(response);
           
          
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}
function saveMarks(marks)
{
   
    $.ajax({
        type: 'POST',
        url: '/saveMarks',
        data: {
           
            mark:marks,
            _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token from meta tag
        },
        success: function(response) {
            console.log(response);
          
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}
function getResult() {
    const loadingHTML = `
       <div id="loading-spinner" class="spinner-container">
            <div class="custom-spinner"></div>
            <span>جاري التحميل...</span>
        </div>
    `;
    document.querySelector('#second-stage').innerHTML = loadingHTML;
    $.ajax({
        type: 'get',
        url: '/result',
        success: function(response) {
           
           
            message=response.msg;
            console.log(message);
            const recommendations = message.split("\n\n");
            console.log(recommendations);
            let formattedHTML =  `
              <div class="recommendation-view" id="recommendation-view">
            <h2>نتيجة الاختبار</h2>
            <p>بناءً على إجاباتك وتحليل اهتماماتك الشخصية والمهنية، نقدم لك التخصصات التي تتناسب مع قدراتك واهتماماتك. 
            هذه التخصصات تم اختيارها بعناية لتناسب ميولك الشخصية وتمكنك من التفوق والنجاح في مسيرتك الأكاديمية والمهنية:</p> 
            <ol>`;
            
            recommendations.forEach((rec, index) => {
                // let match = rec.match(/\*\*(.+?)\*\*\s*-\s*(.+)/);
                let match = rec.match(/(.+?)\s-\s(.+)/);

                if (match && match.length === 3) {
                    let [_, title, description] = match;
                    console.log('Title:', title); // For debugging purposes
                    console.log('Description:', description); // For debugging purposes

                    // Build the list of recommendations dynamically
                    formattedHTML += `
                        <li>
                            <strong>${title}</strong>: ${description.trim()}
                        </li>`;
                } else {
                    console.log('No match found for recommendation:', rec); // Debugging in case regex fails
                }
            });
            
            formattedHTML += '</ol><br>';
            formattedHTML += `<p>تم اختيار هذه التخصصات بناءً على مهارات الطالب واهتماماته وأدائه الأكاديمي، مع مراعاة الاتجاهات الحالية في سوق العمل والمجالات الواعدة.</p>
                    <div class="button-container">

                    <button id="start-chat-btn" class="start-chat-btn" >  ابدأ الدردشة  </button>

                    <a href="/downloadPDF"> <button id="back-btn" class="download-pdf-btn"> قم بتنزيل النتيجة PDF <i class="fas fa-download"></i>  </button></a>

                </div>

          
            </div>`;
            
            
            // const content = `
            //     <h2>نتيجة الاختبار</h2>
                
            //     <p>${response.msg}</p>
                
            //     <div class="button-container">
            //         <button id="next-btn" class="start-chat-btn">ابدأ الدردشة</button>
            //         <button id="back-btn" class="download-pdf-btn">قم بتنزيل النتيجة PDF <i class="fas fa-download"></i></button>
            //     </div>
            // `;
            
            // // Insert the content into the recommendation div
            // document.getElementById('result').innerHTML = content;
            const secondStage = document.querySelector('#second-stage');
            secondStage.innerHTML = ''; // Clear the loading indicator
            secondStage.innerHTML = formattedHTML;  

            
            saveResult(message);
           
            
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
                document.querySelector('#second-stage').innerHTML = `
                <div class="error-message">
                    <p>عذرًا، حدث خطأ أثناء تحميل النتائج. يرجى المحاولة مرة أخرى لاحقًا.</p>
                </div>
            `;
            }

    });
}
function saveResult(recommendations)
{
   
    $.ajax({
        type: 'POST',
        url: '/saveResult',
        data: {
           
            results:recommendations,
            _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token from meta tag
        },
        success: function(response) {
            console.log(response);
            startChatting();
           
          
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}
function startChatting()
{
    const startChatBtn = document.getElementById('start-chat-btn');
       
        startChatBtn.addEventListener('click', function(event) {
            document.querySelector('#recommendation-view').style.display = 'none';
            document.querySelector('#second-stage').style.display = 'none';
            
            const inputArea = document.querySelector('#input-area');
            inputArea.style.display = 'block';
            document.querySelector('#pp').style.display ='block';
           
        });
  

   
  
}

    //  dropdown menu 
    const dropdownIcon = document.getElementById('dropdown-icon');
    const dropdownMenu = document.getElementById('dropdown-menu');
    
    dropdownIcon.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        dropdownMenu.classList.toggle('show');
    });
    
    document.addEventListener('click', function (event) {
        if (!dropdownIcon.contains(event.target) && dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
        }
    });
    
    const chatInput = document.getElementById('user-input'); //id رسالة اليوزر
    chatInput.addEventListener('focus', function() {
        dropdownMenu.classList.add('show'); 
    });
function chatResponse(userQuestion)
{
    const chatWindow = document.getElementById('chat-window');

    
    $.ajax({
        type: 'POST',
        url: '/chatResponse',
        data: {
           
            message:userQuestion,
            _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token from meta tag
        },
        success: function(response) {
            console.log(response);
            const chatAnswer = response.msg.trim();
            const botMessage = `<div class="message murshid-message"><div class="message-bubble murshid-bubble">
                    ${chatAnswer}
            </div></div>`;
            
            chatWindow.innerHTML += botMessage;
                
            chatWindow.scrollTop = chatWindow.scrollHeight;
              
           
          
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}
