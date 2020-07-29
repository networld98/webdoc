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

use Bitrix\Main\Page\Asset,
	 Bitrix\Main\Page\AssetLocation,
	 Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

Loc::loadMessages(__FILE__);
global $rating;
if(method_exists($this, 'setFrameMode'))
	$this->setFrameMode(true);
?>
    <style>
        .api-reviews-filter .clinic-card-full-desc__content__feedback-item-left__mark .text {
            margin: 0;
            border: none;
            background: transparent;
            padding: 0 5px;
        }
        .api-reviews-filter .clinic-card-full-desc__content__feedback-item-left__mark {
            margin-bottom: 0 ;
        }
        .api-star-rating .count {
            padding: 3px 7px;
            font-family: "Ubuntu";
            font-style: normal;
            font-weight: 300;
            font-size: 15px;
            line-height: 24px;
            color: #000000;
            border-radius: 5px;
        }
    </style>
	<div id="<?=$arParams['FORM_ID']?>" class="api-reviews-filter clinic-card-full-desc__content__feedback__radio-group">
		<ul class="api-filters">
			<? for($i = 5; $i >= 1; $i--): ?>
				<?
				$active = (in_array($i, $arResult['SESSION_RATING']));
				?>
                <li>
                    <a href="<?=$APPLICATION->GetCurPageParam('arfilter=1&arrating=' . join('|', array_merge(array($i),$arResult['SESSION_RATING'])), array('arfilter', 'arrating'))?>"
                       class="api-filters-item clinic-card-full-desc__content__feedback-item-left__mark <?if($i==1||$i==2){?>pink<?}elseif ($i==3||$i==4){?>orange<?}else{?>green<?}?> <?=$active ? 'api-active' : ''?>"
                       data-rating="<?=$i?>"
                       rel="nofollow">
                        <span class="text">
                            <?if($i==1){?>
                                Ужасно
                            <?}elseif ($i==2){?>
                                Плохо
                            <?}elseif ($i==3){?>
                                Нормально
                            <?}elseif ($i==4){?>
                                Хорошо
                            <?}elseif ($i==5){?>
                                Отлично
                            <?}?>
                        </span>
                        <span class="count <?if($i==1||$i==2){?>pink<?}elseif ($i==3||$i==4){?>orange<?}else{?>green<?}?>"><?=$rating[$i]?></span>
                        <? if($active): ?>
                            <span class="api-del-filter js-delFilter" data-rating="<?=$i?>">&times;</span>
                        <? endif; ?>
                    </a>
                </li>
			<? endfor ?>
		</ul>
	</div>
<?
ob_start();
?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$.fn.apiReviewsFilter();
		});
	</script>
<?
$html = ob_get_contents();
ob_end_clean();

Asset::getInstance()->addString($html, true, AssetLocation::AFTER_JS);