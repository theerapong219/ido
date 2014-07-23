<?php
session_start();
include "../service/service.php";

unset($_SESSION[OFFICE]);

header('location:'.URL.'/office');

?>