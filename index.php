<?php
/**
 * Created by PhpStorm.
 * User: aagadullin
 * Date: 25.03.2019
 * Time: 9:23
 */

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="./main.php" method="post">
    <label for="getValue">quantity essence</label>
    <input type="text" name="getValue">
    <input type="submit" value="go">
</form>
<form action="./createField.php" method="post">
    <label for="idCreate">id essence</label>
    <input type="text" name="idCreate">
    <label for="idSelect">Select essence</label>
    <select name="idSelect" id="idSelect">
        <option value="1">Contact</option>
        <option value="2">Lead</option>
        <option value="3">Company</option>
        <option value="12">Customer</option>
    </select>
    <label for="link">сущность для изменения</label>
    <select name="link" id="link">
        <option value="contacts">Contact</option>
        <option value="leads">Lead</option>
        <option value="companies">Company</option>
        <option value="customers">Customer</option>
    </select>
    <label for="textarea">Value field</label>
    <input type="text" name="textarea">
    <input type="submit" value="send">
</form>
<form action="./addNote.php" method="post">
    <label for="idElement">ID Essence</label>
    <input type="text" name="idElement">
    <label for="Select">Select essence</label>
    <select name="Select" id="Select">
        <option value="1">Contact</option>
        <option value="2">Lead</option>
        <option value="3">Company</option>
        <option value="12">Customer</option>
    </select>
    <label for="noteSelect">type note</label>
    <select name="noteSelect" id="noteSelect">
        <option value="4">Common</option>
        <option value="17">Chat</option>
        <option value="102">SMS in</option>
        <option value="101">Dropbox</option>
    </select>
    <label for="textNote">TEXT</label>
    <input type="text" name="textNote">
    <input type="submit" value="send">
</form>
<form action="./addTask.php" method="post">
    <label for="idEssence">id essence</label>
    <input type="text" name="idEssence">
    <label for="essence">essence</label>
    <select name="essence" id="essence">
        <option value="1">Contact</option>
        <option value="2">Lead</option>
        <option value="3">Company</option>
        <option value="12">Customer</option>
    </select>
    <label for="dateFinish">Date Finish</label>
    <input type="date" name="dateFinish">
    <label for="taskType">task type</label>
    <select name="taskType" id="taskType">
        <option value="1">call</option>
        <option value="2">meeting</option>
        <option value="3">mail</option>
    </select>
    <label for="text">text</label>
    <input type="text" name="text">
    <label for="responsibleUser">responsibleUser</label>
    <input type="text" name="responsibleUser">
    <input type="submit" value="add">
</form>
<form action="./closeTask.php" method="post">
    <label for="ididTask">ID Task</label>
    <input type="text" name="ididTask">
    <label for="date">Date Close Task</label>
    <input type="date" name="date">
    <label for="text">Text</label>
    <input type="text" name="text">
    <input type="submit" value="close Task">
</form>
</body>
</html>
