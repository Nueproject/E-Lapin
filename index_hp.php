<title>Login MyBKN</title>
<style>
body  {
  background-image: url("img/assets/bg_login.jpg");
  background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
}
</style>
<link rel="stylesheet" href="asset/login/logincss.css">
<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
<link rel="icon" type="image/png" href="img/assets/logobkn.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="asset/plugins/iCheck/square/blue.css">	
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="img/assets/logo_elapin.png"
          class="img-fluid" alt="Sample image">
        </div>
      <div class="col-md-10 col-lg-6 col-xl-4 offset-xl-1">
        
      <form  action="login.php" method="post">
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-3" style="font-size:65px;">LOGIN PEGAWAI</p>
          </div>
          <!-- Username input -->
          <div class="form-outline mb-4">
          <input type="text" style="height:100px; font-size:50px;" class="form-control form-control-lg" placeholder="Username" name="username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <label style="font-size:50px;" class="form-label" for="form3Example3">Username</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
          <input type="password"  style="height:100px;  font-size:50px;" class="form-control form-control-lg" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <label style="font-size:50px;" class="form-label" for="form3Example4">Password</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input style="height:50px; width:50px;" class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                <p style="font-size:50px;">Remember me</p>
              </label>
            </div>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" type="button"  style="height:110px; width:600px;" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;"><p style="font-size:60px;">Masuk</p></button><br><br>
              &nbsp;&nbsp;&nbsp;<p style="height:100px; color:white; font-size:50px;"> Belum punya akun? <a href="https://wa.link/0k1zlo"
                class="link-light">Register</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5">
    <!-- Copyright -->
    <div class="text-black text-center">
      Copyright © 2024. All rights reserved.
    </div>
    <!-- Copyright -->

  </div>
</section>