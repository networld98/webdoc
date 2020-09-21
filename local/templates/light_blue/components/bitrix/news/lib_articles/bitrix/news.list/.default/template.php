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
<h1 class="title-h2">Библиотека</h1>
<div class="row fixed-block-alp">
    <div class="container">
    <div class="col-lg-12">
        <div class="sort-block">
            <ul class="sort-block-list library-sort">
                <li class="sort-block-list-item" data-tabs='0'><a href="../illness/">Болезни</a></li>
                <li class="sort-block-list-item" data-tabs='1'><a href="../symptoms/">Симптомы</a></li>
                <!-- <li class="sort-block-list-item" data-tabs='2'>Врачи</li> -->
                <li class="sort-block-list-item active" data-tabs='3'><a href="javascript:void(0);">Статьи</a></li>
            </ul>
        </div>
    </div>
    </div>
</div>
<div class="library-content articles-box active" data-tabs='3'>

        <? 
        /*echo'<pre>';
        print_r($arResult);
        echo'</pre>';
        */

        console_log($arResult);
        $items = [];
        foreach($arResult['ITEMS'] as $item)
        {   
            $items[][] = array("NAME" => $item['NAME'],"URL"=> $item['DETAIL_PAGE_URL'],'PRE-TEXT'=> $item['PREVIEW_TEXT']);
        }
        console_log($items);
        ?>
    <div class="row variable-blocks">
        <?foreach ($items as $key=> $item){?>
        <div class="col-lg-4">
            <div class="variable-block-item">
            <?
            foreach ($item as $illness){
                ?>
                <h3 class="title-article"><a href="<?=$illness['URL']?>"><?=$illness['NAME']?></a></h3>
                <p class="article-preview"><?=$illness['PRE-TEXT']?></p>
                <? 
            }?>
            </div>
        </div>
        <?}?>
    </div>
</div>