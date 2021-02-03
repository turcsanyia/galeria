<?php
require_once('config/init.php');

printHTML('html/header.html');

echo printMenu();

printHTML('html/footer.html');



$con -> close();
