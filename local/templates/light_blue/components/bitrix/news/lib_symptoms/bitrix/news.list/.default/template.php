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
                <li class="sort-block-list-item" data-tabs='0'><a href="/library/">Болезни</a></li>
                <li class="sort-block-list-item active" data-tabs='1'><a href="javascript:void(0);">Симптомы</a></li>
                <!-- <li class="sort-block-list-item" data-tabs='2'>Врачи</li> -->
                <li class="sort-block-list-item" data-tabs='3'><a href="/library/articles/">Статьи</a></li>
            </ul>
        </div>
    </div>
    </div>

</div>  
<div class="library-content symptoms-box active" data-tabs='1'>
        <? 
        /*echo'<pre>';
        print_r($arResult);
        echo'</pre>';
        */
        console_log($arResult);
        $items = [];
        foreach($arResult['ITEMS'] as $item)
        {   
            $itemElement = CIBlockSection::GetByID($item['IBLOCK_SECTION_ID'])->Fetch();
            $items[$itemElement['NAME']][] = array("NAME" => $item['NAME'],"URL"=> $item['DETAIL_PAGE_URL']);
        }
        ?>
    <div class="row general-blocks">
        <div class="col-lg-6">
            <div class="general-block-item">
                <h3 class="title-h3">Общие симптомы</h3>
                <ul class="general-block-item-list">
                    <?foreach ($items as $key=> $item){?>
                        <?foreach ($item as $illness){?>
                        <li><a href="<?=$illness['URL']?>"><?=$illness['NAME']?></a></li>
                        <?}?>
                    <?}?>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="general-block-item">
                <h3 class="title-h3">Симптомы по частям тела</h3>
                <ul class="general-block-item-list">
                    <?foreach ($items as $key=> $item){?>
                        <li><a href="#"><?=$key?></a></li>
                    <?}?>
                </ul>
            </div>
        </div>
    </div>
    <div class="row variable-blocks">
        <?foreach ($items as $key=> $item){?>
        <div class="col-lg-4">
            <div class="variable-block-item">
            <h3 class="title-h3"><?=$key?></h3>
            <ul class="variable-block-item-list">
                
                <?$i=0;
                foreach ($item as $illness){
                    $i++;
                    if( $i < 8){?>
                    <li class="col__item"><a href="<?=$illness['URL']?>"><?=$illness['NAME']?></a></li>
                    
                    <?}
                    console_log($illness['URL']);
                }?>
            </ul>
            </div>
        </div>
        <?}?>
    </div>
</div>