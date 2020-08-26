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
global $idClinic;
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
    <div class="add" value="0" title="Добавить нового врача">+ Добавить нового врача</div>
    <form id="form_doctor_NEW" name="form_doctor_NEW" action="" method="post" class="personal-cabinet-content__doctors-page-box-item">
    </form>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <form id="form_doctor_<?=$arItem['ID']?>" name="form_doctor_<?=$arItem['ID']?>" action="" method="post" class="personal-cabinet-content__doctors-page-box-item card-item">
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
                           <? /*<span class="personal-cabinet-content__doctors-page-box-item__desc__status">не работает в клинике</span>*/?>
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
                        <span class="save delete-doctor" id="delete_<?=$arItem['ID']?>">Отвязать врача от клиники</span>
                        <button type="submit" name="saveProfile" class="save">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    <script>
        $(document).ready(function () {
            $('#delete_<?=$arItem["ID"]?>').on('click', function () {
                let formMs = $("#message-form_<?=$arItem['ID']?>");
                $.ajax({
                    type: "POST",
                    url: '/lc/doctor-delete.php',
                    data: "ID_CLINIC=<?=$idClinic?>&ID_DOCTOR=<?=$arItem['ID']?>",
                    success: function (data) {
                        // Вывод текста результата отправки
                        $(formMs).html(data);
                    }
                });
                return false;
            });
            $("#form_doctor_<?=$arItem['ID']?>").submit(function () {
                let formID = $(this).attr('id');
                let formNm = $('#' + formID);
                let formMs = $("#message-form_<?=$arItem['ID']?>");
                $.ajax({
                    type: "POST",
                    url: '/lc/doctor-save.php',
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
<?endforeach;?>
<?if(count($arResult["ITEMS"])<1){?>
    <div class="personal-cabinet-none-doctor text-center">
        В вашей клинике нет привязанных врачей
    </div>
<?}?>
    <script>
        $(document).ready(function () {
            $('.add').on('click', function () {
                var str = ' <input type="hidden" name="ID_DOCTOR" value="NEW">\n' +
                    ' <input type="hidden" name="ID_CLINIC" value="<?=$idClinic?>">\n' +
                    ' <input type="hidden" name="PHOTO" value="<?=$photoFile?>">\n' +
                    '    <div class="personal-cabinet-content__doctors-page-box-item__desc">\n' +
                    '        <div class="personal-cabinet-content__doctors-page-box-item__desc__head none-margin">\n' +
                    '            <div class="personal-cabinet-content__doctors-page-box-item__desc-left">\n' +
                    '                <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">\n' +
                    '                    <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box">\n' +
                    '                        <ul class="checkbox-group">\n' +
                    '                            <li>\n' +
                    '                                <label for="">ФИО\n' +

                    '                                </label>\n' +
                    '                                    <input type="text" name="NAME_DOCTOR" value="">\n' +
                    '                            </li>\n' +
                    '                           <li>\n' +
                    '                                <label for="">Номер телефона для привязки врача*\n' +

                    '                                </label>\n' +
                    '                                    <input type="text" name="PHONE" value="">\n' +
                    '                            </li>\n' +
                    '                            <li>\n' +
                    '                                <label for="">Фото\n' +

                    '                                </label>\n' +
                    '                                    <input type="file" id="photoFile" name="DETAIL_PICTURE" value="">\n' +
                    '                            </li>\n' +
                    '                            <li>\n' +
                    '                                <label for="">Пол\n' +

                    '                                </label>\n' +
                    '                                    <select name="GENDER" id="GENDER" value="">\n' +
                    '                                        <option value="70">Мужчина</option>\n' +
                    '                                        <option value="71">Женщина</option>\n' +
                    '                                    </select>\n' +
                    '                            </li>\n' +
                    '                        </ul>\n' +
                            '                <div class="text-view">\n' +
                            '                    <div id="message-form_NEW"></div>\n' +
                            '                    <div id="photo-form_NEW" style="display:none;"></div>\n' +
                            '                    <button type="submit" name="saveProfile" class="save">Добавить врача</button>\n' +
                            '                </div>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '            <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '    </div>';
                document.getElementById('form_doctor_NEW').innerHTML = str;
                $('.add').hide();
            });
            $(document).on('change', '#photoFile', function(){
                let file_data = $(this).prop('files')[0];
                let form_data = new FormData();
                let formPhoto= $("#photo-form_NEW");
                form_data.append('file', file_data);
                $.ajax({
                    url: '/lc/file_upload.php', // point to server-side PHP script
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(form_data){
                        $(formPhoto).html(form_data);
                        let file = $('#photo-form_NEW').text();
                        $('input[name="PHOTO"]').val(file);
                    }
                });
                return false;
            });
            $("#form_doctor_NEW").submit(function () {
                let formID = $(this).attr('id');
                let formNm = $('#' + formID);
                let formMs = $("#message-form_NEW");
                $.ajax({
                    type: "POST",
                    url: '/lc/doctor-add.php',
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