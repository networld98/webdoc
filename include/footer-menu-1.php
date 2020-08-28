
<div class="col__block">
    <div class="col-header">Врачу и клиникам</div>
    <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"vertical_footer_second", 
	array(
		"ROOT_MENU_TYPE" => "bottom_doctor",
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
<div class="col__block">
    <div class="col-header">Партнёрам</div>
    <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"vertical_footer_second", 
	array(
		"ROOT_MENU_TYPE" => "bottom_partner",
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

