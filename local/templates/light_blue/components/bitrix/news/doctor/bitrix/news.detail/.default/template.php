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
require($_SERVER["DOCUMENT_ROOT"].'/include/terminationEx.php');
global $doctorPhone;
global $doctorEmail;
global $doctorSpecialization;
global $noneClinic;
global $doctorClinic;
global $doctorName;
global $doctorId;
global $doctorTime;
global $doctorId;
global $period;
$doctorName = $arResult['NAME'];
$doctorId = $arResult['ID'];
$doctorTime = $arResult["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"];
?>
<?function formRecord($arResult, $mobileTitle){?>
    <div class="doctors-list-item__img">
        <?if($arResult['DETAIL_PICTURE']!=NULL){?>
        <div style="background-image: url('<?= $arResult['DETAIL_PICTURE']['SRC'] ?>')" class="doctors-list-item__img-photo doctor-card__img-link photo-back-image photo-back-image">
            <?}elseif($arResult['PROPERTIES']['GENDER']['VALUE']==NULL || $arResult['PROPERTIES']['GENDER']['VALUE']=="Мужчина" ){?>
            <div style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/male.svg')" class="doctors-list-item__img-photo doctor-card__img-link photo-back-image photo-back-image-contain">
                <?}elseif($arResult['PROPERTIES']['GENDER']['VALUE']=="Женщина" ){?>
                <div style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/female.svg')" class="doctors-list-item__img-photo doctor-card__img-link photo-back-image photo-back-image-contain">
                    <?}?>
                </div>
        <div class="doctors-list-item__img-info">
            <?if(CModule::IncludeModule('api.reviews')) {$arRaing = CApiReviews::getElementRating($arResult['ID']);} ?>
            <div class="doctors-list-item__img-info-ratings">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='1'){?>filled-star.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='2'){?>filled-star.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='3'){?>filled-star.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='4'){?>filled-star.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['RATING']>='5'){?>filled-star.svg<?}else{?>unfilled-star.svg<?}?>" alt="star">
            </div>
            <p class="doctors-list-item__img-info-commend"><?=$arRaing['PERCENT']?> пациентов рекомендуют врача на основе <?getTerminationEx($arRaing['COUNT'])?></p>
        </div>
    </div>
    <div class="doctors-list-item__description">
        <h2 class="title-h2 mobile-title"><?=$mobileTitle?></h2>
        <p class="doctors-list-item__description-position">
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
        <p class="doctors-list-item__description-title"><?=$arResult['NAME']?></p>
        <?if($arResult["PROPERTIES"]["PRICE"]["VALUE"]):?>
            <p class="doctors-list-item__description-price"><?=$arResult["PROPERTIES"]["PRICE"]["VALUE"]?> Р<span>Цена приема в клинике</span></p>
        <?endif;?>
        <?if($arResult["PROPERTIES"]["PHONE"]["VALUE"]):?>
            <a href="tel:<?=$arResult["PROPERTIES"]["PHONE"]["VALUE"]?>" class="doctors-list-item__description-phone"><span>Телефон для записи:</span><?=$arResult["PROPERTIES"]["PHONE"]["VALUE"]?></a>
        <?endif;?>
        <?if($arResult["PROPERTIES"]["CLINIK"]["VALUE"]){?>
            <?foreach ($arResult["PROPERTIES"]["CLINIK"]["VALUE"] as $item){?>
                <?$res = CIBlockElement::GetByID($item);
                if($ar_res = $res->GetNext()){?>
                    <a href="<?=$ar_res['DETAIL_PAGE_URL']?>"><p class="doctor-card__clinic-name"><?=$ar_res['NAME']?></p></a>
                    <?break;}?>
            <?}?>
        <?}else{?>
            <p class="doctor-card__clinic-name">Адрес</p>
        <?}?>
        <?if($arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0]):?>
            <p class="doctor-card__clinic-adress">
                <?if(count(explode('/',$arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0]))>1){?>г.<?}?>
                <?=str_replace('/',', ',$arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0])?>
            </p>
        <?endif;?>
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
    </div>
