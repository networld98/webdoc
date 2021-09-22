/*Куки*/
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
// возвращает cookie если есть или undefined
function setCookie(name, value, props) {

    props = props || {}

    var exp = props.expires

    if (typeof exp == "number" && exp) {

        var d = new Date()

        d.setTime(d.getTime() + exp*1000)

        exp = props.expires = d

    }

    if(exp && exp.toUTCString) { props.expires = exp.toUTCString() }

    value = encodeURIComponent(value)

    var updatedCookie = name + "=" + value

    for(var propName in props){

        updatedCookie += "; " + propName

        var propValue = props[propName]

        if(propValue !== true){ updatedCookie += "=" + propValue }
    }

    document.cookie = updatedCookie

}
function getCookie(name) {

    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ))
    return matches ? decodeURIComponent(matches[1]) : undefined
}

$(document).ready(function () {
    if ($(".side-menu .bxmaker__geoip__city__line-question.js-bxmaker__geoip__city__line-question").css("display") === "block"){
        $('.burger__btn').trigger('click');
        $('.js-bxmaker__geoip__city__line-question-btn-yes').click(function () {
            $('.burger__btn').trigger('click');
        });
        $('.js-bxmaker__geoip__city__line-question-btn-no').click(function () {
            $('.burger__btn').trigger('click');
        })
    }
    $('#title-search-input').keyup(function () {
        setTimeout( () =>  $('.title-search-result').hide(), 1000)
    });
    $('main a').not('.api_modal .api_modal_close').on('click', function() {
        href = $(this).attr('href');
        tel = href.indexOf('tel:')!==-1 ;
            if(tel===true){
                $.ajax({
                    type: "POST",
                    url: '/local/scripts/save_call.php',
                });
            }
        });

    function setEqualHeight(columns)
    {
        var tallestcolumn = 0;
        columns.each(
            function()
            {
                currentHeight = $(this).height();
                if(currentHeight > tallestcolumn)
                {
                    tallestcolumn = currentHeight;
                }
            }
        );
        columns.height(tallestcolumn);
    }
    let anc = window.location.hash.replace("#","");
    if (anc === "otzivy-yakor") {
        $('.clinic-card-full-desc__tabs li').removeClass('active');
        $('#openBlockOtzivy').addClass('active');
        $('.clinic-card-full-desc__content').removeClass('active');
        $('.otzivy-block').addClass('active');
    }
    let $page = $('html, body');
    $('#goToOtzivy').on('click',function () {
        $('.clinic-card-full-desc__tabs li').removeClass('active');
        $('#openBlockOtzivy').addClass('active');
        $('.clinic-card-full-desc__content').removeClass('active');
        $('.otzivy-block').addClass('active');
        $page.animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 400);
        return false;
    });
    $('.review-custom-btn_custom').click(function () {
        $('.clinic-card-full-desc__tabs li').removeClass('active');
        $('#openBlockOtzivy').addClass('active');
        $('.clinic-card-full-desc__content').removeClass('active');
        $('.otzivy-block').addClass('active');
        $('#comment-rating').trigger('click');
    });
    // $('a[href*="#"]').click(function() {
    //     $page.animate({
    //         scrollTop: $($.attr(this, 'href')).offset().top
    //     }, 400);
    //     return false;
    // });

    $('input[name=USER_LOGIN]').mask('+7 (999) 999-99-99', {placeholder: "+7 (___) ___ __ __"});
    $('.contact-phone').mask('+7 (999) 999-99-99', {placeholder: "+7 (___) ___ __ __"});
    $('.bx-register-phone').mask('+7 (999) 999-99-99', {placeholder: "+7 (___) ___ __ __"});
    $('.place-education-block_period').mask('9999-9999', {placeholder: "____-____"});
    $('.lc-doctor-time').mask('99:99', {placeholder: "__:__"});
    $('input[name=YEAR_FONDATION]').mask('9999', {placeholder: "___"});
    $('#selectClinic').on('change',function () {
        let email = $(this).find(':selected').data("email");
        let phone = $(this).find(':selected').data("phone");
        $('.option_phone').val(phone);
        $('.option_mail').val(email);
    });
    $(".select-doctor-day").click(function () {
        let day = $(this).data('day');
        let doctor = $(this).data('doctor');
        let date = $(this).data('date');
        let period = $(this).data('date');
        let block = $('#doctor-day-block-ajax');
        $.ajax({
            type: "POST",
            url: '/ajax/ajax_time.php',
            data:  { day: day, doctor: doctor, date: date, period: period },
            success: function (data) {
                // Вывод текста результата отправки
                $(block).html(data);
            }
        });
        return false;
    });
    let date = $('#selectDay').val();
    let time = $('#selectTime').val();
    $('#fullTime').val(date + '/' + time);
    $("#selectClinic").change(function () {
        let id = $(this).find('option:selected').data('id');
        let doc = $(this).find('option:selected').data('doctor');
        let phone = $(this).find('option:selected').data('phone');
        let email = $(this).find('option:selected').data('email');
        let block = $('#selectDay');
        let period = $(this).find('option:selected').data('period');
        $('#option_phone').val(phone);
        $('#option_mail').val(email);
        $.ajax({
            type: "POST",
            url: '/ajax/ajax_days_form.php',
            data: {id: id, doctor: doc, period: period},
            success: function (data) {
                // Вывод текста результата отправки
                $(block).html(data);
            }
        });
        return false;
    });
    $("#selectDay").change(function () {
        let id = $(this).find('option:selected').data('id');
        let day = $(this).find('option:selected').data('day');
        let doc = $(this).find('option:selected').data('doctor');
        let block = $('#selectTime');
        let date = $('#selectDay').val();
        let time = block.val();
        $.ajax({
            type: "POST",
            url: '/ajax/ajax_time_form.php',
            data: {id: id, doctor: doc, day: day, date: date},
            success: function (data) {
                // Вывод текста результата отправки
                $(block).html(data);
            }
        });
        $('#fullTime').val(date + '/' + time);
        return false;
    });
    $("#selectTime").change(function () {
        let date = $('#selectDay').val();
        let time = $('#selectTime').val();
        $('#fullTime').val(date + '/' + time);
    });
    $("#selectClinicHome").change(function () {
        let id = $(this).find('option:selected').data('id');
        let doc = $(this).find('option:selected').data('doctor');
        let phone = $(this).find('option:selected').data('phone');
        let email = $(this).find('option:selected').data('email');
        let period = $(this).find('option:selected').data('period');
        let block = $('#selectDayHome');
        $('#option_phoneHome').val(phone);
        $('#option_mailHome').val(email);
        $.ajax({
            type: "POST",
            url: '/ajax/ajax_days_form.php',
            data: {id: id, doctor: doc, period: period},
            success: function (data) {
                // Вывод текста результата отправки
                $(block).html(data);
            }
        });
        return false;
    });
    $("#selectDayHome").change(function () {
        let date = $('#selectDayHome').val();
        $('#fullTimeHome').val(date);
    });
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
    $('.popup-service-click').click(function(e) {
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();

        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();

        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .clinic-popup').css('display', 'block');
        console.log($(this).parents('.clinic-card'));
        // $($(this).parent().parent().parent().find('.map-wrapper .popup-box')).show();
        $($(this).parents('main').find('.call-popup .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');

        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
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
                            scrollTop: $(dest).offset().top - ($('#header').innerHeight() + $('.fixed-block').height()) // прокручиваем страницу к требуемому элементу
                        }, 1000 // скорость прокрутки
                    );
                } else {
                    console.log('no-fixed');
                    $('html').animate({
                            // scrollTop: $(dest).offset().top - ($('#header').innerHeight() + $('.fixed-block').outerHeight()) // прокручиваем страницу к требуемому элементу
                        scrollTop: $(dest).offset().top - ($('#header').innerHeight()) // прокручиваем страницу к требуемому элементу
                        }, 1000 // скорость прокрутки
                    );
                }
            } else if ($(window).width() <= 500) {
                if ($('.anchor-block').css('position') == 'fixed') {
                    console.log('fixed');
                    $('html').animate({
                            scrollTop: $(dest).offset().top - ($('#header').innerHeight() + $('.fixed-block').height()) // прокручиваем страницу к требуемому элементу
                        }, 1000 // скорость прокрутки
                    );
                } else {
                    console.log('no-fixed');
                    $('html').animate({
                            // scrollTop: $(dest).offset().top - ($('#header').innerHeight() + $('.fixed-block').outerHeight()) // прокручиваем страницу к требуемому элементу
                        scrollTop: $(dest).offset().top - ($('#header').innerHeight()) // прокручиваем страницу к требуемому элементу
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
