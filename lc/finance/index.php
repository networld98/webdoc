<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пополнить баланс");

CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
global $idClinic;

$arFilter = Array("IBLOCK_ID"=>"9", "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array("ID");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
$arFields = $ob->GetFields();
$idClinic = $arFields['ID'];
}
?>
<? include '../menu.php';?>
<?if($idClinic !=NULL){?>
    <div class="personal-cabinet-content__price-page">
        <div class="personal-cabinet-content__schedule-page__block">
            <h5>Выберете срок платного размещения на сайте</h5>
            <form id="form_requisites" name="form_requisites" action="" method="post" class="form-requistment">
                <ul class="checkbox-group radio-group radio-group-column">
                    <?$arSelect = Array("ID","NAME", "PROPERTY_PRICE");
                    $arFilter = Array("IBLOCK_ID"=>23);
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                    while($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();?>
                        <li>
                            <label data-role="label_<?=$arFields['ID']?>" class="bx_filter_param_label" for="<?=$arFields['ID']?>">
                        <span class="bx_filter_input_radio">
                            <input type="radio" value="<?=$arFields['PROPERTY_PRICE_VALUE']?>" name="PERIOD_PRICE" id="<?=$arFields['ID']?>">
                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                            <span class="bx_filter_param_text"><?=$arFields["NAME"]?> <?=$arFields['PROPERTY_PRICE_VALUE']?> рублей</span>
                        </span>
                            </label>
                        </li>
                    <?}?>
                </ul>
                <button type="submit" class="save" >Выписать счёт</button>
            </form>
        </div>
    </div>
<?}else{?>
    <?include 'none-cabinet.php';?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>