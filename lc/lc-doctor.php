<?
$week = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенье');
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>

<?$arFilter = Array("IBLOCK_ID"=>"10", "PROPERTY_TECH_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $idDoctor = $arFields['ID'];
    $IBLOCK_ID = $arFields['IBLOCK_ID'];
}?>
<?function propview($prop,$id,$iblock){
    $db_enum_list = CIBlockProperty::GetPropertyEnum($prop["CODE"], Array(), Array("IBLOCK_ID"=>$iblock, "VALUE"=>"Y"));
    if($ar_enum_list = $db_enum_list->GetNext()) ?>
        <label data-role="label_<?=$prop["CODE"]?>_<?=$id?>" class="bx_filter_param_label " for="<?=$prop["CODE"]?>_<?=$id?>">
    <span class="bx_filter_input_checkbox">
            <input type="checkbox" <?if($prop["VALUE"] == 'Y'){?>checked<?}?> value="<?=$ar_enum_list['ID']?>" name="<?=$prop["CODE"]?>" id="<?=$prop["CODE"]?>_<?=$id?>">
                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
            <span class="bx_filter_param_text"><?=$prop["NAME"]?></span>
        </span>
    </label>
    <input type="hidden" name="FULL_PROPERTY[]" value="<?=$prop["CODE"]?>">
<?}?>
<?function propselect($prop,$iblock){?>
    <label for=""><?=$prop['NAME']?></label>
<?}?>
<?function propselectspan($prop,$iblock){?>
    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
        <span><?=$prop['NAME']?></span>
        <select name="<?=$prop['CODE']?>" id="<?=$prop['CODE']?>" value="">
            <?
            $property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$prop["CODE"]));
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
        <select name="<?=$prop['CODE']?>" id="<?=$prop['CODE']?>" value="">

            <?
            $arSelect = array("ID", "NAME");
            $arFilter = array("IBLOCK_ID"=>$iblock);
            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext())
            {?>
                <option value="<?=$ar_result['ID']?>" <?if($ar_result['ID']==$prop['VALUE']){?>selected<?}?>><?=$ar_result['NAME']?></option>
            <?}?>
            <option value="<?=$ar_result['ID']?>" <?if($ar_result['ID']==$prop['VALUE']){?>selected<?}?>>-</option>
        </select>
    </div>
