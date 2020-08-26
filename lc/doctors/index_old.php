<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Врачи");
?>
<? include '../menu.php';?>
<div class="personal-cabinet-content__doctors-page">
    <h1 class="title-h2">Врачи</h1>
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
            <div class="row">
                <div class="col-lg-1">
                    <div class="personal-cabinet-content__doctors-page-box-item__img">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/aberyasaeva.png" alt="doc-photo">
                    </div>
                </div>
                <div class="col-lg-11">
                    <div class="personal-cabinet-content__doctors-page-box-item__desc">
                        <div class="row personal-cabinet-content__doctors-page-box-item__desc__head">
                            <div class="col-lg-10">
                                <div class="personal-cabinet-content__doctors-page-box-item__desc-left">
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc-left__info">
                                        <span class="personal-cabinet-content__doctors-page-box-item__desc__name"><span><a href="/">Аберясева Татьяна Александровна</a><div class="edit"></div></span>
                                        <input type="text" name="NAME_DOCTOR" value="Тестовый434543" class="changedInput">
                                        </span>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor">
                                        <span>Редактировать данные</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 text-right">
                                <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                                    <div class="toggle normal">
                                        <input id="normal" class="normal-input" type="checkbox"/>
                                        <label class="toggle-item" for="normal"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop">
                                    <ul>
                                        <li class="active" data-tabs="0">Основное</li>
                                        <li data-tabs="1">Профиль лечения</li>
                                        <li data-tabs="2">Образование</li>
                                        <li data-tabs="3">Опыт работы</li>
                                        <li data-tabs="4">Курсы</li>
                                    </ul>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content main-block active" data-tabs="0">
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
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="1">
                                        <h1>1</h1>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="2">
                                        <h1>2</h1>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="3">
                                        <h1>3</h1>
                                    </div>
                                    <div class="personal-cabinet-content__doctors-page-box-item__desc__redactor__drop__content" data-tabs="4">
                                        <h1>4</h1>
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
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>