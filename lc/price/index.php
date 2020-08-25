<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Цены на услуги клиники");
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

$arFilter = Array("IBLOCK_ID"=>"9", "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $diagnostic = $arProps['PRICE_DIAGNOST']['VALUE'];
    $uslugi = $arProps['PRICE_DOCTOR']['VALUE'];
    $idClinic = $arFields['ID'];
}?>
<? include '../menu.php';?>
<div class="personal-cabinet-content__price-page">
    <h2 class="title-h2"><?$APPLICATION->ShowTitle()?></h2>
    <div class="personal-cabinet-content__price-page__tabs">
        <h5 class="title-h5 active" data-tabs="0">Цены на диагностику</h5>
        <h5 class="title-h5" data-tabs="1">Цены на лечение</h5>
    </div>
    <div class="personal-cabinet-content__price-page__box">
        <div class="personal-cabinet-content__price-page__content active" data-tabs="0">
            <ul class="personal-cabinet-content__price-page__content__list">
                <?
                $i=0;
                $arSelect = array("ID", "NAME");
                $arFilter = array("IBLOCK_ID"=>18);
                $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                while($ar_result = $obSections->GetNext())
                {
                    $i++;
                    $formList_diagnost[]=array("NAME"=>$ar_result['NAME'],"ID"=>$ar_result['ID']);
                    ?>
                    <li <?if($i==1){?>class="active"<?}?> data-tabs="<?=$ar_result['ID']?>"><?=$ar_result['NAME']?></li>
                <?}?>
            </ul>
            <div class="personal-cabinet-content__price-page__content__list-box">
                <form id="form_clinic_PRICE_DIAGNOST" name="form_clinic_PRICE_DIAGNOST" action="" method="post">
                <?
                foreach($formList_diagnost as $key => $formItem){?>
                    <input type="hidden" name="PROPS" value="PRICE_DIAGNOST">
                    <input type="hidden" name="ID_CLINIC" value="<?=$idClinic?>">
                    <div class="personal-cabinet-content__price-page__content__list-content <?if($key==0){?>active<?}?>" data-tabs="<?=$formItem['ID']?>">
                        <div class="personal-cabinet-content__price-page__content__list-content__price">
                            <h4 class="title-h4">Цены на <?=$formItem['NAME']?></h4>
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Вкл.</td>
                                        <td>Вид <?=$formItem['NAME']?></td>
                                        <td>Цена, руб.</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    $arSelect = array("NAME",'ID');
                                    $arFilter = array("IBLOCK_ID"=>18,"IBLOCK_SECTION_ID"=>$formItem['ID']);
                                    $res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array(), $arSelect);
                                    while($ob = $res->GetNextElement())
                                    {
                                        $arFields = $ob->GetFields();?>
                                        <input type="hidden" name="<?=$arFields['ID']?>[]SECTION" value="<?=$formItem['NAME']?>">
                                        <input type="hidden" name="<?=$arFields['ID']?>[]DATE"  value="<?= date("m.d.y H:i:s");?>">
                                        <input type="hidden" name="<?=$arFields['ID']?>[]NAME" value="<?=$arFields['NAME']?>">
                                        <tr>
                                            <td>
                                                <label class="checkbox-group" data-role="label_<?=$arFields['ID']?>[]ACTIVE" for="<?=$arFields['ID']?>[]ACTIVE">
                                                    <span class="bx_filter_input_checkbox">
                                                        <input type="checkbox" class="day_work" name="<?=$arFields['ID']?>[]ACTIVE" id="<?=$arFields['ID']?>[]ACTIVE">
                                                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                                    </span>
                                                </label>
                                            </td>
                                            <td><?=$arFields['NAME']?></td>
                                            <td>
                                                <input type="text" name="<?=$arFields['ID']?>[]PRICE" value="1 500">
                                                <span>18.02.2020</span>
                                            </td>
                                        </tr>
                                    <?}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?}?>
                    <div class="text-view">
                        <div id="message-form_PRICE_DIAGNOST"></div>
                        <button type="submit" name="saveProfile" class="save" id="saveProfile">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="personal-cabinet-content__price-page__content" data-tabs="1">
            <ul class="personal-cabinet-content__price-page__content__list">
                <?
                $i=0;
                $arSelect = array("ID", "NAME");
                $arFilter = array("IBLOCK_ID"=>19);
                $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                while($ar_result = $obSections->GetNext())
                {
                    $i++;
                    $formList_uslugi[]=array("NAME"=>$ar_result['NAME'],"ID"=>$ar_result['ID']);
                    ?>
                    <li <?if($i==1){?>class="active"<?}?> data-tabs="<?=$ar_result['ID']?>"><?=$ar_result['NAME']?></li>
                <?}?>
            </ul>
            <div class="personal-cabinet-content__price-page__content__list-box">
                <form id="form_clinic_PRICE_DOCTOR" name="form_clinic_PRICE_DOCTOR" action="" method="post">
                    <input type="hidden" name="PROPS" value="PRICE_DOCTOR">
                    <input type="hidden" name="ID_CLINIC" value="<?=$idClinic?>">
                <?
                foreach($formList_uslugi as $key => $formItem){?>
                    <div class="personal-cabinet-content__price-page__content__list-content <?if($key==0){?>active<?}?>" data-tabs="<?=$formItem['ID']?>">
                        <div class="personal-cabinet-content__price-page__content__list-content__price">
                            <h4 class="title-h4">Цены на <?=$formItem['NAME']?></h4>
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Вкл.</td>
                                        <td>Вид <?=$formItem['NAME']?></td>
                                        <td>Цена, руб.</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    $arSelect = array("NAME",'ID');
                                    $arFilter = array("IBLOCK_ID"=>19,"IBLOCK_SECTION_ID"=>$formItem['ID']);
                                    $res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array(), $arSelect);
                                    while($ob = $res->GetNextElement())
                                    {
                                        $arFields = $ob->GetFields();?>
                                        <input type="hidden" name="<?=$arFields['ID']?>[]SECTION" value="<?=$formItem['NAME']?>">
                                        <input type="hidden" name="<?=$arFields['ID']?>[]DATE"  value="<?= date("m.d.y H:i:s");?>">
                                        <input type="hidden" name="<?=$arFields['ID']?>[]NAME" value="<?=$arFields['NAME']?>">
                                        <tr>
                                            <td>
                                                <label class="checkbox-group" data-role="label_<?=$arFields['ID']?>[]ACTIVE" for="<?=$arFields['ID']?>[]ACTIVE">
                                                    <span class="bx_filter_input_checkbox">
                                                        <input type="checkbox" class="day_work" name="<?=$arFields['ID']?>[]ACTIVE" id="<?=$arFields['ID']?>[]ACTIVE">
                                                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                                    </span>
                                                </label>
                                            </td>
                                            <td><?=$arFields['NAME']?></td>
                                            <td>
                                                <input type="text" name="<?=$arFields['ID']?>[]PRICE" value="1 500">
                                                <span>18.02.2020</span>
                                            </td>
                                        </tr>
                                    <?}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?}?>
                    <div class="text-view">
                        <div id="message-form_PRICE_DOCTOR"></div>
                        <button type="submit" name="saveProfile" class="save" id="saveProfile">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function () {
            $("#form_clinic_PRICE_DIAGNOST").submit(function () {
                let formID = $(this).attr('id');
                let formNm = $('#' + formID);
                let formMs = $('#message-form_PRICE_DIAGNOST');
                $.ajax({
                    type: "POST",
                    url: '/lc/price-save.php',
                    data: formNm.serialize(),
                    success: function (data) {
                        // Вывод текста результата отправки
                        $(formMs).html(data);
                    }
                });
                return false;
            });
            $("#form_clinic_PRICE_DOCTOR").submit(function () {
                let formID = $(this).attr('id');
                let formNm = $('#' + formID);
                let formMs = $('#message-form_PRICE_DOCTOR');
                $.ajax({
                    type: "POST",
                    url: '/lc/price-save.php',
                    data: formNm.serialize(),
                    success: function (data) {
                        // Вывод текста результата отправки
                        $(formMs).html(data);
                    }
                });
                return false;
            });
        });
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>