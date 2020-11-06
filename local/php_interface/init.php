<?php
AddEventHandler("main", "OnAfterUserAuthorize", Array("UserGroup", "OnAfterUserAuthorizeHandler"));

class UserGroup
{
    function searchClinic($id, $param)
    {
        CModule::IncludeModule('iblock');
        $arFilter = Array("IBLOCK_ID" => $id, $param);

        $arSelect = Array();
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $idClinic = $arFields['ID'];
            return $idClinic;
        }
        return false;
    }
    // создаем обработчик события "OnAfterUserAuthorize"
    function OnAfterUserAuthorizeHandler()
    {
        global $USER;
        $rsUser = CUser::GetByID($USER->GetID());
             $arUser = $rsUser->Fetch();
        if($arUser['UF_TYPE_USER']==6){
            $login = self::searchClinic(9, array("PROPERTY_PHONE"=> $arUser['LOGIN']));
            $nameClinic = self::searchClinic(9, array("NAME"=> $arUser['UF_NAME_CLINIC']));
            if($login == NULL && $nameClinic == NULL) {
                $el = new CIBlockElement;
                $PROP = array();
                $PROP[129] = $arUser['LOGIN'];
                $arParams = array("replace_space"=>"-","replace_other"=>"-");
                $trans = Cutil::translit($arUser['UF_NAME_CLINIC'],"ru",$arParams);
                $arLoadProductArray = Array(
                    "MODIFIED_BY" => $USER->GetID(),
                    "IBLOCK_SECTION_ID" => false,
                    "IBLOCK_ID" => 9,
                    "PROPERTY_VALUES" => $PROP,
                    "NAME" => $arUser['UF_NAME_CLINIC'],
                    "CODE" => substr($arUser['LOGIN'], -4)."_".$trans,
                    "ACTIVE" => "N",
                );
                $PRODUCT_ID = $el->Add($arLoadProductArray);
             }elseif($nameClinic != NULL && $login == NULL){
                CIBlockElement::SetPropertyValuesEx($nameClinic, false, array("PHONE" => $arUser['LOGIN']));
            }
        }elseif($arUser['UF_TYPE_USER']==7) {
            $login = self::searchClinic(10, array("PROPERTY_PHONE"=> $arUser['LOGIN']));
            if($login == NULL) {
                $el = new CIBlockElement;
                $PROP = array();
                $PROP[148] = $arUser['LOGIN'];
                $arParams = array("replace_space"=>"-","replace_other"=>"-");
                $trans = Cutil::translit($arUser['NAME'].' '.$arUser['LAST_NAME'] ,"ru",$arParams);
                $arLoadProductArray = Array(
                    "MODIFIED_BY" => $USER->GetID(),
                    "IBLOCK_SECTION_ID" => false,
                    "IBLOCK_ID" => 10,
                    "PROPERTY_VALUES" => $PROP,
                    "NAME" => $arUser['NAME'].' '.$arUser['LAST_NAME'],
                    "CODE" => substr($arUser['LOGIN'], -4)."_".$trans,
                    "ACTIVE" => "N",
                );
                $PRODUCT_ID = $el->Add($arLoadProductArray);
            }
        }

    }
}

// регистрируем обработчик
AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");
// создаем обработчик события
class BeforeIndex{
     function BeforeIndexHandler($arFields){
        if (!CModule::IncludeModule("iblock")) // подключаем модуль
            return $arFields;
        if ($arFields["MODULE_ID"] == "iblock") {
            $db_props = CIBlockElement::GetProperty(
            // Запросим свойства индексируемого элемента
                $arFields["PARAM2"], // BLOCK_ID индексируемого свойства
                $arFields["ITEM_ID"], // ID индексируемого свойства
                array("sort" => "asc"), // Сортировка (можно упустить)
                Array("CODE" => "ADDRESS")); // CML2_ARTICLE - КОД ВАШЕГО СВОЙСТВА
    // CODE свойства (в данном случае артикул)
            if ($ar_props = $db_props->Fetch()) $arFields["TITLE"] .= " " . $ar_props["VALUE"];
    // Добавим свойство в конец заголовка индексируемого элемента
        }
        return $arFields;
    // вернём изменения
    }
}