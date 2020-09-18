<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
foreach ($_POST as $key => $id){
    $_POST['ID'] = $key;
}
$metroInCity = CIBlockSection::GetSectionElementsCount($_POST['ID'], Array("CNT_ACTIVE"=>"Y"));
if($metroInCity>0):?>
        <label for="">Станции метро</label>
        <div class="metro-container">
            <ul class="checkbox-group">
                <?
                $arSelect = array("ID", "NAME");
                $arFilter = array("IBLOCK_ID"=>14, 'IBLOCK_SECTION_ID'=> $_POST['ID']);
                $res = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilter,false, false, $arSelect);
                while($ob = $res->GetNextElement()){
                    $arField = $ob->GetFields();?>
                    <li>
                        <label data-role="label_<?=$arField['ID']?>" class="bx_filter_param_label " for="<?=$arField['ID']?>">
                            <span class="bx_filter_input_checkbox">
                                <input type="checkbox" <?if(in_array($arField['ID'],$arProps['METRO']['VALUE'])){?>checked<?}?> value="<?=$arField['ID']?>" name="METRO_<?=$arField['ID']?>" id="<?=$arField['ID']?>">
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                <span class="bx_filter_param_text"><?=$arField["NAME"]?></span>
                            </span>
                        </label>
                    </li>
                <?}?>
            </ul>
        </div>
<?endif;?>