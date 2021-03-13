<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Платное размещение");

CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
global $idClinic;

$arFilter = Array("IBLOCK_ID"=>array(9,10), "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
$arFields = $ob->GetFields();
$arProps = $ob->GetProperties();
$idClinic = $arFields['ID'];
$subscrubeDate = $arProps['DATE_END_ACTIVE']['VALUE'];
$subscrube = $arProps['SUBSCRIBE']['VALUE'];
}
$start = strtotime(date('d.m.Y'));
$end = strtotime($subscrubeDate);
$days_between = ceil(($end - $start) / 86400);
if($days_between<=0){
    $subscrubeDate = '<span style="color:red">Просрочена</span>';
}else{
    $subscrubeDate = 'до '.$subscrubeDate;
}
?>
<style>
    #form_requisites .invoice-btn{
        margin: 0 auto;
    }
    .invoice-btn:disabled, .invoice-btn:disabled:hover{
        color: #1a1a1a;
        border-color: #9DD4B3;
        background-color: transparent;
    }
    #invoice .invoice-link {
        background: #E74C77;
        border: 2px solid #E74C77;
        cursor: pointer;
        margin: 20px 0 20px 0;
        display: block;
        float: left;
    }
    #invoice .tinkoff-btn {
        cursor: pointer;
        margin: 20px 0 20px 20px;
        display: block;
        float: left;
        padding: 12px 20px;
        font-family: "Ubuntu";
        font-style: normal;
        font-weight: normal;
        font-size: 18px;
        line-height: 21px;
        outline: none;
        background: #9DD4B3;
        border: 2px solid #9DD4B3;
        box-sizing: border-box;
        border-radius: 5px;
        box-shadow: unset;
    }
    #invoice .tinkoff-btn:hover{
        color: #E74C77;
    }
    #invoice form{
        display: block;
        float: left;
    }
    #invoice .sign img {
        display: none;
    }
</style>
<? include '../menu.php';?>
<?if($idClinic !=NULL){?>
    <div class="personal-cabinet-content__price-page">
        <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
        <div class="personal-cabinet-content__schedule-page__block no-border-padding">
            <?if($subscrube==NULL){?><h5>Выберите вариант платного размещения на Webdoc.clinic</h5><?}?>
            <?
            $res = CIBlockElement::GetByID($subscrube);
            if($ar_res = $res->GetNext())
              echo '<h5>Вы подписаны на тарифный план "'.$ar_res['NAME'].'" '.$subscrubeDate.'</h5>';
            ?>
            <?if($subscrube!=NULL){?><p><span style="color:red">Вы можете выписать счёт только для продление тарифа на который уже подписаны, сменить тарифный план вы можете связавшись с администрацией</span> <a href="mailto:info@webdoc.clinic">info@webdoc.clinic</a>.</p><?}?>
            <form id="form_requisites" name="form_requisites" action="" method="post" class="form-requistment">
                <input type="hidden" name="CLIENT" value="<?=$arProps['OFFICIAL_NAME']['VALUE']?>, ИНН: <?=$arProps['INN']['VALUE']?>, <?=$arProps['URADRESS']['VALUE']?>">
                <input type="hidden" name="NAME" value="<?=$arProps['OFFICIAL_NAME']['VALUE']?>">
                <input type="hidden" name="PHONE" value="<?=$arUser['LOGIN']?>">
                <input type="hidden" name="EMAIL" value="<?=$arUser['EMAIL']?>">
                <ul class="checkbox-group radio-group radio-group-column">
                    <?$arSelect = Array("ID","NAME", "PROPERTY_PRICE");
                    $arFilter = Array("IBLOCK_ID"=>23);
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                    while($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();?>
                        <li>
                            <label data-role="label_<?=$arFields['ID']?>" class="bx_filter_param_label" for="<?=$arFields['ID']?>">
                            <span class="bx_filter_input_radio">
                                <input type="radio" value="<?=$arFields["NAME"]?>/<?=$arFields['PROPERTY_PRICE_VALUE']?>/<?=$arFields['ID']?>" <?if($subscrube!=NULL && $subscrube!=$arFields['ID'] ){?>disabled<?}?> <?if($subscrube!=NULL && $subscrube==$arFields['ID'] ){?>checked<?}?> name="NAME_PRICE" id="<?=$arFields['ID']?>">
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                <span class="bx_filter_param_text"><?=$arFields["NAME"]?></span>
                            </span>
                            </label>
                        </li>
                    <?}?>
                </ul>
                <button type="submit" <?if($subscrube==NULL){?>disabled<?}?> class="save invoice-btn">Оплатить</button>
            </form>
            <div id="invoice"></div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("input[name=NAME_PRICE]").change(function () {
                $('#invoice').html('');
                $('.invoice-btn').show();
                $('.invoice-btn').removeAttr('disabled');
            });
            $("#form_requisites").submit(function () {
                let formID = $(this).attr('id');
                let formNm = $('#' + formID);
                let formMs = $('#invoice');
                $.ajax({
                    type: "POST",
                    url: '/lc/invoice.php',
                    data: formNm.serialize(),
                    success: function (data) {
                        // Вывод текста результата отправки
                        $(formMs).html(data);
                    }
                });
                $('.invoice-btn').hide();
                return false;
            });
        });
    </script>
<?}else{?>
    <?include 'none-cabinet.php';?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