<?}?>
<?function propofficial($prop){?>
    <label for=""><?=$prop['NAME']?></label>
    <input type="text" name="<?=$prop['CODE']?>" value="<?=$prop['VALUE']?>">
<?}?>
<?function propofficialspan($prop){?>
    <span><?=$prop['NAME']?></span>
    <input type="text" name="<?=$prop['CODE']?>" value="<?=$prop['VALUE']?>">
<?}?>
<?if($idDoctor !=NULL){?>
    <div class="personal-cabinet-content__doctors-page">
        <div class="personal-cabinet-content__doctors-page-box">
            <form id="form_doctor_<?=$idDoctor?>" name="form_doctor_<?=$idDoctor?>" action="" method="post" class="personal-cabinet-content__doctors-page-box-item card-item doctor-lc">
                <input type="hidden" name="ID_DOCTOR" value="<?=$idDoctor?>">
                <input type="hidden" name="PHOTO" value="<?=$photoFile?>">
                <div class="row">
                    <div style="padding-left: 15px;" class="">
                        <?if($arFields['DETAIL_PICTURE']!=NULL){?>
                        <?
                        $file = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        ?>
                        <div style="background-image: url('<?= $file['src'] ?>')" class="personal-cabinet-content__doctors-page-box-item__img photo-back-image">
                            <?}elseif($arProps['GENDER']['VALUE']==NULL || $arProps['GENDER']['VALUE']=="Мужчина" ){?>
                            <div style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/male.svg')" class="personal-cabinet-content__doctors-page-box-item__img photo-back-image-contain">
                                <?}elseif($arProps['GENDER']['VALUE']=="Женщина" ){?>
                                <div style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/female.svg')" class="personal-cabinet-content__doctors-page-box-item__img photo-back-image-contain">
                                    <?}?>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="personal-cabinet-content__doctors-page-box-item__desc">
                                    <div class="row personal-cabinet-content__doctors-page-box-item__desc__head">
                                        <div class="col-sm-10 col-12">
                                            <div class="personal-cabinet-content__doctors-page-box-item__desc-left">
                                                <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                                                    <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                                            <span class="personal-cabinet-content__doctors-page-box-item__desc__name">
                                                <a href="/doctors/<?=$arFields['CODE']?>/"><?=$arFields['NAME']?></a>
                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-12">
                                            <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                                                <div class="toggle reverse_switch">
                                                    <?$db_enum_list = CIBlockProperty::GetPropertyEnum($arProps['NOT_ON']['CODE'], Array(), Array("IBLOCK_ID"=>$IBLOCK_ID, "VALUE"=>"Y"));
                                                    if($ar_enum_list = $db_enum_list->GetNext()) ?>
                                                    <input type="checkbox"  id="normal_<?=$idDoctor?>" <?if($arProps['NOT_ON']['VALUE']=='Y'){?>checked<?}?> name="<?=$arProps['NOT_ON']['CODE']?>" value="<?=$ar_enum_list['ID']?>" class="swith" type="checkbox"/>
                                                    <label class="toggle-item" for="normal_<?=$idDoctor?>"></label>
                                                    <input type="hidden" name="FULL_PROPERTY[]" value="<?=$arProps['NOT_ON']['CODE']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop personal-cabinet-content__doctors-page-box-item__desc__redactor__active">
                                                <ul>
                                                    <li data-tabs="0" class="active">Личные данные</li>
                                                    <li data-tabs="1">Основное</li>
                                                    <li data-tabs="4">Образование</li>
                                                    <li data-tabs="3">Опыт работы</li>
                                                    <li data-tabs="2">Профиль лечения</li>
                                                    <li data-tabs="5">График</li>
                                                    <li data-tabs="6">Клиники</li>
                                                    <li data-tabs="7">Адреса</li>
                                                </ul>
                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content active" data-tabs="0">
                                                    <div class="row personal-cabinet-content-item">
                                                        <div class="col-lg-12">
                                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                <span>Фото</span>
                                                                <label class="photoFile-label">Добавить<input type="file" class="photoFile" name="DETAIL_PICTURE" value=""></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                <span>ФИО</span>
                                                                <textarea name="NAME_DOCTOR"><?=$arFields['NAME']?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <?propselectspan($arProps['GENDER'],$IBLOCK_ID)?>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                <span>О враче</span>
                                                                <textarea name="PREVIEW_TEXT"><?=$arFields['PREVIEW_TEXT']?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                <?propofficialspan($arProps['PHONE'],$idDoctor,$IBLOCK_ID)?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                <?propofficialspan($arProps['PRICE'],$idDoctor,$IBLOCK_ID)?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content main-block " data-tabs="1">
                                                    <?propselectSpecSec($arProps['SPECIALIZATION_MAIN'],11)?>
                                                    <?propselectSpecSec($arProps['SPECIALIZATION_DOP'],11)?>
                                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                        <span>Описание специализации</span>
                                                        <textarea name="DETAIL_TEXT"><?=$arFields['DETAIL_TEXT']?></textarea>
                                                    </div>
                                                    <?propselectspan($arProps['RANK'],$IBLOCK_ID)?>
                                                    <?propselectspan($arProps['SCIENCE_DEGREE'],$IBLOCK_ID)?>
                                                    <?propselectspan($arProps['CATEGORY'],$IBLOCK_ID)?>
                                                </div>
                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="2">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <span class="time-block-span"><?=$arProps['SPECIALIZATIONS']['NAME']?></span>
                                                            <ul class="link-checkbox">
                                                                <?$arFilter = Array("IBLOCK_ID"=>"11","ACTIVE"=>"Y");
                                                                $arSelect = Array("NAME","CODE","ID");
                                                                $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
                                                                while($ob = $res->GetNextElement()){
                                                                    $arFields = $ob->GetFields(); ?>
                                                                    <li>
                                                                        <input type="checkbox" <?if(in_array($arFields['ID'],$arProps['SPECIALIZATIONS']['VALUE'])){?>checked<?}?> value="<?=$arFields['ID']?>/<?=$arFields['NAME']?>" name="<?=$arProps['SPECIALIZATIONS']['CODE']?>[]" id="<?=$arFields['ID']?>_<?=$idDoctor?>">
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
                                                        <div class="col-lg-12">
                                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                <span><?=$arProps['STANDING']['NAME']?></span>
                                                                <input type="text" name="<?=$arProps['STANDING']['CODE']?>" value="<?=$arProps['STANDING']['VALUE']?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <?
                                                            foreach ($arProps['EXPERIENCE']['VALUE'] as $plaсe) {
                                                                $work_plaсe[] = array('PERIOD' => explode("/", $plaсe)[0], 'PLAСE' => explode("/", $plaсe)[1]);
                                                            }?>
                                                            <?foreach ($work_plaсe as $key => $str){?>
                                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                    <span>Период</span>
                                                                    <input type="text" class="place-education-block_period" name="EXPERIENCE_<?=$key?>[]" value="<?=$str['PERIOD']?>">
                                                                    <span class="place-work">Место работы</span>
                                                                    <input type="text" class="place-education-block_place" name="EXPERIENCE_<?=$key?>[]" value="<?=$str['PLAСE']?>">
                                                                </div>
                                                                <?
                                                                $place_key = $key+1;
                                                            }
                                                            if($arProps['EXPERIENCE']['VALUE']!=NULL){
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
                                                        <div class="col-lg-12">
                                                            <?foreach ($arProps['EDUCATION']['VALUE'] as $education) {
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
                                                    <div class="row place-education-block place-schedule-block">
                                                        <div class="col-lg-12">
                                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                <?propofficialspan($arProps['PERIOD'],$idDoctor,$IBLOCK_ID)?>
                                                            </div>
                                                        </div>
                                                        <?foreach ($arProps['RECEPTION_SCHEDULE']['VALUE'] as $key => $contacts){
                                                            $contacts_array = explode('/',$contacts);
                                                            if($contacts_array[2] == $idDoctor){?>
                                                                <div class="col-lg-12">
                                                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                        <select class="place-education-block_place"  name="RECEPTION_SCHEDULE_<?=$key?>[]">
                                                                            <?foreach($week as $item){?>
                                                                                <option <?if($item==$contacts_array[0]){?>selected<?}?> value="<?=$item?>"><?=$item?></option>
                                                                            <?}?>
                                                                        </select>
                                                                        <input class="lc-doctor-time" type="text" name="RECEPTION_SCHEDULE_<?=$key?>[]" value="<?=$contacts_array[1]?>">
                                                                    </div>
                                                                </div>
                                                                <?
                                                            }else{?>
                                                                <input type="hidden" name="RECEPTION_SCHEDULE_<?=$key?>[]" value="<?=$contacts?>">
                                                            <?}
                                                            $contact_key = $key+1;
                                                        }
                                                        $contact_key_last = 0 + $contact_key;?>
                                                        <div class="col-lg-12" id="input<?=$idDoctor?><?=$contact_key_last?>"></div>
                                                    </div>
                                                    <div class="add-time" value="<?=$idDoctor?><?=$contact_key_last?>" title="Добавить время">+</div>
                                                </div>
                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="6">
                                                    <div class="row">
                                                        <div class="col-lg-12 list-clinics-cabinet-doctor">
                                                            <?if($arProps['CLINIK']['VALUE'][0]!=NULL){?>
                                                                <h5>Вы привязаны к клиникам:</h5>
                                                                <ul class="checkbox-group">
                                                                    <?foreach ($arProps['CLINIK']['VALUE'] as $key => $clinic){
                                                                        $res = CIBlockElement::GetByID($clinic);
                                                                        if($ar_res = $res->GetNext())?>
                                                                            <li>
                                                                            <label class="clinics-cabinet-doctor clinics-cabinet-doctor_<?=$clinic?>" for="<?=$arProps['CLINIK']['CODE']?>"><?=$ar_res['NAME']?>
                                                                        <input type="text" id="<?=$clinic?>" title='<?=$ar_res['NAME'];?>' name='<?=$arProps['CLINIK']['CODE']?>[]' value="<?=$clinic?>">
                                                                        <div class="del close" data-val="<?=$clinic?>" title="Отвязаться от клиники"></div></label>                                                                </li>
                                                                    <?}?>
                                                                </ul>
                                                            <?}else{?>
                                                                <p>Вас не привязала не одна клиника</p>
                                                            <?}?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="7">
                                                    <div class="row place-education-block">
                                                        <div class="col-lg-12">
                                                            <?foreach ($arProps['RECEPTION_ADDRESSES']['VALUE'] as $key => $address){?>
                                                                <?$str = explode('/',$address);
                                                                $city = $str[0];
                                                                $addr = $str[1];
                                                                $area = $str[2];
                                                                ?>
                                                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                                                    <div class="del-city close" data-val="<?=$key?>" title="Удалить адрес"></div>
                                                                    <div id="city_<?=$key?>">
                                                                        <span><?=$arProps['CITY']['NAME']?></span>
                                                                        <select name="ADDRESSES_<?=$key?>[]" class="citys" data-key="<?=$key?>" value="">
                                                                            <?
                                                                            $arSelect = array("ID", "NAME");
                                                                            $arFilter = array("IBLOCK_ID"=>14, 'DEPTH_LEVEL' => 1);
                                                                            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                                                                            while($ar_result = $obSections->GetNext())
                                                                            {
                                                                                if($ar_result['NAME']==$city){
                                                                                    $selectCity = $ar_result['ID'];
                                                                                    $selectCityArray[$ar_result['NAME']] = $ar_result['ID'];
                                                                                }
                                                                                ?>
                                                                                <option value="<?=$ar_result['ID']?>/<?=$ar_result['NAME']?>" <?if($ar_result['NAME']==$city){?>selected<?}?>><?=$ar_result['NAME']?></option>
                                                                            <?}?>
                                                                        </select>
                                                                        <span class="doctor-adress">Адрес</span>
                                                                        <input type="text" class="input-doctor-address" id="address_<?=$key?>" name="ADDRESSES_<?=$key?>[]" value="<?=$addr?>">
                                                                        <div id="area-block-ajax-<?=$key?>">
                                                                            <?
                                                                            $areaCount =  CIBlockSection::GetCount(array("IBLOCK_ID"=>14, "SECTION_ID"=>$selectCity));
                                                                            if($areaCount>0):?>
                                                                                <span>Район</span>
                                                                                <select name="ADDRESSES_<?=$key?>[]" class="area">
                                                                                    <?
                                                                                    $arSelect = array("ID", "NAME");
                                                                                    $arFilter = array("IBLOCK_ID"=>14, 'SECTION_ID' => $selectCity);
                                                                                    $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                                                                                    while($ar_result = $obSections->GetNext())
                                                                                    {
                                                                                        $AreaId = $arProps['AREA']['VALUE'];
                                                                                        ?>
                                                                                        <option value="<?=$ar_result['ID']?>/<?=$ar_result['NAME']?>" <?if($ar_result['NAME']==$area){?>selected<?}?>><?=$ar_result['NAME']?></option>
                                                                                    <?}?>
                                                                                </select>
                                                                            <?endif;?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?
                                                                $address_key = $key+1;
                                                            }
                                                            $address_key_last = 0 + $address_key;?>
                                                            <div id="input_address<?=$idDoctor?><?=$address_key_last?>"></div>
                                                            <div class="add-address" value="<?=$idDoctor?><?=$address_key_last?>" title="Добавить адрес">+</div>
                                                        </div>
                                                        <?
                                                        $metroInCity = 0;
                                                        foreach ($selectCityArray as $city){
                                                            $metroInCity = $metroInCity +  CIBlockSection::GetSectionElementsCount($city, Array("CNT_ACTIVE"=>"Y"));
                                                        }?>
                                                        <div class="<?if($metroInCity>0){?>col-lg-6<?}else{?>col-lg-12<?}?>">
                                                                <label for="">Ваши координаты на карте:</label>
                                                                <div id="map" style="width: 100%; height: 300px"></div>
                                                            <? propofficial($arProps['MAP']);?>
                                                        </div>
                                                        <?if($metroInCity>0):?>
                                                            <div class="col-lg-6 metro-block">
                                                                <label for=""><?=$arProps['METRO']['NAME']?>(обновляется, после сохранения и обновления страницы):</label>
                                                                <div class="metro-container">
                                                                        <? function metroDoctor($iblock,$sectionId,$arProps){?>
                                                                            <ul class="checkbox-group">
                                                                                <?$arSelect = array("ID", "NAME");
                                                                                $arFilter = array("IBLOCK_ID"=>$iblock, 'SECTION_ID'=> $sectionId, 'INCLUDE_SUBSECTIONS' => 'Y');
                                                                                $res = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilter,false, false, $arSelect);
                                                                                while($ob = $res->GetNextElement()){
                                                                                    $arField = $ob->GetFields();
                                                                                    ?>
                                                                                    <li>
                                                                                        <label data-role="label_<?=$arField['ID']?>" class="bx_filter_param_label " for="<?=$arField['ID']?>">
                                                                                        <span class="bx_filter_input_checkbox">
                                                                                            <input type="checkbox" <?if(in_array($arField['ID'],$arProps['METRO']['VALUE'])){?>checked<?}?> value="<?=$arField['ID']?>" name="<?=$arProps['METRO']['CODE']?>_<?=$arField['ID']?>" id="<?=$arField['ID']?>">
                                                                                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                                                                            <span class="bx_filter_param_text"><?=$arField["NAME"]?></span>
                                                                                        </span>
                                                                                        </label>
                                                                                    </li>
                                                                                <?}?>
                                                                            </ul>
                                                                        <?}?>
                                                                        <? foreach ($selectCityArray as $key => $city){?>
                                                                            <div class="metro-city-select-block">
                                                                                <label for=""><?=$key?>:</label>
                                                                                <? metroDoctor(14,$city,$arProps);?>
                                                                            </div>
                                                                        <?}?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        <?endif;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box">
                                                <ul class="checkbox-group">
                                                    <li><?propofficial($arProps['AGE_PACIENT'],$idDoctor,$IBLOCK_ID)?></li>
                                                    <li><?propview($arProps['CHILDREN_DOCTOR'],$idDoctor,$IBLOCK_ID)?></li>
                                                    <li><?propview($arProps['DEPARTURE_HOUSE'],$idDoctor,$IBLOCK_ID)?></li>
                                                    <li><?propview($arProps['ONLINE'],$idDoctor,$IBLOCK_ID)?></li>
                                                    <li><?propview($arProps['UMC'],$idDoctor,$IBLOCK_ID)?></li>
                                                    <li><?propview($arProps['DMC'],$idDoctor,$IBLOCK_ID)?></li>
                                                    <li><?propview($arProps['DIAGNOSTICS'],$idDoctor,$IBLOCK_ID)?></li>
                                                </ul>
                                                <div class="text-view">
                                                    <div id="message-form_<?=$idDoctor?>"></div>
                                                    <div id="photo-form_<?=$idDoctor?>" style="display:none;"></div>
                                                    <button type="submit" name="saveProfile" class="save">Сохранить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            function citys(){
                $(".citys").change(function () {
                    let id = $(this).val().split('/')[0];
                    let key = $(this).data('key');
                    let area = $('#area-block-ajax-'+ key);
                    $.ajax({
                        type: "POST",
                        url: '/ajax/ajax_area_doctor.php',
                        data: id,
                        success: function (data) {
                            // Вывод текста результата отправки
                            $(area).html(data);
                        }
                    });
                    return false;
                });
            }
            citys();
            if($('.personal-cabinet-content__doctors-page-box-item').hasClass('doctor-lc')) {
                $('.personal-cabinet-menu__manager.mobile-display').css({display : 'none'});
            }
            $("#form_doctor_<?=$idDoctor?>").submit(function () {
                let formID = $(this).attr('id');
                let formNm = $('#' + formID);
                let formMs = $("#message-form_<?=$idDoctor?>");
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
            $(document).on('change', '.photoFile', function(){
                let file_data = $(this).prop('files')[0];
                let form_data = new FormData();
                let formPhoto= $("#photo-form_<?=$idDoctor?>");
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
                        let file = $("#photo-form_<?=$idDoctor?>").text();
                        $('input[name="PHOTO"]').val(file);
                    }
                });
                return false;
            });
            let id = <?=$idDoctor?>;
            let x = <?=$contact_key_last?>;
            $('.add-time').on('click', function () {
                let str = '<div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row"><select class="place-education-block_place" name="RECEPTION_SCHEDULE_' + (x + 1) + '[]"><?foreach($week as $item){?><option value="<?=$item?>"><?=$item?></option><?}?></select> <input class="lc-doctor-time" type="text" name="RECEPTION_SCHEDULE_' + (x + 1) + '[]" value="<?=$contacts_array[1]?>"> </div><div class="col-lg-12 " id="input' + id + (x + 1) + '"></div>';
                document.getElementById('input' + id + x).innerHTML = str;
                x++;
            });
            let y = <?=$place_key_last?>;
            $('.add-place').on('click', function () {
                if (y < 10) {
                    let str = '<div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row"><span>Период</span> <input type="text" class="place-education-block_period" name="EXPERIENCE_' + (y + 1) + '[]"> <span class="place-work">Место работы</span><input type="text" class="place-education-block_place" name="EXPERIENCE_' + (y + 1) + '[]"></div><div id="input_work' + id + (y + 1) + '"></div>';
                    document.getElementById('input_work'+ id + y).innerHTML = str;
                    y++;
                }else{
                    $('.add-place').hide();
                }
            });
            let z = <?=$education_key_last?>;
            $('.add-education').on('click', function () {
                if (z < 10) {
                    let str = '<div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row"><span>Период</span> <input type="text" class="place-education-block_period" name="EDUCATION_' + (z + 1) + '[]"> <span>Место учебы</span><input type="text" class="place-education-block_place" name="EDUCATION_' + (z + 1) + '[]"></div><div id="input_education' + id + (z + 1) + '"></div>';
                    document.getElementById('input_education' + id + z).innerHTML = str;
                    z++;
                }else{
                    $('.add-education').hide();
                }
            });
            let w = <?=$address_key_last?>;
            $('.add-address').on('click', function () {
                if (w < 10) {
                    let str = '<div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row"><span>Город</span><select name="ADDRESSES_' + (w + 1) + '[]" class="citys" data-key="' + (w + 1) + '" value=""><?$arSelect = array("ID", "NAME");$arFilter = array("IBLOCK_ID"=>14, 'DEPTH_LEVEL' => 1);$obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);while($ar_result = $obSections->GetNext()){?><option value="<?=$ar_result['ID']?>/<?=$ar_result['NAME']?>"><?=$ar_result['NAME']?></option><?}?></select><span class="doctor-adress">Адрес</span><input type="text" class="place-education-block_place" name="ADDRESSES_' + (w + 1) + '[]"><div id="area-block-ajax-' + (w + 1) + '"></div></div><div id="input_address' + id + (w + 1) + '"></div>';
                    document.getElementById('input_address' + id + w).innerHTML = str;
                    w++;
                }else{
                    $('.add-address').hide();
                }
                citys();
            });
            $('.del').on('click', function () {
                let del = $(this).data('val');
                $('.clinics-cabinet-doctor_'+ del).css('text-decoration','line-through');
                $('#'+ del).val('');
            });
            $('.del-city').on('click', function () {
                let del = $(this).data('val');
                $('#city_'+ del).css('text-decoration','line-through');
                $('#address_'+ del).val('');
            });
            ymaps.ready(init);

            function init() {
                var myMap = new ymaps.Map('map', {
                    center: [<?=$arProps["MAP"]['VALUE']?>],
                    zoom: 12,
                    hintContent: '<?=$arFields['NAME']?>'
                }, {
                    searchControlProvider: 'yandex#search',
                });
                var myPlacemark = new ymaps.Placemark([<?=$arProps["MAP"]['VALUE']?>], {
                    hintContent: 'Содержимое всплывающей подсказки',
                    balloonContent: 'Содержимое балуна'
                });
                myMap.geoObjects.add(myPlacemark);
                // Слушаем клик на карте.
                myMap.events.add('click', function (e) {
                    var coords = e.get('coords');
                    console.log(coords);
                    $('input[name="MAP"]').val(coords);
                    // Если метка уже создана – просто передвигаем ее.
                    if (myPlacemark) {
                        myPlacemark.geometry.setCoordinates(coords);
                    }
                    // Если нет – создаем.
                    else {
                        myPlacemark = createPlacemark(coords);
                        myMap.geoObjects.add(myPlacemark);
                        // Слушаем событие окончания перетаскивания на метке.
                        myPlacemark.events.add('dragend', function () {
                            getAddress(myPlacemark.geometry.getCoordinates());
                        });
                    }
                    getAddress(coords);
                });

                // Создание метки.
                function createPlacemark(coords) {
                    return new ymaps.Placemark(coords, {
                        iconCaption: 'поиск...'
                    }, {
                        preset: 'islands#violetDotIconWithCaption',
                        draggable: true
                    });
                }

                // Определяем адрес по координатам (обратное геокодирование).
                function getAddress(coords) {
                    myPlacemark.properties.set('iconCaption', 'поиск...');
                    ymaps.geocode(coords).then(function (res) {
                        var firstGeoObject = res.geoObjects.get(0);

                        myPlacemark.properties
                            .set({
                                // Формируем строку с данными об объекте.
                                iconCaption: [
                                    // Название населенного пункта или вышестоящее административно-территориальное образование.
                                    firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                    // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                    firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                                ].filter(Boolean).join(', '),
                                // В качестве контента балуна задаем строку с адресом объекта.
                                balloonContent: firstGeoObject.getAddressLine()
                            });
                    });
                }
            }
        });
    </script>
<?}else{?>
    <?include 'none-cabinet.php';?>
<?}?>