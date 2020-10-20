<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $clinicName, $clinickId, $clinicMail, $clinicPhone;
$week = array(1 => 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье');
$_monthsList = array(
    "01"=>"Января","02"=>"Февраля","03"=>"Марта",
    "04"=>"Апреля","05"=>"Мая", "06"=>"Июня",
    "07"=>"Июля","08"=>"Августя","09"=>"Сентября",
    "10"=>"Октября","11"=>"Ноября","12"=>"Декабря");
$begin = new DateTime(date('Y-m-d'));
if (!empty($period)) {
    $end = new DateTime( date('Y-m-d', strtotime('+'.$period.' days')));
}else{
    $end = new DateTime( date('Y-m-d', strtotime('+14 days')));
}
$end = $end->modify('+1 day');

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval, $end);

 if ($arResult["isFormErrors"] == "Y"): ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>

<?= $arResult["FORM_NOTE"] ?>

<? if ($arResult["isFormNote"] != "Y") {?>
    <?= $arResult["FORM_HEADER"] ?>
    <?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {?>
        <?if($arQuestion["CAPTION"]=="Услуга"){?>
            <div class="reception-select-group">
                <div>
                <label><?= $arQuestion["CAPTION"] ?>
                    <input type="text" readonly id="option_service" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=$_COOKIE['service']?>" size="0">
                </label>
                </div>
            </div>
        <?}elseif ($arQuestion["CAPTION"] == "Дата записи") {?>
            <div class="reception-select-group">
                <div>
                    <label><?= $arQuestion["CAPTION"] ?>
                        <select name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
                            <?foreach($daterange as $date){?>
                                <?if ($date->format("Ymd") == date('Ymd')){
                                    $selectDate = $date->format("d.m.Y");
                                    $selectDay = date($days[$date->format("N")]);
                                }?>
                                 <option value='<?= date( $days[$date->format("N")]);?><?= date($date->format("d.m.Y"));?>'><?if ($date->format("Ymd") == date('Ymd')){?>Сегодня<?}else{?><?= date( $week[$date->format("N")]);?><?}?> <?= date($date->format("d.m.Y"));?></option>
                            <?}?>
                        </select>
                    </label>
                </div>
            </div>
        <?}elseif($arQuestion["CAPTION"] != "Услуга" && $arQuestion["CAPTION"] != "Дата записи" && $arQuestion["CAPTION"]!="E-mail клиники" && $arQuestion["CAPTION"]!="ID/Название клиники" && $arQuestion["CAPTION"]!="Телефон клиники"){?>
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
            <?}elseif ($arQuestion["CAPTION"]=="E-mail клиники"){?>
                <input type="hidden" value="<?=$clinicMail?>" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" size="0">
            <?}elseif ($arQuestion["CAPTION"]=="ID/Название клиники"){?>
                <input type="hidden" value="<?=$clinicName.'/'.$clinickId?>"  name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" size="0">
            <?}elseif ($arQuestion["CAPTION"]=="Телефон клиники"){?>
                <input type="hidden" value="<?=$clinicPhone?>"  name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" size="0">
            <?}?>
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
