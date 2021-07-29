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
global $formItem, $priceClinic;
$idService = $arResult['SECTION']['PATH'][0]['ID'];
?>
<table>
<thead>
<tr>
    <td>Вкл.</td>
    <td>Вид <?=$formItem['NAME']?></td>
    <td>Цена, руб.</td>
</tr>
</thead>
<tbody class="list-item-<?=$formItem['ID']?>">

    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <tr class="card-item-<?=$formItem['ID']?> <?if($arItem['NAME'] != $priceClinic[$arItem['NAME']]['NAME'] ){?>disabled<?}?>">
            <input type="hidden" name="<?=$arItem['ID']?>[]SECTION" value="<?=$arParams['PARENT_SECTION_NAME']?>">
            <input type="hidden" name="<?=$arItem['ID']?>[]DATE"  value="<?= date("d.m.y")?>">
            <input type="hidden" name="<?=$arItem['ID']?>[]NAME" value="<?=$arItem['NAME']?>">
            <td>
                <label class="checkbox-group label_price" data-role="label_<?=$arItem['ID']?>[]ACTIVE" for="<?=$arItem['ID']?>[]ACTIVE">
                            <span class="bx_filter_input_checkbox">
                                <input type="checkbox" class="checked-service" <?if($arItem['NAME'] == $priceClinic[$arItem['NAME']]['NAME'] ){?>checked<?}?> name="<?=$arItem['ID']?>[]ACTIVE" id="<?=$arItem['ID']?>[]ACTIVE">
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                            </span>
                </label>
            </td>
            <td><?=ucfirst($arItem['NAME'])?></td>
            <td>
                <input type="text" class="price-service-input" <?if($arItem['NAME'] != $priceClinic[$arItem['NAME']]['NAME'] ){?>disabled<?}?> name="<?=$arItem['ID']?>[]PRICE" value="<?=$priceClinic[$arItem['NAME']]["PRICE"]?>">
                <span><?=$priceClinic[$arItem['NAME']]["DATE"]?></span>
            </td>
        </tr>
    <?endforeach;?>
</tbody>
</table>
<div class="pagination-lc pagination-lc-<?=$formItem['ID']?>">
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <br /><?=$arResult["NAV_STRING"]?>
    <?endif;?>
</div>
