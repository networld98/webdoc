<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    CModule::IncludeModule("iblock");
    $obEl = new CIBlockElement();
        $PROPS = array(
            "ADDRESS" => $_POST['ADDRESS'],
            "YEAR_FONDATION" => $_POST['YEAR_FONDATION'],
            "DIRECTOR" => $_POST['DIRECTOR'],
            "SITE" => $_POST['SITE'],
            "OFFICIAL_NAME" => $_POST['OFFICIAL_NAME'],
            "CITY" => $_POST['CITY'],
            "SERVICES" => $_POST['SERVICES'],
            "PARKING" => $_POST['PARKING'],
            "DIRECITONS" => $_POST['DIRECITONS'],
            "MAP" => $_POST['MAP'],
            "PAY_CARD" => $_POST['arrFilter_PAY_CARD'],
            "DMC" => $_POST['arrFilter_DMC'],
            "UMC" => $_POST['arrFilter_UMC'],
            "PAY_MONEY" => $_POST['arrFilter_PAY_MONEY'],
            "ADULT" => $_POST['arrFilter_ADULT'],
            "CHILD" => $_POST['arrFilter_CHILD'],
            "ONLINE" => $_POST['arrFilter_ONLINE'],
            "DIAGNOSTICS" => $_POST['arrFilter_DIAGNOSTICS'],
            "GUEST_PARKING" => $_POST['arrFilter_GUEST_PARKING'],
            "DEPARTURE_HOUSE" => $_POST['arrFilter_DEPARTURE_HOUSE'],
            "CHILDREN_DOCTOR" => $_POST['arrFilter_CHILDREN_DOCTOR'],
        );
        CIBlockElement::SetPropertyValuesEx($_POST['ID_CLINIC'], false, $PROPS);
        $nameClinic = $obEl->Update($_POST['ID_CLINIC'],array('NAME' => $_POST['NAME_CLINIC'], 'DETAIL_TEXT' => $_POST['DETAIL_TEXT'])); // деактивация
    ?>
<p>Данные сохранены</p>
<?}?>