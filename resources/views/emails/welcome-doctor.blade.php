@extends('emails.layouts.main')
@section('meta')
    <title> ترحيب بك في تطبيق تلبينة للرعاية الطبية </title>
@endsection
@section('main-container')

    <p>عزيزي الدكتور : {{$emailData['doctor']}}</p>
    <p>
        نحن نرحب بك بحرارة في تطبيق تلبينة للرعاية الطبية، ونشكرك على انضمامك إلى فريقنا الطبي المتميز. نحن ممتنون لفرصة التعاون معك لتقديم الرعاية الصحية عالية الجودة لمرضانا.
    </p>
    <p>
        تطبيق تلبينة يمثل منصة حديثة ومبتكرة لتسهيل التواصل بين الأطباء والمرضى، ولتحسين تجربة الرعاية الصحية. كطبيب محترف في فريقنا، ستلعب دورًا حاسمًا في تحسين صحة المرضى وتقديم الاستشارات الطبية المؤثرة.
    </p>
    <p>
    نحن نفهم أهمية تقديم الدعم والأدوات الضرورية لضمان تفوقك وراحتك أثناء استخدام التطبيق. إذا كنت بحاجة إلى مساعدة أو توجيه في أي وقت، فلا تتردد في الاتصال بفريق الدعم الفني لدينا.
    </p>
    <p>
    نتمنى لك تجربة ناجحة ومثمرة معنا في تلبينة، ونتطلع إلى تحقيق أهدافك الطبية وتقديم الرعاية الصحية الشاملة لمرضانا.
    </p>
    <p>
        مرة أخرى، نرحب بك في تلبينة ونتطلع إلى العمل معك في خدمة المجتمع الصحي.
    </p>
@endsection