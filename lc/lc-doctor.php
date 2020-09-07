<?
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>
<?$arFilter = Array("IBLOCK_ID"=>"10", "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $idDoctor = $arFields['ID'];
}?>
<?//function propview($prop,$id,$iblock){
//    $db_enum_list = CIBlockProperty::GetPropertyEnum($prop["CODE"], Array(), Array("IBLOCK_ID"=>$iblock, "VALUE"=>"Y"));
//    if($ar_enum_list = $db_enum_list->GetNext()) ?>
<!--        <label data-role="label_--><?//=$prop["CODE"]?><!--_--><?//=$id?><!--" class="bx_filter_param_label " for="--><?//=$prop["CODE"]?><!--_--><?//=$id?><!--">-->
<!--    <span class="bx_filter_input_checkbox">-->
<!--            <input type="checkbox" --><?//if($prop["VALUE"] == 'Y'){?><!--checked--><?//}?><!-- value="--><?//=$ar_enum_list['ID']?><!--" name="--><?//=$prop["CODE"]?><!--" id="--><?//=$prop["CODE"]?><!--_--><?//=$id?><!--">-->
<!--                <div class="checkbox"><img src="--><?//= SITE_TEMPLATE_PATH ?><!--/assets/images/checkbox.svg" alt=""></div>-->
<!--            <span class="bx_filter_param_text">--><?//=$prop["NAME"]?><!--</span>-->
<!--        </span>-->
<!--    </label>-->
<!--    <input type="hidden" name="FULL_PROPERTY[]" value="--><?//=$prop["CODE"]?><!--">-->
<?//}?>
<?function propselect($prop,$iblock){?>
    <label for=""><?=$prop['NAME']?></label>
    <select name="<?=$prop['CODE']?>" id="<?=$prop['CODE']?>" value="">
        <?
        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$prop["CODE"]));
        while($enum_fields = $property_enums->GetNext())
        {?>
            <option value="<?=$enum_fields["ID"]?>" <?if($prop['VALUE']==$enum_fields["VALUE"]){?>selected<?}?>><?=$enum_fields["VALUE"]?></option>
        <? }?>
    </select>
<?}?>
<?function propselectspan($prop,$iblock){?>
    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
        <span><?=$prop['NAME']?></span>
        <select name="<?=$prop['CODE']?>" id="<?=$prop['CODE']?>" value="">
            <?
            $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$prop["CODE"]));
            while($enum_fields = $property_enums->GetNext())
            {?>
                <option value="<?=$enum_fields["ID"]?>" <?if($prop['VALUE']==$enum_fields["VALUE"]){?>selected<?}?>><?=$enum_fields["VALUE"]?></option>
            <? }?>
        </select>
    </div>
<?}?>
<?function propselectSpecSec($prop,$iblock){?>
    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
        <span><?=$prop['NAME']?></span>
        <select name="SPECIALIZATION_MAIN" id="SPECIALIZATION_MAIN" value="">
            <?
            $arSelect = array("ID", "NAME");
            $arFilter = array("IBLOCK_ID"=>$iblock);
            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext())
            {?>
                ?>
                <option value="<?=$ar_result['ID']?>" <?if($ar_result['ID']==$prop['VALUE']){?>selected<?}?>><?=$ar_result['NAME']?></option>
            <?}?>
        </select>
    </div>
<?}?>
<?function propselectSpecElm($prop,$iblock){?>
    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
        <span><?=$prop['NAME']?></span>
        <select name="SPECIALIZATION_MAIN" id="SPECIALIZATION_MAIN" value="">
            <?
            $arSelect = array("ID", "NAME");
            $arFilter = array("IBLOCK_ID"=>$iblock);
            $obSections = CIBlockElement::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext())
            {?>
                <option value="<?=$ar_result['ID']?>" <?if($ar_result['ID']==$prop['VALUE']){?>selected<?}?>><?=$ar_result['NAME']?></option>
            <?}?>
        </select>
    </div>
