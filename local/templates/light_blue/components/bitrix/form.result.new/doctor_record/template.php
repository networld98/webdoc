<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $doctorEmail;
global $doctorPhone;
global $doctorSpecialization;
global $doctorClinic;
global $noneClinic;
global $doctorName;
global $doctorTime;
global $doctorId;
$timeForId = $doctorId;
$week = array('Понедельник' , 'Вторник' , 'Среда' , 'Четверг' , 'Пятница' , 'Суббота' , 'Воскресенье' );
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
    <?foreach($doctorTime as  $item){
    $str = explode('/',$item);
        $timeinClinic[] = $str[2];
    }?>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	    ?>
            <?if($arQuestion["CAPTION"]=="Специальность"){?>
                <label><?=$arQuestion["CAPTION"]?>
                    <select name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>">
                        <?foreach($doctorSpecialization as $item):?>
                            <option value="<?=$item?>"><?=$item?></option>
                        <?endforeach?>
                    </select>
                </label>
            <?}elseif($arQuestion["CAPTION"]=="Клиника" && $noneClinic==NULL){?>
                <label><?=$arQuestion["CAPTION"]?>
                    <select id="selectClinic" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>">
                        <?foreach($doctorClinic as $key => $item) {
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
                                <option data-email="<?= $arUser['EMAIL'] ?>" data-id="<?= $timeForIdNext ?>"
                                        data-phone="<?= $arUser['LOGIN'] ?>"
                                        value="<?= $item['NAME'] ?>"><?= $item['NAME'] ?></option>
                            <?
                            }
                        }?>
                    </select>
                </label>
        <?}elseif($arQuestion["CAPTION"]=="Дата и время приёма"){?>
            <label><?=$arQuestion["CAPTION"]?>
                <select id="selectTime" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>">
                    <?
                    foreach($doctorTime as $key => $item){
                        $str = explode('/',$item);
                        if( $str[2] == $timeForId ){
                            $timeForm[$str[0]][] = $str[1];
                        }
                      }
                      foreach ($week as $day){
                          if($timeForm[$day]!=NULL){
                              if (is_array($timeForm[$day])) {
                                  foreach ($timeForm[$day] as $time){
                                      $sortTimeForm[] = $day.' '.$time;
                                  }
                              }else{
                                  $sortTimeForm[] = $day.'_'.$timeForm[$day];
                              }
                          }
                      }
                      ?>
                    <?foreach ($sortTimeForm as $item){?>
                        <option value="<?=$item?>"><?=$item?></option>
                    <?}?>
                </select>
            </label>
            <?}elseif($arQuestion["CAPTION"]!="Дата и время приёма" && $arQuestion["CAPTION"]!="E-mail врача/клиники" && $arQuestion["CAPTION"]!="Специальность" && $arQuestion["CAPTION"]!="Клиника" && $arQuestion["CAPTION"]!="ФИО/Телефон врача" && $arQuestion["CAPTION"]!="Телефон клиники"){?>
            <div>
                <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                    <span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
                <?endif;?>
                <label><?=$arQuestion["CAPTION"]?>
                <?=$arQuestion["HTML_CODE"]?>
                </label>
            </div>
    <?}elseif($arQuestion["CAPTION"]=="E-mail врача/клиники"){?>
        <input type="hidden" id="option_mail" class="inputtext" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=$doctorEmail?>" size="0">
    <?}elseif($arQuestion["CAPTION"]=="ФИО/Телефон врача"){?>
        <input type="hidden" class="inputtext" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?if($noneClinic==NULL){echo $doctorName.'/';}?><?=$doctorPhone?>" size="0">
    <?}elseif($arQuestion["CAPTION"]=="Телефон клиники"){?>
        <input type="hidden" id="option_phone" class="inputtext" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=$clinicPhone?>" size="0">
        <?}?>
	<?
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
        <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /><br>
        <?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?><br>
        <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
    <?
} // isUseCaptcha
?>
    <p class="mess-popup__desc">Нажимая «Отправить», я принимаю <a href="">условия пользовательского соглашения и даю согласие</a> на обработку персональных данных.</p>
    <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
<script>
    $(document).ready(function () {
        $("#selectClinic").change(function () {
            let id = $(this).find('option:selected').data('id');
            let doc = <?=$doctorId?>;
            let phone = $(this).find('option:selected').data('phone');
            let email = $(this).find('option:selected').data('email');
            let block = $('#selectTime');
            $('#option_phone').val(phone);
            $('#option_mail').val(email);
            $.ajax({
                type: "POST",
                url: '/ajax/ajax_time_form.php',
                data: {id: id, doctor: doc},
                success: function (data) {
                    // Вывод текста результата отправки
                    $(block).html(data);
                }
            });
            return false;
        });
    });
</script>
