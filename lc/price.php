<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>

<main class="personal-cabinet">
    <div class="personal-cabinet-menu">
        <ul class="personal-cabinet-menu__list">
            <li class="personal-cabinet-menu__list-item unactive">
                <a href="index.php">
                    <div class="personal-cabinet-menu__icon icon-clinic unactive">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Клиника</h5>
                        <span>профиль, услуги, способы оплаты</span>
                    </div>
                </a>
            </li>
            <li class="personal-cabinet-menu__list-item unactive">
                <a href="schedule.php">
                    <div class="personal-cabinet-menu__icon icon-schedule unactive">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Расписание клиники</h5>
                        <span>время работы</span>
                    </div>
                </a>
            </li>
            <li class="personal-cabinet-menu__list-item unactive">
                <a href="doctors.php">
                    <div class="personal-cabinet-menu__icon icon-doctor unactive">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Врачи</h5>
                        <span>фотографии, квалификация</span>
                    </div>
                </a>
            </li>
            <li class="personal-cabinet-menu__list-item unactive active">
                <a href="">
                    <div class="personal-cabinet-menu__icon icon-price unactive active">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Цены на услуги клиники</h5>
                        <span>МРТ, КТ, УЗИ</span>
                    </div>
                </a>
            </li>
            <li class="personal-cabinet-menu__list-item unactive">
                <a href="">
                    <div class="personal-cabinet-menu__icon icon-doc unactive">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Документы, фото и видео</h5>
                        <span>Логотип, грамоты, дипломы клиники</span>
                    </div>
                </a>
            </li>
            <li class="personal-cabinet-menu__list-item unactive">
                <a href="">
                    <div class="personal-cabinet-menu__icon icon-feedback unactive">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Отзывы</h5>
                        <span>Ответы на отзывы, чат</span>
                    </div>
                </a>
            </li>
            <li class="personal-cabinet-menu__list-item unactive">
                <a href="">
                    <div class="personal-cabinet-menu__icon icon-adv unactive">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Советы</h5>
                        <span>по продвижению клиники</span>
                    </div>
                </a>
            </li>
            <li class="personal-cabinet-menu__list-item unactive">
                <a href="">
                    <div class="personal-cabinet-menu__icon icon-wid unactive">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Виджеты</h5>
                        <span>для сайта клиники</span>
                    </div>
                </a>
            </li>
        </ul>
        <div class="personal-cabinet-menu__manager">
            <div class="personal-cabinet-menu__manager__photo">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/manager-photo.png" alt="photo">
            </div>
            <p class="personal-cabinet-menu__manager__desc">Мой персональный менеджер</p>
            <p class="personal-cabinet-menu__manager__name">Марина Тихоновская</p>
            <a href="tel:+79892897445" class="personal-cabinet-menu__manager__phone">+7 (989) 289-74-45</a>
            <div class="personal-cabinet-menu__manager__social">
                <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/viber-icon.svg" alt="icon"></a>
                <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/whatsapp-icon.svg" alt="icon"></a>
                <a href=""><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/telegram-icon.svg" alt="icon"></a>
            </div>
            <a href="mailto:marina@prodoctorov.ru" class="personal-cabinet-menu__manager__email">marina@prodoctorov.ru</a>
        </div>
    </div>
    <div class="personal-cabinet-content__price-page">
        <h2 class="title-h2">Цены на услуги клиники</h2>
    </div>
</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>