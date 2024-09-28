<?php 
  session_start();
  require('database.php');

  // Functions 
  function pathTo($destination) {
    echo "<script>window.location.href = '/inventorysystem/$destination.php'</script>";
  }

  if ($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])) {
    //Set Default Invalid 
    $_SESSION['status'] = 'invalid';  
    
      
  }

  // check if status is valid and direct to home page
  if ($_SESSION['status'] == 'valid') {
    pathTo('home');
  }
  
  if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
      echo "Please fill up all fields";
    } else {
      $query = "SELECT * FROM `admin` WHERE username = '$username' AND password = md5('$password')";
      $stmt = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($stmt);

      if (mysqli_num_rows($stmt) > 0) {
        $_SESSION['status'] = 'valid';
        pathTo('home');
      
      } else {
        $_SESSION['status'] = 'invalid';

        echo 'Invalid Credential';
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
</head>

<body>
  <?= $_SESSION['status']?>
  <form action="" method="post">
    <input type="text" name="username" placeholder="Enter your username" />
    <input type="password" name="password" placeholder="Enter your password" />
    <input type="submit" name="login" value="LOGIN" />
  </form>
</body>

</html>