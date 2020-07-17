<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Application;
CModule::IncludeModule("iblock");


/**
 * Class WNNewsFilter служит для ффильтрации акций/статей/новостей
 */

class WNNewsFilter extends CBitrixComponent {


    public function onPrepareComponentParams($arParams) {
        return $arParams;
    }



	private function initFilter()
	{

	    $arrProperties = CIBlockSectionPropertyLink::GetArray($this->arParams['IBLOCK_ID'], 0);

        $rsProperty = CIBlockProperty::GetList(
            array('SORT' => 'ASC'),
            array('IBLOCK_ID' => $this->arParams['IBLOCK_ID'], 'ACTIVE'=>'Y')
        );

        while($field = $rsProperty->Fetch())
        {
            if($arrProperties[$field['ID']]['SMART_FILTER'] == 'Y')
            {
                $field['DISPLAY_TYPE'] = $arrProperties[$field['ID']]['DISPLAY_TYPE'];
                $properties[$field['CODE']] = $field;
            }
        }

        foreach($properties as $key => $propery)
        {
            $res = CIBlockElement::GetList(
                Array(),
                array('IBLOCK_ID' => $this->arParams['IBLOCK_ID'], "ACTIVE" => "Y", "!PROPERTY_".$propery['CODE'] => false),
                array("PROPERTY_".$propery['CODE'])
            );
            while ($fields = $res->Fetch()) {
                if($propery['PROPERTY_TYPE'] == 'E')
                {
                    $value = $fields["PROPERTY_" . $propery['CODE'] . "_VALUE"];
                    $elem = CIBlockElement::GetByID($value);
                    if($ar_res = $elem->GetNext()) $name = $ar_res['NAME'];
                    $properties[$propery['CODE']]['FIELDS'][] = ['VALUE' => $value, 'NAME' => $name];
                }
                elseif($propery['PROPERTY_TYPE'] == 'G')
                {
                    $value = $fields["PROPERTY_" . $propery['CODE'] . "_VALUE"];
                    $elem = CIBlockSection::GetByID($value);
                    if($ar_res = $elem->GetNext()) $name = $ar_res['NAME'];
                    $properties[$propery['CODE']]['FIELDS'][] = ['VALUE' => $value, 'NAME' => $name];
                }
                else {
                    $value = $fields["PROPERTY_" . $propery['CODE'] . "_VALUE"];
                    $name = $fields["PROPERTY_" . $propery['CODE'] . "_VALUE"];
                    $properties[$propery['CODE']]['FIELDS'][] = ['VALUE' => $value, 'NAME' => $name];
                }
            }
        }
        $this->arResult['PROPERTIES'] = $properties;
	}

	private function filterGlobalResult()
    {
        $request = Application::getInstance()->getContext()->getRequest();

        foreach($this->arResult['PROPERTIES'] as &$property)
        {
            $propValue  = htmlspecialchars($request->getPost($property['CODE']));

            if($propValue)
            {
                $pref = 'PROPERTY_';

                if($property['PROPERTY_TYPE'] == 'L') {
                    if($propValue == 'N')
                    {
                        $pref = '!PROPERTY_';
                        $propValue = $property['FIELDS'][0]['VALUE'];
                    }
                    elseif($propValue == 'Y')
                    {
                        $pref = 'PROPERTY_';
                        $propValue = $property['FIELDS'][0]['VALUE'];
                    }

                    if($this->arParams['COMPARE_RULE'] == 'OR' && $property['CODE'] != 'YEAR')
                    {
                        $GLOBALS[$this->arParams['FILTER_NAME']][0][$pref . $property['CODE'] . '_VALUE'] = $propValue;
                    }
                    else
                    {
                        $GLOBALS[$this->arParams['FILTER_NAME']][$pref . $property['CODE'] . '_VALUE'] = $propValue;
                    }
                }
                else
                {
                    $GLOBALS[$this->arParams['FILTER_NAME']][$pref . $property['CODE']] = $propValue;
                }
                if($this->arParams['COMPARE_RULE'] == 'OR' && count($GLOBALS[$this->arParams['FILTER_NAME']][0])>0)
                {
                    $GLOBALS[$this->arParams['FILTER_NAME']][0]['LOGIC'] = $this->arParams['COMPARE_RULE'];
                }
            }
        }
    }

    public function executeComponent()
    {
        $this->initFilter();
        $this->filterGlobalResult();
        $this->includeComponentTemplate();
    }
}?>
