$(document).ready(()=>{
    //sticky header
    var h_hght = 0; // высота шапки
    var h_mrg = 0;    // отступ когда шапка уже не видна

    $(function () {
        var elem = $('#header');
        var top = $(this).scrollTop();
        var menu = $('.container.mobile');

        $(window).scroll(function () {
            top = $(this).scrollTop();

            if (top < 1) {
                elem.css({'top': 0, position: 'relative',backgroundColor: 'transparent'});
                menu.css({top: h_mrg, display: 'block'});
            } else {
                elem.css({top: h_mrg, position: 'fixed', backgroundColor: '#fff'});
                menu.css({top: h_mrg, display: 'none'});
            }
        });

    });

    // $(window).resize(function() {
        if ($(window).width() <= 450) {
            $('.statistics__header span').html("Бесплатный сервис</br> подбора медицинских услуг");
        }
    // });

    $( ".doctor-card-favorites" ).on( "click", function() {
        $( this ).toggleClass("active");
      });
    $( ".doctors-list-item-favorites" ).on( "click", function() {
        $( this ).toggleClass("active");
    });

    $('.sort-block-list-item').on( "click", function() {
            $('.sort-block-list-item').removeClass('active');
            $(this).toggleClass('active');
    });
    $('.services-list .sort-block-list-item').on( "click", function() {
        $('.services-list .sort-block-list-item').removeClass('active');
        $(this).toggleClass('active');
    });
    $('.personal-cabinet-menu__list-item').on( "click", function() {
        $('.personal-cabinet-menu__list-item').removeClass('active');
        $('.personal-cabinet-menu__icon').removeClass('active');
        console.dir($(this));
        $(this).find('.personal-cabinet-menu__icon').toggleClass('active');
        $(this).toggleClass('active');
    });

    $('.choosing-time_block-list-item').on( "click", function() {
        if(!$(this).hasClass( 'not-worked' )) {
            $('.choosing-time_block-list-item').removeClass('active');
            $(this).toggleClass('active');
        }
    });
    $('.doctors-list-item__days-list-item').on( "click", function() {
        if(!$(this).hasClass( 'not-worked' )) {
            $('.doctors-list-item__days-list-item').removeClass('active');
            $(this).toggleClass('active');
        }
    });
    $('.clinic-card-full-desc__tabs > ul > li').on( "click", function() {
        $('.clinic-card-full-desc__tabs > ul > li').removeClass('active');
        $(this).toggleClass('active');
    });


    $('.clinic-card-full-desc__tabs ul li').hover(function () {
        $('.clinic-card-full-desc__tabs ul li').removeClass('active');
        $(this).toggleClass('active');
        $(this).on("click" , function () {
            $('.clinic-card-full-desc__content').removeClass('active');
            var data = $(this).data('tabs');
            $(`.clinic-card-full-desc__content[data-tabs="${data}"]`).toggleClass('active');
        });
    });

    $(".go-to").on('click', function(e){
		$('html,body').stop().animate({ scrollTop: $(this.hash).offset().top-150 }, 1500);
		e.preventDefault();
	  });

    $('.slick-slider1').slick({
        arrows: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                  slidesToShow: 3,
                  variableWidth: true,
                  infinite:false,
                }
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 1,
                    variableWidth: true,
                    infinite:false,
                }
              },
        ]
      });
    $('.slick-slider2').slick({
        arrows: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 3,
                variableWidth: true,
                infinite:false,
              }
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 1,
                    variableWidth: true,
                    infinite:false,
                }
              },
        ]
      });
    $('.slick-slider3').slick({
        arrows: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 650,
                settings: {
                    arrows: false,
                    slidesToShow: 4,
                    variableWidth: true,
                    infinite:false,
                }
            },
        ]
    });

    $('.search-doctors').on( "click", function() {
        $(this).hide();
        $('.clinic-card .main-filter').css({'padding-top': '32px', 'padding-bottom': '29px'});
        $(this).prev().slideDown();
        console.log($(this));
    });
      /* messange-to-doctor-popup*/

      var mess = {
        popup: null, //наш popup
        showPopup: function (url) {
            this.popup = BX.PopupWindowManager.create("modal_auth2", '', {
                closeIcon: true,
                autoHide: true,
                offsetLeft: 0,
                offsetTop: 0,
                draggable: {restrict: true},
                closeByEsc: true,
                content: BX('mess-popup'),
                overlay: {backgroundColor: 'black', opacity: '10'}
            });

            this.popup.show();
        }
    };

    $('#header-mess').click(()=>{
        mess.showPopup();
    });

    /* reception-to-doctor-popup*/

    var reception = {
        popup: null, //наш popup
        showPopup: function (url) {
            this.popup = BX.PopupWindowManager.create("modal_auth3", '', {
                closeIcon: true,
                autoHide: true,
                offsetLeft: 0,
                offsetTop: 0,
                draggable: {restrict: true},
                closeByEsc: true,
                content: BX('reception-popup'),
                overlay: {backgroundColor: 'black', opacity: '10'}
            });

            this.popup.show();
        }
    };
    $('#header-reception').click(()=>{
        reception.showPopup();
    });

    /* call-to-doctor-popup*/
    var call = {
        popup: null, //наш popup
        showPopup: function (url) {
            this.popup = BX.PopupWindowManager.create("modal_auth4", '', {
                closeIcon: true,
                autoHide: true,
                offsetLeft: 0,
                offsetTop: 0,
                draggable: {restrict: true},
                closeByEsc: true,
                content: BX('call-popup'),
                overlay: {backgroundColor: 'black', opacity: '10'}
            });

            this.popup.show();
        }
    };
    $('#header-call').click(()=>{
        call.showPopup();
    });

    /* map-to-doctor-popup*/
    var map = {
        popup: null, //наш popup
        showPopup: function (data) {
            this.popup = BX.PopupWindowManager.create("modal_auth5", '', {
                closeIcon: true,
                autoHide: true,
                offsetLeft: 0,
                offsetTop: 0,
                draggable: {restrict: true},
                closeByEsc: true,
                // content: BX('map-popup'),
                // content: $('.map-wrapper .map-popup'),
                content: data[0],
                overlay: {backgroundColor: 'black', opacity: '10'}
            });
            console.log(data);
            console.log(BX('map-popup'));
            this.popup.show();
        }
    };
    
    // $( ".doctor-card-popUp-group__route" ).click( function() {
    //     map.showPopup($(this).parent().parent().parent().find('.map-wrapper .map-popup'));
    // });


    // $( "#header-map" ).on( "click", function() {
    //     map.showPopup($(this).parent().parent().parent().find('.map-wrapper .map-popup'));
    //   });
    // $('#header-map').click(()=>{
    //     console.log($(this));
    //     map.showPopup();
    // });


    $('body').append('<div id="blackout"></div>');
    var boxWidth = 1200;
    function centerBox() {
     
        /* определяем нужные данные */
        var winWidth = $(window).width();
        var winHeight = $(document).height();
        var scrollPos = $(window).scrollTop();
         
        /* Вычисляем позицию */
         
        var disWidth = (winWidth - boxWidth) / 2
        var disHeight = scrollPos + 150;
         
        /* Добавляем стили к блокам */
        $('.popup-box').css({'left' : '50%', 'top' : '50%', 'transform': 'translate(-50%, -50%)'});
        $('#blackout').css({'width' : winWidth+'px', 'height' : winHeight+'px'});
         
        return false;       
    }
    $(window).resize(centerBox);
    $(window).scroll(centerBox);
    centerBox();
    $('.popup-link').click(function(e) {
     
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();
         
        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();
         
        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .map-popup').css('display', 'block');
        console.log($(this).parents('.clinic-card'));
        // $($(this).parent().parent().parent().find('.map-wrapper .popup-box')).show();
        $($(this).parents('main').find('.map-wrapper .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');
         
        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });
    $('.popup-link-marker').click(function(e) {
     
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();
         
        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();
         
        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .map-popup-marker').css('display', 'block');
        $($(this).parent().parent().parent().find('.map-wrapper .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');
         
        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });
     
    $('[class*=popup-box]').click(function(e) { 
        /* Предотвращаем работу ссылки, если она являеться нашим popup окном */
        e.stopPropagation(); 
    });
    $('html').click(function() { 
        var scrollPos = $(window).scrollTop();
        /* Скрыть окно, когда кликаем вне его области */
        $('.popup-box').hide(); 
        $('.popup-box .map-popup').css('display', 'none');
        $('.popup-box .map-popup-marker').css('display', 'none');
        $('#blackout').hide(); 
        $("html,body").css("overflow","auto");
        $('html').scrollTop(scrollPos);
    });
    $('.close').click(function() { 
        var scrollPos = $(window).scrollTop();
        /* Скрываем тень и окно, когда пользователь кликнул по X */
        $('.popup-box').hide();
        $('.popup-box .map-popup').css('display', 'none');
        $('.popup-box .map-popup-marker').css('display', 'none');
        $('#blackout').hide(); 
        $("html,body").css("overflow","auto");
        $('html').scrollTop(scrollPos);
    });


    $('.personal-cabinet-content__doctors-page-box-item__desc__redactor span').click(function() {
        if($(this).text() === 'Редактировать данные') {
            $(this).text('Закрыть');
            $(this).parents('.personal-cabinet-content__doctors-page-box-item__desc-left')
            .children('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop')
            .slideDown();
        } else {
            $(this).text('Редактировать данные');
            $(this).parents('.personal-cabinet-content__doctors-page-box-item__desc-left')
            .children('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop')
            .slideUp();
        }
    });

//     var slice = [].slice;

// (function($, window) {
//   var Starrr;
//   window.Starrr = Starrr = (function() {
//     Starrr.prototype.defaults = {
//       rating: void 0,
//       max: 5,
//       readOnly: false,
//       emptyClass: 'fa fa-star-o',
//       fullClass: 'fa fa-star',
//       change: function(e, value) {}
//     };

//     function Starrr($el, options) {
//       this.options = $.extend({}, this.defaults, options);
//       this.$el = $el;
//       this.createStars();
//       this.syncRating();
//       if (this.options.readOnly) {
//         return;
//       }
//       this.$el.on('mouseover.starrr', 'a', (function(_this) {
//         return function(e) {
//           return _this.syncRating(_this.getStars().index(e.currentTarget) + 1);
//         };
//       })(this));
//       this.$el.on('mouseout.starrr', (function(_this) {
//         return function() {
//           return _this.syncRating();
//         };
//       })(this));
//       this.$el.on('click.starrr', 'a', (function(_this) {
//         return function(e) {
//           e.preventDefault();
//           return _this.setRating(_this.getStars().index(e.currentTarget) + 1);
//         };
//       })(this));
//       this.$el.on('starrr:change', this.options.change);
//     }

//     Starrr.prototype.getStars = function() {
//       return this.$el.find('a');
//     };

//     Starrr.prototype.createStars = function() {
//       var j, ref, results;
//       results = [];
//       for (j = 1, ref = this.options.max; 1 <= ref ? j <= ref : j >= ref; 1 <= ref ? j++ : j--) {
//         results.push(this.$el.append("<a href='#' />"));
//       }
//       return results;
//     };

//     Starrr.prototype.setRating = function(rating) {
//       if (this.options.rating === rating) {
//         rating = void 0;
//       }
//       this.options.rating = rating;
//       this.syncRating();
//       return this.$el.trigger('starrr:change', rating);
//     };

//     Starrr.prototype.getRating = function() {
//       return this.options.rating;
//     };

//     Starrr.prototype.syncRating = function(rating) {
//       var $stars, i, j, ref, results;
//       rating || (rating = this.options.rating);
//       $stars = this.getStars();
//       results = [];
//       for (i = j = 1, ref = this.options.max; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
//         results.push($stars.eq(i - 1).removeClass(rating >= i ? this.options.emptyClass : this.options.fullClass).addClass(rating >= i ? this.options.fullClass : this.options.emptyClass));
//       }
//       return results;
//     };

//     return Starrr;

//   })();
//   return $.fn.extend({
//     starrr: function() {
//       var args, option;
//       option = arguments[0], args = 2 <= arguments.length ? slice.call(arguments, 1) : [];
//       return this.each(function() {
//         var data;
//         data = $(this).data('starrr');
//         if (!data) {
//           $(this).data('starrr', (data = new Starrr($(this), option)));
//         }
//         if (typeof option === 'string') {
//           return data[option].apply(data, args);
//         }
//       });
//     }
//   });
// })(window.jQuery, window);

// $('.starrr').starrr({
//     rating: 5,
//     change: function(e, value) {
//         console.log(e);
//         console.dir($(this).context.firstElementChild);
//         switch (value) {
//             case 1:
//                 alert('new rating is ' + "Очень плохо")
//                 value = "Очень плохо";
//                 break;
//             case 2:
//                 alert('new rating is ' + "Плохо")
//                 value = "Плохо";
//                 break;
//             case 3:
//                 alert('new rating is ' + "Нормально")
//                 value = "Нормально";
//                 break;
//             case 4:
//                 alert('new rating is ' + "Хорошо")
//                 value = "Хорошо";
//                 break;
//             case 5:
//                 alert('new rating is ' + "Отлично")
//                 value = "Отлично";
//                 break;
//             default:
//                 break;
//         }
//         $(this).context.firstElementChild.innerText = value;
//       }
//   })

});
