<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клиникам");
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
        <p>Размещение вашей клиники в сети интернет - это не только удобная витрина представления ваших услуг и возможностей, но и реальный инструмент получения записей от реальных пациентов.</p>
        <p>С каждым годом число пациентов, ищущих услуги врачей в сети интернет растет в геометрической прогрессии.</p>
        <p>Добавьте свою клинику, заполните подробную информацию и получайте больше клиентов и отзывов на ваши услуги.</p>
        <?$APPLICATION->IncludeComponent("bitrix:form.result.new","doctors",Array(
                "SEF_MODE" => "Y",
                "WEB_FORM_ID" => "2",
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_SHADOW" => "N",
                "AJAX_OPTION_JUMP" => "Y",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "LIST_URL" => "result_list.php",
                "EDIT_URL" => "result_edit.php",
                "SUCCESS_URL" => "",
                "CHAIN_ITEM_TEXT" => "",
                "CHAIN_ITEM_LINK" => "",
                "IGNORE_CUSTOM_TEMPLATE" => "Y",
                "USE_EXTENDED_ERRORS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "SEF_FOLDER" => "/",
                "VARIABLE_ALIASES" => Array(
                )
            )
        );?>
    </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>