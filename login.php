<?php
require_once 'index.php';

$errors = [];

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($connt, $_POST['email']);
  $password = md5($_POST['password']);

  $select = "SELECT * FROM user WHERE email='$email' AND password='$password'";
  $result = mysqli_query($connt, $select);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    if ($row['role'] == '1') {
      //$_SESSION['admin_name'] = $row['name'];
      header('location: shows.php');
    } elseif ($row['role'] == '2') {
      //$_SESSION['user_name'] = $row['name'];
      header('location: user.php');
    }
  } else {
    $errors[] = "You are not admin or user";
  }
}
?>


<!DOCTYPE html>
<html>


<head>
  <meta charset="UTF-8">
  <title>login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .login {
      position: absolute;
      top: 50%;
      left: 50%;
      margin: -150px 0 0 -150px;
      width: 300px;
      height: 300px;
    }

    .footer {
      color: #0a0a0a;
      text-align: center;
      margin-top: 40px;
      font-size: 20px;
    }

    .login h1 {
      color: #555555;
      text-shadow: 0px 10px 8px #CDC673;
      letter-spacing: 2px;
      text-align: center;
      margin-bottom: 20px;
    }

    input {
      padding: 10px;
      width: 100%;
      margin-bottom: 10px;
      border: 1px solid black;
      border-radius: 4px;
      letter-spacing: 2px;
    }

    form button {
      width: 100%;
      padding: 10px;
      background-color: #CDC673;
      border: 1px solid black;
      border-radius: 4px;
      cursor: pointer;
      font-size: 20px;

    }

    .login form .error-msg {

      margin: 10px 0;
      display: block;
      background: crimson;
      color: #fff;
      border-radius: 5px;
      font-size: 20px;
    }
  </style>
</head>

<body>

  <div class="login">

    <h1>Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

      <?php
      if (isset($error)) {
        foreach ($error as $error) {
          echo '<span class="error-msg">'  . $error .   '</span>';
        }
      }

      ?>
      <input type="email" name="email" placeholder="Enter email" required>
      <input type="password" name="password" placeholder="password" required="required">
      <button type="submit" name='submit'>login</button>
    </form>
    <div class="card-footer">
      <div class="">
        <p class="footer" class="float-sm-right text-center m-0">New Admin? <a href="register.php" class="card-link">Sign Up</a></p>

      </div>
    </div>
</body>

</html>