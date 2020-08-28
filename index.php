<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Выбор врача и клиники по отзывам от настоящих пользователей, по месторасположению и ценам. Актуальные контактные данные клиник, статьи по медицине и полезные материалы.");
$APPLICATION->SetTitle("Webdoc.clinic - осознанный выбор врача, клиники и медицинских услуг в вашем городе"); ?>
<?/*
    $url = explode('/',$_SERVER['SCRIPT_URL']);
    $param = strpos($_SERVER['QUERY_STRING'], 'arrFilter');
    if($url[1]!=="clinics" && $param!==NULL){
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: http://doc.btx.bz/clinics/?'.$_SERVER['QUERY_STRING']);
        exit;
    }
*/?>
<div class="container main__header">
    <div class="head">
        <h1 class="head__text">
            <div class="head__text--top">
                Поиск лучших врачей
            </div>
            <div class="head__text--bottom">
                и клиник в своем городе
            </div>
        </h1>
        <img alt="plus" src="/local/templates/light_blue/assets/images/Vector.svg" class="desktop-plus">
        <img src="/local/templates/light_blue/assets/images/plus-tablet.svg" alt="plus">
    </div>
    <div class="main__img2"></div>
    <img src="/local/templates/light_blue/assets/images/Vector%20(1).svg" class="main__img" alt="">
</div>
<section class="container">
    <? $APPLICATION->IncludeComponent(
        "bitrix:catalog.smart.filter",
        "custom",
        array(
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "N",
            "COMPONENT_TEMPLATE" => "custom",
            "CONVERT_CURRENCY" => "N",
            "DISPLAY_ELEMENT_COUNT" => "N",
            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "FILTER_VIEW_MODE" => "vertical",
            "HIDE_NOT_AVAILABLE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => 9,
            "PAGER_PARAMS_NAME" => "arrPager",
            "PREFILTER_NAME" => "",
            "SAVE_IN_SESSION" => "N",
            "SECTION_CODE" => "",
            "SECTION_DESCRIPTION" => "-",
            "SECTION_ID" => "",
            "SECTION_TITLE" => "-",
            "SEF_MODE" => "N",
            "TEMPLATE_THEME" => "blue",
            "XML_EXPORT" => "N",
            "POPUP_POSITION" => "left",
            "NOT_FILTER" => "N"
        ),
        false
    );
    ?></section>
<section class="statistics container">
<div class="statistics__header">
        <span>Бесплатный сервис подбора медицинских услуг</span>
        <img src="/local/templates/light_blue/assets/images/plus-mobile.svg" alt="plus">
    </div>
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/count-element-main.php"
        ),
        false
    ); ?>
</section>
<section class="container specializations">
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/specialization.php"
        ),
        false
    ); ?>
</section>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => "/include/main_text.php"
    ),
    false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>