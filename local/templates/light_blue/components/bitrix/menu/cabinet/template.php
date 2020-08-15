<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult)): ?>
    <ul class="personal-cabinet-menu__list">
    <?
    $previousLevel = 0;
foreach ($arResult as $arItem): ?>
        <li class="personal-cabinet-menu__list-item <? if ($arItem["SELECTED"]):?>active<? else:?>unactive<? endif ?>">
            <a href="<?= $arItem["LINK"] ?>">
                <div class="personal-cabinet-menu__icon <? if ($arItem["SELECTED"]):?>active<? else:?>unactive<? endif ?>" style="background-image: url(<? if ($arItem["SELECTED"]):?><?=$arItem["PARAMS"]["ICON_FILE"]?><? else:?><?=$arItem["PARAMS"]["ICON_FILE_UN"]?><? endif ?>">
                </div>
                <div class="personal-cabinet-menu__desc">
                    <h5><?= $arItem["TEXT"] ?></h5>
                    <span><?=$arItem["PARAMS"]["SPAN"]?></span>
                </div>
            </a>
        </li>
    <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>
<? endforeach ?>
    </ul>
<? endif ?>