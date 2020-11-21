<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Документы");

CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

$arFilter = Array("IBLOCK_ID"=>array(9,10), "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
$arFields = $ob->GetFields();
$arProps = $ob->GetProperties();
$idClient = $arFields['ID'];
}
?>
<style>
    .completion-btn {
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 21px;
        color: #000000;
        background: #9DD4B3;
        border-radius: 5px;
        display: block;
        transition: 0.3s;
        border: 2px solid #9DD4B3;
        outline: none;
        padding: 2px 10px;
        margin: 5px 0;
    }
    #invoice .print-btn {
        border-radius: 5px;
        background: #9DD4B3;
        cursor: pointer;
        margin: 20px 0 0 0;
        display: inline-block;
        padding: 12px 20px;
        border: 2px solid #9DD4B3;
        font-style: normal;
        font-weight: normal;
        font-size: 18px;
        line-height: 21px;
    }
    #invoice .print-btn:hover, .completion-btn:hover {
        color: #9DD4B3;
        background: transparent;
        transition: 0.3s;
        border: 2px solid #9DD4B3;
    }
    .completion-btn:disabled {
        color: #cbc9cb;
        background: transparent;
        transition: 0.3s;
        border: 2px solid #cbc9cb;
    }
    tr.active {
        background-color: #f1f1f1;
        border-top: 1px solid #bfbebe;
        border-bottom: 1px solid #bfbebe;
    }
    @media print {
        .no-print, #invoice .print-btn, .title-h2, .header, .footer, .personal-cabinet-menu, #panel, .personal-cabinet-content__schedule-page__block > .border, personal-cabinet-content__schedule-page__block > h5 {
            display:none;
        }
        .media-print-desktop {
            display: block;
        }
    }
</style>
<? include '../menu.php';?>
<?if($idClient !=NULL){?>
    <div class="personal-cabinet-content__price-page">
        <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
        <div class="personal-cabinet-content__schedule-page__block no-border-padding">
            <h5 class="no-print">Счета</h5>
                <table class="border print-table" width="100%">
                    <tbody>
                    <tr valign="middle" align="center">
                        <td><b>Статус</b></td>
                        <td><b>Номер и дата счёта</b></td>
                        <td><b>Сумма счёта, руб.</b></td>
                        <td><b>Акт</b></td>
                    </tr>
                    <?$arSelect = Array("ID","NAME", "PROPERTY_SERVICE", "PROPERTY_SUM", "PROPERTY_PAY", "PROPERTY_FOR");
                    $arFilter = Array("IBLOCK_ID"=>24);
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                    $i=0;
                    while($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();?>
                         <?if ($arFields['PROPERTY_FOR_VALUE'] == $arProps['OFFICIAL_NAME']['VALUE']){
                            $i++;?>
                            <tr valign="middle" align="center">
                              <?if ($arFields['PROPERTY_PAY_VALUE'] ){?>
                                <form id="form_completion_<?=$arFields['ID']?>" name="form_completion_<?=$arFields['ID']?>" action="" method="post" class="form-completiom">
                                    <input type="hidden" name="CLIENT" value="<?=$arProps['OFFICIAL_NAME']['VALUE']?>, ИНН: <?=$arProps['INN']['VALUE']?>, <?=$arProps['URADRESS']['VALUE']?>">
                                    <input type="hidden" name="NAME" value="<?=$arProps['OFFICIAL_NAME']['VALUE']?>">
                                    <input type="hidden" name="PHONE" value="<?=$arUser['LOGIN']?>">
                                    <input type="hidden" name="EMAIL" value="<?=$arUser['EMAIL']?>">
                                    <input type="hidden" name="DOC" value="<?=$arFields['NAME']?>">
                                    <input type="hidden" name="OPISANIE" value="<?=$arFields['PROPERTY_SERVICE_VALUE']?>">
                                    <input type="hidden" name="SUM" value="<?=$arFields['PROPERTY_SUM_VALUE']?>">
                                <?}?>
                                    <td align="center">
                                        <?if ($arFields['PROPERTY_PAY_VALUE']){?>
                                            <span style="color:green">Оплачен</span>
                                        <?}else{?>
                                            <span style="color:red">Не оплачен</span>
                                        <?}?>
                                    </td>
                                    <td>
                                        <?=$arFields['NAME']?></td>
                                    <td>
                                        <?=$arFields['PROPERTY_SUM_VALUE']?>
                                    </td>
                                    <td>
                                        <?if ($arFields['PROPERTY_PAY_VALUE']){?>
                                            <button type="submit" class="completion-btn" id="completion-btn-<?=$arFields['ID']?>">Сформировать акт</button>
                                        <?}else{?>
                                            <button disabled class="completion-btn">Сформировать акт</button>
                                        <?}?>
                                    </td>
                              <?if ($arFields['PROPERTY_PAY_VALUE']){?>
                                </form>
                                <script>
                                    $(document).ready(function () {
                                        $("#form_completion_<?=$arFields['ID']?>").submit(function () {
                                            let formID = $(this).attr('id');
                                            let formNm = $('#' + formID);
                                            let formMs = $('#invoice');

                                            $('.border.print-table').find('tr').removeClass('active');
                                            $(this).parents('tr').addClass('active');
                                            $.ajax({
                                                type: "POST",
                                                url: '/lc/completion.php',
                                                data: formNm.serialize(),
                                                success: function (data) {
                                                    // Вывод текста результата отправки
                                                    $(formMs).html(data);
                                                }
                                            });
                                            return false;
                                        });
                                    });
                                </script>
                                <?}?>
                            </tr>
                        <?}?>
                    <?}?>
                    <?if($i==0){?><tr><td colspan="4" align="center">Вы еще не получали счета, получить счет можно <a href="/lc/finance/"><b>тут</b></a></td></tr><?}?>
                    </tbody>
                </table>
            <div id="invoice"></div>
        </div>
    </div>
<?}else{?>
    <?include '../none-cabinet.php';?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

