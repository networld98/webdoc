<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="personal-cabinet-content__my-profile personal-cabinet-content-auth">
    <div class="personal-cabinet-content__my-profile__info">
        <div class="personal-cabinet-content__my-profile__info-form">
        <?if($arResult["SHOW_SMS_FIELD"] == true)
        {
            CJSCore::Init('phone_auth');
        }
        ?>
        <div class="bx-auth">
            <div class="auth-popup__header text-center">Регистрация</div>
        <?
        ShowMessage($arParams["~AUTH_RESULT"]);
        ?>
        <?if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
            <p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
        <?endif;?>

        <?if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
            <p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
        <?endif?>
        <noindex>
        <div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

        <div id="bx_register_resend"></div>


        <form method="post" action="/lc/finance/" name="bform" enctype="multipart/form-data">
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="REGISTRATION" />

        <table class="data-table bx-registration-table">
        <!--	<thead>-->
        <!--		<tr>-->
        <!--			<td colspan="2"><b>--><?//=GetMessage("AUTH_REGISTER")?><!--</b></td>-->
        <!--		</tr>-->
        <!--	</thead>-->
            <tbody>
            <?// ********************* User properties ***************************************************?>
                <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
                    <tr id="<?=$arUserField['FIELD_NAME']?>"><td>
                        <?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;
                        ?><?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:system.field.edit",
                            $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                            array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?>
                    </td></tr>
                <?endforeach;?>
                <tr class="doctor-type">
                    <td><?=GetMessage("AUTH_NAME")?></td>
                    <td><input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="bx-auth-input" /></td>
                </tr>
                <tr class="doctor-type">
                    <td><?=GetMessage("AUTH_LAST_NAME")?></td>
                    <td><input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="bx-auth-input" /></td>
                </tr>
                <tr>
                    <td><span class="starrequired">*</span><?=GetMessage("AUTH_LOGIN_MIN")?></td>
                    <td><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" class="bx-auth-input bx-register-phone" /></td>
                </tr>
                <tr>
                    <td><span class="starrequired">*</span><?=GetMessage("AUTH_PASSWORD_REQ")?></td>
                    <td><input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
                    <?if($arResult["SECURE_AUTH"]):?>
                        <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                            <div class="bx-auth-secure-icon"></div>
                        </span>
                        <noscript>
                        <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                            <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                        </span>
                        </noscript>
                    <script type="text/javascript">
                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                    </script>
                    <?endif?>
                    </td>
                </tr>
                <tr>
                    <td><span class="starrequired">*</span><?=GetMessage("AUTH_CONFIRM")?></td>
                    <td><input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" /></td>
                </tr>

                <tr>
                    <td><span class="starrequired">*</span><?=GetMessage("AUTH_EMAIL")?></td>
                    <td><input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="bx-auth-input" /></td>
                </tr>

        <?// ******************** /User properties ***************************************************

            /* CAPTCHA */
            if ($arResult["USE_CAPTCHA"] == "Y")
            {
                ?>
                <tr>
                    <td colspan="2"><b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                    </td>
                </tr>
                <tr>
                    <td><span class="starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:</td>
                    <td><input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" /></td>
                </tr>
                <?
            }
            /* CAPTCHA */
            ?>
                <tr>
                    <td></td>
                    <td>
                        <?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
                            array(
                                "ID" => COption::getOptionString("main", "new_user_agreement", ""),
                                "IS_CHECKED" => "Y",
                                "AUTO_SAVE" => "N",
                                "IS_LOADED" => "Y",
                                "ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
                                "ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
                                "INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
                                "REPLACE" => array(
                                    "button_caption" => GetMessage("AUTH_REGISTER"),
                                    "fields" => array(
                                        rtrim(GetMessage("AUTH_NAME"), ":"),
                                        rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
                                        rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
                                        rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
                                        rtrim(GetMessage("AUTH_EMAIL"), ":"),
                                    )
                                ),
                            )
                        );?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" /></td>
                </tr>
            </tfoot>
        </table>

        </form>

        <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
        <p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

        <p><a style="color:#9DD4B3;" href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a></p>

        <script type="text/javascript">
        document.bform.USER_NAME.focus();
            $(document).ready(function () {
                $(".doctor-type").hide();
                let type = 6;
                $(`form[name=${document.bform.name}]`).trigger('reset');
                $('input[value=6]').parent('label').css({'color':'#fff','background': '#32B4C3'});
                $('input[name=UF_NAME_CLINIC]').keyup(function () {
                    let clinic = $(this).val();
                    $('input[name=USER_NAME]').val(clinic);
                });
                $('input[name=UF_TYPE_USER]').change(function () {
                    type = $(this).val();
                   $('input[name=UF_TYPE_USER]').parent('label').removeAttr("style");
                   $(this).parent('label').css({'color':'#fff','background': '#32B4C3'});
                   if(type==6){
                       $(".doctor-type").hide();
                       $("#UF_NAME_CLINIC").show();
                       $("#UF_NAME_CLINIC").find('input').val('');
                   }else{
                       $(".doctor-type").show();
                       $("#UF_NAME_CLINIC").hide();
                       $("#UF_NAME_CLINIC").find('input').val('-');

                   }
                })
            })
        </script>
            <style>
                .enumeration.field-wrap .field-item:first-child, .doctor-type{
                    display: none;
                }
            </style>
        </noindex>
        </div>
        </div>
    </div>
</div>