<?}?>
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
            <div class="doctor-card-location-map popup-link-marker"></div>
            <div class="doctor-card__img <?if($arResult['DETAIL_PICTURE']!=NULL){?>doctor-card-img<?}?>">
                <?if($arResult['DETAIL_PICTURE']!=NULL){?>
                <div style="background-image: url('<?= $arResult['DETAIL_PICTURE']['SRC'] ?>')" class="doctor-card__img-link photo-back-image photo-back-image">
                    <?}elseif($arResult['PROPERTIES']['GENDER']['VALUE']==NULL || $arResult['PROPERTIES']['GENDER']['VALUE']=="Мужчина" ){?>
                <div style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/male.svg')" class="doctor-card__img-link photo-back-image photo-back-image-contain">
                    <?}elseif($arResult['PROPERTIES']['GENDER']['VALUE']=="Женщина" ){?>
                <div style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/female.svg')" class="doctor-card__img-link photo-back-image photo-back-image-contain">
                <?}?>
                </div>
                <div class="doctor-card__img-info">
                    <?
                    $rsUser = CUser::GetByLogin($arResult["PROPERTIES"]["TECH_PHONE"]["VALUE"]);
                    $arUser = $rsUser->Fetch();
                    ?>
                    <?if($arUser!=NULL){
                        $doctorEmail = $arUser['EMAIL'];
                        $doctorPhone = $arUser['LOGIN'];?>
                        <a class="popup-mess-click" href="mailto:<?=$doctorEmail?>" style="cursor:pointer;">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/write-to-doctor.svg" alt="mail-ico">
                        </a>
                    <?}?>
                    <a href="tel:<?=$arResult['PROPERTIES']['PHONE']['VALUE']?>">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/phone-to-doctor.svg" alt="phone-ico">
                    </a>
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
                    <?if($arResult["PROPERTIES"]["CLINIK"]["VALUE"]){?>
                        <?foreach ($arResult["PROPERTIES"]["CLINIK"]["VALUE"] as $item){?>
                            <?$res = CIBlockElement::GetByID($item);
                            if($ar_res = $res->GetNext()){
                                $db_props = CIBlockElement::GetProperty(9, $ar_res['ID'], array("sort" => "asc"), Array("CODE"=>"PHONE"));
                                if($ar_props = $db_props->Fetch()) {
                                    $phone = IntVal($ar_props["VALUE"]);
                                }
                                $db_cords = CIBlockElement::GetProperty(9, $ar_res['ID'], array("sort" => "asc"), Array("CODE"=>"MAP"));
                                if($ar_props = $db_cords->Fetch()) {
                                    $cord = $ar_props["VALUE"];
                                }
                                $db_address = CIBlockElement::GetProperty(9, $ar_res['ID'], array("sort" => "asc"), Array("CODE"=>"ADDRESS"));
                                if($ar_props = $db_address->Fetch()) {
                                    $address = $ar_props["VALUE"];
                                }
                                $doctorClinic[] = array("NAME" => $ar_res['NAME'], "PHONE" => $phone, "URL" => $ar_res['DETAIL_PAGE_URL'], "ID" => $ar_res['ID']);
                            }?>
                        <?}?>
                        <?if($arResult["PROPERTIES"]["MAP"]["VALUE"]==NULL && $cord[0]!=NULL){?>
                            <? $arResult["PROPERTIES"]["MAP"]["VALUE"] = $cord[0]?>
                        <?}?>
                        <a href="<?=$doctorClinic[0]['URL']?>"><p class="doctor-card__clinic-name"><?=$doctorClinic[0]['NAME']?></p></a>
                    <?}else{
                        $noneClinic = "Y";
                        ?>
                        <p class="doctor-card__clinic-name">Адрес</p>
                    <?}?>
                <?if($arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0]):?>
                    <p class="doctor-card__clinic-adress">
                        <?if(count(explode('/',$arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0]))>1){?>г.<?}?>
                        <?=str_replace('/',', ',$arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0])?>
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
                    <ul class="sharding-block sharding-block-doctor-detail">
                        <!--            <li class="sharding-item">-->
                        <!--                <a class="sharding-item-link" href="#">-->
                        <!--                    <img class="sharding-item-img" src="--><?//= SITE_TEMPLATE_PATH ?><!--/assets/images/sharing-mail.svg" alt="mail">-->
                        <!--                </a>-->
                        <!--            </li>-->
                        <!--            <li class="sharding-item">-->
                        <!--                <a class="sharding-item-link" href="#">-->
                        <!--                    <img class="sharding-item-img" src="--><?//= SITE_TEMPLATE_PATH ?><!--/assets/images/sharing-wtf.svg" alt="wtf">-->
                        <!--                </a>-->
                        <!--            </li>-->
                        <li class="sharding-item">
                            <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://www.facebook.com/sharer.php?src=sp&u=<?=$_SERVER["SCRIPT_URI"]?>&title=<?=$arResult["NAME"]?>&utm_source=share2', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');" rel="nofollow noopener" target="_blank" title="Facebook">
                                <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-fb.svg" alt="fb">
                            </a>
                        </li>
                        <li class="sharding-item">
                            <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://vk.com/share.php?url=<?=$_SERVER["SCRIPT_URI"]?>&title=<?=$arResult["NAME"]?>&utm_source=share2', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');" rel="nofollow noopener" title="ВКонтакте">
                                <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-vk.svg" alt="vk">
                            </a>
                        </li>
                        <li class="sharding-item">
                            <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://t.me/share/url?url=<?=$_SERVER["SCRIPT_URI"]?>&text=<?=$arResult["NAME"]?>&utm_source=share2', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"  href="" rel="nofollow noopener"title="Telegram">
                                <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-tele.svg" alt="tele">
                            </a>
                        </li>
                        <li class="sharding-item">
                            <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://api.whatsapp.com/send?text=<?=$arResult["NAME"]?> <?=$_SERVER["SCRIPT_URI"]?>&utm_source=share2', '_blank', 'top=25%,left=25,location=yes,height=570,width=520,scrollbars=yes,status=yes');" rel="nofollow noopener" title="WhatsApp">
                                <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-wu.svg" alt="wu">
                            </a>
                        </li>
                        <li class="sharding-item">
                            <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://twitter.com/intent/tweet?text=<?=$arResult["NAME"]?>&url=<?=$_SERVER["SCRIPT_URI"]?>&utm_source=share2', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');" rel="nofollow noopener" title="Twitter">
                                <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-tw.svg" alt="tw">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="doctor-card-popUp-group">
            <?if(empty($arResult["PROPERTIES"]["NOT_ON"]["VALUE"])){?>
                <a class="doctor-card-popUp-group__reception popup-reception-click"><span>Записаться на прием</span></a>
                <a class="doctor-card-popUp-group__call popup-call-click"><span>Вызвать врача на дом</span></a>
            <?} ?>
            <?if($arResult["PROPERTIES"]["MAP"]["VALUE"] || $cord[0]!=NULL):?>
			    <a class="doctor-card-popUp-group__route popup-link"><span>Проложить маршрут</span></a>
            <?endif;?>
        </div>
                <ul class="sharding-block sharding-block-doctor-detail sharding-block-doctor-detail-ghost">
                <!--            <li class="sharding-item">-->
                <!--                <a class="sharding-item-link" href="#">-->
                <!--                    <img class="sharding-item-img" src="--><?//= SITE_TEMPLATE_PATH ?><!--/assets/images/sharing-mail.svg" alt="mail">-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="sharding-item">-->
                <!--                <a class="sharding-item-link" href="#">-->
                <!--                    <img class="sharding-item-img" src="--><?//= SITE_TEMPLATE_PATH ?><!--/assets/images/sharing-wtf.svg" alt="wtf">-->
                <!--                </a>-->
                <!--            </li>-->
                <li class="sharding-item">
                    <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://www.facebook.com/sharer.php?src=sp&u=<?=$_SERVER["SCRIPT_URI"]?>&title=<?=$arResult["NAME"]?>&utm_source=share2', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');" rel="nofollow noopener" target="_blank" title="Facebook">
                        <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-fb.svg" alt="fb">
                    </a>
                </li>
                <li class="sharding-item">
                    <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://vk.com/share.php?url=<?=$_SERVER["SCRIPT_URI"]?>&title=<?=$arResult["NAME"]?>&utm_source=share2', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');" rel="nofollow noopener" title="ВКонтакте">
                        <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-vk.svg" alt="vk">
                    </a>
                </li>
                <li class="sharding-item">
                    <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://t.me/share/url?url=<?=$_SERVER["SCRIPT_URI"]?>&text=<?=$arResult["NAME"]?>&utm_source=share2', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"  href="" rel="nofollow noopener"title="Telegram">
                        <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-tele.svg" alt="tele">
                    </a>
                </li>
                <li class="sharding-item">
                    <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://api.whatsapp.com/send?text=<?=$arResult["NAME"]?> <?=$_SERVER["SCRIPT_URI"]?>&utm_source=share2', '_blank', 'top=25%,left=25,location=yes,height=570,width=520,scrollbars=yes,status=yes');" rel="nofollow noopener" title="WhatsApp">
                        <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-wu.svg" alt="wu">
                    </a>
                </li>
                <li class="sharding-item">
                    <a class="sharding-item-link" onclick="event.preventDefault();window.open('https://twitter.com/intent/tweet?text=<?=$arResult["NAME"]?>&url=<?=$_SERVER["SCRIPT_URI"]?>&utm_source=share2', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');" rel="nofollow noopener" title="Twitter">
                        <img class="sharding-item-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/sharing-tw.svg" alt="tw">
                    </a>
                </li>
                </ul>
    </div>
    <div class="flex-right">
        <div class="doctor-card-top-content">
            <div class="doctor-card__title">
                <h3 class="title-h3">Информация о враче</h3>
                <div class="doctor-card__img-info-ratings">
                    <?if(CModule::IncludeModule('api.reviews')) {$arRaing = CApiReviews::getElementRating($arResult['ID']);} ?>
                    <?if($arRaing['RATING']>=1){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/filled-star.svg" alt="star-1">
                    <?}if ($arRaing['RATING']>=2){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/filled-star.svg" alt="star-2">
                    <?}if ($arRaing['RATING']>=3){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/filled-star.svg" alt="star-3">
                    <?}if ($arRaing['RATING']>=4){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/filled-star.svg" alt="star-4">
                    <?}if ($arRaing['RATING']>=5){?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/filled-star.svg" alt="star-5">
                    <?}?>
                </div>
            </div>
            <p class="doctor-card__img-info-commend"><?=$arRaing['PERCENT']?> пациентов рекомендуют врача на основе <?getTerminationEx($arRaing['COUNT'])?><a href="#full-feedback">Все отзывы о враче</a></p>
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
        <?if($arResult["PROPERTIES"]["MAP"]["VALUE"] || $cord[0]!=NULL):?>
            <div class="doctor-card-popUp-group">
                <a class="doctor-card-popUp-group__route popup-link">Проложить маршрут</a>
            </div>
        <?endif;?>
        <?if($arResult["PROPERTIES"]["MAP"]["VALUE"] || $cord!=NULL):?>
        <div class="map-wrapper">

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
<?include $_SERVER['DOCUMENT_ROOT'].'/include/result_record_in_form.php';?>
<?if($arResult["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"] && empty($arResult["PROPERTIES"]["NOT_ON"]["VALUE"])):?>
<section class="container choosing-time">
    <h3 class="title-h3">Выберите время приема для записи онлайн</h3>
    <?foreach ($arResult["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"] as $item){
        $date = explode('/',$item);
        $res = CIBlockElement::GetByID($date[2]);
        if($ar_res = $res->GetNext())
        $day[] = $date[0];
        $times[] = ["TIME" =>$date[1], "DAY" =>$date[0],"CLINIC" =>$ar_res['NAME'],"CLINIC_ID" =>$ar_res['ID']];
    }?>
    <?usort($times, function($a, $b){
        return ($a['TIME'] - $b['TIME']);
    });?>
    <?
    $days = array(1 => 'Понедельник' , 'Вторник' , 'Среда' , 'Четверг' , 'Пятница' , 'Суббота' , 'Воскресенье' );
    $_monthsList = array(
        "01"=>"Января","02"=>"Февраля","03"=>"Марта",
        "04"=>"Апреля","05"=>"Мая", "06"=>"Июня",
        "07"=>"Июля","08"=>"Августя","09"=>"Сентября",
        "10"=>"Октября","11"=>"Ноября","12"=>"Декабря");

    $begin = new DateTime( date('Y-m-d') );

    if (!empty($arResult["PROPERTIES"]['PERIOD']['VALUE'])) {
        $period = $arResult["PROPERTIES"]['PERIOD']['VALUE'];
        $end = new DateTime( date('Y-m-d', strtotime('+'.$arResult["PROPERTIES"]['PERIOD']['VALUE'].' days')));
    }else{
        $end = new DateTime( date('Y-m-d', strtotime('+14 days')));
    }
    $end = $end->modify( '+1 day' );

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    ?>
    <div class="choosing-time_block">
        <ul class="choosing-time_block-list slick-slider3">
            <?foreach($daterange as $date){?>
                <?if ($date->format("Ymd") == date('Ymd')){
                    $selectDate = $date->format("d.m.Y");
                    $selectDay = date($days[$date->format("N")]);
                }?>
                <li class="select-doctor-day choosing-time_block-list-item <?if (!in_array($days[$date->format("N")],$day)){?>pass<?}elseif (in_array($days[$date->format("N")],$day) && $date->format("Ymd") == date('Ymd')){?>active<?}?>" data-period="<?=$period?>" data-date="<?=date($date->format("d.m.Y"))?>" data-day="<?=date($days[$date->format("N")])?>" data-doctor="<?=$arResult['ID']?>"><?if ($date->format("Ymd") == date('Ymd')){?>Сегодня<?}else{?><?= date( $days[$date->format("N")]);?><?}?><br><?= date($date->format("d"). ' '. $_monthsList[$date->format("m")] );?></li>
            <?}?>
        </ul>
    </div>
        <ul class="choosing-time__worktimming-list" id="doctor-day-block-ajax">
            <?$i=0;
            foreach ($times as $item){
                if($item['DAY'] == $selectDay && in_array( date($days[$date->format("N")]),$day) && $item['CLINIC']!=NULL){
                    $i++;
                    $fullDate = $days[$date->format("N")].', '.$selectDate.'/'.$item['TIME'];
                    ?>
                <li class="choosing-time__worktimming-list-item popup-reception-click <?if(in_array($fullDate,$record)){?>closed<?}?>" data-clinic="<?=$item['CLINIC']?>" data-time="<?=$selectDate?> <?=$item['TIME']?>" title="<?=$item['CLINIC']?>"><span><?=$item['TIME']?></span></li>
            <?}
            }?>
            <?if($i==0){?>
            <h6 style="color:red;">В этот день нет приема</h6>
            <?}?>
        </ul>
