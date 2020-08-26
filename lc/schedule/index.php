<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расписание клиники");

CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

$arFilter = Array("IBLOCK_ID"=>"9", "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $idClinic = $arFields['ID'];
}?>
<?
$work_time = explode(";", $arProps['WORK_TIME']['VALUE']);
foreach ($work_time as $time){
    $day[] = explode("/", $time);
}
?>
<?function propview_schedule($prop){
    $db_enum_list = CIBlockProperty::GetPropertyEnum($prop["CODE"], Array(), Array("IBLOCK_ID"=>9, "VALUE"=>"Y"));
    if($ar_enum_list = $db_enum_list->GetNext())
    {
        $valueId = $ar_enum_list['ID'];
    }
    ?>
    <li>
        <label data-role="label_<?=$prop["CODE"]?>" class="bx_filter_param_label " for="<?=$prop["CODE"]?>">
                <span class="bx_filter_input_checkbox">
                    <input type="checkbox" <?if($prop["VALUE"] == 'Y'){?>checked<?}?> value="<?=$valueId?>" name="<?=$prop["CODE"]?>" id="<?=$prop["CODE"]?>">
                        <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                    <span class="bx_filter_param_text"><?=$prop["NAME"]?></span>
                </span>
        </label>
        <input type="hidden" name="FULL_PROPERTY[]" value="<?=$prop["CODE"]?>">
    </li>
<?}?>
<?function day($prop, $key, $day, $daynight){?>
    <li >
        <span><?=$prop?></span>
        <select name="<?=$prop?>[]" <?if(count($day[$key]) == 2 || $daynight['VALUE'] == 'Y'){?>disabled="disabled"<?}?>>
            <?$x=-1;
            while ($x++<24){
                $num = str_pad($x, 2, '0', STR_PAD_LEFT);?>
                <option <?if($num==$day[$key][1]){?>selected<?}?> value="<?=$num?>"><?=$num?></option>
            <?}?>
        </select>
        <span>:</span>
        <select name="<?=$prop?>[]" <?if(count($day[$key]) == 2 || $daynight['VALUE'] == 'Y'){?>disabled="disabled"<?}?>>
            <?$x=-1;
            while ($x++<59){
                $num = str_pad($x, 2, '0', STR_PAD_LEFT);?>
                <option <?if($num==$day[$key][2]){?>selected<?}?> value="<?=$num?>"><?=$num?></option>
            <?}?>
        </select>
        <span>—</span>
        <select name="<?=$prop?>[]" <?if(count($day[$key]) == 2 || $daynight['VALUE'] == 'Y'){?>disabled="disabled"<?}?>>
            <?$x=-1;
            while ($x++<24){
                $num = str_pad($x, 2, '0', STR_PAD_LEFT);?>
                <option <?if($num==$day[$key][3]){?>selected<?}?> value="<?=$num?>"><?=$num?></option>
            <?}?>
        </select>
        <span>:</span>
        <select name="<?=$prop?>[]" <?if(count($day[$key]) == 2 || $daynight['VALUE'] == 'Y'){?>disabled="disabled"<?}?>>
            <?$x=-1;
            while ($x++<59){
                $num = str_pad($x, 2, '0', STR_PAD_LEFT);?>
                <option <?if($num==$day[$key][4]){?>selected<?}?> value="<?=$num?>"><?=$num?></option>
            <?}?>
        </select>
        <span>
            <div class="checkbox-group">
                 <label class="label-holiday" data-role="label_<?=$prop?>" for="<?=$prop?>">
                    <span class="bx_filter_input_checkbox">
                        <input type="checkbox" class="day_work" <?if(count($day[$key])==2){?>checked<?}?> value="выходной" name="<?=$prop?>[]" id="<?=$prop?>">
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                    </span>
                    <span class="bx_filter_param_text">выходной</span>
                 </label>
            </div>
        </span>
    </li>
<?}?>
<? include '../menu.php';?>
<?if($idClinic !=NULL){?>
<form id="form_clinic" name="form_clinic" action="" method="post">
    <div class="personal-cabinet-content__schedule-page">
        <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
        <div class="personal-cabinet-content__schedule-page__adress-info">
            <?if($arProps['ADDRESS']['VALUE'] && $arProps['CITY']['VALUE']){?>
            <div class="adress">
                <span>Адрес</span>
                <?$res = CIBlockSection::GetByID($arProps['CITY']['VALUE']);
                if($ar_res = $res->GetNext()){?>
                    <p>г. <?=$ar_res['NAME']?>, <?=$arProps['ADDRESS']['VALUE']?></p>
                <?}?>

            </div>
            <?}?>
        </div>
        <div class="personal-cabinet-content__schedule-page__block">
            <input type="hidden" name="ID_CLINIC" value="<?=$idClinic?>">
            <ul class="checkbox-group">
                <? propview_schedule($arProps['DAY_AND_NIGHT'])?>
                <? propview_schedule($arProps['HOSPITAL'])?>
                <? propview_schedule($arProps['DAY_HOSPITAL'])?>
            </ul>
            <h4 class="title-h4">Расписание</h4>
            <ul class="select-time-list <?if($arProps['DAY_AND_NIGHT']['VALUE'] == 'Y'){?>disabled<?}?>">
                <?day("Пн", 0, $day, $arProps['DAY_AND_NIGHT'])?>
                <?day("Вт", 1, $day, $arProps['DAY_AND_NIGHT'])?>
                <?day("Ср", 2, $day, $arProps['DAY_AND_NIGHT'])?>
                <?day("Чт", 3, $day, $arProps['DAY_AND_NIGHT'])?>
                <?day("Пт", 4, $day, $arProps['DAY_AND_NIGHT'])?>
                <?day("Сб", 5, $day, $arProps['DAY_AND_NIGHT'])?>
                <?day("Вс", 6, $day, $arProps['DAY_AND_NIGHT'])?>
            </ul>
            <div class="text-view">
                <div id="message-form"></div>
                <button type="submit" name="saveProfile" class="save" id="saveProfile">Сохранить</button>
            </div>
        </div>
    </div>
</form>
    <script>
        $(document).ready(function () {
            $("#form_clinic").submit(function () {
                let formID = $(this).attr('id');
                let formNm = $('#' + formID);
                let formMs = $('#message-form');
                $.ajax({
                    type: "POST",
                    url: '/lc/schedule-save.php',
                    data: formNm.serialize(),
                    success: function (data) {
                        // Вывод текста результата отправки
                        $(formMs).html(data);
                    }
                });
                return false;
            });
            function dayNight() {
                var checked = $("input[name='DAY_AND_NIGHT']:checked").length;
                if (checked == 0) {
                    $(".select-time-list select").attr('disabled', false);
                    $(".select-time-list input").attr('disabled', false);
                    $(".select-time-list").removeClass('disabled');
                } else {
                    $(".select-time-list select").attr('disabled', true);
                    $(".select-time-list input").attr('disabled', true);
                    $(".select-time-list").addClass('disabled');
                }
            }
            $("input[name='DAY_AND_NIGHT']").on("click", function () {
                dayNight();
            });
            $(".label-holiday").on("click", function () {
                var check = $(this).find(".day_work:checked").length;
                if (check == 0) {
                    $(this).parents('li').removeClass('disabled');
                    $(this).parents('li').find('select').attr('disabled', false);
                } else {
                    $(this).parents('li').find('select').attr('disabled', true);
                    $(this).parents('li').addClass('disabled');

                }
            });
        })
    </script>
<?}else{?>
    <?include '../none-cabinet.php';?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>