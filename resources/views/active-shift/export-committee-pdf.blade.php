<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Σύνολο Φύλαξης</title>
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
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
    }
    #table{
        max-width: 2480px;
        width:100%;
    }
    #table td{
        width: auto;
        overflow: hidden;
        word-wrap: break-word;
    }
</style>
<body>
<header>
    <div><img src="data:image/png;base64,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"
              width="240px"></div>
</header>
<div class="container">
    <div>
        <p class="text-center"><strong>ΒΑΡΔΙΕΣ ΑΝΑ ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ ΓΙΑ ΤΟ ΔΙΑΣΤΗΜΑ ΑΠΟ {{ $from }} ΜΕΧΡΙ {{ $to }}</strong></p>
    </div>
    <div>
        @foreach($exportData as $locationName => $value)
            <p class="mt-4"><strong>{{ $locationName }}</strong></p>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                        <th style="width: 30%">Όνομα Φύλακα</th>
                        <th style="width: 17.5%">Ώρες Εργάσιμες Πρωί/Απόγευμα</th>
                        <th style="width: 17.5%">Ώρες Εργάσιμες Βράδυ</th>
                        <th style="width: 17.5%">Ώρες Κυριακή/Αργία Πρωί/Απόγευμα</th>
                        <th style="width: 17.5%">Ώρες Κυριακή/Αργία Βράδυ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($value[0] as $guardName => $guard)
                        <tr>
{{--                            {{ dd($guard) }}--}}
                            <td>{{ $guardName }}</td>
                            <td>{{ $guard['weekday_regular'] }}</td>
                            <td>{{ $guard['weekday_night'] }}</td>
                            <td>{{ $guard['holiday_regular'] }}</td>
                            <td>{{ $guard['holiday_night'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Σύνολο ωρών φύλαξης</th>
                        <td>{{ $totalTemp[$locationName]['weekday_regular'] }}</td>
                        <td>{{ $totalTemp[$locationName]['weekday_night'] }}</td>
                        <td>{{ $totalTemp[$locationName]['holiday_regular'] }}</td>
                        <td>{{ $totalTemp[$locationName]['holiday_night'] }}</td>
                    </tr>
                    </tbody>
                </table>
                <p><strong>Σύνολο ωρών που δεν πραγματοποιήθηκε φύλαξη λόγω απουσίας φύλακα: {{ $totalHours[$locationName]['totalHoursAbsentByLocation'] }}</strong></p>
            </div>
        @endforeach
    </div>
    <div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered" id="table">
                <thead>
                <tr>
                    <th>Γενικό Σύνολο Διαφοράς</th>
                    <td>{{ $totalHoursAbsent }}</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Διαφορά σε Ισοδύναμες Ώρες</th>
                    <td>{{ $totalFactorAbsent }}</td>
                </tr>
                <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
