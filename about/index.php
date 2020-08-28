<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О нас");
?>
    <section class="container">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
            "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
            "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
            "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        ),
            false
        );?>
        <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
        <p>Веб Док Клиник - это лучшие медицинские услуги, на основе рейтингов реальных пациентов. 100% проверенная бесплатная информация о медицинских услугах,  без прямых и скрытых комиссий.</p>
        <p>Система сбора данных о медицинских услугах докторов и клиник, позволяет определять лучшее медицинские услуги в вашем городе.</p>
        <p>WebDocClinic не заинтересована в получении прибыли за количество записей на прием в клинику или к доктору и не получает % от обращений пациентов в медицинское учреждение.Мы видим свою миссию в предоставлении информации для бесплатного выбора лучших медицинских услуг, опираясь на реальные отзывы пациентов, получивших помощь.</p>
        <p>Обратившись в нашу виртуальную клинику вы выбираете специалиста на основе фактической информации и отзывов, а не вслепую. В результате вы экономите время, деньги, и получаете качественные медицинские услуги в полном объеме и в удобное время. Отзывы реальных пациентов дают возможность оценить и сделать правильный выбор.</p>
        <div class="row">
            <div class="col-lg-3"><p>Полная база медицинских клиник в вашем регионе</p></div>
            <div class="col-lg-3"><p>Настоящие отзывы</p></div>
            <div class="col-lg-3"><p>Экономия времени на поиск специалиста</p></div>
            <div class="col-lg-3"><p>Все услуги портала абсолютно бесплатны для пациента</p></div>
        </div>
    </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>