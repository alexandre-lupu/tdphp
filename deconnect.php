<?php
session_start();
echo "Au revoir, ".$_SESSION['login'];
session_destroy();
?>