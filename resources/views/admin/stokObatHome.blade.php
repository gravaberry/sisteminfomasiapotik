<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" id="btn-tambah">
      Tambah StokObat
    </button>
  </div>
    <div class="py-12">
      <div class="mt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="responsive">
                            <table class="table table-hover table-striped" id="tabelstok">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stock</th>
                                    <th>Keterangan</th>
                                    <th>Update Trakhir</th>
                                    <th>Admin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            </table>
                        </div>
                        </div>
                      </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-info">
      <div class="modal-dialog">
        <div class="modal-content bg-info">
          <div class="modal-header">
            <h4 class="modal-title">Info Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('stokobat.store') }}" method="POST" id="forms">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Obat</label>
                        <select name="obat" id="obat" class="form-control">
                            <option value="">Pilih Obat</option>
                            @foreach ($obat as $kat)
                              <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        Stok Obat
                        <hr style="border: :1px solid red;">
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nama">Stok Awal</label>
                                <input type="hidden" class="form-control"  autocomplete="off" name="id" id="id" onkeypress="return number(event)">
                                <input type="text" class="form-control" readonly value="0" autocomplete="off" name="stoklama" id="stoklama" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nama">Masuk</label>
                                <input type="text" class="form-control" value="0" autocomplete="off" name="masuk" id="masuk" onkeypress="return number(event)" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nama">Keluar</label>
                                <input type="text" class="form-control" value="0" autocomplete="off" name="keluar" id="keluar" onkeypress="return number(event)" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label >Stok Akhir</label>
                      <input type="text" class="form-control" autocomplete="off" name="stok" id="stok" onkeypress="return number(event)">
                    </div>
                    <div>
                        Stok Obat
                        <hr style="border: :1px solid red;">
                    </div>
                    <div class="form-group">
                      <label for="nama">Harga Beli</label>
                      <input type="text" class="form-control" autocomplete="off" name="beli" id="beli" data-inputmask="'alias':'numeric,'prefix':'Rp.','digits:2,'groupSeparator':',','autogroup':true, digitsOptional':false">
                    </div>
                  <div class="form-group">
                    <label for="alamat">Harga Jual</label>
                    <input type="text" class="form-control" autocomplete="off" name="jual" id="jual" data-inputmask="'alias':'numeric,'prefix':'Rp.','digits:2,'groupSeparator':',','autogroup':true, digitsOptional':false">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Tanggal Expired</label>
                    <input type="date" class="form-control" autocomplete="off" name="expired" id="expired">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Keterangan</label>
                    <input type="text" class="form-control" autocomplete="off" name="keterangan" id="keterangan" placeholder="Kurang Lebih Rusak">
                  </div>

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" id="btn-tutup" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning" id="simpan">Simpan</button>
          </div>

        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</x-app-layout>

@stack('js')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready( function () {
    loadstok();
    } );

    function loadstok(){
        $('#tabelstok').DataTable({
            serverSide:true,
            processing:true,
            ajax:{
                url:"{{ route('stokobats') }}"
            },
            columns:[
                {data:'namaObat',name:'namaObat'},
                {data:'beli',name:'beli'},
                {data:'jual',name:'jual'},
                {data:'stok',name:'stok'},
                {data:'keterangan',name:'keterangan'},
                {data:'updated_at',name:'updated_at'},
                {data:'admins',name:'admins'},
                {data:'aksi',name:'aksi', orderable:false},
            ]
        });
    }

    ///

    $(document).on('submit','form',function(event){
        event.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            type:$(this).attr('method'),
            typeData :"JSON",
            data:new FormData(this),
            processData :false,
            contentType:false,
            success:function(res){
                console.log(res)
                $('#btn-tutup').click()
                $('#tabelstok').DataTable().ajax.reload()
                toastr.success(res.text, 'success')
                $('#forms')[0].reset();
            },
            error:function(xhr){
                toastr.success(xhr.responseJSON.text, 'Gagal')
            }
        })
    })
    function number(evt){
        var charCode = (evt.which) ? evt.which :event.keyCode
        if(charCode > 31 && (charCode < 48 || charCode > 57 ))
        return false;
    return true;
    }

   $(document).on('change','#obat', function(){
        let id= $(this).val()
        $.ajax({
            url:"{{ route('getObat') }}",
            type:'post',
            data:{
                id:id,
                _token :"{{ csrf_token() }}"
            },
            success:function(res){
                $('#stoklama').val(res.data.stok)
                console.log(res)
            },
            error:function(xhr){
                console.log(xhr)
            }
        })
    })

    //masuk dan keluar

    $(document).on('blur','#masuk',function(){
        let awal =parseInt($('#stoklama').val())
        let masuk =parseInt($('#masuk').val())
        let keluar= parseInt($('#keluar').val())
        let akhir = (awal + masuk) - keluar
        $('#stok').val(akhir)
    })
    $(document).on('blur','#keluar',function(){
        let awal =parseInt($('#stoklama').val())
        let masuk =parseInt($('#masuk').val())
        let keluar= parseInt($('#keluar').val())
        let akhir = (awal + masuk) - keluar
        $('#stok').val(akhir)
    })

    ///edits

    $(document).on('click','.edit',function(){
        $('#forms').attr('action',"{{ route('stokobat.updates') }}")
        $('#btn-tambah').click()
        let id = $(this).attr('id')

        $.ajax({
            url:"{{ route('stokobat.edits') }}",
            type:'post',
            data:{
                id:id,
                _token:"{{ csrf_token() }}"
            },
            success:function(res){
                let newOption= new Option(res.namaObat,res.idObat,true,true)
                $('#id').val(res.id)
                $('#obat').append(newOption).trigger('change')
                $('#stoklama').val(res.stok)
                $('#beli').val(parseInt(res.beli) + '00')
                $('#jual').val(parseInt(res.jual) + '00')
                $('#expired').val(res.expired)
                $('#keterangan').val(res.keterangan)
                $('#btn-tambah').click()
                console.log(res)
            },
            error:function(xhr){
                console.log(xhr)
            }
        })
    })

    //hapus

    $(document).on('click','.hapus', function(){
        let id= $(this).attr('id')
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('stokobat.hapus') }}",
                    type:'post',
                    data:{
                        id:id,
                        _token:"{{ csrf_token() }}"
                    },
                    success:function(res,status){
                        if(status='status'){
                            setTimeout(()=>{
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data Berhasil di Hapus',
                                showConfirmButton: false,
                                timer: 1500
                                }).then((res)=>{
                                $('#tabelstok').DataTable().ajax.reload()
                            })
                            })
                        }

                    },
                    error:function(xhr){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                })
            }
            })

    })
</script>
