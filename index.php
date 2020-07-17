<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Webdoc");
$APPLICATION->SetTitle(""); ?>
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
        <img alt="plus" src="/local/templates/light_blue/assets/images/Vector.svg">
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
            "IBLOCK_ID" => "9",
            "PAGER_PARAMS_NAME" => "arrPager",
            "SEF_RULE"=>"",
            "SMART_FILTER_PATH" => '/clinics/',
            "PREFILTER_NAME" => "",
            "SAVE_IN_SESSION" => "N",
            "SECTION_CODE" => "",
            "SECTION_DESCRIPTION" => "-",
            "SECTION_ID" => "",
            "SECTION_TITLE" => "-",
            "SEF_MODE" => "N",
            "TEMPLATE_THEME" => "blue",
            "XML_EXPORT" => "N",
            "POPUP_POSITION" => "left"
        ),
        false
    );
    ?></section>
<section class="statistics container">
    <div class="statistics__header">
        Бесплатный сервис подбора медицинских услуг
        <img src="/local/templates/light_blue/assets/images/plus-mobile.svg" alt="plus">
    </div>
    <div class="statistics__items">
        <div class="statistics__item">
            <div class="statistics__icon">
                <img alt="build" src="/local/templates/light_blue/assets/images/hospital_building.svg">
            </div>
            <div class="statistics__block">
                <div class="statistics__number">
                    2396+
                </div>
                <div class="statistics__text">
                    клиник в нашей базе
                </div>
            </div>
        </div>
        <div class="statistics__item">
            <div class="statistics__icon">
                <img alt="doctor" src="/local/templates/light_blue/assets/images/doctor_3_.svg">
            </div>
            <div class="statistics__block">
                <div class="statistics__number">
                    10418+
                </div>
                <div class="statistics__text">
                    врачей в нашей базе
                </div>
            </div>
        </div>
        <div class="statistics__item">
            <div class="statistics__icon">
                <img alt="order" src="/local/templates/light_blue/assets/images/order_in_progress.svg">
            </div>
            <div class="statistics__block">
                <div class="statistics__number">
                    5162+
                </div>
                <div class="statistics__text">
                    пациента записались
                </div>
            </div>
        </div>
        <div class="statistics__item">
            <div class="statistics__icon">
                <img alt="like" src="/local/templates/light_blue/assets/images/influence_1_.svg">
            </div>
            <div class="statistics__block">
                <div class="statistics__number">
                    41628+
                </div>
                <div class="statistics__text">
                    отзывов о врачах
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container specializations">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                    href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Специализации
                    врачей</a></li>
            <li class="nav-item"><a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Специализации
                    клиник</a></li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-xl-2 col-md-3 col-6">
                        <div class="col__heading">
                            А
                        </div>
                        <ul class="col__list">
                            <li class="col__item"><a href="#">Акушер</a></li>
                            <li class="col__item"><a href="#">Аллерголог</a></li>
                            <li class="col__item"><a href="#">Андролог</a></li>
                            <li class="col__item"><a href="#">Анестезиолог</a></li>
                            <li class="col__item"><a href="#">Аритмолог</a></li>
                            <li class="col__item"><a href="#">Артролог</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-md-3 col-6">
                        <div class="col__heading">
                            А
                        </div>
                        <ul class="col__list">
                            <li class="col__item"><a href="#">Акушер</a></li>
                            <li class="col__item"><a href="#">Аллерголог</a></li>
                            <li class="col__item"><a href="#">Андролог</a></li>
                            <li class="col__item"><a href="#">Анестезиолог</a></li>
                            <li class="col__item"><a href="#">Аритмолог</a></li>
                            <li class="col__item"><a href="#">Артролог</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-md-3 col-6 d-none d-md-block">
                        <div class="col__heading">
                            А
                        </div>
                        <ul class="col__list">
                            <li class="col__item"><a href="#">Акушер</a></li>
                            <li class="col__item"><a href="#">Аллерголог</a></li>
                            <li class="col__item"><a href="#">Андролог</a></li>
                            <li class="col__item"><a href="#">Анестезиолог</a></li>
                            <li class="col__item"><a href="#">Аритмолог</a></li>
                            <li class="col__item"><a href="#">Артролог</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-md-3 col-6 d-none d-md-block">
                        <div class="col__heading">
                            А
                        </div>
                        <ul class="col__list">
                            <li class="col__item"><a href="#">Акушер</a></li>
                            <li class="col__item"><a href="#">Аллерголог</a></li>
                            <li class="col__item"><a href="#">Андролог</a></li>
                            <li class="col__item"><a href="#">Анестезиолог</a></li>
                            <li class="col__item"><a href="#">Аритмолог</a></li>
                            <li class="col__item"><a href="#">Артролог</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-md-3 col-6 d-none d-xl-block">
                        <div class="col__heading">
                            А
                        </div>
                        <ul class="col__list">
                            <li class="col__item"><a href="#">Акушер</a></li>
                            <li class="col__item"><a href="#">Аллерголог</a></li>
                            <li class="col__item"><a href="#">Андролог</a></li>
                            <li class="col__item"><a href="#">Анестезиолог</a></li>
                            <li class="col__item"><a href="#">Аритмолог</a></li>
                            <li class="col__item"><a href="#">Артролог</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-md-3 col-6 d-none d-xl-block">
                        <div class="col__heading">
                            А
                        </div>
                        <ul class="col__list">
                            <li class="col__item"><a href="#">Акушер</a></li>
                            <li class="col__item"><a href="#">Аллерголог</a></li>
                            <li class="col__item"><a href="#">Андролог</a></li>
                            <li class="col__item"><a href="#">Анестезиолог</a></li>
                            <li class="col__item"><a href="#">Аритмолог</a></li>
                            <li class="col__item"><a href="#">Артролог</a></li>
                        </ul>
                    </div>
                </div>
                <div class="load_more">
                    Показать ещё
                </div>
                <div class="specializations__list expand">
                    <div class="row">
                        <div class="col-xl-2 col-md-3 col-6">
                            <div class="col__heading">
                                А
                            </div>
                            <ul class="col__list">
                                <li class="col__item"><a href="#">Акушер</a></li>
                                <li class="col__item"><a href="#">Аллерголог</a></li>
                                <li class="col__item"><a href="#">Андролог</a></li>
                                <li class="col__item"><a href="#">Анестезиолог</a></li>
                                <li class="col__item"><a href="#">Аритмолог</a></li>
                                <li class="col__item"><a href="#">Артролог</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-2 col-md-3 col-6">
                            <div class="col__heading">
                                А
                            </div>
                            <ul class="col__list">
                                <li class="col__item"><a href="#">Акушер</a></li>
                                <li class="col__item"><a href="#">Аллерголог</a></li>
                                <li class="col__item"><a href="#">Андролог</a></li>
                                <li class="col__item"><a href="#">Анестезиолог</a></li>
                                <li class="col__item"><a href="#">Аритмолог</a></li>
                                <li class="col__item"><a href="#">Артролог</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-2 col-md-3 col-6 d-none d-md-block">
                            <div class="col__heading">
                                А
                            </div>
                            <ul class="col__list">
                                <li class="col__item"><a href="#">Акушер</a></li>
                                <li class="col__item"><a href="#">Аллерголог</a></li>
                                <li class="col__item"><a href="#">Андролог</a></li>
                                <li class="col__item"><a href="#">Анестезиолог</a></li>
                                <li class="col__item"><a href="#">Аритмолог</a></li>
                                <li class="col__item"><a href="#">Артролог</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-2 col-md-3 col-6 d-none d-md-block">
                            <div class="col__heading">
                                А
                            </div>
                            <ul class="col__list">
                                <li class="col__item"><a href="#">Акушер</a></li>
                                <li class="col__item"><a href="#">Аллерголог</a></li>
                                <li class="col__item"><a href="#">Андролог</a></li>
                                <li class="col__item"><a href="#">Анестезиолог</a></li>
                                <li class="col__item"><a href="#">Аритмолог</a></li>
                                <li class="col__item"><a href="#">Артролог</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-2 col-md-3 col-6 d-none d-xl-block">
                            <div class="col__heading">
                                А
                            </div>
                            <ul class="col__list">
                                <li class="col__item"><a href="#">Акушер</a></li>
                                <li class="col__item"><a href="#">Аллерголог</a></li>
                                <li class="col__item"><a href="#">Андролог</a></li>
                                <li class="col__item"><a href="#">Анестезиолог</a></li>
                                <li class="col__item"><a href="#">Аритмолог</a></li>
                                <li class="col__item"><a href="#">Артролог</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-2 col-md-3 col-6 d-none d-xl-block">
                            <div class="col__heading">
                                А
                            </div>
                            <ul class="col__list">
                                <li class="col__item"><a href="#">Акушер</a></li>
                                <li class="col__item"><a href="#">Аллерголог</a></li>
                                <li class="col__item"><a href="#">Андролог</a></li>
                                <li class="col__item"><a href="#">Анестезиолог</a></li>
                                <li class="col__item"><a href="#">Аритмолог</a></li>
                                <li class="col__item"><a href="#">Артролог</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div>
                    2
                </div>
                <div class="load_more">
                    Показать ещё
                </div>
                <div class="specializations__list expand">
                    hide
                </div>
            </div>
        </div>
    </section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>