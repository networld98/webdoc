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
<section class="container services-detail">
    <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
    <div class="fixed-block-ghost"></div>
    <div class="row">
        <div class="col-lg-3">
            <div class="anchor-block fixed-block">
                <ul class="anchor-block-list">
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <?echo $arResult["DETAIL_TEXT"];?>
        </div>
    </div>
</section>