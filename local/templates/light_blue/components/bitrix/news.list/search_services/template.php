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
<?if($arResult['ITEMS']!=NULL){?>
<section class="result-filter">
    <div class="row list-item">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-lg-12 card-item">
                <div class="variable-block-item">
                    <h3 class="title-article"><a href="<?if($arParams['IBLOCK_ID'] == 20 || $arParams['IBLOCK_ID'] == 21 || $arParams['IBLOCK_ID'] == 22 ){?>https://lib.webdoc.clinic<?}?><?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME']?></a></h3>
                    <p class="article-preview"><?=$arItem["PREVIEW_TEXT"]?></p>
                </div>
            </div>
        <?endforeach;?>
    </div>
</section>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <br /><?=$arResult["NAV_STRING"]?>
    <?endif;?>
<?}?>

