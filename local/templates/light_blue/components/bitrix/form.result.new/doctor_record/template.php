<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $doctorEmail;
global $doctorPhone;
global $doctorSpecialization;
global $doctorClinic;
global $noneClinic;
global $doctorName;
global $doctorTime;
global $doctorId;
global $period;
$timeForId = $doctorId;
//данные для выборки записей из результатов формы
CModule::IncludeModule("form");
if ($arResult['ID'] == NULL) {
    $arResult['ID'] = $_POST['doctor'];
}
$FORM_ID = 4;
$arFilter = array();
$result = CFormResult::GetList($FORM_ID, $by = 's_id', $order = 'asc', $arFilter, $is_filtered, 'N', false);
while ($arRes = $result->Fetch()) {
    $arID[] = $arRes['ID'];
}
CForm::GetResultAnswerArray($FORM_ID,
    $arrColumns,
    $arrAnswers,
    $arrAnswersVarname,
    array("RESULT_ID" => $arID));
foreach ($arrAnswersVarname as $answer) {
    $strDoctor = explode('/', $answer['SIMPLE_RECORD_PHONE']['0']['USER_TEXT']);
    if ($strDoctor[0] == $doctorId) {
        $record[] = $answer['SIMPLE_RECORD_2']['0']['USER_TEXT'];
    }
}
$week = array(1 => 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье');
$begin = new DateTime(date('Y-m-d'));
if (!empty($period)) {
    $end = new DateTime( date('Y-m-d', strtotime('+'.$period.' days')));
}else{
    $end = new DateTime( date('Y-m-d', strtotime('+14 days')));
}
$end = $end->modify('+1 day');

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval, $end);
?>
<? foreach ($doctorTime as $item) {
    $str = explode('/', $item);
    $timeinClinic[] = $str[2];
} ?>
<? if ($arResult["isFormErrors"] == "Y"): ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>

<?= $arResult["FORM_NOTE"] ?>

