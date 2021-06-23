<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

    use Bitrix\Main\Localization\Loc as Loc,
    \CUtilEx as CUtil;
    $this->setFrameMode(true);

    $randString = $this->randString();

    $COMPONENT_NAME = 'BXMAKER.GEOIP.CITY';

    $oManager = \Bxmaker\GeoIP\Manager::getInstance();


?>

<div class="bxmaker__geoip__city bxmaker__geoip__city--default js-bxmaker__geoip__city" id="bxmaker__geoip__city-id<?= $randString; ?>"
     data-debug="<?= $arResult['DEBUG']; ?>"
     data-data-use-domain-redirect="<?= $arParams['USE_DOMAIN_REDIRECT']; ?>"
     data-cookie-prefix="<?= $arParams['COOKIE_PREFIX']; ?>"
     data-reload="<?= $arParams['RELOAD_PAGE']; ?>"
     data-search-show="<?= $arParams['SEARCH_SHOW']; ?>"
     data-favorite-show="<?= $arParams['FAVORITE_SHOW']; ?>"
     data-use-yandex="<?= $arResult['USE_YANDEX']; ?>"
     data-use-yandex-search="<?= $arResult['USE_YANDEX_SEARCH']; ?>"
     data-yandex-search-skip-words="<?= $oManager->getPreparedForHtmlAttr($arResult['YANDEX_SEARCH_SKIP_WORDS']); ?>"
     data-msg-empty-result="<?= $oManager->getPreparedForHtmlAttr($arParams['MSG_EMPTY_RESULT']); ?>"
     data-key="<?= $randString; ?>">


    <? if ($arParams['CITY_SHOW'] == 'Y'): ?>
        <? $APPLICATION->IncludeComponent(
            "bxmaker:geoip.city.line",
            "custom",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                "CACHE_TIME" => $arParams['CACHE_TIME'],
                "COMPOSITE_FRAME_MODE" => $arParams['COMPOSITE_FRAME_MODE'],
                "COMPOSITE_FRAME_TYPE" => $arParams['COMPOSITE_FRAME_TYPE'],
                "CITY_LABEL" => $arParams['CITY_LABEL'],
                "QUESTION_SHOW" => $arParams['QUESTION_SHOW'],
                "QUESTION_TEXT" => $arParams['QUESTION_TEXT'],
                "INFO_SHOW" => $arParams['INFO_SHOW'],
                "INFO_TEXT" => $arParams['INFO_TEXT'],
                "BTN_EDIT" => $arParams['BTN_EDIT'],
            ),
            $component,
            array('HIDE_ICON' => 'Y')); ?>
    <? endif; ?>

    <div class="bxmaker__geoip__city__composite__params" id="bxmaker__geoip__city__composite__params__id<?= $randString; ?>">
        <? $frame = $this->createFrame('bxmaker__geoip__city__composite__params__id' . $randString, false)->begin(); ?>
        <div class="js-bxmaker__geoip__city__composite__params"
             data-location-domain="<?= $arParams['LOCATION_DOMAIN']; ?>"
             data-cookie-domain="<?= $arParams['COOKIE_DOMAIN']; ?>"></div>
        <? $frame->beginStub(); ?>
        <div class="js-bxmaker__geoip__city__composite__params"
             data-location-domain=""
             data-cookie-domain=""></div>
        <? $frame->end(); ?>
    </div>


    <div class="bxmaker__geoip__popup js-bxmaker__geoip__popup" id="bxmaker__geoip__popup-id<?= $randString; ?>">
        <div class="bxmaker__geoip__popup-background js-bxmaker__geoip__popup-background"></div>

        <div class="bxmaker__geoip__popup-content js-bxmaker__geoip__popup-content">
            <div class="bxmaker__geoip__popup-close js-bxmaker__geoip__popup-close">&times;</div>
            <div class="bxmaker__geoip__popup-header">
                <?= $arParams['POPUP_LABEL']; ?>
            </div>

            <div class="bxmaker__geoip__popup-search">
                <input type="text" name="city" value="" placeholder="<?= $arParams['INPUT_LABEL']; ?>" autocomplete="off">
                <span class="bxmaker__geoip__popup-search-clean js-bxmaker__geoip__popup-search-clean">&times;</span>
                <div class="bxmaker__geoip__popup-search-options js-bxmaker__geoip__popup-search-options"></div>
            </div>


            <div class="bxmaker__geoip__popup-options">
                <?
                    $iColRows = ceil(count($arResult['ITEMS']) / 3);
                ?>
                <div class="bxmaker__geoip__popup-options-col">
                    <?
                        $i = -1;
                        foreach ($arResult['ITEMS'] as $item) {

                            if (++$i > 0 && $i % $iColRows == 0) {
                                echo '</div><div class="bxmaker__geoip__popup-options-col ">';
                            }

                            echo '<div class="bxmaker__geoip__popup-option ' . ($item['MARK'] ? 'bxmaker__geoip__popup-option--bold' : '') . ' js-bxmaker__geoip__popup-option  "	data-id="' . $item['ID'] . '"><span>' . $item['NAME'] . '</span></div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?$arParams = array("replace_space"=>"-","replace_other"=>"-");?>
<script>
    $(document).ready(function () {
        $('.city_input').trigger('click'); $('.bx_filter_param_label_<?=Cutil::translit($_COOKIE['bxmaker_geoip_2_4_2_city'],"ru",$arParams);?>').trigger('click');$('.popup-window').hide();
    })
</script>