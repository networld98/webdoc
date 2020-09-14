<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
CModule::IncludeModule("iblock")
?>
<? 
/*echo'<pre>';
print_r($arResult);
echo'</pre>';
*/

?>
<?
function console_log( $data ){
   echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }
?>
<? 
$items = [];
foreach($arResult['ITEMS'] as $item)
{
    $items[mb_strtoupper(substr($item['NAME'], 0,1))][] = array("NAME" => $item['NAME'],"URL"=> $item['DETAIL_PAGE_URL']);
}
?>
    <h1 class="title-h2">Библиотека</h1>
    <div class="row fixed-block-alp">
        <div class="container">
        <div class="col-lg-12">
            <div class="sort-block">
                <ul class="sort-block-list library-sort">
                    <li class="sort-block-list-item active" data-tabs='0'><a href="/library/">Болезни</a></li>
                    <li class="sort-block-list-item" data-tabs='1'><a href="symptoms/">Симптомы</a></li>
                    <!-- <li class="sort-block-list-item" data-tabs='2'>Врачи</li> -->
                    <li class="sort-block-list-item" data-tabs='3'><a href="articles/">Статьи</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="alphabet-block">
                <ul class="alphabet-block-list">
                    <?foreach ($items as $key=> $item){?>
                        <li><a href="javascript:void(0);" class="popup-alp-click"><?=$key?></a></li>
                    <?}?>
                </ul>
            </div>
        </div>
        </div>
    </div>
<div class="library-content active illness-box" data-tabs='0'>
    <div class="row">
        <?foreach ($items as $key=> $item){?>
        <div class="col-lg-3 col-md-4 col-sm-6 alp-item">
            <div class="col__heading"><?=$key?></div>
            <ul class="col__list">
                
                <?$i=0;
                foreach ($item as $illness){
                    $i++;
                    if( $i < 8){?>
                    <li class="col__item"><a href="<?=$illness['URL']?>"><?=$illness['NAME']?></a></li>
                    
                    <?}
                }?>
            </ul>
            <a href="javascript:void(0);" class="col__show-more popup-alp-click">показать все</a>
            <div class="popup-box popup-library">
                <div class="close"></div>
                <div class="alp-detail container">
                    <div class="col-lg-12">
                        <div class="col__heading"><?=$key?></div>
                        <div class="row col-lg-12">
                            <ul class="col__list col-lg-3 col-md-4 col-sm-6">
                                <?$i=0;
                                foreach ($item as $illness){
                                    $i++;
                                    ?><li class="col__item"><a href="<?=$illness['URL']?>"><?=$illness['NAME']?></a></li>
                                    <?if( ($i % 14) == 0){?>
                                        </ul>
                                        <ul class="col__list col-lg-3 col-md-4 col-sm-6">
                                    <?}
                                }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?}?>
    </div>
</div>
