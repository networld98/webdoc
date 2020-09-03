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
?>
<section class="container services-detail">
    <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
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
    });
    $(window).scroll(function()
    {
        var bottom = $(window).height() - 603;
        var top = $(this).scrollTop();
        bottom = top - bottom;
        if(bottom == $(window).height()) {
            alert(bottom);
        }
    });
</script>