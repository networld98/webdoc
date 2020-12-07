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
<?
global $noneSearch;
global $countSearchService;
global $countSearchIllness;
global $countSearchArticles;
global $countSearchSymptoms;
if($countSearchService==NULL && ($arParams['IBLOCK_ID'] == 18 || $arParams['IBLOCK_ID'] == 19)){
    $countSearchService = count($arResult['ITEMS']);
    $this->SetViewTarget('searchCountService'); ?>
    <? if ($countSearchService != NULL) { ?><a href="#blockService">
        <strong><?= $countSearchService ?></strong> услуг(а); <? } ?></a>
    <? $this->EndViewTarget();
}elseif($countSearchIllness==NULL && $arParams['IBLOCK_ID'] == 21){
    $countSearchIllness = count($arResult['ITEMS']);
    $this->SetViewTarget('searchCountService'); ?>
    <? if ($countSearchIllness != NULL) { ?><a href="#blockIllness">
        <strong><?= $countSearchIllness ?></strong> болезнь(ей); <? } ?></a>
    <? $this->EndViewTarget();
}elseif($countSearchSymptoms==NULL && $arParams['IBLOCK_ID'] == 22){
    $countSearchSymptoms = count($arResult['ITEMS']);
    $this->SetViewTarget('searchCountService'); ?>
    <? if ($countSearchSymptoms != NULL) { ?><a href="#blockSymptoms">
        <strong><?= $countSearchSymptoms ?></strong> симптом(ов); <? } ?></a>
    <? $this->EndViewTarget();
}elseif($countSearchArticles==NULL && $arParams['IBLOCK_ID'] == 21){
    $countSearchArticles = count($arResult['ITEMS']);
    $this->SetViewTarget('searchCountService'); ?>
    <? if ($countSearchArticles != NULL) { ?><a href="#blockArticles">
        <strong><?= $countSearchArticles ?></strong> статья(и); <? } ?></a>
    <? $this->EndViewTarget();
}?>
<?if($arResult['ITEMS']!=NULL){
$noneSearch++;
?>
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