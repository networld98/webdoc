<?
CModule::IncludeModule("form");
if($arResult['ID'] == NULL){
    $arResult['ID'] = $_POST['doctor'];
}
$FORM_ID = 4;
$arFilter = array();
$result = CFormResult::GetList($FORM_ID, $by = 's_id', $order = 'asc', $arFilter, $is_filtered, 'N', false);
while($arRes = $result->Fetch())
{
    $arID[] = $arRes['ID'];
}
CForm::GetResultAnswerArray($FORM_ID,
    $arrColumns,
    $arrAnswers,
    $arrAnswersVarname,
    array("RESULT_ID" => $arID));
foreach ($arrAnswersVarname as $key => $answer){
    $rsResult = CFormResult::GetByID($key);
    $aResult = $rsResult->Fetch();
    if($aResult['STATUS_TITLE'] != 'CANSELED'){
        $strDoctor = explode('/',$answer['SIMPLE_RECORD_PHONE']['0']['USER_TEXT']);
        if($strDoctor[0] == $arResult['ID']){
            $record[] = $answer['SIMPLE_RECORD_2']['0']['USER_TEXT'];
        }
    }
}
?>