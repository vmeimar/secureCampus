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
    .keimeno {line-height: 90%; text-align: center;}
    .signature {text-align: right; font-size: smaller}
    .pagination {text-align: center; font-size: smaller}
    .footer {
        position: fixed;
        left: 0;
        bottom: 90px;
        right: 30px;
        width: 100%;
        text-align: right;
    }
    .sxima { margin-left: 50px; font-size: smaller}
    /*ol. {list-style-type: lower-greek;}*/
</style>
<body>
<header>
    <div class="row">
        <div class="col-md-8">
            <div class="col-md-4">
                <img class="ekpa-logo" src="https://lh3.googleusercontent.com/proxy/ach80ioRg0vApN23Ynzft-eerpMG143W3I-nvF8eIKH6EdOBy-1cJ3nM0REe7u0hmNekBh38tI2528f5sxaJ3RAjS4wy1qzeGSM2vqW8vzCBA0Vp2uR_yltfhio" alt="">
            </div>
            <div class="col-md-4 sxima">
                <span class="float-left">ΣΧΗΜΑ ΕΠΟΠΤΕΙΑΣ Ε.Κ.Π.Α</span>
            </div>
            <br>
            <div class="col-md-4">
                <span class="float-right">Αθήνα, {{ date('d/m/Y') }}</span>
            </div>
        </div>
    </div>
</header>
<div class="container py-3 mt-4">
    <div class="row col-md-4 float-left" style="left: 0"><p><strong>Προς: Επιτροπή Παραλαβής των υπηρεσιών φύλαξης του Ε.Κ.Π.Α.</strong></p></div>
    <div class="row col-md-8" style="margin-left: 200px"><p><u><strong>ΒΕΒΑΙΩΣΗ</strong></u></p></div>
    <div class="row">
        <p class="keimeno">Ο υπογράφων Επόπτης {{ $user->name }}, βεβαιώνω ότι οι υπηρεσίες φύλαξης στη θέση {{ $location->name }} Ε.Κ.Π.Α,
            πραγματοποιήθηκαν σύμφωνα με τους όρους της σύμβασης, για το χρονικό διάστημα από {{ $from }} έως {{ $to }}, ως εξής:</p>
    </div>
    <div class="row">
        <ol>
            @foreach($activeShifts as $key => $value)
                <li style="font-size: 10px"><strong>{{ $key }}</strong></li>
                <ol>
                    @foreach($value as $activeShift)
                        <li style="font-size: 9px">
                            {{ $activeShift->name }}:
                            {{ date('d/m/Y H:i', strtotime($activeShift->from)) }} - {{ date('d-m-Y H:i', strtotime($activeShift->until)) }} &nbsp;
                            <strong>{{ (strtotime($activeShift->until) - strtotime($activeShift->from)) / 3600}} ώρες</strong>
                        </li>
                    @endforeach
                </ol>
            @endforeach
        </ol>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-4">--}}
{{--            <span class="float-right">Ο Επόπτης</span>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
<div class="footer">
    <p class="signature mr-2 justify-content-center">Ο Επόπτης<br><br><br>
        {{ $user->name }}
    </p>
{{--    <p class="pagination">Σελίδα 1 από 2 ΤΕΣΤ</p>--}}
</div>
</body>
</html>
