<?php
session_start();
unset( $_SESSION['basket']);
session_destroy();
echo 1;
