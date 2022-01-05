<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
//Проверяем с какого раздела пришел пользователь
$doctors = stripos($_SERVER['HTTP_REFERER'], '/doctors/');
$clinics = stripos($_SERVER['HTTP_REFERER'], '/clinics/');
$services = stripos($_SERVER['HTTP_REFERER'], '/services/');
?>
<div class="search-page">
	<form action="" method="get">
		<input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
		<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
	</form>
    <?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):?>
        <div class="search-language-guess">
            <?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
        </div><br />
    <?endif;?>
    <?
    $cityCodes = [];
    $metroCodes = [];
    $areaCodes = [];
    $search = [];
    foreach ($arResult['SEARCH'] as $item){
        if (strpos($item['BODY'], $_GET['q']) !== false) {
            $cityId=CIBlockElement::GetByID($item['ITEM_ID'])->GetNextElement()->GetProperties()['CITY']['VALUE'];
            $areaId=CIBlockElement::GetByID($item['ITEM_ID'])->GetNextElement()->GetProperties()['AREA']['VALUE'];
            $metroIds=CIBlockElement::GetByID($item['ITEM_ID'])->GetNextElement()->GetProperties()['METRO']['VALUE'];
            if(!empty($metroIds)){
                foreach ($metroIds as $metro){
                    if (preg_match('/^\w+$/',$metro)) {
                        $metroCodes[$item['PARAM2']][CIBlockElement::GetByID($metro)->GetNextElement()->GetFields()['CODE']][] = $item['ITEM_ID'];
                    }
                }
            }
            if (is_array($cityId)){
                foreach ($cityId as $city){
                    $cityCodes[$item['PARAM2']][str_replace('-','',CIBlockSection::GetByID($city)->GetNext()['CODE'])][] = $item['ITEM_ID'];
                }
            }else{
                $cityCodes[$item['PARAM2']][str_replace('-','',CIBlockSection::GetByID($cityId)->GetNext()['CODE'])][] = $item['ITEM_ID'];
            }
            if (is_array($areaId)){
                foreach ($areaId as $area){
                    $areaCodes[$item['PARAM2']][CIBlockSection::GetByID($area)->GetNext()['CODE']][] = $item['ITEM_ID'];
                    $areaCodeDoctors[$item['PARAM2']][CIBlockSection::GetByID($area)->GetNext()['CODE']][] = $item['ITEM_ID'];
                }
            }else{
                $areaCodes[$item['PARAM2']][CIBlockSection::GetByID($areaId)->GetNext()['CODE']][] = $item['ITEM_ID'];
            }
            if ($_GET['q']==NULL){
                if ($item['PARAM2'] == '9'){
                    if((empty($_GET['arrFilter_92']) && empty($_GET['arrFilter_93']) && $_GET['arrFilter_94'] == str_replace('-','',CIBlockSection::GetByID($cityId)->GetNext()['CODE'])) || (empty($_GET['arrFilter_93']) && !empty($_GET['arrFilter_93']) && $_GET['arrFilter_94'] == str_replace('-','',CIBlockSection::GetByID($cityId)->GetNext()['CODE']) && in_array($_GET['arrFilter_93'],$areaCodes)) || (!empty($_GET['arrFilter_92']) && !empty($_GET['arrFilter_93']) && $_GET['arrFilter_94'] == str_replace('-','',CIBlockSection::GetByID($cityId)->GetNext()['CODE']) && in_array($_GET['arrFilter_93'],$areaCodes) && in_array($_GET['arrFilter_92'],$metroCodes)) ){
                        $search[$item['PARAM2']][] = $item['ITEM_ID'];
                    }
                }
                if ($item['PARAM2'] == '10'){
                    if((empty($_GET['arrFilter_92']) && empty($_GET['arrFilter_93']) && in_array($_GET['arrFilter_94'],$cityCodes))||(empty($_GET['arrFilter_92']) && !empty($_GET['arrFilter_93']) && in_array($_GET['arrFilter_94'],$cityCodes) && in_array($_GET['arrFilter_93'],$areaCodes)) || (!empty($_GET['arrFilter_92']) && !empty($_GET['arrFilter_93']) && in_array($_GET['arrFilter_94'],$cityCodes) && in_array($_GET['arrFilter_93'],$areaCodes) && in_array($_GET['arrFilter_92'],$metroCodes)) ){
                        $search[$item['PARAM2']][] = $item['ITEM_ID'];
                    }
                }
            }
            if ($item['PARAM2'] == '18' || $item['PARAM2'] == '19' || $item['PARAM2'] == '20' || $item['PARAM2'] == '21' || $item['PARAM2'] == '22') {
                $search[$item['PARAM2']][] = $item['ITEM_ID'];
            }
        }
    }
    foreach ($cityCodes as $key => $item){
        if (!empty($_GET['arrFilter_94'])){
            $cityFilter[$key] = $item[$_GET['arrFilter_94']];
        }
    }
    foreach ($areaCodes as $key => $item){
        if (!empty($_GET['arrFilter_93'])){
            $areaFilter[$key] = $item[$_GET['arrFilter_93']];
        }
    }
    foreach ($metroCodes as $key => $item){
        if (!empty($_GET['arrFilter_92'])){
            $metroFilter[$key] = $item[$_GET['arrFilter_92']];
        }
    }
    if ($_GET['q']!=NULL) {
        if (empty($_GET['arrFilter_93']) && empty($_GET['arrFilter_92'])) {
            $search[10] = $cityFilter[10];
            $search[9] = $cityFilter[9];
        }
        if (!empty($_GET['arrFilter_93']) && empty($_GET['arrFilter_92'])) {
            $search[10] = array_intersect($cityFilter[10], $areaFilter[10]);
            $search[9] = array_intersect($cityFilter[9], $areaFilter[9]);
        }
        if (!empty($_GET['arrFilter_93']) && !empty($_GET['arrFilter_92'])) {
            $search[10] = array_intersect($cityFilter[10], $areaFilter[10], $metroFilter[10]);
            $search[9] = array_intersect($cityFilter[9], $areaFilter[9], $metroFilter[9]);
        }
        if (empty($_GET['arrFilter_93']) && !empty($_GET['arrFilter_92'])) {
            $search[10] = array_intersect($cityFilter[10], $metroFilter[10]);
            $search[9] = array_intersect($cityFilter[9], $metroFilter[9]);
        }
    }
    if($search == NULL){
        global $arrFilter, $count;
        $keyArray = array_keys($search);
        $keySort = sort($keyArray);
        ?>
        <?if ($_GET['q']!=NULL) {?>
            <div class="search-result find-name"><?echo GetMessage("CT_BSP_FOUND")?>:
        <?}
        if(empty($_GET['q']) && !empty($_GET['page'])){header("Location:". $APPLICATION->GetCurPageParam('',array('page')));}?>
            <?foreach ($keyArray as $item) {
            $arrFilter['=ID'] = $search[$item];
            $APPLICATION->IncludeComponent("bitrix:news.list", "search_cnt", Array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "NEWS_COUNT" => 99999,
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => $item,
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "arrFilter",
                "FIELD_CODE" => array(),
                "PROPERTY_CODE" => array(),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "show_more",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "COMPONENT_TEMPLATE" => "search_clinic",
                "STRICT_SECTION_CHECK" => "N",
                "FILE_404" => ""
            ),
                false
            );?>
                <? global $count, $globalItem;
                if($item == 9){
                    $globalItem = $item;
                    $globalCount = $count;
                }
                if ($item == 9 && $count>0){?><a href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>"><strong><?=$count?></strong> клиник(а)/врачей(а);</a><?}
                if($item == 9 && $count==0 && $_GET['page'] !== 'doctors'){header("Location:". $APPLICATION->GetCurPageParam('',array('page')).'&page=doctors');}
                ?>
                <? global $count; if ($item == 10 && $count>0){?><a href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>&page=doctors"><strong><?=$count?></strong> врач(а);</a><?}?>

            <?}?>
        </div>
   <?}else{
    if (!empty($_GET['q']) && count($search) != 0){?>
    <div class="search-result"><?if($search[9]>0 || $search[10]>0 || $search[18]>0 || $search[19]>0 || $search[20]>0 || $search[21]>0 || $search[22]>0){echo GetMessage("CT_BSP_FOUND");echo":";}else{?>
            <?ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));?>
        <?}?>
        <? if ($search[9]){?><a <?if (!empty($_GET['page']) && count($search[9])>0){?>href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>"<?}?>><strong><?=count($search[9])?></strong> клиник(а)/врачей(а);</a><?}?>
        <? if ($search[10]){?><a <?if ($_GET['page'] != 'doctors' && count($search[10])>0){?>href="<?=$APPLICATION->GetCurPageParam('', array('page'));?>&page=doctors"<?}?>><strong><?=count($search[10])?></strong> врач(а);</a><?}?>
        <? if ($search[18] || $search[19]){?><a <?if ($_GET['page'] != 'services' && (count($search[18])>0 || $search[19]>0)){?>href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>&page=services"<?}?>><strong><?=count($search[18])+count($search[19])?></strong> услуг(а);</a><?}?>
        <? if ($search[21]){?><a <?if ($_GET['page'] != 'illness' && count($search[21])>0){?>href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>&page=illness"<?}?>><strong><?=count($search[21])?></strong> болезнь(ей);</a><?}?>
        <? if ($search[22]){?><a <?if ($_GET['page'] != 'symptoms' && count($search[22])>0){?>href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>&page=symptoms"<?}?>><strong><?=count($search[22])?></strong> симптом(ов);</a><?}?>
        <? if ($search[20]){?><a <?if ($_GET['page'] != 'articles' && count($search[20])>0){?>href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>&page=articles"<?}?>><strong><?=count($search[20])?></strong> статья(и);</a><?}?>
        <?if ($_GET['page']=='doctors' && count($search[10])==0 && count($search[9])!=0){header("Location:". $APPLICATION->GetCurPageParam('',array('page')));}
        elseif ($_GET['page']!=='doctors' && count($search[9])==0 && count($search[10])!=0){header("Location:". $APPLICATION->GetCurPageParam('',array('page')).'&page=doctors');}
        elseif ($_GET['page']!=='services' && count($search[9])==0 && count($search[10])==0 && (count($search[18])==0 && $search[19]>0)){header("Location:". $APPLICATION->GetCurPageParam('',array('page')).'&page=services');}
        elseif ($_GET['page']!=='illness' && count($search[9])==0 && count($search[10])==0 && (count($search[18])==0 && $search[19]==0) && count($search[21])>0){header("Location:". $APPLICATION->GetCurPageParam('',array('page')).'&page=illness');}
        elseif ($_GET['page']!=='symptoms' && count($search[9])==0 && count($search[10])==0 && (count($search[18])==0 && $search[19]==0) && count($search[21])==0 && count($search[22])>0){header("Location:". $APPLICATION->GetCurPageParam('',array('page')).'&page=symptoms');}
        elseif ($_GET['page']!=='articles' && count($search[9])==0 && count($search[10])==0 && (count($search[18])==0 && $search[19]==0) && count($search[21])==0 && count($search[22])==0 && count($search[20])>0){header("Location:". $APPLICATION->GetCurPageParam('',array('page')).'&page=articles');}
        ?>
    </div>
    <?}
    }?>
	<div class="search-result">
		<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
        <?
              if (empty($_GET['page']) || $_GET['page'] == NULL || $clinics!== false){
                  $template = "search_clinic";
                  $iblockId = 9;
              }
              if ($_GET['page'] == 'doctors' || $doctors!== false) {
                  $iblockId = 10;
                  $template = "search_doctor";
              }
                if ($_GET['page'] == 'services' || $_GET['page'] == 'articles' || $_GET['page'] == 'illness' || $_GET['page'] == 'symptoms' || $services!== false) {
                    $template = "search_services";
                }
                if ($_GET['page'] == 'articles'){
                    $iblockId = 20;
                }
                if($_GET['page'] == 'illness'){
                    $iblockId = 21;
                }
                if($_GET['page'] == 'symptoms') {
                    $iblockId = 22;
                }
                if ($_GET['page'] == 'services' || $services!== false){
                    $iblockId = 19;
                }
              if ($_GET['page'] == 'services' || $services!== false ){?>
                  <div class="container" id="blockService">
                      <h2>Услуги</h2>
                  </div>
              <?}elseif( $_GET['page'] == 'articles'){?>
                  <div class="container" id="blockArticles">
                      <h2>Статьи</h2>
                  </div>
              <?}elseif($_GET['page'] == 'illness'){?>
                  <div class="container" id="blockIllness">
                      <h2>Болезни</h2>
                  </div>
              <?}elseif($_GET['page'] == 'symptoms'){?>
                  <div class="container" id="blockSymptoms">
                      <h2>Симптомы</h2>
                  </div>
              <?}
        if (($_GET['q']== NULL && count($search)==0) || ($_GET['q'] != NULL && count($search[$iblockId])>0)){
           global $arrFilter;
            $arrFilter['=ID'] = $search[$iblockId];
            $APPLICATION->IncludeComponent("bitrix:news.list", "$template", Array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "Y",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => $iblockId,
                "NEWS_COUNT" => 5,
                "SORT_BY1" => "property_SECT_RATING",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "arrFilter",
                "FIELD_CODE" => array(
                    0 => "DETAIL_TEXT",
                    1 => "DETAIL_PICTURE",
                    2 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "DEPARTURE_HOUSE",
                    1 => "CHILDREN_DOCTOR",
                    2 => "DIAGNOSTICS",
                    3 => "RANK",
                    4 => "MAP",
                    5 => "ONLINE",
                    6 => "DMC",
                    7 => "UMC",
                    8 => "METRO",
                    9 => "SPECIALIZATION",
                    10 => "ADDRESS",
                    11 => "DOCTORS",
                    12 => "WORK_TIME",
                    13 => "CONTACTS",
                    14 => "AREA",
                    15 => "COST_PRICE",
                    16 => "REGION",
                    17 => "CITY",
                    18 => "DETAIL_PICTURE",
                    19 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "show_more",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "COMPONENT_TEMPLATE" => "search_clinic",
                "STRICT_SECTION_CHECK" => "N",
                "FILE_404" => ""
            ),
                false
            );?>
            <?if ($_GET['page'] == 'services' && count($search[18])>0){?>
                <div class="container">
                    <h2>Диагностика</h2>
                </div>
                <?$arrFilter['=ID'] = $search[18];
                $APPLICATION->IncludeComponent("bitrix:news.list", "$template", Array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "Y",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => 19,
                    "NEWS_COUNT" => 5,
                    "SORT_BY1" => "property_SECT_RATING",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilter",
                    "FIELD_CODE" => array(
                        0 => "DETAIL_TEXT",
                        1 => "DETAIL_PICTURE",
                        2 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "DEPARTURE_HOUSE",
                        1 => "CHILDREN_DOCTOR",
                        2 => "DIAGNOSTICS",
                        3 => "RANK",
                        4 => "MAP",
                        5 => "ONLINE",
                        6 => "DMC",
                        7 => "UMC",
                        8 => "METRO",
                        9 => "SPECIALIZATION",
                        10 => "ADDRESS",
                        11 => "DOCTORS",
                        12 => "WORK_TIME",
                        13 => "CONTACTS",
                        14 => "AREA",
                        15 => "COST_PRICE",
                        16 => "REGION",
                        17 => "CITY",
                        18 => "DETAIL_PICTURE",
                        19 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_LAST_MODIFIED" => "Y",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "Y",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "show_more",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "Y",
                    "SHOW_404" => "Y",
                    "MESSAGE_404" => "",
                    "PAGER_BASE_LINK" => "",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "COMPONENT_TEMPLATE" => "search_clinic",
                    "STRICT_SECTION_CHECK" => "N",
                    "FILE_404" => ""
                ),
                    false
                );
            }
        }?>
        <?
        if($_GET['q']!= NULL && count($search) == 0){?>
            <?ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));?>
        <?}?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('a[href^="#"]').on('click', function(event) {
                    event.preventDefault();
                    var sc = $(this).attr("href"),
                        dn = $(sc).offset().top;
                    $('html, body').animate({scrollTop: dn - 120}, 1000);
                });
            });
        </script>
        <div class="more_btn_block">
            <?if ((!empty($_GET['page']) && count($search[9])>0)){?>
                <a href="<?=$APPLICATION->GetCurPageParam('',array('page')); ?>" class="show_search">
                    Показать Клиники
                </a>
            <?}?>
            <?if ($_GET['page'] != 'doctors' && count($search[10])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('',array('page'))?>&page=doctors" class="show_search">
                    Показать Докторов
                </a>
            <?}?>
            <?if ($_GET['page'] != 'articles' && count($search[20])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('',array('page'))?>&page=articles" class="show_search" >
                    Показать Статьи
                </a>
            <?}
            if($_GET['page'] != 'illness'  && count($search[21])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('',array('page'))?>&page=illness" class="show_search">
                    Показать Болезни
                </a>
            <?}
            if($_GET['page'] != 'symptoms' && count($search[22])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('',array('page'))?>&page=symptoms" class="show_search" >
                    Показать Симптомы
                </a>
            <?}
            if ($_GET['page'] != 'services' && (count($search[18])>0 || count($search[19])>0)){?>
                <a href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>&page=services" class="show_search">
                    Показать Услуги
                </a>
            <?}?>
        </div>
	</div>
</div>