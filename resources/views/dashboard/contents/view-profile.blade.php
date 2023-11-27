@extends('dashboard.layouts.main')

@section('custom_vendor')
<!-- Vendor CSS -->

@endsection

@section('page_content')
<div class="main main-app p-3 p-lg-4">
    <h1 class="mb-3">Profil</h1>

    @if (session()->has('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
    @endif


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="row g-3">
        <form method="post" action="" enctype="multipart/form-data">
            @csrf
            <div class="card card-settings">
                <div class="card-body p-0">

                    <div class="setting-item">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-5">
                                <h6>Foto Profil</h6>
                                <p>Gunakan foto profil yang menampilkan wajah Anda dengan jelas</p>
                            </div><!-- col -->
                            <div class="col-md">
                                @php($fallbackProfilePhotoURL = 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/1024px-Windows_10_Default_Profile_Picture.svg.png')
                                <img src="{{ $user->getProfilePhotoURL() }}" id="profilePhoto" alt="Foto Profil" class="rounded-circle mr-2" height="50" width="50">

                                <input type="file" name="profile_photo" id="newProfilePicInput" class="form-control d-none mw-10" placeholder="Masukkan foto profil Anda">
                                <button onclick="$('#newProfilePicInput').click()" type="button" class="btn btn-white">Upload foto baru</button>
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
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
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
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Masukkan password baru">
                            </div><!-- col -->
                        </div><!-- row -->
                    </div><!-- setting-item -->

                </div><!-- card-body -->
            </div><!-- card -->

            <button type="submit" class="btn mt-3 btn-primary btn-sign">Simpan Profil</button>

        </form>

    </div>

    <script>
        document.getElementById('newProfilePicInput').addEventListener('change', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePhoto').src = e.target.result;
            }
            reader.readAsDataURL(file);
        });
    </script>

    <div class="main-footer mt-5">
        <span>&copy; 2023. DPR RI</span>
    </div><!-- main-footer -->
</div><!-- main -->
@endsection
