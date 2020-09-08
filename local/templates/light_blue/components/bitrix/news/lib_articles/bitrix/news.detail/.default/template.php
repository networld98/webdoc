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
global $doctorName;
$doctorName = $arResult['NAME'];
?>
<section class="container">
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    ),
        false
    );?>
</section>
<section class="container services-detail">
    <h1 class="title-h2"><?=$APPLICATION->ShowTitle()?></h1>
    <div class="row">
        <div class="col-lg-3">
            <div class="anchor-block fixed-block">
                <ul class="anchor-block-list">
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <?echo $arResult["DETAIL_TEXT"];?>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $(".services-detail h2").addClass('nav-bar-service');
        $(".services-detail h3").addClass('nav-bar-service');
        $(".services-detail h4").addClass('nav-bar-service');

        $(".nav-bar-service").each(function (index) {
            $(this).attr("id", ('heading_' + (index + 1)));
        });

        var ToC = '<ul class="anchor-block-list">';
        var newLine, el, title, link;

        $(".nav-bar-service").each(function() {
            el = $(this);
            title = el.text();
            link = "#" + el.attr("id");

            newLine =
                "<li>" +
                "<a href='" + link + "' class='flowing-scroll'>" +
                title +
                "</a>" +
                "</li>";
            ToC += newLine;
        });
        ToC += '</ul>';

        $(".anchor-block").prepend(ToC);

        // Cache selectors
        var lastId,
            nav_link = $(".anchor-block"),
            // All list items
            nav_items = nav_link.find("a"),
            // Anchors corresponding to menu items
            scroll_items = nav_items.map(function(){
                var item = $($(this).attr("href"));
                if (item.length) { return item; }
            });

        $('.flowing-scroll').on( 'click', function(){
        event.preventDefault();
        console.log('click');
        var el = $(this);
        var dest = el.attr('href'); // получаем направление
        // var dest = el.data('href'); // получаем направление
        if(dest !== undefined && dest !== '') { // проверяем существование
            if($('.anchor-block').css('position') == 'fixed') {
                console.log('fixed');
                $('html').animate({ 
                    scrollTop: $(dest).offset().top - 140 // прокручиваем страницу к требуемому элементу
                }, 1000 // скорость прокрутки
                );
            } else {
                console.log('no-fixed');
                $('html').animate({ 
                    scrollTop: $(dest).offset().top - 200 // прокручиваем страницу к требуемому элементу
                }, 1000 // скорость прокрутки
                );
            }
            
        }
        return false;
        });
    });
</script>