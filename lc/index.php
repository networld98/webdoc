<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мой профиль");
$rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
?>
<?if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0){?>
        <? LocalRedirect($backurl);?>
<?}elseif($arUser['UF_TYPE_USER']==6){?>
    <? include 'menu.php';?>
    <?include 'lc-clinic.php';?>
<?}elseif($arUser['UF_TYPE_USER']==7){?>
    <?include 'lc-doctor.php';?>
    <? include 'menu.php';?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>