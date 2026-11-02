<?php
include_once __DIR__."/src/Cuenta.php";

$cuenta = new Cuenta(200000.34,'maria');
echo "cuenta de maria: ".$cuenta->toString();