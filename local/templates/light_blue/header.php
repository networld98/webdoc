<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
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

    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery-2.2.4.min.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/libraries/slick/slick.min.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/libraries/bootstrap-4.5.0-dist/js/bootstrap.bundle.min.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery.mask.min.js', false); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/main.js', false); ?>
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
        <a href="/" class="logo">
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
            <select name="city" class="city">
                <option selected="selected">Москва</option>
                <option>Санкт-Петербург</option>
                <option>Санкт-Петербург</option>
            </select>
            <a href="tel:+74950952020" class="contacts-phone">+7 (495) 095-20-20</a>
        </div>
            <?if(!CSite::InDir('/lc/')){
                if (!$USER->IsAuthorized()){?>
                    <div id="header-auth">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/bx_bx-user-circle_new.svg" alt="user">
                    </div>
                <?}else{?>
                    <a class="header-auth" href="/lc/">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/bx_bx-user-circle_new.svg" alt="user">
                    </a>
                <?}?>
                <div id="header-records">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/medical_records_1_new.svg" alt="folder" class="records">
                </div>
            <?}else{?>
                <?if (!$USER->IsAuthorized()){?>
                    <div id="header-auth">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/bx_bx-user-circle_new.svg" alt="user">
                    </div>
                <?}else{?>
                    <a class="header-exit" href="?logout=yes">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/medical_records_1_new.svg" alt="folder" class="records">
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
                "PROFILE_URL" => "/auth/",
                "REGISTER_URL" => "/auth/",
                "SHOW_ERRORS" => "Y"
            )
        );?>
    </div>
    <div id="mess-popup" class="mess-popup">
        <!-- Временно скрыл попап -->
        <div style="display:none;">
            <div class="mess-popup__header">Оставьте Ваше сообщение</div>
            <input class="mess-popup__name" type="text" name="" placeholder="ФИО">
            <input class="mess-popup__email" type="text" name="" placeholder="E-mail">
            <textarea class="mess-popup__message" type="text" name="" placeholder="Текст сообщения"></textarea>
            <p class="mess-popup__desc">Нажимая «Отправить», я принимаю <a href="">условия пользовательского соглашения и даю согласие</a> на обработку персональных данных.</p>
            <input type="submit" name="" class="send" value="Отправить">
        </div>
    </div>
    <div id="reception-popup" class="reception-popup">
        <!-- Временно скрыл попап -->
        <div class="doctors-list" style="display:none;">
            <div class="doctors-list-item">
                <div class="flex-content">
                <a href="/" class="logo"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo"></a>
                    <div class="flex-left">
                        <div class="doctors-list-item__img">
                            <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctor-photo.png" alt="doctor-photo" class="doctors-list-item__img-photo"></a>
                            <div class="doctors-list-item__img-info">
                                <div class="doctors-list-item__img-info-ratings">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                </div>
                                <p class="doctors-list-item__img-info-commend">100% пациентов рекомендуют врача на основе <a href="">256 отзыва</a></p>
                            </div>
                        </div>
                        <div class="doctors-list-item__description">
                            <p class="doctors-list-item__description-position">Аллерголог</p>
                            <p class="doctors-list-item__description-title">Баранова Ирина Дмитриевна</p>
                            <p class="doctors-list-item__description-price">2 000 Р<span>Цена приема в клинике</span></p>
                            <a href="tel:+8(812)000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                            <p class="doctor-card__clinic-name">Центр амбулаторной хирургии</p>
                            <p class="doctor-card__clinic-adress">Санкт-Петербург, ул. Чекистов, д. 22 (м. Проспект ветеранов)</p>
                            <ul class="doctor-card__metro-list">
                                <li class="doctor-card_metro-list-item metro2">м. Беговая</li>
                                <li class="doctor-card_metro-list-item metro3">м. Старая Деревня</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex-right">
                    <h2 class="title-h2">Запись на приём</h2>
                    <form action="">
                        <div class="reception-select-group">
                            <div class="reception-select-group__left">
                                <label for="spec">Специальноcть</label>
                                <select name="spec" id="">
                                    <option value="">Аллерголог</option>
                                </select>
                            </div>
                                
                            <div class="reception-select-group__right">
                            <label for="date-and-time">Дата и время приёма</label>
                                <select name="date-and-time" id="">
                                    <option value="">07.04.2020</option>
                                </select>
                            </div>   
                        </div>
                        <div class="reception-select-group">
                            <div>
                            <label for="clinic">Клиника</label>
                                <select name="clinic" id="">
                                    <option value="">Центр семейной медицины на Савушкина</option>
                                </select>
                            </div>
                        </div>
                        <div class="reception-select-group">
                            <div class="reception-select-group__left">
                                <label for="fio">ФИО</label>
                                <select name="fio" id="">
                                    <option value="">Иванов Степан Викторович</option>
                                </select>
                            </div>
                                
                            <div class="reception-select-group__right">
                            <label for="birth">Дата рождения</label>
                                <select name="birth" id="">
                                    <option value="">15.12.1985</option>
                                </select>
                            </div>   
                        </div>
                        <div class="reception-select-group">

                            <div class="reception-select-group__left">
                            <label for="phone">Телефон для подтверждения записи</label>
                                <select name="phone" id="">
                                    <option value="">+7 (***) ***-**-**</option>
                                </select>
                            </div>
                            
                            <div class="reception-select-group__right">
                                <p class="reception-select-group__desc">На этот номер вы получите SMS с кодом подтверждения и информацию о записи</p>
                            </div> 
                        </div>
                        <div class="reception-select-group">

                            <div class="reception-select-group__left">
                                <button>Записаться</button>
                            </div>
                            
                            <div class="reception-select-group__right">
                                <p class="reception-select-group__desc">Нажимая «Записаться», я принимаю <a href="">условия пользовательского соглашения</a> и даю согласие на обработку персональных данных.</p>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="call-popup" class="call-popup">
        <!-- Временно скрыл попап -->
        <div class="doctors-list" style="display:none;"> 
            <div class="doctors-list-item">
                <div class="flex-content">
                <a href="/" class="logo"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo"></a>
                    <div class="flex-left">
                        <div class="doctors-list-item__img">
                            <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctor-photo.png" alt="doctor-photo" class="doctors-list-item__img-photo"></a>
                            <div class="doctors-list-item__img-info">
                                <div class="doctors-list-item__img-info-ratings">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                                </div>
                                <p class="doctors-list-item__img-info-commend">100% пациентов рекомендуют врача на основе <a href="">256 отзыва</a></p>
                            </div>
                        </div>
                        <div class="doctors-list-item__description">
                            <p class="doctors-list-item__description-position">Аллерголог</p>
                            <p class="doctors-list-item__description-title">Баранова Ирина Дмитриевна</p>
                            <p class="doctors-list-item__description-price">2 000 Р<span>Цена приема в клинике</span></p>
                            <a href="tel:+8(812)000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                            <p class="doctor-card__clinic-name">Центр амбулаторной хирургии</p>
                            <p class="doctor-card__clinic-adress">Санкт-Петербург, ул. Чекистов, д. 22 (м. Проспект ветеранов)</p>
                            <ul class="doctor-card__metro-list">
                                <li class="doctor-card_metro-list-item metro2">м. Беговая</li>
                                <li class="doctor-card_metro-list-item metro3">м. Старая Деревня</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex-right">
                    <h2 class="title-h2">Вызов врача на дом</h2>
                    <form action="">
                        <div class="reception-select-group">
                            <div class="reception-select-group__left">
                                <label for="spec">Специальноcть</label>
                                <select name="spec" id="">
                                    <option value="">Аллерголог</option>
                                </select>
                            </div>
                                
                            <div class="reception-select-group__right">
                            <label for="date-and-time">Дата и время приёма</label>
                                <select name="date-and-time" id="">
                                    <option value="">07.04.2020</option>
                                </select>
                            </div>   
                        </div>
                        <div class="reception-select-group">
                            <div>
                            <label for="clinic">Адресс проживания</label>
                                <input type="text" placeholder="Введите адресс">
                            </div>
                        </div>
                        <div class="reception-select-group">
                            <div class="reception-select-group__left">
                                <label for="fio">ФИО</label>
                                <select name="fio" id="">
                                    <option value="">Иванов Степан Викторович</option>
                                </select>
                            </div>
                                
                            <div class="reception-select-group__right">
                            <label for="birth">Дата рождения</label>
                                <select name="birth" id="">
                                    <option value="">15.12.1985</option>
                                </select>
                            </div>   
                        </div>
                        <div class="reception-select-group">

                            <div class="reception-select-group__left">
                            <label for="phone">Телефон для подтверждения записи</label>
                                <select name="phone" id="">
                                    <option value="">+7 (***) ***-**-**</option>
                                </select>
                            </div>
                            
                            <div class="reception-select-group__right">
                                <p class="reception-select-group__desc">На этот номер вы получите SMS с кодом подтверждения и информацию о записи</p>
                            </div> 
                        </div>
                        <div class="reception-select-group">

                            <div class="reception-select-group__left">
                                <button>Записаться</button>
                            </div>
                            
                            <div class="reception-select-group__right">
                                <p class="reception-select-group__desc">Нажимая «Записаться», я принимаю <a href="">условия пользовательского соглашения</a> и даю согласие на обработку персональных данных.</p>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
    <main class="<?if(CSite::InDir('/lc/')){?>personal-cabinet<?}elseif($APPLICATION->GetCurPage(false) === '/'){?>main-screen<?}?>">
    <?function mb_ucfirst($text) {
        return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
    }?>
