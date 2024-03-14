<?php
session_start();
session_unset();
session_destroy();
header("Location: taskregister.php");
exit();
