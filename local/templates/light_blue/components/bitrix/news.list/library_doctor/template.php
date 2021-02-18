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
global $doctor_spec;
CModule::IncludeModule("form");
require($_SERVER["DOCUMENT_ROOT"].'/include/terminationEx.php');
?>
<div class="    doctors-slider slick-slider4">
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="doctors-slider-item">
        <div class="doctors-list-item__img">
                <? if ($arItem['DETAIL_PICTURE']['SRC'] != NULL) { ?>
                    <a style="background-image: url('<?= $arItem['DETAIL_PICTURE']['SRC'] ?>')" class="doctor-card__img-link doctors-list-item__img-photo photo-back-image" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                    </a>
                <? } elseif ($arItem['PROPERTIES']['GENDER']['VALUE'] == NULL || $arItem['PROPERTIES']['GENDER']['VALUE'] == "Мужчина") { ?>
                    <a style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/male.svg')" class="doctor-card__img-link doctors-list-item__img-photo photo-back-image photo-back-image-contain" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                    </a>
                <? } elseif ($arItem['PROPERTIES']['GENDER']['VALUE'] == "Женщина") { ?>
                    <a style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/female.svg')" class="doctor-card__img-link doctors-list-item__img-photo photo-back-image photo-back-image-contain" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                    </a>
                <? } ?>
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
                    <p class="doctors-list-item__img-info-commend"><?= $arRaing['PERCENT'] ?> пациентов рекомендуют врача на основе <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>#otzivy-yakor"><?getTerminationEx($arRaing['COUNT'])?></a></p>
            </div>
        </div>
        <div class="doctors-list-item__description">
            <?if(in_array($arItem['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE'],$doctor_spec)) {
                $res = CIBlockSection::GetByID($arItem['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE']);
                if ($ar_res = $res->GetNext()) {?>
                    <p class="doctors-list-item__description-position"><?= $ar_res['NAME'] ?></p>
                <? }
            }elseif(in_array($arItem['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE'],$doctor_spec)) {
                $res = CIBlockSection::GetByID($arItem['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE']);
                if ($ar_res = $res->GetNext()) {?>
                    <p class="doctors-list-item__description-position"><?= $ar_res['NAME'] ?></p>
                <? }
            }else{
                foreach ($arItem['PROPERTIES']['SPECIALIZATIONS']['VALUE'] as $item){
                    if(in_array($item,$doctor_spec)){
                        $res = CIBlockElement::GetByID($item);
                        if ($ar_res = $res->GetNext()) {?>
                            <p class="doctors-list-item__description-position"><?=$ar_res['NAME'] ?></p>
                        <?}
                        break;
                    }
                }
            }?>
            <a href="https://webdoc.clinic<?=$arItem["DETAIL_PAGE_URL"]?>">
                <p class="doctors-list-item__description-title"><?=$arItem['NAME']?></p>
            </a>
            <? if ($arItem["PROPERTIES"]["STANDING"]["VALUE"]): ?>
                <p class="doctors-list-item__description-exp">
                    Стаж <?= $arItem['PROPERTIES']['STANDING']['VALUE'] ?></p>
            <? endif; ?>
            <? if ($arItem["PROPERTIES"]["SCIENCE_DEGREE"]["VALUE"]): ?>
                <p class="doctors-list-item__description-degree"><?=($arItem['PROPERTIES']['SCIENCE_DEGREE']['VALUE']!='-' ? $arItem['PROPERTIES']['SCIENCE_DEGREE']['VALUE']: ' ')?></p>
            <? endif; ?>
            <? if ($arItem["PROPERTIES"]["PRICE"]["VALUE"]): ?>
                <p class="doctors-list-item__description-price"><?= $arItem['PROPERTIES']['PRICE']['VALUE'] ?>
                    Р<span>Цена приема в клинике</span></p>
            <? endif; ?>
            <a href="tel:<?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?>"
               class="doctors-list-item__description-phone"><span>Телефон для записи:</span><?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?>
            </a>
            <?
            $FORM_ID = 4;
            $arFilter = array(
            );
            $arFilter["FIELDS"] = array();

            $rsResults = CFormResult::GetList($FORM_ID,
                ($by="s_timestamp"),
                ($order="desc"),
                $arFilter,
                $is_filtered,
                "Y",
                10);
            $countRow = $rsResults->result->num_rows;
            $countRecords = 0;
            if($countRow!=0) {
                while ($arResult_ = $rsResults->Fetch()) {
                    $RESULT_ID = $arResult_['ID']; // ID результата
                    $STATUS_ID = $arResult_['STATUS_ID']; // ID статуса

                    // получим данные по всем вопросам
                    $arAnswer = CFormResult::GetDataByID(
                        $RESULT_ID,
                        array(),
                        $arResult_,
                        $arAnswer2);
                    if(explode('/',$arAnswer['SIMPLE_RECORD_PHONE'][0]['USER_TEXT'])[0] == $arItem['ID']){
                        $countRecords++;
                    }
                }
            }?>
            <?if($countRecords>0){?>
                <span class="doctors-list-item__description-counts">Всего записалось <?= $countRecords?> человек(а)</span>
            <?}else{?>
                <span class="doctors-list-item__description-counts">К этому врачу еще никто не записался</span>
            <?}?>
            <?/*<div class="doctors-list-item-favorites"></div>*/?>
        </div>
    </div>
<?endforeach;?>
</div>
<?if(count($arResult["ITEMS"])==0 ){?>
    <style>
        .illness-doctor-list-block {
            display: none;
        }
    </style>
<?}?>
