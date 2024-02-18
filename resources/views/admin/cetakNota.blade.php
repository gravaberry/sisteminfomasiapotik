
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>APOTIK | Dashboard</title>
</head>
<body>
        <div class="container">
            <h1 style="text-align: center">Apotik Sumber Utama</h1>
            <p style="font-size: 10px; text-align:center">Jl. Sukro No.78 Medan Sumatera Utara</p>
            <p style="font-size: 20px; text-align:center"> Telp :08116626462</p>
            <br>
            <hr style="border: 1px solid; color:red">
            <div class="row">
                <div>
                    <table style="width: 40%">
                        <tr>
                            <td>No NOta</td>
                            <td>:</td>
                            <td>{{ $data[0]->nota }}</td>
                        </tr><tr>
                            <td>Customer</td>
                            <td>:</td>
                            <td>{{ $data[0]->customer }}</td>
                        </tr><tr>
                            <td>Telpon</td>
                            <td>:</td>
                            <td>{{ $data[0]->telp }}</td>
                        </tr><tr>
                            <td>Kasir</td>
                            <td>:</td>
                            <td>{{ $data[0]->name }}</td>
                        </tr>
                    </table>
                    {{-- @php

                    dd($data);
                    @endphp --}}
                    <hr style="border: 1px solid;color:red ">
                    <div>
                        <table style="width: 100%;border:1em">
                            <tr>
                                <td>Kode</td>
                                <td>Nama Barang</td>
                                <td>Qantity</td>
                                <td>Kemasan</td>
                                <td>Harga</td>
                                <td>Jumlah</td>
                            </tr>
                            @foreach ($data as $item)

                            <tr>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->namaObat }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td>{{ $item->jual }}</td>
                                <td>{{ $item->subtotal }}</td>
                            </tr>

                            @endforeach
                        </table>
                    </div>

                    <hr style="border: 1px solid;color:red ">
                    <div>
                        <table style="border: 1em; width:100%; table-layouts:fixed">
                            <tr>
                                <th width="40%"></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>:</td>
                                <td style="text-align: right"> {{number_format($bruto[0]->bruto,2) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>:</td>
                                <td style="text-align: right"> {{ number_format($data[0]->diskon,2) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Diskont</td>
                                <td>:</td>
                                <td style="text-align: right"> {{ number_format($data[0]->dibayar,2) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total Bersih</td>
                                <td>:</td>
                                <td style="text-align: right"> {{ number_format($data[0]->total,2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
