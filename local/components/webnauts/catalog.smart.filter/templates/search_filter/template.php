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

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);
?>
<?
$cityTable = [];
$res = \Bitrix\Sale\Location\LocationTable::getList(array(
    'filter' => array('=TYPE.ID' => '5', '=NAME.LANGUAGE_ID' => LANGUAGE_ID),
    'select' => array('NAME_RU' => 'NAME.NAME', 'EXTERNAL.LOCATION.ID')
));
while ($item = $res->fetch()) {
    $cityTable[$item['NAME_RU']] =  $item['SALE_LOCATION_LOCATION_EXTERNAL_LOCATION_ID'];
}
?>
<div class="bx_filter <?=$templateData["TEMPLATE_CLASS"]?> bx_horizontal">
	<div class="bx_filter_section container">
	<?/*	<div class="bx_filter_title"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></div>*/?>
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter main-filter">
            <div class="row">
                <div class="col-12 col-sm-11">
                    <div class="bx_filter_parameters_box active col-12 col-sm-6 search-order">
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container checkboxes">
                                <?$APPLICATION->IncludeComponent(
                                "webnauts:search.title",
                                "custom",
                                array(
                                    "SHOW_INPUT" => "Y",
                                    "INPUT_ID" => "title-search-input",
                                    "CONTAINER_ID" => "title-search",
                                    "PRICE_CODE" => array(
                                        0 => "BASE",
                                        1 => "RETAIL",
                                    ),
                                    "PRICE_VAT_INCLUDE" => "Y",
                                    "PREVIEW_TRUNCATE_LEN" => "150",
                                    "SHOW_PREVIEW" => "Y",
                                    "PREVIEW_WIDTH" => "75",
                                    "PREVIEW_HEIGHT" => "75",
                                    "CONVERT_CURRENCY" => "Y",
                                    "CURRENCY_ID" => "RUB",
                                    "PAGE" => "#SITE_DIR#search/index.php",
                                    "NUM_CATEGORIES" => "6",
                                    "TOP_COUNT" => "10",
                                    "ORDER" => "date",
                                    "USE_LANGUAGE_GUESS" => "Y",
                                    "CHECK_DATES" => "Y",
                                    "SHOW_OTHERS" => "N",
                                    "CATEGORY_0_TITLE" => "Клиники",
                                    "CATEGORY_0" => array(
                                        0 => "iblock_content",
                                    ),
                                    "CATEGORY_0_iblock_news" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_1_TITLE" => "Врачи",
                                    "CATEGORY_1" => array(
                                        0 => "iblock_content",
                                    ),
                                    "CATEGORY_1_forum" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_2_TITLE" => "Услуги",
                                    "CATEGORY_2" => array(
                                        0 => "iblock_content",
                                    ),
                                    "CATEGORY_2_iblock_books" => "all",

                                    "CATEGORY_3_TITLE" => "Болезни",
                                    "CATEGORY_3" => array(
                                        0 => "iblock_content",
                                    ),
                                    "CATEGORY_3_iblock_illness" => "all",

                                    "CATEGORY_4_TITLE" => "Симптомы",
                                    "CATEGORY_4" => array(
                                        0 => "iblock_content",
                                    ),
                                    "CATEGORY_4_iblock_symptoms" => "all",

                                    "CATEGORY_5_TITLE" => "Статьи",
                                    "CATEGORY_5" => array(
                                        0 => "iblock_content",
                                    ),
                                    "CATEGORY_5_iblock_articles" => "all",

                                    "CATEGORY_0_iblock_content" => array(
                                        0 => "9",
                                    ),
                                    "CATEGORY_1_iblock_content" => array(
                                        0 => "10",
                                    ),
                                    "CATEGORY_2_iblock_content" => array(
                                        0 => "18",
                                        1 => "19",
                                    ),

                                    "CATEGORY_3_iblock_content" => array(
                                        0 => "21",
                                    ),

                                    "CATEGORY_4_iblock_content" => array(
                                        0 => "22",
                                    ),

                                    "CATEGORY_5_iblock_content" => array(
                                        0 => "20",
                                    ),
                                ),
                                false
                            );?>
                            </div>
                        </div>
                    </div>
                    <?foreach($arResult["HIDDEN"] as $arItem):?>
                        <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
                    <?endforeach;
                    //not prices
                    foreach($arResult["ITEMS"] as $key=>$arItem)
                    {
                        if(
                            empty($arItem["VALUES"])
                            || isset($arItem["PRICE"])
                        )
                            continue;

                        if (
                            $arItem["DISPLAY_TYPE"] == "A"
                            && (
                                $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                            )
                        )
                            continue;
                        if ($arItem['CODE'] != "SPECIALIZATION" && $arItem['CODE'] != "SPECIALIZATION_MAIN") { ?>
                            <div class="bx_filter_parameters_box <?
                            if ($arItem["DISPLAY_EXPANDED"] == "Y"): ?>active<?endif ?> <?
                            if ($arItem["DISPLAY_TYPE"] == "P") : ?>col-12 col-sm-6<?endif ?>">
                                <span class="bx_filter_container_modef"></span>
                                <!--					<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)">-->
                                <?//=$arItem["NAME"]?><!--</div>-->
                                <div class="bx_filter_block">
                                    <div class="bx_filter_parameters_box_container checkboxes">
                                        <?
                                        $arCur = current($arItem["VALUES"]);
                                        switch ($arItem["DISPLAY_TYPE"]) {
                                        case "A"://NUMBERS_WITH_SLIDER
                                            ?>
                                            <div class="bx_filter_parameters_box_container_block">
                                                <div class="bx_filter_input_container">
                                                    <input
                                                            class="min-price"
                                                            type="text"
                                                            name="<?
                                                            echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                            id="<?
                                                            echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                            value="<?
                                                            echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                            size="5"
                                                            onkeyup="smartFilter.keyup(this)"
                                                    />
                                                </div>
                                            </div>
                                            <div class="bx_filter_parameters_box_container_block">
                                                <div class="bx_filter_input_container">
                                                    <input
                                                            class="max-price"
                                                            type="text"
                                                            name="<?
                                                            echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                            id="<?
                                                            echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                            value="<?
                                                            echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                            size="5"
                                                            onkeyup="smartFilter.keyup(this)"
                                                    />
                                                </div>
                                            </div>
                                            <div style="clear: both;"></div>

                                            <div class="bx_ui_slider_track" id="drag_track_<?= $key ?>">
                                                <?
                                                $value1 = $arItem["VALUES"]["MIN"]["VALUE"];
                                                $value2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4);
                                                $value3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 2);
                                                $value4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) * 3) / 4);
                                                $value5 = $arItem["VALUES"]["MAX"]["VALUE"];
                                                ?>
                                                <div class="bx_ui_slider_part p1"><span><?= $value1 ?></span></div>
                                                <div class="bx_ui_slider_part p2"><span><?= $value2 ?></span></div>
                                                <div class="bx_ui_slider_part p3"><span><?= $value3 ?></span></div>
                                                <div class="bx_ui_slider_part p4"><span><?= $value4 ?></span></div>
                                                <div class="bx_ui_slider_part p5"><span><?= $value5 ?></span></div>

                                                <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;"
                                                     id="colorUnavailableActive_<?= $key ?>"></div>
                                                <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;"
                                                     id="colorAvailableInactive_<?= $key ?>"></div>
                                                <div class="bx_ui_slider_pricebar_V" style="left: 0;right: 0;"
                                                     id="colorAvailableActive_<?= $key ?>"></div>
                                                <div class="bx_ui_slider_range" id="drag_tracker_<?= $key ?>"
                                                     style="left: 0;right: 0;">
                                                    <a class="bx_ui_slider_handle left" style="left:0;"
                                                       href="javascript:void(0)" id="left_slider_<?= $key ?>"></a>
                                                    <a class="bx_ui_slider_handle right" style="right:0;"
                                                       href="javascript:void(0)" id="right_slider_<?= $key ?>"></a>
                                                </div>
                                            </div>
                                        <?
                                        $arJsParams = array(
                                            "leftSlider" => 'left_slider_' . $key,
                                            "rightSlider" => 'right_slider_' . $key,
                                            "tracker" => "drag_tracker_" . $key,
                                            "trackerWrap" => "drag_track_" . $key,
                                            "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                            "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                            "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                            "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                            "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                            "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                            "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                                            "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                            "precision" => $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0,
                                            "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                                            "colorAvailableActive" => 'colorAvailableActive_' . $key,
                                            "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
                                        );
                                        ?>
                                            <script type="text/javascript">
                                                BX.ready(function () {
                                                    window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                                });
                                            </script>
                                        <?
                                        break;
                                        case "B"://NUMBERS
                                        ?>
                                            <div class="bx_filter_parameters_box_container_block">
                                                <div class="bx_filter_input_container">
                                                    <input
                                                            class="min-price"
                                                            type="text"
                                                            name="<?
                                                            echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                            id="<?
                                                            echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                            value="<?
                                                            echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                            size="5"
                                                            onkeyup="smartFilter.keyup(this)"
                                                    />
                                                </div>
                                            </div>
                                            <div class="bx_filter_parameters_box_container_block">
                                                <div class="bx_filter_input_container">
                                                    <input
                                                            class="max-price"
                                                            type="text"
                                                            name="<?
                                                            echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                            id="<?
                                                            echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                            value="<?
                                                            echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                            size="5"
                                                            onkeyup="smartFilter.keyup(this)"
                                                    />
                                                </div>
                                            </div>
                                        <?
                                        break;
                                        case "P"://DROPDOWN
                                        $checkedItemExist = false;
                                        ?>
                                            <div class="bx_filter_select_container">
                                                <div class="bx_filter_select_block"
                                                     onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                                    <?
                                                    if ($arItem['CODE'] != "SPECIALIZATION") { ?>
                                                        <input type="text" class="city_input" value=""
                                                               onkeyup="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')"
                                                               id="city_input_search_<?= CUtil::JSEscape($key) ?>">
                                                    <?
                                                    } ?>
                                                    <div class="bx_filter_select_text" data-role="currentOption"><?
                                                        foreach ($arItem["VALUES"] as $val => $ar) {
                                                            if ($ar["CHECKED"]) {
                                                                echo trim($ar["VALUE"], ".");
                                                                $checkedItemExist = true;
                                                            }
                                                        }
                                                        if (!$checkedItemExist) {
                                                            if ($arItem['CODE'] == "CITY") {
                                                                echo GetMessage("CT_BCSF_FILTER_CITY");
                                                            } else {
                                                                echo GetMessage("CT_BCSF_FILTER_ALL");
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="bx_filter_select_arrow"></div>
                                                    <input
                                                            style="display: none"
                                                            type="radio"
                                                            name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                                            id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                            value=""
                                                    />
                                                    <?
                                                    foreach ($arItem["VALUES"] as $val => $ar):?>
                                                        <input
                                                                style="display: none"
                                                                type="radio"
                                                                name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                                id="<?= $ar["CONTROL_ID"] ?>"
                                                                value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                        />
                                                    <?endforeach ?>
                                                    <div class="bx_filter_select_popup" data-role="dropdownContent"
                                                         style="display: none;">
                                                        <ul>
                                                            <li>
                                                                <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                                       class="bx_filter_param_label"
                                                                       data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                                       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                                                    <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                                </label>
                                                            </li>
                                                            <?
                                                            foreach ($arItem["VALUES"] as $val => $ar):
                                                                $class = "";
                                                                if ($ar["CHECKED"])
                                                                    $class .= " selected";
                                                                if ($ar["DISABLED"])
                                                                    $class .= " disabled";
                                                                ?>
                                                                <li>
                                                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                                                           class="bx_filter_param_label<?= $class ?> bx_filter_param_label_<?= CUtil::JSEscape($key) ?>  bx_filter_param_label_<?echo trim($ar["VALUE"], ".") ?>" data-id="<?=$cityTable[trim($ar["VALUE"], ".")]?>"
                                                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')"><?
                                                                        echo trim($ar["VALUE"], ".") ?></label>
                                                                </li>
                                                            <?endforeach ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?
                                        break;
                                        case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                                        ?>
                                            <div class="bx_filter_select_container">
                                                <div class="bx_filter_select_block"
                                                     onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                                    <div class="bx_filter_select_text" data-role="currentOption">
                                                        <?
                                                        $checkedItemExist = false;
                                                        foreach ($arItem["VALUES"] as $val => $ar):
                                                            if ($ar["CHECKED"]) {
                                                                ?>
                                                                <?
                                                                if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                    <span class="bx_filter_btn_color_icon"
                                                                          style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                                <?endif ?>
                                                                <span class="bx_filter_param_text">
														<?= $ar["VALUE"] ?>
													</span>
                                                                <?
                                                                $checkedItemExist = true;
                                                            }
                                                        endforeach;
                                                        if (!$checkedItemExist) {
                                                            ?><span class="bx_filter_btn_color_icon all"></span> <?
                                                            echo GetMessage("CT_BCSF_FILTER_ALL");
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="bx_filter_select_arrow"></div>
                                                    <input
                                                            style="display: none"
                                                            type="radio"
                                                            name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                                            id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                            value=""
                                                    />
                                                    <?
                                                    foreach ($arItem["VALUES"] as $val => $ar):?>
                                                        <input
                                                                style="display: none"
                                                                type="radio"
                                                                name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                                id="<?= $ar["CONTROL_ID"] ?>"
                                                                value="<?= $ar["HTML_VALUE_ALT"] ?>"
                                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                        />
                                                    <?endforeach ?>
                                                    <div class="bx_filter_select_popup" data-role="dropdownContent"
                                                         style="display: none">
                                                        <ul>
                                                            <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                                                <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                                       class="bx_filter_param_label"
                                                                       data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                                       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                                                    <span class="bx_filter_btn_color_icon all"></span>
                                                                    <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                                </label>
                                                            </li>
                                                            <?
                                                            foreach ($arItem["VALUES"] as $val => $ar):
                                                                $class = "";
                                                                if ($ar["CHECKED"])
                                                                    $class .= " selected";
                                                                if ($ar["DISABLED"])
                                                                    $class .= " disabled";
                                                                ?>
                                                                <li>
                                                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                           class="bx_filter_param_label<?= $class ?>"
                                                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')">
                                                                        <?
                                                                        if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                            <span class="bx_filter_btn_color_icon"
                                                                                  style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                                        <?endif ?>
                                                                        <span class="bx_filter_param_text">
															<?= $ar["VALUE"] ?>
														</span>
                                                                    </label>
                                                                </li>
                                                            <?endforeach ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?
                                        break;
                                        case "K"://RADIO_BUTTONS
                                        ?>
                                            <label class="bx_filter_param_label"
                                                   for="<? echo "all_" . $arCur["CONTROL_ID"] ?>">
									<span class="bx_filter_input_checkbox">
										<input
                                                type="radio"
                                                value=""
                                                name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                onclick="smartFilter.click(this)"
                                        />
										<span class="bx_filter_param_text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
									</span>
                                            </label>
                                            <?
                                        foreach ($arItem["VALUES"] as $val => $ar):?>
                                            <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                   class="bx_filter_param_label" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx_filter_input_checkbox <? echo $ar["DISABLED"] ? 'disabled' : '' ?>">
											<input
                                                    type="radio"
                                                    value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                    name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                    onclick="smartFilter.click(this)"
                                            />
											<span class="bx_filter_param_text" title="<?= $ar["VALUE"]; ?>"
                                                  onclick="smartFilter.hideFilterProps(this)"><?= $arItem["NAME"] ?><?
                                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                    ?> (<span
                                                        data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                endif; ?></span>
										</span>
                                            </label>
                                        <?
                                        endforeach;
                                            ?>
                                            <?
                                        foreach ($arItem["VALUES"] as $val => $ar):?>
                                            <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                   class="bx_filter_param_label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                                   for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx_filter_input_checkbox">
											<input
                                                    type="checkbox"
                                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                    onclick="smartFilter.click(this)"
                                            />
											        <div class="checkbox"><img
                                                                src="/local/templates/light_blue/assets/images/checkbox.svg"
                                                                alt=""></div>
											<span class="bx_filter_param_text" title="<?= $ar["VALUE"]; ?>"
                                                  onclick="smartFilter.hideFilterProps(this)"><?= $arItem["NAME"] ?><?
                                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                    ?> (<span
                                                        data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                endif; ?>
                                            </span>
										</span>
                                            </label>
                                        <?
                                        endforeach;
                                            ?>
                                        <?
                                        }
                                        ?>
                                    </div>
                                    <div class="clb"></div>
                                </div>
                            </div>
                            <?
                        }else{
                            foreach ($arItem["VALUES"] as $val => $ar) {
                                if ($ar["CHECKED"]) {
                                    $checkedItemExist = true;
                                    if ($arItem['CODE'] == "SPECIALIZATION") {
                                        $GLOBALS['titleFilterClinic'] = $ar["VALUE"];
                                    }
                                    if ($arItem['CODE'] == "SPECIALIZATION_MAIN") {
                                        $GLOBALS['titleFilterClinic'] = $ar["VALUE"];
                                    }
                                    $checkedItemExist = true;
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-12 col-sm-1">
                    <div class="bx_filter_button_box active">
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container" id="modez">
                                <?/*  <input class="bx_filter_search_button" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />*/?>
                                <?/*<input class="bx_filter_search_reset" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />*/?>
                               <div id="modef">
                                    <a class="bx_filter_search_button"  href="<?if($APPLICATION->GetCurDir() != "/search/"){?>/search<?}?><?echo $arResult["FILTER_URL"]?>" ><?=GetMessage("CT_BCSF_SET_FILTER")?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <?foreach($arResult["HIDDEN"] as $arItem):?>
                        <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
                    <?endforeach;
                    //not prices
                    foreach($arResult["ITEMS"] as $key=>$arItem)
                    {
                        if(
                            empty($arItem["VALUES"])
                            || isset($arItem["PRICE"])
                        )
                            continue;

                        if (
                            $arItem["DISPLAY_TYPE"] == "A"
                            && (
                                $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                            )
                        )
                            continue;

                        if($arParams['NOT_FILTER'] == 'N'){
                            $show = false;
                        }elseif($arParams['NOT_FILTER'] == 'Y'){
                            $show = true;
                        }
                         if (strpos($arItem["CODE"], 'NOT') === $show) {?>
                        <div class="bx_filter_parameters_box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>active<?endif?>" <?if ($arItem["DISPLAY_TYPE"] == "P") :?>style="display: none"<?endif?>>
                            <span class="bx_filter_container_modef"></span>
                            <!--					<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)">--><?//=$arItem["NAME"]?><!--</div>-->
                            <div class="bx_filter_block">
                                <div class="bx_filter_parameters_box_container checkboxes 1">
                                    <?
                                    $arCur = current($arItem["VALUES"]);
                                    switch ($arItem["DISPLAY_TYPE"])
                                    {
                                    case "A"://NUMBERS_WITH_SLIDER
                                        ?>

                                        <div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
                                            <?
                                            $value1 = $arItem["VALUES"]["MIN"]["VALUE"];
                                            $value2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/4);
                                            $value3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/2);
                                            $value4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])*3)/4);
                                            $value5 = $arItem["VALUES"]["MAX"]["VALUE"];
                                            ?>
                                            <div class="bx_ui_slider_part p1"><span><?=$value1?></span></div>
                                            <div class="bx_ui_slider_part p2"><span><?=$value2?></span></div>
                                            <div class="bx_ui_slider_part p3"><span><?=$value3?></span></div>
                                            <div class="bx_ui_slider_part p4"><span><?=$value4?></span></div>
                                            <div class="bx_ui_slider_part p5"><span><?=$value5?></span></div>

                                            <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                                            <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                                            <div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                                            <div class="bx_ui_slider_range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
                                                <a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                                                <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                                            </div>
                                        </div>
                                    <?
                                    $arJsParams = array(
                                        "leftSlider" => 'left_slider_'.$key,
                                        "rightSlider" => 'right_slider_'.$key,
                                        "tracker" => "drag_tracker_".$key,
                                        "trackerWrap" => "drag_track_".$key,
                                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                        "precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
                                        "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                                        "colorAvailableActive" => 'colorAvailableActive_'.$key,
                                        "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
                                    );
                                    ?>
                                        <script type="text/javascript">
                                            BX.ready(function(){
                                                window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                            });
                                        </script>
                                    <?
                                    break;
                                    case "B"://NUMBERS
                                    ?>
                                        <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
                                                <input
                                                        class="min-price"
                                                        type="text"
                                                        name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                        id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                                        value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                                        size="5"
                                                        onkeyup="smartFilter.keyup(this)"
                                                />
                                            </div></div>
                                        <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
                                                <input
                                                        class="max-price"
                                                        type="text"
                                                        name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                        id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                                        value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                                        size="5"
                                                        onkeyup="smartFilter.keyup(this)"
                                                />
                                            </div></div>
                                    <?
                                    break;
                                    case "G"://CHECKBOXES_WITH_PICTURES
                                    ?>
                                    <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                    <input
                                            style="display: none"
                                            type="checkbox"
                                            name="<?=$ar["CONTROL_NAME"]?>"
                                            id="<?=$ar["CONTROL_ID"]?>"
                                            value="<?=$ar["HTML_VALUE"]?>"
                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                    />
                                        <?
                                        $class = "";
                                        if ($ar["CHECKED"])
                                            $class.= " active";
                                        if ($ar["DISABLED"])
                                            $class.= " disabled";
                                        ?>
                                        <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label dib<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                            <?endif?>
										</span>
                                        </label>
                                    <?endforeach?>
                                    <?
                                    break;
                                    case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                                    ?>
                                    <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                    <input
                                            style="display: none"
                                            type="checkbox"
                                            name="<?=$ar["CONTROL_NAME"]?>"
                                            id="<?=$ar["CONTROL_ID"]?>"
                                            value="<?=$ar["HTML_VALUE"]?>"
                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                    />
                                        <?
                                        $class = "";
                                        if ($ar["CHECKED"])
                                            $class.= " active";
                                        if ($ar["DISABLED"])
                                            $class.= " disabled";
                                        ?>
                                        <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                            <?endif?>
										</span>
                                            <span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?><?
                                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                    ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                endif;?></span>
                                        </label>
                                    <?endforeach?>
                                    <?
                                    break;
                                    case "P"://DROPDOWN
                                    $checkedItemExist = false;
                                    ?>
                                    <?
                                    break;
                                    case "K"://RADIO_BUTTONS
                                    ?>
                                        <label class="bx_filter_param_label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
									<span class="bx_filter_input_checkbox">
										<input
                                                type="radio"
                                                value=""
                                                name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                                onclick="smartFilter.click(this)"
                                        />
										<span class="bx_filter_param_text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
									</span>
                                        </label>
                                        <?foreach($arItem["VALUES"] as $val => $ar):?>
                                        <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx_filter_input_checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
											<input
                                                    type="radio"
                                                    value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                    name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                    onclick="smartFilter.click(this)"
                                            />
											<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?><?
                                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                    ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                endif;?></span>
										</span>
                                        </label>
                                    <?endforeach;?>
                                    <?
                                    break;
                                    case "U"://CALENDAR
                                    ?>
                                        <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container bx_filter_calendar_container">
                                                <?$APPLICATION->IncludeComponent(
                                                    'bitrix:main.calendar',
                                                    '',
                                                    array(
                                                        'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                                        'SHOW_INPUT' => 'Y',
                                                        'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                        'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                                        'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                                        'SHOW_TIME' => 'N',
                                                        'HIDE_TIMEBAR' => 'Y',
                                                    ),
                                                    null,
                                                    array('HIDE_ICONS' => 'Y')
                                                );?>
                                            </div></div>
                                        <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container bx_filter_calendar_container">
                                                <?$APPLICATION->IncludeComponent(
                                                    'bitrix:main.calendar',
                                                    '',
                                                    array(
                                                        'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                                        'SHOW_INPUT' => 'Y',
                                                        'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                        'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                                        'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                                        'SHOW_TIME' => 'N',
                                                        'HIDE_TIMEBAR' => 'Y',
                                                    ),
                                                    null,
                                                    array('HIDE_ICONS' => 'Y')
                                                );?>
                                            </div></div>
                                    <?
                                    break;
                                    default://CHECKBOXES
                                    ?>
                                    <?foreach($arItem["VALUES"] as $val => $ar):?>
                                        <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx_filter_input_checkbox">
											<input
                                                    type="checkbox"
                                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                    onclick="smartFilter.click(this)"
                                            />
											        <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
											<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?><?
                                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                    ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                endif;?>
                                            </span>
										</span>
                                        </label>
                                    <?endforeach;?>
                                    <?
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?}
                    }
                    ?>
                </div>
            </div>
            <div class="search-doctors">Найти</div>
		</form>
		<div style="clear: both;"></div>
	</div>
