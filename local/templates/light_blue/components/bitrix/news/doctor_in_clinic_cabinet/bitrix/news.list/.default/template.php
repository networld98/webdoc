<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
CModule::IncludeModule("iblock");
?>
<?function propview($prop,$id,$iblock){
    $db_enum_list = CIBlockProperty::GetPropertyEnum($prop["CODE"], Array(), Array("IBLOCK_ID"=>$iblock, "VALUE"=>"Y"));
    if($ar_enum_list = $db_enum_list->GetNext()) ?>
        <li>
        <label data-role="label_<?=$prop["CODE"]?>_<?=$id?>" class="bx_filter_param_label " for="<?=$prop["CODE"]?>_<?=$id?>">
            <span class="bx_filter_input_checkbox">
                <input type="checkbox" <?if($prop["VALUE"] == 'Y'){?>checked<?}?> value="<?=$ar_enum_list['ID']?>" name="<?=$prop["CODE"]?>" id="<?=$prop["CODE"]?>_<?=$id?>">
                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                <span class="bx_filter_param_text"><?=$prop["NAME"]?></span>
            </span>
        </label>
    <input type="hidden" name="FULL_PROPERTY[]" value="<?=$prop["CODE"]?><?=$id?>">
    </li>
<?}?>
<?function propofficial($prop){?>
    <li>
        <label for=""><?=$prop['NAME']?></label>
        <input type="text" name="<?=$prop['CODE']?>" value="<?=$prop['VALUE']?>">
    </li>
<?}?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
        <form name="form_clinic" action="" method="post" class="form_clinic personal-cabinet-content__doctors-page-box-item">
            <div class="personal-cabinet-content__doctors-page-box-item__img">
                <?if($arItem['DETAIL_PICTURE']['SRC']!=NULL){?>
                    <img src="<?= $arItem['DETAIL_PICTURE']['SRC'] ?>" alt="doctor-photo" class="doctors-list-item__img-photo">
                <?}elseif($arItem['PROPERTIES']['GENDER']['VALUE']==NULL || $arItem['PROPERTIES']['GENDER']['VALUE']=="Мужчина" ){?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/icon/male.svg" alt="no-photo" class="doctors-list-item__img-none-photo">
                <?}elseif($arItem['PROPERTIES']['GENDER']['VALUE']=="Женщина" ){?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo">
                <?}?>
            </div>
            <div class="personal-cabinet-content__doctors-page-box-item__desc">
                <div class="personal-cabinet-content__doctors-page-box-item__desc__head">
                    <div class="personal-cabinet-content__doctors-page-box-item__desc-left">
                        <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                            <span class="personal-cabinet-content__doctors-page-box-item__desc__name"><?=$arItem['NAME']?></span>
                            <span class="personal-cabinet-content__doctors-page-box-item__desc__status">не работает в клинике</span>
                        </div>
                        <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor">
                            <span>Редактировать данные</span>
                        </div>
                        <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop">
                            <ul>
                                <li class="active">Основное</li>
                                <li>Профиль лечения</li>
                                <li>Образование</li>
                                <li>Опыт работы</li>
                                <li>Курсы</li>
                            </ul>
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content main-block">
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                    <span>Главная специальность</span>
                                    <select name="" id="">
                                        <option value="">Хирург</option>
                                    </select>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                    <span>Степень</span>
                                    <select name="" id="">
                                        <option value="">-----------------</option>
                                    </select>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                    <span>Категория</span>
                                    <select name="" id="">
                                        <option value="">-----------------</option>
                                    </select>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row last">
                                    <span>Главная специальность</span>
                                    <input type="text" name="" id="" value="0">
                                    <span>лет</span>
                                    <span>с</span>
                                    <select name="" id="">
                                        <option value="">2000</option>
                                    </select>
                                    <span>года</span>
                                </div>
                                <button class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__btn">Сохранить</button>
                            </div>
                        </div>
                    </div>
                    <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                        <div class="toggle normal">
                            <input id="normal_<?=$arItem['ID']?>" <?if($arItem['PROPERTIES']['NOT_ON']['VALUE']==NULL){?>checked<?}?> class="swith" type="checkbox"/>
                            <label class="toggle-item" for="normal_<?=$arItem['ID']?>"></label>
                        </div>
                    </div>
                </div>
                <?/* global $USER;
                if ($USER->IsAdmin()) {
                    echo"<pre>";
                    print_r($arItem['PROPERTIES']);
                    echo"</pre>";
                }
                */?>
                <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box">
                    <ul class="checkbox-group">
                        <?propofficial($arItem['PROPERTIES']['GENDER'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propofficial($arItem['PROPERTIES']['AGE_PACIENT'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['CHILDREN_DOCTOR'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['DEPARTURE_HOUSE'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['ONLINE'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['UMC'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['DMC'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['DIAGNOSTICS'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                    </ul>
                    <div class="text-view">
                        <div class="message-form"></div>
                        <button type="submit" name="saveProfile" class="save saveProfile">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
<?endforeach;?>
    <script>
        $(document).ready(function () {
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
            $(document).ready(function () {
                $(".form_clinic").submit(function () {
                    let formID = $(this).attr('id');
                    let formNm = $('.' + formID);
                    let formMs = $('.message-form');
                    $.ajax({
                        type: "POST",
                        url: '/lc/doctor-in-clinic-save.php',
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
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	 <?=$arResult["NAV_STRING"]?>
<?endif;?>