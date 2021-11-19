<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="icon" href="'. public_path() .'/img/brand/KSPLOGO.png" type="image/x-icon"/> --}}
    <title>EKATAMATRANS - Permohonan Dana</title>
    <style>
        .header {
            text-align: center;
            width: 100%;
            font-family: 'Courier New', Courier;
            background-color: red;
            color: white;
            padding-top: 15px;
            padding-bottom: 15px;
            border-radius: 5px
        }

        .title {

            align-self: center;
            font-weight: bold;
            font-size: 38px
        }

        /* hr{
         border-top: 2px solid rgb(201, 199, 199);
      } */

        #brand {

            font-size: 28px;
            font-weight: bold;
        }

        #title {
            font-size: 24px;
            font-weight: bold;
        }

        .subhead {
            font-style: italic;
            color: #444;
            /* font-size: 14px; */
        }

        .type {
            font-weight: bold;
        }

        .info {
            width: 100%;
            /* background-color: red; */
            /* display: flex;
         justify-content: space-between; */
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .infoItem {
            font-family: 'Courier New', Courier;
            padding-left: 10px;
            font-style: italic;
            font-weight: bold;
            font-size: 16px;
        }

        .table-no {
            margin-top: 10px;
            /* font-family: Arial, sans-serif; */
            border-collapse: collapse;
            width: 100%;
        }

        .table-no th,
        .table-no td {
            /* border: 1px solid #ddd; */
            padding: 1px;
        }

        .table {
            font-family: 'Courier New', Courier;
            border-collapse: collapse;
            width: 100%;
        }

        .table-header {
            font-family: 'Courier New', Courier;
        }

        .body {
            font-family: 'Courier New', Courier;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table tr:nth-child(even) {
            background-color: #e9e9e9;
        }

        .table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            color: white;
            background-color: rgb(98, 162, 245);
        }

        .table td,
        .table th {
            font-size: 12px;
        }

        /* hr{
         border-top: 2px dashed rgb(201, 199, 199);
      } */

        img {
            width: 50px;
        }

        .logo {}
    </style>
</head>

<body class="body">
    <table border="0px" class="table-no">
        <tr>
            <td rowspan="2">
                <img src="" alt=""><br>
                <span id="brand"><b>EKATAMATRANS LOGISTIK</b></span><br>
                <span class="subhead">Jl. Hayam Wuruk 2xx</span><br>
                <span class="subhead">021 2227 3382</span>
            </td>


            <td rowspan="2" style=" text-align:right;">

                {{-- @php
                   echo "<img src=" .asset( ."'img/logoresponsive.png' ".)" alt="">"
               @endphp --}}
                <span id="title">PERMOHONAN DANA</span><br>
                {{-- <span class="subhead">{{$vessel->name}}</span><br>
                <span class="subhead"></span> --}}
            </td>
        </tr>

    </table>

    <hr>

    <!-- Titel -->

    {{-- <br> --}}

    <!-- <form action="">
        <div class="form-group">
            <p for="">ID Permohonan : {{$permohonandana->id}}</p>
            <p for="">Order No : {{$permohonandana->order_no}}</p>
            <p for="">Tanggal Pengajuan : {{$permohonandana->tanggal_pengajuan}}</p>
            <p for="">Tanggal Transfer : {{$permohonandana->tanggal_transfer}}</p>
        </div>
        <br>
    </form> -->
    <table class="table-header">
        <tr>
            <td>ID Permohonan </td>
            <td>:</td>
            <td>{{$permohonandana->id}}</td>
        </tr>
        <tr>
            <td>Order No </td>
            <td>:</td>
            <td>{{$permohonandana->order_no}}</td>
        </tr>
        <tr>
            <td>Tanggal Pengajuan </td>
            <td>:</td>
            <td>{{date('Y-m-d', strtotime($permohonandana->tanggal_pengajuan)) }}</td>
        </tr>
        <tr>
            <td>Tanggal Transfer </td>
            <td>:</td>
            <td>{{date('Y-m-d', strtotime($permohonandana->tanggal_transfer)) }}</td>
        </tr>
    </table>
    <br>

    <table class="table">
        <thead>
            <tr>
                <td>Permohonan Dana ID</td>
                <td>Deskripsi</td>
                <td>Dasar Harga</td>
                <td>PPN</td>
                <td>PPh</td>
                <td>Total</td>
                <td>Kode Transaksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach($permohonandanasubones as $key => $permohonandanasubone)
            <tr>
                <td>{{$permohonandanasubone->permohonandana_id}}</td>
                <td>{{$permohonandanasubone->deskripsi}}</td>
                <td>{{$permohonandanasubone->dasar_harga}}</td>
                <td>{{$permohonandanasubone->ppn}}</td>
                <td>{{$permohonandanasubone->pph}}</td>
                <td>{{$permohonandanasubone->pengajuan}}</td>
                <td>{{$permohonandanasubone->kd_transaksi}}</td>
            </tr>

            @endforeach

        </tbody>
    </table>
</body>

</html>