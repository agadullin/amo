<?php
/**
 * Created by PhpStorm.
 * User: aagadullin
 * Date: 27.03.2019
 * Time: 13:26
 */

require 'classes.php';

$idTask = $_POST["ididTask"];
$dateClose = time($_POST["date"]);
$text = $_POST["text"];

print_r($idTask);

$auth = new Authorization();
$auth->getAuth();
$addTask = new Essence();
$addTask->closeTask($idTask, $dateClose, $text);
echo "complied";