<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Anbiotek Storage</title>

    <link href="favicon.ico" rel="shortcut icon" />

    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/laporan.css')}}" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-xs-2 col-md-2">
                <img src="{{ asset('images/anbiotek.png') }}" alt="PT. Anbiotek" height="100px">
            </div>
            <div class="col-sm-10 col-xs-10 col-md-10">
                <p class="text-large">PT. Andalas Bioteknologi Saiyo</p>
                <p>Komp. Cendana Mata Air Thp. VIII Blok A/4 Koto Baru Nan XX, Padang 25171 <br>Telepon: +62751 64652, Email: bioteknologiandalas@yahoo.co.id</p>
            </div>
        </div>
        <br><br><br><br><br><br><hr>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <p class="text-center"><b>LAPORAN STOK PRODUK</b></p>
                <p class="text-center">{{ date('d/m/Y') }}</p>
                <br>
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr class="bg-blue">
                            <th>NO KATALOG</th>
                            <th>PRODUK</th>
                            <th>MERK</th>
                            <th>QTY</th>
                            <th>SATUAN</th>
                            <th>EXPIRE</th>
                            <th>KET</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach ($reportbarang as $value)
                            <tr>
                                <td colspan="7"><b>Kategori : {{ $value['nmkategori'] }}</b></td>
                            </tr>
                            @foreach ($value['produk'] as $element)
                                <tr>
                                    <td>{{ $element->kode }}</td>
                                    <td>{{ $element->nmbarang }}</td>
                                    <td>{{ $element->merk->nmmerk }}</td>
                                    <td class="text-center"><strong>{{ $element->stock }}</strong></td>
                                    <td>{{ $element->satuan->nmsatuan }}</td>
                                    <td>{{ Carbon\Carbon::parse($element->expire)->format('d/m/Y') }}</td>
                                    <td>{{ $element->ket }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
