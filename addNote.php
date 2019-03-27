<?php
/**
 * Created by PhpStorm.
 * User: aagadullin
 * Date: 27.03.2019
 * Time: 11:13
 */

require 'classes.php';
$idElement = $_POST["idElement"];
$selectEssence = $_POST["Select"];
$noteType = $_POST["noteSelect"];
$text = $_POST["textNote"];


$addNote = new Essence();
$addNote->addNote('https://aagadullin.amocrm.ru/api/v2/notes', $idElement, $selectEssence, $noteType, $text);
echo "gavno code";