<?php
    include "../../utils/route.php";
    session_start();
    $_SESSION['authToken'] = NULL;
    session_destroy();
    route('../../index');
?>