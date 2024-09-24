@extends('layouts.app')
@section('content')
    <section class="about-us">
        <h1>عن نافذة</h1>
        <p>نحن في "نافذة" نفهم أن كل طالب لديه اهتمامات وأهداف فريدة، لذا نسعى لتقديم حلول مخصصة تساعد في تحديد أفضل الخيارات الأكاديمية التي تتناسب مع طموحاتهم. من خلال تقنيات الذكاء الاصطناعي وأدوات التحليل المتقدمة، نقدم لكم توصيات دقيقة وشخصية للتخصصات الجامعية بناءً على اهتماماتكم، قدراتكم.<br>

            عبر استخدام "نافذة"، يمكنكم الوصول إلى تقارير مفصلة حول التخصصات المختلفة، المتطلبات الجامعية، والفرص المهنية المستقبلية. نهدف إلى تبسيط عملية اتخاذ القرار وجعلها قائمة على معلومات دقيقة وشاملة.
            
            سواء كنتم مترددين بين أكثر من تخصص أو تبحثون عن الإلهام لتحديد مساركم الأكاديمي، نحن هنا لدعمكم في كل خطوة، وضمان أن تكونوا مستعدين للمرحلة القادمة بثقة ووضوح.
            
            <br><br>في "نافذة"، نحن لا نقدم لكم مجرد منصة، بل شريكاً موثوقاً يساعدكم في بناء مستقبلكم الأكاديمي والمهني بطريقة ذكية ومثمرة.</p>
    </section>

    <section class="about-us-image">
        <img src="{{asset('photo/nafitha-about.png')}}" alt="نافذة" class="full-width-image">
    </section>

    <section class="vision">
        <div class="vision-text">
            <h1>رؤيتنا</h1>
            <p>
                في "نافذة"، نهدف إلى أن نكون الشريك الأمثل للطلاب في رحلتهم الأكاديمية. نحن نؤمن بأن كل طالب يستحق فرصة لتحقيق إمكاناته الكاملة من خلال اختيار التخصص الجامعي الذي يتماشى مع شغفه وقدراته. رؤيتنا هي تبسيط عملية اتخاذ القرار الأكاديمي عبر تقديم مشورة دقيقة ودعم مخصص يساعد الطلاب على تحقيق أهدافهم وبناء مستقبلهم الأكاديمي بثقة. نطمح لأن نكون الجسر الذي يربط بين الطموحات والنجاح، مفتحين أبواباً جديدة لتحقيق الأحلام وتحقيق النجاح الأكاديمي.
            </p>

            
        </div>

      
        <div class="vision-image">
            <img src="{{asset('photo/vision-stud.png')}}" alt="vision" class="vision-image-overlay">
            <div class="upper-row">
                <div class="rec2"></div>
                <div class="rec3"></div>
            </div>
            <div class="rec1"></div>
        </div>
    </section>
    

    <section class="founders">
        <h2>المؤسسون</h2>
        <div class="founders-slider">
            <!-- مؤسس 1 -->
            <div class="founder-card active">
                <img src="{{asset('photo/girl-founder.png')}}" alt="المؤسس 1">
                <h3>حورية البوسعيدي</h3>
                <div class="founder-email"><p>horiya.busaidi@gmail.com</p> <img class="founder-emailicon" src="photo/email.png"></div>
                
            </div>
            <!-- مؤسس 2 -->
            <div class="founder-card">
                <img src="{{asset('photo/girl-founder.png')}}" alt="المؤسس 2">
                <h3>آلاء العامري</h3>
                <div class="founder-email"><p>alaaalaamria@gmail.com</p> <img class="founder-emailicon" src="photo/email.png"></div>
            </div> 
             <!-- مؤسس 3 -->
            <div class="founder-card">
                <img src="{{asset('photo/boy-founder.png')}}" alt="المؤسس 4">
                <h3>عبد الله الربيعي </h3>
                <div class="founder-email"><p>3lrubaiai@gmail.com</p> <img class="founder-emailicon" src="photo/email.png"></div>
            </div>
            <!-- مؤسس 4 -->
            <div class="founder-card">
                <img src="{{asset('photo/girl-founder.png')}}" alt="المؤسس 3">
                <h3>عائشة الشامسي</h3>
                <div class="founder-email"><p>aysha.alshamsi988@gmail.com</p> <img class="founder-emailicon" src="photo/email.png"></div>
            </div>
          
        </div>
        
        <!-- النقاط الثلاث للتبديل بين المؤسسين -->
        <div class="founders-dots">
            <span class="active"></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        
    </section>
    <script>
        const founders = document.querySelectorAll('.founder-card');
        const dots = document.querySelectorAll('.founders-dots span');
        let currentIndex = 0;
    
        function updateSlider(index) {
            founders.forEach((founder, i) => {
                founder.classList.remove('active');
                dots[i].classList.remove('active');
                if (i === index) {
                    founder.classList.add('active');
                    dots[i].classList.add('active');
                }
            });
        }
    
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                updateSlider(index);
            });
        });
    
        setInterval(() => {
            currentIndex = (currentIndex + 1) % founders.length;
            updateSlider(currentIndex);
        }, 3000); 
    </script>
@endsection