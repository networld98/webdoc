<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Врачи");
?>
<div class="full-screen__filter-bg">
	<section class="container">
		<? $APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter",
            "horizontal",
            Array(
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => "horizontal",
                "CONVERT_CURRENCY" => "N",
                "DISPLAY_ELEMENT_COUNT" => "Y",
                "FILTER_NAME" => "arrFilter",
                "FILTER_VIEW_MODE" => "vertical",
                "HIDE_NOT_AVAILABLE" => "N",
                "IBLOCK_ID" => "10",
                "IBLOCK_TYPE" => "content",
                "PAGER_PARAMS_NAME" => "arrPager",
                "PREFILTER_NAME" => "smartPreFilter",
                "SAVE_IN_SESSION" => "N",
                "SECTION_CODE" => "",
                "SECTION_DESCRIPTION" => "-",
                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                "SECTION_TITLE" => "-",
                "SEF_MODE" => "N",
                "TEMPLATE_THEME" => "blue",
                "XML_EXPORT" => "N"
            )
        );
	?>
	</section>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"doctors", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"BIG_DATA_RCM_TYPE" => "personal",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
			0 => "BUY",
		),
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => array(
		),
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_IMAGE_RESOLUTION" => "16by9",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"DETAIL_SHOW_POPULAR" => "Y",
		"DETAIL_SHOW_SLIDER" => "N",
		"DETAIL_SHOW_VIEWED" => "Y",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_HIDE_ON_MOBILE" => "N",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_SUBSECTIONS" => "Y",
		"INSTANT_RELOAD" => "N",
		"LABEL_PROP" => array(
		),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_ENLARGE_PRODUCT" => "STRICT",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"LIST_SHOW_SLIDER" => "Y",
		"LIST_SLIDER_INTERVAL" => "3000",
		"LIST_SLIDER_PROGRESS" => "N",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_COMMENTS_TAB" => "Комментарии",
		"MESS_DESCRIPTION_TAB" => "Описание",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_PRICE_RANGES_TITLE" => "Цены",
		"MESS_PROPERTIES_TAB" => "Характеристики",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SEARCH_CHECK_DATES" => "Y",
		"SEARCH_NO_WORD_LOGIC" => "Y",
		"SEARCH_PAGE_RESULT_COUNT" => "50",
		"SEARCH_RESTART" => "N",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_TOP_ELEMENTS" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "N",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_ENLARGE_PRODUCT" => "STRICT",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"TOP_SHOW_SLIDER" => "Y",
		"TOP_SLIDER_INTERVAL" => "3000",
		"TOP_SLIDER_PROGRESS" => "N",
		"TOP_VIEW_MODE" => "SECTION",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_BIG_DATA" => "Y",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_FILTER" => "N",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"USE_GIFTS_SECTION" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_REVIEW" => "N",
		"USE_SALE_BESTSELLERS" => "Y",
		"USE_STORE" => "N",
		"COMPONENT_TEMPLATE" => "doctors",
		"VARIABLE_ALIASES" => array(
			"ELEMENT_ID" => "ELEMENT_ID",
			"SECTION_ID" => "SECTION_ID",
		)
	),
	false
);?>

