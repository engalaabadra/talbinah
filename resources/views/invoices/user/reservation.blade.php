<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation #{{ $reservation->id }}</title>
    <style>
        body {}

        .underline {
            border-bottom: 2px dotted lightgray;
            padding-bottom: 2px;
        }

        .mt-3 {
            margin-top: 3rem;
        }

        .mt-1 {
            margin-top: 10px !important
        }

        .invoice-line {
            padding-right: 0 !important;
        }

        .card-header {
            padding: 12px;
            font-weight: 500 !important;
        }

        .w-100 {
            width: 100% !important
        }
    </style>
</head>

<body
    style="font-family: Verdana, Geneva, Tahoma, sans-serif !important;
            direction: rtl;
            padding: 2rem;">
    <div class="container">



        <table style="width: 100%; border: none">
            <tr>
                <td style="width: 50%; direction: rtl; ">
                    <div class="card-header">
                        <img class="lazy logo" src="assets/images/logo/logo_talbinah.png"
                            style="height: 60px; width: 140px" title="Talbinah" alt="Talbinah" /></a>
                        <a class="navbar-brand mb-0" href="#"></a>
                    </div>
                    <div class="card-body" style="text-align: center; margin-top:10px;">
                        <h4 style="font-weight: 800;">المملكة العربية السعودية</h4>
                        <p style="font-weight: 800;">ترخيص وزارة الصحة 4500011559
                        <p>
                        <p style="font-weight: 800;">السجل التجاري 4650211770</p>
                        <p style="font-weight: 800;">الموقع الالكتروني https://talbinah.net</p>
                        <p style="font-weight: 800;">العنوان البريدي info@talbinah.net</p>
                        <p style="font-weight: 800;">رقم خدمة العملاء 
                            +966552272756
                        </p>
                    </div>
                    
                </td>
                <td style="width: 50%; direction: rtl; padding-right: 70px">
                    <div class="card-body">
                        <div class="card-header" style="margin-top: 20px;">
                            <h3><b>بيانات المريض :</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="mt-1 invoice-line"><b>رقم المريض </b>: <span class="underline"
                                    style="border-bottom: 2px dotted lightgray; padding-bottom: 2px;">{{ $reservation->user->id }}</span>
                            </div>
                            <div class="mt-1 invoice-line"><b>اسم المريض </b>: <span class="underline"
                                    style="border-bottom: 2px dotted lightgray; padding-bottom: 2px;">{{ $reservation->full_name }}</span>
                            </div>
                            <div class="mt-1"><b class="mt-1">رقم الموعد </b>: <span class="underline"
                                    style="border-bottom: 2px dotted lightgray; padding-bottom: 2px;">{{ $reservation->appointment->id }}</span>
                            </div>
                            <div class="mt-1"><b class="mt-1">تاريخ الميلاد </b>: <span class="underline"
                                    style="border-bottom: 2px dotted lightgray; padding-bottom: 2px;">{{ $reservation->user->profile->birth_date }}</span>
                            </div>
                            <div class="mt-1"><b class="mt-1">تاريخ الاستشارة </b>: <span class="underline"
                                    style="border-bottom: 2px dotted lightgray; padding-bottom: 2px;">{{ $reservation->date }}</span>
                            </div>
                        </div>
                    </div>
    </div>
    </td>


    </tr>
    </table>
    <h4 style="color:red; margin-top: 10px !important; font-weight: 800;">بالنسبة للقاصرين، يجب صرف جميع الأدوية بحضور
        الوصي القانوني</h4>

    <div class="card">

        <h4 class="card-header" style="background-color: lightgrey; ">التشخيص</h4>

        <div class="card-body" style="margin-right: 15px !important">
            <div class="mt-1 invoice-line"><b>اسم الدكتور </b>: <span
                    class="underline">{{ $reservation->doctor->full_name }}</div>
            
            <div class="mt-1 invoice-line"><b>التخصص</b>: 
                <span class="underline">
                @foreach ($reservation->doctor->specialties as $specialty)
                    - {{$specialty->name}} -
                @endforeach
            </span>
            </div>
            <div class="mt-1 invoice-line"><b>رقم الرخصة</b>: <span class="underline">{{ $reservation->doctor->profile->license_number }}</span>
            </div>
            <div class="mt-1 invoice-line"><b>التشخيص</b>: <span class="underline">{{ $reservation->report }}</span>
            </div>
           
            {{-- <div class="mt-1 invoice-line"><b> تراخبص طبية</b>: <span
                    class="underline">{{ $reservation->medical_licences }}</span></div> --}}
            <div class="mt-1 invoice-line"><b>المدة</b> : <span
                    class="underline">{{ $reservation->duration ? $reservation->duration->duration : null }}</span></div>
            <div class="mt-1 invoice-line"><b>تاريخ البدء</b> <span
                    class="underline">{{ $reservation->start_time }}</span></div>
            <div class="mt-1 invoice-line"><b>تاريخ الانتهاء</b> : <span
                    class="underline">{{ $reservation->end_time }}</span></div>
        </div>
    </div>

    <div class="card">

        <h4 class="card-header" style="background-color: lightgrey;">الأدوية</h4>
        <div class="card-body">
            @if ($reservation->prescriptions)
                @foreach ($reservation->prescriptions as $prescription)
                    <div class="mt-1 invoice-line"><b>اسم الدواء</b>: <span
                            class="underline">{{ $prescription->name }}</span>
                    </div>
                    <div class="mt-1 invoice-line"><b>الجرعة</b> :<span class="underline">
                            {{ $prescription->dose }}</span>
                    </div>
                    <div class="mt-1 invoice-line"><b>مدة العلاج</b> :<span
                            class="underline">{{ $prescription->duration }}</span></div>
                    <div class="mt-1 invoice-line"><b>تكرار العلاج</b> :<span class="underline">
                            {{ $prescription->frequency }}</span></div>
                    <div class="mt-1 invoice-line"><b>التعليمات</b> : <span
                            class="underline">{{ $prescription->instruction }}</span></div>
                    ----------------------------------------------------------------------------------------------------------------------------------------------
                @endforeach
            @endif
        </div>
    </div>
    </div>
        <img class="lazy logo" src="assets/images/logo/STamp.png"
            style="height: 300px; width: 300px; margin-right:180px;margin-top:-122px" title="Talbinah" alt="Talbinah" /></a>
        <a class="navbar-brand mb-0" href="#"></a>
</body>

</html>
