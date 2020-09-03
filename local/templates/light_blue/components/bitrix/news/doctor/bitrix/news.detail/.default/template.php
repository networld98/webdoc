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
global $doctorName;
$doctorName = $arResult['NAME'];
?>
<section class="container">
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    ),
        false
    );?>
</section>
<section class="container doctor-card">
    <div class="flex-left">
        <div class="doctor-card-top-content">
            <div class="doctor-card__img <?if($arResult['DETAIL_PICTURE']!=NULL){?>doctor-card-img<?}?>">
                <div class="doctor-card__img-link">
                <?if($arResult['DETAIL_PICTURE']){?>
                    <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="doctor-photo" class="doctor-card__img-photo">
                <?}elseif($arResultm['PROPERTIES']['GENDER']['VALUE']==NULL || $arResult['PROPERTIES']['GENDER']['VALUE']=="Мужчина" ){?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/icon/male.svg" alt="no-photo" class="doctors-list-item__img-none-photo">
                <?}elseif($arResult['PROPERTIES']['GENDER']['VALUE']=="Женщина" ){?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo">
                <?}?>
                </div>
                <div class="doctor-card__img-info">
                    <a class="popup-mess-click" style="cursor:pointer;">Написать доктору</a>
                    <a href="tel:<?=$arResult['PROPERTIES']['PHONE']['VALUE']?>">Позвонить</a>
                </div>
                <div class="doctor-card-favorites"></div>
            </div>
            <div class="doctor-card__description">
                <p class="doctor-card__description-position">
                    <?$res = CIBlockSection::GetByID($arResult['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE']);
                    if($ar_res = $res->GetNext()){?>
                        <?=$ar_res['NAME']?>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["SPECIALIZATION_DOP"]["VALUE"]):?>
                        <?echo " · "?>
                        <?$res = CIBlockSection::GetByID($arResult['PROPERTIES']['SPECIALIZATION_DOP']['VALUE']);
                        if($ar_res = $res->GetNext()){?>
                            <?=$ar_res['NAME']?>
                        <?}?>
                    <?endif;?>
                    <?if($arResult["PROPERTIES"]["RANK"]["VALUE"]):?>
                        <?= " · "?>
                        <?=$arResult['PROPERTIES']['RANK']['VALUE']?>
                    <?endif;?>
                </p>
                <p class="doctor-card__description-title"><?=$arResult['NAME']?></p>
                <?if($arResult["PROPERTIES"]["STANDING"]["VALUE"]):?>
                    <p class="doctor-card__description-exp">Стаж <?=$arResult['PROPERTIES']['STANDING']['VALUE']?></p>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["SCIENCE_DEGREE"]["VALUE"]):?>
                    <p class="doctor-card__description-degree"><?=$arResult["PROPERTIES"]["SCIENCE_DEGREE"]["VALUE"]?></p>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["PRICE"]["VALUE"]):?>
                    <p class="doctor-card__description-price"><?=$arResult["PROPERTIES"]["PRICE"]["VALUE"]?> Р<span>Цена приема в клинике</span></p>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["PHONE"]["VALUE"]):?>
                    <a href="tel:<?=$arResult["PROPERTIES"]["PHONE"]["VALUE"]?>" class="doctor-card__description-phone"><span>Телефон для записи:</span><?=$arResult["PROPERTIES"]["PHONE"]["VALUE"]?></a>
                <?endif;?>
                <div class="doctor-card__description__adapt">
                <?if($arResult["PROPERTIES"]["CLINIK"]["VALUE"]):?>
                    <?foreach ($arResult["PROPERTIES"]["CLINIK"]["VALUE"] as $item){?>
                        <?$res = CIBlockElement::GetByID($item);
                        if($ar_res = $res->GetNext()){?>
                            <a href="<?=$ar_res['DETAIL_PAGE_URL']?>"><p class="doctor-card__clinic-name"><?=$ar_res['NAME']?></p></a>
                        <?break;}?>
                    <?}?>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"] || $arResult["PROPERTIES"]["CITY"]["VALUE"] ):
                    $res = CIBlockSection::GetByID($arResult["PROPERTIES"]["CITY"]["VALUE"]);?>
                    <p class="doctor-card__clinic-adress">
                        <? if($ar_res = $res->GetNext()){
                            echo $ar_res['NAME'];
                        }?><?if($arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"] && $arResult["PROPERTIES"]["CITY"]["VALUE"] ){?>, <?}?>
                        <?=$arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"]?>
                    </p>
                <?endif;?>
                <!-- <div class="doctor-card-location-map"></div> -->
                <?if($arResult["PROPERTIES"]["METRO"]["VALUE"]):?>
                    <ul class="doctor-card__metro-list">
                        <?foreach ($arResult["PROPERTIES"]["METRO"]["VALUE"] as $key => $item){?>
                            <?$res = CIBlockElement::GetByID($item);
                            if($ar_res = $res->GetNext()){?>
                                <li class="doctor-card_metro-list-item <?if(($key % 2)==0 && $key!=0){?>metro1<?}elseif(($key % 3)==0||$key===0){?>metro2<?}else{?>metro3<?}?>"><?=$ar_res['NAME']?></li>
                            <?}?>
                        <?}?>
                    </ul>
                <?endif;?>
                <?/*<a href="" class="doctor-card__metro-list-show_more">ещё адреса приёма</a>*/?>
                </div>
            </div>
        </div>
       <?/* <div class="doctor-card-popUp-group">
            <a class="doctor-card-popUp-group__reception popup-reception-click"><span>Записаться на прием</span></a>
			<a class="doctor-card-popUp-group__call popup-call-click"><span>Вызвать врача на дом</span></a>
            <?if($arResult["PROPERTIES"]["MAP"]["VALUE"]):?>
			    <a class="doctor-card-popUp-group__route popup-link"><span>Проложить маршрут</span></a>
            <?endif;?>
        </div>*/?>
        <div class="reception-popup">
            <div class="popup-box">
                <div class="close"></div>
                <div class="doctors-list reception" style="width: 100%;">
                    <div class="doctors-list-item">
                        <div class="flex-content">
                            <a href="/" class="logo">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo">
                                <h2 class="title-h2 tablet-title">Запись на приём</h2>
                            </a>
                            <div class="flex-left">
                                <div class="doctors-list-item__img">
                                    <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctor-photo.png" alt="doctor-photo" class="doctors-list-item__img-photo"></a>
                                    <div class="doctors-list-item__img-info">
                                        <div class="doctors-list-item__img-info-ratings">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                        </div>
                                        <p class="doctors-list-item__img-info-commend">100% пациентов рекомендуют врача на основе <a href="">256 отзыва</a></p>
                                    </div>
                                </div>
                                <div class="doctors-list-item__description">
                                    <h2 class="title-h2 mobile-title">Запись на приём</h2>
                                    <p class="doctors-list-item__description-position">Аллерголог</p>
                                    <p class="doctors-list-item__description-title">Баранова Ирина Дмитриевна</p>
                                    <p class="doctors-list-item__description-price">2 000 Р<span>Цена приема в клинике</span></p>
                                    <a href="tel:+8(812)000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                                    <p class="doctor-card__clinic-name">Центр амбулаторной хирургии</p>
                                    <p class="doctor-card__clinic-adress">Санкт-Петербург, ул. Чекистов, д. 22 (м. Проспект ветеранов)</p>
                                    <ul class="doctor-card__metro-list">
                                        <li class="doctor-card_metro-list-item metro2">м. Беговая</li>
                                        <li class="doctor-card_metro-list-item metro3">м. Старая Деревня</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flex-right">
                            <h2 class="title-h2">Запись на приём</h2>
                            <form action="">
                                <div class="reception-select-group">
                                    <div class="reception-select-group__left">
                                        <label for="spec">Специальноcть</label>
                                        <select name="spec" id="">
                                            <option value="">Аллерголог</option>
                                        </select>
                                    </div>
                                        
                                    <div class="reception-select-group__right">
                                        <label for="fio">ФИО</label>
                                            <select name="fio" id="">
                                                <option value="">Иванов Степан Викторович</option>
                                            </select>
                                    </div>   
                                </div>
                                <div class="reception-select-group">
                                    <div>
                                        <label for="clinic">Клиника</label>
                                            <select name="clinic" id="">
                                                <option value="">Центр семейной медицины на Савушкина</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="reception-select-group date-birth">
                                    <div class="reception-select-group__left">
                                        <label for="date-and-time">Дата и время приёма</label>
                                        <select name="date-and-time" id="">
                                            <option value="">07.04.2020</option>
                                        </select>
                                    </div>
                                        
                                    <div class="reception-select-group__right">
                                    <label for="birth">Дата рождения</label>
                                        <select name="birth" id="">
                                            <option value="">15.12.1985</option>
                                        </select>
                                    </div>   
                                </div>
                                <div class="reception-select-group">

                                    <div class="reception-select-group__left">
                                    <label for="phone">Телефон для подтверждения записи</label>
                                        <select name="phone" id="">
                                            <option value="">+7 (***) ***-**-**</option>
                                        </select>
                                    </div>
                                    
                                    <div class="reception-select-group__right">
                                        <p class="reception-select-group__desc">На этот номер вы получите SMS с кодом подтверждения и информацию о записи</p>
                                    </div> 
                                </div>
                                <div class="reception-select-group">

                                    <div class="reception-select-group__left">
                                        <button>Записаться</button>
                                    </div>
                                    
                                    <div class="reception-select-group__right">
                                        <p class="reception-select-group__desc">Нажимая «Записаться», я принимаю <a href="">условия пользовательского соглашения</a> и даю согласие на обработку персональных данных.</p>
                                    </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="call-popup">
            <div class="popup-box">
                <div class="close"></div>
                <div class="doctors-list call" style="width: 100%;"> 
                    <div class="doctors-list-item">
                        <div class="flex-content">
                            <a href="/" class="logo">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo">
                                <h2 class="title-h2 tablet-title">Вызов врача на дом</h2>
                            </a>
                            <div class="flex-left">
                                <div class="doctors-list-item__img">
                                    <a href="">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctor-photo.png" alt="doctor-photo" class="doctors-list-item__img-photo">
                                    </a>
                                    <div class="doctors-list-item__img-info">
                                        <div class="doctors-list-item__img-info-ratings">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                        </div>
                                        <p class="doctors-list-item__img-info-commend">100% пациентов рекомендуют врача на основе <a href="">256 отзыва</a></p>
                                    </div>
                                </div>
                                <div class="doctors-list-item__description">
                                <h2 class="title-h2 mobile-title">Вызов врача на дом</h2>
                                    <p class="doctors-list-item__description-position">Аллерголог</p>
                                    <p class="doctors-list-item__description-title">Баранова Ирина Дмитриевна</p>
                                    <p class="doctors-list-item__description-price">2 000 Р<span>Цена приема в клинике</span></p>
                                    <a href="tel:+8(812)000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                                    <p class="doctor-card__clinic-name">Центр амбулаторной хирургии</p>
                                    <p class="doctor-card__clinic-adress">Санкт-Петербург, ул. Чекистов, д. 22 (м. Проспект ветеранов)</p>
                                    <ul class="doctor-card__metro-list">
                                        <li class="doctor-card_metro-list-item metro2">м. Беговая</li>
                                        <li class="doctor-card_metro-list-item metro3">м. Старая Деревня</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flex-right">
                            <h2 class="title-h2">Вызов врача на дом</h2>
                            <form action="">
                                <div class="reception-select-group">
                                    <div class="reception-select-group__left">
                                        <label for="spec">Специальноcть</label>
                                        <select name="spec" id="">
                                            <option value="">Аллерголог</option>
                                        </select>
                                    </div>
                                        
                                    <div class="reception-select-group__right">
                                    <label for="fio">ФИО</label>
                                        <select name="fio" id="">
                                            <option value="">Иванов Степан Викторович</option>
                                        </select>
                                    </div>   
                                </div>
                                <div class="reception-select-group">
                                    <div>
                                    <label for="clinic">Адресс проживания</label>
                                        <input type="text" placeholder="Введите адресс">
                                    </div>
                                </div>
                                <div class="reception-select-group date-birth">
                                    <div class="reception-select-group__left">
                                        <label for="date-and-time">Дата и время приёма</label>
                                        <select name="date-and-time" id="">
                                            <option value="">07.04.2020</option>
                                        </select>
                                    </div>
                                        
                                    <div class="reception-select-group__right">
                                    <label for="birth">Дата рождения</label>
                                        <select name="birth" id="">
                                            <option value="">15.12.1985</option>
                                        </select>
                                    </div>   
                                </div>
                                <div class="reception-select-group">

                                    <div class="reception-select-group__left">
                                    <label for="phone">Телефон для подтверждения записи</label>
                                        <select name="phone" id="">
                                            <option value="">+7 (***) ***-**-**</option>
                                        </select>
                                    </div>
                                    
                                    <div class="reception-select-group__right">
                                        <p class="reception-select-group__desc">На этот номер вы получите SMS с кодом подтверждения и информацию о записи</p>
                                    </div> 
                                </div>
                                <div class="reception-select-group">

                                    <div class="reception-select-group__left">
                                        <button>Записаться</button>
                                    </div>
                                    
                                    <div class="reception-select-group__right">
                                        <p class="reception-select-group__desc">Нажимая «Записаться», я принимаю <a href="">условия пользовательского соглашения</a> и даю согласие на обработку персональных данных.</p>
                                    </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mess-popup">
            <div class="popup-box">
                <div class="close"></div>
                <div class="message-to-doctor" style="width: 100%;">
                    <div class="mess-popup__header">Оставьте Ваше сообщение</div>
                    <input class="mess-popup__name" type="text" name="" placeholder="ФИО">
                    <input class="mess-popup__email" type="text" name="" placeholder="E-mail">
                    <textarea class="mess-popup__message" type="text" name="" placeholder="Текст сообщения"></textarea>
                    <p class="mess-popup__desc">Нажимая «Отправить», я принимаю <a href="">условия пользовательского соглашения и даю согласие</a> на обработку персональных данных.</p>
                    <input type="submit" name="" class="send" value="Отправить">
                </div>
            </div>
        </div>
    </div>
    <div class="flex-right">
        <div class="doctor-card-top-content">
            <div class="doctor-card__title">
                <h3 class="title-h3">Информация о враче</h3>
                <div class="doctor-card__img-info-ratings">
                    <?if(CModule::IncludeModule('api.reviews')) {$arRaing = CApiReviews::getElementRating($arResult['ID']);} ?>
                    <?if($arRaing['RATING']>=1){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-1">
                    <?}if ($arRaing['RATING']>=2){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-2">
                    <?}if ($arRaing['RATING']>=3){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-3">
                    <?}if ($arRaing['RATING']>=4){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-4">
                    <?}if ($arRaing['RATING']>=5){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-5">
                    <?}?>
                </div>
            </div>
            <p class="doctor-card__img-info-commend"><?=$arRaing['PERCENT']?> пациентов рекомендуют врача на основе <?=$arRaing['COUNT']?> отзывов(а)<a href="#full-feedback">Все отзывы о враче</a></p>
            <ul class="doctor-card_options-list">
                <?if($arResult["PROPERTIES"]["DIAGNOSTICS"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["DIAGNOSTICS"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["CHILDREN_DOCTOR"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["CHILDREN_DOCTOR"]["NAME"]?></li>
                <?endif;?>
                <?if($arResultm["PROPERTIES"]["DMC"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["DMC"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["UMC"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["UMC"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["ONLINE"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["ONLINE"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["DEPARTURE_HOUSE"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["DEPARTURE_HOUSE"]["NAME"]?></li>
                <?endif;?>
            </ul>
            <p class="doctor-card__position-desc"><?=$arResult['PREVIEW_TEXT']?></p>
            <a href="#anchor-spec-info" class="doctor-card__metro-list-show_more go-to">Подробная информация о специалисте</a>
        </div>
        <div class="doctor-card-popUp-group">
            <a class="doctor-card-popUp-group__route popup-link">Проложить маршрут</a>
        </div>
        <?if($arResult["PROPERTIES"]["MAP"]["VALUE"]):?>
        <div class="map-wrapper">
                <div class="doctor-card-location-map popup-link-marker"></div>
                <div class="popup-box">
					<div class="close"></div>
                    <div class="map-popup-marker" id="map_<?=$arResult['ID']?>"  style="width: 100%;"></div>
                    <div class="map-popup" id="map_track_<?=$arResult["ID"]?>"  style="width: 100%;"></div>
                    <script type="text/javascript">
                        ymaps.ready(init);
                        function init() {
                            var myMap_<?=$arResult['ID']?> = new ymaps.Map("map_<?=$arResult['ID']?>", {
                                center: [<?=$arResult["PROPERTIES"]["MAP"]["VALUE"]?>],
                                zoom: 12,
                                controls: [
                                    'zoomControl', // Ползунок масштаба
                                    'rulerControl', // Линейка
                                    'routeButtonControl', // Панель маршрутизации
                                    'trafficControl', // Пробки
                                    'typeSelector', // Переключатель слоев карты
                                    'fullscreenControl', // Полноэкранный режим
                                    new ymaps.control.SearchControl({
                                        options: {
                                            size: 'large',
                                            provider: 'yandex#search'
                                        }
                                    })
                                ]
                            });
                            var myPlacemark_<?=$arResult['ID']?> = new ymaps.Placemark([<?=$arResult["PROPERTIES"]["MAP"]["VALUE"]?>], {
                                hintContent: '<?=$arResult["NAME"]?>'
                            });
                            myMap_<?=$arResult['ID']?>.geoObjects.add(myPlacemark_<?=$arResult['ID']?>);

                            var myMap_track_<?=$arResult['ID']?> = new ymaps.Map('map_track_<?=$arResult["ID"]?>', {
                                center: [<?=$arResult["PROPERTIES"]["MAP"]["VALUE"]?>],
                                zoom: 12,
                                controls: ['routePanelControl']
                            });

                            var control_track_<?=$arResult["ID"]?> = myMap_track_<?=$arResult["ID"]?>.controls.get('routePanelControl');
                            control_track_<?=$arResult["ID"]?>.routePanel.state.set({
                                type: 'masstransit',
                                fromEnabled: true,
                                toEnabled: false,
                                to: '<?=$arResult["PROPERTIES"]["MAP"]["VALUE"]?>'
                            });
                            control_track_<?=$arResult["ID"]?>.routePanel.options.set({
                                allowSwitch: false,
                                reverseGeocoding: true,
                                types: { masstransit: true, pedestrian: true, taxi: true }
                            });

                            var switchPointsButton = new ymaps.control.Button({
                                data: {content: "Поменять местами", title: "Поменять точки местами"},
                                // options: {selectOnClick: false, maxWidth: 160}
                            });
                            switchPointsButton.events.add('click', function () {
                                control_track_<?=$arResult["ID"]?>.routePanel.switchPoints();
                            });
                            myMap_track_<?=$arResult["ID"]?>.controls.add(switchPointsButton);
                        }
                    </script>
				</div>
            </div>
        <?endif;?>
    </div>
</section>
<?/*<section class="container choosing-time">
    <h3 class="title-h3">Выберите время приема для записи онлайн</h3>
    <?if($arResult["PROPERTIES"]["DAY_RECEPTION"]["VALUE"]):?>
    <div class="choosing-time_block">
        <!-- <span class="choosing-time_block__arrows arrow-left"></span> -->
        <ul class="choosing-time_block-list slick-slider3">
            <li class="choosing-time_block-list-item active">Сегодня</br> 6 апреля</li>
            <li class="choosing-time_block-list-item">Завтра</br> 7 апреля</li>
            <li class="choosing-time_block-list-item">Среда</br> 8 апреля</li>
            <li class="choosing-time_block-list-item not-worked">Четверг</br> 9 апреля</li>
            <li class="choosing-time_block-list-item">Пятница</br> 10 апреля</li>
            <li class="choosing-time_block-list-item">Cуббота</br> 11 апреля</li>
            <?foreach ($arResult["PROPERTIES"]["DAY_RECEPTION"]["VALUE"] as $item){?>
                <li class="choosing-time_block-list-item"><?=$item?></li>
            <?}?>
        </ul>
        <!-- <span class="choosing-time_block__arrows arrow-right"></span> -->
    </div>
    <?endif;?>
    <?if($arResult["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"]):?>
        <ul class="choosing-time__worktimming-list">
<!--            <li class="choosing-time__worktimming-list-item closed">10:10</li>-->
<!--            <li class="choosing-time__worktimming-list-item pass">10:50</li>-->
            <?foreach ($arResult["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"] as $item){?>
                <li class="choosing-time__worktimming-list-item popup-reception-click"><?=$item?></li>
            <?}?>
        </ul>
    <?endif;?>
</section>*/?>
<section class="container checked-feedback" id="full-feedback">
    <h2 class="title-h2">Проверенные отзывы о враче</h2>
    <?
    if(CModule::IncludeModule('api.uncachedarea'))
    {
        CAPIUncachedArea::includeFile(
            "/doctors/reviews.php",
            array(
                'ID' => $arResult['ID'],
                'NAME' => $arResult['NAME'],
            )
        );
    }
    ?>
</section>
<section id="anchor-spec-info" class="container spec-info">
    <h2 class="title-h2">Информация о специалисте</h2>
    <div class="spec-info-block">
        <ul class="spec-info-block__spec-list">
            <h3 class="title-h3">Специализируется</br> на лечении</h3>
            <li>
                <?$res = CIBlockSection::GetByID($arResult['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE']);
                if($ar_res = $res->GetNext()){?>
                    <p class="spec-info-block__spec-list__title"><?=$ar_res['NAME']?></p>
                <?}?>
                <?if($arResult["PROPERTIES"]["SPECIALIZATIONS"]["VALUE"]):?>
                    <ul>
                        <?foreach ($arResult["PROPERTIES"]["SPECIALIZATIONS"]["VALUE"] as $item){?>
                            <?$res = CIBlockElement::GetByID($item);
                            if($ar_res = $res->GetNext()){?>
                                <li class="spec-info-block__spec-list-item"><a href=""><?=$ar_res['NAME']?></a></li>
                            <?}?>
                        <?}?>
                    </ul>
                <?endif;?>
            </li>
        </ul>
        <ul class="spec-info-block__education-list">
            <h3 class="title-h3">Образование</h3>
            <?if($arResult["PROPERTIES"]["EDUCATION"]["VALUE"]):?>
                <ol>
                <?foreach ($arResult["PROPERTIES"]["EDUCATION"]["VALUE"] as $item){?>
                    <?$obr = explode('/',$item); ?>
                    <li><span><?=$obr[0]?></span><?=$obr[1]?></li>
                <?}?>
                </ol>
            <?endif;?>
        </ul>
        <ul class="spec-info-block__exp-list">
            <h3 class="title-h3">Опыт работы</h3>
            <?if($arResult["PROPERTIES"]["EXPERIENCE"]["VALUE"]):?>
                <ol>
                <?foreach ($arResult["PROPERTIES"]["EXPERIENCE"]["VALUE"] as $item){?>
                    <?$obr = explode('/',$item); ?>
                    <li><span><?=$obr[0]?></span><?=$obr[1]?></li>
                <?}?>
                </ol>
            <?endif;?>
        </ul>
    </div>
</section>
<section class="container spec-list">
    <h2 class="title-h2">Специализация</h2>
    <div class="flex-between">
        <?=$arResult['DETAIL_TEXT']?>
    </div>
</section>
