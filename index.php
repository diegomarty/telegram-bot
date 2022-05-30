<?php

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);

require_once 'app.php';

$input = file_get_contents('php://input');

dd($input);

?>
