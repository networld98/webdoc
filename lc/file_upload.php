<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("user");
// upload file and update user photo
if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER["DOCUMENT_ROOT"].'/upload/tmp/' . $_FILES['file']['name']);
    if (file_exists($_SERVER["DOCUMENT_ROOT"].'/upload/tmp/' . $_FILES['file']['name'])) {
        $arFile = CFile::MakeFileArray('/upload/tmp/' . $_FILES['file']['name']);
        echo $arFile['tmp_name'];
    }
    else {
        echo 'copy error';
    }
}
move_uploaded_file(
    $_FILES['file']['tmp_name'],
    'upload/tmp/' . $_FILES['file']['name']
);