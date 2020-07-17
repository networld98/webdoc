<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
global $clinicName;
$clinicName = $arResult["NAME"];
?>
<section class="container doctor-card">
    <div class="flex-left">
        <div class="doctor-card-top-content">
            <div class="doctor-card__img <?if($arResult['DETAIL_PICTURE']!=NULL){?>doctor-card-img<?}?>">
                <?if($arResult['DETAIL_PICTURE']){?>
                    <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="doctor-photo" class="doctors-list-item__img-photo">
                <?}elseif($arResultm['PROPERTIES']['GENDER']['VALUE']==NULL || $arResult['PROPERTIES']['GENDER']['VALUE']=="Мужчина" ){?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/icon/male.svg" alt="no-photo" class="doctors-list-item__img-none-photo">
                <?}elseif($arResult['PROPERTIES']['GENDER']['VALUE']=="Женщина" ){?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/icon/female.svg" alt="no-photo" class="doctors-list-item__img-none-photo">
                <?}?>
                <div class="doctor-card__img-info">
                    <a id="header-mess" style="cursor:pointer;">Написать доктору</a>
                    <a href="tel:<?=$arResult['PROPERTIES']['PHONE']['VALUE']?>">Позвонить</a>
                </div>
                <div class="doctor-card-favorites"></div>
            </div>
            <div class="doctor-card__description">
                <p class="doctor-card__description-position">
                    <?$res = CIBlockSection::GetByID($arResult['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE']);
                    if($ar_res = $res->GetNext()){?>
                        <?=$ar_res['NAME']?>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["SPECIALIZATION_DOP"]["VALUE"]):?>
                        <?echo " · "?>
                        <?$res = CIBlockSection::GetByID($arResult['PROPERTIES']['SPECIALIZATION_DOP']['VALUE']);
                        if($ar_res = $res->GetNext()){?>
                            <?=$ar_res['NAME']?>
                        <?}?>
                    <?endif;?>
                    <?if($arResult["PROPERTIES"]["RANK"]["VALUE"]):?>
                        <?= " · "?>
                        <?=$arResult['PROPERTIES']['RANK']['VALUE']?>
                    <?endif;?>
                </p>
                <p class="doctor-card__description-title"><?=$arResult['NAME']?></p>
                <?if($arResult["PROPERTIES"]["STANDING"]["VALUE"]):?>
                    <p class="doctor-card__description-exp">Стаж <?=$arResult['PROPERTIES']['STANDING']['VALUE']?></p>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["SCIENCE_DEGREE"]["VALUE"]):?>
                    <p class="doctor-card__description-degree"><?=$arResult["PROPERTIES"]["SCIENCE_DEGREE"]["VALUE"]?></p>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["PRICE"]["VALUE"]):?>
                    <p class="doctor-card__description-price"><?=$arResult["PROPERTIES"]["PRICE"]["VALUE"]?> Р<span>Цена приема в клинике</span></p>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["PHONE"]["VALUE"]):?>
                    <a href="tel:<?=$arResult["PROPERTIES"]["PHONE"]["VALUE"]?>" class="doctor-card__description-phone"><span>Телефон для записи:</span><?=$arResult["PROPERTIES"]["PHONE"]["VALUE"]?></a>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["CLINIK"]["VALUE"]):?>
                    <?foreach ($arResult["PROPERTIES"]["CLINIK"]["VALUE"] as $item){?>
                        <?$res = CIBlockElement::GetByID($item);
                        if($ar_res = $res->GetNext()){?>
                            <p class="doctor-card__clinic-name"><?=$ar_res['NAME']?></p>
                        <?}?>
                    <?}?>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"]):?>
                    <p class="doctor-card__clinic-adress"><?=$arResult["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"]?></p>
                <?endif;?>
                <div class="doctor-card-location-map"></div>
                <?if($arResult["PROPERTIES"]["METRO"]["VALUE"]):?>
                    <ul class="doctor-card__metro-list">
                        <?foreach ($arResult["PROPERTIES"]["METRO"]["VALUE"] as $key => $item){?>
                            <?$res = CIBlockElement::GetByID($item);
                            if($ar_res = $res->GetNext()){?>
                                <li class="doctor-card_metro-list-item <?if(($key % 2)==0 && $key!=0){?>metro1<?}elseif(($key % 3)==0||$key===0){?>metro2<?}else{?>metro3<?}?>"><?=$ar_res['NAME']?></li>
                            <?}?>
                        <?}?>
                    </ul>
                <?endif;?>
                <a href="" class="doctor-card__metro-list-show_more">ещё адреса приёма</a>
            </div>
        </div>
        <div class="doctor-card-popUp-group">
            <a id="header-reception" class="doctor-card-popUp-group__reception">Записаться на прием</a>
            <a id="header-call" class="doctor-card-popUp-group__call">Вызвать врача на дом</a>
        </div>
    </div>
    <div class="flex-right">
        <div class="doctor-card-top-content">
            <h3 class="title-h3">Информация о враче</h3>
            <div class="doctor-card__img-info-ratings">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
            </div>
            <p class="doctor-card__img-info-commend">100% пациентов рекомендуют врача на основе 131 отзыва<a href="">Все отзывы о враче</a></p>
            <ul class="doctor-card_options-list">
                <?if($arResult["PROPERTIES"]["DIAGNOSTICS"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["DIAGNOSTICS"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["CHILDREN_DOCTOR"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["CHILDREN_DOCTOR"]["NAME"]?></li>
                <?endif;?>
                <?if($arResultm["PROPERTIES"]["DMC"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["DMC"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["UMC"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["UMC"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["ONLINE"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["ONLINE"]["NAME"]?></li>
                <?endif;?>
                <?if($arResult["PROPERTIES"]["DEPARTURE_HOUSE"]["VALUE"]=='Y'):?>
                    <li class="doctor-card_options-list-item"><?=$arResult["PROPERTIES"]["DEPARTURE_HOUSE"]["NAME"]?></li>
                <?endif;?>
            </ul>
            <p class="doctor-card__position-desc"><?=$arResult['PREVIEW_TEXT']?></p>
            <a href="#anchor-spec-info" class="doctor-card__metro-list-show_more go-to">Подробная информация о специалисте</a>
        </div>
        <div class="doctor-card-popUp-group">
            <a id="header-map" class="doctor-card-popUp-group__route">Проложить маршрут</a>
        </div>
    </div>
</section>
<section class="container choosing-time">
    <h3 class="title-h3">Выберите время приема для записи онлайн</h3>
    <div class="choosing-time_block">
        <!-- <span class="choosing-time_block__arrows arrow-left"></span> -->
        <ul class="choosing-time_block-list slick-slider3">
            <li class="choosing-time_block-list-item active">Сегодня</br> 6 апреля</li>
            <li class="choosing-time_block-list-item">Завтра</br> 7 апреля</li>
            <li class="choosing-time_block-list-item">Среда</br> 8 апреля</li>
            <li class="choosing-time_block-list-item not-worked">Четверг</br> 9 апреля</li>
            <li class="choosing-time_block-list-item">Пятница</br> 10 апреля</li>
            <li class="choosing-time_block-list-item">Cуббота</br> 11 апреля</li>
        </ul>
        <!-- <span class="choosing-time_block__arrows arrow-right"></span> -->
    </div>
    <ul class="choosing-time__worktimming-list">
        <li class="choosing-time__worktimming-list-item">09:00</li>
        <li class="choosing-time__worktimming-list-item closed">09:40</li>
        <li class="choosing-time__worktimming-list-item closed">10:10</li>
        <li class="choosing-time__worktimming-list-item pass">10:50</li>
        <li class="choosing-time__worktimming-list-item">11:30</li>
        <li class="choosing-time__worktimming-list-item">12:10</li>
        <li class="choosing-time__worktimming-list-item">12:50</li>
        <li class="choosing-time__worktimming-list-item">13:30</li>
        <li class="choosing-time__worktimming-list-item">14:10</li>
        <li class="choosing-time__worktimming-list-item pass">14:50</li>
        <li class="choosing-time__worktimming-list-item pass">15:30</li>
        <li class="choosing-time__worktimming-list-item">16:00</li>
        <li class="choosing-time__worktimming-list-item">16:40</li>
        <li class="choosing-time__worktimming-list-item closed">17:20</li>
        <li class="choosing-time__worktimming-list-item">18:00</li>
        <li class="choosing-time__worktimming-list-item closed">18:40</li>
        <li class="choosing-time__worktimming-list-item">19:00</li>
    </ul>
</section>
<section class="container checked-feedback">
    <h2 class="title-h2">Проверенные отзывы о враче</h2>
    <div class="checked-feedback-list slick-slider2">
        <div class="checked-feedback-list-item">
            <div class="checked-feedback-list-item__doctor-info">
                <div class="checked-feedback-list-item__img-info-ratings starrr">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <span>Отлично</span>
                </div>
                <p class="checked-feedback-list-item__from">Марина, 16 февраля 2020,<span>прием в клинике</span></p>
                <p class="checked-feedback-list-item__feedback">Доброжелательный и приятный врач. Видно, что это профессионал своего дела. Она все спросила, узнала историю, причину. Все доступно объяснила, рассказала, дала рекомендации и назначения.</p>
            </div>
        </div>
        <div class="checked-feedback-list-item">
            <div class="checked-feedback-list-item__doctor-info">
                <div class="checked-feedback-list-item__img-info-ratings">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <span>Отлично</span>
                </div>
                <p class="checked-feedback-list-item__from">Дмитрий, 18 января 2020,<span>прием в клинике</span></p>
                <p class="checked-feedback-list-item__feedback">Очень внимательный доктор. Она досконально все выяснила, спросила какие были операции, заболевания в детстве. Составила диету, чтобы исключить продукты, которые могут вызывать аллергию. Прописала лечение, сказала какие препараты нужно употреблять и обозначила несколько анализов, которые нужно сдать, подешевле и подороже. Я давно мучаюсь с аллергией, но не встречал еще лучше врача! Я услышал все, что хотел!</p>
            </div>
        </div>
        <div class="checked-feedback-list-item">
            <div class="checked-feedback-list-item__doctor-info">
                <div class="checked-feedback-list-item__img-info-ratings">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <span>Отлично</span>
                </div>
                <p class="checked-feedback-list-item__from">Дмитрий, 18 января 2020,<span>прием в клинике</span></p>
                <p class="checked-feedback-list-item__feedback">Очень приятный и спокойный человек. Я и мой муж посещаем не первый раз данного специалиста и очень удовлетворены ей! Результат от первого этапа лечения уже есть! Доктор все спрашивает, вникает в проблему, обсуждает всю информацию и отвечает абсолютно на все вопросы! От врача не уходишь пока все не решишь, не смотря на то, что иногда прием занимает больше времени чем положено!</p>
            </div>
        </div>
        <div class="checked-feedback-list-item">
            <div class="checked-feedback-list-item__doctor-info">
                <div class="checked-feedback-list-item__img-info-ratings">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-none-filled.png" alt="">
                    <span>Хорошо</span>
                </div>
                <p class="checked-feedback-list-item__from">Дмитрий, 18 января 2020,<span>прием в клинике</span></p>
                <p class="checked-feedback-list-item__feedback">Очень приятный и спокойный человек. Я и мой муж посещаем не первый раз данного специалиста и очень удовлетворены ей! Результат от первого этапа лечения уже есть! Доктор все спрашивает, вникает в проблему, обсуждает всю информацию и отвечает абсолютно на все вопросы! От врача не уходишь пока все не решишь, не смотря на то, что иногда прием занимает больше времени чем положено!</p>
            </div>
        </div>
        <div class="checked-feedback-list-item">
            <div class="checked-feedback-list-item__doctor-info">
                <div class="checked-feedback-list-item__img-info-ratings">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
                    <span>Отлично</span>
                </div>
                <p class="checked-feedback-list-item__from">Марина, 16 февраля 2020,<span>прием в клинике</span></p>
                <p class="checked-feedback-list-item__feedback">Доброжелательный и приятный врач. Видно, что это профессионал своего дела. Она все спросила, узнала историю, причину. Все доступно объяснила, рассказала, дала рекомендации и назначения.</p>
            </div>
        </div>
    </div>
</section>
<section id="anchor-spec-info" class="container spec-info">
    <h2 class="title-h2">Информация о специалисте</h2>
    <div class="spec-info-block">
        <ul class="spec-info-block__spec-list">
            <h3 class="title-h3">Специализируется</br> на лечении</h3>
            <li>
                <?$res = CIBlockSection::GetByID($arResult['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE']);
                if($ar_res = $res->GetNext()){?>
                    <p class="spec-info-block__spec-list__title"><?=$ar_res['NAME']?></p>
                <?}?>
                <?if($arResult["PROPERTIES"]["SPECIALIZATIONS"]["VALUE"]):?>
                    <ul>
                        <?foreach ($arResult["PROPERTIES"]["SPECIALIZATIONS"]["VALUE"] as $item){?>
                            <?$res = CIBlockElement::GetByID($item);
                            if($ar_res = $res->GetNext()){?>
                                <li class="spec-info-block__spec-list-item"><a href=""><?=$ar_res['NAME']?></a></li>
                            <?}?>
                        <?}?>
                    </ul>
                <?endif;?>
            </li>
        </ul>
        <ul class="spec-info-block__education-list">
            <h3 class="title-h3">Образование</h3>
            <?if($arResult["PROPERTIES"]["EDUCATION"]["VALUE"]):?>
                <ol>
                <?foreach ($arResult["PROPERTIES"]["EDUCATION"]["VALUE"] as $item){?>
                    <?$obr = explode('/',$item); ?>
                    <li><span><?=$obr[0]?></span><?=$obr[1]?></li>
                <?}?>
                </ol>
            <?endif;?>
        </ul>
        <ul class="spec-info-block__exp-list">
            <h3 class="title-h3">Опыт работы</h3>
            <?if($arResult["PROPERTIES"]["EXPERIENCE"]["VALUE"]):?>
                <ol>
                <?foreach ($arResult["PROPERTIES"]["EXPERIENCE"]["VALUE"] as $item){?>
                    <?$obr = explode('/',$item); ?>
                    <li><span><?=$obr[0]?></span><?=$obr[1]?></li>
                <?}?>
                </ol>
            <?endif;?>
        </ul>
    </div>
</section>