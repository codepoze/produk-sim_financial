<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link mb-2 active" id="v-pills-foto-tab" data-bs-toggle="pill" href="#v-pills-foto" role="tab" aria-controls="v-pills-foto" aria-selected="true">
                                    <i class="fa fa-image"></i>&nbsp;
                                    Foto
                                </a>
                                <a class="nav-link mb-2" id="v-pills-akun-tab" data-bs-toggle="pill" href="#v-pills-akun" role="tab" aria-controls="v-pills-akun" aria-selected="false">
                                    <i class="fa fa-address-card"></i>&nbsp;
                                    Akun
                                </a>
                                <a class="nav-link mb-2" id="v-pills-keamanan-tab" data-bs-toggle="pill" href="#v-pills-keamanan" role="tab" aria-controls="v-pills-keamanan" aria-selected="false">
                                    <i class="fa fa-key"></i>&nbsp;
                                    Keamanan
                                </a>
                                <a class="nav-link mb-2" id="v-pills-telegram-tab" data-bs-toggle="pill" href="#v-pills-telegram" role="tab" aria-controls="v-pills-telegram" aria-selected="false">
                                    <i class="fa fa-paper-plane"></i>&nbsp;
                                    Telegram
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                <!-- begin:: foto -->
                                <div class="tab-pane fade show active" id="v-pills-foto" role="tabpanel" aria-labelledby="v-pills-foto-tab">
                                    <form id="form-foto" action="{{ route('admin.profil.save_picture') }}" method="POST">
                                        <div class="row">
                                            <div class="col-lg-6 align-self-center">
                                                <div class="field-input">
                                                    <input type="file" name="i_foto" id="i_foto" class="form-control form-control-sm" />
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <img src="{{ ($user->foto === null) ? '//placehold.co/150' : asset_upload('picture/'.$user->foto) }}" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="Profil" width="200" />
                                                <br>
                                                <div class="text-center">
                                                    <button type="submit" id="save-foto" class="btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end:: foto -->
                                <!-- begin:: akun -->
                                <div class="tab-pane fade" id="v-pills-akun" role="tabpanel" aria-labelledby="v-pills-akun-tab">
                                    <form id="form-akun" action="{{ route('admin.profil.save_account') }}" method="POST">
                                        <div class="mb-3 row field-input">
                                            <label for="i_nama" class="col-sm-3 col-form-label">Nama&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="text" name="i_nama" id="i_nama" class="form-control form-control-sm" value="{{ $user->nama }}" placeholder="Masukkan nama Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row field-input">
                                            <label for="i_email" class="col-sm-3 col-form-label">Email&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="text" name="i_email" id="i_email" class="form-control form-control-sm" value="{{ $user->email }}" placeholder="Masukkan e-mail Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" id="save-akun" class="btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- end:: akun -->
                                <!-- begin:: keamanan -->
                                <div class="tab-pane fade" id="v-pills-keamanan" role="tabpanel" aria-labelledby="v-pills-keamanan-tab">
                                    <form id="form-keamanan" action="{{ route('admin.profil.save_security') }}" method="POST">
                                        <div class="mb-3 row field-input">
                                            <label for="i_pass_lama" class="col-sm-3 col-form-label">Password Lama&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="password" name="i_pass_lama" id="i_pass_lama" class="form-control form-control-sm" placeholder="Masukkan password lama Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row field-input">
                                            <label for="i_pass_baru" class="col-sm-3 col-form-label">Password Baru&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="password" name="i_pass_baru" id="i_pass_baru" class="form-control form-control-sm" placeholder="Masukkan password baru Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row field-input">
                                            <label for="i_pass_baru_lagi" class="col-sm-3 col-form-label">Ulangin Password Baru&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="password" name="i_pass_baru_lagi" id="i_pass_baru_lagi" class="form-control form-control-sm" placeholder="Masukkan kembali password Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" id="save-keamanan" class="btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- end:: keamanan -->
                                <!-- begin:: telegram -->
                                <div class="tab-pane fade" id="v-pills-telegram" role="tabpanel" aria-labelledby="v-pills-telegram-tab">
                                    <h6 class="mb-3">Hubungkan Akun Telegram</h6>

                                    {{-- Status --}}
                                    <div class="mb-4">
                                        @if($user->telegram_chat_id)
                                        <div class="alert alert-success d-flex align-items-center gap-2 mb-0">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Akun Telegram kamu <strong>sudah terhubung</strong>.</span>
                                        </div>
                                        @else
                                        <div class="alert alert-warning d-flex align-items-center gap-2 mb-0">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <span>Akun Telegram kamu <strong>belum terhubung</strong>.</span>
                                        </div>
                                        @endif
                                    </div>

                                    {{-- Generate Token --}}
                                    <div class="mb-3">
                                        <p class="text-muted mb-2">
                                            Klik tombol di bawah untuk mendapatkan token, lalu kirimkan ke bot Telegram kamu.
                                            Token berlaku selama <strong>5 menit</strong>.
                                        </p>
                                        <button type="button" id="btn-generate-token" class="btn btn-primary btn-sm">
                                            <i class="fab fa-telegram-plane"></i>&nbsp;Generate Token
                                        </button>
                                    </div>

                                    {{-- Token Result --}}
                                    <div id="telegram-token-result" class="d-none">
                                        <div class="alert alert-info">
                                            <p class="mb-1"><strong>Token kamu:</strong></p>
                                            <h4 class="mb-2 font-monospace fw-bold" id="token-value"></h4>
                                            <p class="mb-1">Kirim perintah berikut ke bot Telegram:</p>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="token-command" class="form-control font-monospace" readonly />
                                                <button class="btn btn-outline-secondary" type="button" id="btn-copy-token">
                                                    <i class="fas fa-copy"></i>&nbsp;Salin
                                                </button>
                                            </div>
                                            <small class="text-muted mt-1 d-block">
                                                <i class="fas fa-hourglass-half"></i>&nbsp;Expired pukul: <span id="token-expired"></span>
                                            </small>
                                        </div>
                                    </div>

                                    {{-- Unlink --}}
                                    @if($user->telegram_chat_id)
                                    <hr>
                                    <p class="text-muted mb-2">Ingin memutuskan koneksi Telegram?</p>
                                    <button type="button" id="btn-unlink-telegram" class="btn btn-danger btn-sm">
                                        <i class="fas fa-link-slash"></i>&nbsp;Putuskan Koneksi
                                    </button>
                                    @endif
                                </div>
                                <!-- end:: telegram -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- begin:: js local -->
    @push('js')
    <script type="text/javascript" src="{{ asset_admin('my_assets/parsley/2.9.2/parsley.js') }}"></script>

    <script>
        let untukChangePicture = function() {
            $("#i_foto").change(function() {
                cekLokasiFoto(this);
            });
        }();

        let untukSimpanFoto = function() {
            $(document).on('submit', '#form-foto', function(e) {
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
                        $('#save-foto').attr('disabled', 'disabled');
                        $('#save-foto').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
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
                                location.reload();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
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

                        $('#save-foto').removeAttr('disabled');
                        $('#save-foto').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            });

            $(document).on('change', '#form-foto input[type="file"]', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        let untukSimpanAkun = function() {
            $(document).on('submit', '#form-akun', function(e) {
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
                        $('#save-akun').attr('disabled', 'disabled');
                        $('#save-akun').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
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
                                location.reload();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
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

                        $('#save-akun').removeAttr('disabled');
                        $('#save-akun').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            });

            $(document).on('keyup', '#form-akun input', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        let untukSimpanKeamanan = function() {
            $(document).on('submit', '#form-keamanan', function(e) {
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
                        $('#save-keamanan').attr('disabled', 'disabled');
                        $('#save-keamanan').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
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
                                location.reload();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
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

                        $('#save-keamanan').removeAttr('disabled');
                        $('#save-keamanan').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });

                $(document).on('keyup', '#form-keamanan input', function(e) {
                    e.preventDefault();

                    if ($(this).val() == '') {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }
                });
            });
        }();

        let untukTelegram = function() {
            // Generate Token
            $(document).on('click', '#btn-generate-token', function() {
                let btn = $(this);
                btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Memproses...');

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.profil.generate_telegram_token') }}",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.type === 'success') {
                            $('#token-value').text(response.token);
                            $('#token-command').val(response.command);
                            $('#token-expired').text(response.expired_at);
                            $('#telegram-token-result').removeClass('d-none');
                        } else {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'btn btn-sm btn-danger'
                                },
                                buttonsStyling: false,
                            });
                        }
                    },
                    complete: function() {
                        btn.removeAttr('disabled').html('<i class="fa fa-telegram"></i>&nbsp;Generate Token');
                    }
                });
            });

            // Salin Token
            $(document).on('click', '#btn-copy-token', function() {
                let command = $('#token-command').val();
                navigator.clipboard.writeText(command).then(function() {
                    $('#btn-copy-token').html('<i class="fa fa-check"></i>&nbsp;Tersalin!');
                    setTimeout(() => {
                        $('#btn-copy-token').html('<i class="fa fa-copy"></i>&nbsp;Salin');
                    }, 2000);
                });
            });

            // Unlink Telegram
            $(document).on('click', '#btn-unlink-telegram', function() {
                Swal.fire({
                    title: 'Putuskan Koneksi?',
                    text: 'Akun Telegram kamu akan diputuskan dari MoneyLog.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Putuskan',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-sm btn-danger me-2',
                        cancelButton: 'btn btn-sm btn-secondary',
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('admin.profil.unlink_telegram_token') }}",
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.type,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        confirmButton: 'btn btn-sm btn-success'
                                    },
                                    buttonsStyling: false,
                                }).then(() => location.reload());
                            }
                        });
                    }
                });
            });

        }();

        function cekLokasiFoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function(e) {
                    $('#lihat-gambar').attr('src', e.target.result);
                }
            }
        }
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>