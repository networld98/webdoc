<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>

<main class="personal-cabinet">
    <div class="personal-cabinet-menu">
        <ul class="personal-cabinet-menu__list">
            <li class="personal-cabinet-menu__list-item unactive active">
                <a href="">
                    <div class="personal-cabinet-menu__icon icon-clinic unactive active">
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
    <div class="personal-cabinet-content__my-profile">
        <h2 class="title-h2">Мой профиль</h2>
        <div class="personal-cabinet-content__my-profile__info">
            <div class="personal-cabinet-content__my-profile__info-form">
                <ul>
                    <li>
                        <label for="">Логин</label>
                        <p>info@mail.ru</p>
                    </li>
                    <li>
                        <label for="">Пароль</label>
                        <a href="">Изменение пароля</a>
                    </li>
                    <li>
                        <label for="">Год основания</label>
                        <input type="text">
                    </li>
                    <li>
                        <label for="">ФИО руководителя</label>
                        <input type="text">
                    </li>
                    <li>
                        <label for="">Официальный сайт</label>
                        <input type="text">
                    </li>
                    <li>
                        <label for="">Юридическое лицо</label>
                        <input type="text">
                    </li>
                    <li>
                        <label for="">Оплата</label>
                        <ul class="checkbox-group">
                            <li><span class="bx_filter_input_checkbox">
                                    <input type="checkbox" value="" name="" id="" checked="checked"/>
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                </span>
								<label for="">Картой</label></li>
                            <li><span class="bx_filter_input_checkbox">
                                    <input type="checkbox" value="" name="" id="" checked="checked"/>
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                </span>
                                <label for="">ОМС</label></li>
                            <li><span class="bx_filter_input_checkbox">
                                    <input type="checkbox" value="" name="" id="" checked="checked"/>
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                </span>
                                <label for="">ДМС</label></li>
                            <li><span class="bx_filter_input_checkbox">
                                    <input type="checkbox" value="" name="" id="" checked="checked"/>
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                </span>
                                <label for="">Наличными</label></li>
                        </ul>
                    </li>
                    <li>
                        <label for="">Лицензии</label>
                        <ul class="checkbox-group">
                            <li><span class="bx_filter_input_checkbox">
                                    <input type="checkbox" value="" name="" id="" checked="checked"/>
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                </span>
                                <label for="">Взрослые</label></li>
                            <li><span class="bx_filter_input_checkbox">
                                    <input type="checkbox" value="" name="" id="" checked="checked"/>
                                    <div class="checkbox"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/checkbox.svg" alt=""></div>
                                </span>
                                <label for="">Дети</label></li>
                        </ul>
                    </li>
                    <li>
                        <label for="mail-mess">Почтовые сообщения</label>
                        <select name="mail-mess" id="">
                            <option value="">Максимум полезного</option>
                        </select>
                    </li>
                    <button class="save">Сохранить</button>
                </ul>
            </div>
            <div class="personal-cabinet-content__my-profile__info-desc">
                <ul>
                    <li>
                        <label for="">Тип клиники:</label>
                        <p>Клиника</p>
                    </li>
                    <li>
                        <label for="">Название клиники:</label>
                        <p>Медицинский центр «Иммунитет»</p>
                    </li>
                    <li>
                        <label for="">Информация:</label>
                        <p>Медицинский центр «Иммунитет» города Бронницы предлагает помощь команды профессионалов с большой практикой излечения различных заболеваний. В наличии современное оборудование зарубежных производителей. Деятельность медицинского центра «Иммунитет» лицензирована.</p>
                    </li>
                    <li>
                        <label for="">Проезд:</label>
                        <p>До медицинского центра «Иммунитет» едет автобус № 5. Выйти на остановке «Магазин Минимаркет».</p>
                    </li>
                    <li>
                        <label for=""></label>
                        <p><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/map-img.svg" alt="map-clinic"></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="personal-cabinet-content__my-profile__services">
            <label for="">Услуги:</label>
            <div class="personal-cabinet-content__my-profile__services-col">
                <p>На базе медицинского центра «Иммунитет» принимает:</p>
                <ul>
                    <li><a href="">психиатр</a></li>
                    <li><a href="">мануальный терапевт</a></li>
                    <li><a href="">педиатр</a></li>
                    <li><a href="">уролог</a></li>
                    <li><a href="">неонатолог</a></li>
                    <li><a href="">дерматолог</a></li>
                    <li><a href="">терапевт</a></li>
                    <li><a href="">невролог</a></li>
                    <li><a href="">эндокринолог</a></li>
                    <li><a href="">травматолог</a></li>
                    <li><a href="">офтальмолог</a></li>
                    <li><a href="">хирург</a></li>
                    <li><a href="">сосудистый хирург</a></li>
                    <li><a href="">оториноларинголог</a></li>
                    <li><a href="">офтальмолог</a></li>
                    <li><a href="">гинеколог</a></li>
                    <li><a href="">уз-диагност</a></li>
                    <li><a href="">кардиолог</a></li>
                    <li><a href="">пластический хирург</a></li>
                </ul>
            </div>
            <div class="personal-cabinet-content__my-profile__services-col">
                <p>Предлагаются лабораторные исследования:</p>
                <ul>
                    <li><a href="">диагностика различных инфекций</a></li>
                    <li><a href="">онкомаркеры</a></li>
                    <li><a href="">педиатр</a></li>
                    <li><a href="">выполнение пренатального скрининга</a></li>
                    <li><a href="">маркеры остеопороза</a></li>
                    <li><a href="">онкомаркеры</a></li>
                    <li><a href="">наличие глистных инвазий</a></li>
                    <li><a href="">маркеры остеопороза</a></li>
                    <li><a href="">педиатр</a></li>
                </ul>
            </div>
            
        </div>
    </div>
</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>