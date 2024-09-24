@extends('layouts.app')
@section('content')
    <section>
    
        <main>
           <!-- الشكل شبه الدائري -->
           <div  class="circle-background"></div>
   
           <!-- النص -->
           <div  class="text-container">
               <h1  id="A1">نحو <span>مستقبل</span> <br> أكثر وضوحا</h1>
               <p  id="A2">قم ببدأ اختبار تحديد الشغف الآن لاكتشاف التخصص <br> المثالي الذي يناسب شخصيتك وطموحاتك.</p>
               <a href="/chat" id="A3" class="cta-button start-now-btn">ابدأ الآن</a>
           </div>
   
           <!-- الصورة -->
           <div class="image-container">
               <img id="murshid" src="{{asset('photo/1.PNG')}}" alt="صورة الشخصية">
           </div>
       </main>
   </section>
   
   
     <div class="packagesh1" id="packagesh1">
       <h1>الباقات والاشتراكات </h1>
       <h9> اختر الخطة التي تناسبك، يمكنك الإلغاء في أي وقت.
       </h9>
   </div>
       <!-- قسم الباقات -->
       <section id="packages" class="packages">
           <div id="indi" class="package-card">
               <h3>الأفراد</h3>
               <div class="price">
                   1 ريال عماني<span class="duration"> / شهر واحد</span>
               </div>
               <hr class="card-divider"> 
       
               <ul>
                   <li><p><span class="checkmark">✔</span> إمكانية إعادة الاختبار لعدد 2 من المرات.</p></li>
                   <li><p><span class="checkmark">✔</span> إمكانية ترتيب الخيارات في القبول الموحد.</p></li>
               </ul>
               <a href="#" class="cta-button">اشترك الآن</a>
           </div>
       
           <div id="prim" class="package-card">
               <h3>المدرسية (الأساسي)</h3>
               <div class="price">
                   17 ريال عماني<span class="duration"> / 3 أشهر</span>
               </div>
               <hr class="card-divider"> 
       
               <ul>
                   <li><p><span class="checkmark">✔</span> 30 طالبًا يمكنهم إجراء الاختبار والحصول على توصيات أكاديمية.</p></li>
                   <li><p><span class="checkmark">✔</span> صالح لمدة 3 أشهر.</p></li>
                   <li><p><span class="checkmark">✔</span> يمكن لكل طالب إعادة الاختبار مرة واحدة.</p></li>
                   <li><p><span class="checkmark">✔</span> إمكانية ترتيب الخيارات في القبول الموحد.</p></li>
               </ul>
               <a href="#" class="cta-button">اشترك الآن</a>
           </div>
       
           <div id="best" class="package-card">
               <h3>المدرسية (المميز)</h3>
               <div class="price">
                   45 ريال عماني<span class="duration"> / 6 أشهر</span>
               </div>
               <hr class="card-divider"> 
       
               <ul>
                   <li><p><span class="checkmark">✔</span> 100 طالبًا يمكنهم إجراء الاختبار والحصول على توصيات أكاديمية.</p></li>
                   <li><p><span class="checkmark">✔</span> صالح لمدة 6 أشهر.</p></li>
                   <li><p><span class="checkmark">✔</span> يمكن لكل طالب إعادة الاختبار مرتين.</p></li>
                   <li><p><span class="checkmark">✔</span> إمكانية ترتيب الخيارات في القبول الموحد.</p></li>
               </ul>
               <a href="#" class="cta-button">اشترك الآن</a>
           </div>
       </section>
@endsection






