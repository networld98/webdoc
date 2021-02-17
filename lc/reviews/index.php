<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

$arFilter = Array("IBLOCK_ID"=>array(9,10), "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $id = $arFields['ID'];
    $iblock = $arFields['IBLOCK_ID'];
}?>
<? include '../menu.php';?>
<div class="personal-cabinet-content__price-page">
    <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
    <div class="personal-cabinet-content__schedule-page__block no-border-padding2">
        <?$APPLICATION->IncludeComponent(
	"api:reviews", 
	"custom_lc", 
	array(
		"CACHE_TIME" => "31536000",
		"CACHE_TYPE" => "N",
		"COLOR" => "blue",
		"DETAIL_HASH" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_ID" => $id,
		"EMAIL_TO" => "",
		"FORM_CITY_VIEW" => "N",
		"FORM_DELIVERY" => array(
		),
		"FORM_DISPLAY_FIELDS" => array(
			0 => "RATING",
			1 => "COMPANY",
			2 => "ADVANTAGE",
			3 => "DISADVANTAGE",
			4 => "ANNOTATION",
			5 => "GUEST_NAME",
			6 => "GUEST_EMAIL",
		),
		"FORM_FORM_SUBTITLE" => "",
		"FORM_FORM_TITLE" => "Отзыв о клинике",
		"FORM_MESS_ADD_REVIEW_ERROR" => "Внимание!<br>Ошибка добавления отзыва",
		"FORM_MESS_ADD_REVIEW_EVENT_TEXT" => "<p>#USER_NAME# добавил(а) новый отзыв (оценка: #RATING#) ##ID#</p>
        <p>Открыть в админке #LINK_ADMIN#</p>
        <p>Открыть на сайте #LINK#</p>",
		"FORM_MESS_ADD_REVIEW_EVENT_THEME" => "Отзыв о Клинике (оценка: #RATING#) ##ID#",
		"FORM_MESS_ADD_REVIEW_MODERATION" => "Спасибо!<br>Ваш отзыв отправлен на модерацию",
		"FORM_MESS_ADD_REVIEW_VIZIBLE" => "Спасибо!<br>Ваш отзыв опубликован",
		"FORM_MESS_EULA" => "Нажимая кнопку «Отправить отзыв», я принимаю условия Пользовательского соглашения и даю своё согласие на обработку моих персональных данных, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях и для целей, определенных Политикой конфиденциальности.",
		"FORM_MESS_EULA_CONFIRM" => "Для продолжения вы должны принять условия Пользовательского соглашения",
		"FORM_MESS_PRIVACY" => "Я согласен на обработку персональных данных",
		"FORM_MESS_PRIVACY_CONFIRM" => "Для продолжения вы должны принять соглашение на обработку персональных данных",
		"FORM_MESS_PRIVACY_LINK" => "",
		"FORM_MESS_STAR_RATING_1" => "Ужасно",
		"FORM_MESS_STAR_RATING_2" => "Плохо",
		"FORM_MESS_STAR_RATING_3" => "Удовлетворительно",
		"FORM_MESS_STAR_RATING_4" => "Хорошо",
		"FORM_MESS_STAR_RATING_5" => "Отлично",
		"FORM_PREMODERATION" => "N",
		"FORM_REQUIRED_FIELDS" => array(
			0 => "RATING",
			1 => "ANNOTATION",
		),
		"FORM_RULES_LINK" => "http://doc.btx.bz/rules/",
		"FORM_RULES_TEXT" => "Правила публикации отзывов",
		"FORM_SHOP_BTN_TEXT" => "Оставить свой отзыв",
		"FORM_SHOP_TEXT" => "Отзывы о клиние",
		"FORM_USE_EULA" => "Y",
		"FORM_USE_PRIVACY" => "Y",
		"IBLOCK_ID" => $iblock,
		"INCLUDE_CSS" => "Y",
		"INCLUDE_JQUERY" => "jquery2",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_ITEMS_LIMIT" => "10",
		"LIST_MESS_ADD_UNSWER_EVENT_TEXT" => "#USER_NAME#, здравствуйте! 
        К Вашему отзыву добавлен официальный ответ, для просмотра перейдите по ссылке #LINK#",
		"LIST_MESS_ADD_UNSWER_EVENT_THEME" => "Официальный ответ к вашему отзыву",
		"LIST_MESS_HELPFUL_REVIEW" => "Отзыв полезен?",
		"LIST_MESS_TRUE_BUYER" => "Проверенный пациент",
		"LIST_SET_TITLE" => "N",
		"LIST_SHOP_NAME_REPLY" => "Портал DOC.BTX.BZ",
		"LIST_SHOW_THUMBS" => "N",
		"LIST_SORT_FIELDS" => array(
			0 => "ACTIVE",
			1 => "ACTIVE_FROM",
			2 => "RATING",
			3 => "THUMBS",
		),
		"LIST_SORT_FIELD_1" => "ACTIVE_FROM",
		"LIST_SORT_FIELD_2" => "DATE_CREATE",
		"LIST_SORT_FIELD_3" => "ID",
		"LIST_SORT_ORDER_1" => "DESC",
		"LIST_SORT_ORDER_2" => "DESC",
		"LIST_SORT_ORDER_3" => "DESC",
		"MESSAGE_404" => "",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "31536000",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_THEME" => "blue",
		"PAGER_TITLE" => "Отзывы",
		"PICTURE" => array(
		),
		"RESIZE_PICTURE" => "48x48",
		"SECTION_ID" => "",
		"SEF_MODE" => "Y",
		"SET_STATUS_404" => "N",
		"SHOP_NAME" => "DOC.BTX.BZ",
		"SHOW_404" => "N",
		"STAT_MESS_CUSTOMER_RATING" => "На основе #N# оценок пациентов",
		"STAT_MESS_CUSTOMER_REVIEWS" => "Отзывы пациентов <span class=\"api-reviews-count\"></span>",
		"STAT_MESS_TOTAL_RATING" => "На основе отзывов пациентов",
		"STAT_MIN_AVERAGE_RATING" => "5",
		"THEME" => "aspro",
		"THUMBNAIL_HEIGHT" => "72",
		"THUMBNAIL_WIDTH" => "114",
		"UPLOAD_FILE_LIMIT" => "8",
		"UPLOAD_FILE_SIZE" => "10M",
		"UPLOAD_FILE_TYPE" => "",
		"UPLOAD_VIDEO_LIMIT" => "8",
		"URL" => "",
		"USE_FORM_MESS_FIELD_PLACEHOLDER" => "N",
		"USE_MESS_FIELD_NAME" => "N",
		"USE_STAT" => "Y",
		"USE_SUBSCRIBE" => "Y",
		"USE_USER" => "Y",
		"COMPONENT_TEMPLATE" => "custom_lc",
		"SUBSCRIBE_AJAX_URL" => "/bitrix/components/api/reviews.subscribe/ajax.php",
		"MESS_SUBSCRIBE_LINK" => "Подписаться на новые отзывы",
		"MESS_SUBSCRIBE_FIELD_PLACEHOLDER" => "Введите свой e-mail",
		"MESS_SUBSCRIBE_BUTTON_TEXT" => "Подписаться",
		"MESS_SUBSCRIBE_SUBSCRIBE" => "Вы успешно подписались!",
		"MESS_SUBSCRIBE_UNSUBSCRIBE" => "Вы успешно отписались!",
		"MESS_SUBSCRIBE_ERROR" => "Ошибка изменения подписки!",
		"MESS_SUBSCRIBE_ERROR_EMAIL" => "Укажите e-mail",
		"MESS_SUBSCRIBE_ERROR_CHECK_EMAIL" => "Указанный e-mail некорректен!",
		"SEF_FOLDER" => "/lc/reviews/",
		"SEF_URL_TEMPLATES" => array(
			"list" => "",
			"detail" => "review#review_id#/",
			"user" => "user#user_id#/",
			"search" => "search/",
			"rss" => "rss/",
		)
	),
	false
);?>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>