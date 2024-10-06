@extends('layouts.app')
@section('content')

    <!-- Chat Section -->
    <div class="chat-container">
        <div id="chat-window">
            <!-- Murshid's initial message -->
            <div id="murshid-message" class="message murshid-message">
                <img src="photo/murshid_icon.png" alt="Murshid Icon" class="chat-icon">
                <div class="message-bubble murshid-bubble">
                    <p>مرحباً! 👋<br> 
                        أنا مرشد، مساعدك الشخصي في اكتشاف شغفك وتحديد التخصص الجامعي الأنسب لك. هدفي هو مساعدتك، كطالب في المرحلة الثانوية، على فهم اهتماماتك وميولك الشخصية لتتمكن من اتخاذ القرار الأفضل لمستقبلك الأكاديمي.
                        <br>
                        من خلال هذا الاختبار، سنعمل معاً على استكشاف المجالات التي تناسبك وتلهمك لتتخذ خطوة واثقة نحو تخصصك الجامعي.
                        <br>
                        هل أنت مستعد للبدء واكتشاف التخصص الأنسب لك؟ 🚀<br>
                        <button class="start-btn" id="start-test-btn">ابدأ الاختبار الآن</button>
                    </p>
                </div>
            </div>

            <!-- Exam Box -->
            <div id="exam-box" class="exam-container" style="display: none;">
                <h2 class="exam-title">اختبار تحديد الشغف</h2>
                <div class="progress-bar">
                    <div id="progress" style="width: 0%;"></div>
                </div>
                <div id="question-box">
                    <p class="question-text">ما الذي تستمتع به أكثر عند تعلم موضوع جديد؟</p>
                    <div class="choices">
                        <label><input type="radio" name="question1" value="1"> تطبيق النظريات العلمية في تجارب واقعية.</label><br>
                        <label><input type="radio" name="question1" value="2"> التفكير الإبداعي وحل المشكلات.</label><br>
                        <label><input type="radio" name="question1" value="3"> قراءة المقالات والكتب لتوسيع معرفتي.</label><br>
                        <label><input type="radio" name="question1" value="4"> التعاون مع الآخرين للوصول إلى حلول.</label><br>
                    </div>
                </div>
                <div class="button-container">
                    <button id="next-btn" disabled>
                        <i class="fas fa-arrow-right icon"></i> التالي
                    </button> 
                    <button id="back-btn" style="display: none;">
                        رجوع <i class="fas fa-arrow-left icon"></i>
                    </button>
                </div>
            </div>

            <div id="end-message" class="message murshid-message" style="display: none;">
                <img src="photo/murshid_icon.png" alt="Murshid Icon" class="chat-icon">
                <div class="message-bubble murshid-bubble">
                    <p>لقد انتهيت من الاختبار! 🎉</p>
                    <button id="next-stage-btn" class="start-btn">انتقل للمرحلة الثانية</button>
                </div>
            </div>

            <div id="second-stage" style="display: none;">
              <div class="subject-container">
                <h2>اختر المواد وأدخل الدرجات</h2>

                <div class="subject-row">
                    <select class="subject-dropdown" id="first_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="first_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <div class="subject-row">
                    <select class="subject-dropdown" id="two_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="two_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <div class="subject-row">
                    <select class="subject-dropdown" id="third_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="third_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <div class="subject-row">
                    <select class="subject-dropdown" id="four_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="four_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <div class="subject-row">
                    <select class="subject-dropdown" id="five_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="five_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <div class="subject-row">
                    <select class="subject-dropdown" id="six_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="six_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <div class="subject-row">
                    <select class="subject-dropdown" id="seven_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="seven_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <div class="subject-row">
                    <select class="subject-dropdown" id="eight_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="eight_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <div class="subject-row">
                    <select class="subject-dropdown" id="nine_sub">
                        <option value="" disabled selected>اختر مادة</option>
                        <option value="هذا وطني">هذا وطني</option>
                        <option value="الرياضة المدرسية">الرياضة المدرسية</option>
                        <option value="اللغة العربية">اللغة العربية</option>
                        <option value="الكيمياء">الكيمياء</option>
                        <option value="الفيزياء">الفيزياء</option>
                        <option value="العلوم والبيئة">العلوم والبيئة</option>
                        <option value="العالم من حولي">العالم من حولي</option>
                        <option value="الرياضيات التطبيقية">الرياضيات التطبيقية</option>
                        <option value="الرياضيات البحتة">الرياضيات البحتة</option>
                        <option value="الجغرافيا والتقنيات">الجغرافيا والتقنيات</option>
                        <option value="التربية الإسلامية">التربية الإسلامية</option>
                        <option value="الأحياء">الأحياء</option>
                        <option value="اللغة الإنجليزية">اللغة الإنجليزية</option>
                        <option value="مهارات موسيقية">مهارات موسيقية</option>
                        <option value="الفنون التشكيلية">الفنون التشكيلية</option>
                    </select>
                    <input type="number" class="grade-input" id="nine_mark" placeholder="أدخل الدرجة" min="0" max="100">
                </div>
                <button id="submit-info-btn" class="start-btn">تسليم البيانات</button>

            </div>
            <div class="recommendation"  style="display: none;">
                <div class="recommendation-view" id="result">

                <h2>نتيجة الاختبار</h2>
                <p>بناءً على إجاباتك وتحليل اهتماماتك الشخصية والمهنية، نقدم لك التخصصات التي تتناسب مع قدراتك واهتماماتك. هذه التخصصات تم اختيارها بعناية لتناسب ميولك الشخصية وتمكنك من التفوق والنجاح في مسيرتك الأكاديمية والمهنية:</p>
                <ol>
                    <li><strong>العلوم الصحية (الطب والصيدلة):</strong> إذا كنت تميل إلى مساعدة الآخرين، والاهتمام بالتفاصيل، وترغب في العمل في بيئة تتطلب الدقة والانضباط، فإن تخصصات العلوم الصحية ستكون خيارًا ممتازًا لك. يتطلب هذا المجال اهتمامًا شديدًا بصحة الأفراد ومجتمعك، ويتيح لك أن تكون جزءًا من حلول الرعاية الصحية.</li>
                    <li><strong>الهندسة (الهندسة المدنية/الهندسة الكهربائية):</strong> لعشاق الابتكار والتصميم وحل المشكلات. سواء كنت تميل إلى تطوير الهياكل المعمارية الضخمة أو الشبكات الكهربائية المعقدة، فإن مجال الهندسة يوفر لك فرصًا غير محدودة للإبداع والعمل على مشاريع حيوية تؤثر على المجتمع بشكل مباشر.</li>
                    <li><strong>إدارة الأعمال (التمويل/التسويق):</strong> إذا كنت تحب العمل مع الأرقام أو استراتيجيات السوق، فإن إدارة الأعمال توفر لك بيئة ديناميكية مليئة بالتحديات. يمكنك أن تعمل في مجال التمويل وتحليل البيانات المالية أو تسويق المنتجات والخدمات بطرق إبداعية لجذب العملاء.</li>
                    <li><strong>تكنولوجيا المعلومات (IT) أو علوم الحاسب:</strong> هذا التخصص مثالي لمن يحب العمل مع الأجهزة التقنية والبرمجيات. مع تزايد الاعتماد على التكنولوجيا في جميع جوانب الحياة، ستكون لديك فرص لا حصر لها لتطوير مهاراتك في البرمجة، إدارة البيانات، والأمن السيبراني.</li>
                    <li><strong>الفنون والتصميم:</strong> إذا كنت تمتلك حسًا إبداعيًا وترغب في التعبير عن نفسك من خلال الألوان والأشكال، فإن الفنون والتصميم ستمكنك من تحويل أفكارك الإبداعية إلى مشاريع ملموسة. من التصميم الجرافيكي إلى الفنون البصرية، هناك العديد من الفرص لإبراز موهبتك.</li>
                </ol>
                
                <div class="button-container">
                    <button id="next-btn" class="start-chat-btn">  ابدأ الدردشة  </button>
                    <button id="back-btn" class="download-pdf-btn">  قم بتنزيل النتيجة PDF <i class="fas fa-download"></i>  </button>
                </div>
            </div>
            </div>

       </div>  
      
    </div>

        <!-- Input Area -->
         <div class="input-area-hidden" style="display: none;">
        <div class="input-area" id="input-area" >
            <textarea id="user-input" placeholder="اكتب رسالتك ......"></textarea>
            <button id="send-btn"><i class="fas fa-paper-plane"></i></button>
        </div>
</div>
        

    </div>

<script src="{{asset('assets/js/chat.js')}}"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
@endsection

