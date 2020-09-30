<?php

use \Bitrix\Main\Page\Asset,
	 \Bitrix\Main\Page\AssetLocation,
	 Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

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

Loc::loadMessages(__FILE__);

if(method_exists($this, 'setFrameMode'))
	$this->setFrameMode(true);

if($arParams['INCLUDE_CSS'] == 'Y') {
	$this->addExternalCss($templateFolder . '/theme/' . $arParams['THEME'] . '/style.css');
}

$stat_class = ($arParams['USE_STAT'] ? ' api-stat-on' : ' api-stat-off');
global $clinicName;
?>
	<div id="reviews" class="api-reviews <?=$stat_class?>" itemscope itemtype="http://schema.org/Product">
		<?
		$dynamicArea = new \Bitrix\Main\Page\FrameStatic("reviews");
		$dynamicArea->setAnimation(true);
		$dynamicArea->setStub('');
		$dynamicArea->setContainerID("reviews");
		$dynamicArea->startDynamicArea();
		?>
        <div class="clinic-card-full-desc__content__feedback arbt-color-<?=$arParams['COLOR']?>">
				<? if($arParams['USE_SUBSCRIBE'] == 'Y'): ?>
					<div class="api-block-right">
						<? $APPLICATION->IncludeComponent(
							 'api:reviews.subscribe',
							 "",
							 array(
									'THEME'                  => $arParams['~THEME'],
									'COLOR'                  => $arParams['~COLOR'],
									'INCLUDE_CSS'            => $arParams['~INCLUDE_CSS'],
									'AJAX_URL'               => $arParams['~SUBSCRIBE_AJAX_URL'],
									'MESS_LINK'              => $arParams['~MESS_SUBSCRIBE_LINK'],
									'MESS_SUBSCRIBE'         => $arParams['~MESS_SUBSCRIBE_SUBSCRIBE'],
									'MESS_UNSUBSCRIBE'       => $arParams['~MESS_SUBSCRIBE_UNSUBSCRIBE'],
									'MESS_FIELD_PLACEHOLDER' => $arParams['~MESS_SUBSCRIBE_FIELD_PLACEHOLDER'],
									'MESS_BUTTON_TEXT'       => $arParams['~MESS_SUBSCRIBE_BUTTON_TEXT'],
									'MESS_ERROR'             => $arParams['~MESS_SUBSCRIBE_ERROR'],
									'MESS_ERROR_EMAIL'       => $arParams['~MESS_SUBSCRIBE_ERROR_EMAIL'],
									'MESS_ERROR_CHECK_EMAIL' => $arParams['~MESS_SUBSCRIBE_ERROR_CHECK_EMAIL'],
									'IBLOCK_ID'              => $arParams['~IBLOCK_ID'],
									'SECTION_ID'             => $arParams['~SECTION_ID'],
									'ELEMENT_ID'             => $arParams['~ELEMENT_ID'],
									'ORDER_ID'               => $arParams['~ORDER_ID'],
									'URL'                    => $arParams['~URL'],
							 ),
							 $component
						); ?>
					</div>
				<? endif ?>
			<div class="api-block-header">
				<? if($arParams['USE_STAT']): ?>
					<? $APPLICATION->IncludeComponent(
						 'api:reviews.stat',
						 "",
						 array(
								'THEME'                 => $arParams['~THEME'],
								'COLOR'                 => $arParams['~COLOR'],
								'MESS_TOTAL_RATING'     => $arParams['~STAT_MESS_TOTAL_RATING'],
								'MESS_CUSTOMER_RATING'  => $arParams['~STAT_MESS_CUSTOMER_RATING'],
								'MESS_CUSTOMER_REVIEWS' => $arParams['~STAT_MESS_CUSTOMER_REVIEWS'],
								'MIN_AVERAGE_RATING'    => $arParams['~STAT_MIN_AVERAGE_RATING'],
								'CACHE_TYPE'            => $arParams['~CACHE_TYPE'],
								'CACHE_TIME'            => $arParams['~CACHE_TIME'],
								'INCLUDE_CSS'           => $arParams['~INCLUDE_CSS'],
								'IBLOCK_ID'             => $arParams['~IBLOCK_ID'],
								'SECTION_ID'            => $arParams['~SECTION_ID'],
								'ELEMENT_ID'            => $arParams['~ELEMENT_ID'],
								'ORDER_ID'              => $arParams['~ORDER_ID'],
								'URL'                   => $arParams['~URL'],
						 ),
						 $component
					); ?>
				<? endif ?>
			</div>
			<?/*<div class="api-block-sort">
				<? $APPLICATION->IncludeComponent(
					 'api:reviews.sort',
					 "",
					 array(
							'THEME'       => $arParams['~THEME'],
							'COLOR'       => $arParams['~COLOR'],
							'USE_STAT'    => $arParams['~USE_STAT'],
							'INCLUDE_CSS' => $arParams['~INCLUDE_CSS'],
							'SORT_FIELDS' => $arParams['~LIST_SORT_FIELDS'],
					 ),
					 $component
				); ?>
			</div>*/?>
		</div>
		<div class="api-block-content">
			<? $APPLICATION->IncludeComponent(
				 'api:reviews.list',
				 '',
				 array(
						'THEME'              => $arParams['~THEME'],
						'COLOR'              => $arParams['~COLOR'],
						'EMAIL_TO'           => $arParams['~EMAIL_TO'],
						'SHOP_NAME'          => $arParams['~SHOP_NAME'],
						'INCLUDE_CSS'        => $arParams['~INCLUDE_CSS'],
						'INCLUDE_JQUERY'     => $arParams['~INCLUDE_JQUERY'],
						'CACHE_TYPE'         => $arParams['~CACHE_TYPE'],
						'CACHE_TIME'         => $arParams['~CACHE_TIME'],
						'ITEMS_LIMIT'        => $arParams['~LIST_ITEMS_LIMIT'],
						'ACTIVE_DATE_FORMAT' => $arParams['~LIST_ACTIVE_DATE_FORMAT'],
						'SET_TITLE'          => $arParams['~LIST_SET_TITLE'],
						'SHOW_THUMBS'        => $arParams['~LIST_SHOW_THUMBS'],
						'ALLOW'              => $arParams['~LIST_ALLOW'],
						'SHOP_NAME_REPLY'    => $arParams['~LIST_SHOP_NAME_REPLY'],
						'IBLOCK_ID'          => $arParams['~IBLOCK_ID'],
						'SECTION_ID'         => $arParams['~SECTION_ID'],
						'ELEMENT_ID'         => $arParams['~ELEMENT_ID'],
						'ORDER_ID'           => $arParams['~ORDER_ID'],
						'URL'                => $arParams['~URL'],
						'PICTURE'            => $arParams['~PICTURE'],
						'RESIZE_PICTURE'     => $arParams['~RESIZE_PICTURE'],
						'USE_STAT'           => $arParams['~USE_STAT'],
						'USE_USER'           => $arParams['~USE_USER'],

						'SORT_FIELDS'  => $arParams['~LIST_SORT_FIELDS'],
						'SORT_FIELD_1' => $arParams['~LIST_SORT_FIELD_1'],
						'SORT_ORDER_1' => $arParams['~LIST_SORT_ORDER_1'],
						'SORT_FIELD_2' => $arParams['~LIST_SORT_FIELD_2'],
						'SORT_ORDER_2' => $arParams['~LIST_SORT_ORDER_2'],
						'SORT_FIELD_3' => $arParams['~LIST_SORT_FIELD_3'],
						'SORT_ORDER_3' => $arParams['~LIST_SORT_ORDER_3'],

						'MESS_ADD_UNSWER_EVENT_THEME'  => $arParams['~LIST_MESS_ADD_UNSWER_EVENT_THEME'],
						'MESS_ADD_UNSWER_EVENT_TEXT'   => $arParams['~LIST_MESS_ADD_UNSWER_EVENT_TEXT'],
						'MESS_TRUE_BUYER'              => $arParams['~LIST_MESS_TRUE_BUYER'],
						'MESS_HELPFUL_REVIEW'          => $arParams['~LIST_MESS_HELPFUL_REVIEW'],

						//new
						'USE_SUBSCRIBE'                => $arParams['~USE_SUBSCRIBE'],
						'DISPLAY_FIELDS'               => $arParams['~FORM_DISPLAY_FIELDS'],
						'MESS_FIELD_NAME_RATING'       => $arParams['MESS_FIELD_NAME_RATING'],
						'MESS_FIELD_NAME_ORDER_ID'     => $arParams['MESS_FIELD_NAME_ORDER_ID'],
						'MESS_FIELD_NAME_TITLE'        => $arParams['MESS_FIELD_NAME_TITLE'],
						'MESS_FIELD_NAME_ADVANTAGE'    => $arParams['MESS_FIELD_NAME_ADVANTAGE'],
						'MESS_FIELD_NAME_DISADVANTAGE' => $arParams['MESS_FIELD_NAME_DISADVANTAGE'],
						'MESS_FIELD_NAME_ANNOTATION'   => $arParams['MESS_FIELD_NAME_ANNOTATION'],
						'MESS_FIELD_NAME_DELIVERY'     => $arParams['MESS_FIELD_NAME_DELIVERY'],
						'MESS_FIELD_NAME_GUEST_NAME'   => $arParams['MESS_FIELD_NAME_GUEST_NAME'],
						'MESS_FIELD_NAME_GUEST_EMAIL'  => $arParams['MESS_FIELD_NAME_GUEST_EMAIL'],
						'MESS_FIELD_NAME_GUEST_PHONE'  => $arParams['MESS_FIELD_NAME_GUEST_PHONE'],
						'MESS_FIELD_NAME_CITY'         => $arParams['MESS_FIELD_NAME_CITY'],
						'MESS_FIELD_NAME_COMPANY'      => $arParams['~MESS_FIELD_NAME_COMPANY'],
						'MESS_FIELD_NAME_WEBSITE'      => $arParams['~MESS_FIELD_NAME_WEBSITE'],
						'MESS_FIELD_NAME_FILES'        => $arParams['~MESS_FIELD_NAME_FILES'],
						'MESS_FIELD_NAME_VIDEOS'       => $arParams['~MESS_FIELD_NAME_VIDEOS'],

						'THUMBNAIL_WIDTH'  => $arParams['~THUMBNAIL_WIDTH'],
						'THUMBNAIL_HEIGHT' => $arParams['~THUMBNAIL_HEIGHT'],

						'PAGER_THEME'                     => $arParams['~PAGER_THEME'],
						'DISPLAY_TOP_PAGER'               => $arParams['~DISPLAY_TOP_PAGER'],
						'DISPLAY_BOTTOM_PAGER'            => $arParams['~DISPLAY_BOTTOM_PAGER'],
						'PAGER_DESC_NUMBERING'            => $arParams['~PAGER_DESC_NUMBERING'],
						'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['~PAGER_DESC_NUMBERING_CACHE_TIME'],
						'PAGER_SHOW_ALL'                  => $arParams['~PAGER_SHOW_ALL'],
						'PAGER_SHOW_ALWAYS'               => $arParams['~PAGER_SHOW_ALWAYS'],
						'PAGER_TEMPLATE'                  => $arParams['~PAGER_TEMPLATE'],
						'PAGER_TITLE'                     => $arParams['~PAGER_TITLE'],

						'SET_STATUS_404' => $arParams['~SET_STATUS_404'],
						'SHOW_404'       => $arParams['~SHOW_404'],
						'FILE_404'       => $arParams['~FILE_404'],
						'MESSAGE_404'    => $arParams['~MESSAGE_404'],

						'COMPOSITE_FRAME_MODE' => $arParams['~COMPOSITE_FRAME_MODE'],
						'COMPOSITE_FRAME_TYPE' => $arParams['~COMPOSITE_FRAME_TYPE'],

						//'USE_LIST'    => $arParams['~USE_LIST'],
						'DETAIL_HASH'          => $arParams['~DETAIL_HASH'],
						'SEF_MODE'             => $arParams['~SEF_MODE'],
						'SEF_FOLDER'           => $arParams['~SEF_FOLDER'],
						'DETAIL_URL'           => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['detail'],
						'LIST_URL'             => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['list'],
						'USER_URL'             => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['user'],
				 ),
				 $component
			); ?>
		</div>
		<?
		$dynamicArea->finishDynamicArea();
		?>
	</div>
<?
ob_start();
?>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$.fn.apiReviews();
	});
</script>
<?
$html = ob_get_contents();
ob_end_clean();

Asset::getInstance()->addString($html, true, AssetLocation::AFTER_JS);
?>