</section>
<?endif;?>
<section class="container checked-feedback" id="full-feedback">
    <h2 class="title-h2" id="otzivy-yakor">Проверенные отзывы о враче</h2>
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
                            if($ar_res = $res->GetNext()){
                                $doctorSpecialization[] = $ar_res['NAME'];?>
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
        <? echo htmlspecialchars_decode($arResult['DETAIL_TEXT'])?>
    </div>
</section>
<div class="reception-popup">
    <div class="popup-box popup-scroll">
        <div class="close"></div>
        <div class="doctors-list reception" style="width: 100%;">
            <div class="doctors-list-item">
                <div class="flex-content">
                    <a href="/" class="logo">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo">
                        <h2 class="title-h2 tablet-title"><span class="green-color">Запись</span> на приём</h2>
                    </a>
                    <div class="flex-left">
                        <?formRecord($arResult, 'Запись на приём')?>
                    </div>
                </div>
                <div class="flex-right">
                    <h2 class="title-h2"><span class="green-color">Запись</span> на приём</h2>
                    <?$APPLICATION->IncludeComponent("bitrix:form.result.new","doctor_record",Array(
                            "SEF_MODE" => "N",
                            "WEB_FORM_ID" => "4",
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
<div class="call-popup">
    <div class="popup-box popup-scroll">
        <div class="close"></div>
        <div class="doctors-list call" style="width: 100%;">
            <div class="doctors-list-item">
                <div class="flex-content">
                    <a href="/" class="logo">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo">
                        <h2 class="title-h2 tablet-title">Вызов врача на дом</h2>
                    </a>
                    <div class="flex-left">
                        <?formRecord($arResult,'Вызов врача на дом')?>
                    </div>
                </div>
                <div class="flex-right">
                    <h2 class="title-h2">Вызов врача на дом</h2>
                    <?$APPLICATION->IncludeComponent("bitrix:form.result.new","doctor_home",Array(
                            "SEF_MODE" => "N",
                            "WEB_FORM_ID" => "5",
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
<div class="mess-popup">
    <div class="popup-box popup-scroll">
        <div class="close"></div>
        <div class="message-to-doctor" style="width: 100%;">
            <div class="mess-popup__header">Оставьте Ваше сообщение</div>
            <?$APPLICATION->IncludeComponent("bitrix:form.result.new","doctor_feedback",Array(
                    "SEF_MODE" => "N",
                    "WEB_FORM_ID" => "3",
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