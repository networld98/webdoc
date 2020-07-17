<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<form action="#" class="filterEl">
    <?foreach($arResult['PROPERTIES'] as $prop):?>
        <?if(
                $prop['PROPERTY_TYPE'] == 'E' ||
                $prop['PROPERTY_TYPE'] == 'G' ||
                $prop['PROPERTY_TYPE'] == 'S' ||
                ($prop['PROPERTY_TYPE'] == 'L' && $prop['DISPLAY_TYPE'] == 'P')
        ): ?>
            <div class="select-wrap<?=($prop['CODE'] == 'ACTION_YEAR')? ' ml-auto w-auto':''?>">
                <select class="filter-field select-primary" name="<?=$prop['CODE']?>">
                        <?if($prop['CODE'] != 'ACTION_YEAR' && $prop['CODE'] != 'ATT_YEAR'  && $prop['CODE'] != 'YEAR'):?>
                            <option value=""><?=$prop['NAME']?></option>
                        <?endif;?>
                    <?foreach($prop['FIELDS'] as $field):?>
                        <option value="<?=$field['VALUE']?>"<?=($field['CHECKED'] == 'Y')? ' selected="selected"' : '';?>><?=$field['NAME']?></option>
                    <?endforeach;?>
                </select>
            </div>
        <?elseif($prop['PROPERTY_TYPE'] == 'L'):?>
                <div class="check-primary">
                    <?foreach($prop['FIELDS'] as $field):?>
                        <input class="filter-field" id="action-check-<?=strtolower($prop['CODE'])?>" name="<?=$prop['CODE']?>" type="checkbox" <?=($field['CHECKED'] == 'Y')? 'checked="checked"' : '';?>>
                        <label for="action-check-<?=strtolower($prop['CODE'])?>"><span class="boxCb"></span><?=$prop['NAME']?></label>
                    <?endforeach;?>
                </div>
        <?endif;?>
    <?endforeach;?>
    <?if($arParams['SHOW_ELEMENT_COUNT'] == 'Y') : ?>
        <div class="select-wrap ml-auto w-auto">
            <p class="text">На странице</p>
            <select class="filter-field select-primary" name="ELEMENT_COUNT">
                <option value="5">5</option>
                <option value="30">30</option>
                <option value="60">60</option>
                <option value="90">90</option>
            </select>
        </div>
    <?endif;?>
</form>
