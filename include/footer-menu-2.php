<div class="col__block">
    <div class="col-header">Пациенту</div>
    <div class="two-column">
        <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"vertical_footer_second", 
	array(
		"ROOT_MENU_TYPE" => "bottom_pacient1",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_TITLE" => GetMessage("MENU_1_TITLE"),
		"COMPONENT_TEMPLATE" => "vertical_footer_second",
		"MENU_THEME" => "site"
	),
	false
); ?>
        <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"vertical_footer_second", 
	array(
		"ROOT_MENU_TYPE" => "bottom_pacient2",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_TITLE" => GetMessage("MENU_1_TITLE"),
		"COMPONENT_TEMPLATE" => "vertical_footer_second",
		"MENU_THEME" => "site"
	),
	false
); ?>
    </div>
</div>