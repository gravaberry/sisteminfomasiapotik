<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fas fa-users"></i> Data Customer</h3>
                        </div>
                        <!-- /.card-header -->
                        <hr style="border: 2px solid red;">
                        <!-- form start -->
                        <form action="{{ route('penjualans.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama Pasien</label>
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Enter Nama Pasien">
                                </div>
                                <div class="form-group">
                                    <label for="">NO Telepon</label>
                                    <input type="text" class="form-control" onkeypress="return number(event)"
                                        maxlength="12" id="telp" name="telp" placeholder="Enter No Telp">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5" placeholder="Jl.Sukro"></textarea>
                                </div>

                                <hr style="border: 2px solid red;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">No Resep</label>
                                            <input type="text" class="form-control" id="resep" name="resep"
                                                placeholder="Isi No Resep Jika Ada">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">No Pengirim</label>
                                            <input type="text" class="form-control" id="pengirim" name="pengirim"
                                                placeholder="Isi Pengirim Jika Ada">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-8">
                    <!-- Form Element sizes -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Data Penjualan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Obat</label>
                                        <select class="js-example-basic-single form-control custom-select mr-sm-2"
                                            name="obat" id="obat">
                                            <option value="">Pilih Obat</option>
                                            @foreach ($obat as $kat)
                                                <option value="{{ $kat->id }}">{{ $kat->namaObat }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Stok Tersedia</label>
                                        <input type="text" class="form-control" name="stoks" id="stoks"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">No Kwitansi</label>
                                        <input type="text" class="form-control" name="no" id="no"
                                            readonly value="{{ $nomors }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input type="text" class="form-control" name="tanggal" id="tanggal"
                                            readonly value="{{ $tanggals }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Jumlah Pembelian</label>
                                        <input type="number" class="form-control" name="qty" id="qty"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Harga@Satuan</label>
                                        <input type="text" class="form-control" name="harga" id="harga"
                                            readonly onkeypress="return number(event)">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Diskon</label>
                                        <input type="text" class="form-control" name="diskon" id="diskon"
                                            placeholder="Enter Diskon" onkeypress="return number(event)">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Total Harga</label>
                                        <input type="text" class="form-control" name="total" id="total"
                                            readonly onkeypress="return number(event)">
                                    </div>
                                </div>
                            </div>

                            <hr style="border: 2px solid red;">
                            <button class="btn btn-sm btn-primary" id="tambah" name="tambah" type="submit"><i
                                    class="fas fa-save"></i> Simpan</button>
                            </form>
                            <button class="btn btn-sm btn-warning" id="buka" name="bukachrome"
                                type="submit"><i class="fas fa-plus-circle"></i> Tambah</button>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="tabeljual" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Nama Obat</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Total Harga</th>
                                                <th>Aksi</th>

                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="col-md-3">
                                        <form action="{{ route('cetakNota') }}" method="POST">
                                            @csrf
                                            <input type="text" hidden class="form-control" name="kwitansi"
                                                id="kwitansi" autocomplete="off" onkeypress="return number(event)"
                                                maxlength="12" value="{{ $nomors }}">
                                            <button type="submit" id="cetak" name="cetak"
                                                class="btn btn-danger btn-sm float-left"><i
                                                    class="far fa-file-pdf"></i>
                                                &nbsp; Cetak SLip
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm float-right"
                                            id="btn-bayar" name="btn-bayar" data-toggle="modal"
                                            data-target="#modal-info">
                                            Proses
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Transaksi Pembayaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('simpanPenjualan') }}" method="POST" id="transaksiBaru">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Form Pembayaran</label>
                                <hr class="" style="border: 1px solid;color:red;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nota" id="nota">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Kasir : {{ Auth::user()->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="total">Total Harga</label>
                                <input type="text" class="form-control" name="totalharga" id="totalharga"
                                    onkeypress="return number(event)" maxlength="12">
                            </div>
                            <div class="form-group">
                                <label for="diskon">Diskon</label>
                                <input type="text" class="form-control" id="modalDiskon" name="modalDiskon"
                                    value="0">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Yang harus Dibayar</label>
                                <input type="text" class="form-control" name="yangHarus" id="yangHarus"
                                    onkeypress="return number(event)" maxlength="12">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Yang Dibayar</label>
                                <input type="text" class="form-control" name="yangDibayar" id="yangDibayar">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Uang Kembalian</label>
                                <input type="text" class="form-control" name="kembali" id="kembali">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Status Bayar</label>
                                <select id="statusbayar" name="statusbayar" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="lunas">Lunas</option>
                                    <option value="belumlunas">Belum Lunas</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-lg btn-success" id="simpanBayar"
                                name="simpanBayar">Bayar</button>

                            <button type="reset" class="btn btn-outline-light" id="batal"
                                data-dismiss="modal">Tutup</button>
                        </div>

                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
</x-app-layout>

@push('js')

    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#obat').select2();
            // $('#cetak').hide()
            // $('#transaksiBaru').hide()
        });


        function number(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $('#obat').change(function() {
            let id = $(this).val()
            $.ajax({
                url: "{{ route('getdataObat') }}",
                type: 'post',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    $('#harga').val(res.jual)
                    $('#stoks').val(res.stok)

                }
            })
        })

        //total

        $(document).on('blur', '#qty', function() {
            let harga = parseInt($('#harga').val())
            let qty = parseInt($(this).val())
            let stok = parseInt($('#stoks').val()) - qty
            $('#total').val(qty * harga)
            $('#stoks').val(stok)
        })

        //tambah

        $(document).on('submit', 'form', function(event) {
            event.preventDefault()
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                typeData: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);
                    $('#obat').prop('disabled', true);
                    $('#qty').attr('disabled', true)
                    $('#diskon').attr('disabled', true)
                    $('#tambah').hide()
                    $('#tabeljual').DataTable().ajax.reload()
                    toastr.success(res.text, 'success')
                }
            })
        })

        //datatabl
        $('#tabeljual').DataTable({
            serverside: true,
            processing: true,
            language: {
                url: "{{ asset('js/bahasa.json') }}"
            },
            ajax: {
                url: "{{ route('penjualans.dataTable') }}",
                data: {
                    id: $('#no').val()
                }
            },
            columns: [{
                    "data": "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    //auto numbering
                },
                {
                    data: 'namaObat',
                    name: 'namaObat'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'jual',
                    name: 'jual',
                    render: $.fn.DataTable.render.number(',', '.', 2)
                },
                {
                    data: 'subtotal',
                    name: 'subtotal',
                    render: $.fn.DataTable.render.number(',', '.', 2)
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false
                },
            ]
        });

        //hapus

        $(document).on('click', '.hapus', function() {
            let id = $(this).attr('id')
            $.ajax({
                url: "{{ route('hapusOrder') }}",
                type: 'post',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}",

                },
                success: function(res) {
                    console.log(res);
                    $('#tabeljual').DataTable().ajax.reload();
                    toastr.success(res.text, 'success')
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON.text)
                }
            })
        })

        //aktifkan simpan
        $('#buka').click(function() {
            $('#tambah').show()
            $('#obat').prop('disabled', false)
            $('#qty').attr('disabled', false)
            $('#qty').val(null)
            $('#diskon').attr('disabled', false)
        })


        //cari total, @param[id], #btnbayar

        $('#btn-bayar').click(function() {
            let id = $('#no').val()
            $.ajax({
                url: "{{ route('hitung') }}",
                type: 'post',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res)
                    $('#totalharga').val(res.data[0].totalHarga)
                    $('#yangHarus').val(parseInt(res.data[0].totalHarga) - parseInt(res.diskon))
                    $('#modalDiskon').val(res.diskon)
                    $('#nota').val(res.data[0].nota)
                }
            })
        })


        //kembalian

        $(document).on('blur', '#yangDibayar', function() {
            let a = parseInt($('#yangHarus').val())
            let b = $(this).val()
            let c = b - a

            if (c < 0) {
                toastr.info('periksa inputan', 'info')
                $('#simpanBayar').hide()
            } else {
                $('#kembali').val(c)
                $('#simpanBayar').show()
            }
        })

        // $(document).on('blur','#yangDibayar', function(){
        //     let a = parseInt($('#yangHarus').val())
        //     let b = $(this).val()
        //     let c = b - a

        //     if(c < 0){
        //         toastr.info('periksa inputan','info')
        //         $('#simpaBayar').hide()
        //     }else{

        //         $('#kembali').val(c)
        //         $('#simpaBayar').show()
        //     }
        // })

        //simpan bayar

        $('#simpanBayar').click(function() {
            $.ajax({
                url: "{{ route('simpanPenjualan') }}",
                type: 'post',
                data: {
                    total: $('#yangHarus').val(),
                    diskon: $('#modalDiskon').val(),
                    dibayar: $('#yangDibayar').val(),
                    statusbayar: $('#statusbayar').val(),
                    nota: $('#nota').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    toastr.success(res.text, 'success')
                    $('#batal').click()
                    $('#tambah').hide()
                    $('#cetak').show()
                    $('#transaksiBaru').hide()
                    $('#tabeljual').destroy()
                    $('#tabeljual').DataTable().ajax.reload()
                }
            })
        })
    </script>
