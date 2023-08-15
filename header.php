<link rel='stylesheet' type="text/css" href="main.css">
<div class="header">
  <a href="#default" class="logo">CompanyLogo</a>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
    <a href="profile.php">Profile</a>
    <?php if(empty($_SESSION['info'])):?>

    <a href="login.php">log in</a>
    <a href="signup.php"  class="logo" >sign up</a>
    <?php else :?>
    <a href="logout.php">log out</a>
  <?php endif;?>
  </div>
</div> 