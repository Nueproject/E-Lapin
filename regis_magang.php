<title>Register E-Lapin</title>
<style>
body  {
  background-image: url("img/assets/kantorbg1.jpg");
  background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
}
</style>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="asset/plugins/iCheck/square/blue.css">
    <link rel="icon" type="image/png" href="img/assets/logobkn.png">
<section class="vh-100">
  <div class="container-fluid h-custom">
  <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="img/assets/logo_elapin.png"
          class="img-fluid" alt="Sample image">
          </div>

      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <br><hr>
      <form action="aksi_regis.php" method="post">
      <center><h4><b>FORM REGISTRASI</b></h4></center>
      <hr>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-4 col-form-label">Nama Lengkap </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap"  required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-4 col-form-label">NIK </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nik"  name="nik"  placeholder="Nomor Induk Kependudukan"  required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-4 col-form-label">Nomor HP  </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="spk"  name="spk"  placeholder="082170066601"  required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-4 col-form-label">Tanggal Mulai Magang  </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="tglspk"  name="tglspk"  placeholder="01 Januari 2024"  required>
        </div>
      </div>
     
      
      <div class="input-group mb-3">
      <label class="input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
      <select class="form-select"  id="kelamin" name="kelamin"  required>
        <option selected="">Choose...</option>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      </div> 
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-4 col-form-label">Email </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nippnpn" name="nippnpn"  placeholder="xxx@gmail.com"  required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-4 col-form-label">Username </label>
        <div class="col-sm-8">
           <input type="hidden" class="form-control" id="nama_atasan"  name="nama_atasan"  placeholder="Nama Atasan"  value="Eka Pangestuti, M.Ap">
           <input type="hidden" class="form-control" id="jabatan" name="jabatan" placeholder="Magang"  value="Magang">
           <input type="hidden" class="form-control" id="nip_atasan"  name="nip_atasan"  placeholder="NIP Atasan"  value="NIPBUEKA">
           <input type="hidden" class="form-control" id="jabatan_atasan"  name="jabatan_atasan"  placeholder="Kepala Subbagian Umum "  value="Kepala Subbagian Kepegawaian">
        
          <input type="text" class="form-control" id="username"  name="username"  placeholder="Username"  required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-4 col-form-label">Password </label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="password"  name="password"  placeholder="Password86!" required>
        </div>
      </div>
<div class="row">
  <div class="col-xs-4 text-center d-md-flex justify-content-md-end">
    <button type="submit" class="btn btn-primary" name="submit">REGISTER</button>
  </div><!-- /.col -->
</div>

</form>



      </div>
    </div>
  </div>

</section>