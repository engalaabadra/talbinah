<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reservations</title>
    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th,
        .custom-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .custom-table th {
            background-color: #f2f2f2;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body style="font-family: Verdana, Geneva, Tahoma, sans-serif !important;">
    <h2 style="text-align: center">الحجوزات</h2>
    <table style="width: 100%; border: 0px solid white !important;">
        <tr>
            <td style="width: 50%; direction: rtl;  padding-right: 70px">
                <div class="card-header" style="width: 50%; ">
                    <h4>اجمالي الايرادات : {{ $priceSum }}</h4>
                    <h4> حصة الدكتور :{{ $doctorPresentageSum }} </h4>
                    <h4>حصة تلبينة : {{ $talbinahPresentageSum }} </h4>

                </div>
            </td>
            <td style="width: 50%; direction: rtl;">
                <div class="card-header" style="direction: rtl; width: 50%;">
                    <h4>اسم الدكتور : {{ $doctor->full_name }}</h4>
                    <h4> الرقم التعريفي : {{ $doctor->id }}</h4>
                    <h4> رقم الترخيص : {{ $doctor->profile->license_number }}</h4>
                    <h4>الايميل : {{ $doctor->email }}</h4>
                    <h4>عدد الحجوزات : {{ $reservations_count }}</h4>
                </div>

            </td>

        </tr>
    </table>


    <div class="table-wrapper" style="margin-top: 3rem">
        <table class="custom-table" style="border: 2px solid white">
            <thead>
                <tr>
                    <th>حصة تلبينة</th>
                    <th>حصة الدكتور</th>
                    <th>السعر</th>
                    <th>المدة</th>
                    <th>التاريخ</th>
                    <th>الرقم التعريفي</th>
                    <th>الاسم بالكامل</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{$reservation->Talbinah_presentage}}</td>
                        <td>{{$reservation->doctor_presentage }}</td>
                        <td>{{ $reservation->price}}</td>
                        <td>{{ $reservation->duration }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->reservation_id }}</td>
                        <td>{{ $reservation->patient_name }}</td>
                    </tr>
                @endforeach

            <tbody>
        </table>
    </div>
    @if (isset($errors) && $errors)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
</body>

</html>
