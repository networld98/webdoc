<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Выбор услуг клиники");
CModule::IncludeModule('iblock');
global $priceClinic;
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
<?
$arSelect = Array("PROPERTY_PRICE_DOCTOR", "PROPERTY_PRICE_DIAGNOST", "PROPERTY_SPECIALIZATION");
$arFilter = Array("IBLOCK_ID"=>9, "ID"=>$idClinic);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $doctor = explode("/",$arFields['PROPERTY_PRICE_DOCTOR_VALUE']);
    $diagnost = explode("/",$arFields['PROPERTY_PRICE_DIAGNOST_VALUE']);
    $specializations[] = $arFields['PROPERTY_SPECIALIZATION_VALUE'];
    $priceClinic[$doctor[1]] = array(
        "NAME" =>$doctor[1],
        "PRICE" =>$doctor[2],
        "DATE" =>$doctor[3],
    );
    $priceClinic[$diagnost[1]] = array(
        "NAME" =>$diagnost[1],
        "PRICE" =>$diagnost[2],
        "DATE" =>$diagnost[3],
    );
}
?>
<?
 function tablePrice($formItem, $id_block, $priceClinic){?>
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
         $arFilter = array("IBLOCK_ID"=>$id_block,"IBLOCK_SECTION_ID"=>$formItem['ID']);
         $res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array(), $arSelect);
         while($ob = $res->GetNextElement())
         {
             $arFields = $ob->GetFields();?>
             <input type="hidden" name="<?=$arFields['ID']?>[]SECTION" value="<?=$formItem['NAME']?>">
             <input type="hidden" name="<?=$arFields['ID']?>[]DATE"  value="<?= date("d.m.y")?>">
             <input type="hidden" name="<?=$arFields['ID']?>[]NAME" value="<?=$arFields['NAME']?>">
             <tr <?if($arFields['NAME'] != $priceClinic[$arFields['NAME']]['NAME'] ){?>class="disabled"<?}?>>
                 <td>
                     <label class="checkbox-group label_price" data-role="label_<?=$arFields['ID']?>[]ACTIVE" for="<?=$arFields['ID']?>[]ACTIVE">
                        <span class="bx_filter_input_checkbox">
                            <input type="checkbox" class="checked-service" <?if($arFields['NAME'] == $priceClinic[$arFields['NAME']]['NAME'] ){?>checked<?}?> name="<?=$arFields['ID']?>[]ACTIVE" id="<?=$arFields['ID']?>[]ACTIVE">
                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                     </label>
                 </td>
                 <td><?=$arFields['NAME']?></td>
                 <td>
                     <input type="text" class="price-service-input" <?if($arFields['NAME'] != $priceClinic[$arFields['NAME']]['NAME'] ){?>disabled<?}?> name="<?=$arFields['ID']?>[]PRICE" value="<?=$priceClinic[$arFields['NAME']]["PRICE"]?>">
                     <span><?=$priceClinic[$arFields['NAME']]["DATE"]?></span>
                 </td>
             </tr>
         <?}?>
         </tbody>
     </table>
 <?}?>
