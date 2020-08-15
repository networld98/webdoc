<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<? include '../menu.php';?>
<div class="personal-cabinet-content__price-page">
    <h2 class="title-h2">Цены на услуги клиники</h2>
    <div class="personal-cabinet-content__price-page__tabs">
        <h5 class="title-h5" data-tabs="0">Цены на диагностику</h5>
        <h5 class="title-h5 active" data-tabs="1">Цены на лечение</h5>
    </div>
    <div class="personal-cabinet-content__price-page__box">
        <div class="personal-cabinet-content__price-page__content" data-tabs="0">
            <h1>data tabs1</h1>
        </div>
        <div class="personal-cabinet-content__price-page__content active" data-tabs="1">
            <ul class="personal-cabinet-content__price-page__content__list">
                <li class="active" data-tabs="0">ЛОР услуги</li>
                <li data-tabs="1">Массаж</li>
                <li data-tabs="2">Стоматологические услуги</li>
                <li data-tabs="3">Косметологические услуги</li>
                <li data-tabs="4">Гинекологические услуги</li>
                <li data-tabs="5">Лечение глаз</li>
                <li data-tabs="6">Прививки</li>
                <li data-tabs="7">Проктологические услуги</li>
                <li data-tabs="8">Физиотерапия</li>
                <li data-tabs="9">Аллергологические услуги</li>
                <li data-tabs="10">Хирургические услуги</li>
                <li data-tabs="11">Хирургические услуги</li>
                <li data-tabs="12">Наркологические услуги</li>
                <li data-tabs="13">Оздоровительные услуги</li>
                <li data-tabs="14">Андрологические услуги</li>
                <li data-tabs="15">Укол</li>
                <li data-tabs="16">Справки</li>
                <li data-tabs="17">Эндопротезирование</li>
            </ul>
            <div class="personal-cabinet-content__price-page__content__list-box">
                <div class="personal-cabinet-content__price-page__content__list-content active" data-tabs="0">
                    <div class="personal-cabinet-content__price-page__content__list-content__equipment">
                        <h4 class="title-h4">Перечень оборудования<span>(пер. Марьинский, д. 1)</span></h4>
                        <table>
                            <thead>
                                <tr>
                                    <td>Тип</td>
                                    <td>Марка</td>
                                    <td>Характеристики</td>
                                </tr>
                            </thead>
                        </table>
                        <div class="personal-cabinet-content__price-page__content__list-content__equipment-add">
                            <p>Перечень оборудования не заполнен</p>
                            <button class="personal-cabinet-content__price-page__content__list-content__equipment-add__btn">+ Добавить оборудование</button>
                        </div>
                    </div>
                    <div class="personal-cabinet-content__price-page__content__list-content__price">
                        <h4 class="title-h4">Цены на Массаж</h4>
                        <table>
                            <thead>
                                <tr>
                                    <td>Вкл.</td>
                                    <td>Вид массажа</td>
                                    <td>Цена, руб.</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" checked>
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>LPG массаж</td>
                                    <td>
                                        <input type="text" value="1 500">
                                        <span>18.02.2020</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" >
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Антицеллюлитный массаж</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Баночный массаж </td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Вакуумный массаж</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="" checked>
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Висцеральный массаж живота</td>
                                    <td>
                                        <input type="text" value="2 000">
                                        <span>18.02.2020</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Детский массаж</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Криомассаж</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Лимфодренажный массаж</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Массаж головы</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Массаж Гуаша</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Массаж для похудения</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-group">
                                            <span class="bx_filter_input_checkbox">
                                                <input type="checkbox" value="" name="" id="">
                                                <div class="checkbox"><img src="/local/templates/light_blue/assets/images/checkbox.svg" alt=""></div>
                                            </span>
                                        </label>
                                    </td>
                                    <td>Массаж шейно-воротниковой зоны</td>
                                    <td>
                                        <input type="text" value="0">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="1">
                    <h1>data1</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="2">
                    <h1>data2</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="3">
                    <h1>data3</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="4">
                    <h1>data4</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="5">
                    <h1>data5</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="6">
                    <h1>data6</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="7">
                    <h1>data7</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="8">
                    <h1>data8</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="9">
                    <h1>data9</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="10">
                    <h1>data10</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="11">
                    <h1>data11</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="12">
                    <h1>data12</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="13">
                    <h1>data13</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="14">
                    <h1>data14</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="15">
                    <h1>data15</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="16">
                    <h1>data16</h1>
                </div>
                <div class="personal-cabinet-content__price-page__content__list-content" data-tabs="17">
                    <h1>data17</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>