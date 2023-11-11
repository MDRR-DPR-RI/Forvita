@extends('dashboard.layouts.main')

@section('custom_vendor')
<!-- Vendor CSS -->

@endsection

@section('page_content')
<div class="main main-app p-3 p-lg-4">
    <h1 class="mb-3">Profil</h1>

    <div class="row g-3">
        <div class="card card-settings">
            <div class="card-body p-0">

                <div class="setting-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <h6>Foto Profil</h6>
                            <p>Gunakan foto profil yang menampilkan wajah Anda dengan jelas</p>
                        </div><!-- col -->
                        <div class="col-md">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/1024px-Windows_10_Default_Profile_Picture.svg.png" style="height: 3rem" alt="..." class="mx-2">
                            <input type="file" id="newProfilePicInput" class="form-control d-none mw-10" placeholder="Masukkan foto profil Anda">
                            <button onclick="$('#newProfilePicInput').click()" class="btn btn-white">Upload foto baru</button>
                            <!-- TODO: handle selected file properly and display the preview -->
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- setting-item -->

                <div class="setting-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <h6>Nama</h6>
                            <p>Nama pengguna Anda yang ditampilkan</p>
                        </div><!-- col -->
                        <div class="col-md">
                            <input type="text" class="form-control" placeholder="Masukkan nama Anda" value="{{ $user->name }}" readonly>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- setting-item -->

                <div class="setting-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <h6>Email</h6>
                            <p>Email yang terdaftar</p>
                        </div><!-- col -->
                        <div class="col-md">
                            <input type="text" class="form-control" placeholder="Masukkan email Anda" value="{{ $user->email }}" readonly>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- setting-item -->

                <div class="setting-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <h6>Password baru</h6>
                            <p>Gunakan password yang aman dan sulit untuk ditebak</p>
                        </div><!-- col -->
                        <div class="col-md">
                            <input type="password" class="form-control" placeholder="Masukkan password baru">
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- setting-item -->

                <div class="setting-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <h6>Konfirmasi Password Baru</h6>
                            <p>Ketik ulang password sesuai dengan sebelumnya</p>
                        </div><!-- col -->
                        <div class="col-md">
                            <input type="password" class="form-control" placeholder="Masukkan password baru">
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- setting-item -->

            </div><!-- card-body -->
        </div><!-- card -->

        <button class="btn btn-primary btn-sign">Simpan Profil</button>
    </div>

    <div class="main-footer mt-5">
        <span>&copy; 2023. DPR RI</span>
    </div><!-- main-footer -->
</div><!-- main -->
@endsection