<? if ($arResult["isFormNote"] != "Y") {
    ?>
    <?= $arResult["FORM_HEADER"] ?>
    <?
    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
        ?>
        <? if ($arQuestion["CAPTION"] == "Специальность") {
            ?>
        <div class="reception-select-group">
            <div>
            <label><?= $arQuestion["CAPTION"] ?>
                <select name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
                    <? foreach ($doctorSpecialization as $item):?>
                        <option value="<?= $item ?>"><?= $item ?></option>
                    <? endforeach ?>
                </select>
            </label>
            </div>
        </div>
        <? } elseif ($arQuestion["CAPTION"] == "Клиника" && $noneClinic == NULL) {
            ?>
            <div class="reception-select-group">
                <div>
            <label for="selectClinic"><?= $arQuestion["CAPTION"] ?>
                <select id="selectClinic" name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
                    <? foreach ($doctorClinic as $key => $item) {
                        $timeForIdNext = NULL;
                        if (in_array($item['ID'], $timeinClinic)) {
                            $ClinicName = $item['NAME'];
                            $rsUser = CUser::GetByLogin('+' . $item['PHONE']);
                            $arUser = $rsUser->Fetch();
                            $timeForIdNext = $item['ID'];
                            if ($key == 0) {
                                $doctorEmail = $arUser['EMAIL'];
                                $clinicPhone = $arUser['LOGIN'];
                                $timeForId = $item['ID'];
                            }
                            if ($arUser['EMAIL'] == NULL) {
                                $arUser['EMAIL'] = 'Нет почты';
                            }
                            if ($arUser['LOGIN'] == NULL) {
                                $arUser['LOGIN'] = 'Нет номера';
                            }
                            ?>
                            <option data-doctor="<?=$doctorId?>" data-period="<?=$period?>" data-email="<?= $arUser['EMAIL'] ?>" data-id="<?= $timeForIdNext ?>"
                                    data-phone="<?= $arUser['LOGIN'] ?>"
                                    value="<?= $item['NAME'] ?>/<?= $timeForIdNext ?>"><?= $item['NAME'] ?></option>
                            <?
                        }
                    } ?>
                </select>
            </label>
                </div>
            </div>
        <? } elseif ($arQuestion["CAPTION"] == "Дата и время приёма") {
            ?>
            <? foreach ($doctorTime as $item) {
                $str = explode('/', $item);
                if ($str[2] == $timeForId) {
                    $dayinClinic[] = $str[0];
                }
            } ?>
            <div class="reception-select-group">
                <div class="reception-select-group__left">
            <label><?= $arQuestion["CAPTION"] ?>
                <select id="selectDay">
                    <? foreach ($daterange as $key => $date) {
                        ?>
                        <? if (in_array(date($week[$date->format("N")]), $dayinClinic)) {
                            ?>
                            <? if ($dayOfTime == NULL && $dateOfTime == NULL) {
                                $dateOfTime = date($date->format("d.m.Y"));
                                $dayOfTime = date($week[$date->format("N")]);
                            } ?>
                            <option data-doctor="<?=$doctorId?>" data-id="<?= $timeForId ?>" data-day="<?= date($week[$date->format("N")]) ?>"
                                    value="<?= date($week[$date->format("N")]); ?>, <?= date($date->format("d.m.Y")); ?>"><?= date($week[$date->format("N")]); ?>
                                , <?= date($date->format("d.m.Y")); ?></option>
                        <? } ?>
                    <? } ?>
                </select>
                </div>
                <div class="eception-select-group__right">
                <select id="selectTime">
                    <? foreach ($doctorTime as $time) {
                        $str = explode('/', $time); ?>
                        <? if ($str[0] == $dayOfTime) {
                            $fullDate = $dayOfTime . ', ' . $dateOfTime . '/' . $str[1];?>
                            <option <? if (in_array($fullDate, $record)){?>disabled<?}?> value="<?= $str[1] ?>"><?= $str[1] ?></option>
                        <? } ?>
                    <? } ?>
                </select>
                <input type="hidden" id="fullTime" name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
                       value="<?= $week[0] ?>" size="0">
            </label>
                </div>
            </div>
        <? } elseif ($arQuestion["CAPTION"] != "Дата и время приёма" && $arQuestion["CAPTION"] != "E-mail врача/клиники" && $arQuestion["CAPTION"] != "Специальность" && $arQuestion["CAPTION"] != "Клиника" && $arQuestion["CAPTION"] != "ID/ФИО/Телефон врача" && $arQuestion["CAPTION"] != "Телефон клиники") {
            ?>
            <div class="reception-select-group">
                <div>
                <? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                    <span class="error-fld"
                          title="<?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>"></span>
                <? endif; ?>
                <label><?= $arQuestion["CAPTION"] ?>
                    <?= $arQuestion["HTML_CODE"] ?>
                </label>
                </div>
            </div>
        <? } elseif ($arQuestion["CAPTION"] == "E-mail врача/клиники") {
            ?>
            <input type="hidden" id="option_mail" name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
                   value="<?= $doctorEmail ?>" size="0">
        <? } elseif ($arQuestion["CAPTION"] == "ID/ФИО/Телефон врача") {
            ?>
            <input type="hidden" name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
                   value="<?= $doctorId ?>/<? if ($noneClinic == NULL) {
                       echo $doctorName . '/';
                   } ?><?= $doctorPhone ?>" size="0">
        <? } elseif ($arQuestion["CAPTION"] == "Телефон клиники") {
            ?>
            <input type="hidden" id="option_phone" name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
                   value="<?= $clinicPhone ?>" size="0">
        <? } elseif ($arQuestion["CAPTION"] == "ID врача") {
            ?>
            <input type="hidden" name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>" value="" size="0">
        <? } ?>
        <?
    } //endwhile
    ?>
    <?
    if ($arResult["isUseCaptcha"] == "Y") {
        ?>
        <input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"/>
        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"
             width="180" height="40"/><br>
        <?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?><?= $arResult["REQUIRED_SIGN"]; ?><br>
        <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext"/>
        <?
    } // isUseCaptcha
    ?>

    <div class="reception-select-group">
        <div class="reception-select-group__left">
            <input <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit"
                                                                                              name="web_form_submit"
                                                                                              value="<?= htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"/>
        </div>

        <div class="reception-select-group__right">
            <p class="mess-popup__desc">Нажимая «Отправить», я принимаю <a href="">условия пользовательского соглашения и даю
                    согласие</a> на обработку персональных данных.</p>
        </div>
    </div>

    <?= $arResult["FORM_FOOTER"] ?>
    <?
} //endif (isFormNote)
?>
