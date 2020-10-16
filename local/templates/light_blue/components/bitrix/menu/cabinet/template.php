<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $clinicName;
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

$arFilter = Array("IBLOCK_ID"=>array(9,10), "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $idClient = $arFields['ID'];
}
$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>array(9,10),"ID" => $idClient);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
$i=0;
while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $messages = $arProps['MESSAGE']['VALUE'];
    $clinicName = $arFields['NAME'];
}

if (!empty($arResult)): ?>
    <ul class="personal-cabinet-menu__list">
    <?
    $previousLevel = 0;
foreach ($arResult as $arItem): ?>
        <li class="personal-cabinet-menu__list-item <? if ($arItem["SELECTED"]):?>active<? else:?>unactive<? endif ?>">
            <a href="<?= $arItem["LINK"] ?>">
                <?if($arItem["LINK"]=="/lc/message/" && $messages!=NULL){?>
                    <div class="count-message">
                        <?=count($messages)?>
                    </div>
                <?}?>
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