<?}?>
<?//function propofficial($prop){?>
<!--    <label for="">--><?//=$prop['NAME']?><!--</label>-->
<!--    <input type="text" name="--><?//=$prop['CODE']?><!--" value="--><?//=$prop['VALUE']?><!--">-->
<?//}?>
<?if($idDoctor !=NULL){?>
    <?function propview($prop){
        $db_enum_list = CIBlockProperty::GetPropertyEnum($prop["CODE"], Array(), Array("IBLOCK_ID"=>9, "VALUE"=>"Y"));
        if($ar_enum_list = $db_enum_list->GetNext()) ?>
            <li>
            <label data-role="label_<?=$prop["CODE"]?>" class="bx_filter_param_label " for="<?=$prop["CODE"]?>">
        <span class="bx_filter_input_checkbox">
                    <input type="checkbox" <?if($prop["VALUE"] == 'Y'){?>checked<?}?> value="<?=$ar_enum_list['ID']?>" name="<?=$prop["CODE"]?>" id="<?=$prop["CODE"]?>">
                        <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                    <span class="bx_filter_param_text"><?=$prop["NAME"]?></span>
                </span>
        </label>
        <input type="hidden" name="FULL_PROPERTY[]" value="<?=$prop["CODE"]?>">
        </li>
    <?}?>
    <?function propofficial($prop){?>
        <li>
            <label for=""><?=$prop['NAME']?></label>
            <input type="text" name="<?=$prop['CODE']?>" value="<?=$prop['VALUE']?>">
        </li>
    <?}?>
    <form id="form_doctor_<?=$idDoctor?>" name="form_doctor_<?=$idDoctor?>" action="" method="post" class="personal-cabinet-content__doctors-page-box-item card-item">
        <input type="hidden" name="ID_DOCTOR" value="<?=$idDoctor?>">
        <input type="hidden" name="PHOTO" value="<?=$photoFile?>">
        <div class="row">
            <div class="col-xl-1 col-lg-2 col-md-12 col-sm-12 col-12">
                <div class="personal-cabinet-content__doctors-page-box-item__img">
                    <?if($arItem['DETAIL_PICTURE']['SRC']!=NULL){?>
                        <img src="<?= $arItem['DETAIL_PICTURE']['SRC'] ?>" alt="doctor-photo" class="doctors-list-item__img-photo">
                    <?}elseif($arItem['PROPERTIES']['GENDER']['VALUE']==NULL || $arItem['PROPERTIES']['GENDER']['VALUE']=="Мужчина" ){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/icon/male.svg" alt="no-photo" class="doctors-list-item__img-none-photo">
                    <?}elseif($arItem['PROPERTIES']['GENDER']['VALUE']=="Женщина" ){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo">
                    <?}?>
                </div>
            </div>
            <div class="col-xl-11 col-lg-10 col-md-12 col-sm-12 col-12">
                <div class="personal-cabinet-content__doctors-page-box-item__desc">
                    <div class="row personal-cabinet-content__doctors-page-box-item__desc__head">
                        <div class="col-sm-10 col-12">
                            <div class="personal-cabinet-content__doctors-page-box-item__desc-left">
                                <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                                            <span class="personal-cabinet-content__doctors-page-box-item__desc__name"><span><a href="/doctors/<?=$arItem['CODE']?>/"><?=$arItem['NAME']?></a><div class="edit"></div></span>
                                                <input type="text" name="NAME_DOCTOR" value="<?=$arItem['NAME']?>" class="changedInput">
                                            </span>
                                    </div>
                                    <? /*<span class="personal-cabinet-content__doctors-page-box-item__desc__status">не работает в клинике</span>*/?>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor">
                                    <span>Редактировать данные</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-12">
                            <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                                <div class="toggle reverse_switch">
                                    <?$db_enum_list = CIBlockProperty::GetPropertyEnum($arItem['PROPERTIES']['NOT_ON']['CODE'], Array(), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "VALUE"=>"Y"));
                                    if($ar_enum_list = $db_enum_list->GetNext()) ?>
                                    <input type="checkbox"  id="normal_<?=$idDoctor?>" <?if($arItem['PROPERTIES']['NOT_ON']['VALUE']=='Y'){?>checked<?}?> name="<?=$arItem['PROPERTIES']['NOT_ON']['CODE']?>" value="<?=$ar_enum_list['ID']?>" class="swith" type="checkbox"/>
                                    <label class="toggle-item" for="normal_<?=$idDoctor?>"></label>
                                    <input type="hidden" name="FULL_PROPERTY[]" value="<?=$arItem['PROPERTIES']['NOT_ON']['CODE']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop">
                                <ul>
                                    <li class="active" data-tabs="0">Основное</li>
                                    <li data-tabs="1">О враче</li>
                                    <li data-tabs="2">Профиль лечения</li>
                                    <li data-tabs="3">Опыт работы</li>
                                    <li data-tabs="4">Образование</li>
                                    <li data-tabs="5">График</li>
                                </ul>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content main-block active" data-tabs="0">
                                    <?propselectSpecSec($arItem['PROPERTIES']['SPECIALIZATION_MAIN'],11)?>
                                    <?propselectSpecSec($arItem['PROPERTIES']['SPECIALIZATION_DOP'],11)?>
                                    <?propselectspan($arItem['PROPERTIES']['RANK'],$arParams['IBLOCK_ID'])?>
                                    <?propselectspan($arItem['PROPERTIES']['SCIENCE_DEGREE'],$arParams['IBLOCK_ID'])?>
                                    <?propselectspan($arItem['PROPERTIES']['CATEGORY'],$arParams['IBLOCK_ID'])?>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="1">
                                    <div class="row personal-cabinet-content-item">
                                        <div class="col-lg-12 no-padding">
                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                <span>Фото</span>
                                                <input type="file" class="photoFile" name="DETAIL_PICTURE" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 no-padding">
                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                <span>О враче</span>
                                                <textarea name="PREVIEW_TEXT"><?=$arItem['PREVIEW_TEXT']?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 no-padding">
                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                <span>Описание специализации</span>
                                                <textarea name="DETAIL_TEXT"><?=$arItem['DETAIL_TEXT']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <span class="time-block-span"><?=$arItem['PROPERTIES']['SPECIALIZATIONS']['NAME']?></span>
                                            <ul class="link-checkbox">
                                                <?$arFilter = Array("IBLOCK_ID"=>"11","ACTIVE"=>"Y");
                                                $arSelect = Array("NAME","CODE","ID");
                                                $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
                                                while($ob = $res->GetNextElement()){
                                                    $arFields = $ob->GetFields(); ?>
                                                    <li>
                                                        <input type="checkbox" <?if(in_array($arFields['ID'],$arItem['PROPERTIES']['SPECIALIZATIONS']['VALUE'])){?>checked<?}?> value="<?=$arFields['ID']?>" name="<?=$arItem['PROPERTIES']['SPECIALIZATIONS']['CODE']?>[]" id="<?=$arFields['ID']?>_<?=$idDoctor?>">
                                                        <label data-role="label_<?=$arFields['ID']?>_<?=$idDoctor?>" class="bx_filter_param_label" for="<?=$arFields['ID']?>_<?=$idDoctor?>">
                                                        <span class="bx_filter_input_checkbox">
                                                            <span class="bx_filter_param_text"><?=$arFields["NAME"]?></span>
                                                        </span>
                                                        </label>
                                                    </li>
                                                <?}?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="3">
                                    <div class="row place-education-block">
                                        <div class="col-lg-12 no-padding">
                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                <span><?=$arItem['PROPERTIES']['STANDING']['NAME']?></span>
                                                <input type="text" name="<?=$arItem['PROPERTIES']['STANDING']['CODE']?>" value="<?=$arItem['PROPERTIES']['STANDING']['VALUE']?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 no-padding">
                                            <?
                                            foreach ($arItem['PROPERTIES']['EXPERIENCE']['VALUE'] as $plaсe) {
                                                $work_plaсe[] = array('PERIOD' => explode("/", $plaсe)[0], 'PLAСE' => explode("/", $plaсe)[1]);
                                            }?>
                                            <?foreach ($work_plaсe as $key => $str){?>
                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                    <span>Период</span>
                                                    <input type="text" class="place-education-block_period" name="EXPERIENCE_<?=$key?>[]" value="<?=$str['PERIOD']?>">
                                                    <span>Место работы</span>
                                                    <input type="text" class="place-education-block_place" name="EXPERIENCE_<?=$key?>[]" value="<?=$str['PLAСE']?>">
                                                </div>
                                                <?
                                                $place_key = $key+1;
                                            }
                                            if($arItem['PROPERTIES']['EXPERIENCE']['VALUE']!=NULL){
                                                $place_key_last = 0 + $place_key;
                                            }else{
                                                $place_key_last = 1;
                                            }?>
                                            <div id="input_work<?=$idDoctor?><?=$place_key_last?>"></div>
                                            <div class="add-place" value="<?=$idDoctor?><?=$place_key_last?>" title="Добавить место работы">+</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="4">
                                    <div class="row place-education-block">
                                        <div class="col-lg-12 no-padding">
                                            <?foreach ($arItem['PROPERTIES']['EDUCATION']['VALUE'] as $education) {
                                                $education_plaсe[] = array('PERIOD' => explode("/", $education)[0], 'PLAСE' => explode("/", $education)[1]);
                                            }?>
                                            <?foreach ($education_plaсe as $key => $str){?>
                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                    <span>Период</span>
                                                    <input type="text" class="place-education-block_period" name="EDUCATION_<?=$key?>[]" value="<?=$str['PERIOD']?>">
                                                    <span>Место учебы</span>
                                                    <input type="text" class="place-education-block_place" name="EDUCATION_<?=$key?>[]" value="<?=$str['PLAСE']?>">
                                                </div>
                                                <?
                                                $education_key = $key+1;
                                            }
                                            $education_key_last = 0 + $education_key;?>
                                            <div id="input_education<?=$idDoctor?><?=$education_key_last?>"></div>
                                            <div class="add-education" value="<?=$idDoctor?><?=$education_key_last?>" title="Добавить место учебы">+</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <span class="time-block-span"><?=$arItem['PROPERTIES']['DAY_RECEPTION']['NAME']?></span>
                                            <ul class="link-checkbox">
                                                <?
                                                $db_enum_list = CIBlockProperty::GetPropertyEnum("DAY_RECEPTION", Array('SORT'=>'ASC'), Array("IBLOCK_ID"=>10));
                                                while($ar_enum_list = $db_enum_list->GetNext()) {?>
                                                    <li>
                                                        <input type="checkbox" <?if(in_array($ar_enum_list['VALUE'],$arItem['PROPERTIES']['DAY_RECEPTION']['VALUE'])){?>checked<?}?> value="<?=$ar_enum_list['ID']?>" name="<?=$arItem['PROPERTIES']['DAY_RECEPTION']['CODE']?>[]" id="<?=$ar_enum_list['PROPERTY_ID']?>_<?=$ar_enum_list['ID']?>_<?=$idDoctor?>">
                                                        <label data-role="label_<?=$ar_enum_list['PROPERTY_ID']?>_<?=$ar_enum_list['ID']?>_<?=$idDoctor?>" class="bx_filter_param_label" for="<?=$ar_enum_list['PROPERTY_ID']?>_<?=$ar_enum_list['ID']?>_<?=$idDoctor?>">
                                                                <span class="bx_filter_input_checkbox">
                                                                    <span class="bx_filter_param_text"><?=$ar_enum_list["VALUE"]?></span>
                                                                </span>
                                                        </label>
                                                    </li>
                                                <?}?>
                                            </ul>
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="time-block-span"><?=$arItem['PROPERTIES']['RECEPTION_SCHEDULE']['NAME']?></span>
                                            <ul class="checkbox-group time-group">
                                                <?foreach ($arItem['PROPERTIES']['RECEPTION_SCHEDULE']['VALUE'] as $key => $contact){?>
                                                    <li>
                                                        <input type="text" name="<?=$arItem['PROPERTIES']['RECEPTION_SCHEDULE']['CODE']?>[]" value="<?=$contact?>">
                                                    </li>
                                                    <?
                                                    $contact_key = $key+1;
                                                }
                                                $contact_key_last = 0 + $contact_key;?>
                                                <ul id="input<?=$idDoctor?><?=$contact_key_last?>"></ul>
                                            </ul>
                                            <div class="add-time" value="<?=$idDoctor?><?=$contact_key_last?>" title="Добавить время">+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box">
                                <ul class="checkbox-group">
                                    <li><?propselect($arItem['PROPERTIES']['GENDER'],$arParams['IBLOCK_ID'])?></li>
                                    <li><?propofficial($arItem['PROPERTIES']['AGE_PACIENT'])?></li>
                                    <li><?propview($arItem['PROPERTIES']['CHILDREN_DOCTOR'],$idDoctor,$arParams['IBLOCK_ID'])?></li>
                                    <li><?propview($arItem['PROPERTIES']['DEPARTURE_HOUSE'],$idDoctor,$arParams['IBLOCK_ID'])?></li>
                                    <li><?propview($arItem['PROPERTIES']['ONLINE'],$idDoctor,$arParams['IBLOCK_ID'])?></li>
                                    <li><?propview($arItem['PROPERTIES']['UMC'],$idDoctor,$arParams['IBLOCK_ID'])?></li>
                                    <li><?propview($arItem['PROPERTIES']['DMC'],$idDoctor,$arParams['IBLOCK_ID'])?></li>
                                    <li><?propview($arItem['PROPERTIES']['DIAGNOSTICS'],$idDoctor,$arParams['IBLOCK_ID'])?></li>
                                </ul>
                                <div class="text-view">
                                    <div id="message-form_<?=$idDoctor?>"></div>
                                    <div id="photo-form_<?=$idDoctor?>" style="display:none;"></div>
                                    <span class="save delete-doctor" id="delete_<?=$idDoctor?>">Отвязать врача от клиники</span>
                                    <button type="submit" name="saveProfile" class="save">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?}else{?>
    <?include 'none-cabinet.php';?>
<?}?>