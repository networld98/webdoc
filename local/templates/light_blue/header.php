<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//IncludeTemplateLangFile(__FILE__);
CJSCore::Init("popup", "jquery");
//CJSCore::Init(['masked_input']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico"/>
    <? $APPLICATION->ShowHead(); ?>
    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/libraries/bootstrap-4.5.0-dist/css/bootstrap.css", false); ?>
    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/libraries/slick/slick.css", false); ?>
    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/libraries/slick/slick-theme.css", false); ?>
    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/font-awesome.min.css", false); ?>
    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/style.css", false); ?>
    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/custom.css", false); ?>

    <? $APPLICATION->AddHeadScript('https://code.jquery.com/jquery-1.9.1.min.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/libraries/slick/slick.min.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/libraries/bootstrap-4.5.0-dist/js/bootstrap.bundle.min.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/main.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery.mask.min.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/custom.js', false); ?>
    <? $APPLICATION->AddHeadScript('https://api-maps.yandex.ru/2.1/?apikey=f471c6ff-1ad1-4847-8940-573cea31904e&lang=ru_RU', false); ?>
    <title><? $APPLICATION->ShowTitle() ?><?$APPLICATION->ShowProperty("meta_title");?></title>
<meta name="yandex-verification" content="4a254ce6a8470c55" />
</head>
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<header class="header" id="header">
    <div class="burger">
        <input id="burger__toggle" class="burger__toggle" type="checkbox"/>
        <label class="burger__btn" for="burger__toggle">
            <div></div>
            <div></div>
            <div></div>
        </label>
        <div class="side-menu">
            <div class="contacts">

                <select name="city" class="city">
                    <option selected="selected">Москва</option>
                    <option>Санкт-Петербург</option>
                </select>
                <a href="tel:+74950952020" class="contacts-phone">+7 (495) 095-20-20</a>
            </div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "side_menu",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "left",
                    "USE_EXT" => "N"
                )
            ); ?>
            <div class="side-menu-nav">
                <? $APPLICATION->IncludeComponent("bitrix:menu", "horizontal", array(
                    "ROOT_MENU_TYPE" => "top",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                    false
                ); ?>
            </div>
            
        </div>
    </div>
    <div class="container <?if(CSite::InDir('/lc/')){?>cabinet<?}?>">
        <a href="<?if($_SERVER["SERVER_NAME"]==="webdoc.clinic"){?>/<?}else{?>https://webdoc.clinic/<?}?>" class="logo">
            <img class="desktop" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo">
            <img class="mobile" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO-mobile.svg" alt="logo">
        </a>
        <?if(!CSite::InDir('/lc/')){?>
        <nav class="top-menu top-menu">
            <div id="main-menu top-menu">
                <? $APPLICATION->IncludeComponent("bitrix:menu", "horizontal", array(
                    "ROOT_MENU_TYPE" => "top",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                    false
                ); ?>
            </div>
        </nav>
        <?}?>
        <div class="contacts">
            <?$APPLICATION->IncludeComponent(
            "bxmaker:geoip.city",
            "custom",
            array(
                "BTN_EDIT" => "Изменить город",
                "CACHE_TIME" => "36000",
                "CACHE_TYPE" => "A",
                "CITY_COUNT" => "30",
                "CITY_LABEL" => "",
                "CITY_SHOW" => "Y",
                "FAVORITE_SHOW" => "Y",
                "FID" => "1",
                "INFO_SHOW" => "Y",
                "INFO_TEXT" => "Мы ищем по всей России",
                "INPUT_LABEL" => "Начните вводить название города...",
                "MSG_EMPTY_RESULT" => "Ничего не найдено",
                "POPUP_LABEL" => "Мы ищем по всей России",
                "QUESTION_SHOW" => "Y",
                "QUESTION_TEXT" => "<i class=\"fa fa-map-marker\" aria-hidden=\"true\"></i>Ваш город<br/>#CITY#?",
                "RELOAD_PAGE" => "N",
                "SEARCH_SHOW" => "Y",
                "COMPONENT_TEMPLATE" => "custom",
                "COMPOSITE_FRAME_MODE" => "Y",
                "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITH_STUB"
            ),
            false
        );?>
            <a href="tel:+74950952020" class="contacts-phone">+7 (495) 095-20-20</a>
        </div>
            <?if(!CSite::InDir('/lc/')){
                if (!$USER->IsAuthorized()){?>
                    <div id="header-auth">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/bx_bx-user-circle_new.svg" alt="user">
                    </div>
                <?}else{?>
                    <a class="header-auth" href=" <?if($_SERVER["SERVER_NAME"]==="webdoc.clinic"){?>/lc/<?}else{?>http://webdoc.clinic/lc/<?}?>">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/bx_bx-user-circle_new.svg" alt="user">
                    </a>
                <?}?>
                <?if($_SERVER["SERVER_NAME"]==="webdoc.clinic"){?>
                    <a id="header-records" href="https://lib.webdoc.clinic/">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/medical_records_1_new.svg" alt="folder" class="records">
                    </a>
                <?}?>

            <?}else{?>
                <?if (!$USER->IsAuthorized()){?>
                    <div id="header-auth">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/bx_bx-user-circle_new.svg" alt="user">
                    </div>
                <?}else{?>
                    <a class="header-exit" href="?logout=yes">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/bx_bx-user-exit.svg" alt="folder" class="records">
                    </a>
                <?}?>
            <?}?>
    </div>
    <?if(!CSite::InDir('/lc/')){?>
    <div class="container mobile">
        <nav class="top-menu-mobile">
            <? $APPLICATION->IncludeComponent("bitrix:menu", "horizontal", array(
                "ROOT_MENU_TYPE" => "top",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "36000000",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => array(),
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "left",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N"
            ),
                false
            ); ?>
        </nav>
    </div>
    <?}?>
    <div id="auth-popup" class="auth-popup">
        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo">
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "header_auth",
            Array(
                "FORGOT_PASSWORD_URL" => "/auth/",
                "PROFILE_URL" => "/lc/",
                "REGISTER_URL" => "/auth/",
                "SHOW_ERRORS" => "Y"
            )
        );?>
    </div>
</header>
<?include SITE_TEMPLATE_PATH.'/include/functions.php';?>
    <main class="<?if(CSite::InDir('/lc/')){?>personal-cabinet<?}elseif($APPLICATION->GetCurPage(false) === '/'){?>main-screen<?}?>">
    <?function mb_ucfirst($text) {
        return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
    }?>
