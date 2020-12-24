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
<?if($arResult['ITEMS']!=NULL){
$noneSearch++;
?>
    <div class="illness-detail-block">
        <h3 class="title-h3 to-choice">К какому врачу обратиться при сколиозе позвоночника?</h3>
        <p>С помощью нашего сервиса вы можете найти хорошего ортопеда или ортопедическую клинику, где можно пройти полное обследование по поводу искривления позвоночника. Если вам требуется операция, ознакомьтесь с отзывами и выберете хорошую ортопедическую больницу.</p>
        <div class="doctors-slider slick-slider4">
            <div class="doctors-slider-item">
                <div class="doctors-list-item__img">
                    <a href="/doctors/kalinina-irina-andreevna/"><img src="/local/templates/light_blue/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                    <div class="doctors-list-item__img-info">
                        <div class="doctors-list-item__img-info-ratings">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                        </div>
                        <p class="doctors-list-item__img-info-commend">0% пациентов рекомендуют врача на основе <a href="">0 отзывов</a></p>
                    </div>
                </div>
                <div class="doctors-list-item__description">
                    <p class="doctors-list-item__description-position">Реабилитолог</p>
                    <a href="/doctors/kalinina-irina-andreevna/">
                        <p class="doctors-list-item__description-title">Калинина Ирина Андреевна</p>
                    </a>
                    <p class="doctors-list-item__description-exp">Стаж 21 год</p>
                    <p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
                    <p class="doctors-list-item__description-price">2 600 Р<span>Цена приема в клинике</span></p>
                    <a href="tel:8 (812) 000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                    <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                    <div class="doctors-list-item-favorites"></div>
                </div>
            </div>
            <div class="doctors-slider-item">
                <div class="doctors-list-item__img">
                    <a href="/doctors/kalinina-irina-andreevna/"><img src="/local/templates/light_blue/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                    <div class="doctors-list-item__img-info">
                        <div class="doctors-list-item__img-info-ratings">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                        </div>
                        <p class="doctors-list-item__img-info-commend">0% пациентов рекомендуют врача на основе <a href="">0 отзывов</a></p>
                    </div>
                </div>
                <div class="doctors-list-item__description">
                    <p class="doctors-list-item__description-position">Реабилитолог</p>
                    <a href="/doctors/kalinina-irina-andreevna/">
                        <p class="doctors-list-item__description-title">Калинина Ирина Андреевна</p>
                    </a>
                    <p class="doctors-list-item__description-exp">Стаж 21 год</p>
                    <p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
                    <p class="doctors-list-item__description-price">2 600 Р<span>Цена приема в клинике</span></p>
                    <a href="tel:8 (812) 000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                    <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                    <div class="doctors-list-item-favorites"></div>
                </div>
            </div>
            <div class="doctors-slider-item">
                <div class="doctors-list-item__img">
                    <a href="/doctors/kalinina-irina-andreevna/"><img src="/local/templates/light_blue/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                    <div class="doctors-list-item__img-info">
                        <div class="doctors-list-item__img-info-ratings">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                        </div>
                        <p class="doctors-list-item__img-info-commend">0% пациентов рекомендуют врача на основе <a href="">0 отзывов</a></p>
                    </div>
                </div>
                <div class="doctors-list-item__description">
                    <p class="doctors-list-item__description-position">Реабилитолог</p>
                    <a href="/doctors/kalinina-irina-andreevna/">
                        <p class="doctors-list-item__description-title">Калинина Ирина Андреевна</p>
                    </a>
                    <p class="doctors-list-item__description-exp">Стаж 21 год</p>
                    <p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
                    <p class="doctors-list-item__description-price">2 600 Р<span>Цена приема в клинике</span></p>
                    <a href="tel:8 (812) 000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                    <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                    <div class="doctors-list-item-favorites"></div>
                </div>
            </div>
            <div class="doctors-slider-item">
                <div class="doctors-list-item__img">
                    <a href="/doctors/kalinina-irina-andreevna/"><img src="/local/templates/light_blue/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                    <div class="doctors-list-item__img-info">
                        <div class="doctors-list-item__img-info-ratings">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                            <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                        </div>
                        <p class="doctors-list-item__img-info-commend">0% пациентов рекомендуют врача на основе <a href="">0 отзывов</a></p>
                    </div>
                </div>
                <div class="doctors-list-item__description">
                    <p class="doctors-list-item__description-position">Реабилитолог</p>
                    <a href="/doctors/kalinina-irina-andreevna/">
                        <p class="doctors-list-item__description-title">Калинина Ирина Андреевна</p>
                    </a>
                    <p class="doctors-list-item__description-exp">Стаж 21 год</p>
                    <p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
                    <p class="doctors-list-item__description-price">2 600 Р<span>Цена приема в клинике</span></p>
                    <a href="tel:8 (812) 000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                    <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                    <div class="doctors-list-item-favorites"></div>
                </div>
            </div>
        </div>
    </div>
<div class="row">


    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col-lg-12">
            <div class="variable-block-item">
                <h3 class="title-article"><a href="<?if($arParams['IBLOCK_ID'] == 20 || $arParams['IBLOCK_ID'] == 21 || $arParams['IBLOCK_ID'] == 22 ){?>https://lib.webdoc.clinic<?}?><?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME']?></a></h3>
                <p class="article-preview"><?=$arItem["PREVIEW_TEXT"]?></p>
            </div>
        </div>
    <?endforeach;?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <br /><?=$arResult["NAV_STRING"]?>
    <?endif;?>
</div>
<?}?>