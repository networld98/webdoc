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
        <div class="api-items checked-feedback-list slick-slider2">
            <? foreach($arResult['ITEMS'] as $arItem): ?>
                <?
                $item_class = '';
                if($bCanEdit && ($arItem['PUBLISH'] == 'N' || $arItem['ACTIVE'] == 'N')) {
                    $item_class = 'api-item-hidden';
                }
                $arElement = $arItem['ELEMENT_FIELDS'];
                ?>
                <div class="checked-feedback-list-item <?=$item_class?> " id="review<?=$arItem['ID']?>" itemprop="review" itemscope itemtype="http://schema.org/Review">
                    <div class="checked-feedback-list-item__doctor-info">
                        <div class="checked-feedback-list-item__img-info-ratings starrr">
                            <?if($arItem['RATING']>=1){?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-1">
                            <?}if ($arItem['RATING']>=2){?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-2">
                            <?}if ($arItem['RATING']>=3){?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-3">
                            <?}if ($arItem['RATING']>=4){?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-4">
                            <?}if ($arItem['RATING']>=5){?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="star-5">
                            <?}?>
                            <span>
                                <?if($arItem['RATING']==1){?>
                                    Ужасно
                                <?}elseif ($arItem['RATING']==2){?>
                                    Плохо
                                <?}elseif ($arItem['RATING']==3){?>
                                    Нормально
                                <?}elseif ($arItem['RATING']==4){?>
                                    Хорошо
                                <?}elseif ($arItem['RATING']==5){?>
                                    Отлично
                                <?}?>
                            </span>
                        </div>
                        <p class="checked-feedback-list-item__from">
                            <span itemprop="name">
                                <? if($arParams['USE_USER'] == 'Y' && $arItem['USER_URL']): ?>
                                    <?=$arItem['GUEST_NAME']?>
                                <? else: ?>
                                    <?=$arItem['GUEST_NAME']?>
                                <? endif ?>
                            </span>,
                            <span itemprop="datePublished" content="<?=$arItem['DISPLAY_DATE_PUBLISHED']?>"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
                        </p>
                        <p class="checked-feedback-list-item__feedback" data-edit="ANNOTATION" itemprop="reviewBody"><?=$arItem['ANNOTATION']?></p>
                    </div>
                </div>
                <?/*
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

								<button class="api-delete api_button api_button_small"
								        onclick="jQuery.fn.apiReviewsList('delete',<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_DELETE')?></button>

								<button class="api-send api_button api_button_success api_button_small <? if($arItem['ACTIVE'] == 'N' || $arParams['USE_SUBSCRIBE'] != 'Y' || $arItem['SUBSCRIBE_SEND'] == 'Y'): ?>api-hidden<? endif ?>"
								        onclick="jQuery.fn.apiReviewsList('send',this,<?=$arItem['ID']?>);"><?=Loc::getMessage('API_REVIEWS_LIST_BTN_SEND')?></button>
							</div>
						<? endif ?>
					</div>*/?>
            <? endforeach ?>
        </div>
	<? endif ?>
</div>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/main.js"></script>