<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

    if(isset($_SESSION['username'])){
      echo "<script>window.location.href='".APPURL."'</script>";
    }

  if(isset($_POST['submit'])){
    if(empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password'])){
      echo "<script>alert('One or more inputs are empty')</script>";
    } else {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $insert = $conn->prepare("INSERT INTO users(username, email, mypassword)
      VALUES (:username, :email, :mypassword)");

      $insert->execute([
        ":username" => $username,
        ":email" => $email,
        ":mypassword" => $password,
      ]);

      header("location: login.php");
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
        <form action="register.php" method="POST" class="appointment-form">
          <h3 class="mb-4 text-center">Register</h3>

          <div class="form-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>

          <div class="form-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>

          <div class="form-group mb-4">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="form-group text-center">
            <input type="submit" name="submit" value="Register" class="btn btn-primary py-3 px-5 w-100">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require "../includes/footer.php"; ?>
