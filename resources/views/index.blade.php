@extends('layouts.app')
@section('content')


<section>
     <main>
       

        <div  class="text-container">
            <h1  id="A1">نحو <span>مستقبل</span> <br> أكثر وضوحا</h1>
            <p  id="A2">قم ببدأ اختبار تحديد الشغف الآن لاكتشاف التخصص <br> المثالي الذي يناسب شخصيتك وطموحاتك.</p>
            <a href="/chat" id="A3" class="cta-button start-now-btn">ابدأ الآن</a>
        </div>

        <div class="image-container">
           
            <img id="murshid" src=" {{asset('photo/murshid-home.gif')}}" alt="صورة الشخصية">
        </div>
    </main>
</section>

<!-- قسم خدماتنا -->
 <section class="section-services services-row" id="services-row">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-10 col-lg-8">
                    <div class="header-section">
                        <h2 class="title">خدمات حصرية</h2>
                        <p class="description">نقدم مجموعة من الخدمات المتطورة التي تساعد الطلاب في اختيار التخصص الجامعي الأنسب وفقاً لمهاراتهم واهتماماتهم باستخدام تقنيات الذكاء الاصطناعي المتقدمة.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Single Service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="content">
                            <span class="icon">
                                <i class="fab fa-brain"></i>
                            </span>
                            <h3 class="title">تحليل الاهتمامات والقدرات</h3>
                            <p class="description">نقوم بتحليل شامل لاهتماماتك وقدراتك الشخصية لتقديم توصيات دقيقة حول التخصصات الجامعية الأكثر ملاءمة لك.</p>
                        </div>
                        <span class="circle-before"></span>
                    </div>
                </div>
                <!-- / End Single Service -->
                <!-- Single Service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="content">
                            <span class="icon">
                                <i class="fab fa-lightbulb"></i>
                            </span>
                            <h3 class="title">توصيات تخصص مخصصة</h3>
                            <p class="description">نستخدم خوارزميات الذكاء الاصطناعي المتقدمة لتقديم توصيات مخصصة بناءً على بياناتك الفردية، لضمان اختيار التخصص الجامعي الذي يتماشى مع طموحاتك.</p>
                        </div>
                        <span class="circle-before"></span>
                    </div>
                </div>
                <!-- / End Single Service -->
                <!-- Single Service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="content">
                            <span class="icon">
                                <i class="fab fa-road"></i>
                            </span>
                            <h3 class="title">استكشاف المسارات المهنية</h3>
                            <p class="description">نقدم رؤية شاملة حول المسارات المهنية المحتملة لكل تخصص، مما يساعدك على اتخاذ قرارات واعية حول مستقبلك الأكاديمي والمهني.</p>
                        </div>
                        <span class="circle-before"></span>
                    </div>
                </div>
                    <!-- / End Single Service -->
            </div>
        </div>
    </section>


    <!-- قسم الباقات -->

  <div class="packagesh1" id="packagesh1">
    <h1>الباقات والاشتراكات </h1>
    <h9> اختر الخطة التي تناسبك، يمكنك الإلغاء في أي وقت.
    </h9>
</div>
    <section id="packages" class="packages">
        <div id="indi" class="package-card">
            <h3>الأفراد</h3>
            <div class="price">
                1 ريال عماني<span class="duration"> / شهر واحد</span>
            </div>
            <hr class="card-divider"> 
    
            <ul>
                <li><p><span class="checkmark">✔</span>  إمكانية إجراء الاختبار والحصول على توصيات أكاديمية لطالب واحد.</p></li>
                <li><p><span class="checkmark">✔</span> إمكانية ترتيب الخيارات في القبول الموحد.</p></li>
                <li><p><span class="checkmark">✔</span>  الدردشة مع النموذج لمدة 14 يوم.</p></li>
                <li><p><span class="checkmark">✔</span> إجراء الاختبار مرة واحدة فقط.</p></li>

            </ul>
            <a href="#" class="cta-button">اشترك الآن</a>
        </div>
    
        <div id="prim" class="package-card">
            <h3>المدرسية (الأساسي)</h3> 
            <div class="price">
                25  ريال عماني<span class="duration"> / 3 أشهر</span>
            </div>
            <hr class="card-divider"> 
    
            <ul>
                <li><p><span class="checkmark">✔</span> 30 طالبًا يمكنهم إجراء الاختبار والحصول على توصيات أكاديمية.</p></li>
                <li><p><span class="checkmark">✔</span> إمكانية ترتيب الخيارات في القبول الموحد.</p></li>
                <li><p><span class="checkmark">✔</span> الدردشة مع النموذج لمدة 3 أشهر.</p></li>
                <li><p><span class="checkmark">✔</span> إمكانية إعادة الاختبار مرة واحدة.</p></li>

            </ul>
            <a href="#" class="cta-button">اشترك الآن</a>
        </div>
    
        <div id="best" class="package-card">
            <h3>المدرسية (المميز)</h3>
            <div class="price">
                85 ريال عماني<span class="duration"> / 6 أشهر</span>
            </div>
            <hr class="card-divider"> 
    
            <ul>
                <li><p><span class="checkmark">✔</span> 100 طالبًا يمكنهم إجراء الاختبار والحصول على توصيات أكاديمية.</p></li>
                <li><p><span class="checkmark">✔</span> إمكانية ترتيب الخيارات في القبول الموحد.</p></li>
                <li><p><span class="checkmark">✔</span> الدردشة مع النموذج لمدة 6 أشهر.</p></li>
                <li><p><span class="checkmark">✔</span> إمكانية إعادة الاختبار مرة واحدة.</p></li>
                <li><p><span class="checkmark">✔</span> إضافة المدرسة في قسم المحتوى الإعلاني على المنصة لمدة 12 شهر.</p></li>

            </ul>
            <a href="#" class="cta-button">اشترك الآن</a>
        </div>
    </section>

