<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спасибо за оплату");
if($_GET['Id']!=NULL && $_GET['ServiceId']!=NULL){
    setcookie ("idOrder", $_GET['Id'],time()+3600,'/');
    setcookie ("serviceId", $_GET['ServiceId'],time()+3600,'/');
    header("Location: ".$_SERVER['SCRIPT_URI']);
}
if($_COOKIE['idOrder']!=NULL && $_COOKIE['serviceId']) {
    CModule::IncludeModule("iblock");
    $obEl = new CIBlockElement();
    $PROPS['PAY'] = 127;
    CIBlockElement::SetPropertyValuesEx($_COOKIE['idOrder'], false, $PROPS);

    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    $arFilter = Array("IBLOCK_ID"=>array(9,10), "PROPERTY_PHONE"=> $arUser['LOGIN']);
    $arSelect = Array();
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $idClinic = $arFields['ID'];
        $date = $arProps["DATE_END_ACTIVE"]["VALUE"];
    }

    $start = strtotime(date('d.m.Y'));
    $end = strtotime($date);
    $days_between = ceil(($end - $start) / 86400);
    if($days_between<=0){
        $NewDate=Date('d.m.Y', strtotime("+1 year"));
    }elseif($days_between>0){
        $datetime = new DateTime($date);
        $datetime->modify('+1 year');
        $NewDate = $datetime->format('d.m.Y');
    }
    $PROP[174] = $NewDate;
    $PROP[176] = $_COOKIE['serviceId'];
    CIBlockElement::SetPropertyValuesEx($idClinic, false, $PROP);
}
if($_GET['Id']==NULL) {
    setcookie('idOrder', null, -1, '/');
    setcookie('serviceId', null, -1, '/');
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