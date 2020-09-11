<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $doctorEmail;
global $doctorSpecialization;
global $doctorClinic;
global $noneClinic;
?>
<?function selectForm($name,$data){?>
    <select name="<?=$name?>">
    <?foreach($data as $item):?>
        <option value="<?=$item?>"><?=$item?></option>
    <?endforeach?>
    </select>
<?}?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	    ?>
            <?if($arQuestion["CAPTION"]=="Специальность"){?>
                <label><?=$arQuestion["CAPTION"]?>
                    <?selectForm('form_text_'.$arQuestion['STRUCTURE'][0]['ID'],$doctorSpecialization)?>
                </label>
            <?}elseif($arQuestion["CAPTION"]=="Клиника"){?>
                <label><?=$arQuestion["CAPTION"]?>
                    <?selectForm('form_text_'.$arQuestion['STRUCTURE'][0]['ID'],$doctorClinic)?>
                </label>
            <?}elseif($arQuestion["CAPTION"]!="E-mail врача" && $arQuestion["CAPTION"]!="Специальность" && $arQuestion["CAPTION"]!="Клиника"){?>
            <div>
                <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                    <span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
                <?endif;?>
                <label><?=$arQuestion["CAPTION"]?>
                <?=$arQuestion["HTML_CODE"]?>
                </label>
            </div>
            <?}else{?>
            <input type="hidden" class="inputtext" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=$doctorEmail?>" size="0">
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