<section class="container doctor-card">
	<div class="flex-left">
		<div class="doctor-card-top-content">
			<div class="doctor-card__img">
				<a href="" class="doctor-card__img-link"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctor-photo.png" alt="doctor-photo" class="doctor-card__img-photo"></a>
				<div class="doctor-card__img-info">
					<a id="header-mess" style="cursor:pointer;">Написать доктору</a>
					<a href="tel:+1234567890">Позвонить</a>
				</div>
				<div class="doctor-card-favorites"></div>
			</div>
			<div class="doctor-card__description">
				<p class="doctor-card__description-position">Аллерголог · Иммунолог · Доцент</p>
				<p class="doctor-card__description-title">Баранова Ирина Дмитриевна</p>
				<p class="doctor-card__description-exp">Стаж 28 лет</p>
				<p class="doctor-card__description-degree">Кандидат медицинских наук</p>
				<p class="doctor-card__description-price">2 000 Р<span>Цена приема в клинике</span></p>
				<a href="tel:+8(812)000-00-00" class="doctor-card__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
				<div class="doctor-card__description__adapt">
					<p class="doctor-card__clinic-name">Центр амбулаторной хирургии</p>
					<p class="doctor-card__clinic-adress">Санкт-Петербург, ул. Чекистов, д. 22 (м. Проспект ветеранов)</p>
					<ul class="doctor-card__metro-list">
						<li class="doctor-card_metro-list-item metro2">м. Беговая</li>
						<li class="doctor-card_metro-list-item metro3">м. Старая Деревня</li>
						<!-- <div class="doctor-card-location-map"></div> -->
					</ul>
					<a href="" class="doctor-card__metro-list-show_more">ещё адреса приёма</a>
				</div>
			</div>
		</div>
		<div class="doctor-card-popUp-group">
			<a id="header-reception" class="doctor-card-popUp-group__reception"><span>Записаться на прием</span></a>
			<a id="header-call" class="doctor-card-popUp-group__call"><span>Вызвать врача на дом</span></a>
			<a id="header-map" class="doctor-card-popUp-group__route popup-link"><span>Проложить маршрут</span></a>
		</div>
	</div>
	<div class="flex-right">
		<div class="doctor-card-top-content">
			<div class="doctor-card__title">
				<h3 class="title-h3">Информация о враче</h3>
				<div class="doctor-card__img-info-ratings">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				</div>
			</div>
			<p class="doctor-card__img-info-commend">100% пациентов рекомендуют врача на основе 131 отзыва<a href="">Все отзывы о враче</a></p>
			<ul class="doctor-card_options-list">
			<li class="doctor-card_options-list-item">Детский врач</li>
				<li class="doctor-card_options-list-item">Выезд на дом</li>
				<li class="doctor-card_options-list-item">По полису ДМС</li>
			</ul>
			<p class="doctor-card__position-desc">Врач аллегролог-иммунолог. Специализируется на лечении атопического дерматита, крапивницы, отека Квинке, наследственного ангионевротического отека, аллергического ринита, поллиноза, непереносимости пищевых продуктов, лекарств, пыльцы. Автор 30 научных работ, посвященных проблемам ВИЧ-инфекции, гриппа, герпетических инфекций, фурункулеза и др. Постоянно повышает свою квалификацию и участвует в конференциях по иммунологии, аллергологии, педиатрии и инфекционным болезням.</p>
			<a href="#anchor-spec-info" class="doctor-card__metro-list-show_more go-to">Подробная информация о специалисте</a>
		</div>
		<div class="doctor-card-popUp-group">
			<a id="header-map" class="doctor-card-popUp-group__route popup-link">Проложить маршрут</a>
		</div>
		<div class="map-wrapper">
                <div class="doctor-card-location-map popup-link-marker"></div>
                <div class="popup-box">
					<div class="close"></div>
					<div class="map-popup">
						<h1>hello2 route</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
					<div class="map-popup-marker">
						<h1>hello2 marker</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                	</div>
				</div>
            </div>
	</div>
</section>