</div>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', 'horizontal');
    $(document).ready(function () {
        geoCity = getCookie('bxmaker.geoip.2.4.2_city');
        if(getCookie('displayBtnSearch') == 'false') {
            $('.search-doctors').hide();
            $('.clinic-card .main-filter').css({'padding-top': '32px', 'padding-bottom': '29px'});
            $('.main-filter > .row').css({'display': 'flex'});
        }
        $('.bx_filter_param_label_'+geoCity).trigger('click');
        $('.popup-window').hide();
        let city = $('.city_input');
        city.css('color','transparent');
        let city_input = city.val();
        let city_name = $('.bx_filter_param_label');
        city_name.on('click',function() {
            document.cookie = "displayBtnSearch=false; path=/;"
            window.BXmakerGeoIPCity.selectLocation($(this).data('id'));
        });
        city.on('focus',function() {
            $(this).css('color','black');
        });
        city.focus(function() {
            $(this).parent('.bx_filter_select_block').trigger('click');
        });
        city.mouseout(function() {
            $('.bx_filter_select_text').show();
            city.val('');
        });
        city.on('keyup',function() {
            var select = $(this).val();
            if (select.length >= 1) {
                $(this).parent('.bx_filter_select_block').find('.bx_filter_select_text').hide();
                $('.bx_filter_param_label_94').hide();
                $('.bx_filter_param_label_115').hide();
                $('#smartFilterDropDown94 .bx_filter_param_label').each(function( index ) {
                    if ($(this).text().toLowerCase().indexOf(select) === 0) {
                        $('.bx_filter_param_label_'+ $( this ).text() ).show();
                    }else if ($(this).text().indexOf(select) === 0) {
                        $('.bx_filter_param_label_'+ $( this ).text() ).show();
                    }
                });
                $('#smartFilterDropDown115 .bx_filter_param_label').each(function( index ) {
                    if ($(this).text().toLowerCase().indexOf(select) === 0) {
                        $('.bx_filter_param_label_'+ $( this ).text() ).show();
                    }else if ($(this).text().indexOf(select) === 0) {
                        $('.bx_filter_param_label_'+ $( this ).text() ).show();
                    }
                });
            }else{
                $('.bx_filter_param_label_94').show();
                $('.bx_filter_param_label_115').show();
                $(this).parent('.bx_filter_select_block').find('bx_filter_select_text').show();
            }
        });
        $('.bx_filter_param_label_94').on('click',function () {
            $('.bx_filter_select_text').show();
            city.css('color','transparent');
        });
        $('.bx_filter_param_label_115').on('click',function () {
            $('.bx_filter_select_text').show();
            city.css('color','transparent');
        });
        if (city_input !== '' || city_input !== null) {
            $('.bx_filter_select_text').show();
            city.css('color','transparent');
        }
    });
</script>