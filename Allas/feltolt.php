<?php
require_once 'config/init.php';

if (!is_logged()){
    header("Location: index.php");
}

print_html("html/header.html");
menu();
print_html("html/feltolt.html");
print_html("html/footer.html");


