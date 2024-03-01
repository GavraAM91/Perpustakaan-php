<?php
//koneksi terhadap database
include 'connection.php';

session_start();
if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $pass = $_POST['password'];

  // Enkripsi password yang dimasukkan pengguna
  //   $pass_enkrip = password_hash($pass, PASSWORD_DEFAULT);

  // Dapatkan password dari database
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query);

  $data = mysqli_fetch_array($result);
  $pass_db = $data['password'];

 if (mysqli_num_rows($result) > 0) {
    // Bandingkan password yang dimasukkan pengguna degan password yang disimpan di database
    if (password_verify($pass, $pass_db)) {
      if ($data['user_type'] == 'admin') {
        $_SESSION['user_name'] = $username;
        header("Location: ../admin/index.php");
      } else if ($data['user_type'] == 'user') {
        $_SESSION['user_name'] = $username;
        header("Location: ../users/index.php");
      }
    } else {  
      echo "<script>alert('Username / Password Salah!')</script>";
      echo "<script>location=' ../account/login.php'</script>";
    }
  }
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta username="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
  <!--FONT-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,700;1,600&display=swap" rel="stylesheet">

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form action="" method="post">
          <h1 class="mb-4">Login</h1>
          <div class="mb-3">
            <label for="username">username </label>
            <input type="text" class="form-control" id="username" name="username" placeholder="input username">
          </div>
          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="input password">
          </div>
          <p>don't have account? <a href="signup.php" style="text-decoration: none;">sign up</a></p>
          <button type="submit" name="submit" class="btn btn-primary">login</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>