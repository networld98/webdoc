<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Выбор врача и клиники по отзывам от настоящих пользователей, по месторасположению и ценам. Актуальные контактные данные клиник, статьи по медицине и полезные материалы.");
$APPLICATION->SetTitle("Webdoc.clinic - осознанный выбор врача, клиники и медицинских услуг в вашем городе"); ?>
<?/*if($_SERVER["SERVER_NAME"]==="webdoc.clinic"){
    header('Location: http://lib.webdoc.clinic/');
    exit;
}*/?>
    <section class="container library">
        <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"lib_articles", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "20",
		"NEWS_COUNT" => "1000",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "Y",
		"USE_REVIEW" => "Y",
		"USE_FILTER" => "N",
		"SORT_BY1" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"STRICT_SECTION_CHECK" => "Y",
		"SET_TITLE" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"SET_LAST_MODIFIED" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => "",
		"FILTER_PROPERTY_CODE" => "",
		"NUM_NEWS" => "20",
		"NUM_DAYS" => "30",
		"YANDEX" => "Y",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(
			0 => "0",
			1 => "1",
			2 => "2",
			3 => "3",
			4 => "4",
		),
		"CATEGORY_IBLOCK" => array(
		),
		"CATEGORY_CODE" => "CATEGORY",
		"CATEGORY_ITEMS_COUNT" => "5",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"POST_FIRST_MESSAGE" => "Y",
		"SEF_FOLDER" => "/articles/",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"USE_SHARE" => "Y",
		"SHARE_HIDE" => "Y",
		"SHARE_TEMPLATE" => "",
		"SHARE_HANDLERS" => array(
			0 => "delicious",
			1 => "facebook",
			2 => "twitter",
			3 => "lj",
		),
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_SHORTEN_URL_KEY" => "",
		"COMPONENT_TEMPLATE" => "lib_articles",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
        <!-- <div class="library-content symptoms-box active" data-tabs='1'>
        <div class="row general-blocks">
            <div class="col-lg-6">
                <div class="general-block-item">
                    <h3 class="title-h3">Общие симптомы</h3>
                    <ul class="general-block-item-list">
                        <li><a href="#">Кашель</a></li>
                        <li><a href="#">Обезвоживание</a></li>
                        <li><a href="#">Кашель</a></li>
                        <li><a href="#">Обезвоживание</a></li>
                        <li><a href="#">Кашель</a></li>
                        <li><a href="#">Обезвоживание</a></li>
                        <li><a href="#">Кашель</a></li>
                        <li><a href="#">Обезвоживание</a></li>
                        <li><a href="#">Кашель</a></li>
                        <li><a href="#">Обезвоживание</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
             <div class="general-block-item">
                    <h3 class="title-h3">Симптомы по частям тела</h3>
                    <ul class="general-block-item-list">
                        <li><a href="#">Грудь, сердце</a></li>
                        <li><a href="#">Мужские симптомы</a></li>
                        <li><a href="#">Грудь, сердце</a></li>
                        <li><a href="#">Мужские симптомы</a></li>
                        <li><a href="#">Грудь, сердце</a></li>
                        <li><a href="#">Мужские симптомы</a></li>
                        <li><a href="#">Грудь, сердце</a></li>
                        <li><a href="#">Мужские симптомы</a></li>
                        <li><a href="#">Грудь, сердце</a></li>
                        <li><a href="#">Мужские симптомы</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row variable-blocks">
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="variable-block-item">
                            <h3 class="title-h3">Глаза и зрение</h3>
                            <ul class="variable-block-item-list">
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                                <li><a href="#">8 проблем на веках глаз</a></li>
                                <li><a href="#">Кровь из носа</a></li>
                                <li><a href="#">Болят ноги у ребенка (болезнь роста)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</section>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>