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
CModule::IncludeModule("iblock");
global $clinicName;
?>
<?if(count($arResult["ITEMS"])>0){?>
    <div class="container">
        <h1 class="title-h2">Врачи <?=$clinicName?></h1>
    </div>
<?}?>
<section class="container result-filter">
    <div class="list-item doctors-list">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="doctors-list-item card-item">
                <div class="flex-left">
                    <div class="doctors-list-item__img">
                        <?if($arItem['DETAIL_PICTURE']['SRC']!=NULL){?>
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?= $arItem['DETAIL_PICTURE']['SRC'] ?>" alt="doctor-photo" class="doctors-list-item__img-photo"></a>
                        <?}elseif($arItem['PROPERTIES']['GENDER']['VALUE']==NULL || $arItem['PROPERTIES']['GENDER']['VALUE']=="Мужчина" ){?>
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?= SITE_TEMPLATE_PATH ?>/icon/male.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                        <?}elseif($arItem['PROPERTIES']['GENDER']['VALUE']=="Женщина" ){?>
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?= SITE_TEMPLATE_PATH ?>/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                        <?}?>
                        <div class="doctors-list-item__img-info">
                            <?if(CModule::IncludeModule('api.reviews')) {$arRaing = CApiReviews::getElementRating($arItem['ID']);} ?>
                            <div class="doctors-list-item__img-info-ratings">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'1%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'21%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'41%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'61%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<?if($arRaing['PERCENT']>'81%'){?>ant-design_star-filled.svg<?}else{?>ant-design_star-none-filled.png<?}?>" alt="star">
                            </div>
                            <p class="doctors-list-item__img-info-commend"><?=$arRaing['PERCENT']?> пациентов рекомендуют врача на основе <a href=""><?=$arRaing['COUNT']?> отзывов</a></p>
                        </div>
                    </div>
                    <div class="doctors-list-item__description">
                        <?$res = CIBlockSection::GetByID($arItem['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE']);
                        if($ar_res = $res->GetNext()){?>
                            <p class="doctors-list-item__description-position"><?=$ar_res['NAME']?></p>
                        <?}?>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <p class="doctors-list-item__description-title"><?=$arItem['NAME']?></p>
                        </a>
                        <?if($arItem["PROPERTIES"]["STANDING"]["VALUE"]):?>
                            <p class="doctors-list-item__description-exp">Стаж <?=$arItem['PROPERTIES']['STANDING']['VALUE']?></p>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["SCIENCE_DEGREE"]["VALUE"]):?>
                            <p class="doctors-list-item__description-degree"><?=$arItem['PROPERTIES']['SCIENCE_DEGREE']['VALUE']?></p>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]):?>
                            <p class="doctors-list-item__description-price"><?=$arItem['PROPERTIES']['PRICE']['VALUE']?> Р<span>Цена приема в клинике</span></p>
                        <?endif;?>
                        <a href="tel:<?=$arItem['PROPERTIES']['PHONE']['VALUE']?>" class="doctors-list-item__description-phone"><span>Телефон для записи:</span><?=$arItem['PROPERTIES']['PHONE']['VALUE']?></a>
                        <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                        <?/*<div class="doctors-list-item-favorites"></div>*/?>
                    </div>
                </div>
                <div class="flex-right">
                    <div class="doctors-list-item__description">
                        <p class="doctors-list-item_timing">Выберите время приема для записи онлайн</p>
                        <ul class="doctors-list-item__days-list">
                            <li class="doctors-list-item__days-list-item active">понедельник, 6</li>
                            <li class="doctors-list-item__days-list-item">вторник, 7</li>
                            <li class="doctors-list-item__days-list-item not-worked">среда, 8</li>
                            <li class="doctors-list-item__days-list-item">четверг, 9</li>
                        </ul>
                        <?if($arItem["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"]):?>
                            <ul class="doctors-list-item__worktimming-list">
    <!--                            <li class="doctors-list-item__worktimming-list-item closed">10:10</li>-->
    <!--                            <li class="doctors-list-item__worktimming-list-item pass">10:50</li>-->
                                <?foreach ($arItem["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"] as $item){?>
                                    <li class="doctors-list-item__worktimming-list-item"><?=$item?></li>
                                <?}?>
                            </ul>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["CLINIK"]["VALUE"]):?>
                            <?foreach ($arItem["PROPERTIES"]["CLINIK"]["VALUE"] as $item){?>
                                <?$res = CIBlockElement::GetByID($item);
                                if($ar_res = $res->GetNext()){?>
                                    <a href="<?=$ar_res['DETAIL_PAGE_URL']?>"><p class="doctors-list-item__clinic-name"><?=$ar_res['NAME']?></p></a>
                                    <?break;}?>
                            <?}?>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"]):?>
                            <p class="doctors-list-item__clinic-adress"><?=$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"]?></p>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["METRO"]["VALUE"]):?>
                            <ul class="doctors-list-item__metro-list">
                                <?foreach ($arItem["PROPERTIES"]["METRO"]["VALUE"] as $key => $item){?>
                                    <?$res = CIBlockElement::GetByID($item);
                                    if($ar_res = $res->GetNext()){?>
                                        <li class="doctors-list-item_metro-list-item <?if(($key % 2)==0 && $key!=0){?>metro1<?}elseif(($key % 3)==0||$key===0){?>metro2<?}else{?>metro3<?}?>"><?=$ar_res['NAME']?></li>
                                    <?}?>
                                <?}?>
                            </ul>
                        <?endif;?>
                        <ul class="doctors-list-item_options">
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
                </div>
            </div>
        <?endforeach;?>
    </div>
</section>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	 <?=$arResult["NAV_STRING"]?>
<?endif;?>