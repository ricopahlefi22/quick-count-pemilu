<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            margin-bottom: 20px;
        }

        .table-name th {
            text-align: left;
        }

        #table-voter {
            font-size: 13px;
            text-align: center;
            width: 100%;
            border-collapse: collapse;
        }

        #table-voter td,
        #table-voter th {
            border: 1px solid #ddd;
            padding: 0px 10px;
            height: 25px;
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

        .witness {
            background-color: lightslategray;
            color: white
        }

        .fw-bold {
            font-weight: bolder;
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
            DAFTAR ANGGOTA PEDULORAN {{ strtoupper($web->candidate->name) }}<br> DI TPS {{ $votingPlace->name }}
            {{ strtoupper($votingPlace->village->name) }}
        </h4>
    </div>

    <table class="table-name">
        <tr>
            <th>NAMA SAKSI</th>
            <td>
                :
                {{ empty($votingPlace->witness->voter->name) ? '-' : strtoupper($votingPlace->witness->voter->name) }}
            </td>
        </tr>

        <tr>
            <th>NO HP</th>
            <td>
                :
                {{ empty($votingPlace->witness->voter->phone_number) ? '-' : $votingPlace->witness->voter->phone_number }}
            </td>
        </tr>

    </table>

    <table id="table-voter">
        <thead class="table-header">
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>USIA</th>
                <th>ALAMAT</th>
                <th>NO HP</th>
                <th>TPS</th>
                <th>KOORDINATOR</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($voters as $voter)
                @if ($voter->witness()->exists())
                    <tr class="witness {{ $voter->level == true ? 'fw-bold' : null }}">
                    @else
                    <tr class="{{ $voter->level == true ? 'fw-bold' : null }}">
                @endif
                <td>{{ $loop->iteration }}.</td>
                <td class="text-left">
                    {{ strtoupper($voter->name) }}
                    @if ($voter->gender == 'P')
                        <img src="storage/venus.png" height="10">
                    @else
                        <img src="storage/mars.png" height="10">
                    @endif
                </td>
                <td>{{ empty($voter->age) ? '-' : $voter->age . ' Tahun' }}</td>
                @if ($voter->address && $voter->rt && $voter->rw)
                    <td class="text-sm text-left">
                        {{ strtoupper($voter->address) }}, RT {{ $voter->rt }}/RW {{ $voter->rw }}
                    </td>
                @elseif ($voter->rt && $voter->rw)
                    <td class="text-sm text-left">
                        {{ strtoupper($voter->village->name) }}, RT {{ $voter->rt }}/RW
                        {{ $voter->rw }}
                    </td>
                @elseif ($voter->address)
                    <td class="text-sm text-left">
                        {{ strtoupper($voter->address) }}
                    </td>
                @else
                    <td class="text-sm text-left">-</td>
                @endif
                <td>{{ empty($voter->phone_number) ? '-' : $voter->phone_number }}</td>

                <td>{{ strtoupper($voter->votingPlace->name) }}</td>
                <td>{{ strtoupper($voter->coordinator->name) }}</td>
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
