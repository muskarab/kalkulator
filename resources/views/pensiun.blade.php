{{-- @extends('back.layouts.app', [
'class' => '',
'elementActive' => 'kalkulator'
]) --}}

@extends('export.app')

@section('title', 'Kalkulator')

@section('css')
    <style>
        input,
        td {
            font-family: 'Times New Roman', Times, serif;
        }

    </style>
@endsection

@section('content')
    <div class="content">
        <div class="row mt-sm-4">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-12 simulasi_pembiayaan">
                        <div class="card">
                            <div class="card-header bg-warning text-white">
                                <h5 class="card-title">Simulasi Pembiayaan</h5>
                            </div>
                            <div class="card-body">
                                <form id="form-calculator">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="nama_nasabah" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Nama Nasabah:</label>
                                                <input style="height: 46px;" type="text" class="form-control"
                                                    id="nama_nasabah" required="">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tgl_lahir" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Tgl. Lahir:</label>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control datepicker" id="tgl_lahir"
                                                        value="01/01/1960" onkeyup="checkInput();" placeholder="mm/dd/yyyy"
                                                        required="">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-black str_nas_usia"
                                                            style="padding-left:5px; padding-right:5px; font-weight: bold;">
                                                            ~ Thn ~ Bln</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="atribusi" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Coverage Asuransi:</label>
                                                <div class="input-group mb-2">
                                                    <select name="atribusi" class="form-control" id="atribusi" required>
                                                        <option selected disabled value="">-- Pilih coverage asuransi --
                                                        </option>
                                                        <option value="Atribusi">Atribusi</option>
                                                        <option value="Non Atribusi">Non Atribusi</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="bunga_pinjaman" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Margin:</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" min="0" max="100" class="form-control"
                                                        id="bunga_pinjaman" onkeyup="checkInput();" required="">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-black"
                                                            style="padding-left:5px; padding-right:5px; font-weight: bold;">
                                                            % / tahun</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="premi_asuransi" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Premi Asuransi:</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" min="0" max="100" class="form-control"
                                                        id="premi_asuransi" onkeyup="checkInput();" required="">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-black"
                                                            style="padding-left:5px; padding-right:5px; font-weight: bold;">
                                                            %</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <label for="gaji_bersih" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Gaji Bersih:</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-black"
                                                            style="padding-left:5px; padding-right:5px; font-weight: bold;">
                                                            Rp.</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="gaji_bersih"
                                                        onkeyup="checkInput();" required="">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="persentase_gaji" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Persentase Gaji:</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" min="0" max="100" class="form-control"
                                                        id="persentase_gaji" onkeyup="checkInput();" required="">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-black"
                                                            style="padding-left:5px; padding-right:5px; font-weight: bold;">
                                                            % (per bulan)</div>
                                                    </div>
                                                </div>
                                                <small style="display:none;" id="less_persentase_gaji"
                                                    class="text_info form-text text-danger">*Tidak boleh kurang dari
                                                    1%</small>
                                                <small style="display:none;" id="more_persentase_gaji"
                                                    class="text_info form-text text-danger">*Tidak boleh lebih dari
                                                    90%</small>
                                                <small class="form-text">(persentase gaji perbulan dari gaji bersih untuk
                                                    angsuran. Max. 90%)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="tenor" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Tenor (bulan):</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" min="0" max="180" class="form-control" id="tenor"
                                                        onkeyup="checkInput();" required="">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-black"
                                                            style="padding-left:5px; padding-right:5px; font-weight: bold;">
                                                            max <span class="str_max_tenor">: ~ Bln</span></div>
                                                    </div>
                                                </div>
                                                <small style="display:none;" id="less_tenor"
                                                    class="text_info form-text text-danger">*Tidak boleh kurang dari 1
                                                    bulan</small>
                                                <small style="display:none;" id="more_tenor"
                                                    class="text_info form-text text-danger">*Tidak boleh lebih dari <span
                                                        class="str_max_tenor">~</span> bulan</small>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="plafon" class="col-form-label pt-0"
                                                    style="color: #000; font-weight: bold;">Plafon:</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-black"
                                                            style="padding-left:5px; padding-right:5px; font-weight: bold;">
                                                            Rp.</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="plafon"
                                                        onkeyup="checkInput();" required="">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text text-black"
                                                            style="padding-left:5px; padding-right:5px; font-weight: bold;">
                                                            max <span class="str_max_plafon">Rp. ~</span></div>
                                                    </div>
                                                </div>
                                                <small style="display:none;" id="less_plafon"
                                                    class="text_info form-text text-danger">*Tidak boleh kurang dari Rp.
                                                    1.000.000</small>
                                                <small style="display:none;" id="more_plafon"
                                                    class="text_info form-text text-danger">*Tidak boleh lebih dari <span
                                                        class="str_max_plafon">Rp. ~</span></small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-0">
                                    <div class="text-right">
                                        <button type="button" id="btn_hitung" onclick="hitung()"
                                            class="btn btn-primary btn-lg">Hitung</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="searchable_card card">
                    <div class="row">
                        <div class="col-md-12 spinner_container" style="display: none">
                            <div class="spinner">
                                <div class="rotate"></div>
                            </div>
                            <div class="spinner-text">
                                <p>Sedang memuat...</p>
                            </div>
                        </div>
                        <div class="col-md-12 content_container" style="display: block">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header py-0 row">
                                        <div class="col-md-12 bg-primary text-white">
                                            <div class="card-header py-0 row">
                                                <div class="col-7 px-0 text-left">
                                                    <h5 class="str_card_title">Tabel Angsuran</h5>
                                                </div>
                                                <div class="col-5 px-0 text-right">
                                                    <button class="btn btn-info btn_cetak" style="display:none;"><i
                                                            class="fa fa-print"></i> Cetak</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="card-title" style="color: #000;">Biaya Lain:</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="setor" class="col-form-label pt-0"
                                                style="color: #000; font-weight: bold;">Administrasi:</label>
                                            <div class="input-group mb-1">
                                                <p id="str_administrasi">Rp. ~</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="setor" class="col-form-label pt-0"
                                                style="color: #000; font-weight: bold;">Asuransi:</label>
                                            <div class="input-group mb-1">
                                                <p id="str_asuransi">Rp. ~</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="setor" class="col-form-label pt-0"
                                                style="color: #000; font-weight: bold;">Blokir 2x Angsuran:</label>
                                            <div class="input-group mb-1">
                                                <p id="str_angsuran_2x">Rp. ~</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="setor" class="col-form-label pt-0"
                                                        style="color: #000; font-weight: bold;">Total Biaya:</label>
                                                    <div class="input-group mb-1">
                                                        <p id="str_total_biaya">Rp. ~</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="setor" class="col-form-label pt-0"
                                                style="color: #000; font-weight: bold;">Terima Bersih:</label>
                                            <div class="input-group mb-1">
                                                <p id="str_terima_bersih">Rp. ~</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="setor" class="col-form-label pt-0"
                                                style="color: #000; font-weight: bold;">Angsuran:</label>
                                            <div class="input-group mb-1">
                                                <p id="str_angsuran">Rp. ~</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="setor" class="col-form-label pt-0"
                                                style="color: #000; font-weight: bold;">Limit Angsuran:</label>
                                            <div class="input-group mb-1">
                                                <p id="str_limit_angsuran">Rp. ~</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="tabel_angsuran">
                                        <thead>
                                            <th class="">Bulan ke</th>
                                            <th class="">Angsuran Margin</th>
                                            <th class="">Angsuran Pokok</th>
                                            <th class="">Total Angsuran</th>
                                            <th class="">Sisa Pinjaman</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="card-footer">
                                <ul style="padding-left:1em;">
                                    <li style="list-style-type: disc !important; margin-left:1em;">Simulasi ini merupakan
                                        ilustrasi pembiayaan pensiun.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- Format Nominal --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="{{ asset('paper/js/plugins/jQuery.print.min.js') }}"></script>
    <script>
        let csrf_token = $('meta[name="csrf-token"]').attr('content');
        let base_url = "{{ url('/') }}";
        let batas_usia = 74;
        let batas_usia_bulan = 6;

        let nas_tahun = '~';
        let nas_bulan = '~';
        let nas_hari = '~';
        let max_plafon = '~';
        let max_tenor = '~';

        let nama_nasabah = "";
        let tgl_lahir = "";
        let tenor = "";
        let bunga_pinjaman = "";
        let gaji_bersih = "";
        let persentase_gaji = "";
        let plafon = "";
        let premi_asuransi = "";

        let limit_angsuran = "~";
        let persentase_administrasi = 1;
        let administrasi = "~";
        let asuransi = "~";
        let angsuran_2x = "~";
        let angsuran = "~";
        let total_biaya = "~";
        let terima_bersih = "~";
        let outstanding_to = "~";
        let terima_bersih_to = "~";

        let last_bunga_pinjaman = 0.00;
        let persen_bunga_pinjaman = 0.00;
        let persen_gaji_bersih = 0.00;

        let bulan = [];
        let angsuran_bunga = [];
        let angsuran_pokok = [];
        let total_angsuran = [];
        let nominal_total_angsuran = [];
        let sisa_pinjaman = [];

        function findAndReplace(string, target, replacement) {
            for (i = 0; i < string.length; i++) {
                string = string.replace(target, replacement);
            }
            return string;
        }

        function CUMIPMT(rate, type) {
            if (!(type == 0 || type == 1)) {
                console.log(7, "#NUM!");
                return "#NUM!";
            }

            let value = 0;
            let pmt = PMT(rate / 12, tenor, plafon, 0, 0);
            for (let i = 0; i < tenor; i++) {
                value += IPMT(plafon, pmt, rate / 12, i);
            }
            return value;
        }

        function rate(nper, pmt, pv, fv, type, guess) {
            // Sets default values for missing parameters
            fv = typeof fv !== 'undefined' ? fv : 0;
            type = typeof type !== 'undefined' ? type : 0;
            guess = typeof guess !== 'undefined' ? guess : 0.1;

            // Sets the limits for possible guesses to any
            // number between 0% and 100%
            var lowLimit = 0;
            var highLimit = 1;

            // Defines a tolerance of up to +/- 0.00005% of pmt, to accept
            // the solution as valid.
            var tolerance = Math.abs(0.00000005 * pmt);

            // Tries at most 40 times to find a solution within the tolerance.
            for (var i = 0; i < 40; i++) {
                // Resets the balance to the original pv.
                var balance = pv;

                // Calculates the balance at the end of the loan, based
                // on loan conditions.
                for (var j = 0; j < nper; j++) {
                    if (type == 0) {
                        // Interests applied before payment
                        balance = balance * (1 + guess) + pmt;
                    } else {
                        // Payments applied before insterests
                        balance = (balance + pmt) * (1 + guess);
                    }
                }

                // Returns the guess if balance is within tolerance.  If not, adjusts
                // the limits and starts with a new guess.
                if (Math.abs(balance + fv) < tolerance) {
                    return guess;
                } else if (balance + fv > 0) {
                    // Sets a new highLimit knowing that
                    // the current guess was too big.
                    highLimit = guess;
                } else {
                    // Sets a new lowLimit knowing that
                    // the current guess was too small.
                    lowLimit = guess;
                }

                // Calculates the new guess.
                guess = (highLimit + lowLimit) / 2;
            }

            // Returns null if no acceptable result was found after 40 tries.
            return null;
        };

        function IPMT(pv, pmt, rate, per) {
            var tmp = Math.pow(1 + rate, per);
            return (pv * tmp * rate + pmt * (tmp - 1));
        }

        function PPMT(rate, per, nper, pv, fv, type) {
            if (per < 1 || (per >= nper + 1)) return null;
            var pmt = this.PMT(rate, nper, pv, fv, type);
            var ipmt = this.IPMT(pv, pmt, rate, per - 1);
            return pmt - ipmt;
        }

        function generateTabelAngsuran() {
            let html = ``;
            let ipmt = 0;
            let ppmt = 0;
            let pmt = 0;
            let _sisa_pinjaman = plafon;

            bulan = [];
            angsuran_bunga = [];
            angsuran_pokok = [];
            total_angsuran = [];
            nominal_total_angsuran = [];
            sisa_pinjaman = [];

            hitungMaxTenor(tgl_lahir);
            hitungMaxPlafon(gaji_bersih, persentase_gaji, bunga_pinjaman);

            pmt = PMT(persen_bunga_pinjaman / 12, tenor, plafon, 0, 0);
            html += `<tr>
                        <td>${0}</td>
                        <td>${toRp(0)}</td>
                        <td>${toRp(0)}</td>
                        <td>${toRp(0)}</td>
                        <td>${toRp(_sisa_pinjaman)}</td>
                    </tr>`;
            bulan.push(0);
            angsuran_bunga.push(0);
            angsuran_pokok.push(0);
            total_angsuran.push(0);
            nominal_total_angsuran.push(0);
            sisa_pinjaman.push(toRp(_sisa_pinjaman));

            for (let i = 0; i < tenor; i++) {
                ipmt = IPMT(plafon, pmt, persen_bunga_pinjaman / 12, i);
                ppmt = (ipmt + pmt) * -1;
                _sisa_pinjaman -= ppmt;
                bulan.push(parseInt(i) + 1);
                html += `<tr>
                            <td>${parseInt(i) + 1}</td>
                            <td>${toRp(ipmt)}</td>
                            <td>${toRp(ppmt)}</td>
                            <td>${toRp(ipmt + ppmt)}</td>
                            <td>${toRp(Math.round(_sisa_pinjaman))}</td>
                        </tr>`;
                angsuran_bunga.push(toRp(ipmt));
                angsuran_pokok.push(toRp(ppmt));
                total_angsuran.push(toRp(ipmt + ppmt));
                nominal_total_angsuran.push(ipmt + ppmt);
                sisa_pinjaman.push(toRp(Math.round(_sisa_pinjaman)));
            }
            $('#tabel_angsuran tbody').html(html);
        }

        function toRp(angka) {
            var rev = parseInt(angka, 10).toString().split('').reverse().join('');
            var rev2 = '';
            for (var i = 0; i < rev.length; i++) {
                rev2 += rev[i];
                if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
                    rev2 += '.';
                }
            }
            return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
        }

        function hitungMaxTenor(tgl_lahir) {
            let now = new Date();
            let today = new Date(now.getYear(), now.getMonth(), now.getDate());
            let yearNow = now.getYear();
            let monthNow = now.getMonth();
            let date_now = now.getDate();

            let arr_tgl_lahir = tgl_lahir.split('/');
            let dob = new Date(arr_tgl_lahir[2], arr_tgl_lahir[0] - 1, arr_tgl_lahir[1]);
            let yearDob = dob.getYear();
            let monthDob = dob.getMonth();
            let date_dob = dob.getDate();

            nas_tahun = yearNow - yearDob;
            if (monthNow >= monthDob)
                nas_bulan = monthNow - monthDob;
            else {
                nas_tahun--;
                nas_bulan = 12 + monthNow - monthDob;
            }

            if (date_now >= date_dob)
                nas_hari = date_now - date_dob;
            else {
                nas_bulan--;
                nas_hari = 31 + date_now - date_dob;
                if (nas_bulan < 0) {
                    nas_bulan = 11;
                    nas_tahun--;
                }
            }
            max_tenor = (((batas_usia - nas_tahun) * 12) + batas_usia_bulan) - nas_bulan;
        }

        function hitungMaxPlafon(gaji_bersih, persentase_gaji, bunga_pinjaman) {
            persen_persentase_gaji = (persentase_gaji / 100);
            persen_bunga_pinjaman = (bunga_pinjaman / 100);
            if (nas_tahun > 74 || nas_tahun < 48) {
                max_plafon = 0
            } else {
                let procesesPmt = getProcessedPmt(nas_tahun, persen_bunga_pinjaman, max_tenor);
                max_plafon = parseInt(((persen_persentase_gaji * gaji_bersih / ((max_tenor * procesesPmt) + 1)) *
                    max_tenor) / 100000) * 100000
            }
        }

        function arrayMin(arr) {
            var len = arr.length,
                min = Infinity;
            while (len--) {
                if (Number(arr[len]) < min) {
                    min = Number(arr[len]);
                }
            }
            return min;
        };

        function hitung() {
            // if(nama_nasabah == "") { $('#btn_hitung').prop('disabled', true); return false; }
            // updateBungaPinjaman();
            hitungHasil();
            generateTabelAngsuran();
            $('.btn_cetak').show();
            // $('#hasil_angsuran_pokok').text(toRp(angsuran_pokok)));
        }

        function hitungHasil() {
            console.log(persen_bunga_pinjaman);
            limit_angsuran = (persentase_gaji / 100) * gaji_bersih;
            $("#str_limit_angsuran").text(toRp(limit_angsuran));
            // angsuran = PMT(+persen_bunga_pinjaman / 12, tenor, -plafon).toFixed(2;
            angsuran = PMT(+persen_bunga_pinjaman / 12, tenor, -plafon);
            $("#str_angsuran").text(toRp(angsuran));

            if ($('#atribusi').val() == "Atribusi") asuransi = 0;
            else asuransi = plafon * (premi_asuransi / 100);
            
            $("#str_asuransi").text(toRp(asuransi));
            administrasi = plafon * (persentase_administrasi / 100);
            $("#str_administrasi").text(toRp(administrasi));
            angsuran_2x = angsuran * 2;
            $("#str_angsuran_2x").text(toRp(angsuran_2x));
            total_biaya = parseFloat(asuransi) + parseFloat(administrasi) + parseFloat(angsuran_2x);
            $("#str_total_biaya").text(toRp(total_biaya));
            terima_bersih = plafon - total_biaya;
            $("#str_terima_bersih").text(toRp(terima_bersih));
            sisa_gaji = gaji_bersih - angsuran;
            $("#str_sisa_gaji").text(toRp(sisa_gaji));
        }

        function updateBungaPinjaman() {
            bunga_pinjaman = $('#bunga_pinjaman').val();
            persen_bunga_pinjaman = bunga_pinjaman / 100;
            if ($('#atribusi').val() == "Atribusi") {
                _fee_asuransi = arrayMin([(premi_asuransi / 100) * (parseFloat(plafon) + (parseFloat(plafon) * 40 / 100)),
                    (premi_asuransi / 100) * (parseFloat(plafon) / (1 - (premi_asuransi / 100)))
                ]);
                console.log("_fee_asuransi", _fee_asuransi);
                _margin = CUMIPMT(persen_bunga_pinjaman, 0);
                console.log("_margin", _margin);
                _total_angsuran = parseFloat(plafon) + parseFloat(_fee_asuransi) + parseFloat(_margin);
                console.log("_total_angsuran", _total_angsuran);
                _angsuran_baru = Math.round(parseFloat(_total_angsuran / tenor));
                console.log("_angsuran_baru", _angsuran_baru);
                _fix_price = ((rate(tenor, -_angsuran_baru, plafon) * 12) * 100).toFixed(2);
                console.log("_fix_price", _fix_price);
                bunga_pinjaman = _fix_price;
                persen_bunga_pinjaman = bunga_pinjaman / 100;
                hitungMaxTenor(tgl_lahir);
                hitungMaxPlafon(gaji_bersih, persentase_gaji, bunga_pinjaman);
            }
            $('.str_nas_usia').text(`${nas_tahun} Thn ${nas_bulan} Bln`);
            $('.str_max_tenor').text(`: ${max_tenor} Bln`);
            $('.str_max_plafon').text(
                `: Rp. ${isNaN(max_plafon)? '~': max_plafon.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`);
        }

        function checkInput() {
            $('.text_info').hide();
            $('#btn_hitung').prop('disabled', true);
            nama_nasabah = $('#nama_nasabah').val();
            tgl_lahir = $('#tgl_lahir').val();
            if (tgl_lahir == "") return false;
            hitungMaxTenor(tgl_lahir);
            $('.str_nas_usia').text(`${nas_tahun} Thn ${nas_bulan} Bln`);
            $('.str_max_tenor').text(`: ${max_tenor} Bln`);
            bunga_pinjaman = parseFloat($('#bunga_pinjaman').val());
            // $('.str_bunga_per_bulan').text(`= ${isNaN((bunga_pinjaman / 12).toFixed(2))? '0.00': (bunga_pinjaman / 12).toFixed(2)} / bulan`);
            gaji_bersih = findAndReplace($('#gaji_bersih').val(), ".", "");
            if (gaji_bersih == "") return false;
            persentase_gaji = parseFloat($('#persentase_gaji').val());
            if (persentase_gaji < 1) {
                $('#less_persentase_gaji').show();
                $('#more_persentase_gaji').hide();
                return false;
            } else if (persentase_gaji > 90) {
                $('#less_persentase_gaji').hide();
                $('#more_persentase_gaji').show();
                return false;
            } else if (persentase_gaji == "") return false;
            hitungMaxPlafon(gaji_bersih, persentase_gaji, bunga_pinjaman);
            $('.str_max_plafon').text(
                `: Rp. ${isNaN(max_plafon)? '~': max_plafon.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`);
            plafon = findAndReplace($('#plafon').val(), ".", "");
            if (plafon < 1000000) {
                $('#less_plafon').show();
                $('#more_plafon').hide();
            } else if (plafon > max_plafon) {
                $('#less_plafon').hide();
                $('#more_plafon').show();
            } else if (plafon == "") {
                $('#btn_hitung').prop('disabled', true);
            }
            tenor = $('#tenor').val();
            if (tenor < 1) {
                $('#less_tenor').show();
                $('#more_tenor').hide();
                return false;
            } else if (tenor > max_tenor) {
                $('#less_tenor').hide();
                $('#more_tenor').show();
                return false;
            }
            premi_asuransi = parseFloat($('#premi_asuransi').val());
            updateBungaPinjaman();
            $('#btn_hitung').prop('disabled', false);
        }

        function resetHasil() {
            $('#form-calculator input').val('');
            $('#nama_nasabah').val(nama_nasabah);
            $('#tgl_lahir').val('01/01/1960');
        }

        function PMT(rate, nperiod, pv, fv, type) {
            if (!fv) fv = 0;
            if (!type) type = 0;
            if (rate == 0) return -(pv + fv) / nperiod;
            var pvif = Math.pow(1 + rate, nperiod);
            var pmt = rate / (pvif - 1) * -(pv * pvif + fv);
            if (type == 1) {
                pmt /= (1 + rate);
            };
            return pmt;
        }

        function getProcessedPmt(nas_tahun, persen_bunga_pinjaman, max_tenor) {
            if (nas_tahun > 74 || nas_tahun < 46) return 0;
            return ((-PMT(persen_bunga_pinjaman / 12, max_tenor, 1, 0) - (1 / max_tenor)) / 1);
        }

        function downloadPDF(response) {
            var blob = new Blob([response], {
                type: 'application/pdf'
            })
            var url = URL.createObjectURL(blob);
            location.assign(url);
        }

        $(document).ready(function() {
            $("#minimizeSidebar").trigger("click");

            $('#tgl_lahir').datetimepicker({
                format: 'MM/DD/YYYY',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });

            $('#gaji_bersih').maskMoney({
                thousands: '.',
                decimal: ',',
                precision: 0
            });
            $('#plafon').maskMoney({
                thousands: '.',
                decimal: ',',
                precision: 0
            });

            $('.text_info').hide();
            $('#btn_hitung').prop('disabled', true);
            // $('.simulasi_pembiayaan .modal-footer').css('display', 'block');
            // $('.simulasi_pembiayaan .modal-footer').css('font-family', 'Arial');
            // $('.simulasi_pembiayaan .modal-footer p').css('font-weight', 'bold');

            // $(document).on("change", '#tgl_lahir', function () {
            //     checkInput();
            // });
            $(document).on("dp.change", '#tgl_lahir', function() {
                checkInput();
            });
            $(document).on("dp.error", '#tgl_lahir', function() {
                checkInput();
            });
            $(document).on("dp.hide", '#tgl_lahir', function() {
                checkInput();
            });
            $(document).on("change", '#atribusi', function() {
                checkInput();
            });
            
        });
    </script>
@endsection
