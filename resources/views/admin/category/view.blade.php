<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables/1.11.3/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables-responsive/2.2.9/css/responsive.dataTables.min.css') }}" />
    @endpush
    <!-- end:: css local -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ $title }}</h4>
                    <div class="flex-shrink-0">
                        <button type="button" id="add" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-upd">
                            <i class="fa fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="tabel-category-dt"></table>
                </div>
            </div>
        </div>
    </div>

    <!-- begin:: modal add & upd -->
    <div class="modal fade" id="modal-add-upd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="judul-add-upd"></span> {{ $title }}</h5>
                </div>
                <div class="modal-body">
                    <form id="form-add-upd" action="{{ route('admin.category.save') }}" method="POST">
                        <!-- begin:: id -->
                        <input type="hidden" name="id_category" id="id_category" />
                        <!-- end:: id -->

                        <!-- begin:: untuk loading -->
                        <div id="form-loading"></div>
                        <!-- end:: untuk loading -->

                        <!-- begin:: untuk form -->
                        <div id="form-show">
                            <div class="mb-3 row field-input">
                                <label for="name" class="col-sm-2 col-form-label">Name&nbsp;*</label>
                                <div class="col-md-10 my-auto">
                                    <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Masukkan nama" />
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="mb-3 row field-input">
                                <label for="type" class="col-sm-2 col-form-label">Type&nbsp;*</label>
                                <div class="col-md-10 my-auto">
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="">Pilih</option>
                                        <option value="income">Income</option>
                                        <option value="expense">Expense</option>
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" id="cancel" class="btn btn-warning btn-sm" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Batal</button>
                                <button type="submit" id="save" class="btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                            </div>
                        </div>
                        <!-- end:: untuk form -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: modal add & upd -->

    <!-- begin:: js local -->
    @push('js')
    <script type="text/javascript" src="{{ asset_admin('my_assets/datatables/1.11.3/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/datatables/1.11.3/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/datatables-responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>

    <script>
        var table;

        let untukTabel = function() {
            table = $('#tabel-category-dt').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                    processing: "Data sedang diproses...",
                },
                ajax: "{{ route('admin.category.list') }}",
                columns: [{
                        title: 'No.',
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        title: 'Name',
                        data: 'name',
                        class: 'text-center'
                    },
                    {
                        title: 'Type',
                        data: 'type',
                        class: 'text-center'
                    },
                    {
                        title: 'Aksi',
                        data: 'action',
                        className: 'text-center',
                        responsivePriority: -1,
                        orderable: false,
                        searchable: false,
                    },
                ],
            });
        }();

        let untukSimpanData = function() {
            $(document).on('submit', '#form-add-upd', function(e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save').attr('disabled', 'disabled');
                        $('#save').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        if (response.type === 'success') {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            }).then((value) => {
                                table.ajax.reload();
                                $('#modal-add-upd').modal('hide');
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    }
                                }
                            });

                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            });
                        }

                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            });

            $(document).on('keyup', '#form-add-upd input', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $(document).on('change', '#form-add-upd select', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        let untukTambahData = function() {
            $(document).on('click', '#add', function(e) {
                e.preventDefault();
                $('#judul-add-upd').text('Tambah');

                $('#id_category').removeAttr('value');

                $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
                $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

                $('#form-add-upd').parsley().destroy();
                $('#form-add-upd').parsley().reset();
                $('#form-add-upd')[0].reset();
            });
        }();

        let untukUbahData = function() {
            $(document).on('click', '#upd', function(e) {
                var ini = $(this);
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ route('admin.category.show') }}",
                    data: {
                        id: ini.data('id')
                    },
                    beforeSend: function() {
                        $('#judul-add-upd').html('Ubah');
                        $('#form-add-upd').parsley().destroy();

                        $('#form-loading').html(`<div class="center"><div class="loader"></div></div>`);
                        $('#form-show').attr('style', 'display: none');

                        $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
                        $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

                        ini.attr('disabled', 'disabled');
                        ini.html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        $('#form-loading').empty();
                        $('#form-show').removeAttr('style');

                        $.each(response, function(key, value) {
                            if (key) {
                                if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                    $('#' + key).val(value);
                                } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                    $('#' + key).val(value);
                                }
                            }
                        });

                        ini.removeAttr('disabled');
                        ini.html('<i class="fa fa-edit"></i>&nbsp;Ubah');
                    }
                });
            });
        }();

        let untukHapusData = function() {
            $(document).on('click', '#del', function() {
                var ini = $(this);
                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapusnya?",
                    text: "Data yang telah dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    confirmButtonClass: "btn btn-sm btn-primary",
                    cancelButtonClass: "btn btn-sm btn-danger ms-1",
                    buttonsStyling: !1,
                    showCloseButton: !0
                }).then((del) => {
                    if (del.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.category.del') }}",
                            dataType: 'json',
                            data: {
                                id: ini.data('id'),
                            },
                            beforeSend: function() {
                                ini.attr('disabled', 'disabled');
                                ini.html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.type,
                                    confirmButtonText: response.button,
                                    customClass: {
                                        confirmButton: `btn btn-sm btn-${response.class}`,
                                    },
                                    buttonsStyling: false,
                                }).then((value) => {
                                    table.ajax.reload();
                                });
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });
        }();
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>