<?php
/**
 * Bitrix vars
 *
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent         $component
 *
 * @var array                    $arParams
 * @var array                    $arResult
 *
 * @var string                   $templateName
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var array                    $templateData
 *
 * @var string                   $componentPath
 * @var string                   $parentTemplateFolder
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 */

use \Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

Loc::loadMessages(dirname(__FILE__) . '/template.php');

if(method_exists($this, 'setFrameMode'))
    $this->setFrameMode(true);

$bCanEdit = $arParams['IS_EDITOR'];
global $clinicName;
if($arParams['DISPLAY_TOP_PAGER'] || $arParams['DISPLAY_BOTTOM_PAGER']) {
    ob_start();
    $this->addExternalCss('/bitrix/components/bitrix/main.pagenavigation/templates/.default/style.css');
    $APPLICATION->IncludeComponent('bitrix:main.pagenavigation', '', array(
        'NAV_OBJECT'     => $arResult['NAV_OBJECT'],
        'SEF_MODE'       => $arParams['SEF_MODE'],
        'TEMPLATE_THEME' => $arParams['PAGER_THEME'],
    ),
        false,
        array('HIDE_ICONS' => 'Y')
    );
    $pagenavigation = ob_get_contents();
    ob_end_clean();
}
?>
<div class="api-reviews-list">
    <? $APPLICATION->IncludeComponent('api:reviews.filter', "", $arParams, $component->getParent()); ?>
    <? if($arResult['ITEMS']): ?>
        <? if($arParams['DISPLAY_TOP_PAGER'] && $pagenavigation): ?>
            <div class="api-pagination"><?=$pagenavigation?></div>
        <? endif; ?>
        <div class="api-items">
            <? foreach($arResult['ITEMS'] as $arItem): ?>
                <?
                $item_class = '';
                if($bCanEdit && ($arItem['PUBLISH'] == 'N' || $arItem['ACTIVE'] == 'N')) {
                    $item_class = 'api-item-hidden';
                }
                $arElement = $arItem['ELEMENT_FIELDS'];
                ?>
                <div id="review<?=$arItem['ID']?>" class="<?=$item_class?> clinic-card-full-desc__content__feedback-item" itemprop="review" itemscope itemtype="http://schema.org/Review">
                    <? if($arResult['STATUS']): ?>
                        <div class="api-item-status"><?=$arResult['STATUS']?></div>
                    <? endif ?>
                    <div class="clinic-card-full-desc__content__feedback-item-left">
                        <? if($arItem['GUEST_NAME']): ?>
                            <p class="clinic-card-full-desc__content__feedback-item-left__name" itemprop="author" itemscope itemtype="http://schema.org/Person">
                            <span itemprop="name">
                                <? if($arParams['USE_USER'] == 'Y' && $arItem['USER_URL']): ?>
                                    <?=$arItem['GUEST_NAME']?>
                                <? else: ?>
                                    <?=$arItem['GUEST_NAME']?>
                                <? endif ?>
                            </span>
                            </p>
                        <? endif; ?>
                        <div class="clinic-card-full-desc__content__feedback-item-left__mark <?if($arItem['RATING']==1||$arItem['RATING']==2){?>pink<?}elseif ($arItem['RATING']==3||$arItem['RATING']==4){?>orange<?}else{?>green<?}?>" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                            <span class="count" itemprop="ratingValue"><?=($arItem['RATING'] ? $arItem['RATING'] : 5)?></span>
                            <span class="text">
                                <?if($arItem['RATING']==1){?>
                                    Ужасно
                                <?}elseif ($arItem['RATING']==2){?>
                                    Плохо
                                <?}elseif ($arItem['RATING']==3){?>
                                    Удовлетворительно
                                <?}elseif ($arItem['RATING']==4){?>
                                    Хорошо
                                <?}elseif ($arItem['RATING']==5){?>
                                    Отлично
                                <?}?>
                            </span>
                        </div>
                        <?/* <div class="clinic-card-full-desc__content__feedback-item-left__visit">
                            <span class="clinic-card-full-desc__content__feedback-item-left__visit__text">Посетили врача</span>
                            <span class="clinic-card-full-desc__content__feedback-item-left__visit__date">Апрель 2020</span>
                        </div>*/?>
                        <div class="clinic-card-full-desc__content__feedback-item-left__from">
                            <span class="clinic-card-full-desc__content__feedback-item-left__from__text">Отзыв оставлен</span>
                            <span class="clinic-card-full-desc__content__feedback-item-left__from__source"itemprop="datePublished" content="<?=$arItem['DISPLAY_DATE_PUBLISHED']?>"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
                        </div>
                    </div>
                    <div class="clinic-card-full-desc__content__feedback-item-right">
                        <? if($arItem['ADVANTAGE']): ?>
                            <div class="clinic-card-full-desc__content__feedback-item-right__liked">
                                <span>Понравилось</span>
                                <p data-edit="ADVANTAGE"><?=$arItem['ADVANTAGE']?></p>
                            </div>
                        <? endif ?>
                        <? if($arItem['DISADVANTAGE']): ?>
                            <div class="clinic-card-full-desc__content__feedback-item-right__disliked">
                                <span>Не понравилось</span>
                                <p data-edit="DISADVANTAGE"><?=$arItem['DISADVANTAGE']?></p>
                            </div>
                        <? endif ?>
                        <? if($arItem['ANNOTATION']): ?>
                            <div class="clinic-card-full-desc__content__feedback-item-right__comment">
                                <span>Комментарий</span>
                                <p  data-edit="ANNOTATION" itemprop="reviewBody"><?=$arItem['ANNOTATION']?></p>
                            </div>
                        <? endif ?>
                        <? if($arItem['COMPANY']): ?>
                            <div class="clinic-card-full-desc__content__feedback-item-right__doctor">
                                <span>Лечащий врач:&nbsp;</span>
                                <span class="doctor-name"><?=$arItem['COMPANY']?></span>
                            </div>
                        <? endif ?>

                        <div class="clinic-card-full-desc__content__feedback-item-right__reply">
                            <? if($arItem['REPLY']): ?>
                                <span class="clinic-card-full-desc__content__feedback-item-right__reply__clinic"><?=$clinicName?></span>
                                <?/* <span class="clinic-card-full-desc__content__feedback-item-right__reply__date-time">30 июня 20 в 10:00</span>*/?>
                                <p id="api-answer-text-<?=$arItem['ID']?>"><?=$arItem['REPLY']?></p>
                            <? endif ?>
                        </div>
                    </div>

                </div>
                <div class="api-footer">
                    <div class="api-user-info">
                        <div class="api-left">

                            <? if($bCanEdit && ($arItem['GUEST_EMAIL'] || $arItem['GUEST_PHONE'] || $arItem['ORDER_ID'] || $arItem['IP'])): ?>
                                <div class="api-guest-contacts">
                                    (
                                    <? if($arItem['GUEST_EMAIL']): ?>
                                        <a href="mailto:<?=$arItem['GUEST_EMAIL']?>"><?=$arItem['GUEST_EMAIL']?></a> <? endif ?>
                                    <? if($arItem['GUEST_PHONE']): ?> |
                                        <a href="tel:<?=$arItem['GUEST_PHONE']?>"><?=$arItem['GUEST_PHONE']?></a> <? endif ?>
                                    <? if($arItem['ORDER_ID']): ?> | <?=Loc::getMessage('API_REVIEWS_LIST_ORDER_NUM')?> <?=$arItem['ORDER_ID']?><? endif ?>
                                    <? if($arItem['IP']): ?> | <?=$arItem['IP']?><? endif ?>
                                    )
                                </div>
                            <? endif ?>

                            <? if($arItem['LOCATION'] || ($arItem['DELIVERY'] && $arItem['DELIVERY']['NAME']) || $arParams['SHOW_THUMBS']): ?>
                                <? if($arItem['LOCATION']): ?>
                                    <span class="api-guest-loc"><?=$arItem['LOCATION']?></span>
                                <? endif ?>
                                <? if($arItem['DELIVERY'] && $arItem['DELIVERY']['NAME']): ?>
                                    <span class="api-guest-delivery"> <?=($arItem['LOCATION'] ? '/' : '')?> <?=$arItem['DELIVERY']['NAME']?></span>
                                <? endif ?>
                            <? endif ?>
                        </div>
                        <div class="api-right">
                            <? if($arParams['SHOW_THUMBS']): ?>
                                <div class="api-thumbs">
                                    <div class="api-thumbs-label"><?=$arParams['MESS_HELPFUL_REVIEW']?></div>
                                    <div class="api-thumbs-up<? if($arItem['THUMBS_UP'] && $arItem['THUMBS_UP_ACTIVE']): ?> api-thumbs-active<? endif ?>"
                                         onclick="jQuery.fn.apiReviewsList('vote',this,<?=$arItem['ID']?>,1);">
                                        <span class="api-hand"></span> <span class="api-counter"><?=$arItem['THUMBS_UP']?></span>
                                    </div>
                                    <div class="api-thumbs-down<? if($arItem['THUMBS_DOWN'] && $arItem['THUMBS_DOWN_ACTIVE']): ?> api-thumbs-active<? endif ?>"
                                         onclick="jQuery.fn.apiReviewsList('vote',this,<?=$arItem['ID']?>,-1)">
                                        <span class="api-hand"></span> <span class="api-counter"><?=$arItem['THUMBS_DOWN']?></span>
                                    </div>
                                </div>
                            <? endif ?>
                        </div>
                    </div>

                    <? if($arItem['REPLY']): ?>
                        <div class="api-answer<?=($arItem['REPLY_SEND'] == 'Y' ? ' api-answer-send' : '')?>">
                            <? if($arParams['SHOP_NAME_REPLY']): ?>
                                <div class="api-shop-name"><?=$arParams['SHOP_NAME_REPLY']?></div>
                            <? endif ?>
                            <div class="api-shop-text" id="api-answer-text-<?=$arItem['ID']?>"><?=$arItem['REPLY']?></div>
                        </div>
                    <? endif ?>

                    <? if($bCanEdit): ?>
                        <div class="api-admin-controls">
                            <button class="api-reply api_button api_button_small"
                                    onclick="jQuery.fn.apiReviewsList('showReply',<?=$arItem['ID']?>,<?=($arItem['GUEST_EMAIL'] ? 1 : 0)?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_REPLY')?></button>

                            <button class="api-edit api_button api_button_small"
                                    onclick="jQuery.fn.apiReviewsList('edit',<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_EDIT')?></button>

                            <button class="api-save api-hidden api_button api_button_small"
                                    onclick="jQuery.fn.apiReviewsList('save',<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_SAVE')?></button>

                            <button class="api-cancel api-hidden api_button api_button_small"
                                    onclick="jQuery.fn.apiReviewsList('cancel',<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_CANCEL')?></button>

                            <button class="api-hide api_button api_button_small <? if($arItem['ACTIVE'] == 'N'): ?>api-hidden<? endif ?>"
                                    onclick="jQuery.fn.apiReviewsList('hide',<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_HIDE')?></button>

                            <button class="api-show api_button api_button_small <? if($arItem['ACTIVE'] == 'Y'): ?>api-hidden<? endif ?>"
                                    onclick="jQuery.fn.apiReviewsList('show',<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_SHOW')?></button>

                            <?/*<button class="api-delete api_button api_button_small"
                                    onclick="jQuery.fn.apiReviewsList('delete',<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_DELETE')?></button>
                                */?>
                            <button class="api-send api_button api_button_success api_button_small <? if($arItem['ACTIVE'] == 'N' || $arParams['USE_SUBSCRIBE'] != 'Y' || $arItem['SUBSCRIBE_SEND'] == 'Y'): ?>api-hidden<? endif ?>"
                                    onclick="jQuery.fn.apiReviewsList('send',this,<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_SEND')?></button>
                        </div>
                    <? endif ?>
                </div>
            <? endforeach ?>
        </div>
        <? if($arParams['DISPLAY_BOTTOM_PAGER'] && $pagenavigation): ?>
            <div class="api-pagination"><?=$pagenavigation?></div>
        <? endif; ?>
    <? endif ?>
</div>