<? include '../menu.php';?>
<div class="personal-cabinet-content__price-page">
    <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
    <div class="personal-cabinet-content__price-page__tabs">
        <h5 class="title-h5 active" data-tabs="0">Цены на диагностику</h5>
        <h5 class="title-h5" data-tabs="1">Цены на лечение</h5>
    </div>
    <div class="personal-cabinet-content__price-page__box">
        <div class="personal-cabinet-content__price-page__content active" data-tabs="0">
            <ul class="personal-cabinet-content__price-page__content__list">
                <?
                $i=0;
                $arSelect = array("ID", "NAME", "UF_SPECIF");
                $arFilter = array("IBLOCK_ID"=>18);
                $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                while($ar_result = $obSections->GetNext())
                {
                    if(array_intersect($ar_result['UF_SPECIF'],$specializations)!=NULL){
                        $i++;
                        $formList_diagnost[]=array("NAME"=>$ar_result['NAME'],"ID"=>$ar_result['ID']);
                        ?>
                        <li <?if($i==1){?>class="active"<?}?> data-tabs="<?=$ar_result['ID']?>"><?=$ar_result['NAME']?></li>
                    <?}
                }?>
            </ul>
            <?if($i==NUll){?>
                <div style="text-align:center;padding:40px 30px;width: 100%;">
                    <h5>Услуги не вы выбраны при заполнении данных о личном кабинете, выберите их <a href="/lc/"> тут</a></h5>
                </div>
            <?}?>
            <?if($i>0){?>
                <div class="personal-cabinet-content__price-page__content__list-box list-item">
                    <form id="form_clinic_PRICE_DIAGNOST" name="form_clinic_PRICE_DIAGNOST" action="" method="post">
                    <?
                    foreach($formList_diagnost as $key => $formItem){?>
                        <input type="hidden" name="PROPS" value="PRICE_DIAGNOST">
                        <input type="hidden" name="ID_CLINIC" value="<?=$idClinic?>">
                        <div class="personal-cabinet-content__price-page__content__list-content <?if($key==0){?>active<?}?>" data-tabs="<?=$formItem['ID']?>">
                            <div class="personal-cabinet-content__price-page__content__list-content__price">
                                <h4 class="title-h4">Цены на <?=$formItem['NAME']?></h4>
                                    <?
                                    global $formItem;
                                    $APPLICATION->IncludeComponent("bitrix:news.list","price_lc",Array(
                                            "DISPLAY_DATE" => "Y",
                                            "DISPLAY_NAME" => "Y",
                                            "DISPLAY_PICTURE" => "N",
                                            "DISPLAY_PREVIEW_TEXT" => "N",
                                            "AJAX_MODE" => "N",
                                            "IBLOCK_TYPE" => "content",
                                            "IBLOCK_ID" => "18",
                                            "NEWS_COUNT" => "10",
                                            "SORT_BY1" => "ACTIVE_FROM",
                                            "SORT_ORDER1" => "DESC",
                                            "SORT_BY2" => "SORT",
                                            "SORT_ORDER2" => "ASC",
                                            "FILTER_NAME" => "",
                                            "FIELD_CODE" => Array("ID"),
                                            "PROPERTY_CODE" => Array("DESCRIPTION"),
                                            "CHECK_DATES" => "Y",
                                            "DETAIL_URL" => "",
                                            "PREVIEW_TRUNCATE_LEN" => "",
                                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                            "SET_TITLE" => "Y",
                                            "SET_BROWSER_TITLE" => "Y",
                                            "SET_META_KEYWORDS" => "Y",
                                            "SET_META_DESCRIPTION" => "Y",
                                            "SET_LAST_MODIFIED" => "Y",
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                            "ADD_SECTIONS_CHAIN" => "Y",
                                            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                            "PARENT_SECTION" => $formItem['ID'],
                                            "PARENT_SECTION_NAME" => $formItem['NAME'],
                                            "PARENT_SECTION_CODE" => "",
                                            "INCLUDE_SUBSECTIONS" => "Y",
                                            "CACHE_TYPE" => "N",
                                            "CACHE_TIME" => "3600",
                                            "CACHE_FILTER" => "N",
                                            "CACHE_GROUPS" => "N",
                                            "DISPLAY_TOP_PAGER" => "",
                                            "DISPLAY_BOTTOM_PAGER" => "Y",
                                            "PAGER_TITLE" => "Новости",
                                            "PAGER_SHOW_ALWAYS" => "N",
                                            "PAGER_TEMPLATE" => "show_more_lc_price",
                                            "PAGER_DESC_NUMBERING" => "N",
                                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                            "PAGER_SHOW_ALL" => "Y",
                                            "PAGER_BASE_LINK_ENABLE" => "N",
                                            "SET_STATUS_404" => "Y",
                                            "SHOW_404" => "Y",
                                            "MESSAGE_404" => "",
                                            "PAGER_BASE_LINK" => "/lc/price/",
                                            "PAGER_PARAMS_NAME" => "",
                                            "AJAX_OPTION_JUMP" => "N",
                                            "AJAX_OPTION_STYLE" => "Y",
                                            "AJAX_OPTION_HISTORY" => "N",
                                            "AJAX_OPTION_ADDITIONAL" => ""
                                        )
                                    );
                                    unset($formItem);
                                    ?>
                                </div>
                            </div>
                        <?}?>
                        <div class="text-view">
                            <div id="message-form_PRICE_DIAGNOST"></div>
                            <button type="submit" name="saveProfile" class="save" id="saveProfile">Сохранить</button>
                        </div>
                    </form>
                </div>
            <?}?>
        </div>
        <div class="personal-cabinet-content__price-page__content" data-tabs="1">
            <ul class="personal-cabinet-content__price-page__content__list">
                <?
                $i=0;
                $arSelect = array("ID", "NAME", "UF_SPECIF");
                $arFilter = array("IBLOCK_ID"=>19);
                $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                while($ar_result = $obSections->GetNext()) {
                    if (array_intersect($ar_result['UF_SPECIF'],$specializations)!=NULL) {
                        $i++;
                        $formList_uslugi[] = array("NAME" => $ar_result['NAME'], "ID" => $ar_result['ID']);
                        ?>
                        <li <?
                            if ($i == 1){
                            ?>class="active"<?
                        } ?> data-tabs="<?= $ar_result['ID'] ?>"><?= $ar_result['NAME'] ?></li>
                    <?
                    }
                }?>
            </ul>
            <?if($i==NUll){?>
                <div style="text-align:center;padding:40px 30px;width: 100%;">
                    <h5>Услуги не вы выбраны при заполнении данных о личном кабинете, выберите их <a href="/lc/"> тут</a></h5>
                </div>
            <?}?>
            <?if($i>0){?>
                <div class="personal-cabinet-content__price-page__content__list-box">
                    <form id="form_clinic_PRICE_DOCTOR" name="form_clinic_PRICE_DOCTOR" action="" method="post">
                        <input type="hidden" name="PROPS" value="PRICE_DOCTOR">
                        <input type="hidden" name="ID_CLINIC" value="<?=$idClinic?>">
                        <?foreach($formList_uslugi as $key => $formItem){?>
                            <div class="personal-cabinet-content__price-page__content__list-content <?if($key==0){?>active<?}?>" data-tabs="<?=$formItem['ID']?>">
                                <div class="personal-cabinet-content__price-page__content__list-content__price">
                                    <h4 class="title-h4">Цены на <?=$formItem['NAME']?></h4>
                                        <?
                                        global $formItem;
                                        $APPLICATION->IncludeComponent("bitrix:news.list","price_lc",Array(
                                                "DISPLAY_DATE" => "Y",
                                                "DISPLAY_NAME" => "Y",
                                                "DISPLAY_PICTURE" => "N",
                                                "DISPLAY_PREVIEW_TEXT" => "N",
                                                "AJAX_MODE" => "N",
                                                "IBLOCK_TYPE" => "content",
                                                "IBLOCK_ID" => "19",
                                                "NEWS_COUNT" => "10",
                                                "SORT_BY1" => "ACTIVE_FROM",
                                                "SORT_ORDER1" => "DESC",
                                                "SORT_BY2" => "SORT",
                                                "SORT_ORDER2" => "ASC",
                                                "FILTER_NAME" => "",
                                                "FIELD_CODE" => Array("ID"),
                                                "PROPERTY_CODE" => Array("DESCRIPTION"),
                                                "CHECK_DATES" => "Y",
                                                "DETAIL_URL" => "",
                                                "PREVIEW_TRUNCATE_LEN" => "",
                                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                                "SET_TITLE" => "Y",
                                                "SET_BROWSER_TITLE" => "Y",
                                                "SET_META_KEYWORDS" => "Y",
                                                "SET_META_DESCRIPTION" => "Y",
                                                "SET_LAST_MODIFIED" => "Y",
                                                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                                "ADD_SECTIONS_CHAIN" => "Y",
                                                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                                "PARENT_SECTION" => $formItem['ID'],
                                                "PARENT_SECTION_NAME" => $formItem['NAME'],
                                                "PARENT_SECTION_CODE" => "",
                                                "INCLUDE_SUBSECTIONS" => "Y",
                                                "CACHE_TYPE" => "N",
                                                "CACHE_TIME" => "3600",
                                                "CACHE_FILTER" => "N",
                                                "CACHE_GROUPS" => "N",
                                                "DISPLAY_TOP_PAGER" => "",
                                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                                "PAGER_TITLE" => "Новости",
                                                "PAGER_SHOW_ALWAYS" => "N",
                                                "PAGER_TEMPLATE" => "show_more_lc_price",
                                                "PAGER_DESC_NUMBERING" => "N",
                                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                                "PAGER_SHOW_ALL" => "Y",
                                                "PAGER_BASE_LINK_ENABLE" => "N",
                                                "SET_STATUS_404" => "Y",
                                                "SHOW_404" => "Y",
                                                "MESSAGE_404" => "",
                                                "PAGER_BASE_LINK" => "/lc/price/",
                                                "PAGER_PARAMS_NAME" => "",
                                                "AJAX_OPTION_JUMP" => "N",
                                                "AJAX_OPTION_STYLE" => "Y",
                                                "AJAX_OPTION_HISTORY" => "N",
                                                "AJAX_OPTION_ADDITIONAL" => ""
                                            )
                                        );
                                        unset($formItem);
                                        ?>
                                </div>
                            </div>
                        <?}?>
                        <div class="text-view">
                            <div id="message-form_PRICE_DOCTOR"></div>
                            <button type="submit" name="saveProfile" class="save" id="saveProfile">Сохранить</button>
                        </div>
                    </form>
                </div>
            <?}?>
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
            $(".label_price").on("click", function () {
                var check = $(this).find(".checked-service:checked").length;
                if (check == 1) {
                    $(this).parents('tr').removeClass('disabled');
                    $(this).parents('tr').find('.price-service-input').attr('disabled', false);
                } else {
                    $(this).parents('tr').find('.price-service-input').attr('disabled', true);
                    $(this).parents('tr').addClass('disabled');

                }
            });
        });
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>