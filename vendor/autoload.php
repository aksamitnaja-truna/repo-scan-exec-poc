<?php
// Vector C: committed autoloader, loaded by PHPStan (--autoload-file) and Psalm.
// Benign marker only. To test Vector D (hang), uncomment the sleep line below.
@file_put_contents('/tmp/scan-probe-php-autoload.txt',
    "vector C (vendor/autoload.php) executed at ".date('c')."\n");
// sleep(100000); // Vector D: uncomment to make the scan hang (holds a slot)
spl_autoload_register(function($c){
    $p='App\\'; if(strncmp($p,$c,strlen($p))===0){
        $f=__DIR__.'/../src/'.str_replace('\\','/',substr($c,strlen($p))).'.php';
        if(is_file($f)) require $f;
    }
});
