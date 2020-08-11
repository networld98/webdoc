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
?>
    <style>
        .clinic-card-desc__clinic-name {
            width: calc(100% - 26px);
        }
    </style>
    <section class="container">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
            "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
            "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
            "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        ),
            false
        );?>
    </section>
<?$APPLICATION->ShowViewContent('filterTitle');?>
<div class="list-item clinic-list container">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="clinic-card-item card-item">
            <div class="clinic-card-img">
                <div class="clinic-card-im-flex-right">
                    <div class="clinic-card-img__img">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <?if($arItem["PROPERTIES"]["LOGO"]["VALUE"]){
                                ?>
                                <img src="<?= CFile::GetPath($arItem["PROPERTIES"]["LOGO"]["VALUE"]); ?>" alt='"<?=$arItem["NAME"]?>'>
                            <?}else{?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/icon/hospital_building.svg" alt="нет лого">
                            <?}?>
                        </a>
                    </div>
                    <?if(CModule::IncludeModule('api.reviews')) {$arRaing = CApiReviews::getElementRating($arItem['ID']);} ?>
                    <div class="clinic-card-img__ratings">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'1%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'21%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'41%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'61%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'81%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                    </div>
                    <a class="clinic-card-img__link" href="#"><?=$arRaing['COUNT']?> отзывов</a>
                </div>
                <div class="clone-adapt">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <p class="clinic-card-desc__clinic-name"><?=$arItem["NAME"]?></p>
                    </a>
                    <?if($arItem["DISPLAY_PROPERTIES"]["COST_PRICE"]["DISPLAY_VALUE"]):?>
                        <p class="clinic-card-desc__price">Первичная стоимость приёма - <span><?=$arItem["DISPLAY_PROPERTIES"]["COST_PRICE"]["DISPLAY_VALUE"]?></span></p>
                    <?endif;?>
                    <?if($arItem["PROPERTIES"]["SPECIALIZATION"]["VALUE"]):?>
                        <ul class="clinic-card-desc__spec-list">
                            <?foreach ($arItem["PROPERTIES"]["SPECIALIZATION"]["VALUE"] as $item){
                                $res = CIBlockElement::GetByID($item);
                                if($ar_res = $res->GetNext()){?>
                                    <li><a href="#"><?=$ar_res['NAME']?></a></li>
                                <?}
                            }?>
                        </ul>
                    <?endif;?>
                </div>
            </div>
            <div class="clinic-card-desc">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                  <p class="clinic-card-desc__clinic-name"><?=$arItem["NAME"]?></p>
                </a>
                <?if($arItem["DISPLAY_PROPERTIES"]["COST_PRICE"]["DISPLAY_VALUE"]):?>
                    <p class="clinic-card-desc__price">Первичная стоимость приёма - <span><?=$arItem["DISPLAY_PROPERTIES"]["COST_PRICE"]["DISPLAY_VALUE"]?></span></p>
                <?endif;?>
                <?if($arItem["PROPERTIES"]["SPECIALIZATION"]["VALUE"]):?>
                    <ul class="clinic-card-desc__spec-list list-2">
                        <?foreach ($arItem["PROPERTIES"]["SPECIALIZATION"]["VALUE"] as $item){
                            $res = CIBlockElement::GetByID($item);
                            if($ar_res = $res->GetNext()){?>
                                <li><a href="#"><?=$ar_res['NAME']?></a></li>
                            <?}
                        }?>
                    </ul>
                <?endif;?>
                <p class="clinic-card-desc__about"><?=$arItem["PREVIEW_TEXT"]?></p>
                <?
                $arFilter = Array("IBLOCK_ID"=>"10","ACTIVE"=>"Y", "PROPERTY_CLINIK" =>$arItem['ID']);
                $arSelect = Array("PROPERTY_SPECIALIZATION_MAIN");
                $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
                while($ob = $res->GetNextElement()){
                    $arFields = $ob->GetFields();
                    $specs[] = $arFields['PROPERTY_SPECIALIZATION_MAIN_VALUE'];
                }?>
                <?if($specs){?>
                    <ul class="clinic-card-desc__spec-list">
                        <?foreach ($specs as $spec){
                            $res = CIBlockSection::GetByID($spec);
                            if($ar_res = $res->GetNext()){?>
                                <li><a href=""><?=$ar_res['NAME']?></a></li>
                            <?}
                        }?>
                    </ul>
                <?}?>
                <?if($arItem["PROPERTIES"]["MAP"]["VALUE"]):?>
                    <div class="map-wrapper">
                        <div class="doctor-card-location-map popup-link-marker"></div>
                        <div class="popup-box">
                            <div class="close"></div>
                            <div class="map-popup-marker" id="map_<?=$arItem['ID']?>"  style="width: 100%;"></div>
                            <div class="map-popup"  id="map_track_<?=$arItem["ID"]?>"  style="width: 100%;"></div>
                            <script type="text/javascript">
                                ymaps.ready(init);
                                function init() {
                                    var myMap_<?=$arItem['ID']?> = new ymaps.Map("map_<?=$arItem['ID']?>", {
                                        center: [<?=$arItem["PROPERTIES"]["MAP"]["VALUE"]?>],
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
                                    var myPlacemark_<?=$arItem['ID']?> = new ymaps.Placemark([<?=$arItem["PROPERTIES"]["MAP"]["VALUE"]?>], {
                                        hintContent: '<?=$arItem["NAME"]?>'
                                    });
                                    myMap_<?=$arItem['ID']?>.geoObjects.add(myPlacemark_<?=$arItem['ID']?>);
                                    var myMap_track_<?=$arItem['ID']?> = new ymaps.Map('map_track_<?=$arItem["ID"]?>', {
                                        center: [<?=$arItem["PROPERTIES"]["MAP"]["VALUE"]?>],
                                        zoom: 12,
                                        controls: ['routePanelControl']
                                    });

                                    var control_track_<?=$arItem["ID"]?> = myMap_track_<?=$arItem["ID"]?>.controls.get('routePanelControl');
                                    control_track_<?=$arItem["ID"]?>.routePanel.state.set({
                                        type: 'masstransit',
                                        fromEnabled: true,
                                        toEnabled: false,
                                        to: '<?=$arItem["PROPERTIES"]["MAP"]["VALUE"]?>'
                                    });
                                    control_track_<?=$arItem["ID"]?>.routePanel.options.set({
                                        allowSwitch: false,
                                        reverseGeocoding: true,
                                        types: { masstransit: true, pedestrian: true, taxi: true }
                                    });

                                    var switchPointsButton = new ymaps.control.Button({
                                        data: {content: "Поменять местами", title: "Поменять точки местами"},
                                        options: {selectOnClick: false, maxWidth: 160}
                                    });
                                    switchPointsButton.events.add('click', function () {
                                        control_track_<?=$arItem["ID"]?>.routePanel.switchPoints();
                                    });
                                    myMap_track_<?=$arItem["ID"]?>.controls.add(switchPointsButton);
                                }
                            </script>
                        </div>
                    </div>
                <?endif;?>
            </div>
            <div class="clinic-card-info">
                <div class="grey-block">
                    <div class="clinic-card-info__block">
                        <?if($arItem["DISPLAY_PROPERTIES"]["SPECIALIZATION"]["DISPLAY_VALUE"]):?>
                            <p class="clinic-card-info__title map">Адрес</p>
                            <span><?if($arItem["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?><?}?></span>
                        <?endif;?>
                    </div>
                    <div class="clinic-card-info__block">
                        <?if($arItem["PROPERTIES"]["CONTACTS"]["VALUE"]):?>
                            <p class="clinic-card-info__title contacts-phone">Контакты</p>
                            <?foreach ($arItem["PROPERTIES"]["CONTACTS"]["VALUE"] as $item){?>
                                <span><a href="tel:<?=$item?>"><?=$item?></a></span>
                            <?}?>
                        <?endif;?>
                    </div>
                    <div class="clinic-card-info__block">
                        <?if($arItem["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]!=NULL):?>
                            <p class="clinic-card-info__title time">Время работы</p>
                            <span><?=$arItem["DISPLAY_PROPERTIES"]["WORK_TIME"]["DISPLAY_VALUE"]?></span>
                        <?endif;?>
                    </div>
                    <ul class="doctors-list-item_options-list">
                        <?if($arItem["PROPERTIES"]["DIAGNOSTICS"]["VALUE"]=='Y'):?>
                            <li class="doctors-list-item_options-list-item"><?=$arItem["PROPERTIES"]["DIAGNOSTICS"]["NAME"]?></li>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["CHILDREN_DOCTOR"]["VALUE"]=='Y'):?>
                            <li class="doctors-list-item_options-list-item"><?=$arItem["PROPERTIES"]["CHILDREN_DOCTOR"]["NAME"]?></li>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["DMC"]["VALUE"]=='Y'):?>
                            <li class="doctors-list-item_options-list-item"><?=$arItem["PROPERTIES"]["DMC"]["NAME"]?></li>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["UMC"]["VALUE"]=='Y'):?>
                            <li class="doctors-list-item_options-list-item"><?=$arItem["PROPERTIES"]["UMC"]["NAME"]?></li>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["ONLINE"]["VALUE"]=='Y'):?>
                            <li class="doctors-list-item_options-list-item"><?=$arItem["PROPERTIES"]["ONLINE"]["NAME"]?></li>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["DEPARTURE_HOUSE"]["VALUE"]=='Y'):?>
                            <li class="doctors-list-item_options-list-item"><?=$arItem["PROPERTIES"]["DEPARTURE_HOUSE"]["NAME"]?></li>
                        <?endif;?>
                    </ul>
                </div>
                <?if($arItem["PROPERTIES"]["MAP"]["VALUE"]):?>
                    <div class="doctor-card-popUp-group">
                        <a id="header-map" class="doctor-card-popUp-group__route popup-link"><span>Проложить маршрут</span></a>
                    </div>
                <?endif;?>
            </div>
        </div>
    <?endforeach;?>
</div>
<?if($GLOBALS['titleFilterClinic']!=NULL){?>
<?$this->SetViewTarget('filterTitle');?>
    <div class="container">
        <h2 class="title-h2"><?=$GLOBALS['titleFilterClinic']?> - (<?=$arResult['NAV_RESULT']->NavRecordCount ?>)</h2>
    </div>
<?$this->EndViewTarget();?>
<?}else{?>
    <?$this->SetViewTarget('filterTitle');?>
    <?$this->EndViewTarget();?>
<?}?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>