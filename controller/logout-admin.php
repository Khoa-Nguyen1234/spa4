<?php
session_start();
session_destroy();
header("Location: ../admin/Login-Admin.php");
exit();
