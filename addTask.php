<?php
/**
 * Created by PhpStorm.
 * User: aagadullin
 * Date: 27.03.2019
 * Time: 12:39
 */

require 'classes.php';


$idEssence = $_POST["idEssence"];
$typeEssence = $_POST["essence"];
$date = $_POST["dateFinish"];
$taskType = $_POST['taskType'];
$text = $_POST["text"];
$resUser = $_POST["responsibleUser"];
$date = time($date);


$auth = new Authorization();
$auth->getAuth();
$addTask = new Essence();
print_r($addTask->addTask($idEssence, $typeEssence, $date, $taskType,$text, $resUser));
echo "complied";