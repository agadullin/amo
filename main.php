<?php
/**
 * Created by PhpStorm.
 * User: aagadullin
 * Date: 25.03.2019
 * Time: 9:59
 */

require 'classes.php';

$obj = new Authorization();
$obj->getAuth();

//$num = new Number();
//var_dump($num->checkNum());

$a = "company";

$link = "https://aagadullin.amocrm.ru/api/v2/{$a}";

echo $link;