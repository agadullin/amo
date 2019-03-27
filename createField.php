<?php
/**
 * Created by PhpStorm.
 * User: aagadullin
 * Date: 26.03.2019
 * Time: 19:53
 */


require 'classes.php';

$idEssense = $_POST['idCreate'];
$select = $_POST['idSelect'];
$valueFields = $_POST['textarea'];
$link = $_POST["link"];


$auth = new Authorization();
$auth->getAuth();
$fieldText = new Essence();
//$fieldText->addFieldText('fields',$select);

$idField [] = $fieldText->idFieldText;
$responce = $fieldText->response();


//$fieldText->createFieldText($idEssense, $valueFields, $link, $idField[0]);







if ($select == 1) {
    $essence = 'contacts';
} elseif ($select == 2) {
    $essence = 'leads';
} elseif ($select == 3) {
    $essence = "companies";
} elseif ($select == 12) {
    $essence = 'customers';
}
//
//
//
//echo '<pre>';
print_r($responce = $responce['_embedded']['custom_fields'][$essence]);
//echo "</pre>";
//
foreach ($responce as $key => $item){
        if( $item['id'] == $idField[0]){
            print_r($item['id']);
            echo '<br>';
            print_r($idField[0]);
            $fieldText->addFieldText('fields',$select);
            $fieldText->createFieldText($idEssense, $valueFields, $link, $idField[0]);
            break;
        }
}












//$fieldText->createFieldText($idEssense, $valueFields, $link);
//echo "completed";



