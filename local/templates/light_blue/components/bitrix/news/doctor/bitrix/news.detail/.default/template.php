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
                    <a id="header-mess" style="cursor:pointer;">Написать доктору</a>
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
                <?if($arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"]):?>
                    <p class="doctor-card__clinic-adress"><?=$arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"]?></p>
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
                <a href="" class="doctor-card__metro-list-show_more">ещё адреса приёма</a>
                </div>
            </div>
        </div>
        <div class="doctor-card-popUp-group">
            <a id="header-reception" class="doctor-card-popUp-group__reception"><span>Записаться на прием</span></a>
			<a id="header-call" class="doctor-card-popUp-group__call"><span>Вызвать врача на дом</span></a>
            <?if($arResult["PROPERTIES"]["MAP"]["VALUE"]):?>
			    <a class="doctor-card-popUp-group__route popup-link"><span>Проложить маршрут</span></a>
            <?endif;?>
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
            <p class="doctor-card__img-info-commend"><?=$arRaing['PERCENT']?> пациентов рекомендуют врача на основе <?=$arRaing['COUNT']?> отзывов(а)<a href="">Все отзывы о враче</a></p>
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
                    <div class="map-popup-marker" id="map_<?=$arResult['ID']?>"  style="width: 100%; height: 500px;"></div>
                    <div class="map-popup" id="map_track_<?=$arResult["ID"]?>"  style="width: 100%; height: 500px;"></div>
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
<section class="container choosing-time">
    <h3 class="title-h3">Выберите время приема для записи онлайн</h3>
    <div class="choosing-time_block">
        <!-- <span class="choosing-time_block__arrows arrow-left"></span> -->
        <ul class="choosing-time_block-list slick-slider3">
            <li class="choosing-time_block-list-item active">Сегодня</br> 6 апреля</li>
            <li class="choosing-time_block-list-item">Завтра</br> 7 апреля</li>
            <li class="choosing-time_block-list-item">Среда</br> 8 апреля</li>
            <li class="choosing-time_block-list-item not-worked">Четверг</br> 9 апреля</li>
            <li class="choosing-time_block-list-item">Пятница</br> 10 апреля</li>
            <li class="choosing-time_block-list-item">Cуббота</br> 11 апреля</li>
        </ul>
        <!-- <span class="choosing-time_block__arrows arrow-right"></span> -->
    </div>
    <ul class="choosing-time__worktimming-list">
        <li class="choosing-time__worktimming-list-item">09:00</li>
        <li class="choosing-time__worktimming-list-item closed">09:40</li>
        <li class="choosing-time__worktimming-list-item closed">10:10</li>
        <li class="choosing-time__worktimming-list-item pass">10:50</li>
        <li class="choosing-time__worktimming-list-item">11:30</li>
        <li class="choosing-time__worktimming-list-item">12:10</li>
        <li class="choosing-time__worktimming-list-item">12:50</li>
        <li class="choosing-time__worktimming-list-item">13:30</li>
        <li class="choosing-time__worktimming-list-item">14:10</li>
        <li class="choosing-time__worktimming-list-item pass">14:50</li>
        <li class="choosing-time__worktimming-list-item pass">15:30</li>
        <li class="choosing-time__worktimming-list-item">16:00</li>
        <li class="choosing-time__worktimming-list-item">16:40</li>
        <li class="choosing-time__worktimming-list-item closed">17:20</li>
        <li class="choosing-time__worktimming-list-item">18:00</li>
        <li class="choosing-time__worktimming-list-item closed">18:40</li>
        <li class="choosing-time__worktimming-list-item">19:00</li>
    </ul>
</section>
<section class="container checked-feedback">
    <h2 class="title-h2">Проверенные отзывы о враче</h2>
    <?$APPLICATION->IncludeComponent(
	"api:reviews",
	"custom_doctor",
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
		"INCLUDE_JQUERY" => "jquery",
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
		"COMPONENT_TEMPLATE" => "custom_doctor",
		"VARIABLE_ALIASES" => array(
			"review_id" => "review_id",
			"user_id" => "user_id",
		)
	),
	false
);?>
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
