<!DOCTYPE html>
<html>
<head>
{{--    <meta charset="UTF-8">--}}
    <title>Βεβαίωση Φύλαξης</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<style>
    body, .row { font-family: DejaVu Sans, sans-serif; font-size: small }
    .ekpa-logo {max-height: 110px;}
</style>
<body>
<div class="container py-3 mt-3">
    <div class="row">
        <div class="col-md-8">
            <div class="col-md-4">
                <img class="ekpa-logo" src="https://i2.wp.com/www.endo.gr/wp-content/uploads/2019/07/logo-ekpa.jpg?ssl=1" alt="">
            </div>
            <div class="col-md-4">
                <span class="float-right">Αθήνα, {{ date('d/m/Y') }}</span>
            </div>
        </div>
    </div>
    <div class="row col-md-4"><p><strong>Προς: Επιτροπή Παραλαβής των υπηρεσιών φύλαξης του Ε.Κ.Π.Α.</strong></p></div>
    <div class="row col-md-8" style="margin-left: 200px"><p><u><strong>Βεβαίωση</strong></u></p></div>
    <div class="row">
        <p>Ο υπογράφων Επόπτης {{ $user->name }}, βεβαιώνω ότι οι υπηρεσίες φύλαξης του κτιρίου {{ $location->name }} Ε.Κ.Π.Α.,
            για το χρονικό διάστημα από {{ $from }} έως {{ $to }}, πραγματοποιήθηκαν σύμφωνα με τους όρους της σύμβασης:</p>
    </div>
    <div class="row">
        <ol>
{{--            @foreach($guards as $guard)--}}
{{--                <li style="font-size: 12px"><strong>{{ $guard->name }} {{ $guard->surname }}</strong></li>--}}
{{--                <ol>--}}
{{--                    @foreach($guard->activeShifts()->get() as $activeShift)--}}
{{--                        @if($activeShift->confirmed_supervisor == 1)--}}
{{--                            <li style="font-size: 10px">{{ $activeShift->name }}: {{ date('d/m/Y H:i', strtotime($activeShift->from)) }} - {{ date('d-m-Y H:i', strtotime($activeShift->until)) }}</li>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </ol>--}}
{{--            @endforeach--}}
            @foreach($activeShifts as $key => $value)
                <li style="font-size: 12px"><strong>{{ $key }}</strong></li>
                <ol>
                    @foreach($value as $activeShift)
                        {{--                        @if($activeShift->confirmed_supervisor == 1)--}}
                        <li style="font-size: 10px">{{ $activeShift->name }}: {{ date('d/m/Y H:i', strtotime($activeShift->from)) }} - {{ date('d-m-Y H:i', strtotime($activeShift->until)) }}</li>
                        {{--                        @endif--}}
                    @endforeach
                </ol>
            @endforeach
        </ol>
    </div>
    <div class="row">
        <div class="col-md-4">
            <span class="float-right">Ο Επόπτης</span>
        </div>
    </div>
</div>
</body>
</html>
