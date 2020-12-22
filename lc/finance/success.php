<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спасибо за оплату");
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
if($_GET['Id']!=NULL){
    setcookie ("idOrder", $_GET['Id'],time()+3600,'/');
    header("Location: ".$_SERVER['SCRIPT_URI']);

}
if($_COOKIE['idOrder']!=NULL) {
    CModule::IncludeModule("iblock");
    $obEl = new CIBlockElement();
    $PROPS['PAY'] = 127;
    CIBlockElement::SetPropertyValuesEx($_COOKIE['idOrder'], false, $PROPS);
}
if($_GET['Id']==NULL) {
    setcookie('idOrder', null, -1, '/');
}
?>
<?if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0){?>
    <? LocalRedirect($backurl);?>
<?}else{?>
    <? include '../menu.php';?>
    <div class="personal-cabinet-content__price-page">
    <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
        <div class="personal-cabinet-content__schedule-page__block no-border-padding text-center">
            <a href="/lc/invoices/" style="width: 250px;display: initial;" class="save invoice-btn">Вернуться к списку счетов</a>
        </div>
    </div>

<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>