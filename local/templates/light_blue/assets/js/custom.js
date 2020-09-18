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
        let block = $('#doctor-day-block-ajax');
        $.ajax({
            type: "POST",
            url: '/ajax/ajax_time.php',
            data:  { day: day, doctor: doctor },
            success: function (data) {
                // Вывод текста результата отправки
                $(block).html(data);
            }
        });
        return false;
    });
});