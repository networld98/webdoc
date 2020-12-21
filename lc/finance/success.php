<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спасибо за оплату");
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
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