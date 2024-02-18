<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" id="btn-tambah">
        Tambah Suppliers
    </button>
    </div>
    <div class="py-12">
        <div class="mt-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="card">
                        <div class="card-body">
                            <div class="responsive">
                                <table class="table table-hover table-striped" id="tabel">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Telpon</th>
                                            <th>Email</th>
                                            <th>Rekening</th>
                                            <th>Alamat</th>
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
                        <form action="{{ route('suplier.store') }}" method="POST" id="forms">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="hidden" class="form-control" name="id" id="id"
                                        placeholder="Enter nama">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Enter nama">
                                </div>
                                <div class="form-group">
                                    <label for="telpon">Telpon</label>
                                    <input type="number" class="form-control" name="telp"
                                        onkeypress="return number(event)" maxlength="12" id="telp"
                                        placeholder="Enter Telepon">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">No Rekening</label>
                                    <input type="number" class="form-control" name="rekening" id="rekening"
                                        onkeypress="return number(event)" maxlength="12" placeholder="Enter Rekening">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat"
                                        placeholder="Enter Alamat">
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light" id="btn-tutup"
                                    data-dismiss="modal">Close</button>
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
    $(document).ready(function() {
        loaddata();
        toastr.info('Are you the 6 fingered man?')
        //     Swal.fire(
        //   'Good job!',
        //   'You clicked the button!',
        //   'success'
        // )
    });

    function loaddata() {

        $('#tabel').DataTable({
            serverside: true,
            processing: true,
            language: {
                url: "{{ asset('js/bahasa.json') }}"
            },
            ajax: {
                url: "{{ route('supliers') }}"
            },
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'telp',
                    name: 'telp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'rekening',
                    name: 'rekening'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false
                },
            ]
        });
    }

    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    $(document).on('submit', 'form', function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            typeData: "Json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res);
                $('#btn-tutup').click()
                $('#tabel').DataTable().ajax.reload()
                toastr.success(res.text, 'success')
            },
            error: function(xhr) {
                toastr.success(xhr.responseJSON.text, 'Gagal')
            }
        })
    });

    $(document).on('click', '.edit', function() {
        $('#forms').attr('action', "{{ route('suplier.updates') }}")
        let id = $(this).attr('id')
        $.ajax({
            url: "{{ route('suplier.edits') }}",
            type: 'post',
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                console.log(res);
                $('#id').val(res.id)
                $('#nama').val(res.nama)
                $('#telp').val(res.telp)
                $('#email').val(res.email)
                $('#rekening').val(res.rekening)
                $('#alamat').val(res.alamat)
                $('#btn-tambah').click()

            },
            error: function(xhr) {
                console.log(xhr);
            }
        })
    })

    $(document).on('click', '.hapus', function() {

        let id = $(this).attr('id')
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
                    url: "{{ route('suplier.hapus') }}",
                    type: 'post',
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res, status) {
                        if (status = '200') {
                            setTimeout(() => {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil di Hapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((res) => {
                                    $('#tabel').DataTable().ajax.reload()
                                })
                            });
                        }
                    },
                    error: function(xhr) {
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
