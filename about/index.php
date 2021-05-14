<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О сервисе doctora.clinic");
?><section class="container about-page">
<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"custom",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
<h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
<p>
	Веб Док Клиник - это лучшие медицинские услуги, на основе рейтингов реальных пациентов. 100% проверенная бесплатная информация о медицинских услугах, без прямых и скрытых комиссий.
</p>
<p>
	Система сбора данных о медицинских услугах докторов и клиник, позволяет определять лучшее медицинские услуги в вашем городе.
</p>
<p>
	WebDocClinic не заинтересована в получении прибыли за количество записей на прием в клинику или к доктору и не получает % от обращений пациентов в медицинское учреждение.Мы видим свою миссию в предоставлении информации для бесплатного выбора лучших медицинских услуг, опираясь на реальные отзывы пациентов, получивших помощь.
</p>
<p>
	Обратившись в нашу виртуальную клинику вы выбираете специалиста на основе фактической информации и отзывов, а не вслепую. В результате вы экономите время, деньги, и получаете качественные медицинские услуги в полном объеме и в удобное время. Отзывы реальных пациентов дают возможность оценить и сделать правильный выбор.
</p>
<div class="row">
	<div class="col-lg-3 icons-block">
		<img alt="about_1" src="/local/templates/light_blue/icon/about_1.svg">Полная база медицинских клиник в вашем регионе
	</div>
	<div class="col-lg-3 icons-block">
		<img alt="about_1" src="/local/templates/light_blue/icon/about_2.svg">Настоящие отзывы
	</div>
	<div class="col-lg-3 icons-block">
		<img alt="about_1" src="/local/templates/light_blue/icon/about_3.svg">Экономия времени на поиск специалиста
	</div>
	<div class="col-lg-3 icons-block">
		<img alt="about_1" src="/local/templates/light_blue/icon/about_4.svg">Все услуги сервиса абсолютно бесплатны для пациента
	</div>
</div>
 </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>