<?php

/**
 * if user already login, redirect him to char room page
 */
if ($page == 'login' || $page == 'register') {
  if (isset($_SESSION['user']['login']) && $_SESSION['user']['login'] == true) {
    header('Location:' . $ChatRoom . '');
    exit;
  }
} elseif ($page != 'login' || $page != 'register') {
  if (!isset($_SESSION['user']['login'])) {
    header('Location:' . AppURL . '');
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- bootstrap css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- font-awesome css link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $css ?>main.css">
  <title>Chat Application </title>
</head>

<body>
  <?php
  if ($page != 'login' && $page != 'register') {
  ?>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">Chat App</label>
      <ul>
        <li><a class="active" href="<?php echo $ChatRoom ?>">Home</a></li>
        <!-- <li><a href="#">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>
      <li><a href="#">Feedback</a></li> -->
        <li><a id="logout" href="<?php echo $authentication ?>logout.php">Logout</a></li>
      </ul>
    </nav>
  <?php
  }
  ?>
  <div id="loadingIcon" style="display: none;">
    <div class="loader"></div>
  </div>