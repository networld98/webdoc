<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->createFrame()->begin("Загрузка навигации");
?>
<?if($arResult["NavPageCount"] > 1):?>
    <?if ($arResult["NavPageNomer"]+1 <= $arResult["nEndPage"]):?>
        <?
        $plus = $arResult["NavPageNomer"]+1;
        $url = $arResult["sUrlPathParams"] . "PAGEN_".$arResult["NavNum"]."=".$plus;
        ?>
        <div class="load_more load_page" data-url="<?=$url?>">
            Показать ещё
        </div>
    <?endif?>
<?endif?>
<script>
    $('body').on('click', 'div.load_page', function() {
        var targetContainer = $('.list-item'),          //  Контейнер, в котором хранятся элементы
            url =  $('.load_more').attr('data-url');    //  URL, из которого будем брать элементы

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){
                    console.log('qweqwe')

                    //  Удаляем старую навигацию
                    $('.load_page').remove();
                    var elements = $(data).find('.card-item'),  //  Ищем элементы
                        pagination = $(data).find('.load_page');//  Ищем навигацию
                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination); //  добавляем навигацию следом
                }
            })
        }
    });
</script>
