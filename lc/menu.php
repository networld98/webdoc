<?
$rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
        if($arUser['UF_TYPE_USER']==6){
            $menu = "leftclinic";
        }elseif($arUser['UF_TYPE_USER']==7){
            $menu = "leftdoctor";
        }
?>
<div class="personal-cabinet-menu">
    <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"cabinet", 
	array(
		"ROOT_MENU_TYPE" => $menu,
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "cabinet"
	),
	false
); ?>
</div>