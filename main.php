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

$num = new Number();
$arr = $num->checkNum();

$contacts = new Essence();
$idContacts = $contacts->createEssence($arr, "контакт ", 'contacts');
$idCreateContacts = $contacts->createId($idContacts);

$companies = new Essence();
$idCompanies = $companies->createEssence($arr, "компания ", 'companies');
$idCreateCompanies = $companies->createId($idCompanies);

$leads = new Essence();
$idLeads = $leads->createEssence($arr, "лиды ", 'leads');
$idCreateLeads = $leads->createId($idLeads);

$customers = new Essence();
$idCustomers = $customers->createEssenceCustomer($arr, "пользователь ", 'customers');


$companies->upEssence($idCompanies, $idCreateContacts, $idCreateLeads, $idCustomers, 'https://aagadullin.amocrm.ru/api/v2/companies' );

$contacts->createFilds();
$a = $contacts->getIdFilds();
$contacts->upContact($idContacts, $idCreateLeads, $idCustomers, $a,'https://aagadullin.amocrm.ru/api/v2/contacts');


