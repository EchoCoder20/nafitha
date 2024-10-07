<link rel="stylesheet" href="{{asset('assets/css/aboutus.css')}}"/>
@extends('layouts.app')
@section('content')
    
<div class="container">
    <div class="intro">
    <h2>مـن نـحـن؟</h2>
    <p>نافذة هي منصة تعتمد على الذكاء الاصطناعي لمساعدة طلاب الثانوية العامة في اتخاذ قراراتهم الأكاديمية بسهولة وثقة.</p>
    </div>
    
    <div class="content">
    <div class="box">
    <img src=" {{asset('photo/01.svg')}}" alt="رؤيتنا">
    <div>
    <h3>رؤيتنا</h3>
    <p>نطمح أن نكون الشريك الأكاديمي الموثوق به لطلاب المدارس، لتسهيل عملية اختيار التخصصات الجامعية بناءً على المهارات والشغف.</p>
    </div>
    </div>
    <div class="box">
    <img src=" {{asset('photo/02.svg')}}" alt="هويتنا">
    <div>
    <h3>هويتنا</h3>
    <p>نؤمن بتقديم تجربة مستخدم سلسة وشخصية لكل طالب، من خلال تحليل البيانات وتقديم توصيات مصممة خصيصًا لكل فرد.</p>
    </div>
    </div>
    
    </div>
    
    <div class="images">
    <img src=" {{asset('photo/IMG-20241007-WA0003.jpg')}}" alt="نافذة - منصة الذكاء الاصطناعي">
    </div>
    
    <div class="content">
    <div class="box">
    <img src=" {{asset('photo/03.svg')}}" alt="مهمتنا">
    <div>
    <h3>مهمتنا</h3>
    <p>نقدم للطلاب الأدوات اللازمة لاكتشاف شغفهم وتحليل قدراتهم، مع ترتيب خيارات القبول الموحد بالطريقة الأمثل.</p>
    </div>
    </div>
    
    <div class="box">
    <img src=" {{asset('photo/04.svg')}}" alt="قيمنا">
    <div>
    <h3>قيمنا</h3>
    <p>نعمل على تمكين الطلاب ليكونوا قادرين على اتخاذ قرارات مدروسة بشأن مستقبلهم الأكاديمي والمهني من خلال توفير المعلومات الموثوقة والتحليل الدقيق.</p>
    </div>
    </div>
    </div>
    </div>

@endsection
   
