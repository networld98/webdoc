<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
foreach ($_POST as $key => $id){
    $_POST['ID'] = $key;
}
$areaCount =  CIBlockSection::GetCount(array("IBLOCK_ID"=>14, "SECTION_ID"=>$_POST['ID']));
if($areaCount>0):?>
    <span>Район</span>
    <select name="AREA" id="area">
        <?
        $arSelect = array("ID", "NAME");
        $arFilter = array("IBLOCK_ID"=>14, 'SECTION_ID' => $_POST['ID']);
        $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
        while($ar_result = $obSections->GetNext())
        {
            $AreaId = $arProps['AREA']['VALUE'];
            ?>
            <option value="<?=$ar_result['ID']?>/<?=$ar_result['NAME']?>" <?if($ar_result['ID']==$arProps['AREA']['VALUE']){?>selected<?}?>><?=$ar_result['NAME']?></option>
        <?}?>
    </select>
<?endif;?>