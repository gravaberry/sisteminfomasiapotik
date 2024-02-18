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
        <!--/.col (left) -->
        <!-- right column -->
            <div class="col-md-8">
                <form action="{{ route('belanja.store') }}" method="POST">
                    @csrf
                    <!-- Form Element sizes -->
                    <div class="card card-danger">
                        <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Data Pembelian</h3>
                        </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="">No Pembelian</label>
                                <input type="text" class="form-control" name="faktur" id="faktur" value="{{ $nomor }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="text" class="form-control" name="tanggal" id="tanggal" value="{{ $time }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="">Nama Suplier</label>
                                <select class="js-example-basic-single form-control form-control custom-select mr-sm-2"  name="supplier" id="supplier" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($suppliers as $id => $nama)
                                    <option value="{{ $id }}">{{ $nama }}</option>
                                    @endforeach
                                </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="">Kode Barang</label>
                                <select data-width="100%"  name="kode" id="kode" class="form-control" required>
                                    <option value="">Masukkan Kode</option>
                                    @foreach ($obats as $key)
                                    <option value="{{ $key->id }}">{{ $key->kode }}</option>
                                    @endforeach
                                </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="text" class="form-control" name="item" id="item" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="">Harga @satuan</label>
                                <input type="text" class="form-control" name="harga" id="harga" value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="">Jumlah Pembelian</label>
                                <input type="text" class="form-control" name="qty" id="qty" onkeypress="return number(event)" maxlength="9" autocomplete="off" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Sub Total</label>
                                    <input type="text" class="form-control" name="subtotal" id="subtotal" value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Pajak</label>
                                    <input type="text" class="form-control" name="pajak" id="pajak" value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Diskon</label>
                                    <input type="text" class="form-control" name="diskon" id="diskon" value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="0">
                                </div>
                            </div>
                        </div>

                            <hr style="border: 2px solid red;">
                            <button class="btn btn-sm btn-danger" id="tambahsimpan" name="tambahsimpan" type="submit"><i class="fas fa-save"></i> Simpan</button>
                            <button class="btn btn-sm btn-danger" id="buka" name="buka" type="submit"><i class="fas fa-plus-circle"></i> Tambah Item</button>
                    </div>
                </form>
            <!-- /.card-body -->
          </div>
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Keranjang</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                  <table id="tabelbeli" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>NO</th>
                      <th>Suplier</th>
                      <th>Nama Obat</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Pajak</th>
                      <th>diskon</th>
                      <th>Total harga</th>
                      <th>Aksi</th>

                    </tr>
                    </thead>
                  </table>
                </div>
                  <div>
                    <br>
                  </div>
                    <div class="col-md-3">
                        <button type="button" id="proses" name="proses" class="btn btn-danger btn-sm float-left"><i class="far fa-file-pdf"></i>
                                &nbsp; ACC/ Proses
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            </div>
        <div class="col-md-4" id="prosesHitung">
            <!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-users"></i> Data Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <hr style="border: 2px solid red;">

                <div class="card-body">
                    <div class="form-group">
                    <label for="">Dibayar Dengan</label>
                    <select class="js-example-basic-single form-control custom-select mr-sm-2"  name="statusbayar" id="statusbayar">
                        <option value="">---| Pilih |---</option>
                        <option value="cash">Cash</option>
                        <option value="hutang">Hutang</option>
                      </select>

                    </div>
                  <div class="form-group">
                    <label for="">Total Kotor</label>
                    <input type="text" class="form-control" name="ttlkotor" id="ttlkotor" value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
                </div>
                  <div class="form-group">
                    <label for="">Besar Pajak</label>
                    <input type="text" class="form-control" name="ttlpajak" id="ttlpajak" value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">Besar Diskon</label>
                  <input type="text" class="form-control" name="ttldiskon" id="ttldiskon" value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="">Total Bersih / Yang Harus Dibayar</label>
                <input type="text" class="form-control" name="grand" id="grand" value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="">Pembayaran Sebesar</label>
              <input type="text" class="form-control" name="dibayar" id="dibayar" placeholder="kosongkan jika metode pembayaran cash/Tunai"
               value="0" onkeypress="return number(event)" maxlength="9" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="">Keterangan</label>
            <input type="text" class="form-control"  name="keteranganbeli" id="keteranganbeli">
        </div>

        <button type="button" class="btn btn-danger btn-sm float-right" id="simpanBeli" name="simpanBeli">
            Simpan
        </button>
              </div>
                <!-- /.card-body -->
              </div>
            <!-- /.card -->


          </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
{{--
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
                    <input type="text" class="form-control" name="totalharga" id="totalharga" onkeypress="return number(event)" maxlength="12">
                  </div>
                <div class="form-group">
                  <label for="diskon">Diskon</label>
                  <input type="text" class="form-control" id="modalDiskon" name="modalDiskon" value="0">
                </div>
                <div class="form-group">
                  <label for="harga">Harga Yang harus Dibayar</label>
                  <input type="text" class="form-control" name="yangHarus" id="yangHarus" onkeypress="return number(event)" maxlength="12">
                </div>
                <div class="form-group">
                  <label for="alamat">Yang Dibayar</label>
                  <input type="text" class="form-control" name="yangDibayar" id="yangDibayar">
                </div>
                <div class="form-group">
                  <label for="alamat">Uang Kembalian</label>
                  <input type="text" class="form-control" name="kembali" id="kembali" >
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
                <button type="submit" class="btn btn-lg btn-success" id="simpanBayar" name="simpanBayar">Bayar</button>

                <button type="reset" class="btn btn-outline-light" id="batal" data-dismiss="modal">Tutup</button>
            </div>

        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div> --}}
</x-app-layout>

@push('js')

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready( function () {
        $('#supplier').select2();
        $('#kode').select2({tags:true});
        // $('#cetak').hide()
        // $('#transaksiBaru').hide()
        loadisi();
        $('#prosesHitung').hide()
    } );

    function loadisi(faktur)
    {
        $('#tabelbeli').DataTable({
        serverside :true,
        processing:true,
        language:{
            url:"{{ asset('js/bahasa.json') }}"
        },
        ajax:{
            url:"{{ route('belanja.dataTable') }}",
            data:{
                faktur:faktur
            }
        },
        columns:[
            {
                "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                 //auto numbering
            },
            {data:'supplier', name:'supplier'},
            {data:'item', name:'item'},
            {data:'harga', name:'harga'},
            {data:'qty', name:'qty'},
            {
                data:'pajakBeli', name:'pajakBeli',
                render:$.fn.DataTable.render.number(',','.',2)
            },
            {
                data:'diskonBeli', name:'diskonBeli',
                render:$.fn.DataTable.render.number(',','.',2)
            },
            {
                data:'totalbersih', name:'totalbersih',
                render:$.fn.DataTable.render.number(',','.',2)
            },
            {data:'aksi', name:'aksi', orderable:false},
        ]
    });
    }

    function number(evt){
        var charCode = (evt.which) ? evt.which :event.keyCode
        if(charCode > 31 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
    }

    //carikode
    $(document).on('change','#kode', function(){
        carikode($(this).val())
    })

    function carikode(kode){
        $.ajax({
            url:"{{ route('carikode') }}",
            type:'post',
            data:{
                kode: kode
            },
            success: function(res){
                if(res.length > 0){
                    $('#item').val(res[0].nama)
                }else{
                    $('#item').val(null)
                }
                console.log(res)
            },
            error: function(xhr){
                console.log(xhr)
            }
        })
    }

    $(document).on('blur','#qty', function(){
        let harga =parseInt($('#harga').val())
        let qty   =parseInt($(this).val())
        $('#subtotal').val(qty * harga)
    })

    $(document).on('blur','#harga', function(){
        let harga =parseInt($('#harga').val())
        let qty =parseInt($(this).val())
         $('#subtotal').val(qty* harga)
    })

    //simpan

    $(document).on('submit','form', function(event){
        let faktur=$('#faktur').val()
        event.preventDefault()
        $.ajax({
            url:$(this).attr('action'),
            type:$(this).attr('method'),
            typedata:"JSON",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function(res){
                console.log(res)
                $('#tabelbeli').DataTable().destroy()
                loadisi(faktur)
                toastr.success(res.text,' success')
            },
            error: function(xhr){

                toastr.error(xhr.responseJSON.text, 'Gagal')
            }
        })
    })

    $(document).on('click','.hapus', function(){
        let id= $(this).attr('id')
        $.ajax({
            url:"{{ route('belanja.hapus') }}",
            type:'post',
            data:{
                id:id,
                _token:"{{ csrf_token() }}"
            },
            success: function(res){
                console.log
                $('#tabelbeli').DataTable().ajax.reload()
                toastr.success(res.text, 'success')
            },
            error: function(xhr)
            {
                console.log(xhr.responseJSON.text,'gagal')
            }
        })
    })

    //acc/hitung

    $(document).on('click','#proses',function(){
        $('#prosesHitung').show()
        let id =$('#faktur').val()

        $.ajax({
            url:"{{ route('belanja.bayar') }}",
            type:'post',
            data:{
                id:id,
                _token:"{{ csrf_token() }}"
            },
            success: function(res){
                console.log(res)
                $('#ttlkotor').val(res.data[0].total_kotor)
                $('#ttlpajak').val(res.data[0].pajak)
                $('#ttldiskon').val(res.data[0].diskons)
                $('#grand').val(res.data[0].total_bersih)
            },
            error: function(xhr){
                console.log(xhr)
            }
        })
    })

    //simpanBeli

    $(document).on('click','#simpanBeli', function(){
        $.ajax({
            url:"{{ route('simpanPenjualan') }}",
            type:'post',
            data:{
                nota :$('#faktur').val(),
                total:$('#ttlkotor').val(),
                pajak:$('#pajak').val(),
                diskon:$('#diskon').val(),
                totalbersih:$('#grand').val(),
                dibayar:$('#dibayar').val(),
                nota:$('#faktur').val(),
                statusbayar:$('#statusbayar').val(),
                _token:"{{ csrf_token() }}"


            },
            success :function(res)
            {
                console.log(res)
                toastr.success(res.text)
            },
            error: function(xhr)
            {
                console.log(xhr.responseJSON.text)
            }
        })
    })
</script>
