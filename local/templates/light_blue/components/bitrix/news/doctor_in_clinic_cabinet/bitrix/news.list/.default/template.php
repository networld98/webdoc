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
    <input type="hidden" name="FULL_PROPERTY[]" value="<?=$prop["CODE"]?>">
    </li>
<?}?>
<?function propselect($prop,$iblock){?>
<li>
        <label for=""><?=$prop['NAME']?></label>
    <select name="<?=$prop['CODE']?>" id="<?=$prop['CODE']?>" value="">
        <?
        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$prop["CODE"]));
        while($enum_fields = $property_enums->GetNext())
        {?>
            <option value="<?=$enum_fields["ID"]?>" <?if($prop['VALUE']==$enum_fields["VALUE"]){?>selected<?}?>><?=$enum_fields["VALUE"]?></option>
       <? }?>
    </select>
    </li>
<?}?>
<?function propofficial($prop){?>
    <li>
        <label for=""><?=$prop['NAME']?></label>
        <input type="text" name="<?=$prop['CODE']?>" value="<?=$prop['VALUE']?>">
    </li>
<?}?>
    <div class="add" value="0" title="Добавить нового врача">Добавить нового врача</div>
    <form id="form_doctor_NEW" name="form_doctor_NEW" action="" method="post" class="personal-cabinet-content__doctors-page-box-item"></form>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
        <form id="form_doctor_<?=$arItem['ID']?>" name="form_doctor_<?=$arItem['ID']?>" action="" method="post" class="personal-cabinet-content__doctors-page-box-item">
            <input type="hidden" name="ID_DOCTOR" value="<?=$arItem['ID']?>">
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
                            <span class="personal-cabinet-content__doctors-page-box-item__desc__name">
                                <input type="text" name="NAME_DOCTOR" value="<?=$arItem['NAME']?>">
                            </span>
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
                        <div class="toggle reverse_switch">
                            <?$db_enum_list = CIBlockProperty::GetPropertyEnum($arItem['PROPERTIES']['NOT_ON']['CODE'], Array(), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "VALUE"=>"Y"));
                            if($ar_enum_list = $db_enum_list->GetNext()) ?>
                            <input type="checkbox"  id="normal_<?=$arItem['ID']?>" <?if($arItem['PROPERTIES']['NOT_ON']['VALUE']=='Y'){?>checked<?}?> name="<?=$arItem['PROPERTIES']['NOT_ON']['CODE']?>" value="<?=$ar_enum_list['ID']?>" class="swith" type="checkbox"/>
                            <label class="toggle-item" for="normal_<?=$arItem['ID']?>"></label>
                            <input type="hidden" name="FULL_PROPERTY[]" value="<?=$arItem['PROPERTIES']['NOT_ON']['CODE']?>">
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
                        <? propselect($arItem['PROPERTIES']['GENDER'],$arParams['IBLOCK_ID'])?>
                        <?propofficial($arItem['PROPERTIES']['AGE_PACIENT'])?>
                        <?propview($arItem['PROPERTIES']['CHILDREN_DOCTOR'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['DEPARTURE_HOUSE'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['ONLINE'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['UMC'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['DMC'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                        <?propview($arItem['PROPERTIES']['DIAGNOSTICS'],$arItem['ID'],$arParams['IBLOCK_ID'])?>
                    </ul>
                    <div class="text-view">
                        <div id="message-form_<?=$arItem['ID']?>"></div>
                        <button type="submit" name="saveProfile" class="save">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    <script>
        $(document).ready(function () {
            $("#form_doctor_<?=$arItem['ID']?>").submit(function () {
                let formID = $(this).attr('id');
                let formNm = $('#' + formID);
                let formMs = $("#message-form_<?=$arItem['ID']?>");
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
            $('.add').on('click', function () {
                var str = ' <input type="hidden" name="ID_DOCTOR" value="NEW">\n' +
                    '    <div class="personal-cabinet-content__doctors-page-box-item__img">\n' +
                    '        <img src="<?= SITE_TEMPLATE_PATH ?>/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo">\n' +
                    '    </div>\n' +
                    '    <div class="personal-cabinet-content__doctors-page-box-item__desc">\n' +
                    '        <div class="personal-cabinet-content__doctors-page-box-item__desc__head">\n' +
                    '            <div class="personal-cabinet-content__doctors-page-box-item__desc-left">\n' +
                    '                <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">\n' +
                    '                            <span class="personal-cabinet-content__doctors-page-box-item__desc__name">\n' +
                    '                                <input type="text" name="NAME_DOCTOR" value="">\n' +
                    '                            </span>\n' +
                    '                    <span class="personal-cabinet-content__doctors-page-box-item__desc__status">не работает в клинике</span>\n' +
                    '                </div>\n' +
                    '                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor">\n' +
                    '                    <span>Редактировать данные</span>\n' +
                    '                </div>\n' +
                    '                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop">\n' +
                    '                    <ul>\n' +
                    '                        <li class="active">Основное</li>\n' +
                    '                        <li>Профиль лечения</li>\n' +
                    '                        <li>Образование</li>\n' +
                    '                        <li>Опыт работы</li>\n' +
                    '                        <li>Курсы</li>\n' +
                    '                    </ul>\n' +
                    '                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content main-block">\n' +
                    '                        <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">\n' +
                    '                            <span>Главная специальность</span>\n' +
                    '                            <select name="" id="">\n' +
                    '                                <option value="">Хирург</option>\n' +
                    '                            </select>\n' +
                    '                        </div>\n' +
                    '                        <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">\n' +
                    '                            <span>Степень</span>\n' +
                    '                            <select name="" id="">\n' +
                    '                                <option value="">-----------------</option>\n' +
                    '                            </select>\n' +
                    '                        </div>\n' +
                    '                        <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">\n' +
                    '                            <span>Категория</span>\n' +
                    '                            <select name="" id="">\n' +
                    '                                <option value="">-----------------</option>\n' +
                    '                            </select>\n' +
                    '                        </div>\n' +
                    '                        <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row last">\n' +
                    '                            <span>Главная специальность</span>\n' +
                    '                            <input type="text" name="" id="" value="0">\n' +
                    '                            <span>лет</span>\n' +
                    '                            <span>с</span>\n' +
                    '                            <select name="" id="">\n' +
                    '                                <option value="">2000</option>\n' +
                    '                            </select>\n' +
                    '                            <span>года</span>\n' +
                    '                        </div>\n' +
                    '                        <button class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__btn">Сохранить</button>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '            <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">\n' +
                    '                <div class="toggle reverse_switch">\n' +
                    '                    <input type="checkbox" id="normal_NEW" name="NOT_ON" value="98" class="swith">\n' +
                    '                    <label class="toggle-item" for="normal_NEW"></label>\n' +
                    '                    <input type="hidden" name="FULL_PROPERTY[]" value="NOT_ON">\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box">\n' +
                    '            <ul class="checkbox-group">\n' +
                    '                <li>\n' +
                    '                    <label for="">Пол</label>\n' +
                    '                    <select name="GENDER" id="GENDER" value="">\n' +
                    '                        <option value="70">Мужчина</option>\n' +
                    '                        <option value="71">Женщина</option>\n' +
                    '                    </select>\n' +
                    '                </li>\n' +
                    '                <li>\n' +
                    '                    <label for="">Возраст пациентов</label>\n' +
                    '                    <input type="text" name="AGE_PACIENT" value="">\n' +
                    '                </li>\n' +
                    '                <li>\n' +
                    '                    <label data-role="label_CHILDREN_DOCTOR_NEW" class="bx_filter_param_label " for="CHILDREN_DOCTOR_NEW">\n' +
                    '            <span class="bx_filter_input_checkbox">\n' +
                    '                <input type="checkbox" value="58" name="CHILDREN_DOCTOR" id="CHILDREN_DOCTOR_NEW">\n' +
                    '                    <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>\n' +
                    '                <span class="bx_filter_param_text">Детский врач</span>\n' +
                    '            </span>\n' +
                    '                    </label>\n' +
                    '                    <input type="hidden" name="FULL_PROPERTY[]" value="CHILDREN_DOCTOR">\n' +
                    '                </li>\n' +
                    '                <li>\n' +
                    '                    <label data-role="label_DEPARTURE_HOUSE_NEW" class="bx_filter_param_label " for="DEPARTURE_HOUSE_NEW">\n' +
                    '            <span class="bx_filter_input_checkbox">\n' +
                    '                <input type="checkbox" value="59" name="DEPARTURE_HOUSE" id="DEPARTURE_HOUSE_NEW">\n' +
                    '                    <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>\n' +
                    '                <span class="bx_filter_param_text">Выезд на дом</span>\n' +
                    '            </span>\n' +
                    '                    </label>\n' +
                    '                    <input type="hidden" name="FULL_PROPERTY[]" value="DEPARTURE_HOUSE">\n' +
                    '                </li>\n' +
                    '                <li>\n' +
                    '                    <label data-role="label_ONLINE_NEW" class="bx_filter_param_label " for="ONLINE_NEW">\n' +
                    '            <span class="bx_filter_input_checkbox">\n' +
                    '                <input type="checkbox" value="68" name="ONLINE" id="ONLINE_NEW">\n' +
                    '                    <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>\n' +
                    '                <span class="bx_filter_param_text">Онлайн</span>\n' +
                    '            </span>\n' +
                    '                    </label>\n' +
                    '                    <input type="hidden" name="FULL_PROPERTY[]" value="ONLINE">\n' +
                    '                </li>\n' +
                    '                <li>\n' +
                    '                    <label data-role="label_UMC_NEW" class="bx_filter_param_label " for="UMC_NEW">\n' +
                    '            <span class="bx_filter_input_checkbox">\n' +
                    '                <input type="checkbox" value="86" name="UMC" id="UMC_NEW">\n' +
                    '                    <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>\n' +
                    '                <span class="bx_filter_param_text">По полису ОМС</span>\n' +
                    '            </span>\n' +
                    '                    </label>\n' +
                    '                    <input type="hidden" name="FULL_PROPERTY[]" value="UMC">\n' +
                    '                </li>\n' +
                    '                <li>\n' +
                    '                    <label data-role="label_DMC_NEW" class="bx_filter_param_label " for="DMC_NEW">\n' +
                    '            <span class="bx_filter_input_checkbox">\n' +
                    '                <input type="checkbox" value="87" name="DMC" id="DMC_NEW">\n' +
                    '                    <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>\n' +
                    '                <span class="bx_filter_param_text">По полису ДМС</span>\n' +
                    '            </span>\n' +
                    '                    </label>\n' +
                    '                    <input type="hidden" name="FULL_PROPERTY[]" value="DMC">\n' +
                    '                </li>\n' +
                    '                <li>\n' +
                    '                    <label data-role="label_DIAGNOSTICS_NEW" class="bx_filter_param_label " for="DIAGNOSTICS_NEW">\n' +
                    '            <span class="bx_filter_input_checkbox">\n' +
                    '                <input type="checkbox" value="88" name="DIAGNOSTICS" id="DIAGNOSTICS_NEW">\n' +
                    '                    <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>\n' +
                    '                <span class="bx_filter_param_text">Диагностика</span>\n' +
                    '            </span>\n' +
                    '                    </label>\n' +
                    '                    <input type="hidden" name="FULL_PROPERTY[]" value="DIAGNOSTICS">\n' +
                    '                </li>\n' +
                    '            </ul>\n' +
                    '            <div class="text-view">\n' +
                    '                <div id="message-form_NEW"></div>\n' +
                    '                <button type="submit" name="saveProfile" class="save">Сохранить</button>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '    </div>';
                document.getElementById('form_doctor_NEW').innerHTML = str;
                $('.add').hide();
            });
        });
    </script>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	 <?=$arResult["NAV_STRING"]?>
<?endif;?>
