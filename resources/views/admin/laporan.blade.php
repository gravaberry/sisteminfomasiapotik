<x-app-layout>
    <div class="py-12">

        <div class="col-12 col-sm-12">
            {{-- <div class="d-flex justify-content-center">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                        </div>
                    </div>
                </div>
                <div>
                    <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
                    <button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
                </div>
            </div> --}}
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                aria-selected="true">Laporan Penjualan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                                aria-selected="false">Laporan Pembelian</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                            aria-labelledby="custom-tabs-one-home-tab">

                            <div class="table-responsive">
                                <table id="tabelpenjualan" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nota</th>
                                            <th>Tanggal</th>
                                            <th>Qty</th>
                                            <th>Diskon</th>
                                            <th>Nama Obat</th>
                                            <th>Subtotal</th>
                                            <th>Customer</th>
                                            <th>Kasir</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <button type="button" class="btn btn-default" data-toggle="modal" id="btnModalJual"
                                data-target="#modal-xl" hidden>
                                Launch Extra Large Modal
                            </button>

                            {{-- <div class="d-flex justify-content-center">
                    <div class="row">
                        <div class="col-6">
                            <form action="{{ route('exportlaporan') }}" method="get">
                                <input type="text" id="minp" name="minp">
                                <input type="text" id="maxp" name="maxp">
                                <button class="btn btn-warning">Export Penjualan</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <input type="text" id="min" name="min">
                            <input type="text" id="max" name="max">
                            <button class="btn btn-warning">Export Pembelian</button>
                        </div>
                    </div>
                </div> --}}
                            <a href="{{ route('exportlaporan') }}" class="btn btn-primary">Export Ke Excel
                                Penjualan</a>
                        </div>



                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-one-profile-tab">

                            <div class="table-responsive">
                                <table id="tabelpembelian" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Faktur</th>
                                            <th>Harga</th>
                                            <th>Nama Obat</th>
                                            <th>Qty</th>
                                            {{-- <th>TotalKotor</th> --}}
                                            <th>diskon</th>
                                            <th>Total Bersih</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Pajak</th>
                                            <th>Admin</th>
                                            <th>Suplier</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <a href="{{ route('exportpembelian') }}" class="btn btn-primary">Export Ke Excel
                                Pembelian</a>
                        </div>

                        <button type="button" class="btn btn-default" data-toggle="modal" id="btnModalBeli"
                            data-target="#modal-beli" hidden>
                            Launch Extra Large Modal
                        </button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

    {{-- modaljual --}}
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Details Penjualans</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tabelDetailJual" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nota</th>
                                    <th>Tanggal</th>
                                    <th>Qty</th>
                                    <th>Diskon</th>
                                    <th>Nama Obat</th>
                                    <th>Subtotal</th>
                                    <th>Customer</th>
                                    <th>Kasir</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                {{-- <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    {{-- modalBeli --}}
    <div class="modal fade" id="modal-beli">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Details Pembelians</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tabelDetailBeli" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Faktur</th>
                                    <th>Harga</th>
                                    <th>Nama Obat</th>
                                    <th>Qty</th>
                                    {{-- <th>TotalKotor</th> --}}
                                    <th>diskon</th>
                                    <th>Total Bersih</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Pajak</th>
                                    <th>Admin</th>
                                    <th>Suplier</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                {{-- <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</x-app-layout>


@push('js')

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Datatables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
    </script>
    <!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            loadjual();
            loadbeli();
        })

        $(function() {
            $("#start_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $("#end_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });
    </script>
    <script>
        // Fetch records
        function fetch(start_date, end_date) {
            $.ajax({
                url: "{{ route('laporan.records') }}",
                type: "get",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                dataType: "json",
                success: function(data) {
                    // Datatables
                    var i = 1;
                    $('#records').DataTable({
                        "data": data.students,
                        // buttons
                        "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        "buttons": [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        // responsive
                        "responsive": true,
                        "columns": [{
                                "data": "id",
                                "render": function(data, type, row, meta) {
                                    return i++;
                                }
                            },
                            {
                                "data": "name"
                            },
                            {
                                "data": "standard",
                                "render": function(data, type, row, meta) {
                                    return `${row.standard}th Standard`;
                                }
                            },
                            {
                                "data": "percentage",
                                "render": function(data, type, row, meta) {
                                    return `${row.percentage}%`;
                                }
                            },
                            {
                                "data": "result"
                            },
                            {
                                "data": "created_at",
                                "render": function(data, type, row, meta) {
                                    return moment(row.created_at).format('DD-MM-YYYY');
                                }
                            }
                        ]
                    });
                }
            });
        }

        fetch();

        // Filter
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            if (start_date == "" || end_date == "") {
                alert("Both date required");
            } else {
                $('#records').DataTable().destroy();
                fetch(start_date, end_date);
            }
        });

        // Reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $("#start_date").val(''); // empty value
            $("#end_date").val('');
            $('#records').DataTable().destroy();
            fetch();
        });
        //penjualan
        function loadjual() {
            $('#tabelpenjualan').DataTable({
                rowReorder: true,
                columnDefs: [{
                        orderable: true,
                        className: 'reorder',
                        targets: 0

                    },
                    {
                        orderable: false,
                        targets: '_all'
                    }
                ],
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('dataTablePenjualan') }}"
                },

                columns: [{
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                        //auto numbering
                    },
                    {
                        data: 'nota',
                        name: 'nota'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'diskon',
                        name: 'diskon'
                    },
                    {
                        data: 'namaObat',
                        name: 'namaObat'
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal',
                        render: $.fn.DataTable.render.number(',', '.', 2)
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false
                    },
                ]
            })
        }

        //pembelian
        function loadbeli() {
            $('#tabelpembelian').DataTable({
                rowReorder: true,
                columnDefs: [{
                        orderable: true,
                        className: 'reorder',
                        targets: 0

                    },
                    {
                        orderable: false,
                        targets: '_all'
                    }
                ],
                // responsive:true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('dataTablePembelian') }}"
                },

                columns: [{
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                        //auto numbering
                    },
                    {
                        data: 'faktur',
                        name: 'faktur'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'item',
                        name: 'item'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    // {
                    //     data:'totalkotor', name:'totalkotor',
                    //     render:$.fn.DataTable.render.number(',','.',2)
                    // },
                    {
                        data: 'diskonBeli',
                        name: 'diskonBeli'
                    },
                    {
                        data: 'totalbersih',
                        name: 'totalbersih',
                        render: $.fn.DataTable.render.number(',', '.', 2)
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'pajakBeli',
                        name: 'pajakBeli'
                    },
                    {
                        data: 'admin',
                        name: 'admin'
                    },
                    {
                        data: 'supplier',
                        name: 'suplier'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false
                    },
                ]
            })
        }

        //detailjual


        function detailJual(id) {
            $('#tabelDetailJual').DataTable({
                rowReorder: true,
                columnDefs: [{
                        orderable: true,
                        className: 'reorder',
                        targets: 0

                    },
                    {
                        orderable: false,
                        targets: '_all'
                    }
                ],
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('detailjual') }}",
                    data: {
                        nota: id
                    }
                },

                columns: [{
                        data: null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                        //auto numbering
                    },
                    {
                        data: 'nota',
                        name: 'nota'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'diskon',
                        name: 'diskon'
                    },
                    {
                        data: 'namaObat',
                        name: 'namaObat'
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal',
                        render: $.fn.DataTable.render.number(',', '.', 2)
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                ]
            })
        }

        $(document).on('click', '.detailsJual', function() {
            let nota = $(this).attr('id')
            $('#tabelDetailJual').DataTable().destroy()
            detailJual(nota)
            $('#btnModalJual').click()

        })


        //details beli

        function detailBeli(id) {
            $('#tabelDetailBeli').DataTable({
                rowReorder: true,
                columnDefs: [{
                        orderable: true,
                        className: 'reorder',
                        targets: 0

                    },
                    {
                        orderable: false,
                        targets: '_all'
                    }
                ],
                // responsive:true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('detailbeli') }}",
                    data: {
                        faktur: id
                    }
                },

                columns: [{
                        data: null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                        //auto numbering
                    },
                    {
                        data: 'faktur',
                        name: 'faktur'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'item',
                        name: 'item'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    // {
                    //     data:'totalkotor', name:'totalkotor',
                    //     render:$.fn.DataTable.render.number(',','.',2)
                    // },
                    {
                        data: 'diskonBeli',
                        name: 'diskonBeli'
                    },
                    {
                        data: 'totalbersih',
                        name: 'totalbersih',
                        render: $.fn.DataTable.render.number(',', '.', 2)
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'pajakBeli',
                        name: 'pajakBeli'
                    },
                    {
                        data: 'admin',
                        name: 'admin'
                    },
                    {
                        data: 'supplier',
                        name: 'suplier'
                    },
                ]
            })
        }

        $(document).on('click', '.detailsBeli', function() {
            let faktur = $(this).attr('id')
            $('#tabelDetailBeli').DataTable().destroy()
            detailBeli(faktur)
            $('#btnModalBeli').click()

        });


        //btnseleksi

        $(document).on('click', '#btn-seleksi', function() {
            let min = $('#min').val()
            let max = $('#max').val()

            $('#tabelpenjualan').DataTable().destroy()
            loadjual(min, max)
            $('#tabelpembelian').DataTable().destroy()
            loadbeli(min, max)

            $('#minp').val(min)
            $('#maxp').val(max)

        })
    </script>
