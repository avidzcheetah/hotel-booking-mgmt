<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

  if(isset($_POST['submit'])){
    if(empty($_POST['email']) OR empty($_POST['password'])){
      echo "<script>alert('One or more inputs are empty')</script>";
    } else {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $login = $conn->query("SELECT * FROM users WHERE email='$email'");
      $login->execute();

      $fetch = $login->fetch(PDO::FETCH_ASSOC);

      if($login->rowCount() > 0){
        if(password_verify($password, $fetch['mypassword'])){
          echo "<script>alert('LOGGED IN')</script>";
        } else {
          echo "<script>alert('Email or password is incorrect')</script>";
        }
      }
    }
  }
?>

<div class="hero-wrap js-fullheight" data-stellar-background-ratio="0.5">
  <!-- Background Video -->
  <video autoplay muted loop playsinline class="background-video"
    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
    <source src="<?php echo APPURL; ?>/videos/cinnamon.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Dark Overlay -->
  <div class="overlay"
    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 2;">
  </div>

  <!-- Form Container -->
  <div class="container h-100 d-flex align-items-center justify-content-center" style="position: relative; z-index: 3;">
    <div class="col-md-4">
    <div class="p-4 rounded shadow-sm" style="background: rgba(255, 255, 255, 0.53);">
        <form action="login.php" method="POST" class="appointment-form">
          <h3 class="mb-4 text-center">Login</h3>

          <div class="form-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>

          <div class="form-group mb-4">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="form-group text-center">
            <input type="submit" name="submit" value="Login" class="btn btn-primary py-3 px-5 w-100">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require "../includes/footer.php"; ?>