<!-- Session Modification -->
<?php
    $lifeTime = 86400 * 30;
    ini_set('session.gc_maxlifetime', $lifeTime);
    session_set_cookie_params($lifeTime);
?>
<!-- Sessions Starting -->
<?php session_start() ?>
<!-- Required Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Use of functions -->
<?php include "assets/php/functions.php" ?>
<!-- Master Style -->
<link rel="stylesheet" href="assets/css/master.css?v=<?= time() ?>">
<!-- Bootstrap Style -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?= time() ?>">
<!-- FavIcon -->
<link rel="shortcut icon" href="favicon.png?v=<?= time() ?>" type="image/x-icon">
<!-- jQuery Use -->
<script src="assets/js/jquery.min.js?v=<?= time() ?>"></script>