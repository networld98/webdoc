<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
global $noneSearch;
$noneSearch = 0;
?>
<div class="search-page">
	<?if($arParams["SHOW_TAGS_CLOUD"] == "Y")
	{
		$arCloudParams = Array(
			"SEARCH" => $arResult["REQUEST"]["~QUERY"],
			"TAGS" => $arResult["REQUEST"]["~TAGS"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
			"arrFILTER" => $arParams["arrFILTER"],
			"SORT" => $arParams["TAGS_SORT"],
			"PAGE_ELEMENTS" => $arParams["TAGS_PAGE_ELEMENTS"],
			"PERIOD" => $arParams["TAGS_PERIOD"],
			"URL_SEARCH" => $arParams["TAGS_URL_SEARCH"],
			"TAGS_INHERIT" => $arParams["TAGS_INHERIT"],
			"FONT_MAX" => $arParams["FONT_MAX"],
			"FONT_MIN" => $arParams["FONT_MIN"],
			"COLOR_NEW" => $arParams["COLOR_NEW"],
			"COLOR_OLD" => $arParams["COLOR_OLD"],
			"PERIOD_NEW_TAGS" => $arParams["PERIOD_NEW_TAGS"],
			"SHOW_CHAIN" => "N",
			"COLOR_TYPE" => $arParams["COLOR_TYPE"],
			"WIDTH" => $arParams["WIDTH"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"RESTART" => $arParams["RESTART"],
		);

		if(is_array($arCloudParams["arrFILTER"]))
		{
			foreach($arCloudParams["arrFILTER"] as $strFILTER)
			{
				if($strFILTER=="main")
				{
					$arCloudParams["arrFILTER_main"] = $arParams["arrFILTER_main"];
				}
				elseif($strFILTER=="forum" && IsModuleInstalled("forum"))
				{
					$arCloudParams["arrFILTER_forum"] = $arParams["arrFILTER_forum"];
				}
				elseif(strpos($strFILTER,"iblock_")===0)
				{
					foreach($arParams["arrFILTER_".$strFILTER] as $strIBlock)
						$arCloudParams["arrFILTER_".$strFILTER] = $arParams["arrFILTER_".$strFILTER];
				}
				elseif($strFILTER=="blog")
				{
					$arCloudParams["arrFILTER_blog"] = $arParams["arrFILTER_blog"];
				}
				elseif($strFILTER=="socialnetwork")
				{
					$arCloudParams["arrFILTER_socialnetwork"] = $arParams["arrFILTER_socialnetwork"];
				}
			}
		}
		$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", ".default", $arCloudParams, $component, array("HIDE_ICONS" => "Y"));
	}
	?>
	<form action="" method="get">
		<input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
		<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
	</form>

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>

	<div class="search-result list-item">
	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<p><?=GetMessage("CT_BSP_ERROR")?></p>
		<?ShowError($arResult["ERROR_TEXT"]);?>
		<p><?=GetMessage("CT_BSP_CORRECT_AND_CONTINUE")?></p>
		<br /><br />
		<p><?=GetMessage("CT_BSP_SINTAX")?><br /><b><?=GetMessage("CT_BSP_LOGIC")?></b></p>
		<table border="0" cellpadding="5">
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_OPERATOR")?></td><td valign="top"><?=GetMessage("CT_BSP_SYNONIM")?></td>
				<td><?=GetMessage("CT_BSP_DESCRIPTION")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_AND")?></td><td valign="top">and, &amp;, +</td>
				<td><?=GetMessage("CT_BSP_AND_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_OR")?></td><td valign="top">or, |</td>
				<td><?=GetMessage("CT_BSP_OR_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_NOT")?></td><td valign="top">not, ~</td>
				<td><?=GetMessage("CT_BSP_NOT_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top">( )</td>
				<td valign="top">&nbsp;</td>
				<td><?=GetMessage("CT_BSP_BRACKETS_ALT")?></td>
			</tr>
		</table>
	<?elseif(count($arResult["SEARCH"])>0):?>
		<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
		<?
		$searchArray = [];
		foreach($arResult["SEARCH"] as $arItem):

                $searchArray[$arItem['PARAM2']][] = $arItem['ITEM_ID'];
		endforeach;?>
        <div class="search-result"><?echo GetMessage("CT_BSP_FOUND")?>:
            <? $APPLICATION->ShowViewContent('searchCountClinic'); ?>
            <? $APPLICATION->ShowViewContent('searchCountDoctor'); ?>
            <? $APPLICATION->ShowViewContent('searchCountService'); ?>
        </div>
        <?
          global $arrFilter;
          foreach(array_keys($searchArray) as $iblockId){
            if ($iblockId == 9){$template = "search_clinic";}
            if ($iblockId == 10){
                if($arrFilter["=PROPERTY_94"] !=NULL){
                    $arrFilter["=PROPERTY_115"] = $arrFilter["=PROPERTY_94"];
                    unset($arrFilter["=PROPERTY_94"]);
                }
                if($arrFilter["=PROPERTY_97"] !=NULL){
                    $arrFilter["=PROPERTY_90"] = $arrFilter["=PROPERTY_97"];
                    unset($arrFilter["=PROPERTY_97"]);
                }
                if($arrFilter["=PROPERTY_97"] !=NULL){
                    $arrFilter["=PROPERTY_90"] = $arrFilter["=PROPERTY_97"];
                    unset($arrFilter["=PROPERTY_97"]);
                }
                if($arrFilter["=PROPERTY_83"] !=NULL){
                    $arrFilter["=PROPERTY_124"] = $arrFilter["=PROPERTY_83"];
                    unset($arrFilter["=PROPERTY_83"]);
                }
               if($arrFilter["=PROPERTY_86"] !=NULL){
                    $arrFilter["=PROPERTY_77"] = $arrFilter["=PROPERTY_86"];
                    unset($arrFilter["=PROPERTY_86"]);
                }
               if($arrFilter["=PROPERTY_86"] !=NULL){
                    $arrFilter["=PROPERTY_76"] = $arrFilter["=PROPERTY_84"];
                    unset($arrFilter["=PROPERTY_84"]);
                }
               if($arrFilter["=PROPERTY_85"] !=NULL){
                    $arrFilter["=PROPERTY_123"] = $arrFilter["=PROPERTY_85"];
                    unset($arrFilter["=PROPERTY_85"]);
                }
                 if($arrFilter["=PROPERTY_89"] !=NULL){
                    $arrFilter["=PROPERTY_122"] = $arrFilter["=PROPERTY_89"];
                    unset($arrFilter["=PROPERTY_89"]);
                }
                $template = "search_doctor";
            }
            if ($iblockId == 18 || $iblockId == 19){$template = "search_services";}
             $arrFilter['=ID'] = $searchArray[$iblockId];

           $APPLICATION->IncludeComponent("bitrix:news.list","$template",Array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "Y",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => $iblockId,
                    "PAGER_SHOW_ALL" => "Y",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilter",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "FIELD_CODE" => array(
                        0 => "DETAIL_TEXT",
                        1 => "DETAIL_PICTURE",
                        2 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "DEPARTURE_HOUSE",
                        1 => "CHILDREN_DOCTOR",
                        2 => "DIAGNOSTICS",
                        3 => "RANK",
                        4 => "MAP",
                        5 => "ONLINE",
                        6 => "DMC",
                        7 => "UMC",
                        8 => "METRO",
                        9 => "SPECIALIZATION",
                        10 => "ADDRESS",
                        11 => "DOCTORS",
                        12 => "WORK_TIME",
                        13 => "CONTACTS",
                        14 => "AREA",
                        15 => "COST_PRICE",
                        16 => "REGION",
                        17 => "CITY",
                        18 => "DETAIL_PICTURE",
                        19 => "",
                    ),
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_TEMPLATE" => "show_more",
                    "PAGER_DESC_NUMBERING" => "Y",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_BASE_LINK_ENABLE" => "Y",
                    "SET_STATUS_404" => "Y",
                    "SHOW_404" => "Y",
                    "MESSAGE_404" => "",
                    "PAGER_BASE_LINK" => "",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => ""
                )
            );
          }
           ?>
		<?/*if($arParams["SHOW_ORDER_BY"] != "N"):?>
			<div class="search-sorting"><label><?echo GetMessage("CT_BSP_ORDER")?>:</label>&nbsp;
			<?if($arResult["REQUEST"]["HOW"]=="d"):?>
				<a href="<?=$arResult["URL"]?>&amp;how=r"><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></a>&nbsp;<b><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></b>
			<?else:?>
				<b><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></b>&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d"><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></a>
			<?endif;?>
			</div>
		<?endif;*/?>
	<?else:?>
		<?ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));?>
	<?endif;?>
    <?
    global $noneSearch;
    if($noneSearch === 0){?>
        <div class="search-result list-item">
            <p><font class="notetext">К сожалению, на ваш поисковый запрос ничего не найдено.</font></p>
        </div>
    <?}?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('a[href^="#"]').on('click', function(event) {
                    event.preventDefault();
                    var sc = $(this).attr("href"),
                        dn = $(sc).offset().top;
                    $('html, body').animate({scrollTop: dn - 120}, 1000);
                });
            });
        </script>
	</div>
</div>