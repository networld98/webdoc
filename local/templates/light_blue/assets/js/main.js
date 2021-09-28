$(document).ready(()=>{
    //sticky header
    var h_hght = 0; // высота шапки
    var h_mrg = 0;    // отступ когда шапка уже не видна
    var elem = $('#header');
    elem.css({top: h_mrg, position: 'fixed'});
    $(function () {
        var top = $(this).scrollTop();
        var menu = $('.container.mobile');
        var header = $('#header');
        $(window).scroll(function () {
            top = $(this).scrollTop();
            if($(window).width() <= 1279) {
                if (top < 1) {
                    // elem.css({'top': 0, position: 'relative',backgroundColor: 'transparent'});
                    menu.css({top: h_mrg});
                    menu.slideDown('100');
                } else {

                    menu.css({top: h_mrg});
                    menu.hide();
                }
            }
        });

    });

    $(function () {
        if(document.querySelector('.fixed-block') != null) {
            var elem = $('.fixed-block');
            var top = $(this).scrollTop();
            var footer= $('#footer-wrapper').offset();
            var topfixed = '134px';
            var elemFixedPos = elem.offset().top;
            var widthDevice = 20;
            $(window).scroll(function () {
                if($(window).width() <= 992 && $(window).width() > 500) {
                    widthDevice = -20;
                }
                if($(window).width() <= 500) {
                    widthDevice = -20;
                }
                if($(window).width() <= 1279 && $(window).width() > 1024) {
                    topfixed = 156 + 'px';
                } else if($(window).width() <= 1024 && $(window).width() > 992) {
                    topfixed = 156 + 'px';
                } else if($(window).width() <= 992 && $(window).width() > 768) {
                    topfixed = 108 + 'px';
                }
                 else if ($(window).width() <= 768 && $(window).width() > 500) {
                    topfixed = 114 + 'px';
                } else if($(window).width() <= 500) {
                    topfixed = 87 + 'px';
                }
                footer= $('#footer-wrapper').offset();
                top = $(this).scrollTop();
                if($(window).width() <= 992) {
                    if ((top + $('#header').innerHeight()) + widthDevice < elemFixedPos) {
                        // console.log(top + $('#header').innerHeight() + " pos --- offset " + `${elem.offset().top}`);
                        // console.log((top + $('#header').innerHeight()));
                        // console.log("relatived");
                        elem.css({'top': 'initial', position: 'relative',backgroundColor: 'transparent',bottom:'initial'});
                        // $('.container h1').fadeIn();
                        // $('.bx-breadcrumb').show();
                        $('.fixed-block-ghost').css({height: 0 +'px', display: 'none'});
                    } else {
                        if($(window).width() <= 500) {
                            if(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + widthDevice/3 < footer.top) {
                                // console.log(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + " pos --- offset " + `${footer.top}`);
                                // console.log((top + $('#header').innerHeight() + $('.fixed-block').innerHeight()));
                                // console.log("FIXED");
                                $('.fixed-block-ghost').css({height: $('.fixed-block').innerHeight()+'px', display: 'block'});
                                elem.css({top: topfixed, position: 'fixed', backgroundColor: '#fff', bottom: 'initial', width: `85vw`});
                            } else {
                                $('.fixed-block-ghost').css({height: $('.fixed-block').innerHeight()+'px', display: 'block'});
                                // console.log('ABSOLUTED');
                                elem.css({top: 'initial', position: 'absolute', backgroundColor: '#fff', bottom: '20px'});
                            }
                        } else {
                            if(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + widthDevice < footer.top) {
                                // console.log(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + " pos --- offset " + `${footer.top}`);
                                // console.log((top + $('#header').innerHeight() + $('.fixed-block').innerHeight()));
                                // console.log("FIXED");
                                $('.fixed-block-ghost').css({height: $('.fixed-block').innerHeight()+'px', display: 'block'});
                                elem.css({top: topfixed, position: 'fixed', backgroundColor: '#fff', bottom: 'initial', width: `92vw`});
                            } else {
                                // console.log('ABSOLUTED');
                                elem.css({top: 'initial', position: 'absolute', backgroundColor: '#fff', bottom: '20px'});
                                $('.fixed-block-ghost').css({height: $('.fixed-block').innerHeight()+'px', display: 'block'});
                            }
                        }
                        
                    }
                } else {
                if ((top + $('#header').innerHeight()) + widthDevice < elemFixedPos) {
                    // console.log(top + $('#header').innerHeight() + " pos --- offset " + `${elem.offset().top}`);
                    // console.log((top + $('#header').innerHeight()));
                    // console.log("RELATIVED");
                    elem.css({'top': 0, position: 'relative',backgroundColor: 'transparent',bottom:'initial'});
                    // $('.container h1').fadeIn();
                    // $('.bx-breadcrumb').show();
                    $('.fixed-block-ghost').css({height: 0 +'px', display: 'none'});
                } else {
                    if(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + widthDevice*2 < footer.top) {
                        // console.log(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + " pos --- offset " + `${footer.top}`);
                        // console.log((top + $('#header').innerHeight() + $('.fixed-block').innerHeight()));
                        // console.log("FIXED");
                        $('.fixed-block-ghost').css({height: $('.fixed-block').innerHeight()+'px', display: 'block'});
                        elem.css({top: topfixed, position: 'fixed', backgroundColor: '#fff', bottom: 'initial', width: `${elem.parent().width()}px`});
                    } else {
                        // console.log('ABSOLUTED');
                        elem.css({top: 'initial', position: 'absolute', backgroundColor: '#fff', bottom: '20px'});
                        $('.fixed-block-ghost').css({height: $('.fixed-block').innerHeight()+'px', display: 'block'});
                    }
                    // $('.container h1').fadeIn();
                    // $('.bx-breadcrumb').hide();
                }
             }
            });
        }
    });
    $(function () {
        if(document.querySelector('.fixed-block-alp') != null) {
            var elem2 = $('.fixed-block-alp');
        var top2 = $(this).scrollTop();
        var footer2= $('#footer-wrapper').offset();
        var topfixed2 = 113 + 'px';
        var elemFixedPos2 = elem2.offset().top;
        var elemAbsolutePos2 = '-118px';
        if($(window).width() <= 576) {
            elemAbsolutePos2 = '-21px'; 
        }
        $(window).scroll(function () {
            if($(window).width() <= 992 && $(window).width() > 500) {
                widthDevice2 = -20;
            }
            if($(window).width() <= 500) {
                widthDevice2 = -20;
            }
            if($(window).width() <= 1279 && $(window).width() > 1024) {
                topfixed2 = 134 + 'px';
            } else if($(window).width() <= 1024 && $(window).width() > 1000) {
                topfixed2 = 110 + 'px';
            } else if($(window).width() <= 1000 && $(window).width() > 768) {
                topfixed2 = 110 + 'px';
            }
             else if ($(window).width() <= 768 && $(window).width() > 500) {
                topfixed2 = 114 + 'px';
            } else if($(window).width() <= 500) {
                topfixed2 = 87 + 'px';
            }
            // console.log(top);
            // console.log(footer);
            footer2= $('#footer-wrapper').offset();
            top2 = $(this).scrollTop();
            // if ((top2 + $('#header').innerHeight()) < elemFixedPos2) {
            //     // console.log(top2 + $('#header').innerHeight() + " pos --- offset " + `${elem2.offset().top}`);
            //     // console.log((top2 + $('#header').innerHeight()));
            //     // console.log("RELATIVED");
            //     elem2.css({'top': 0, position: 'relative',backgroundColor: 'transparent',bottom:'initial',paddingBottom: '30px'});
            //     elem2.children('.container').css({paddingLeft: '0',paddingRight: '0'});
            //     $('.container h1').fadeIn();
            //     $('.bx-breadcrumb').show();
            //     $('.fixed-block-ghost').css({height: 0 +'px', display: 'none'});
            // } else {
            //     $('.fixed-block-ghost').css({height: $('.fixed-block-alp').innerHeight()+'px', display: 'block'});
            //     if(top2 + $('#header').innerHeight() + $('.fixed-block-alp').innerHeight() < footer2.top) {
            //         // console.log(top2 + $('#header').innerHeight() + $('.fixed-block-alp').innerHeight() + " pos --- offset " + `${footer2.top}`);
            //         // console.log((top2 + $('#header').innerHeight() + $('.fixed-block-alp').innerHeight()));
            //         // console.log("FIXED");
            //         elem2.css({'top': topfixed2, position: 'fixed', backgroundColor: '#fff', bottom: 'initial', width: `${100}%`,paddingBottom: '30px'});
            //         elem2.children('.container').css({paddingLeft: '15px',paddingRight: '15px'});
            //     } else {
            //         // console.log('ABSOLUTED');
            //         elem2.css({'top': 'initial', position: 'absolute', backgroundColor: '#fff', bottom: elemAbsolutePos2 ,paddingBottom: '30px'});
            //         elem2.children('.container').css({paddingLeft: '15px',paddingRight: '15px'});
            //     }
            //     $('.container h1').fadeIn();
            //     $('.bx-breadcrumb').hide();
            // }


            if($(window).width() <= 992) {
                if ((top2 + $('#header').innerHeight()) + widthDevice2 < elemFixedPos2) {
                    // console.log(top2 + $('#header').innerHeight() + " pos --- offset " + `${elem2.offset().top}`);
                    // console.log((top2 + $('#header').innerHeight()));
                    // console.log("relatived");
                    elem2.css({'top': 'initial', position: 'relative',backgroundColor: 'transparent',bottom:'initial'});
                    // $('.container h1').fadeIn();
                    // $('.bx-breadcrumb').show();
                    $('.fixed-block-ghost').css({height: 0 +'px', display: 'none'});
                } else {
                    if($(window).width() <= 500) {
                        if(top2 + $('#header').innerHeight() + $('.fixed-block-alp').innerHeight() + widthDevice2/3 < footer2.top) {
                            // console.log(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + " pos --- offset " + `${footer.top}`);
                            // console.log((top + $('#header').innerHeight() + $('.fixed-block').innerHeight()));
                            // console.log("FIXED");
                            $('.fixed-block-ghost').css({height: $('.fixed-block-alp').innerHeight()+'px', display: 'block'});
                            elem2.css({top: topfixed2, position: 'fixed', backgroundColor: '#fff', bottom: 'initial', width: `${elem2.parent().outerWidth()}px`});
                        } else {
                            $('.fixed-block-ghost').css({height: $('.fixed-block-alp').innerHeight()+'px', display: 'block'});
                            // console.log('ABSOLUTED');
                            elem2.css({top: 'initial', position: 'absolute', backgroundColor: '#fff', bottom: '20px'});
                        }
                    } else {
                        if(top2 + $('#header').innerHeight() + $('.fixed-block-alp').innerHeight() + widthDevice2 < footer2.top) {
                            // console.log(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + " pos --- offset " + `${footer.top}`);
                            // console.log((top + $('#header').innerHeight() + $('.fixed-block').innerHeight()));
                            // console.log("FIXED");
                            $('.fixed-block-ghost').css({height: $('.fixed-block-alp').innerHeight()+'px', display: 'block'});
                            elem2.css({top: topfixed2, position: 'fixed', backgroundColor: '#fff', bottom: 'initial', width: `${elem2.parent().outerWidth()}px`});
                        } else {
                            // console.log('ABSOLUTED');
                            elem2.css({top: 'initial', position: 'absolute', backgroundColor: '#fff', bottom: '20px'});
                            $('.fixed-block-ghost').css({height: $('.fixed-block-alp').innerHeight()+'px', display: 'block'});
                        }
                    }

                }
            } else {
                if ((top2 + $('#header').innerHeight()) + widthDevice2 < elemFixedPos2) {
                    // console.log(top + $('#header').innerHeight() + " pos --- offset " + `${elem.offset().top}`);
                    // console.log((top + $('#header').innerHeight()));
                    // console.log("RELATIVED");
                    elem2.css({'top': 0, position: 'relative',backgroundColor: 'transparent',bottom:'initial'});
                    // $('.container h1').fadeIn();
                    // $('.bx-breadcrumb').show();
                    $('.fixed-block-ghost').css({height: 0 +'px', display: 'none'});
                } else {
                    if(top + $('#header').innerHeight() + $('.fixed-block-alp').innerHeight() + widthDevice2*2 < footer2.top) {
                        // console.log(top + $('#header').innerHeight() + $('.fixed-block').innerHeight() + " pos --- offset " + `${footer.top}`);
                        // console.log((top + $('#header').innerHeight() + $('.fixed-block').innerHeight()));
                        // console.log("FIXED");
                        $('.fixed-block-ghost').css({height: $('.fixed-block-alp').innerHeight()+'px', display: 'block'});
                        elem2.css({top: topfixed2, position: 'fixed', backgroundColor: '#fff', bottom: 'initial', width: `${elem2.parent().width()}px`});
                    } else {
                        // console.log('ABSOLUTED');
                        elem2.css({top: 'initial', position: 'absolute', backgroundColor: '#fff', bottom: '20px'});
                        $('.fixed-block-ghost').css({height: $('.fixed-block-alp').innerHeight()+'px', display: 'block'});
                    }
                    // $('.container h1').fadeIn();
                    // $('.bx-breadcrumb').hide();
                }
            }



        });
        }
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

   /* $('.sort-block-list-item').on( "click", function() {
            $('.sort-block-list-item').removeClass('active');
            $(this).toggleClass('active');
    });
    $('.services-list .sort-block-list-item').on( "click", function() {
        $('.services-list .sort-block-list-item').removeClass('active');
        $(this).toggleClass('active');
    });*/
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
        if(!$(this).hasClass( 'pass' )) {
            console.log($(this).parents('.doctors-list-item__days-list'));
            // $('.doctors-list-item__days-list-item').removeClass('active');
            $(this).parents('.doctors-list-item__days-list').children('.doctors-list-item__days-list-item').removeClass('active');
            $(this).toggleClass('active');
        } else {
            $(this).parents('.doctors-list-item__days-list').children('.doctors-list-item__days-list-item').removeClass('active');
        }
    });
    $('.clinic-card-full-desc__tabs > ul > li').on( "click", function() {
        $('.clinic-card-full-desc__tabs > ul > li').removeClass('active');
        $(this).toggleClass('active');
    });


    $('.clinic-card-full-desc__tabs ul li').hover(function () {
        // $('.clinic-card-full-desc__tabs ul li').removeClass('active');
        // $(this).toggleClass('active');
        $(this).on("click" , function () {
            $('.clinic-card-full-desc__content').removeClass('active');
            var data = $(this).data('tabs');
            $(`.clinic-card-full-desc__content[data-tabs="${data}"]`).toggleClass('active');
        });
    });




    $('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop ul > li').on( "click", function() {
        $('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop ul > li').removeClass('active');
        $(this).toggleClass('active');
    });

    $('.personal-cabinet-content__doctors-page-box-item__desc__name .edit').on( "click", function() {
        $(this).parents('.personal-cabinet-content__doctors-page-box-item__desc__name').children('span').hide();
        $(this).parents('.personal-cabinet-content__doctors-page-box-item__desc__name').children('input').fadeIn(2000);
        // $('.personal-cabinet-content__doctors-page-box-item__desc__name > span').hide();
        // $('.personal-cabinet-content__doctors-page-box-item__desc__name > input').fadeIn(2000);
    });

    $('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop > ul > li').hover(function () {
        
        
        $(this).on("click" , function () {
            $('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop > ul > li').removeClass('active');
            $(this).toggleClass('active');
            $('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content').removeClass('active');
            var data = $(this).data('tabs');
            $(`.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content[data-tabs="${data}"]`).toggleClass('active');
        });
    });


    $('.personal-cabinet-content__price-page__tabs .title-h5').on( "click", function() {
        $('.personal-cabinet-content__price-page__tabs .title-h5').removeClass('active');
        $(this).toggleClass('active');
    });


    $('.personal-cabinet-content__price-page__tabs .title-h5').hover(function () {
        // $('.personal-cabinet-content__price-page__tabs .title-h5').removeClass('active');
        // $(this).toggleClass('active');
        $(this).on("click" , function () {
            $('.personal-cabinet-content__price-page__content').removeClass('active');
            var data = $(this).data('tabs');
            $(`.personal-cabinet-content__price-page__content[data-tabs="${data}"]`).toggleClass('active');
        });
    });
    $(function () {
        if(window.outerWidth <= 650) {
            $('.personal-cabinet-content__price-page__content__list > li').removeClass('active');
        }
    });

    $('.personal-cabinet-content__price-page__content__list > li').on( "click", function() {
        if(window.outerWidth > 650) {
            $(this).parent().children().removeClass('active');
            // $('.personal-cabinet-content__price-page__content__list > li').removeClass('active');
            $(this).toggleClass('active');
        }

    });



    $('.personal-cabinet-content__price-page__content__list > li').hover(function () {

        // $('.personal-cabinet-content__price-page__content__list > li').removeClass('active');
        // $(this).toggleClass('active');
        $(this).parents('.personal-cabinet-content__price-page__content').find('.personal-cabinet-content__price-page__content__list-content').removeClass('active');
        // $('.personal-cabinet-content__price-page__content__list-content').removeClass('active');
        var data = $(this).data('tabs');
        $(`.personal-cabinet-content__price-page__content__list-content[data-tabs="${data}"]`).toggleClass('active');
        $(this).on("click" ,function () {
            console.log('click!');
            if($('.personal-cabinet-content__price-page__content__list > li').hasClass('active')){
                $('.personal-cabinet-content__price-page__content__list > li').css({'margin-bottom': '0'});
            }
            if(window.outerWidth <= 650) {
                var box = $(this).parents('.personal-cabinet-content__price-page__content').find('.personal-cabinet-content__price-page__content__list-box');
                console.log($(this)[0]);
                var calcHeight = $(this)[0].offsetTop + $(this).outerHeight() + box.outerHeight();
                console.log(calcHeight);
                // $(this).css({'margin-bottom': ''});

                if($(this).delay(500).hasClass('active')){
                    $(this).parent().children().removeClass('active');
                    box.hide();
                    $(this).parents('.personal-cabinet-content__price-page__content').height('auto');
                    // console.log($(this));

                } else {
                    $(this).addClass('active');
                    var offsetTopLi = $(this)[0].offsetTop + $(this).outerHeight();
                    box.css({top: offsetTopLi + 'px'});
                    box.show();
                    $(this).css({'margin-bottom': box.outerHeight()});
                   // $(this).parents('.personal-cabinet-content__price-page__content').height(calcHeight);
                    $(this).parents('.personal-cabinet-content__price-page__content').height('auto');
                    // $(this).on('click','.load_page-1007',function (){
                    //     $(this).parents('.personal-cabinet-content__price-page__content').height(calcHeight);
                    // })
                }

            }
        });

    });
    // $('.load_page-1007').on('click',function (e){
    //     var customBox = $(this).parents('.personal-cabinet-content__price-page__content').find('.personal-cabinet-content__price-page__content__list-box');
    //     var myHeight = customBox.height() + customBox[0].offsetHeight;
    //     $('.personal-cabinet-content__price-page__content').height(myHeight);
    //
    //     // console.log(customBox[0].offsetHeight);
    // })
    $('.library-sort > li').on( "click", function() {
        $('.library-sort > li').removeClass('active');
        $(this).toggleClass('active');
    });


    // $('.library-sort > li').hover(function () {
    //     // $('.library-sort > li').removeClass('active');
    //     // $(this).toggleClass('active');
    //     console.log('as');
    //     $(this).on("click" , function () {
    //         $('.library-content').removeClass('active');
    //         var data = $(this).data('tabs');
    //         $(`.library-content[data-tabs="${data}"]`).toggleClass('active');
    //     });
    // });




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
        swipeToSlide: true,
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
    
    $('.slick-slider4').slick({
        arrows: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        variableWidth: true,
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
                    adaptiveHeight: true,
                }
              },
        ]
    });

    $('.search-doctors').on( "click", function() {
        $(this).hide();
        $('.clinic-card .main-filter').css({'padding-top': '32px', 'padding-bottom': '29px'});
        $(this).prev().slideDown();
        $(this).prev().css({'display': 'flex'});
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
    $('.clinic-card-item .popup-link').click(function(e) {
     
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
        $($(this).parents('.clinic-card-item').find('.map-wrapper .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');
         
        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });
    $('.clinic-card-item .popup-link-marker').click(function(e) {
     
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();
         
        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();
        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .map-popup-marker').css('display', 'block');
        $(this).parents('.clinic-card-item').find('.map-wrapper .popup-box').show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');
         
        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });
    $('.doctor-card .popup-link').click(function(e) {

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
        $($(this).parents('.doctor-card').find('.map-wrapper .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');

        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });
    $('.doctor-card .popup-link-marker').click(function(e) {

        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();

        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();
        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .map-popup-marker').css('display', 'block');
        $(this).parents('.doctor-card').find('.map-wrapper .popup-box').show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');

        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });
    /* CUSTOM*/
    function splitMulti(str, tokens){
        var tempChar = tokens[0]; // We can use the first token as a temporary join character
        for(var i = 1; i < tokens.length; i++){
            str = str.split(tokens[i]).join(tempChar);
        }
        str = str.split(tempChar);
        return str;
    }
    $('.popup-reception-click').click(function(e) {
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();
         
        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();
         
        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .doctors-list.reception').css('display', 'block');
        console.log($(this).parents('.clinic-card'));
        // $($(this).parent().parent().parent().find('.map-wrapper .popup-box')).show();
        $($(this).parents('main').find('.reception-popup .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');
         
        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });
    $('.doctor-card__metro-list-show_more').click(function(e) {
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();

        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();

        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .more-adress-content').css('display', 'block');
        console.log($(this).parents('.clinic-card'));
        // $($(this).parent().parent().parent().find('.map-wrapper .popup-box')).show();
        $($(this).parents('main').find('.more-adress-popup .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');

        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });

    $('.popup-call-click').click(function(e) {
     
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();
         
        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();
         
        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .doctors-list.call').css('display', 'block');
        console.log($(this).parents('.clinic-card'));
        // $($(this).parent().parent().parent().find('.map-wrapper .popup-box')).show();
        $($(this).parents('main').find('.call-popup .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');
         
        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });

    $('.popup-mess-click').click(function(e) {
     
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();
         
        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();
         
        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        $('.popup-box .message-to-doctor').css('display', 'flex');
        console.log($(this).parents('.clinic-card'));
        // $($(this).parent().parent().parent().find('.map-wrapper .popup-box')).show();
        $($(this).parents('main').find('.mess-popup .popup-box')).show();
        $('#blackout').show();
        $('html,body').css('overflow', 'hidden');
         
        /* Убираем баг в Firefox */
        $('html').scrollTop(scrollPos);
    });

    $('.popup-alp-click').click(function(e) {
     
        /* Предотвращаем действия по умолчанию */
        e.preventDefault();
        e.stopPropagation();
         
        /* Получаем id (последний номер в имени класса ссылки) */
        var name = $(this).attr('class');
        var id = name[name.length - 1];
        var scrollPos = $(window).scrollTop();
        /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
        // console.log($(this).parents('.alp-item').children('.col__heading').text());
        if($(this).parents('.fixed-block-alp').hasClass('fixed-block-alp')) {
            let search2 = $(this).text();
            console.log(search2 + "fixed");
            $($('.library').find(`.col__heading:contains('${search2}')`).parents('.alp-item').children('.popup-box')).show();
            $('.popup-box .alp-detail').css('display', 'block'); 
        }
        if($(this).parents('.alp-item').hasClass('alp-item')) {
            let search = $(this).parents('.alp-item').children('.col__heading').text();
            console.log(search + 'alp-item');
            $($(this).parents('.library').find(`.col__heading:contains('${search}')`).parents('.alp-item').children('.popup-box')).show();
            $('.popup-box .alp-detail').css('display', 'block');   
        }

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
        $('.popup-box .doctors-list.reception').css('display', 'none');
        $('.popup-box .doctors-list.call').css('display', 'none');
        $('.popup-box .message-to-doctor').css('display', 'none');
        $('.popup-box .more-adress-content').css('display', 'none');

        $('#blackout').hide(); 
        $("html,body").css("overflow","auto");
        $('html').scrollTop(scrollPos);
    });
    $('.close').click(function() { 
        var scrollPos = $(window).scrollTop();
        $('.popup-box').hide();
        $('.popup-box .map-popup').css('display', 'none');
        $('.popup-box .map-popup-marker').css('display', 'none');
        $('.popup-box .doctors-list.reception').css('display', 'none');
        $('.popup-box .doctors-list.call').css('display', 'none');
        $('.popup-box .message-to-doctor').css('display', 'none');
        $('.popup-box .more-adress-content').css('display', 'none');

        $('#blackout').hide(); 
        $("html,body").css("overflow","auto");
        $('html').scrollTop(scrollPos);
    });




    $('.personal-cabinet-content__doctors-page-box-item__desc__redactor span').click(function() {
        if($(this).text() === 'Редактировать данные') {
            $(this).text('Закрыть');
            $(this).parents('.personal-cabinet-content__doctors-page-box-item__desc').find('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop').slideDown();
        } else {
            $(this).text('Редактировать данные');
            $(this).parents('.personal-cabinet-content__doctors-page-box-item__desc').find('.personal-cabinet-content__doctors-page-box-item__desc__redactor__drop').slideUp();
        }
    });

    $('.bx_filter_select_block').click( function () {
        $('.popup-window').css({width: this.offsetWidth + 'px'});
    });
    $('#title-search-input').keyup(function () {
        $('.title-search-result').css({minWidth: this.offsetWidth + 'px'});
    });

    $(document).mouseup(function (e) {
        var div = $(".side-menu");
        if (!div.is(e.target) && div.has(e.target).length === 0 && !$('.burger__btn').is(e.target)) {
            // console.log('click za bredelami sidemenu');
            // console.log($(".burger__toggle").prop('checked'));
            $(".burger__toggle").prop('checked',false);
    }
    });

});

/* CUSTOM*/
function splitMulti(str, tokens){
    var tempChar = tokens[0]; // We can use the first token as a temporary join character
    for(var i = 1; i < tokens.length; i++){
        str = str.split(tokens[i]).join(tempChar);
    }
    str = str.split(tempChar);
    return str;
}
$(document).ready(function () {
    let urlParams = String(new URLSearchParams(window.location.search));
    let params = splitMulti(urlParams, ['=', '&']);
    if(params[0]==='clinic' && params[1]!==null && params[2]==="time" && params[3]!==null){
        $('.popup-reception-click').trigger('click');
        // params[1].replace('+', ' ');
        // console.log(decodeURIComponent(params[1]));
        // console.log(decodeURIComponent(params[3]));
        // $("#selectClinic").val(params[1]);
        // $("#selectTime").val(decodeURIComponent(params[3]));
    }
    $('.popup-reception-click').click(function() {
        let clinic = $(this).data('clinic');
        let time = $(this).data('time');
        const params = new URLSearchParams(location.search);
        if(time!==undefined && clinic!==undefined){
            params.set('clinic', clinic);
            params.set('time', time);
            window.history.replaceState({}, '', `${location.pathname}?${params}`);
        }
    });
    // задержка для клика по фильтрам

    $('.bx_filter_parameters_box.active').mouseup(function () {
        $('.bx_filter_parameters_box.active').addClass('delay')
        setTimeout(() => {
            $('.bx_filter_parameters_box.active.delay').removeClass('delay');
        },770);

        console.log('123');
    });
});

