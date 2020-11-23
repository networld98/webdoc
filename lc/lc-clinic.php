<?
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>
<?$arFilter = Array("IBLOCK_ID"=>"9", "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $idClinic = $arFields['ID'];
}?>
<?if($idClinic !=NULL){?>
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
<form id="form_clinic" name="form_clinic" action="" method="post">
    <div class="personal-cabinet-content__my-profile">
        <h2 class="title-h2"><?$APPLICATION->ShowTitle()?></h2>
        <div class="personal-cabinet-content__my-profile__info">
            <div class="personal-cabinet-content__my-profile__info-form">
                <input type="hidden" name="ID_CLINIC" value="<?=$idClinic?>">
                <input type="hidden" name="LOGO" value="<?=$photoFile?>">
                <ul>
                    <li class="uploadPhoto">
                        <?$file = CFile::ResizeImageGet($arProps['LOGO']['VALUE'], array('width'=>84, 'height'=>84), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                        <label>
                            <?if($arProps['LOGO']['VALUE']){?>
                            <img class="logo-clinic-in-cabinet" src="<?=$file['src']?>" alt="logo_clinic">
                            <?}else{?>
                                Размер лого<br>153*153px
                            <?}?>
                        </label>
                        <label class="photoFile-label">Загрузить новое лого<input type="file" class="photoFile" name="DETAIL_PICTURE" value=""></label>
                        <span id="uploadPhoto" style="color:green"></span>
                    </li>
                    <li>
                        <label for="">Логин</label>
                        <p><?=$arUser['EMAIL']?> или <?=$arUser['LOGIN']?></p>
                    </li>
                    <li>
                        <label for="">Пароль</label>
                        <div class="change-password"><span>Изменение пароля</span></div>
                    </li>
                    <li class="change-password-flex">
                        <label for=""></label>
                        <div class="change-password-block">
                            <?$APPLICATION->IncludeComponent("bitrix:main.profile", ".default", Array(
                                "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                            ),
                                false
                            );?>
                        </div>
                    </li>
                    <? propofficial($arProps['YEAR_FONDATION']);?>
                    <? propofficial($arProps['DIRECTOR']);?>
                    <? propofficial($arProps['SITE']);?>
                    <? propofficial($arProps['OFFICIAL_NAME']);?>
                    <li>
                        <label for=""><?=$arProps['CITY']['NAME']?></label>
                        <select name="CITY" id="city" value="">
                            <?
                            $arSelect = array("ID", "NAME");
                            $arFilter = array("IBLOCK_ID"=>14);
                            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                            while($ar_result = $obSections->GetNext())
                            {
                                $cityId = $arProps['CITY']['VALUE']?>
                                <option value="<?=$ar_result['ID']?>" <?if($ar_result['ID']==$arProps['CITY']['VALUE']){?>selected<?}?>><?=$ar_result['NAME']?></option>
                            <?}?>
                        </select>
                    </li>
                    <li id="metro-block-ajax">
                        <?
                        $metroInCity = CIBlockSection::GetSectionElementsCount($cityId, Array("CNT_ACTIVE"=>"Y"));
                        if($metroInCity>0):?>
                            <label for=""><?=$arProps['METRO']['NAME']?></label>
                            <div class="metro-container">
                                <ul class="checkbox-group">
                                    <?
                                    $arSelect = array("ID", "NAME");
                                    $arFilter = array("IBLOCK_ID"=>14, 'IBLOCK_SECTION_ID'=> $cityId);
                                    $res = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilter,false, false, $arSelect);
                                    while($ob = $res->GetNextElement()){
                                        $arField = $ob->GetFields();?>
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
                            </div>
                        <?endif;?>
                    </li>
                    <? propofficial($arProps['ADDRESS']);?>
                    <li>
                        <label for="">Контакты</label>
                        <ul class="checkbox-group contacts-group">
                            <?foreach ($arProps['CONTACTS']['VALUE'] as $key => $contact){?>
                                <li>
                                    <input type="text" class="contact-phone" name="<?=$arProps['CONTACTS']['CODE']?>_<?=$key?>" value="<?=$contact?>">
                                </li>
                                <?
                                $contact_key = $key+1;
                            }
                            $contact_key_last = 0 + $contact_key;?>
                            <ul id="input<?=$contact_key_last?>" class="contacts-group-add"></ul>
                        </ul>
                        <div class="add" value="<?=$contact_key_last?>" title="Добавить телефон">+</div>
                    </li>
                    <li>
                        <label for=""><?=$arProps['COST_PRICE']['NAME']?></label>
                        <select name="COST_PRICE" value="">
                        <?$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>9, "CODE"=>$arProps['COST_PRICE']['CODE']));
                            while($enum_fields = $property_enums->GetNext())
                            {?>
                                <option value="<?=$enum_fields['ID']?>" <?if ($enum_fields['ID']==$arProps['COST_PRICE']['VALUE']){?>selected<?}?>><?=$enum_fields['VALUE']?></option>
                            <?}?>
                        </select>
                    </li>
                    <li>
                        <label for="">Оплата</label>
                        <ul class="checkbox-group">
                            <? propview($arProps["PAY_CARD"])?>
                            <? propview($arProps["DMC"])?>
                            <? propview($arProps["UMC"])?>
                            <? propview($arProps["PAY_MONEY"])?>
                        </ul>
                    </li>
                    <li>
                        <label for="">Лицензии</label>
                        <ul class="checkbox-group">
                            <? propview($arProps["ADULT"])?>
                            <? propview($arProps["CHILD"])?>
                        </ul>
                    </li>
                    <li>
                        <label for="">Прочие свойства</label>
                        <ul class="checkbox-group">
                            <? propview($arProps["ONLINE"])?>
                            <? propview($arProps["DIAGNOSTICS"])?>
                            <? propview($arProps["GUEST_PARKING"])?>
                            <? propview($arProps["DEPARTURE_HOUSE"])?>
                            <? propview($arProps["CHILDREN_DOCTOR"])?>
                            <? propview($arProps["WIFI"])?>
                            <? propview($arProps["SMS_MESSAGE"])?>
                            <? propview($arProps["EMAIL_MESSAGE"])?>
                        </ul>
                    </li>
                    <!--                        <li>-->
                    <!--                            <label for="mail-mess">Почтовые сообщения</label>-->
                    <!--                            <select name="mail-mess" id="">-->
                    <!--                                <option value="">Максимум полезного</option>-->
                    <!--                            </select>-->
                    <!--                        </li>-->
                </ul>
                <div class="text-view">
                    <div id="message-form"></div>
                    <div id="photo-form" style="display:none;"></div>
                    <button type="submit" name="saveProfile" class="save" id="saveProfile">Сохранить</button>
                </div>
            </div>
            <div class="personal-cabinet-content__my-profile__info-desc">
                <ul>
                    <!--                        <li>-->
                    <!--                            <label for="">Тип клиники:</label>-->
                    <!--                            <p>Клиника</p>-->
                    <!--                        </li>-->
                    <li>
                        <label for="">Название клиники:</label>
                        <input type="text" name="NAME_CLINIC" value="<?=$arFields['NAME']?>">
                    </li>
                    <li>
                        <label for="">Информация:</label>
                        <textarea rows="5" name="DETAIL_TEXT" ><?=$arFields['DETAIL_TEXT']?></textarea>
                    </li>
                    <li>
                        <label for="">Услуги:</label>
                        <textarea  rows="5" name="<?=$arProps["SERVICES"]['CODE']?>"><?=$arProps["SERVICES"]['VALUE']['TEXT']?></textarea>
                    </li>
                    <li>
                        <label for="">Парковка:</label>
                        <textarea rows="5" name="<?=$arProps["PARKING"]['CODE']?>"><?=$arProps["PARKING"]['VALUE']['TEXT']?></textarea>
                    </li>
                    <li>
                        <label for="">Проезд:</label>
                        <textarea rows="5" name="<?=$arProps["DIRECITONS"]['CODE']?>"><?=$arProps["DIRECITONS"]['VALUE']['TEXT']?></textarea>
                    </li>
                    <li>
                        <label for=""></label>
                        <div id="map" style="width: 100%; height: 300px"></div>
                    </li>
                    <? propofficial($arProps['MAP']);?>
                </ul>
                <div class="requisites-block">
                    <h4 class="title-h4">Реквизиты</h4>
                    <ul class="checkbox-group">
                        <? propofficial($arProps["INN"])?>
                        <? propofficial($arProps["OGRN"])?>
                        <? propofficial($arProps["KPP"])?>
                        <? propofficial($arProps["BIK"])?>
                        <? propofficial($arProps["OKATO"])?>
                        <? propofficial($arProps["URADRESS"])?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="personal-cabinet-content__my-profile__services link-checkbox">
            <label for="">Услуги:</label>
            <div class="personal-cabinet-content__my-profile__services-col">
                <p>На базе медицинского центра «Иммунитет» принимает:</p>
                <ul>
                    <?$arFilter = Array("IBLOCK_ID"=>"13","ACTIVE"=>"Y");
                    $arSelect = Array("NAME","CODE","ID");
                    $res = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter,false, false, $arSelect);
                    while($ob = $res->GetNextElement()){
                        $arFields = $ob->GetFields(); ?>
                        <li>
                            <input type="checkbox" <?if(in_array($arFields['ID'],$arProps['SPECIALIZATION']['VALUE'])){?>checked<?}?> value="<?=$arFields['ID']?>/<?=$arFields["NAME"]?>" name="<?=$arProps['SPECIALIZATION']['CODE']?>_<?=$arFields['ID']?>" id="<?=$arFields['ID']?>">
                            <label data-role="label_<?=$arFields['ID']?>" class="bx_filter_param_label" for="<?=$arFields['ID']?>">
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
</form>
<?if($arProps["MAP"]['VALUE']==NULL){$arProps["MAP"]['VALUE']='55.753215, 37.622504';}?>
<script>
    $(document).ready(function () {
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
        $('.change-password span').on('click', function () {
            $('.change-password-block').toggle();
        });
        $("#form_clinic").submit(function () {
            let formID = $(this).attr('id');
            let formNm = $('#' + formID);
            let formMs = $('#message-form');
            $.ajax({
                type: "POST",
                url: '/lc/clinic-save.php',
                data: formNm.serialize(),
                success: function (data) {
                    // Вывод текста результата отправки
                    $(formMs).html(data);
                }
            });
            return false;
        });
        $("#city").change(function () {
            let id = $(this).val();
            let block = $('#metro-block-ajax');
            $.ajax({
                type: "POST",
                url: '/ajax/ajax_metro.php',
                data: id,
                success: function (data) {
                    // Вывод текста результата отправки
                    $(block).html(data);
                }
            });
            return false;
        });
        $(document).on('change', '.photoFile', function(){
            let file_data = $(this).prop('files')[0];
            let form_data = new FormData();
            let formPhoto= $("#photo-form");
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
                    let file = $("#photo-form").text();
                    let str = file.substring(0,file.indexOf('/u'));
                    let imgUrl = file.replace(str, '');
                    console.log(imgUrl);
                    $('.logo-clinic-in-cabinet').attr('src',imgUrl);
                    $('.logo-clinic-in-cabinet').css('max-width','85px');
                    $('.logo-clinic-in-cabinet').css('max-height','85px');
                    $("#uploadPhoto").text('Не забудьте сохранить изменения');
                    $('input[name="LOGO"]').val(file);
                }
            });
            return false;
        });
        var x = <?=$contact_key_last?>;
        $('.add').on('click', function () {
            if (x < 10) {
                var str = '<li><input type="text" class="contact-phone" name="CONTACTS_' + x + '"></li><ul class="contacts-group-add" id="input' + (x + 1) + '"></ul>';
                document.getElementById('input' + x).innerHTML = str;
                x++;
            }else{
                $('.add').hide();
            }
        });
    });
</script>
<?}else{?>
    <?include 'none-cabinet.php';?>
<?}?>