<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALLYSHEET-{{$stevedoring->id}}</title>
</head>

<body>
    <table border="0px" width="100%">
        <tr>
            <td>
                <h2>EKANURI</h2>
            </td>
            <td> </td>
            <td style="text-align: right;">
                <h2>TALLY SHEET</h2>
            </td>
        </tr>
        <tr>
            <td>Jl. Ketel Uap I No. 1 Jakarta Utara DKI Jakarta</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Telp : (021) 439-02157 | Fax : (021) 385-0830</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <hr>
    <!-- Header -->
    <table border="0px" width="100%">
        <tr>
            <td width="10%">ID</td>
            <td width="20%">: {{$stevedoring->id}}</td>
            <td width="30%"></td>
            <td width="10%">Tanggal</td>
            <td width="20%">: {{tanggalHari($stevedoring->start_activity)}}
            </td>
        </tr>
        <tr>
            <td>Kapal</td>
            <td>: {{$stevedoring->vessel->name}}</td>
            <td></td>
            <td>Mulai Kegiatan</td>
            <td>: {{tanggalWaktu($stevedoring->start_activity)}}</td>
        </tr>
        <tr>
            <td>Area</td>
            <td>: {{$stevedoring->area->name}}</td>
            <td></td>
            <td>Selesai Kegiatan</td>
            <td>: {{tanggalWaktu($stevedoring->finish_activity)}}</td>
        </tr>
        <tr>
            <td>Kegiatan</td>
            <td>: {{$stevedoring->stevedoringcategory->name}}</td>
            <td></td>
            <td>Durasi Kegiatan</td>
            <td>: {{$stevedoring->text_duration}}</td>
        </tr>
    </table>
    <br>

    <!-- Table -->
    <table border="1px" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Doc no</th>
                <th rowspan="2">QTY</th>
                <th rowspan="2">DESCRIPTION</th>
                <th rowspan="2">REMARKS</th>
                <th rowspan="2">PLACED</th>
                <th colspan="3">DIMENTION</th>
                <th rowspan="2">M<sup>3</sup></th>
                <th rowspan="2">TON</th>
                <th rowspan="2">TON/M<sup>3</sup></th>
            </tr>
            <tr>
                <th>L</th>
                <th>W</th>
                <th>H</th>
            </tr>
        </thead>
        <tbody>

            @foreach($tallysheets as $key => $tallysheet)
            <tr style="text-align: center;">
                <td>{{$key+1}}</td>
                <td>{{$tallysheet->doc_no}}</td>
                <td>{{$tallysheet->qty}}</td>
                <td>{{$tallysheet->description}}</td>
                <td>{{$tallysheet->remarks}}</td>
                <td>{{$tallysheet->origin_destination}}</td>
                <td>{{$tallysheet->long}}</td>
                <td>{{$tallysheet->widht}}</td>
                <td>{{$tallysheet->height}}</td>
                <td>{{$tallysheet->m3}}</td>
                <td>{{$tallysheet->ton}}</td>
                <td>{{$tallysheet->m3}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <br><br>

    <!-- TTD -->
    <table width="100%">
        <tr style="text-align: center;">
            <td style="width:25%">Menyetujui:</td>
            <td style="width:25%"></td>
            <td style="width:25%">Mengetahui:</td>
            <td style="width:25%"></td>
            <td style="width:25%">Menyetujui:</td>
        </tr>
        <tr style="text-align: center;">
            <td>{{$stevedoring->client->name}} Reps,</td>
            <td></td>
            <td>Checker</td>
            <td></td>
            <td>Supervisor/Team Leader</td>
        </tr>
        <tr>
            <td colspan="5" style="height: 50px;"></td>
        </tr>
        <tr style="text-align: center;">
            <td>(.........................)</td>
            <td></td>
            <td>(.........................)</td>
            <td></td>
            <td>(.........................)</td>
        </tr>
    </table>
</body>

</html>