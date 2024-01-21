<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-Bold.ttf') }}) format("truetype");
            font-weight: 700;
            font-style: normal;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-BoldItalic.ttf') }}) format("truetype");
            font-weight: 700;
            font-style: italic;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-ExtraBold.ttf') }}) format("truetype");
            font-weight: 800;
            font-style: normal;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-ExtraBoldItalic.ttf') }}) format("truetype");
            font-weight: 800;
            font-style: italic;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-Light.ttf') }}) format("truetype");
            font-weight: 300;
            font-style: normal;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-LightItalic.ttf') }}) format("truetype");
            font-weight: 300;
            font-style: italic;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-Medium.ttf') }}) format("truetype");
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-MediumItalic.ttf') }}) format("truetype");
            font-weight: 500;
            font-style: italic;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-Regular.ttf') }}) format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-SemiBold.ttf') }}) format("truetype");
            font-weight: 600;
            font-style: normal;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-SemiBoldItalic.ttf') }}) format("truetype");
            font-weight: 600;
            font-style: italic;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url({{ storage_path('fonts/Montserrat/Montserrat-Italic.ttf') }}) format("truetype");
            font-weight: 400;
            font-style: italic;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .title {
            text-align: center;
            font-size: 20px;
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .table-name {
            margin-top: 40px;
            margin-bottom: 0px;
        }

        .table-name th {
            text-align: left;
        }

        #table-member {
            font-size: 12px;
            text-align: center;
            width: 100%;
            border-collapse: collapse;
        }

        #table-member td,
        #table-member th {
            border: 1px solid #ddd;
            padding: 0px 10px;
            height: 35px;
        }

        .table-header {
            margin: 0;
            padding: 0;
            color: white;
            background-color: #037abc;
        }

        .text-left {
            text-align: left;
        }

        .slogan {
            margin-top: 30px;
            text-align: center;
            font-weight: bold;
        }

        .bg-warning {
            background-color: yellowgreen;
        }

        .text-sm {
            font-size: 10px;
        }

        .text-md {
            font-size: 14px;
        }

        .env-information {
            text-align: right;
        }
    </style>
</head>

<body>
    <div>
        @if ($web->strict == false)
            <img src="{{ $web->party->logo }}" height="100" alt="Logo Partai" class="float-left">
            <img src="{{ $web->photo }}" height="100" alt="Foto" class="float-right">
        @endif
        <h4 class="title">
            DAFTAR PENDUKUNG {{ strtoupper($web->candidate->name) }}<br>
            PER KOORDINATOR
        </h4>
    </div>

    <table class="table-name">
        <tr>
            <th>NAMA KOORDINATOR</th>
            <td>
                : {{ strtoupper($voter->name) }}
            </td>
        </tr>

        <tr>
            <th>NO HP</th>
            <td>
                : {{ empty($voter->phone_number) ? '-' : $voter->phone_number }}
            </td>
        </tr>

        <tr>
            <th>DESA/KELURAHAN</th>
            <td>
                : {{ empty($voter->village_id) ? 'DILUAR DAPIL 1' : strtoupper($voter->village->name) }}
            </td>
        </tr>
    </table>

    @if (env('ADMIN_PHONE_NUMBER') && env('ADMIN_ADDRESS'))
        <div class="env-information">
            <div class="text-md">
                <b>ADMIN (WA):</b> {{ env('ADMIN_PHONE_NUMBER') }} <br>
                <strong>ALAMAT KANTOR:</strong> {{ env('ADMIN_ADDRESS') }}
            </div>
        </div>
    @endif

    <table id="table-member">
        <thead class="table-header">
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>USIA</th>
                <th>ALAMAT</th>
                <th>NO HP</th>
                <th>KETERANGAN</th>
                <th>TPS</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td class="text-left">
                        {{ strtoupper($member->name) }}
                        @if ($member->gender == 'P')
                            <img src="storage/venus.png" height="10">
                        @else
                            <img src="storage/mars.png" height="10">
                        @endif
                    </td>
                    <td>{{ empty($member->age) ? '-' : $member->age . ' Tahun' }}</td>
                    @if ($member->address && $member->rt && $member->rw)
                        <td class="text-sm text-left">
                            {{ strtoupper($member->address) }}, RT {{ $member->rt }}/RW {{ $member->rw }}
                        </td>
                    @elseif ($member->rt && $member->rw)
                        <td class="text-sm text-left">
                            {{ strtoupper($member->village->name) }}, RT {{ $member->rt }}/RW
                            {{ $member->rw }}
                        </td>
                    @elseif ($member->address)
                        <td class="text-sm text-left">
                            {{ strtoupper($member->address) }}
                        </td>
                    @else
                        <td class="text-sm text-left">-</td>
                    @endif
                    <td>{{ empty($member->phone_number) ? '-' : $member->phone_number }}</td>
                    @if ($member->level == true)
                        <td>KOORDINATOR</td>
                    @else
                        <td class="{{ $voter->village_id == $member->village_id ? null : 'bg-warning' }} text-sm">
                            {{ $voter->village_id == $member->village_id ? null : strtoupper($member->village->name) }}
                        </td>
                    @endif

                    <td>{{ empty($member->votingPlace->name) ? '-' : strtoupper($member->votingPlace->name) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (env('SLOGAN'))
        <div class="slogan">
            ~ {{ env('SLOGAN') }} ~
        </div>
    @endif
</body>

</html>
