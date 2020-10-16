<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бронирование");
CModule::IncludeModule("form");
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

$arFilter = Array("IBLOCK_ID"=>array(9,10), "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
$arFields = $ob->GetFields();
$arProps = $ob->GetProperties();
$idClient = $arFields['ID'];
}
?>
<?function booking ($id, $idClient,$form){
    // ID веб-формы
    $FORM_ID = $id;

    // фильтр по полям результата
    $arFilter = array(
    );

    // фильтр по вопросам

    $arFilter["FIELDS"] = array();

    // выберем первые 10 результатов
    $rsResults = CFormResult::GetList($FORM_ID,
        ($by="s_timestamp"),
        ($order="desc"),
        $arFilter,
        $is_filtered,
        "Y",
        10);
    while ($arResult = $rsResults->Fetch())
    {
        $RESULT_ID = $arResult['ID']; // ID результата

        // получим данные по всем вопросам
        $arAnswer = CFormResult::GetDataByID(
            $RESULT_ID,
            array(),
            $arResult,
            $arAnswer2);?>
        <?if(explode('/',$arAnswer['SIMPLE_'.$form.'_3'][0]['USER_TEXT'])[1] == $idClient ){?>
        <div class="row text-center">
            <div class="col-1 text-left">
                <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                    <div class="toggle reverse_switch">
                        <input type="checkbox"  id="normal_<?=$arItem['ID']?>" <?if($arItem['PROPERTIES']['NOT_ON']['VALUE']=='Y'){?>checked<?}?> name="<?=$arItem['PROPERTIES']['NOT_ON']['CODE']?>" value="<?=$ar_enum_list['ID']?>" class="swith" type="checkbox"/>
                        <label class="toggle-item" for="normal_<?=$arItem['ID']?>"></label>
                        <input type="hidden" name="FULL_PROPERTY[]" value="<?=$arItem['PROPERTIES']['NOT_ON']['CODE']?>">
                    </div>
                </div>
            </div>
            <div class="col-2"><?=$arAnswer['SIMPLE_'.$form.'_1'][0]['USER_TEXT']?></div>
            <div class="col-2"><?=explode('/',$arAnswer['SIMPLE_'.$form.'_PHONE'][0]['USER_TEXT'])[1]?></div>
            <div class="col-2"><?=$arAnswer['SIMPLE_'.$form.'_2'][0]['USER_TEXT']?></div>
            <div class="col-2"><?=$arAnswer['SIMPLE_'.$form.'_5'][0]['USER_TEXT']?></div>
            <div class="col-1"><?=$arAnswer['SIMPLE_'.$form.'_6'][0]['USER_TEXT']?></div>
            <div class="col-2"><?=$arAnswer['SIMPLE_'.$form.'_4'][0]['USER_TEXT']?></div>
        </div>
    <?}?>
    <?}
} ?>
<? include '../menu.php';?>
<?if($idClient !=NULL){?>
    <div class="personal-cabinet-content__price-page">
        <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
        <div class="personal-cabinet-content__schedule-page__block">
            <h5>Запись к врачам</h5>
            <div class="border">
                <?booking(4,$idClient,"RECORD") ?>
            </div>
            <h5>Вызов домой</h5>
            <div class="border">
                <?booking(5,$idClient,"HOME") ?>
            </div>
         </div>
    </div>
<?}else{?>
    <?include '../none-cabinet.php';?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

