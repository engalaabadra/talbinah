@extends('emails.layouts.main')
@section('meta')
    <title> تذكير بموعد حجز جديد </title>
@endsection
@section('main-container')

    <p>عزيزي الدكتور : {{$emailData['doctor']}}</p>
    <p>هذا تذكير بموعد حجزك مع 
        : {{$emailData['user']}}
        في تطبيق تلبينة للرعاية الطبية
    </p>
    <p>
        موعدك من  : {{$emailData['reservation_start_time']}}
        الى : {{$emailData['reservation_end_time']}}
        اليوم
    </p>
   <p>يُرجى التأكد من تواجدك في الوقت المحدد. شكرًا لاختيارك تلبينة للرعاية الصحية.</p>
    <p>
        إذا كنت بحاجة إلى مزيد من المعلومات أو لديك أسئلة إضافية حول هذا المريض، تستطيع متابعة الحجز من التطبيق
    </p>
    <p>
        نحن نثمن تعاونك وجهوزيتك لخدمة مرضانا. شكرًا مقدمًا على وقتك واهتمامك.
    </p>
       
@endsection
