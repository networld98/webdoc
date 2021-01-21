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
            $login = self::searchClinic(10, array("TECH_PHONE"=> $arUser['LOGIN']));
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

/*КОСТЫЛЬ ТРНАСЛИТА */
class CUtilEx extends \CUtil{

    private static function mb_strtr($str, $from, $to)
    {
        return str_replace(\CUtilEx::mb_str_split($from), \CUtilEx::mb_str_split($to), $str);
    }
    private static function mb_str_split($str) {
        return preg_split('~~u', $str, null, PREG_SPLIT_NO_EMPTY);
    }

    private static function ToUpper($str, $lang = false)
    {
        static $lower = array();
        static $upper = array();
        if(!defined("BX_CUSTOM_TO_UPPER_FUNC"))
        {
            if(defined("BX_UTF"))
            {
                return mb_strtoupper($str);
            }
            else
            {
                if($lang === false)
                    $lang = LANGUAGE_ID;
                if(!isset($lower[$lang]))
                {
                    $arMsg = IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/tools.php", $lang, true);
                    $lower[$lang] = $arMsg["ABC_LOWER"];
                    $upper[$lang] = $arMsg["ABC_UPPER"];
                }
                return mb_strtoupper(\CUtilEx::mb_strtr($str, $lower[$lang], $upper[$lang]));
            }
        }
        else
        {
            $func = BX_CUSTOM_TO_UPPER_FUNC;
            return $func($str);
        }
    }

    private static function ToLower($str, $lang = false)
    {
        static $lower = array();
        static $upper = array();
        if(!defined("BX_CUSTOM_TO_LOWER_FUNC"))
        {
            if(defined("BX_UTF"))
            {
                return mb_strtolower($str);
            }
            else
            {
                if($lang === false)
                    $lang = LANGUAGE_ID;
                if(!isset($lower[$lang]))
                {
                    $arMsg = IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/tools.php", $lang, true);
                    $lower[$lang] = $arMsg["ABC_LOWER"];
                    $upper[$lang] = $arMsg["ABC_UPPER"];
                }
                return mb_strtolower(\CUtilEx::mb_strtr($str, $upper[$lang], $lower[$lang]));
            }
        }
        else
        {
            $func = BX_CUSTOM_TO_LOWER_FUNC;
            return $func($str);
        }
    }



    public static function translit($str, $lang, $params = array())
    {
        static $search = array();

        if(!isset($search[$lang]))
        {
            $mess = IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/js_core_translit.php", $lang, true);
            $trans_from = explode(",", $mess["TRANS_FROM"]);
            $trans_to = explode(",", $mess["TRANS_TO"]);
            foreach($trans_from as $i => $from)
                $search[$lang][$from] = $trans_to[$i];
        }

        $defaultParams = array(
            "max_len" => 100,
            "change_case" => "L", // 'L' - toLower, 'U' - toUpper, false - do not change
            "replace_space" => '_',
            "replace_other" => '_',
            "delete_repeat_replace" => true,
            "safe_chars" => '',
        );
        foreach($defaultParams as $key => $value)
            if(!array_key_exists($key, $params))
                $params[$key] = $value;

        $len = mb_strlen($str);
        $str_new = '';
        $last_chr_new = '';

        for($i = 0; $i < $len; $i++)
        {
            $chr = mb_substr($str, $i, 1, "UTF-8");

            if(preg_match("/[a-zA-Z0-9]/".BX_UTF_PCRE_MODIFIER, $chr) || mb_strpos($params["safe_chars"], $chr)!==false)
            {
                $chr_new = $chr;
            }
            elseif(preg_match("/\\s/".BX_UTF_PCRE_MODIFIER, $chr))
            {
                if (
                    !$params["delete_repeat_replace"]
                    ||
                    ($i > 0 && $last_chr_new != $params["replace_space"])
                )
                    $chr_new = $params["replace_space"];
                else
                    $chr_new = '';
            }
            else
            {
                if($search[$lang][$chr])
                {
                    $chr_new = $search[$lang][$chr];
                }
                else
                {
                    if (
                        !$params["delete_repeat_replace"]
                        ||
                        ($i > 0 && $i != $len-1 && $last_chr_new != $params["replace_other"])
                    )
                        $chr_new = $params["replace_other"];
                    else
                        $chr_new = '';
                }
            }

            if(mb_strlen($chr_new))
            {
                if($params["change_case"] == "L" || $params["change_case"] == "l")
                    $chr_new = \CUtilEx::ToLower($chr_new);
                elseif($params["change_case"] == "U" || $params["change_case"] == "u")
                    $chr_new = \CUtilEx::ToUpper($chr_new);

                $str_new .= $chr_new;
                $last_chr_new = $chr_new;
            }

            if (mb_strlen($str_new) >= $params["max_len"])
                break;
        }
        $str_new = trim($str_new, $params['replace_space'] . $params['replace_other']);

        return $str_new;
    }


}
/*КОНЕЦ КОСТЫЛЯ */