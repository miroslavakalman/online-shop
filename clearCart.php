<?php
session_start();
unset($_SESSION['cart']);
http_response_code(200);
?>