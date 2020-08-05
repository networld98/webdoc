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
            <li class="personal-cabinet-menu__list-item unactive active">
                <a href="">
                    <div class="personal-cabinet-menu__icon icon-doctor unactive active">
                    </div>
                    <div class="personal-cabinet-menu__desc">
                        <h5>Врачи</h5>
                        <span>фотографии, квалификация</span>
                    </div>
                </a>
            </li>
            <li class="personal-cabinet-menu__list-item unactive">
                <a href="price.php">
                    <div class="personal-cabinet-menu__icon icon-price unactive">
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
    <div class="personal-cabinet-content__doctors-page">
        <h2 class="title-h2">Врачи</h2>
        <div class="personal-cabinet-content__doctors-page__filter">
            <div class="personal-cabinet-content__doctors-page__filter__options">
                <h4 class="title-h4">Фильтры</h4>
                <ul class="checkbox-group">
                    <li><span class="bx_filter_input_checkbox">
                            <input type="checkbox" value="" name="" id="" checked="checked"/>
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                        <label for="">выключена запись</label>
                    </li>
                    <li><span class="bx_filter_input_checkbox">
                            <input type="checkbox" value="" name="" id="" checked="checked"/>
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                        <label for="">не указан стаж</label>
                    </li>
                    <li><span class="bx_filter_input_checkbox">
                            <input type="checkbox" value="" name="" id="" checked="checked"/>
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                        <label for="">нет цены</label>
                    </li>
                    <li><span class="bx_filter_input_checkbox">
                            <input type="checkbox" value="" name="" id="" checked="checked"/>
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                        <label for="">без образования</label>
                    </li>
                    <li><span class="bx_filter_input_checkbox">
                            <input type="checkbox" value="" name="" id="" checked="checked"/>
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                        <label for="">нет фото</label>
                    </li>
                    <li><span class="bx_filter_input_checkbox">
                            <input type="checkbox" value="" name="" id="" checked="checked"/>
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                        <label for="">незарегистрированные</label>
                    </li>
                    <li><span class="bx_filter_input_checkbox">
                            <input type="checkbox" value="" name="" id="" checked="checked"/>
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                        <label for="">не указан профиль лечения</label>
                    </li>
                    <li><span class="bx_filter_input_checkbox">
                            <input type="checkbox" value="" name="" id="" checked="checked"/>
                            <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                        </span>
                        <label for="">не указан возраст пациента</label>
                    </li>
                </ul>
                <select name="" id="">
                        <option value="">Все специальности</option>
                </select>
            </div>
            <div class="personal-cabinet-content__doctors-page__filter__desc">
            <span>Как включить запись на приём</span>
                <ol>
                    <li>Включите запись у каждого врача:
                        <ul>
                            <li>загрузите портрет врача</li>
                            <li>укажите стоимость первичного приёма</li>
                            <li>переведите переключатель в положение "Запись"</li>
                        </ul>
                    </li>
                    <li>Включите запись на приём у клиники в целом на странице настройки записи на приём</li>
                </ol>
                <p>Чтобы получить максимальную отдачу от записи, включайте запись у каждого врача, ведущего приём в клинике, а также <a href="#">воспользуйтесь советами</a> по улучшению</p>
            </div>
        </div>
        <div class="personal-cabinet-content__doctors-page-box">
            <div class="personal-cabinet-content__doctors-page-box-item">
                <div class="personal-cabinet-content__doctors-page-box-item__img">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/aberyasaeva.png" alt="doc-photo">
                </div>
                <div class="personal-cabinet-content__doctors-page-box-item__desc">
                    <div class="personal-cabinet-content__doctors-page-box-item__desc__head">
                        <div class="personal-cabinet-content__doctors-page-box-item__desc-left">
                            <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                                <span class="personal-cabinet-content__doctors-page-box-item__desc__name">Аберясева Татьяна Александровна</span>
                                <span class="personal-cabinet-content__doctors-page-box-item__desc__status">не работает в клинике</span>
                            </div>
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor">
                                <span>Редактировать данные</span>
                            </div>
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop">
                                <ul>
                                    <li class="active">Основное</li>
                                    <li>Профиль лечения</li>
                                    <li>Образование</li>
                                    <li>Опыт работы</li>
                                    <li>Курсы</li>
                                </ul>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content main-block">
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Главная специальность</span>
                                        <select name="" id="">
                                            <option value="">Хирург</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Степень</span>
                                        <select name="" id="">
                                            <option value="">-----------------</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Категория</span>
                                        <select name="" id="">
                                            <option value="">-----------------</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row last">
                                        <span>Главная специальность</span>
                                        <input type="text" name="" id="" value="0">
                                        <span>лет</span>
                                        <span>с</span>
                                        <select name="" id="">
                                            <option value="">2000</option>
                                        </select>
                                        <span>года</span>
                                    </div>
                                    <button class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__btn">Сохранить</button>
                                </div>
                            </div>
                        </div>
                        <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                            <div class="toggle normal">
                                <input id="normal" class="normal-input" type="checkbox"/>
                                <label class="toggle-item" for="normal"></label>
                        </div>
                        </div>
                    </div>
                    <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box">
                        <!-- <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box-item">

                        </div> -->
                        <table>
                            <thead>
                                <tr>
                                    <td>Адрес</td>
                                    <td>Специальность</td>
                                    <td>Скидка</td>
                                    <td>Возраст пациента</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <select name="" id="">
                                        <option value="">пер. Марьинский, д. 1</option>
                                    </select>
                                    </td>
                                    <td>
                                    <select name="" id="">
                                        <option value="">Врач УЗИ</option>
                                    </select>
                                    </td>
                                    <td>
                                    <select name="" id="">
                                        <option value="">10</option>
                                    </select>
                                    </td>
                                    <td>
                                    <span>c</span>
                                    <input type="text" name="" id="" value="0">
                                    <span class="margin-x">до</span>
                                    <input type="text" name="" id="" value="0">
                                    <ul class="checkbox-group">
                                        <li><span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" checked="checked"/>
                                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                            <label for="">Онлайн</label>
                                        </li>
                                        <li><span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" checked="checked"/>
                                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                            <label for="">На дом</label>
                                        </li>
                                    </ul>
                                    <div class="close"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span class="personal-cabinet-content__doctors-page-box-item__desc__adress-box__add">+ добавить адрес</span>
                    </div>
                </div>
            </div>
            <div class="personal-cabinet-content__doctors-page-box-item">
                <div class="personal-cabinet-content__doctors-page-box-item__img">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/aberyasaeva.png" alt="doc-photo">
                </div>
                <div class="personal-cabinet-content__doctors-page-box-item__desc">
                    <div class="personal-cabinet-content__doctors-page-box-item__desc__head">
                        <div class="personal-cabinet-content__doctors-page-box-item__desc-left">
                            <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                                <span class="personal-cabinet-content__doctors-page-box-item__desc__name">Аберясева Татьяна Александровна</span>
                                <span class="personal-cabinet-content__doctors-page-box-item__desc__status">не работает в клинике</span>
                            </div>
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor">
                                <span>Редактировать данные</span>
                            </div>
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop">
                                <ul>
                                    <li class="active">Основное</li>
                                    <li>Профиль лечения</li>
                                    <li>Образование</li>
                                    <li>Опыт работы</li>
                                    <li>Курсы</li>
                                </ul>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content main-block">
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Главная специальность</span>
                                        <select name="" id="">
                                            <option value="">Хирург</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Степень</span>
                                        <select name="" id="">
                                            <option value="">-----------------</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Категория</span>
                                        <select name="" id="">
                                            <option value="">-----------------</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row last">
                                        <span>Главная специальность</span>
                                        <input type="text" name="" id="" value="0">
                                        <span>лет</span>
                                        <span>с</span>
                                        <select name="" id="">
                                            <option value="">2000</option>
                                        </select>
                                        <span>года</span>
                                    </div>
                                    <button class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__btn">Сохранить</button>
                                </div>
                            </div>
                        </div>
                        <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                            <div class="toggle normal">
                                <input id="normal" type="checkbox"/>
                                <label class="toggle-item" for="normal"></label>
                        </div>
                        </div>
                    </div>
                    <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box">
                        <!-- <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box-item">

                        </div> -->
                        <table>
                            <thead>
                                <tr>
                                    <td>Адрес</td>
                                    <td>Специальность</td>
                                    <td>Скидка</td>
                                    <td>Возраст пациента</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <select name="" id="">
                                        <option value="">пер. Марьинский, д. 1</option>
                                    </select>
                                    </td>
                                    <td>
                                    <select name="" id="">
                                        <option value="">Врач УЗИ</option>
                                    </select>
                                    </td>
                                    <td>
                                    <select name="" id="">
                                        <option value="">10</option>
                                    </select>
                                    </td>
                                    <td>
                                    <span>c</span>
                                    <input type="text" name="" id="" value="0">
                                    <span class="margin-x">до</span>
                                    <input type="text" name="" id="" value="0">
                                    <ul class="checkbox-group">
                                        <li><span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" checked="checked"/>
                                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                            <label for="">Онлайн</label>
                                        </li>
                                        <li><span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" checked="checked"/>
                                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                            <label for="">На дом</label>
                                        </li>
                                    </ul>
                                    <div class="close"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span class="personal-cabinet-content__doctors-page-box-item__desc__adress-box__add">+ добавить адрес</span>
                    </div>
                </div>
            </div>
            <div class="personal-cabinet-content__doctors-page-box-item">
                <div class="personal-cabinet-content__doctors-page-box-item__img">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/aberyasaeva.png" alt="doc-photo">
                </div>
                <div class="personal-cabinet-content__doctors-page-box-item__desc">
                    <div class="personal-cabinet-content__doctors-page-box-item__desc__head">
                        <div class="personal-cabinet-content__doctors-page-box-item__desc-left">
                            <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                                <span class="personal-cabinet-content__doctors-page-box-item__desc__name">Аберясева Татьяна Александровна</span>
                                <span class="personal-cabinet-content__doctors-page-box-item__desc__status">не работает в клинике</span>
                            </div>
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor">
                                <span>Редактировать данные</span>
                            </div>
                            <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop">
                                <ul>
                                    <li class="active">Основное</li>
                                    <li>Профиль лечения</li>
                                    <li>Образование</li>
                                    <li>Опыт работы</li>
                                    <li>Курсы</li>
                                </ul>
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content main-block">
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Главная специальность</span>
                                        <select name="" id="">
                                            <option value="">Хирург</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Степень</span>
                                        <select name="" id="">
                                            <option value="">-----------------</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row">
                                        <span>Категория</span>
                                        <select name="" id="">
                                            <option value="">-----------------</option>
                                        </select>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content-row last">
                                        <span>Главная специальность</span>
                                        <input type="text" name="" id="" value="0">
                                        <span>лет</span>
                                        <span>с</span>
                                        <select name="" id="">
                                            <option value="">2000</option>
                                        </select>
                                        <span>года</span>
                                    </div>
                                    <button class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__btn">Сохранить</button>
                                </div>
                            </div>
                        </div>
                        <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                            <div class="toggle normal">
                                <input id="normal" type="checkbox"/>
                                <label class="toggle-item" for="normal"></label>
                        </div>
                        </div>
                    </div>
                    <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box">
                        <!-- <div class="personal-cabinet-content__doctors-page-box-item__desc__adress-box-item">

                        </div> -->
                        <table>
                            <thead>
                                <tr>
                                    <td>Адрес</td>
                                    <td>Специальность</td>
                                    <td>Скидка</td>
                                    <td>Возраст пациента</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <select name="" id="">
                                        <option value="">пер. Марьинский, д. 1</option>
                                    </select>
                                    </td>
                                    <td>
                                    <select name="" id="">
                                        <option value="">Врач УЗИ</option>
                                    </select>
                                    </td>
                                    <td>
                                    <select name="" id="">
                                        <option value="">10</option>
                                    </select>
                                    </td>
                                    <td>
                                    <span>c</span>
                                    <input type="text" name="" id="" value="0">
                                    <span class="margin-x">до</span>
                                    <input type="text" name="" id="" value="0">
                                    <ul class="checkbox-group">
                                        <li><span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" checked="checked"/>
                                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                            <label for="">Онлайн</label>
                                        </li>
                                        <li><span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" checked="checked"/>
                                                <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                            <label for="">На дом</label>
                                        </li>
                                    </ul>
                                    <div class="close"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span class="personal-cabinet-content__doctors-page-box-item__desc__adress-box__add">+ добавить адрес</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>