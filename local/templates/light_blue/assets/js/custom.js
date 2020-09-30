$(document).ready(function () {
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
});
$(window).scroll(function()
{
    var bottom = $(window).height() - 603;
    var top = $(this).scrollTop();
    bottom = top - bottom;
});