<section class="container choosing-time">
	<h3 class="title-h3">Выберите время приема для записи онлайн</h3>
	<div class="choosing-time_block">
			<!-- <span class="choosing-time_block__arrows arrow-left"></span> -->
			<ul class="choosing-time_block-list slick-slider3">
				<li class="choosing-time_block-list-item active">Сегодня</br> 6 апреля</li>
				<li class="choosing-time_block-list-item">Завтра</br> 7 апреля</li>
				<li class="choosing-time_block-list-item">Среда</br> 8 апреля</li>
				<li class="choosing-time_block-list-item not-worked">Четверг</br> 9 апреля</li>
				<li class="choosing-time_block-list-item">Пятница</br> 10 апреля</li>
				<li class="choosing-time_block-list-item">Cуббота</br> 11 апреля</li>
			</ul>
			<!-- <span class="choosing-time_block__arrows arrow-right"></span> -->
		</div>
		<ul class="choosing-time__worktimming-list">
			<li class="choosing-time__worktimming-list-item">09:00</li>
			<li class="choosing-time__worktimming-list-item closed">09:40</li>
			<li class="choosing-time__worktimming-list-item closed">10:10</li>
			<li class="choosing-time__worktimming-list-item pass">10:50</li>
			<li class="choosing-time__worktimming-list-item">11:30</li>
			<li class="choosing-time__worktimming-list-item">12:10</li>
			<li class="choosing-time__worktimming-list-item">12:50</li>
			<li class="choosing-time__worktimming-list-item">13:30</li>
			<li class="choosing-time__worktimming-list-item">14:10</li>
			<li class="choosing-time__worktimming-list-item pass">14:50</li>
			<li class="choosing-time__worktimming-list-item pass">15:30</li>
			<li class="choosing-time__worktimming-list-item">16:00</li>
			<li class="choosing-time__worktimming-list-item">16:40</li>
			<li class="choosing-time__worktimming-list-item closed">17:20</li>
			<li class="choosing-time__worktimming-list-item">18:00</li>
			<li class="choosing-time__worktimming-list-item closed">18:40</li>
			<li class="choosing-time__worktimming-list-item">19:00</li>
		</ul>
</section>

<section class="container checked-feedback">
	<h2 class="title-h2">Проверенные отзывы о враче</h2>
	<div class="checked-feedback-list slick-slider2">
		<div class="checked-feedback-list-item">
			<div class="checked-feedback-list-item__doctor-info">
				<div class="checked-feedback-list-item__img-info-ratings starrr">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<span>Отлично</span>
				</div>
				<p class="checked-feedback-list-item__from">Марина, 16 февраля 2020,<span>прием в клинике</span></p>
				<p class="checked-feedback-list-item__feedback">Доброжелательный и приятный врач. Видно, что это профессионал своего дела. Она все спросила, узнала историю, причину. Все доступно объяснила, рассказала, дала рекомендации и назначения.</p>
			</div>
		</div>
		<div class="checked-feedback-list-item">
			<div class="checked-feedback-list-item__doctor-info">
				<div class="checked-feedback-list-item__img-info-ratings">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<span>Отлично</span>
				</div>
				<p class="checked-feedback-list-item__from">Дмитрий, 18 января 2020,<span>прием в клинике</span></p>
				<p class="checked-feedback-list-item__feedback">Очень внимательный доктор. Она досконально все выяснила, спросила какие были операции, заболевания в детстве. Составила диету, чтобы исключить продукты, которые могут вызывать аллергию. Прописала лечение, сказала какие препараты нужно употреблять и обозначила несколько анализов, которые нужно сдать, подешевле и подороже. Я давно мучаюсь с аллергией, но не встречал еще лучше врача! Я услышал все, что хотел!</p>
			</div>
		</div>
		<div class="checked-feedback-list-item">
			<div class="checked-feedback-list-item__doctor-info">
				<div class="checked-feedback-list-item__img-info-ratings">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<span>Отлично</span>
				</div>
				<p class="checked-feedback-list-item__from">Дмитрий, 18 января 2020,<span>прием в клинике</span></p>
				<p class="checked-feedback-list-item__feedback">Очень приятный и спокойный человек. Я и мой муж посещаем не первый раз данного специалиста и очень удовлетворены ей! Результат от первого этапа лечения уже есть! Доктор все спрашивает, вникает в проблему, обсуждает всю информацию и отвечает абсолютно на все вопросы! От врача не уходишь пока все не решишь, не смотря на то, что иногда прием занимает больше времени чем положено!</p>
			</div>
		</div>
		<div class="checked-feedback-list-item">
			<div class="checked-feedback-list-item__doctor-info">
				<div class="checked-feedback-list-item__img-info-ratings">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-none-filled.png" alt="">
					<span>Хорошо</span>
				</div>
				<p class="checked-feedback-list-item__from">Дмитрий, 18 января 2020,<span>прием в клинике</span></p>
				<p class="checked-feedback-list-item__feedback">Очень приятный и спокойный человек. Я и мой муж посещаем не первый раз данного специалиста и очень удовлетворены ей! Результат от первого этапа лечения уже есть! Доктор все спрашивает, вникает в проблему, обсуждает всю информацию и отвечает абсолютно на все вопросы! От врача не уходишь пока все не решишь, не смотря на то, что иногда прием занимает больше времени чем положено!</p>
			</div>
		</div>
		<div class="checked-feedback-list-item">
			<div class="checked-feedback-list-item__doctor-info">
				<div class="checked-feedback-list-item__img-info-ratings">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
					<span>Отлично</span>
				</div>
				<p class="checked-feedback-list-item__from">Марина, 16 февраля 2020,<span>прием в клинике</span></p>
				<p class="checked-feedback-list-item__feedback">Доброжелательный и приятный врач. Видно, что это профессионал своего дела. Она все спросила, узнала историю, причину. Все доступно объяснила, рассказала, дала рекомендации и назначения.</p>
			</div>
		</div>
	</div>
