@extends('admin.template')
@section('isi')

<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Ubah Password</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="{{ route('UpdatePassword') }}">
        @csrf
          <div class="form-group row">
            <input type="hidden" name="username" value="{{ $username }}">
            <label class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input type="password" class="form-control"
                    id="password_lama" name="password_lama" placeholder="Password Lama. . .">
                    <div class="input-group-append">
                    <span class="input-group-text" id="togglePassword">
                        <i class="mdi mdi-eye text-dark"></i>
                    </span>
                    </div>
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Password Baru</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="password" class="form-control"
                        id="password_baru" name="password_baru" placeholder="Password Baru. . .">
                        <div class="input-group-append">
                        <span class="input-group-text" id="togglePasswordbaru">
                            <i class="mdi mdi-eye text-dark"></i>
                        </span>
                        </div>
                    </div>
                </div>

          </div>
          <center>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <a href="#" class="btn btn-light" onclick="self.history.back()">Batal</a>
          </center>
        </form>
    </div>
  </div>
</div>

<script>
      document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password_lama');
            var icon = document.querySelector('#togglePassword i');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('mdi-eye-off');
                icon.classList.add('mdi-eye');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('mdi-eye');
                icon.classList.add('mdi-eye-off');
            }
        });

      document.getElementById('togglePasswordbaru').addEventListener('click', function() {
            var passwordInput = document.getElementById('password_baru');
            var icon = document.querySelector('#togglePasswordbaru i');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('mdi-eye-off');
                icon.classList.add('mdi-eye');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('mdi-eye');
                icon.classList.add('mdi-eye-off');
            }
        });
</script>

@endsection