<!-- قسم الإعلانات -->
<section id="advertisements" class="advertisements">
    <div class="ads-wrapper">
        <div class="ads-container">
            <div class="ad-card item1">
                <img src=" {{asset('photo/squ.png')}}" alt="شعار الجامعة" class="ad-logo">
                <div class="separator"></div> 
                <div class="ad-content">
                    <h3 class="college-name">جامعة السلطان قابوس</h3>
                    <p class="ad-description">خيارك الأمثل</p>
                    <a href="#" class="ad-link">اكتشف المزيد <span>&larr;</span></a>
                </div>
            </div>
            <div class="ad-card item2">
                <img src=" {{asset('photo/utas.png')}}" alt="شعار الجامعة" class="ad-logo">
                <div class="separator"></div> 
                <div class="ad-content">
                    <h3 class="college-name">الجامعة التقنية والعلوم التطبيقية</h3>
                    <p class="ad-description">خيارك الأمثل</p>
                    <a href="#" class="ad-link">اكتشف المزيد <span>&larr;</span></a>
                </div>
            </div>
            <div class="ad-card item3">
                <img src=" {{asset('photo/nu.png')}}" alt="شعار الجامعة" class="ad-logo">
                <div class="separator"></div> 
                <div class="ad-content">
                    <h3 class="college-name">الجامعة الوطنية</h3>
                    <p class="ad-description">خيارك الأمثل</p>
                    <a href="#" class="ad-link">اكتشف المزيد <span>&larr;</span></a>
                </div>
            </div>
            <div class="ad-card item4">
                <img src=" {{asset('photo/arabou.png')}}" alt="شعار الجامعة" class="ad-logo">
                <div class="separator"></div> 
                <div class="ad-content">
                    <h3 class="college-name">الجامعة العربية المفتوحة</h3>
                    <p class="ad-description">خيارك الأمثل</p>
                    <a href="#" class="ad-link">اكتشف المزيد <span>&larr;</span></a>
                </div>
            </div>
            <div class="ad-card item5">
                <img src=" {{asset('photo/squ.png')}}" alt="شعار الجامعة" class="ad-logo">
                <div class="separator"></div> 
                <div class="ad-content">
                    <h3 class="college-name">جامعة السلطان قابوس</h3>
                    <p class="ad-description">خيارك الأمثل</p>
                    <a href="#" class="ad-link">اكتشف المزيد <span>&larr;</span></a>
                </div>
            </div>
            <div class="ad-card item6">
                <img src=" {{asset('photo/utas.png')}}" alt="شعار الجامعة" class="ad-logo">
                <div class="separator"></div> 
                <div class="ad-content">
                    <h3 class="college-name">الجامعة التقنية والعلوم التطبيقية</h3>
                    <p class="ad-description">خيارك الأمثل</p>
                    <a href="#" class="ad-link">اكتشف المزيد <span>&larr;</span></a>
                </div>
            </div>
            <div class="ad-card item7">
                <img src=" {{asset('photo/nu.png')}}" alt="شعار الجامعة" class="ad-logo">
                <div class="separator"></div> 
                <div class="ad-content">
                    <h3 class="college-name">الجامعة الوطنية</h3>
                    <p class="ad-description">خيارك الأمثل</p>
                    <a href="#" class="ad-link">اكتشف المزيد <span>&larr;</span></a>
                </div>
            </div>
            <div class="ad-card item8">
                <img src=" {{asset('photo/arabou.png')}}" alt="شعار الجامعة" class="ad-logo">
                <div class="separator"></div> 
                <div class="ad-content">
                    <h3 class="college-name">الجامعة العربية المفتوحة</h3>
                    <p class="ad-description">خيارك الأمثل</p>
                    <a href="#" class="ad-link">اكتشف المزيد <span>&larr;</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


    

