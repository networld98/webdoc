<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Врачам");
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
        <p>Станьте ближе к своим пациентам.</p>
        <p>По исследованиям, все большее количество пациентов ищут информацию о клиниках и врачах в сети интернет.</p>
        <p>Помогите им узнать о вас: вашей квалификации, опыте и умениях.</p>
        <p>Дайте им возможность разыскать вас и записаться на прием.</p>
        <?$APPLICATION->IncludeComponent("bitrix:form.result.new","doctors",Array(
                "SEF_MODE" => "Y",
                "WEB_FORM_ID" => "1",
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