<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
?>
<?if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0){?>
        <? LocalRedirect($backurl);?>
<?}else{?>
    <?$arFilter = Array("IBLOCK_ID"=>"9","ACTIVE"=>"Y", "PROPERTY_PHONE"=> $arUser['PERSONAL_PHONE']);
    $arSelect = Array();
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $idClinic = $arFields['ID'];
    }?>
    <?function propview($prop){
        $db_enum_list = CIBlockProperty::GetPropertyEnum($prop["CODE"], Array(), Array("IBLOCK_ID"=>9, "VALUE"=>"Y"));
        if($ar_enum_list = $db_enum_list->GetNext())
        {
           $valueId = $ar_enum_list['ID'];
        }
       ?>
            <li>
                <label data-role="label_arrFilter_<?=$prop["CODE"]?>" class="bx_filter_param_label " for="arrFilter_<?=$prop["CODE"]?>">
                    <span class="bx_filter_input_checkbox">
                        <input type="checkbox" <?if($prop["VALUE"] == 'Y'){?>checked<?}?> value="<?=$valueId?>" name="arrFilter_<?=$prop["CODE"]?>" id="arrFilter_<?=$prop["CODE"]?>">
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        <span class="bx_filter_param_text"><?=$prop["NAME"]?></span>
                    </span>
                </label>
            </li>
        <?}?>
    <?function propofficial($prop){?>
        <li>
            <label for=""><?=$prop['NAME']?></label>
            <input type="text" name="<?=$prop['CODE']?>" value="<?=$prop['VALUE']?>">
        </li>
    <?}?>
    <style>
        .personal-cabinet-content__my-profile__info-form > ul > li > ul > li > label {
            margin-left: 0;
        }
        .personal-cabinet-content__my-profile__info-form  .bx_filter_input_checkbox {
            display: flex;
        }
        .personal-cabinet-content__my-profile__info-form .bx_filter_param_text {
            margin-left: 5px;
        }
        .personal-cabinet-content__my-profile__info-desc input, .personal-cabinet-content__my-profile__info-desc textarea {
            width: 100%;
            outline: none;
            border: 2px solid #9DD4B3;
            box-sizing: border-box;
            border-radius: 5px;
            box-shadow: unset;
        }

        .personal-cabinet-content__my-profile__info-desc ul > li > input {
            height: 40px;
        }
        .personal-cabinet-content__my-profile__info-form .change-password-block {
            display: none;
        }
        .personal-cabinet-content__my-profile__info-form .change-password span {
            color: #32B4C3;
            text-decoration: underline;
            cursor: pointer;
        }
        .personal-cabinet-content__my-profile__info-form .change-password span:hover, .personal-cabinet-content__my-profile__info-form .change-password span:active, .personal-cabinet-content__my-profile__info-form .change-password span:focus{
            text-decoration: none;
        }
        .personal-cabinet-content__my-profile__info-form .change-password-flex {
            margin-bottom: 0;
        }
        .personal-cabinet-content__my-profile__info-form .profile-block-shown {
            display: block;
            margin: -15px auto 0;
        }
        .personal-cabinet-content__my-profile__info-form ul, .personal-cabinet-content__my-profile__info-desc ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .personal-cabinet-content__my-profile .metro-container {
            width: 100%;
            max-height: 120px;
            overflow: auto;
        }
        .personal-cabinet-content__my-profile .metro-container ul {
            padding: 0;
            margin: 0;
        }
        .personal-cabinet-content__my-profile .metro-container li label {
            margin-bottom: 0;
        }
        .personal-cabinet-content__my-profile .text-view {
            display: flex;
            justify-content: flex-end;
        }
        #message-form {
            margin-right: 20px;
            color: #9DD4B3;
            font-size: 18px;
            line-height: 21px;
        }
    </style>
    <main class="personal-cabinet">
        <div class="personal-cabinet-menu">
            <ul class="personal-cabinet-menu__list">
                <li class="personal-cabinet-menu__list-item unactive active">
                    <a href="">
                        <div class="personal-cabinet-menu__icon icon-clinic unactive active">
                        </div>
                        <div class="personal-cabinet-menu__desc">
                            <h5>Клиника</h5>
                            <span>профиль, услуги, способы оплаты</span>
                        </div>
                    </a>
                </li>
                <li class="personal-cabinet-menu__list-item unactive">
                    <a href="schedule.php">
                        <div class="personal-cabinet-menu__icon icon-schedule unactive">
                        </div>
                        <div class="personal-cabinet-menu__desc">
                            <h5>Расписание клиники</h5>
                            <span>время работы</span>
                        </div>
                    </a>
                </li>
                <li class="personal-cabinet-menu__list-item unactive">
                    <a href="doctors.php">
                        <div class="personal-cabinet-menu__icon icon-doctor unactive">
                        </div>
                        <div class="personal-cabinet-menu__desc">
                            <h5>Врачи</h5>
                            <span>фотографии, квалификация</span>
                        </div>
                    </a>
                </li>
                <li class="personal-cabinet-menu__list-item unactive">
                    <a href="price.php">
                        <div class="personal-cabinet-menu__icon icon-price unactive">
                        </div>
                        <div class="personal-cabinet-menu__desc">
                            <h5>Цены на услуги клиники</h5>
                            <span>МРТ, КТ, УЗИ</span>
                        </div>
                    </a>
                </li>
                <li class="personal-cabinet-menu__list-item unactive">
                    <a href="">
                        <div class="personal-cabinet-menu__icon icon-doc unactive">
                        </div>
                        <div class="personal-cabinet-menu__desc">
                            <h5>Документы, фото и видео</h5>
                            <span>Логотип, грамоты, дипломы клиники</span>
                        </div>
                    </a>
                </li>
                <li class="personal-cabinet-menu__list-item unactive">
                    <a href="">
                        <div class="personal-cabinet-menu__icon icon-feedback unactive">
                        </div>
                        <div class="personal-cabinet-menu__desc">
                            <h5>Отзывы</h5>
                            <span>Ответы на отзывы, чат</span>
                        </div>
                    </a>
                </li>
                <li class="personal-cabinet-menu__list-item unactive">
                    <a href="">
                        <div class="personal-cabinet-menu__icon icon-adv unactive">
                        </div>
                        <div class="personal-cabinet-menu__desc">
                            <h5>Советы</h5>
                            <span>по продвижению клиники</span>
                        </div>
                    </a>
                </li>
                <li class="personal-cabinet-menu__list-item unactive">
                    <a href="">
                        <div class="personal-cabinet-menu__icon icon-wid unactive">
                        </div>
                        <div class="personal-cabinet-menu__desc">
                            <h5>Виджеты</h5>
                            <span>для сайта клиники</span>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="personal-cabinet-menu__manager">
                <div class="personal-cabinet-menu__manager__photo">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/manager-photo.png" alt="photo">
                </div>
                <p class="personal-cabinet-menu__manager__desc">Мой персональный менеджер</p>
                <p class="personal-cabinet-menu__manager__name">Марина Тихоновская</p>
                <a href="tel:+79892897445" class="personal-cabinet-menu__manager__phone">+7 (989) 289-74-45</a>
                <div class="personal-cabinet-menu__manager__social">
                    <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/viber-icon.svg" alt="icon"></a>
                    <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/whatsapp-icon.svg" alt="icon"></a>
                    <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/telegram-icon.svg" alt="icon"></a>
                </div>
                <a href="mailto:marina@prodoctorov.ru" class="personal-cabinet-menu__manager__email">marina@prodoctorov.ru</a>
            </div>
        </div>
        <form id="form_clinic" name="form_clinic" action="" method="post">
            <div class="personal-cabinet-content__my-profile">
                <h2 class="title-h2">Мой профиль</h2>
                <div class="personal-cabinet-content__my-profile__info">
                    <div class="personal-cabinet-content__my-profile__info-form">
                        <input type="hidden" name="ID_CLINIC" value="<?=$idClinic?>">
                        <ul>
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
                            <?
                            $metroInCity = CIBlockSection::GetSectionElementsCount($cityId, Array("CNT_ACTIVE"=>"Y"));
                            if($metroInCity>0):?>
                            <li>
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
                                                <label data-role="label_arrFilter_<?=$arField['ID']?>" class="bx_filter_param_label " for="arrFilter_<?=$arFiels['ID']?>">
                                                <span class="bx_filter_input_checkbox">
                                                    <input type="checkbox" <?if(in_array($arField['ID'],$arProps['METRO']['VALUE'])){?>checked<?}?> name="arrFilter_<?=$arField['ID']?>" id="arrFilter_<?=$arFields['ID']?>">
                                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                                    <span class="bx_filter_param_text"><?=$arField["NAME"]?></span>
                                                </span>
                                                </label>
                                            </li>
                                        <?}?>
                                    </ul>
                                </div>
                            </li>
                            <?endif;?>
                            <? propofficial($arProps['ADDRESS']);?>
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
                    </div>
                </div>
                <div class="personal-cabinet-content__my-profile__services">
                    <label for="">Услуги:</label>
                    <div class="personal-cabinet-content__my-profile__services-col">
                        <p>На базе медицинского центра «Иммунитет» принимает:</p>
                        <ul>
                            <?$arFilter = Array("IBLOCK_ID"=>"13","ACTIVE"=>"Y");
                            $arSelect = Array("NAME");
                            $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
                            while($ob = $res->GetNextElement()){
                            $arFields = $ob->GetFields();?>
                                <li><a href=""><?=$arFields['NAME']?></a></li>
                            <?}?>
                        </ul>
                    </div>
                    <div class="personal-cabinet-content__my-profile__services-col">
                        <p>Предлагаются лабораторные исследования:</p>
                        <ul>
                            <li><a href="">диагностика различных инфекций</a></li>
                            <li><a href="">онкомаркеры</a></li>
                            <li><a href="">педиатр</a></li>
                            <li><a href="">выполнение пренатального скрининга</a></li>
                            <li><a href="">маркеры остеопороза</a></li>
                            <li><a href="">онкомаркеры</a></li>
                            <li><a href="">наличие глистных инвазий</a></li>
                            <li><a href="">маркеры остеопороза</a></li>
                            <li><a href="">педиатр</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </form>
    </main>
<?}?>
    <script>
        $(document).ready(function () {
            ymaps.ready(init);

            function init() {
                var myPlacemark,
                    myMap = new ymaps.Map('map', {
                        center: [<?=$arProps["MAP"]['VALUE']?>],
                        zoom: 9
                    }, {
                        searchControlProvider: 'yandex#search'
                    });

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
                var formID = $(this).attr('id');
                var formNm = $('#' + formID);
                var formMs = $('#message-form');
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
        });
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>