</section>

<section id="anchor-spec-info" class="container spec-info">
	<h2 class="title-h2">Информация о специалисте</h2>
	<div class="spec-info-block">
		<ul class="spec-info-block__spec-list">
			<h3 class="title-h3">Специализируется на лечении</h3>
			<li>
				<p class="spec-info-block__spec-list__title">Аллерголог</p>
				<ul>
					<li class="spec-info-block__spec-list-item"><a href="">Аллергический дерматит</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Аллергический ринит</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Аллергия</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Aллергия лекарственная</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Аллергия пищевая</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Ангионевротический отек</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Дерматит атопический</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Дерматит контактный</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Крапивница</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Отек Квинке</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Поллиноз</a></li>
					<li class="spec-info-block__spec-list-item"><a href="">Ринит аллергический</a></li>
				</ul>
			</li>
		</ul>
		<ul class="spec-info-block__education-list">
			<h3 class="title-h3">Образование</h3>
			<ol>
				<li><span>1997</span>Ординатура по специальности "Аллергология и иммунология", Гематологический научный центр Институт Иммунологии</li>
				<li><span>1993</span>Интернатура по специальности "Детские инфекционные болезни", Смоленский государственный медицинский институт</li>
				<li><span>1992</span>Смоленский государственный медицинский институт</li>
			</ol>
		</ul>
		<ul class="spec-info-block__exp-list">
			<h3 class="title-h3">Опыт работы</h3>
			<ol>
				<li><span>2010 -2012</span>Врач аллерголог-иммунолог, педиатр-инфекционист, МЦ "Саккара"</li>
				<li><span>1996 -2010</span>Заведующая отделением, врач-аллерголог-иммунолог, педиатр-инфекционист, Орловский областной центр по борьбе и профилактике СПИДа и инфекционных заболеваний</li>
				<li><span>1992 -1995</span>Врач педиатр-инфекционист, Детская инфекционная больница</li>
			</ol>
		</ul>
	</div>
</section>

