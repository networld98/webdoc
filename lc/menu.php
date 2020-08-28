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
    <div class="personal-cabinet-menu__manager mobile-display-none">
        <div class="personal-cabinet-menu__manager__photo">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/manager-photo.png" alt="photo">
        </div>
        <p class="personal-cabinet-menu__manager__desc">Мой персональный менеджер</p>
        <p class="personal-cabinet-menu__manager__name">Марина Тихоновская</p>
        <a href="tel:+79892897445" class="personal-cabinet-menu__manager__phone">+7 (989) 289-74-45</a>
        <div class="personal-cabinet-menu__manager__social">
            <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/viber-icon.svg" alt="icon"></a>
            <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/whatsapp-icon.svg" alt="icon"></a>
            <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/telegram-icon.svg" alt="icon"></a>
        </div>
        <a href="mailto:marina@prodoctorov.ru" class="personal-cabinet-menu__manager__email">marina@prodoctorov.ru</a>
    </div>
</div>