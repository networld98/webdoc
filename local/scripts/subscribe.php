<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = [9,10];
$start = strtotime(date('d.m.Y'));
if(CModule::IncludeModule('iblock')) {
    $arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), Array('ID', 'NAME', 'PROPERTY_DATE_END_ACTIVE','PROPERTY_SUBSCRIBE','PROPERTY_PHONE','PROPERTY_API_REVIEWS_RATING'));
    while ($ob = $res->GetNextElement()) {
        $Element = $ob->GetFields();
        if($Element['PROPERTY_DATE_END_ACTIVE_VALUE']!=NULL){
            $end = strtotime($Element['PROPERTY_DATE_END_ACTIVE_VALUE']);
            $days_between = ceil(($end - $start) / 86400);
            if($days_between == 1) {
                $rsUser = CUser::GetByLogin($Element['PROPERTY_PHONE_VALUE']);
                $arUser = $rsUser->Fetch();
                $email = $arUser['EMAIL'];
                $subs = CIBlockElement::GetByID($Element['PROPERTY_SUBSCRIBE_VALUE']);
                if($ar_res = $subs->GetNext()){
                    $Tarif = $ar_res['NAME'];
                }
                $arEventFields = array(
                    "TARIF" => $Tarif,
                    "NAME" => html_entity_decode ($Element['NAME']),
                    "EMAIL_TO" => $email,
                    "DATE" => $Element['PROPERTY_DATE_END_ACTIVE_VALUE'],
                    );
                CEvent::Send("PAUSE_SUBSCRIPTION", s1, $arEventFields, "N", 97);
            }elseif ($days_between < 1 && $Element['PROPERTY_API_REVIEWS_RATING_VALUE'] < 5){
                $PROP[127] = NULL;
                $PROP[125] = NULL;
            }elseif ($days_between > 1 && $Element['PROPERTY_API_REVIEWS_RATING_VALUE'] < 5){
                $PROP[127] = 128;
                $PROP[125] = 89;
            }else{
                $PROP[127] = 128;
                $PROP[125] = 89;
            }
        }else{
            if ($Element['PROPERTY_API_REVIEWS_RATING_VALUE'] < 5){
                $PROP[127] = NULL;
                $PROP[125] = NULL;
             }else{
                $PROP[127] = 128;
                $PROP[125] = 89;

            }
        }
        CIBlockElement::SetPropertyValuesEx($Element['ID'], false, $PROP);
    }
}
$f = fopen('subscribe.log', 'a');
fwrite($f, date('d.m.Y H:i:s') . " скрипт выполнился\n");
fclose($f);
print "Отработал";
?>