<section class="container spec-list">
	<h2 class="title-h2">Специализация</h2>
	<div class="flex-between">
		<ul class="spec-list-list">
			<p class="spec-list-list__title">В качестве взрослого врача аллерголога-иммунолога проводит лечение следующих заболеваний:</p>
			<li>атопический дерматит, крапивница, отек Квинке;</li>
			<li>наследственный ангионевротический отек;</li>
			<li>аллергический ринит, поллиноз;</li>
			<li>непереносимость пищевых продуктов, лекарств, пыльцы;</li>
			<li>длительный субфебрилитет неясной этиологии;</li>
			<li>лимфаденопатии (увеличение лимфатических узлов);</li>
			<li>бактериальные инфекции кожи, подкожной клетчатки (пиодермии, фурункулезы);</li>
			<li>туберкулез, бруцеллез и другие тяжелые инфекционные заболевания, склонные к диссеминации и хронизации процесса;</li>
			<li>грибковые поражения кожи, ногтей, слизистых;</li>
			<li>вагинальные дисбактериозы, дисбактериозы кишечника, неподдающиеся стандартной медикаментозной терапии;</li>
			<li>частые "простудные" заболевания (более 4-х раз в год у взрослых, более 6-ти раз в год у детей);</li>
			<li>хронические рецидивирующие заболевания ЛОР-органов (синуситы, отиты), органов дыхания (бронхиты, пневмонии);</li>
			<li>хронические рецидивирующие инфекции мочеполовой системы (хламидийной, микоплазменной, уреаплазменной и др);</li>
			<li>рецидивирующие лямблиозы, токсокарозы, аскаридозы и другие гельминтозы при неэффективности стандартной медикаментозной терапии; • хронические рецидивирующие вирусные инфекции (ВПГ1,2 –вирусы герпеса, вызывающие поражение губ, носа, глаз, половых органов, ЦНС; инфекции, вызванные вирусом Эпштейн-Барр, цитомегаловирусом, вирусами герпеса ВГ-6, ВГ-7, ВГ-8);</li>
		</ul>
		<ul class="spec-list-list">
			<p class="spec-list-list__title">В качестве детского врача аллерголога-иммунолога проводит лечение у детей с 3-х лет следующих заболеваний:</p>
			<li>длительный субфебрилитет неясной этиологии; </li>
			<li>лимфаденопатии (увеличение лимфатических узлов);</li>
			<li>бактериальные инфекции кожи, подкожной клетчатки (пиодермии, фурункулезы);</li>
			<li>туберкулез, бруцеллез и другие тяжелые инфекционные заболевания, склонные к диссеминации и хронизации процесса;</li>
			<li>грибковые поражения кожи, ногтей, слизистых;</li>
			<li>вагинальные дисбактериозы, дисбактериозы кишечника, неподдающиеся стандартной медикаментозной терапии;</li>
			<li>частые "простудные" заболевания (более 6-ти раз в год у детей);</li>
			<li>хронические рецидивирующие заболевания ЛОР-органов (синуситы, отиты), органов дыхания (бронхиты, пневмонии);</li>
			<li>хронические рецидивирующие инфекции мочеполовой системы (хламидийной, микоплазменной, уреаплазменной и др);</li>
			<li>рецидивирующие лямблиозы, токсокарозы, аскаридозы и другие гельминтозы при неэффективности стандартной медикаментозной терапии;</li>
			<li>хронические рецидивирующие вирусные инфекции (ВПГ1,2 –вирусы герпеса, вызывающие поражение губ, носа, глаз, половых органов, ЦНС; инфекции, вызванные вирусом Эпштейн-Барр, цитомегаловирусом, вирусами герпеса ВГ-6, ВГ-7, ВГ-8);</li>
			<li>токсоплазменная, цитомегаловирусная;</li>
			<li>подготовка к вакцинациям и проведение различных прививок без осложнений;</li>
		</ul>
	</div>
</section>

