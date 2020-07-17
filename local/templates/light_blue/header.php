<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
CJSCore::Init("popup", "jquery");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico"/>
    <? $APPLICATION->ShowHead(); ?>
    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/assets/js/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/libraries/bootstrap-4.5.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/libraries/slick/slick.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/libraries/slick/slick-theme.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/style.css"/>

    <script src="<?= SITE_TEMPLATE_PATH ?>/assets/libraries/slick/slick.min.js"></script>
    <script src="<?= SITE_TEMPLATE_PATH ?>/assets/libraries/bootstrap-4.5.0-dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/main.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=f471c6ff-1ad1-4847-8940-573cea31904e&lang=ru_RU" type="text/javascript"></script>
    <title><? $APPLICATION->ShowTitle() ?></title>
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
        </div>
    </div>
    <div class="container">
        <a href="/" class="logo"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo"></a>
        <nav class="top-menu">
            <div id="main-menu">
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
        <div class="contacts">
            <select name="city" class="city">
                <option selected="selected">Москва</option>
                <option>Санкт-Петербург</option>
                <option>Санкт-Петербург</option>
            </select>
            <a href="tel:+74950952020" class="contacts-phone">+7 (495) 095-20-20</a>
        </div>
        <div id="header-auth">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/bx_bx-user-circle.svg" alt="user">
        </div>
        <div id="header-records">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/medical_records_1_.svg" alt="folder" class="records">
        </div>
    </div>
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
    <div id="auth-popup" class="auth-popup">
        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO.svg" alt="logo">
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "header_auth",
            Array(
                "FORGOT_PASSWORD_URL" => "",
                "PROFILE_URL" => "",
                "REGISTER_URL" => "",
                "SHOW_ERRORS" => "N"
            )
        );?>
    </div>
    <div id="mess-popup" class="mess-popup">
        <div class="mess-popup__header">Оставьте Ваше сообщение</div>
        <input class="mess-popup__name" type="text" name="" placeholder="ФИО">
        <input class="mess-popup__email" type="text" name="" placeholder="E-mail">
        <textarea class="mess-popup__message" type="text" name="" placeholder="Текст сообщения"></textarea>
        <p class="mess-popup__desc">Нажимая «Отправить», я принимаю <a href="">условия пользовательского соглашения и даю согласие</a> на обработку персональных данных.</p>
        <input type="submit" name="" class="send" value="Отправить">
    </div>
    <div id="reception-popup" class="reception-popup">
        <div class="doctors-list">
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
        <div class="doctors-list">
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
    <div id="map-popup" class="map-popup">
    <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <script>
        var auth = {
            popup: null, //наш popup
            showPopup: function (url) {
                this.popup = BX.PopupWindowManager.create("modal_auth", '', {
                    closeIcon: true,
                    autoHide: true,
                    offsetLeft: 0,
                    offsetTop: 0,
                    draggable: {restrict: true},
                    closeByEsc: true,
                    content: BX('auth-popup'),
                    overlay: {backgroundColor: 'black', opacity: '10'}
                });

                this.popup.show();
            }
        };
        

        $('#header-auth').click(()=>{
            auth.showPopup();
        });
        
    </script>

</header>
<main class="">
    <?if($APPLICATION->GetCurPage() != '/clinics/' && $APPLICATION->GetCurPage() != '/'){?>
        <section class="container">
            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
	"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
		"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
		"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
	),
	false
);?>
        </section>
    <?}?>
