<?php
require_once 'tinkoff.params.php';
$tinkoff->AddMainInfo(
    array(
        'OrderId'     => $_GET['OrderId'],
        'Description' => $_GET['Description'],
        'Language'    => 'ru',
        'SuccessURL' => $_SERVER['HOST'].'/lc/finance/success.php'
    )
);


$tinkoff->AddItem(
    array(
        'Name'     => $_GET['Description'],
        'Price'    => $_GET['Price'].'00',
        "Quantity" => (float) 1.00,
        "Tax"      => "none",
    )
);
$tinkoff->SetOrderEmail($_GET['Email']);
$tinkoff->SetOrderMobile($_GET['Phone']);
$tinkoff->SetTaxation('usn_income');
//$tinkoff->DeleteItem(0);
$tinkoff->Init();
$tinkoff->doRedirect();