<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" id="btn-tambah">
      Tambah Obat
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
                            <table class="table table-hover table-striped" id="tabelobat">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Dosis</th>
                                    <th>Indikasi</th>
                                    <th>Alamat</th>
                                    <th>Kategori</th>
                                    <th>Satuan</th>
                                    <th>Ready</th>
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
            <form action="{{ route('obat.store') }}" method="POST" id="forms">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="hidden" class="form-control" name="id" id="id" placeholder="Enter nama">
                      <input type="text" class="form-control" autocomplete="off" name="nama" id="nama" placeholder="Enter nama">
                    </div>
                    <div class="form-group">
                      <label >Kode</label>
                      <input type="text" class="form-control" autocomplete="off" name="kode" id="kode" placeholder="Enter Kode">
                    </div>
                    <div class="form-group">
                      <label for="nama">Dosis</label>
                      <input type="text" class="form-control" autocomplete="off" name="dosis" id="dosis" placeholder="Enter Dosis">
                    </div>
                  <div class="form-group">
                    <label for="alamat">Indikasi</label>
                    <input type="text" class="form-control" autocomplete="off" name="indikasi" id="indikasi"  placeholder="Enter Indikasi">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" autocomplete="off" name="alamat" id="alamat" placeholder="Enter Alamat">
                  </div>
                  <div class="form-group">
                      <label for="">Kategori</label>
                      <select name="kategori" id="kategori" class="form-control">
                          <option value="">Pilih Kategori</option>
                          @foreach ($kategoris as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->kategori }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="">Satuan</label>
                      <select name="satuan" id="satuan" class="form-control">
                          <option value="">Pilih Satuan</option>
                          @foreach ($satuans as $sat)
                            <option value="{{ $sat->id }}">{{ $sat->satuan }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="">Ready</label>
                      <select name="ready" id="ready" class="form-control">
                          <option value="">Pilih Salah Satu</option>
                          <option value="Y">Yes</option>
                          <option value="N">No</option>
                      </select>
                  </div>

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" id="btn-tutup" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-light" id="simpan">Save changes</button>
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
        loadobat();
    } );

    function loadobat(){
        $('#tabelobat').DataTable({
            serverside:true,
            processing:true,
            ajax:{
                url:"{{ route('obats') }}"
            },
            columns:[
                {data:'nama',name:'nama'},
                {data:'kode',name:'kode'},
                {data:'dosis',name:'dosis'},
                {data:'indikasi',name:'indikasi'},
                {data:'alamat',name:'alamat'},
                {data:'kategoris',name:'kategoris'},
                {data:'satuans',name:'satuans'},
                {data:'ready',name:'ready'},
                {data:'aksi',name:'aksi', orderable:false},
            ]
        });
    }

    //simpan

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
                $('#tabelobat').DataTable().ajax.reload()
                toastr.success(res.text, 'success')
                $('#forms')[0].reset();
            },
            error:function(xhr){
                toastr.success(xhr.responseJSON.text, 'Gagal')
            }
        })
    })

    //edit

    $(document).on('click','.edit', function(){
        $('#forms').attr('action',"{{ route('obat.updates') }}")
        let id= $(this).attr('id')
        $.ajax({
            url:"{{ route('obat.edits') }}",
            type:"post",
            data:{
                id:id,
                _token:"{{ csrf_token() }}"
            },
            success:function(res){
                console.log(res)
                $('#id').val(res.id)
                $('#nama').val(res.nama)
                $('#kode').val(res.kode)
                $('#dosis').val(res.dosis)
                $('#indikasi').val(res.indikasi)
                $('#alamat').val(res.alamat)
                $('#kategori').val(res.kategori)
                $('#satuan').val(res.satuan)
                $('#ready').val(res.ready)
                $('#btn-tambah').click()
            },
            error: function(xhr){
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
                    url:"{{ route('obat.hapus') }}",
                    type:'post',
                    data:{
                        id:id,
                        _token:"{{ csrf_token() }}"
                    },
                    success:function(res,status){
                        console.log(res)
                        if(status='200'){
                            setTimeout(()=>{
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data Berhasil di Hapus',
                                showConfirmButton: false,
                                timer: 1500
                                }).then((res)=>{
                                    $('#tabelobat').DataTable().ajax.reload()
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
