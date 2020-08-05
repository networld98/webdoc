<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клиники");
?>
    <section class="clinic-card">
      <?$APPLICATION->ShowViewContent('filterTitle');?>
       <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"clinic", 
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "clinic",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "SPECIALIZATION",
			1 => "ADDRESS",
			2 => "DOCTORS",
			3 => "WORK_TIME",
			4 => "DEPARTURE_HOUSE",
			5 => "CHILDREN_DOCTOR",
			6 => "DIAGNOSTICS",
			7 => "CONTACTS",
			8 => "MAP",
			9 => "AREA",
			10 => "ONLINE",
			11 => "COST_PRICE",
			12 => "DMC",
			13 => "UMC",
			14 => "REGION",
			15 => "METRO",
			16 => "CITY",
			17 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "SPECIALIZATION",
			1 => "ADDRESS",
			2 => "DOCTORS",
			3 => "WORK_TIME",
			4 => "DEPARTURE_HOUSE",
			5 => "CHILDREN_DOCTOR",
			6 => "DIAGNOSTICS",
			7 => "CONTACTS",
			8 => "MAP",
			9 => "AREA",
			10 => "ONLINE",
			11 => "COST_PRICE",
			12 => "DMC",
			13 => "UMC",
			14 => "REGION",
			15 => "METRO",
			16 => "CITY",
			17 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "show_more",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_FOLDER" => "/clinics/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "SPECIALIZATION",
			1 => "ADDRESS",
			2 => "DOCTORS",
			3 => "WORK_TIME",
			4 => "DEPARTURE_HOUSE",
			5 => "CHILDREN_DOCTOR",
			6 => "DIAGNOSTICS",
			7 => "CONTACTS",
			8 => "MAP",
			9 => "AREA",
			10 => "ONLINE",
			11 => "COST_PRICE",
			12 => "DMC",
			13 => "UMC",
			14 => "REGION",
			15 => "METRO",
			16 => "CATEGORY",
			17 => "",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
    </section>
    <section class="container doctors-lastfeedback">
        <h2 class="title-h2">Аллергологи - последние отзывы</h2>
        <div class="doctors-lastfeedback-list slick-slider1">
            <div class="doctors-lastfeedback-list-item">
                <div class="doctors-lastfeedback-list-item__doctor-info">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                    <div class="doctors-lastfeedback-list-item__doctor-info__content">
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                    </div>
                </div>
                <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
                <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
            </div>
            <div class="doctors-lastfeedback-list-item">
                <div class="doctors-lastfeedback-list-item__doctor-info">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                    <div class="doctors-lastfeedback-list-item__doctor-info__content">
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                    </div>
                </div>
                <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
                <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
            </div>
            <div class="doctors-lastfeedback-list-item">
                <div class="doctors-lastfeedback-list-item__doctor-info">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                    <div class="doctors-lastfeedback-list-item__doctor-info__content">
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                    </div>
                </div>
                <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
                <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
            </div>
            <div class="doctors-lastfeedback-list-item">
                <div class="doctors-lastfeedback-list-item__doctor-info">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                    <div class="doctors-lastfeedback-list-item__doctor-info__content">
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                    </div>
                </div>
                <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
                <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
            </div>
            <div class="doctors-lastfeedback-list-item">
                <div class="doctors-lastfeedback-list-item__doctor-info">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                    <div class="doctors-lastfeedback-list-item__doctor-info__content">
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                        <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                    </div>
                </div>
                <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
                <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>