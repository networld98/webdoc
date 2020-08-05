<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги");
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

<section class="container services-list">
	<h2 class="title-h2">Услуги по направлениям</h2>
	<div class="sort-block">
		<ul class="sort-block-list">
			<li class="sort-block-list-item active">Направления</li>
			<li class="sort-block-list-item">Диагностика</li>
		</ul>
	</div>
	<div class="services-list-item">
		<h3 class="title-h3">Андрология<span class="services-list-item__count">20</span></h3>
		<ul class="services-list-item__list">
			<li><a href="">Спермограмма</a></li>
			<li><a href="">Лечебный массаж простаты</a></li>
			<li><a href="">MAR-тест (на антиспермальные антитела)</a></li>
			<li><a href="">Исследование секрета простаты</a></li>
			<li><a href="">Циркумцизио (обрезание)</a></li>
			<li><a href="">Пластика короткой уздечки (френулотомия)</a></li>
			<li><a href="">Биохимический анализ спермы</a></li>
			<li><a href="">Пункция мошонки</a></li>
			<li><a href="">Разделение синехий крайней плоти</a></li>
			<li><a href="">Операция Райха</a></li>
			<li><a href="">Вазорезекция (стерилизация)</a></li>
			<li><a href="">Операция Винкельмана при водянке яичка</a></li>
			<li><a href="">Вправление парафимоза</a></li>
			<li><a href="">Удаление кисты придатка яичка</a></li>
			<li><a href="">Увеличение полового члена</a></li>
			<li><a href="">Удаление множественных атером мошонки</a></li>
			<li><a href="">Биопсия предстательной железы</a></li>
			<li><a href="">Операция по удалению водянки яичка</a></li>
		</ul>
	</div>
	<div class="services-list-item">
		<h3 class="title-h3">Венерология<span class="services-list-item__count">3</span></h3>
		<ul class="services-list-item__list">
			<li><a href="">Удаление кондилом</a></li>
		</ul>
	</div>
	<div class="services-list-item">
		<h3 class="title-h3">Гастроэнтерология<span class="services-list-item__count">28</span></h3>
		<ul class="services-list-item__list">
			<li><a href="">Дыхательный тест на хеликобактер</a></li>
			<li><a href="">Лапароскопия диагностическая</a></li>
			<li><a href="">рН-метрия желудка</a></li>
			<li><a href="">Операции на поджелудочной железе</a></li>
			<li><a href="">Печеночные пробы</a></li>
			<li><a href="">Ретроградная холангиопанкреатография (ЭРХПГ)</a></li>
			<li><a href="">Бактериологическое исследование кала</a></li>
			<li><a href="">Дуоденальное зондирование</a></li>
			<li><a href="">Холецистография</a></li>
		</ul>
		<a href="" class="services-list__show-more">Показать все</a>
	</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>