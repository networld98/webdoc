<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
?>
</main>
<footer id="footer-wrapper" class="footer">
    <div class="container">
        <div class="row">
            <div class="footer__col-1 col-sm-4 col-xl-4 col-lg-4">
                <div class="logo"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/LOGO-dark-bg.svg" alt="logo"></div>
                <div class="footer__contacts">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/include/footer-contacts.php"
                        ),
                        false
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/include/footer-politics.php"
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <div class="footer__col-2 d-none d-xl-block col-xl-2 col-lg-3 col-sm-12 pt-xl-0 pt-2">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "vertical_footer",
                    array(
                        "ROOT_MENU_TYPE" => "top",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_TITLE" => GetMessage("MENU_1_TITLE"),
                        "COMPONENT_TEMPLATE" => "vertical_footer",
                        "MENU_THEME" => "site"
                    ),
                    false
                ); ?>
            </div>
            <div class="footer__col-3 col-xl-3 col-lg-3 offset-lg-1  offset-xl-0 col-sm-4 col-12 pt-2 pt-xl-0">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/footer-menu-1.php"
                    ),
                    false
                ); ?>
            </div>
            <div class="footer__col-4 col-xl-3 col-lg-4 col-sm-4 col-12 pt-2 pt-xl-0">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/footer-menu-2.php"
                    ),
                    false
                ); ?>
            </div>
            <div class="footer__col-5 col-sm-12 pt-2">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/footer-politics.php"
                    ),
                    false
                ); ?>
            </div>
            <div class="col-lg-12 text-center">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/alarm.php"
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>
</footer>
<script>
    var auth = {
        popup: null, //наш popup
        showPopup: function (url) {
            this.popup = BX.PopupWindowManager.create("modal_auth", '', {
                closeIcon: true,
                autoHide: true,
                offsetLeft: 0,
                offsetTop: 0,
                closeByEsc: true,
                content: BX('auth-popup')
            });

            this.popup.show();
        }
    };
    $('#header-auth').click(()=>{
        auth.showPopup();
    });
    $('body').on('click', '.load_more', function () {
        let content = this.parentNode.lastElementChild;
        this.remove();
        if (!content) {
            return false;
        } else if (content.classList.contains('expand')) {
            content.classList.remove('expand');
        }
    })
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(67047445, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/67047445" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>