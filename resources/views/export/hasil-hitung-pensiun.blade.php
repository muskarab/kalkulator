<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hasil Simulasi Pembiayaan Pensiun</title>
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url(public_path('paper/fonts/SourceSansPro-Regular.ttf'));
        }
        
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #00622f;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #000;
            background: #FFFFFF;
            /* font-family: Arial, sans-serif; */
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
            text-align: left;
        }

        #logo img {
            height: 50px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #title {
            text-align: left;
        }

        #title h2{
            margin: 0;
        }

        #details {
            margin-bottom: 10px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #00622f;
            float: left;
            text-align: left;
            width:100%;
        }

        #client, #title h2 {
            /* font-family: 'Times New Roman', Times, serif; */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        
        table th {
            font-weight: normal;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #FFFFFF;
        }

        table .no {
            font-size: 1em;
        }

        table .nama {
            text-align: left;
            background: #eee;
        }

        table .prob {
            background: #eee;
        }

        table td.alamat,
        table td.jarak,
        table td.prob {
            font-size: 1em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            /* font-size: 1.2em; */
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #00622f;
            /* font-size: 1.4em; */
            border-top: 1px solid #00622f;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #00622f;
        }
    </style>
</head>

<body>    
    <header class="clearfix">
        <table style="margin: 0;">
            <thead>
                <tr>
                    <th id="logo">
                        <img style="margin-right: 5px;" width="50px" src="{{ public_path('paper/img/favicon.png') }}">
                        <img style="margin-right: 5px;" width="80px" src="{{ public_path('paper/img/logo-bsi-color.png') }}">
                        <img style="margin-right: 5px;" width="50px" src="{{ public_path('paper/img/logo-eka-black.png') }}">
                    </th>
                    <th id="company">
                        <h2>{{ $site_name?? 'Sistemberkah.id' }}</h2>
                        {{-- <div>{{ $business_address?? 'Jl. Dawuhan Tegalgondo RT 24/06 Karangploso, Malang, Jawa Timur, 65152' }}</div>
                        <div><a href="#">{{ $business_email?? 'admin@ekakarjati.id' }}</a></div> --}}
                    </th>
                </tr>
                <tr>
                    <th id="title">
                        <h2>{{ $judul?? 'Hasil Simulasi Pembiayaan Pensiun' }}</h2>
                    </th>
                </tr>
            </thead>
        </table>
    </header>
    <main>
        <div id="details" class="clearfix">
            <table>
                <thead>
                    <tr>
                        <th id="client">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td style="padding:5px; text-align:left !important;" width="20%">Nama Nasabah</td>
                                        <td style="padding:5px; text-align:left !important;" width="80%">: {{ $nama_nasabah }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; text-align:left !important;" width="20%">Tgl. Lahir</td>
                                        <td style="padding:5px; text-align:left !important;" width="80%">: {{ $tgl_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; text-align:left !important;" width="20%">Gaji Bersih</td>
                                        <td style="padding:5px; text-align:left !important;" width="80%">: Rp. {{ $gaji_bersih }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; text-align:left !important;" width="20%">Persentase Gaji</td>
                                        <td style="padding:5px; text-align:left !important;" width="80%">: {{ $persentase_gaji }}%</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; text-align:left !important;" width="20%">Margin Akhir</td>
                                        <td style="padding:5px; text-align:left !important;" width="80%">: {{ $bunga_pinjaman }}%</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; text-align:left !important;" width="20%">Premi Asuransi</td>
                                        <td style="padding:5px; text-align:left !important;" width="80%">: {{ $premi_asuransi }}%</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; text-align:left !important;" width="20%">Plafon</td>
                                        <td style="padding:5px; text-align:left !important;" width="80%">: Rp. {{ number_format($plafon,2,',','.') }} (Max: Rp. {{ number_format($max_plafon,2,',','.') }})</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; text-align:left !important;" width="20%">Tenor</td>
                                        <td style="padding:5px; text-align:left !important;" width="80%">: {{ $tenor }} Bln (Max: {{ $max_tenor }} Bln)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>{!! isset($deskripsi) && $deskripsi == ""? "-": $deskripsi?? '-' !!}</p>
                            <div class="ttd" style="text-align: right;">
                                <p style="margin-bottom: 50px;">Sales</p>
                                <p><strong>{{ Auth::user()->name }}</strong></p>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
        <hr>
        <div id="notices">
            <h5>Biaya Lain:</h5>
            <table>
                <tbody>
                    <tr>
                        <td style="padding:5px; text-align:left !important;" width="20%">Administrasi</td>
                        <td style="padding:5px; text-align:left !important;" width="80%">: Rp. {{ number_format($administrasi,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:5px; text-align:left !important;" width="20%">Asuransi</td>
                        <td style="padding:5px; text-align:left !important;" width="80%">: Rp. {{ number_format($asuransi,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:5px; text-align:left !important;" width="20%">2x Angsuran</td>
                        <td style="padding:5px; text-align:left !important;" width="80%">: Rp. {{ number_format($angsuran_2x,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:5px; text-align:left !important;" width="20%">Total Biaya</td>
                        <td style="padding:5px; text-align:left !important;" width="80%">: Rp. {{ number_format($total_biaya,2,',','.') }}</td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table>
            <hr>
            <h5>Tabel Angsuran:</h5>
            <table>
                <tbody>
                    <tr>
                        <td style="padding:5px; text-align:left !important;" width="20%">Angsuran</td>
                        <td style="padding:5px; text-align:left !important;" width="80%">: Rp. {{ number_format($angsuran,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:5px; text-align:left !important;" width="20%">Limit Angsuran</td>
                        <td style="padding:5px; text-align:left !important;" width="80%">: Rp. {{ number_format($limit_angsuran,2,',','.') }}</td>
                    </tr>
                </tbody>
            </table>
            @if (count($bulan) > 0)
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th style="border-right: 1px solid #eee; font-weight: bold;" class="no">Bulan ke</th>
                            <th style="border-right: 1px solid #eee; font-weight: bold;" class="nama">Angsuran Bunga</th>
                            <th style="border-right: 1px solid #eee; font-weight: bold;" class="alamat">Angsuran Pokok</th>
                            <th style="border-right: 1px solid #eee; font-weight: bold;" class="prob">Total Angsuran</th>
                            <th style="border-right: 1px solid #eee; font-weight: bold;" class="alamat">Sisa Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $tenor + 1; $i++)
                            <tr>
                                <td style="border-right: 1px solid #eee;" class="no" width="5%">{{ $bulan[$i] + 1 }}</td>
                                <td style="border-right: 1px solid #eee;" class="nama" width="20%">{{ $angsuran_bunga[$i] }}</td>
                                <td style="border-right: 1px solid #eee;" class="alamat" width="25%">{{ $angsuran_pokok[$i] }}</td>
                                <td style="border-right: 1px solid #eee;" class="prob" width="25%">{{ $total_angsuran[$i] }}</td>
                                <td style="border-right: 1px solid #eee;" class="alamat" width="25%">{{ $sisa_pinjaman[$i] }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <p>CATATAN:</p>
                <ul style="padding-left:1em;">
                    <li style="list-style-type: disc !important; margin-left:1em;">Simulasi ini merupakan ilustrasi pembiayaan pensiun.</li>
                </ul>
            @else
                <p>-</p>
            @endif
        </div>
    </main>
</body>

</html>