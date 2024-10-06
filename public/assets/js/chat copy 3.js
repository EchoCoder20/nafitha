document.addEventListener('DOMContentLoaded', function () {
    const sendButton = document.getElementById('send-btn');
    const userInput = document.getElementById('user-input');
    const chatWindow = document.getElementById('chat-window');
    const typingAnimation = document.getElementById('typing-animation');
    const examBox = document.getElementById('exam-box');


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
                    <button class="start-btn">ابدأ الاختبار الآن</button>
                </div></div>`;
                chatWindow.innerHTML += botMessage;
                
                chatWindow.scrollTop = chatWindow.scrollHeight;


                const startButton = document.querySelector('.start-btn');
                startButton.addEventListener('click', function() {
                    examBox.style.display = 'block'; 
                });
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
        question: "السؤال الثاني: كيف تفضل قضاء وقت فراغك؟",
        options: [
            "البحث عن معلومات جديدة على الإنترنت أو في الكتب.",
            "العمل على مشاريع يدوية أو تقنية.",
            "التطوع أو المشاركة في فعاليات مجتمعية.",
            "ممارسة الرياضة أو الأنشطة الخارجية."
        ]
    },
    {
        question: "السؤال الثالث: أي من هذه الأنشطة يستهويك أكثر؟",
        options: [
            "حل المشكلات الحسابية والمعادلات الرياضية.",
            "كتابة القصص أو المقالات.",
            "متابعة آخر المستجدات في عالم التكنولوجيا.",
            "المشاركة في مناقشات سياسية أو اجتماعية."
        ]
    },
    {
        question: "السؤال الرابع: كيف تتعامل مع التحديات؟",
        options: [
            "أبحث عن حلول منطقية تستند إلى البيانات.",
            "أفكر في حلول جديدة ومبتكرة.",
            "أستعين بخبرات الآخرين وأعمل ضمن فريق.",
            "أقوم بالتخطيط بعناية وأحلل جميع الخيارات."
        ]
    },
    {
        question: "السؤال الخامس: أي من المواد الدراسية المفضلة لديك في المدرسة؟",
        options: [
            "الرياضيات أو الفيزياء.",
            "الأدب أو الفن.",
            "العلوم أو الأحياء.",
            "التاريخ أو الدراسات الاجتماعية."
        ]
    },
    {
        question: "السؤال السادس:كيف تقيم قدرتك في التواصل و التعبير عن الأفكار؟",
        options: [
            "ممتاز",
            "جيد",
            "متوسط",
            "ضعيف"
        ]
    },
    {
        question: "السؤال السابع: ما نوع المهارات التي تشعر أنها تأتيك بسهولة؟",
        options: [
            "حل المشكلات الرياضية والتحليل المنطقي.",
            "التعبير عن الأفكار بشكل إبداعي وفني.",
            "البرمجة أو التعامل مع الأجهزة التقنية.",
            "التواصل الفعال مع الآخرين وإقناعهم بوجهة نظري."
        ]
    },
    {
        question: "السؤال الثامن: ما الذي يدفعك للشعور بالإنجاز؟",
        options: [
            "النجاح في حل مسألة صعبة أو مشروع معقد.",
            "إبداع شيء جديد يثير إعجاب الآخرين.",
            "مساعدة الآخرين في تحقيق أهدافهم.",
            "تطوير فكرة أو مفهوم يؤدي إلى تغيير إيجابي."
        ]
    },
    {
        question: "السؤال التاسع: كيف تفضل أن تقضي حياتك المهنية؟",
        options: [
            "في مختبر أو بيئة بحثية.",
            "في مكتب إبداعي أو استوديو فني.",
            "في شركة تقنية أو بيئة عمل مليئة بالتحديات.",
            "في مؤسسة اجتماعية أو حكومية تخدم المجتمع."
        ]
    },
    {
        question: "السؤال العاشر: ما هو المجال الذي يثير فضولك أكثر؟",
        options: [
            "العلوم والتكنولوجيا.",
            "الفن والتصميم.",
            "الصحة والبيئة.",
            "القانون أو العلاقات الدولية."
        ]
    }
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
    const userInput = document.getElementById('user_answer');
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
    $.ajax({
        type: 'get',
        url: '/result',
        success: function(response) {
           
           
            message=response.msg;
            
            const recommendations = message.split("\n\n");
            console.log(recommendations);
            let formattedHTML =  `
             <div class="recommendation">
            <h2>نتيجة الاختبار</h2>
            <p>بناءً على إجاباتك وتحليل اهتماماتك الشخصية والمهنية، نقدم لك التخصصات التي تتناسب مع قدراتك واهتماماتك. 
            هذه التخصصات تم اختيارها بعناية لتناسب ميولك الشخصية وتمكنك من التفوق والنجاح في مسيرتك الأكاديمية والمهنية:</p> 
            <ol>`;
            
            recommendations.forEach((rec, index) => {
                console.log(rec);
                // Extracting the title and description using regex
                // let [_, title, description] = rec.match(/\d+\.\s\*\*(.+?)\*\*:(.+)/) || [];
                let [_, title, description] = rec.match(/\*\*(.+?)\*\*\s*-\s*(.+)/) || [];
                console.log(description); // Log the entire response for debugging
                console.log(title); // Log the entire response for debugging
                // let [_, title, description] = rec.match(/\d+\.\s\*\*(.+?)\*\*\s*[-:]\s*(.+)/) || [];

                if (title && description) {
                    formattedHTML += `
                        
                        <li>
                            <strong>${title}</strong>: ${description.trim()}
                        </li>
                    `;
                }
               
            });
            
            formattedHTML += '</ol><br>';
            formattedHTML += `<p>تم اختيار هذه التخصصات بناءً على مهارات الطالب واهتماماته وأدائه الأكاديمي، مع مراعاة الاتجاهات الحالية في سوق العمل والمجالات الواعدة.</p>
                        
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
            document.querySelector('#second-stage').innerHTML += formattedHTML; 
           
            saveResult(message);
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
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
          
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}