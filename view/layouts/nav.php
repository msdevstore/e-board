<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">EBOARD MANAGER</a>

  <!-- Links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="./home.php">Home</a>
    </li>
    <?php
    if($_SESSION['role'] != 2) echo '<li class="nav-item"><a class="nav-link" href="./user.php">User</a></li>';
    ?>
    <li class="nav-item">
      <a class="nav-link" href="../app/auth/logout.php">Logout</a>
    </li>
  </ul>
</nav>