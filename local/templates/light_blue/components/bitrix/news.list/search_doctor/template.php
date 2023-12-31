<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
CModule::IncludeModule("iblock");
CModule::IncludeModule("form"); ?>
<?if($arResult['ITEMS']!=NULL){?>
<div id="blockDoctor">
    <h2>Врачи</h2>
</div>
<section class="result-filter">
    <div class="list-item doctors-list">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="doctors-list-item card-item">
                <div class="flex-left">
                    <div class="doctors-list-item__img">
                        <? if ($arItem['DETAIL_PICTURE']['SRC'] != NULL) { ?>
                            <a style="background-image: url('<?= $arItem['DETAIL_PICTURE']['SRC'] ?>')" class="doctor-card__img-link doctors-list-item__img-photo photo-back-image" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                            </a>
                        <? } elseif ($arItem['PROPERTIES']['GENDER']['VALUE'] == NULL || $arItem['PROPERTIES']['GENDER']['VALUE'] == "Мужчина") { ?>
                            <a style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/male.svg')" class="doctor-card__img-link doctors-list-item__img-photo photo-back-image photo-back-image-contain" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                            </a>
                        <? } elseif ($arItem['PROPERTIES']['GENDER']['VALUE'] == "Женщина") { ?>
                            <a style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/icon/female-new.svg')" class="doctor-card__img-link doctors-list-item__img-photo photo-back-image photo-back-image-contain" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                            </a>
                        <? } ?>
                        <div class="doctors-list-item__img-info">
                            <? if (CModule::IncludeModule('api.reviews')) {
                                $arRaing = CApiReviews::getElementRating($arItem['ID']);
                            } ?>
                            <div class="doctors-list-item__img-info-ratings">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='1') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                                     alt="star">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='2') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                                     alt="star">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='3') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                                     alt="star">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='4') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                                     alt="star">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/<? if ($arRaing['RATING']>='5') { ?>filled-star.svg<? } else { ?>unfilled-star.svg<? } ?>"
                                     alt="star">
                            </div>
                            <p class="doctors-list-item__img-info-commend"><?=$arRaing['COUNT']?> пациентов записались к врачу через <span class="commend-logo"></span><a href="#full-feedback">Все отзывы о враче</a></p>
                        </div>
                    </div>
                    <div class="doctors-list-item__description">
                        <? $res = CIBlockSection::GetByID($arItem['PROPERTIES']['SPECIALIZATION_MAIN']['VALUE']);
                        if ($ar_res = $res->GetNext()) {
                            ?>
                            <p class="doctors-list-item__description-position"><?= $ar_res['NAME'] ?></p>
                        <? } ?>
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                            <p class="doctors-list-item__description-title"><?= $arItem['NAME'] ?></p>
                        </a>
                        <? if ($arItem["PROPERTIES"]["STANDING"]["VALUE"]): ?>
                            <p class="doctors-list-item__description-exp">
                                Стаж <?= $arItem['PROPERTIES']['STANDING']['VALUE'] ?></p>
                        <? endif; ?>
                        <? if ($arItem["PROPERTIES"]["SCIENCE_DEGREE"]["VALUE"] && $arItem["PROPERTIES"]["SCIENCE_DEGREE"]["VALUE"]!='-' ): ?>
                            <p class="doctors-list-item__description-degree"><?= $arItem['PROPERTIES']['SCIENCE_DEGREE']['VALUE'] ?></p>
                        <? endif; ?>
                        <? if ($arItem["PROPERTIES"]["PRICE"]["VALUE"]): ?>
                            <p class="doctors-list-item__description-price"><?= $arItem['PROPERTIES']['PRICE']['VALUE'] ?>
                                Р<span>Цена приема в клинике</span></p>
                        <? endif; ?>
                        <? if ($arItem["PROPERTIES"]["PHONE"]["VALUE"]): ?>
                            <a href="tel:<?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?>"
                               class="doctors-list-item__description-phone"><span></span><?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?>
                            </a>
                        <? endif; ?>
                        <?
                        $FORM_ID = 4;
                        $arFilter = array(
                        );
                        $arFilter["FIELDS"] = array();

                        $rsResults = CFormResult::GetList($FORM_ID,
                            ($by="s_timestamp"),
                            ($order="desc"),
                            $arFilter,
                            $is_filtered,
                            "Y",
                            10);
                        $countRow = $rsResults->result->num_rows;
                        $countRecords = 0;
                        if($countRow!=0) {
                            while ($arResult_ = $rsResults->Fetch()) {
                                $RESULT_ID = $arResult_['ID']; // ID результата
                                $STATUS_ID = $arResult_['STATUS_ID']; // ID статуса

                                // получим данные по всем вопросам
                                $arAnswer = CFormResult::GetDataByID(
                                    $RESULT_ID,
                                    array(),
                                    $arResult_,
                                    $arAnswer2);
                                if(explode('/',$arAnswer['SIMPLE_RECORD_PHONE'][0]['USER_TEXT'])[0] == $arItem['ID']){
                                    $countRecords++;
                                }
                            }
                        }?>
                        <?if($countRecords>0){?>
                            <span class="doctors-list-item__description-counts">Всего записалось <?= $countRecords?> человек(а)</span>
                        <?}else{?>
                            <span class="doctors-list-item__description-counts">К этому врачу еще никто не записался</span>
                        <?}?>                        <? /*<div class="doctors-list-item-favorites"></div>*/ ?>
                    </div>
                </div>
                <div class="flex-right">
                    <div class="doctors-list-item__description <?if(!empty($arItem["PROPERTIES"]["NOT_ON"]["VALUE"])){?>reception-none<?}?>">
                        <div class="adapt">
                            <div>
                                <? foreach ($arItem["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"] as $item) {
                                    $date = explode('/', $item);
                                    $res = CIBlockElement::GetByID($date[2]);
                                    if ($ar_res = $res->GetNext())
                                        $day[] = $date[0];
                                    $times[] = ["TIME" => $date[1], "DAY" => $date[0], "CLINIC" => $ar_res['NAME'], "CLINIC_ID" => $ar_res['ID']];
                                } ?>
                                <? usort($times, function ($a, $b) {
                                    return ($a['TIME'] - $b['TIME']);
                                }); ?>
                                <? $days = array(1 => 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье');
                                $begin = new DateTime(date('Y-m-d'));
                                $end = new DateTime(date('Y-m-d', strtotime('+3 days')));
                                $end = $end->modify('+1 day');

                                $interval = new DateInterval('P1D');
                                $daterange = new DatePeriod($begin, $interval, $end);
                                ?>
                                <? if ($arItem["PROPERTIES"]["RECEPTION_SCHEDULE"]["VALUE"] && empty($arItem["PROPERTIES"]["NOT_ON"]["VALUE"])): ?>
                                    <p class="doctors-list-item_timing">Выберите время приема для записи онлайн</p>
                                    <ul class="doctors-list-item__days-list">
                                        <? foreach ($daterange as $date) { ?>
                                            <? if ($date->format("Ymd") == date('Ymd')) {
                                                $selectDate = $date->format("d.m.Y");
                                                $selectDay = date($days[$date->format("N")]);
                                            } ?>
                                            <li class="select-doctor-day_<?= $arItem['ID'] ?> doctors-list-item__days-list-item <? if (!in_array($days[$date->format("N")], $day)) { ?>pass<? } elseif (in_array($days[$date->format("N")], $day) && $date->format("Ymd") == date('Ymd')) { ?>active<? } ?>"
                                                data-date="<?= date($date->format("d.m.Y")) ?>"
                                                data-day="<?= date($days[$date->format("N")]) ?>"
                                                data-doctor="<?= $arItem['ID'] ?>"><?= date($days[$date->format("N")]); ?>, <?= date($date->format("d")); ?></li>
                                        <? } ?>
                                    </ul>
                                    <?include $_SERVER['DOCUMENT_ROOT'].'/include/result_record_in_form_list.php';?>
                                    <ul class="doctors-list-item__worktimming-list"
                                        id="doctor-day-block-ajax_<?= $arItem['ID'] ?>">
                                        <?
                                        $i = 0;
                                        foreach ($times as $item) {
                                            if ($item['DAY'] == $selectDay && $item['CLINIC']!=NULL) {
                                                $i++;
                                                $fullDate = $selectDay . ', ' . $selectDate . '/' . $item['TIME']; ?>
                                                <li class="doctors-list-item__worktimming-list-item <?if (in_array($fullDate, $record)) {?>closed<?}?>" title="<?= $item['CLINIC'] ?>">
                                                    <a href="<?if (in_array($fullDate, $record)){?>javascript:void(0);<?}else {?><?= $arItem['DETAIL_PAGE_URL'] ?>?clinic=<?= $item['CLINIC'] ?>&time=<?= $selectDate ?> <?= $item['TIME'] ?><?}?>"><?= $item['TIME']?></a>
                                                </li>
                                            <?
                                            }
                                        } ?>
                                        <? if ($i == 0) { ?>
                                            <h6 style="color:red;">В этот день нет приема</h6>
                                        <? } ?>
                                    </ul>
                                <? endif; ?>
                            </div>
                            <div>
                                <? if ($arItem["PROPERTIES"]["CLINIK"]["VALUE"]) { ?>
                                    <? foreach ($arItem["PROPERTIES"]["CLINIK"]["VALUE"] as $item) { ?>
                                        <? $res = CIBlockElement::GetByID($item);
                                        if ($ar_res = $res->GetNext()) {
                                            ?>
                                            <a href="<?= $ar_res['DETAIL_PAGE_URL'] ?>"><p
                                                        class="doctors-list-item__clinic-name"><?= $ar_res['NAME'] ?></p>
                                            </a>
                                            <? break;
                                        } ?>

                                    <? } ?>
                                <? } else { ?>
                                    <p class="doctor-card__description-address-title">Адрес</p>
                                <? } ?>
                                <? if ($arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0] && count(explode('/',$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0]))>1){?>
                                    <p class="doctor-card__clinic-adress">
                                        <?if(explode('/',$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0])[3]!=''){
                                            echo explode('/',$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0])[3];?>,
                                        <?}?>
                                        <?=explode('/',$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0])[0]?>,
                                        <?if(explode('/',$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0])[2]!=''){
                                            echo explode('/',$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0])[2];?>,
                                        <?}?>
                                        <?=explode('/',$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0])[1]?>
                                    </p>
                                <? }elseif ($arItem["PROPERTIES"]["CITY"]["VALUE"][0]){?>
                                    <p class="doctor-card__clinic-adress">
                                        <? $res = CIBlockSection::GetByID($arItem["PROPERTIES"]["CITY"]["VALUE"][0]);
                                        if ($ar_res = $res->GetNext()) {echo $ar_res['NAME'];}?>
                                        <?if(count(explode('/',$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0]))==1){echo ' '.$arItem["PROPERTIES"]["RECEPTION_ADDRESSES"]["VALUE"][0];}?>
                                    </p>
                                <?}?>
                                <? if ($arItem["PROPERTIES"]["METRO"]["VALUE"]): ?>
                                    <ul class="doctors-list-item__metro-list">
                                        <? foreach ($arItem["PROPERTIES"]["METRO"]["VALUE"] as $key => $item) { ?>
                                            <? $res = CIBlockElement::GetByID($item);
                                            if ($ar_res = $res->GetNext()) {
                                                ?>
                                                <li class="doctors-list-item_metro-list-item <? if (($key % 2) == 0 && $key != 0) {
                                                    ?>metro1<? } elseif (($key % 3) == 0 || $key === 0) {
                                                    ?>metro2<? } else {
                                                    ?>metro3<? } ?>"><?= $ar_res['NAME'] ?></li>
                                            <? } ?>
                                        <? } ?>
                                    </ul>
                                <? endif; ?>
                            </div>
                        </div>
                        <ul class="doctors-list-item_options">
                            <? if ($arItem["PROPERTIES"]["DIAGNOSTICS"]["VALUE"] == 'Y'): ?>
                                <li class="doctors-list-item_options-list-item"><?= $arItem["PROPERTIES"]["DIAGNOSTICS"]["NAME"] ?></li>
                            <? endif; ?>
                            <? if ($arItem["PROPERTIES"]["CHILDREN_DOCTOR"]["VALUE"] == 'Y'): ?>
                                <li class="doctors-list-item_options-list-item"><?= $arItem["PROPERTIES"]["CHILDREN_DOCTOR"]["NAME"] ?></li>
                            <? endif; ?>
                            <? if ($arItem["PROPERTIES"]["DMC"]["VALUE"] == 'Y'): ?>
                                <li class="doctors-list-item_options-list-item"><?= $arItem["PROPERTIES"]["DMC"]["NAME"] ?></li>
                            <? endif; ?>
                            <? if ($arItem["PROPERTIES"]["UMC"]["VALUE"] == 'Y'): ?>
                                <li class="doctors-list-item_options-list-item"><?= $arItem["PROPERTIES"]["UMC"]["NAME"] ?></li>
                            <? endif; ?>
                            <? if ($arItem["PROPERTIES"]["ONLINE"]["VALUE"] == 'Y'): ?>
                                <li class="doctors-list-item_options-list-item"><?= $arItem["PROPERTIES"]["ONLINE"]["NAME"] ?></li>
                            <? endif; ?>
                            <? if ($arItem["PROPERTIES"]["DEPARTURE_HOUSE"]["VALUE"] == 'Y'): ?>
                                <li class="doctors-list-item_options-list-item"><?= $arItem["PROPERTIES"]["DEPARTURE_HOUSE"]["NAME"] ?></li>
                            <? endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $(".select-doctor-day_<?=$arItem['ID']?>").click(function () {
                        let day = $(this).data('day');
                        let doctor = $(this).data('doctor');
                        let date = $(this).data('date');
                        let id = <?=$arItem['ID']?>;
                        let block = $('#doctor-day-block-ajax_' + id);
                        $.ajax({
                            type: "POST",
                            url: '/ajax/ajax_time.php',
                            data: {day: day, doctor: doctor, date: date},
                            success: function (data) {
                                // Вывод текста результата отправки
                                $(block).html(data);
                            }
                        });
                        return false;
                    });
                });
            </script>
        <? endforeach; ?>
    </div>
</section>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>
<?}?>