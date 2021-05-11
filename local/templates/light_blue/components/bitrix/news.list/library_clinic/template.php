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
CModule::IncludeModule("form");
global $clinic_spec;
require($_SERVER["DOCUMENT_ROOT"].'/include/termination.php');
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}
console_log($arResult);
?>
<style>
    .clinic-card-info__title::before {
        position: absolute;
        left: 10px;
    }
    .clinic-card-info__block span {
        font-size: 14px;
        line-height: 16px;
        padding-left: 30px;
    }
    .doctors-slider-item .doctors-list-item__img.logo  {
        margin: 10px;
    }
    .doctors-list-item__description-phone {
        font-size: 14px;
    }
    .clinic-card-info__title, .clinic-card-info__block, .doctors-list-item__description-exp {
        margin-bottom: 5px;
    }
</style>
<div class="doctors-slider slick-slider4">
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $start = strtotime(date('d.m.Y'));
    $end = strtotime($arItem["PROPERTIES"]["DATE_END_ACTIVE"]["VALUE"]);
    $days_between = ceil(($end - $start) / 86400);
    ?>
    <div class="doctors-slider-item">
        <div class="doctors-list-item__img <?if($arItem["PROPERTIES"]["LOGO"]["VALUE"]){?>logo<?}?>">
            <a href="https://doctora.clinic<?=$arItem["DETAIL_PAGE_URL"]?>">
                <?if($arItem["PROPERTIES"]["LOGO"]["VALUE"]){
                    $file = CFile::ResizeImageGet($arItem["PROPERTIES"]["LOGO"]["VALUE"], array('width'=>153, 'height'=>153), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <img src="<?= $file['src'] ?>" alt='<?=$arItem["NAME"]?>'>
                <?}else{?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/icon/hospital_building.svg" alt="нет лого">
                <?}?>
            </a>
            <div class="doctors-list-item__img-info">
            <div class="doctors-list-item__img-info-ratings">
                <? if (CModule::IncludeModule('api.reviews')) {
                    $arRaing = CApiReviews::getElementRating($arItem['ID']);
                } ?>
                <div class="doctors-list-item__img-info-ratings">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='1') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                         alt="star">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='2') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                         alt="star">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='3') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                         alt="star">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='4') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                         alt="star">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='5') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                         alt="star">
                </div>
            </div>
                <a class="clinic-card-img__link" href="https://doctora.clinic<?=$arItem['DETAIL_PAGE_URL']?>#otzivy-yakor"><?getTermination($arRaing['COUNT'])?></a>
            </div>
        </div>
        <div class="doctors-list-item__description">
                <?
                $res = CIBlockElement::GetByID($arItem["PROPERTIES"]["MAIN_SPECIALIZATION"]["VALUE"]);
                if($ar_res = $res->GetNext()){?>
                    <a href="https://doctora.clinic<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <span class="main-spec"><?=$ar_res['NAME']?></span>
                    </a>
                <?}
                ?>
                <?if($arItem["PROPERTIES"]["MAIN_SPECIALIZATION"]["VALUE"]== NULL) {
                    foreach ($arItem["PROPERTIES"]["SPECIALIZATION"]["VALUE"] as $item){
                        if(in_array($item, $clinic_spec)){
                            $res = CIBlockElement::GetByID($item);
                            if ($ar_res = $res->GetNext()) {?>
                                <a href="https://doctora.clinic<?=$arItem["DETAIL_PAGE_URL"]?>">
                                    <span class="main-spec"><?=$ar_res['NAME']?></span>
                                </a>
                            <?}
                            break;
                        }
                    }
                }?>
                <p class="doctors-list-item__description-exp">
                    <a href="https://doctora.clinic<?=$arItem["DETAIL_PAGE_URL"]?>">
                       <?=$arItem["NAME"]?>
                    </a>
                </p>
                <?if($arItem["PROPERTIES"]["CITY"]["VALUE"]):?>
                <?
                    $rez = CIBlockSection::GetByID($arItem["DISPLAY_PROPERTIES"]["CITY"]["VALUE"]);
                    if ($ar_res = $rez->GetNext())
                        $city = $ar_res['NAME'];
                    ?>
                    <div class="clinic-card-info__block">
                        <span class="clinic-card-info__title map"><?if($arItem["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["REGION"]["DISPLAY_VALUE"]?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]){?> <?=$city?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["AREA"]["DISPLAY_VALUE"]?>, <?}?><?if($arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]){?><?=$arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?><?}?></span>
                    </div>
                <?endif;?>
                <?if($arItem["PROPERTIES"]["CONTACTS"]["VALUE"]):?>
                    <a href="tel:<?= $arItem["PROPERTIES"]["CONTACTS"]["VALUE"][0]?>"
                       class="doctors-list-item__description-phone"><span></span><?= $arItem["PROPERTIES"]["CONTACTS"]["VALUE"][0]?>
                    </a>
                <?endif;?>

        </div>
    </div>
<?endforeach;?>
</div>

<?if(count($arResult["ITEMS"])==0 ){?>
    <style>
        .illness-clinic-list-block {
            display: none;
        }
    </style>
<?}?>