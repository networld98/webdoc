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
global $clinicName, $clinickId, $clinicMail, $clinicPhone;
$clinicName = $arResult["NAME"];
$clinickId = $arResult["ID"];

$rsUser = CUser::GetByLogin($arResult["PROPERTIES"]["PHONE"]["VALUE"]);
$arUser = $rsUser->Fetch();
if($arUser!=NULL){
    $clinicMail = $arUser['EMAIL'];
    $clinicPhone = $arUser['LOGIN'];
}

function propsClinic($prop){
     if($prop["VALUE"]=='Y'):?>
        <li class="doctors-list-item_options-list-item"><?=$prop["NAME"]?></li>
    <?endif;
}
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
                $file = CFile::ResizeImageGet($arResult["PROPERTIES"]["LOGO"]["VALUE"], array('width'=>153, 'height'=>153), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                <img src="<?= $file['src'] ?>" alt='<?=$arItem["NAME"]?>'>
            <?}else{?>
                <img src="<?= SITE_TEMPLATE_PATH ?>/icon/hospital_building.svg" alt="нет лого">
            <?}?>
        </div>
        <?if(CModule::IncludeModule('api.reviews')) {$arRaing = CApiReviews::getElementRating($arResult['ID']);} ?>
        <div class="clinic-card-img__ratings">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='1'){?>ant-design_star-filled.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='2'){?>ant-design_star-filled.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='3'){?>ant-design_star-filled.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='4'){?>ant-design_star-filled.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='5'){?>ant-design_star-filled.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
        </div>
        <a class="clinic-card-img__link" id="goToOtzivy" href="#otzivy-yakor"><?=$arRaing['COUNT']?> отзывов</a>
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
                    <div class="map-popup-marker" id="map_<?=$arResult['ID']?>"  style="width: 100%;height:500px;"></div>
                    <div class="map-popup" id="map_track_<?=$arResult["ID"]?>"  style="width: 100%;height:500px;"></div>
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
                    <?$this->SetViewTarget('address_clinic');?>
                        <p class="doctors-list-item__clinic-adress"><?if($arResult["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?><?}?></p>
                    <?$this->EndViewTarget();?>
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
                    <p class="clinic-card-info__title time">Время работы</p>
                    <?if($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"] == "Круглосуточно"):?>
                        <span><?=$arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]?></span>
                    <?else:?>
                        <? $work_time = explode(";", $arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]);
                        foreach ($work_time as $day){
                            $time = explode("/", $day);?>
                            <?if(count($time)==2){?>
                                <span><?=$time[0]?> - <?=$time[1]?></span>
                            <?}elseif(count($time)==5){?>
                                <span><?=$time[0]?> -  c <?=$time[1]?>:<?=$time[2]?> до <?=$time[3]?>:<?=$time[4]?></span>
                            <?}?>
                        <?}?>
                    <?endif;?>
                <?endif;?>
            </div>
            <ul class="doctors-list-item_options-list">
                <?propsClinic($arResult["PROPERTIES"]["DIAGNOSTICS"])?>
                <?propsClinic($arResult["PROPERTIES"]["CHILDREN_DOCTOR"])?>
                <?propsClinic($arResult["PROPERTIES"]["DMC"])?>
                <?propsClinic($arResult["PROPERTIES"]["ONLINE"])?>
                <?propsClinic($arResult["PROPERTIES"]["DEPARTURE_HOUSE"])?>
                <?propsClinic($arResult["PROPERTIES"]["HOSPITAL"])?>
                <?propsClinic($arResult["PROPERTIES"]["DAY_HOSPITAL"])?>
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
    <section class="container">
        <button class="review-custom-btn review-custom-btn_custom">
            Оставить свой отзыв
        </button>
    </section>
<div class="clinic-card-full-desc" id="otzivy-yakor">
    <div class="clinic-card-full-desc__tabs">
        <ul>
            <?if($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]!=NULL && $arResult["PROPERTIES"]["OFFICIAL_NAME"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["DIRECTOR"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["GUEST_PARKING"]["VALUE"]!=NULL || $arResult['DETAIL_TEXT']!=NULL || $arResult["PROPERTIES"]["SERVICES"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["PARKING"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["DIRECITONS"]["VALUE"]!=NULL ){?>
                <li class="active" data-tabs="1">Информация</li>
            <?}?>
            <li data-tabs="2" id="openBlockOtzivy"
                <?if($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]==NULL && $arResult["PROPERTIES"]["OFFICIAL_NAME"]["VALUE"]==NULL && $arResult["PROPERTIES"]["DIRECTOR"]["VALUE"]==NULL && $arResult["PROPERTIES"]["GUEST_PARKING"]["VALUE"]==NULL && $arResult['DETAIL_TEXT']==NULL && $arResult["PROPERTIES"]["SERVICES"]["VALUE"]==NULL && $arResult["PROPERTIES"]["PARKING"]["VALUE"]==NULL && $arResult["PROPERTIES"]["DIRECITONS"]["VALUE"]==NULL ){?>
                    class="active"
                <?}?>>Отзывы<span><?=$arRaing['COUNT']?></span></li>
            <?if($arResult["PROPERTIES"]["STOCKS"]["VALUE"]):?>
                <li data-tabs="3">Акции<span><?=count($arResult["PROPERTIES"]["STOCKS"]["VALUE"])?></span></li>
            <?endif;?>
            <?if($arResult["PROPERTIES"]["PRICE_DOCTOR"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["PRICE_DIAGNOST"]["VALUE"]!=NULL):?>
                <?if($arResult["PROPERTIES"]["PRICE_DOCTOR"]["VALUE"][0]!=NULL){
                    $countUslug = count($arResult["PROPERTIES"]["PRICE_DOCTOR"]["VALUE"]);
                }
                if($arResult["PROPERTIES"]["PRICE_DIAGNOST"]["VALUE"][0]!=NULL){
                    $countDiagnost = count($arResult["PROPERTIES"]["PRICE_DIAGNOST"]["VALUE"]);
                }?>
                <li data-tabs="4">Цены<span><?=$countUslug + $countDiagnost?></span></li>
            <?endif;?>
        </ul>
    </div>
        <div class="clinic-card-full-desc__content
           <?if($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["OFFICIAL_NAME"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["DIRECTOR"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["GUEST_PARKING"]["VALUE"]!=NULL || $arResult['DETAIL_TEXT']!=NULL || $arResult["PROPERTIES"]["SERVICES"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["PARKING"]["VALUE"]!=NULL || $arResult["PROPERTIES"]["DIRECITONS"]["VALUE"]!=NULL ){?>
                        active
            <?}?>" data-tabs="1">
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
                            <span class="clinic-card-full-desc__content__info-left__name__text"><?=$arResult["PROPERTIES"]["OFFICIAL_NAME"]["NAME"]?></span>
                            <p><?=$arResult["PROPERTIES"]["OFFICIAL_NAME"]["VALUE"]?></p>
                        <?endif;?>
                    </div>
                    <div class="clinic-card-full-desc__content__info-left__head">
                        <?if($arResult["PROPERTIES"]["DIRECTOR"]["VALUE"]):?>
                            <span class="clinic-card-full-desc__content__info-left__head__text"><?=$arResult["PROPERTIES"]["DIRECTOR"]["NAME"]?></span>
                            <p><?=$arResult["PROPERTIES"]["DIRECTOR"]["VALUE"]?></p>
                        <?endif;?>
                    </div>
                    <div class="clinic-card-full-desc__content__info-left__facilities">
                        <ul>
                            <?if($arResult["PROPERTIES"]["GUEST_PARKING"]["VALUE"]=='Y'):?>
                                <li class="icon1"><?=$arResult["PROPERTIES"]["GUEST_PARKING"]["NAME"]?></li>
                            <?endif;?>
                            <?if($arResult["PROPERTIES"]["PAY_MONEY"]["VALUE"] == 'Y' || $arResult["PROPERTIES"]["PAY_CARD"]["VALUE"] == 'Y'):?>
                                <li class="icon2">
                                    <?if($arResult["PROPERTIES"]["PAY_MONEY"]["VALUE"] == 'Y'){ echo $arResult["PROPERTIES"]["PAY_MONEY"]["NAME"];}?><?if($arResult["PROPERTIES"]["PAY_MONEY"]["VALUE"] == 'Y' && $arResult["PROPERTIES"]["PAY_CARD"]["VALUE"] == 'Y'){?>, <?}?>
                                    <?if($arResult["PROPERTIES"]["PAY_CARD"]["VALUE"] == 'Y'){
                                        if($arResult["PROPERTIES"]["PAY_MONEY"]["VALUE"] == 'Y' && $arResult["PROPERTIES"]["PAY_CARD"]["VALUE"] == 'Y'){
                                            echo mb_strtolower($arResult["PROPERTIES"]["PAY_CARD"]["NAME"]);
                                        }else{
                                            echo $arResult["PROPERTIES"]["PAY_CARD"]["NAME"];
                                        }
                                    }?>
                                </li>
                            <?endif;?>
                            <?if($arResult["PROPERTIES"]["CHILD"]["VALUE"] == 'Y' || $arResult["PROPERTIES"]["ADULT"]["VALUE"] == 'Y'):?>
                                <li class="icon3">
                                    <?if($arResult["PROPERTIES"]["CHILD"]["VALUE"] == 'Y'){ echo $arResult["PROPERTIES"]["CHILD"]["NAME"];}?><?if($arResult["PROPERTIES"]["CHILD"]["VALUE"] == 'Y' && $arResult["PROPERTIES"]["ADULT"]["VALUE"] == 'Y'){?>, <?}?>
                                    <?if($arResult["PROPERTIES"]["ADULT"]["VALUE"] == 'Y'){
                                        if($arResult["PROPERTIES"]["CHILD"]["VALUE"] == 'Y' && $arResult["PROPERTIES"]["ADULT"]["VALUE"] == 'Y'){
                                            echo mb_strtolower($arResult["PROPERTIES"]["ADULT"]["NAME"]);
                                        }else{
                                            echo $arResult["PROPERTIES"]["ADULT"]["NAME"];
                                        }
                                    }?>
                                </li>
                            <?endif;?>
                            <?if($arResult["PROPERTIES"]["SITE"]["VALUE"]!=NULL):?>
                                <li class="icon4"><a href="<?=$arResult["PROPERTIES"]["SITE"]["VALUE"]?>"><?=$arResult["PROPERTIES"]["GUEST_PARKING"]["NAME"]?></a></li>
                            <?endif;?>
                            <?if($arResult["PROPERTIES"]["WIFI"]["VALUE"]!=NULL):?>
                                <li class="icon7"><a href="<?=$arResult["PROPERTIES"]["SITE"]["VALUE"]?>"><?=$arResult["PROPERTIES"]["WIFI"]["NAME"]?></a></li>
                            <?endif;?>
                            <?if($arResult["PROPERTIES"]["SMS_MESSAGE"]["VALUE"]!=NULL):?>
                                <li class="icon6"><a href="<?=$arResult["PROPERTIES"]["SITE"]["VALUE"]?>"><?=$arResult["PROPERTIES"]["SMS_MESSAGE"]["NAME"]?></a></li>
                            <?endif;?>
                            <?if($arResult["PROPERTIES"]["EMAIL_MESSAGE"]["VALUE"]!=NULL):?>
                                <li class="icon4"><a href="<?=$arResult["PROPERTIES"]["SITE"]["VALUE"]?>"><?=$arResult["PROPERTIES"]["EMAIL_MESSAGE"]["NAME"]?></a></li>
                            <?endif;?>
                            <?if($arResult["PROPERTIES"]["LICENSE"]["VALUE"]):?>
                                <li class="icon5"><a href="<?=CFile::GetPath($arResult["PROPERTIES"]["LICENSE"]["VALUE"])?>"><?=$arResult["PROPERTIES"]["LICENSE"]["NAME"]?></a></li>
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
                            <p><?=htmlspecialchars_decode($arResult["PROPERTIES"]["SERVICES"]["VALUE"]['TEXT'])?></p>
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
    <div class="otzivy-block clinic-card-full-desc__content
    <?if($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]==NULL && $arResult["PROPERTIES"]["OFFICIAL_NAME"]["VALUE"]==NULL && $arResult["PROPERTIES"]["DIRECTOR"]["VALUE"]==NULL && $arResult["PROPERTIES"]["GUEST_PARKING"]["VALUE"]==NULL && $arResult['DETAIL_TEXT']==NULL && $arResult["PROPERTIES"]["SERVICES"]["VALUE"]==NULL && $arResult["PROPERTIES"]["PARKING"]["VALUE"]==NULL && $arResult["PROPERTIES"]["DIRECITONS"]["VALUE"]==NULL ){?>
                active
    <?}?>" data-tabs="2" >
        <?
        if(CModule::IncludeModule('api.uncachedarea'))
        {
            CAPIUncachedArea::includeFile(
                "/clinics/reviews.php",
                array(
                    'ID' => $arResult['ID'],
                    'NAME' => $arResult['NAME'],
                )
            );
        }
        ?>
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
            <?foreach ($arResult["PROPERTIES"]["PRICE_DIAGNOST"]["VALUE"] as $item){
                $price = explode('/',$item);
                $diagnistPrice[$price[0]][] = array('SERVICE'=>$price[1],'PRICE'=>$price[2]);
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
                         <?foreach ($doctor as $i => $item){?>
                         <tr>
                             <td><?=$item['SERVICE']?></td>
                             <td class="clinic-card-full-desc__content__price-item__price"><?=$item['PRICE']?> ₽</td>
                             <td><button class="popup-service-click popup-service-click-one-<?=$i?>-<?=$key?>" data-service="<?=$key?> (<?=$item['SERVICE']?>)">Запись на услугу</button></td>
                         </tr>
                             <script>
                                 $(document).ready(function () {
                                     $(".popup-service-click-one-<?=$i?>-<?=$key?>").click(function () {
                                         let service = $(this).data('service');
                                         $('#option_service').val(service);
                                     });
                                 });
                             </script>
                         <?}?>
                         </tbody>
                     </table>
                     <hr/>
                 </div>
            <?}?>
            <?foreach ($diagnistPrice as $key => $doctor){?>
                <div class="clinic-card-full-desc__content__price-item">
                    <table>
                        <thead>
                        <tr>
                            <td><?=$key?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach ($doctor as $i => $item){?>
                            <tr>
                                <td><?=$item['SERVICE']?></td>
                                <td class="clinic-card-full-desc__content__price-item__price"><?=$item['PRICE']?> ₽</td>
                                <td><button class="popup-service-click popup-service-click-two-<?=$i?>-<?=$key?>" data-service="<?=$key?> (<?=$item['SERVICE']?>)">Запись на услугу</button></td>
                            </tr>
                            <script>
                                $(document).ready(function () {
                                    $(".popup-service-click-two-<?=$i?>-<?=$key?>").click(function () {
                                        let service = $(this).data('service');
                                        $('#option_service').val(service);
                                    });
                                });
                            </script>
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
<div class="call-popup">
    <div class="popup-box popup-scroll">
        <div class="close"></div>
        <div class="doctors-list clinic-popup call" style="width: 100%;">
            <div class="doctors-list-item">
                <div class="flex-content">
                    <a href="/" class="logo">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo">
                    </a>
                    <div class="flex-left">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="clinic-card-desc__clinic-name"><?=$arResult["NAME"]?></p>
                            </div>
                            <div class="col-4">
                                <div class="clinic-popup_img">
                                    <?if($arResult["PROPERTIES"]["LOGO"]["VALUE"]){
                                        ?>
                                        <img src="<?= CFile::GetPath($arResult["PROPERTIES"]["LOGO"]["VALUE"]); ?>" alt='<?=$arResult["NAME"]?>'>
                                    <?}else{?>
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/icon/hospital_building.svg" alt="нет лого">
                                    <?}?>
                                    <?if(CModule::IncludeModule('api.reviews')) {$arRaing = CApiReviews::getElementRating($arResult['ID']);} ?>
                                </div>
                                <div class="clinic-card-img__ratings text-center">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='1'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='2'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='3'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='4'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='5'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                </div>
                                <a class="clinic-card-img__link" id="goToOtzivy" href="#otzivy-yakor"><?=$arRaing['COUNT']?> отзывов</a>
                            </div>
                            <div class="col-8 no-padding">
                                <div class="row no-margin">
                                    <?if($arResult["DISPLAY_PROPERTIES"]["COST_PRICE"]["DISPLAY_VALUE"]):?>
                                        <div class="col-12 no-padding">
                                            <p class="clinic-card-desc__price">Первичная стоимость приёма - <span><?=$arResult["DISPLAY_PROPERTIES"]["COST_PRICE"]["DISPLAY_VALUE"]?></span></p>
                                        </div>
                                    <?endif;?>
                                    <?if($arResult["DISPLAY_PROPERTIES"]["SPECIALIZATION"]["DISPLAY_VALUE"]):?>
                                        <div class="col-12 col-margin no-padding">
                                            <p class="clinic-card-info-detail__title map">Адрес</p>
                                            <span><?if($arResult["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]?>, <?}?><?if($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]){?><?=$arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?><?}?></span>
                                        </div>
                                    <?endif;?>
                                    <?if($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]):?>
                                        <div class="col-6 col-margin no-padding">
                                            <p class="clinic-card-info-detail__title contacts-phone">Контакты</p>
                                            <?foreach ($arResult["PROPERTIES"]["CONTACTS"]["VALUE"] as $item){?>
                                                <span><a href="tel:<?=$item?>"><?=$item?></a></span>
                                            <?}?>
                                        </div>
                                    <?endif;?>
                                    <?if($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]!=NULL):?>
                                        <div class="col-6 col-margin no-padding">
                                            <p class="clinic-card-info__title time">Время работы</p>
                                            <?if($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"] == "Круглосуточно"):?>
                                                <span><?=$arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]?></span>
                                            <?else:?>
                                                <? $work_time = explode(";", $arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]);
                                                foreach ($work_time as $day){
                                                    $time = explode("/", $day);?>
                                                    <?if(count($time)==2){?>
                                                        <span><?=$time[0]?> - <?=$time[1]?></span>
                                                    <?}elseif(count($time)==5){?>
                                                        <span><?=$time[0]?> -  c <?=$time[1]?>:<?=$time[2]?> до <?=$time[3]?>:<?=$time[4]?></span>
                                                    <?}?>
                                                <?}?>
                                            <?endif;?>
                                        </div>
                                    <?endif;?>
                                    <div class="col-12 col-margin no-padding">
                                        <ul class="doctors-list-item_options-list">
                                            <?propsClinic($arResult["PROPERTIES"]["DIAGNOSTICS"])?>
                                            <?propsClinic($arResult["PROPERTIES"]["CHILDREN_DOCTOR"])?>
                                            <?propsClinic($arResult["PROPERTIES"]["DMC"])?>
                                            <?propsClinic($arResult["PROPERTIES"]["ONLINE"])?>
                                            <?propsClinic($arResult["PROPERTIES"]["DEPARTURE_HOUSE"])?>
                                            <?propsClinic($arResult["PROPERTIES"]["HOSPITAL"])?>
                                            <?propsClinic($arResult["PROPERTIES"]["DAY_HOSPITAL"])?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-right">
                    <h2 class="title-h2">Запись на услугу</h2>
                    <?$APPLICATION->IncludeComponent("bitrix:form.result.new","clinic_service",Array(
                            "SEF_MODE" => "N",
                            "WEB_FORM_ID" => "7",
                            "AJAX_MODE" => "Y",
                            "AJAX_OPTION_SHADOW" => "N",
                            "AJAX_OPTION_JUMP" => "Y",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "LIST_URL" => "result_list.php",
                            "EDIT_URL" => "result_edit.php",
                            "SUCCESS_URL" => "",
                            "CHAIN_ITEM_TEXT" => "",
                            "CHAIN_ITEM_LINK" => "",
                            "IGNORE_CUSTOM_TEMPLATE" => "Y",
                            "USE_EXTENDED_ERRORS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "SEF_FOLDER" => "/",
                            "VARIABLE_ALIASES" => Array(
                            )
                        )
                    );?>
                </div>
            </div>
        </div>
    </div>
</div>