<section class="container result-filter">
	<h2 class="title-h2">Врачи-аллергологи - <span class="title-h2__result-counts">(527)</span></h2>
	<div class="options-block">
		<div class="sort-block">
			<ul class="sort-block-list">
				<li class="sort-block-list-item active">Популярные</li>
				<li class="sort-block-list-item">Рейтинг</li>
				<li class="sort-block-list-item">Стаж</li>
				<li class="sort-block-list-item">Стоимость</li>
				<li class="sort-block-list-item">Отзывы</li>
			</ul>
			<select name="" id="" class="sort-block-list__select">
				<option value="">Популярные</option>
				<option value="">Рейтинг</option>
				<option value="">Стаж</option>
				<option value="">Стоимость</option>
				<option value="">Отзывы</option>
			</select>
		</div>
		<div class="calendar-block">
			<select class="calendar">
				<option value="">Расписание на <a href="">все дни</a></option>
			</select>
		</div>
	</div>
	<div class="doctors-list">
		<div class="doctors-list-item">
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
					<p class="doctors-list-item__description-exp">Стаж 28 лет</p>
					<p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
					<p class="doctors-list-item__description-price">2 000 Р<span>Цена приема в клинике</span></p>
					<a href="tel:+8(812)000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
					<span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
					<div class="doctors-list-item-favorites"></div>
				</div>
			</div>
			<div class="flex-right">
				<div class="doctors-list-item__description">
					<div class="adapt">
						<div>
							<p class="doctors-list-item_timing">Выберите время приема для записи онлайн</p>
							<ul class="doctors-list-item__days-list">
								<li class="doctors-list-item__days-list-item active">понедельник, 6</li>
								<li class="doctors-list-item__days-list-item">вторник, 7</li>
								<li class="doctors-list-item__days-list-item not-worked">среда, 8</li>
								<li class="doctors-list-item__days-list-item">четверг, 9</li>
							</ul>
							<ul class="doctors-list-item__worktimming-list">
								<li class="doctors-list-item__worktimming-list-item">09:00</li>
								<li class="doctors-list-item__worktimming-list-item closed">09:40</li>
								<li class="doctors-list-item__worktimming-list-item closed">10:10</li>
								<li class="doctors-list-item__worktimming-list-item pass">10:50</li>
								<li class="doctors-list-item__worktimming-list-item">11:30</li>
								<li class="doctors-list-item__worktimming-list-item">12:10</li>
								<li class="doctors-list-item__worktimming-list-item">09:00</li>
								<li class="doctors-list-item__worktimming-list-item">09:40</li>
								<li class="doctors-list-item__worktimming-list-item">10:10</li>
								<li class="doctors-list-item__worktimming-list-item">10:50</li>
								<li class="doctors-list-item__worktimming-list-item">11:30</li>
								<li class="doctors-list-item__worktimming-list-item">12:10</li>
							</ul>
						</div>
						<div>
							<p class="doctors-list-item__clinic-name">Центр амбулаторной хирургии</p>
							<p class="doctors-list-item__clinic-adress">Санкт-Петербург, ул. Чекистов, д. 22 (м. Проспект ветеранов)</p>
							<ul class="doctors-list-item__metro-list">
								<li class="doctors-list-item_metro-list-item metro1">м. Проспект ветеранов</li>
							</ul>
						</div>
					</div>
					<ul class="doctors-list-item_options">
						<li class="doctors-list-item_options-list-item">Детский врач</li>
						<li class="doctors-list-item_options-list-item">Выезд на дом</li>
						<li class="doctors-list-item_options-list-item">По полису ДМС</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="doctor-pagination">
		<div class="doctor-pagination_show-more">
			<button>Показать ещё</button>
		</div>
		<div class="doctor-pagination_block">
			<span class="doctor-pagination_block__arrows arrow-left"></span>
			<ul class="doctor-pagination_block-list">
				<li class="doctor-pagination_block-list-item">1</li>
				<li class="doctor-pagination_block-list-item active">2</li>
				<li class="doctor-pagination_block-list-item">3</li>
				<li class="doctor-pagination_block-list-item">4</li>
				<li class="doctor-pagination_block-list-item">5</li>
				<li class="doctor-pagination_block-list-item">6</li>
				<li class="doctor-pagination_block-list-item">7</li>
				<li class="doctor-pagination_block-list-item">...</li>
				<li class="doctor-pagination_block-list-item">25</li>
			</ul>
			<span class="doctor-pagination_block__arrows arrow-right"></span>
		</div>
	</div>
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
				<div class="col">
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
				<div class="col">
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
				<div class="col">
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
				<div class="col">
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
				<div class="col">
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
				<div class="col">
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
					<div class="col">
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
					<div class="col">
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
					<div class="col">
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
					<div class="col">
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
					<div class="col">
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
					<div class="col">
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