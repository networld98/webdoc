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
global $clinicName;
global $clinickId;
$clinicName = $arResult["NAME"];
$clinickId = $arResult["ID"];
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
<div class="container">
<div class="clinic-card-item">
    <div class="clinic-card-img">
        <div class="clinic-card-img__img">
            <?if($arResult["PROPERTIES"]["LOGO"]["VALUE"]){
                ?>
                <img src="<?= CFile::GetPath($arResult["PROPERTIES"]["LOGO"]["VALUE"]); ?>" alt='<?=$arResult["NAME"]?>'>
            <?}else{?>
                <img src="<?= SITE_TEMPLATE_PATH ?>/icon/hospital_building.svg" alt="нет лого">
            <?}?>
        </div>
        <?if(CModule::IncludeModule('api.reviews')) {$arRaing = CApiReviews::getElementRating($arResult['ID']);} ?>
        <div class="clinic-card-img__ratings">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'1%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'21%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'41%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'61%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'81%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
        </div>
        <a class="clinic-card-img__link" href="#"><?=$arRaing['COUNT']?> отзывов</a>
    </div>
    <div class="clinic-card-desc-detail">
        <h1 class="clinic-card-desc__clinic-name"><?=$arResult["NAME"]?></h1>
        <?if($arResult["DISPLAY_PROPERTIES"]["COST_PRICE"]["DISPLAY_VALUE"]):?>
            <p class="clinic-card-desc__price">Первичная стоимость приёма - <span><?=$arResult["DISPLAY_PROPERTIES"]["COST_PRICE"]["DISPLAY_VALUE"]?></span></p>
        <?endif;?>
        <?if($arResult["PROPERTIES"]["SPECIALIZATION"]["VALUE"]):?>
            <ul class="clinic-card-desc__spec-list">
                <?foreach ($arResult["PROPERTIES"]["SPECIALIZATION"]["VALUE"] as $item){
                    $res = CIBlockElement::GetByID($item);
                    if($ar_res = $res->GetNext()){?>
                        <li><a href="#"><?=$ar_res['NAME']?></a></li>
                    <?}
                }?>
            </ul>
        <?endif;?>
        <p class="clinic-card-desc__about"><?=$arResult["PREVIEW_TEXT"]?></p>
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
                            var myMap_view_<?=$arResult['ID']?> = new ymaps.Map("map_view_<?=$arResult['ID']?>", {
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
                            var myPlacemark_view_<?=$arResult['ID']?> = new ymaps.Placemark([<?=$arResult["PROPERTIES"]["MAP"]["VALUE"]?>], {
                                hintContent: '<?=$arResult["NAME"]?>'
                            });
                            myMap_view_<?=$arResult['ID']?>.geoObjects.add(myPlacemark_view_<?=$arResult['ID']?>);

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
                                options: {selectOnClick: false, maxWidth: 160}
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
        <div class="clinic-card-info-detail">
            <div class="clinic-card-info-detail__block">
                <?if($arResult["DISPLAY_PROPERTIES"]["SPECIALIZATION"]["DISPLAY_VALUE"]):?>
                    <p class="clinic-card-info-detail__title map">Адрес</p>
                    <span><?if($arResult["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?><?}?></span>
                <?endif;?>
            </div>
            <div class="clinic-card-info-detail__block">
                <?if($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]):?>
                    <p class="clinic-card-info-detail__title contacts-phone">Контакты</p>
                    <?foreach ($arResult["PROPERTIES"]["CONTACTS"]["VALUE"] as $item){?>
                        <span><a href="tel:<?=$item?>"><?=$item?></a></span>
                    <?}?>
                <?endif;?>
            </div>
            <div class="clinic-card-info-detail__block">
                <?if($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]!=NULL):?>
                    <p class="clinic-card-info-detail__title time">Время работы</p>
                    <span><?=$arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]?></span>
                <?endif;?>
            </div>
            <ul class="doctors-list-item_options-list">
                <?if($arResult["PROPERTIES"]["DIAGNOSTICS"]["VALUE"]=='Y'):?>
                    <li class="doctors-list-item_options-list-item"><?=$arResult["PROPERTIES"]["DIAGNOSTICS"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["CHILDREN_DOCTOR"]["VALUE"]=='Y'):?>
                    <li class="doctors-list-item_options-list-item"><?=$arResult["PROPERTIES"]["CHILDREN_DOCTOR"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["DMC"]["VALUE"]=='Y'):?>
                    <li class="doctors-list-item_options-list-item"><?=$arResult["PROPERTIES"]["DMC"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["UMC"]["VALUE"]=='Y'):?>
                    <li class="doctors-list-item_options-list-item"><?=$arResult["PROPERTIES"]["UMC"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["ONLINE"]["VALUE"]=='Y'):?>
                    <li class="doctors-list-item_options-list-item"><?=$arResult["PROPERTIES"]["ONLINE"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["DEPARTURE_HOUSE"]["VALUE"]=='Y'):?>
                    <li class="doctors-list-item_options-list-item"><?=$arResult["PROPERTIES"]["DEPARTURE_HOUSE"]["NAME"]?></li>
                <?endif;?>
            </ul>
        </div>
        <?if($arResult["PROPERTIES"]["MAP"]["VALUE"]):?>
                <div class="doctor-card-popUp-group">
                    <a id="header-map" class="doctor-card-popUp-group__route popup-link">Проложить маршрут</a>
                </div>
        <?endif;?>
    </div>
</div>
<section class="clinic-card">
    <?$APPLICATION->IncludeComponent(
        "bitrix:news",
        "doctor_in_clinic",
        array(
            "ADD_ELEMENT_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "BROWSER_TITLE" => "-",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "N",
            "COMPONENT_TEMPLATE" => "doctor",
            "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
            "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
            "DETAIL_DISPLAY_TOP_PAGER" => "N",
            "DETAIL_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "DETAIL_PAGER_SHOW_ALL" => "Y",
            "DETAIL_PAGER_TEMPLATE" => "",
            "DETAIL_PAGER_TITLE" => "Страница",
            "DETAIL_PROPERTY_CODE" => array(
                0 => "DEPARTURE_HOUSE",
                1 => "CHILDREN_DOCTOR",
                2 => "DIAGNOSTICS",
                3 => "MAP",
                4 => "ONLINE",
                5 => "DMC",
                6 => "UMC",
                7 => "METRO",
                8 => "SPECIALIZATION",
                9 => "ADDRESS",
                10 => "DOCTORS",
                11 => "WORK_TIME",
                12 => "CONTACTS",
                13 => "AREA",
                14 => "COST_PRICE",
                15 => "REGION",
                16 => "CITY",
                17 => "",
            ),
            "DETAIL_SET_CANONICAL_URL" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "10",
            "IBLOCK_TYPE" => "content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
            "LIST_FIELD_CODE" => array(
                0 => "DETAIL_TEXT",
                1 => "DETAIL_PICTURE",
                2 => "",
            ),
            "LIST_PROPERTY_CODE" => array(
                0 => "DEPARTURE_HOUSE",
                1 => "CHILDREN_DOCTOR",
                2 => "DIAGNOSTICS",
                3 => "RANK",
                4 => "MAP",
                5 => "ONLINE",
                6 => "DMC",
                7 => "UMC",
                8 => "METRO",
                9 => "SPECIALIZATION",
                10 => "ADDRESS",
                11 => "DOCTORS",
                12 => "WORK_TIME",
                13 => "CONTACTS",
                14 => "AREA",
                15 => "COST_PRICE",
                16 => "REGION",
                17 => "CITY",
                18 => "DETAIL_PICTURE",
                19 => "",
            ),
            "MESSAGE_404" => "",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "NEWS_COUNT" => "3",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "show_more",
            "PAGER_TITLE" => "Новости",
            "PREVIEW_TRUNCATE_LEN" => "",
            "SEF_FOLDER" => "/doctors/",
            "SEF_MODE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N",
            "USE_CATEGORIES" => "N",
            "USE_FILTER" => "Y",
            "USE_PERMISSIONS" => "N",
            "USE_RATING" => "N",
            "USE_REVIEW" => "N",
            "USE_RSS" => "N",
            "USE_SEARCH" => "N",
            "USE_SHARE" => "N",
            "FILTER_NAME" => "",
            "FILTER_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_PROPERTY_CODE" => array(
                0 => "DEPARTURE_HOUSE",
                1 => "CHILDREN_DOCTOR",
                2 => "DIAGNOSTICS",
                3 => "CATEGORY",
                4 => "MAP",
                5 => "ONLINE",
                6 => "DMC",
                7 => "UMC",
                8 => "METRO",
                9 => "SPECIALIZATION",
                10 => "ADDRESS",
                11 => "DOCTORS",
                12 => "WORK_TIME",
                13 => "CONTACTS",
                14 => "AREA",
                15 => "COST_PRICE",
                16 => "REGION",
                17 => "CITY",
                18 => "",
            ),
            "SEF_URL_TEMPLATES" => array(
                "news" => "",
                "section" => "",
                "detail" => "#ELEMENT_CODE#/",
            )
        ),
        false
    );?>
</section>
<div class="clinic-card-full-desc">
    <div class="clinic-card-full-desc__tabs">
        <ul>
            <li class="active" data-tabs="1">Информация</li>
            <li data-tabs="2">Отзывы<span><?=$arRaing['COUNT']?></span></li>
            <?if($arResult["PROPERTIES"]["STOCKS"]["VALUE"]):?>
                <li data-tabs="3">Акции<span><?=count($arResult["PROPERTIES"]["STOCKS"]["VALUE"])?></span></li>
            <?endif;?>
            <?if($arResult["PROPERTIES"]["PRICE_DOCTOR"]["VALUE"]):?>
                <li data-tabs="4">Цены<span><?=count($arResult["PROPERTIES"]["PRICE_DOCTOR"]["VALUE"])?></span></li>
            <?endif;?>
        </ul>
    </div>
    <div class="clinic-card-full-desc__content active" data-tabs="1">
        <div class="clinic-card-full-desc__content__info">
            <div class="clinic-card-full-desc__content__info-left">
                <div class="clinic-card-full-desc__content__info-left__map" id="map_view_<?=$arResult['ID']?>">
                </div>
                <div class="clinic-card-full-desc__content__info-left__phone">
                    <?if($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]):?>
                        <span class="clinic-card-full-desc__content__info-left__phone__text">Телефон для записи</span>
                        <a href="tel:<?=$arResult["PROPERTIES"]["CONTACTS"]["VALUE"][0]?>"><?=$arResult["PROPERTIES"]["CONTACTS"]["VALUE"][0]?></a>
                    <?endif;?>
                </div>
                <div class="clinic-card-full-desc__content__info-left__adress">
                    <span class="clinic-card-full-desc__content__info-left__adress__text"><?if($arItem["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?><?}?></span>
                    <ul class="clinic-card__metro-list">
                        <?foreach ($arResult["DISPLAY_PROPERTIES"]["METRO"]["DISPLAY_VALUE"] as $key => $item){?>
                            <li class="clinic-card_metro-list-item <?if(($key % 2)==0 && $key!=0){?>metro1<?}elseif(($key % 3)==0||$key===0){?>metro2<?}else{?>metro3<?}?>"><?=$item?></li>
                        <?}?>
                    </ul>
                </div>
                <div class="clinic-card-full-desc__content__info-left__name">
                    <?if($arResult["PROPERTIES"]["OFFICIAL_NAME"]["VALUE"]):?>
                        <span class="clinic-card-full-desc__content__info-left__name__text">Официальное название</span>
                        <p><?=$arResult["PROPERTIES"]["OFFICIAL_NAME"]["VALUE"]?></p>
                    <?endif;?>
                </div>
                <div class="clinic-card-full-desc__content__info-left__head">
                    <?if($arResult["PROPERTIES"]["DIRECTOR"]["VALUE"]):?>
                        <span class="clinic-card-full-desc__content__info-left__head__text">Руководитель</span>
                        <p><?=$arResult["PROPERTIES"]["DIRECTOR"]["VALUE"]?></p>
                    <?endif;?>
                </div>
                <div class="clinic-card-full-desc__content__info-left__facilities">
                    <ul>
                        <?if($arResult["PROPERTIES"]["GUEST_PARKING"]["VALUE"]=='Y'):?>
                            <li class="icon1"><?=$arResult["PROPERTIES"]["GUEST_PARKING"]["NAME"]?></li>
                        <?endif;?>
                        <?if($arResult["PROPERTIES"]["PAY"]["VALUE"]!=NULL):?>
                            <li class="icon2"><?=$arResult["PROPERTIES"]["PAY"]["VALUE"]?></li>
                        <?endif;?>
                        <?if($arResult["PROPERTIES"]["AGE"]["VALUE"]!=NULL):?>
                            <li class="icon3"><?=$arResult["PROPERTIES"]["AGE"]["VALUE"]?></li>
                        <?endif;?>
                        <?if($arResult["PROPERTIES"]["SITE"]["VALUE"]!=NULL):?>
                            <li class="icon4"><a href="<?=$arResult["PROPERTIES"]["SITE"]["VALUE"]?>"><?=$arResult["PROPERTIES"]["GUEST_PARKING"]["NAME"]?></a></li>
                        <?endif;?>
                        <?if($arResult["PROPERTIES"]["LICENSE"]["VALUE"]=='Y'):?>
                            <li class="icon5"><?=$arResult["PROPERTIES"]["LICENSE"]["NAME"]?></li>
                        <?endif;?>
                    </ul>
                </div>
            </div>
            <div class="clinic-card-full-desc__content__info-right">
                <?if($arResult['DETAIL_TEXT']!=NULL):?>
                <div class="clinic-card-full-desc__content__info-right__desc">
                    <h4 class="title-h4">Описание</h4>
                    <p><?=htmlspecialchars_decode($arResult['DETAIL_TEXT'])?></p>
                </div>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["SERVICES"]["VALUE"]!=NULL):?>
                    <div class="clinic-card-full-desc__content__info-right__services">
                        <h4 class="title-h4">Услуги</h4>
                        <p><?=$arResult["PROPERTIES"]["SERVICES"]["VALUE"]['TEXT']?></p>
                    </div>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["PARKING"]["VALUE"]!=NULL):?>
                    <div class="clinic-card-full-desc__content__info-right__parking">
                        <h4 class="title-h4">Парковка</h4>
                        <p><?=htmlspecialchars_decode($arResult["PROPERTIES"]["PARKING"]["VALUE"]['TEXT'])?></p>
                    </div>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["DIRECITONS"]["VALUE"]!=NULL):?>
                    <div class="clinic-card-full-desc__content__info-right__transit">
                        <h4 class="title-h4">Проезд</h4>
                        <p><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DIRECITONS"]["VALUE"]['TEXT'])?></p>
                    </div>
                <?endif;?>
            </div>
        </div>
    </div>
    <div class="clinic-card-full-desc__content" data-tabs="2">
        <?$APPLICATION->IncludeComponent(
	"api:reviews",
	"custom",
	array(
		"CACHE_TIME" => "31536000",
		"CACHE_TYPE" => "A",
		"COLOR" => "blue",
		"DETAIL_HASH" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_ID" => $arResult["ID"],
		"EMAIL_TO" => "",
		"FORM_CITY_VIEW" => "N",
		"FORM_DELIVERY" => array(
		),
		"FORM_DISPLAY_FIELDS" => array(
			0 => "RATING",
			1 => "COMPANY",
			2 => "ADVANTAGE",
			3 => "DISADVANTAGE",
			4 => "ANNOTATION",
			5 => "GUEST_NAME",
			6 => "GUEST_EMAIL",
		),
		"FORM_FORM_SUBTITLE" => "",
		"FORM_FORM_TITLE" => "Отзыв о клинике",
		"FORM_MESS_ADD_REVIEW_ERROR" => "Внимание!<br>Ошибка добавления отзыва",
		"FORM_MESS_ADD_REVIEW_EVENT_TEXT" => "<p>#USER_NAME# добавил(а) новый отзыв (оценка: #RATING#) ##ID#</p>
<p>Открыть в админке #LINK_ADMIN#</p>
<p>Открыть на сайте #LINK#</p>",
		"FORM_MESS_ADD_REVIEW_EVENT_THEME" => "Отзыв о Клинике (оценка: #RATING#) ##ID#",
		"FORM_MESS_ADD_REVIEW_MODERATION" => "Спасибо!<br>Ваш отзыв отправлен на модерацию",
		"FORM_MESS_ADD_REVIEW_VIZIBLE" => "Спасибо!<br>Ваш отзыв №#ID# опубликован",
		"FORM_MESS_EULA" => "Нажимая кнопку «Отправить отзыв», я принимаю условия Пользовательского соглашения и даю своё согласие на обработку моих персональных данных, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях и для целей, определенных Политикой конфиденциальности.",
		"FORM_MESS_EULA_CONFIRM" => "Для продолжения вы должны принять условия Пользовательского соглашения",
		"FORM_MESS_PRIVACY" => "Я согласен на обработку персональных данных",
		"FORM_MESS_PRIVACY_CONFIRM" => "Для продолжения вы должны принять соглашение на обработку персональных данных",
		"FORM_MESS_PRIVACY_LINK" => "",
		"FORM_MESS_STAR_RATING_1" => "Ужасно",
		"FORM_MESS_STAR_RATING_2" => "Плохо",
		"FORM_MESS_STAR_RATING_3" => "Нормально",
		"FORM_MESS_STAR_RATING_4" => "Хорошо",
		"FORM_MESS_STAR_RATING_5" => "Отлично",
		"FORM_PREMODERATION" => "N",
		"FORM_REQUIRED_FIELDS" => array(
			0 => "RATING",
			1 => "ANNOTATION",
		),
		"FORM_RULES_LINK" => "http://doc.btx.bz/rules/",
		"FORM_RULES_TEXT" => "Правила публикации отзывов",
		"FORM_SHOP_BTN_TEXT" => "Оставить свой отзыв",
		"FORM_SHOP_TEXT" => "Отзывы о клиние",
		"FORM_USE_EULA" => "Y",
		"FORM_USE_PRIVACY" => "Y",
		"IBLOCK_ID" => "",
		"INCLUDE_CSS" => "Y",
		"INCLUDE_JQUERY" => "jquery2",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_ITEMS_LIMIT" => "10",
		"LIST_MESS_ADD_UNSWER_EVENT_TEXT" => "#USER_NAME#, здравствуйте! 
К Вашему отзыву добавлен официальный ответ, для просмотра перейдите по ссылке #LINK#",
		"LIST_MESS_ADD_UNSWER_EVENT_THEME" => "Официальный ответ к вашему отзыву",
		"LIST_MESS_HELPFUL_REVIEW" => "Отзыв полезен?",
		"LIST_MESS_TRUE_BUYER" => "Проверенный покупатель",
		"LIST_SET_TITLE" => "N",
		"LIST_SHOP_NAME_REPLY" => "Интернет-магазин DOC.BTX.BZ",
		"LIST_SHOW_THUMBS" => "N",
		"LIST_SORT_FIELDS" => array(
			0 => "ACTIVE",
			1 => "ACTIVE_FROM",
			2 => "RATING",
			3 => "THUMBS",
		),
		"LIST_SORT_FIELD_1" => "ACTIVE_FROM",
		"LIST_SORT_FIELD_2" => "DATE_CREATE",
		"LIST_SORT_FIELD_3" => "ID",
		"LIST_SORT_ORDER_1" => "DESC",
		"LIST_SORT_ORDER_2" => "DESC",
		"LIST_SORT_ORDER_3" => "DESC",
		"MESSAGE_404" => "",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "31536000",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_THEME" => "blue",
		"PAGER_TITLE" => "Отзывы",
		"PICTURE" => array(
		),
		"RESIZE_PICTURE" => "48x48",
		"SECTION_ID" => "",
		"SEF_MODE" => "N",
		"SET_STATUS_404" => "N",
		"SHOP_NAME" => "DOC.BTX.BZ",
		"SHOW_404" => "N",
		"STAT_MESS_CUSTOMER_RATING" => "На основе #N# оценок покупателей",
		"STAT_MESS_CUSTOMER_REVIEWS" => "Отзывы покупателей <span class=\"api-reviews-count\"></span>",
		"STAT_MESS_TOTAL_RATING" => "Рейтинг покупателей",
		"STAT_MIN_AVERAGE_RATING" => "5",
		"THEME" => "aspro",
		"THUMBNAIL_HEIGHT" => "72",
		"THUMBNAIL_WIDTH" => "114",
		"UPLOAD_FILE_LIMIT" => "8",
		"UPLOAD_FILE_SIZE" => "10M",
		"UPLOAD_FILE_TYPE" => "",
		"UPLOAD_VIDEO_LIMIT" => "8",
		"URL" => "",
		"USE_FORM_MESS_FIELD_PLACEHOLDER" => "N",
		"USE_MESS_FIELD_NAME" => "N",
		"USE_STAT" => "Y",
		"USE_SUBSCRIBE" => "N",
		"USE_USER" => "N",
		"COMPONENT_TEMPLATE" => "custom",
		"VARIABLE_ALIASES" => array(
			"review_id" => "review_id",
			"user_id" => "user_id",
		)
	),
	false
);?>
    </div>
    <div class="clinic-card-full-desc__content" data-tabs="3">
        <div class="clinic-card-full-desc__content__actions">
            <h4 class="title-h4">Акции</h4>
            <?foreach ($arResult["PROPERTIES"]["STOCKS"]["VALUE"] as $item){
                $arSelect = Array();
                $arFilter = Array("IBLOCK_ID"=>16, "ID"=>$item, "ACTIVE" => "Y");
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

                while($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $arProps = $ob->GetProperties();
                    ?>
                    <div class="clinic-card-full-desc__content__actions-item">
                        <p class="clinic-card-full-desc__content__actions-item__title"><?=$arFields['NAME']?></p>
                        <div class="clinic-card-full-desc__content__actions-item-range-block">
                            <span class="clinic-card-full-desc__content__actions-item-range-block__range"><?=$arFields['ACTIVE_FROM']?> — <?=$arFields['ACTIVE_TO']?></span>
                            <?if($arFields['ACTIVE_TO'] == date('d.m.Y')){?>
                                <p class="clinic-card-full-desc__content__actions-item-range-block__time">Заканчивается сегодня</p>
                            <?}?>
                        </div>
                        <div class="clinic-card-full-desc__content__actions-item__desc">
                            <p class="clinic-card-full-desc__content__actions-item__desc__title">
                                <?=$arFields['PREVIEW_TEXT']?>
                            </p>
                            <p class="clinic-card-full-desc__content__actions-item__desc__price">Цена без скидки: <span><?=$arProps['FULL_PRICE']['VALUE']?></span></p>
                            <p class="clinic-card-full-desc__content__actions-item__desc__price">Цена со скидкой: <span><?=$arProps['DISCONT_PRICE']['VALUE']?></span></p>
                        </div>
                        <div class="clinic-card-full-desc__content__actions-item__phone">
                            <span class="clinic-card-full-desc__content__actions-item__phone__text">Телефон для записи</span>
                            <a href="tel:+812245-61-20"><?=$arProps['PHONE']['VALUE']?></a>
                        </div>
                        <hr>
                    </div>
                <?}
            }?>
            <div class="load_more">
                Показать ещё
            </div>
        </div>
    </div>
    <div class="clinic-card-full-desc__content" data-tabs="4">
        <div class="clinic-card-full-desc__content__price">
            <h4 class="title-h4">Цены на приём специалистов</h4>
            <?foreach ($arResult["PROPERTIES"]["PRICE_DOCTOR"]["VALUE"] as $item){
                $price = explode('/',$item);
                $doctorPrice[$price[0]][] = array('SERVICE'=>$price[1],'PRICE'=>$price[2]);
            } ?>
             <?foreach ($doctorPrice as $key => $doctor){?>
                 <div class="clinic-card-full-desc__content__price-item">
                     <table>
                         <thead>
                         <tr>
                             <td><?=$key?></td>
                         </tr>
                         </thead>
                         <tbody>
                         <?foreach ($doctor as $item){?>
                         <tr>
                             <td><?=$item['SERVICE']?></td>
                             <td class="clinic-card-full-desc__content__price-item__price"><?=$item['PRICE']?> ₽</td>
                             <td><button>Запись на услугу</button></td>
                         </tr>
                         <?}?>
                         </tbody>
                     </table>
                     <hr/>
                 </div>
            <?}?>
        </div>
    </div>
</div>
</div>