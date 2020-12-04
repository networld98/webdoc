<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
    <table class="title-search-result">
        <? global $USER;
        if ($USER->IsAdmin()) {
            echo"<pre>";
            print_r($arResult["CATEGORIES"]);
            echo"</pre>";
        }
        ?>
        <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
            <tr>
                <th class="title-search-separator">&nbsp;</th>
                <td class="title-search-separator">&nbsp;</td>
            </tr>
            <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
                <tr>
                    <?if($i == 0):?>
                        <th>&nbsp;<?echo $arCategory["TITLE"]?></th>
                    <?else:?>
                        <th>&nbsp;</th>
                    <?endif?>
                    <?if($category_id === "all"):?>
                        <td class="title-search-all"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
                    <?elseif(isset($arItem["ICON"])):?>
                        <td class="title-search-item"><a href="<?echo $arItem["URL"]?>"><img src="<?echo $arItem["ICON"]?>"><?echo $arItem["NAME"]?> <?if($arItem['SPEC'] != NULL){?>(<?=$arItem['SPEC']?>)<?}?></a></td>
                    <?else:?>
                        <td class="title-search-more"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
                    <?endif;?>
                </tr>
            <?endforeach;?>
        <?endforeach;?>
        <tr>
            <th class="title-search-separator">&nbsp;</th>
            <td class="title-search-separator">&nbsp;</td>
        </tr>
    </table><div class="title-search-fader"></div>
<?endif;
?>