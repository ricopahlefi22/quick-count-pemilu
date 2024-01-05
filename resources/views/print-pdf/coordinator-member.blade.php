<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	 <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

</head>
<body>

	<style>
        @page {
            size: A4 landscape;
            margin: 20mm; /* Atur margin sesuai kebutuhan Anda */
        }

        body {
            margin: 0;
            padding: 0;
        }

        .page-number::before {
        content: counter(page);
    }

        /* Tambahkan gaya CSS lainnya sesuai kebutuhan Anda */
    </style>


<div class="card border-0">
	<div class="card-body ">
		<center>
			<h4>DAFTAR ANGGOTA PEDULORAN, TEMAN, KAWAN, SAHABAT RION SARDI <br>
			KECAMATAN DELTA PAWAN</h4>
		</center>


		<table class=" table-borderless mt-5">
			<tr>
				<th>NAMA KOORDINATOR</th>
				<td>: {{strtoupper($voter->name)}}</td>
			</tr>

			<tr>
				<th>NO TELP</th>
				<td>:  {{strtoupper($voter->phone_number)}}</td>
			</tr>

			<tr>
				<th>DESA/KELURAHAN</th>
				<td>:  {{strtoupper($voter->village->name)}}</td>
			</tr>

			<tr>
				<th>RT/RW</th>
				<td>:  {{strtoupper($voter->rt)}}/ {{strtoupper($voter->rw)}}</td>
			</tr>	
		</table>


		<table class="table table-bordered mt-5" style="font-size: 9pt;">
			<thead>
				<tr class="bg-secondary text-white">
					<th class="page-number">NO</th>
					<th>NAMA SESUAI KTP</th>
					<th>NIK</th>
					<th>ALAMAT</th>
					<th>NO HP(WA)</th>
					<th>KETERANGAN</th>
					<th>TPS</th>
				</tr>
			</thead>

			<tbody>
				@foreach($members as $item)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{strtoupper($item->name)}}</td>
					<td>{{strtoupper($item->id_number)}}</td>
					<td>{{strtoupper($item->address)}}</td>
					<td>{{$item->phone_number}}</td>
					<td>{{strtoupper($item->note)}}</td>
					<td>{{strtoupper($item->votingPlace->name)}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</div>

<script>
    // Wait for the content to load before triggering the print
    window.onload = function () {
        window.print();
    };
</script>
	
</body>
</html>