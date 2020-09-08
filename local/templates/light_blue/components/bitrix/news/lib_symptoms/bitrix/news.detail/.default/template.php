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
            <!-- <div class="illness-detail-block">
                <h3 class="title-h3 to-choice">К какому врачу обратиться при сколиозе позвоночника?</h3>
                <p>С помощью нашего сервиса вы можете найти хорошего ортопеда или ортопедическую клинику, где можно пройти полное обследование по поводу искривления позвоночника. Если вам требуется операция, ознакомьтесь с отзывами и выберете хорошую ортопедическую больницу.</p>
                <div class="doctors-slider slick-slider4">
                    <div class="doctors-slider-item">
                        <div class="doctors-list-item__img">
                            <a href="/doctors/kalinina-irina-andreevna/"><img src="/local/templates/light_blue/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                                <div class="doctors-list-item__img-info">
                                    <div class="doctors-list-item__img-info-ratings">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                    </div>
                                <p class="doctors-list-item__img-info-commend">0% пациентов рекомендуют врача на основе <a href="">0 отзывов</a></p>
                            </div>
                        </div>
                        <div class="doctors-list-item__description">
                            <p class="doctors-list-item__description-position">Реабилитолог</p>
                            <a href="/doctors/kalinina-irina-andreevna/">
                                <p class="doctors-list-item__description-title">Калинина Ирина Андреевна</p>
                            </a>
                            <p class="doctors-list-item__description-exp">Стаж 21 год</p>
                            <p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
                            <p class="doctors-list-item__description-price">2 600 Р<span>Цена приема в клинике</span></p>
                            <a href="tel:8 (812) 000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                            <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                            <div class="doctors-list-item-favorites"></div>
                        </div>
                    </div>
                    <div class="doctors-slider-item">
                        <div class="doctors-list-item__img">
                            <a href="/doctors/kalinina-irina-andreevna/"><img src="/local/templates/light_blue/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                                <div class="doctors-list-item__img-info">
                                    <div class="doctors-list-item__img-info-ratings">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                    </div>
                                <p class="doctors-list-item__img-info-commend">0% пациентов рекомендуют врача на основе <a href="">0 отзывов</a></p>
                            </div>
                        </div>
                        <div class="doctors-list-item__description">
                            <p class="doctors-list-item__description-position">Реабилитолог</p>
                            <a href="/doctors/kalinina-irina-andreevna/">
                                <p class="doctors-list-item__description-title">Калинина Ирина Андреевна</p>
                            </a>
                            <p class="doctors-list-item__description-exp">Стаж 21 год</p>
                            <p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
                            <p class="doctors-list-item__description-price">2 600 Р<span>Цена приема в клинике</span></p>
                            <a href="tel:8 (812) 000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                            <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                            <div class="doctors-list-item-favorites"></div>
                        </div>
                    </div>
                    <div class="doctors-slider-item">
                        <div class="doctors-list-item__img">
                            <a href="/doctors/kalinina-irina-andreevna/"><img src="/local/templates/light_blue/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                                <div class="doctors-list-item__img-info">
                                    <div class="doctors-list-item__img-info-ratings">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                    </div>
                                <p class="doctors-list-item__img-info-commend">0% пациентов рекомендуют врача на основе <a href="">0 отзывов</a></p>
                            </div>
                        </div>
                        <div class="doctors-list-item__description">
                            <p class="doctors-list-item__description-position">Реабилитолог</p>
                            <a href="/doctors/kalinina-irina-andreevna/">
                                <p class="doctors-list-item__description-title">Калинина Ирина Андреевна</p>
                            </a>
                            <p class="doctors-list-item__description-exp">Стаж 21 год</p>
                            <p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
                            <p class="doctors-list-item__description-price">2 600 Р<span>Цена приема в клинике</span></p>
                            <a href="tel:8 (812) 000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                            <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                            <div class="doctors-list-item-favorites"></div>
                        </div>
                    </div>
                    <div class="doctors-slider-item">
                        <div class="doctors-list-item__img">
                            <a href="/doctors/kalinina-irina-andreevna/"><img src="/local/templates/light_blue/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo"></a>
                                <div class="doctors-list-item__img-info">
                                    <div class="doctors-list-item__img-info-ratings">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                        <img src="/local/templates/light_blue/assets/images/ant-design_star-none-filled.png" alt="star">
                                    </div>
                                <p class="doctors-list-item__img-info-commend">0% пациентов рекомендуют врача на основе <a href="">0 отзывов</a></p>
                            </div>
                        </div>
                        <div class="doctors-list-item__description">
                            <p class="doctors-list-item__description-position">Реабилитолог</p>
                            <a href="/doctors/kalinina-irina-andreevna/">
                                <p class="doctors-list-item__description-title">Калинина Ирина Андреевна</p>
                            </a>
                            <p class="doctors-list-item__description-exp">Стаж 21 год</p>
                            <p class="doctors-list-item__description-degree">Кандидат медицинских наук</p>
                            <p class="doctors-list-item__description-price">2 600 Р<span>Цена приема в клинике</span></p>
                            <a href="tel:8 (812) 000-00-00" class="doctors-list-item__description-phone"><span>Телефон для записи:</span>8 (812) 000-00-00</a>
                            <span class="doctors-list-item__description-counts">Всего записалось 582 человека</span>
                            <div class="doctors-list-item-favorites"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="illness-detail-block">
            <h4 class="title-h4">Возможно, Вам также будет интересно прочитать</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <a href="" class="blog-item">
                        <img class="blog-item__img" src="/local/templates/light_blue/assets/images/blog-pic1.png" alt="img">
                            <span class="blog-item__desc">Физические упражнения: как дозировать нагрузку</span>
                        </a>
                    </div>
                    <div class="col-lg-4">
                    <a href="" class="blog-item">
                    <img class="blog-item__img" src="/local/templates/light_blue/assets/images/blog-pic1.png" alt="img">
                            <span class="blog-item__desc">Физические упражнения: как дозировать нагрузку</span>
                        </a>
                    </div>
                    <div class="col-lg-4">
                    <a href="" class="blog-item">
                            <img class="blog-item__img" src="/local/templates/light_blue/assets/images/blog-pic1.png" alt="img">
                            <span class="blog-item__desc">Физические упражнения: как дозировать нагрузку</span>
                        </a>
                    </div>
                </div>
            </div> -->
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
            if($(window).width() <= 992) {
                if($('.anchor-block').css('position') == 'fixed') {
                console.log('fixed');
                $('html').animate({ 
                    scrollTop: $(dest).offset().top - $('#header').innerHeight() - $('.anchor-block.fixed-block').innerHeight() // прокручиваем страницу к требуемому элементу
                }, 1000 // скорость прокрутки
                );
            } else {
                console.log('no-fixed');
                $('html').animate({ 
                    scrollTop: $(dest).offset().top - $('#header').innerHeight() - $('.anchor-block.fixed-block').innerHeight()// прокручиваем страницу к требуемому элементу
                }, 1000 // скорость прокрутки
                );
            }
            } else {
                if($('.anchor-block').css('position') == 'fixed') {
                console.log('fixed');
                $('html').animate({ 
                    scrollTop: $(dest).offset().top - $('#header').innerHeight() // прокручиваем страницу к требуемому элементу
                }, 1000 // скорость прокрутки
                );
            } else {
                console.log('no-fixed');
                $('html').animate({ 
                    scrollTop: $(dest).offset().top - $('#header').innerHeight() // прокручиваем страницу к требуемому элементу
                }, 1000 // скорость прокрутки
                );
            }
            }
            
        }
        return false;
        });
    });

</script>