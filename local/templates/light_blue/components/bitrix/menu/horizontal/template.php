<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul class="nav">

    <?
    $previousLevel = 0;
foreach ($arResult as $arItem): ?>

    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? endif ?>

    <? if ($arItem["IS_PARENT"]): ?>

    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
    <li class="nav__item">
    <a href="<?= $arItem["LINK"] ?>"
           class="<? if ($arItem["SELECTED"]):?>root-item-selected<? else:?>root-item<? endif ?>">
        <div class="nav__icon">
            <img src="assets/images/tooth-dentist.svg" alt="">
        </div>
        <div class="nav__header">
            <?= $arItem["TEXT"] ?>
        </div>
    </a>
    <ul>
    <? else: ?>
    <li<? if ($arItem["SELECTED"]):?> class="item-selected nav__item"<? endif ?>><a href="<?= $arItem["LINK"] ?>"
                                                                          class="parent">
        <div class="nav__icon">
            <img src="assets/images/tooth-dentist.svg" alt="">
        </div>
        <div class="nav__header">
            <?= $arItem["TEXT"] ?>
        </div>
    </a>
    <ul>
    <? endif ?>

    <? else:?>

        <? if ($arItem["PERMISSION"] > "D"):?>

            <? if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li class="nav__item"><a href="<?= $arItem["LINK"] ?>"
                       class="<? if ($arItem["SELECTED"]):?>root-item-selected<? else:?>root-item<? endif ?>">
                        <div class="nav__icon">
                            <img src="/<?=$arItem["PARAMS"]["ICON_FILE"]?>" alt="">
                        </div>
                        <div class="nav__header">
                            <?= $arItem["TEXT"] ?>
                        </div>
                    </a>
                </li>
            <? else:?>
                <li<? if ($arItem["SELECTED"]):?> class="item-selected nav__item"<? endif ?>>
                    <a href="<?= $arItem["LINK"] ?>"><div class="nav__icon">
                            <img src="/<?=$arItem["PARAMS"]["ICON_FILE"]?>" alt="">
                        </div>
                        <div class="nav__header">
                            <?= $arItem["TEXT"] ?>
                        </div>
                    </a></li>
            <? endif ?>

        <? else:?>

            <? if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li class="nav__item"><a href="" class="<? if ($arItem["SELECTED"]):?>root-item-selected<? else:?>root-item<? endif ?> "
                       title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>">
                        <div class="nav__icon">
                            <img src="/<?=$arItem["PARAMS"]["ICON_FILE"]?>" alt="">
                        </div>
                        <div class="nav__header">
                            <?= $arItem["TEXT"] ?>
                        </div></a>
                </li>
            <? else:?>
                <li class="nav__item"><a href="" class="denied"
                       title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>">
                        <div class="nav__icon">
                            <img src="/<?=$arItem["PARAMS"]["ICON_FILE"]?>" alt="">
                        </div>
                        <div class="nav__header">
                            <?= $arItem["TEXT"] ?>
                        </div>
                    </a>
                </li>
            <? endif ?>

        <? endif ?>

    <? endif ?>

    <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

<? endforeach ?>

    <? if ($previousLevel > 1)://close last item tags?>
        <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
    <? endif ?>

    </ul>
    <div class="menu-clear-left"></div>
<? endif ?>