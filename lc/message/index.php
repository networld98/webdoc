<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Уведомления");

CModule::IncludeModule("form");
CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
if($arUser['UF_TYPE_USER']==6){
    $arFilter = Array("IBLOCK_ID"=>array(9), "PROPERTY_PHONE"=> $arUser['LOGIN']);
}elseif($arUser['UF_TYPE_USER']==7){
    $arFilter = Array("IBLOCK_ID"=>array(10), "PROPERTY_TECH_PHONE"=> $arUser['LOGIN']);
}
$arSelect = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
$arFields = $ob->GetFields();
$arProps = $ob->GetProperties();
$idClient = $arFields['ID'];
}
?>
<?function booking ($id, $idClient,$form){
    // ID веб-формы
    $FORM_ID = $id;

    // фильтр по полям результата
    $arFilter = array(
    );

    // фильтр по вопросам

    $arFilter["FIELDS"] = array();

    // выберем первые 10 результатов
    $rsResults = CFormResult::GetList($FORM_ID,
        ($by="s_timestamp"),
        ($order="desc"),
        $arFilter,
        $is_filtered,
        "Y",
        1000);
    $countRow = $rsResults->result->num_rows;
    if($countRow!=0){
    while ($arResult = $rsResults->Fetch())
    {
        $RESULT_ID = $arResult['ID']; // ID результата
        $STATUS_ID = $arResult['STATUS_ID']; // ID статуса

        // получим данные по всем вопросам
        $arAnswer = CFormResult::GetDataByID(
            $RESULT_ID,
            array(),
            $arResult,
            $arAnswer2);
        ?>
        <?if(explode('/',$arAnswer['SIMPLE_'.$form.'_3'][0]['USER_TEXT'])[1] == $idClient ){?>
        <div class="row text-xl-center">
                <div class="text-left col-md order-sm-1 col-4 order-1"id="result-form<?=$RESULT_ID?>">
                    <div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
                        <div class="toggle reverse_switch">
                            <input type="checkbox" id="normal_<?=$RESULT_ID?>" <?if($arResult['STATUS_TITLE']!='ACCEPTED'){?>checked<?}?> name="STATUS_TITLE_<?=$RESULT_ID?>" class="swith <?if($arResult['STATUS_TITLE']=='DEFAULT'){?>switch-default<?}?>" value="<?if($arResult['STATUS_TITLE']=='DEFAULT'){?>ACCEPTED<?}elseif($arResult['STATUS_TITLE']=='ACCEPTED'){?>CANSELED<?}elseif($arResult['STATUS_TITLE']=='CANSELED'){?>ACCEPTED<?}?>" type="checkbox"/>
                            <label class="toggle-item" for="normal_<?=$RESULT_ID?>"></label>
                            <input type="hidden" name="STATUS" value="STATUS_TITLE_<?=$RESULT_ID?>">
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#normal_<?=$RESULT_ID?>').on('click', function () {
                                let formMs = $("#result-form<?=$RESULT_ID?>");
                                let statusNow = $(this).val();
                                $.ajax({
                                    type: "POST",
                                    url: '/lc/message/change_status.php',
                                    data: "RESULT=<?=$RESULT_ID?>&FORM=<?=$id?>&STATUS="+statusNow,
                                    success: function (data) {
                                        // Вывод текста результата отправки
                                        $(formMs).html(data).animate({transition: '.3s ease'
                                    }, 1500 );
                                    }
                                });
                                return false;
                            });
                        });
                    </script>
                </div>
                <div class="col-<?if($id!=7){?>xl-2<?}else{?>xl-4<?}?> col-sm-6 order-sm-5 order-3"><?=$arAnswer['SIMPLE_'.$form.'_1'][0]['USER_TEXT']?></div>
                <?if($id!=7){?>
                    <div class="col-xl-2 col-sm-6 order-sm-3 order-2 col-8 text-right"><?=explode('/',$arAnswer['SIMPLE_'.$form.'_PHONE'][0]['USER_TEXT'])[1]?></div>
                <?}?>
                <div class="col-xl-2 col-sm-6 order-sm-4 order-4"><?=$arAnswer['SIMPLE_'.$form.'_2'][0]['USER_TEXT']?></div>
                <div class="col-xl-2 col-sm-6 order-sm-2 order-5"><?=$arAnswer['SIMPLE_'.$form.'_5'][0]['USER_TEXT']?></div>
                <div class="col-xl-1 col-sm-6 order-sm-6 order-6"><?=$arAnswer['SIMPLE_'.$form.'_6'][0]['USER_TEXT']?></div>
                <div class="col-xl-2 col-sm-6 offset-xl-0 offset-sm-6 order-sm-7 order-7"><?=$arAnswer['SIMPLE_'.$form.'_4'][0]['USER_TEXT']?>
                    <?if($id==5){?><br><?=$arAnswer['SIMPLE_'.$form.'_ADDRESS'][0]['USER_TEXT']?><?}?>
                </div>


        </div>
    <?}?>
    <?}
    }else{?>
        <h5>У вас нет заявок</h5>
    <?}
} ?>
<? include '../menu.php';?>
<?if($idClient !=NULL){?>
    <div class="personal-cabinet-content__price-page">
        <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
        <?if($arUser['UF_TYPE_USER']==7){?>
            <div class="personal-cabinet-content__schedule-page__block">
                <?$arSelect = Array();
                $arFilter = Array("IBLOCK_ID"=>array(9,10),"ID" => $idClient);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                $i=0;
                while($ob = $res->GetNextElement()) {
                    $arProps = $ob->GetProperties();
                    $messages = $arProps['MESSAGE']['VALUE'];
                }
                foreach ($messages as $message){
                    $res = CIBlockElement::GetByID($message);
                if($ar_res = $res->GetNext())?>
                    <div class="message-lc">
                        Вам пришел запрос на добавление в клинику&nbsp;<a href="<?= $ar_res['DETAIL_PAGE_URL']?>"><strong><?=$ar_res['NAME'];?></strong></a>, принять?
                        <button class="save close-modal" id="yes_<?=$message?>">Да</button>
                        <button class="save delete-doctor" id="no_<?=$message?>">Нет</button>
                        <div id="message-<?=$message?>"></div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#yes_<?=$message?>').on('click', function () {
                                let formMs = $("#message-<?=$message?>");
                                $.ajax({
                                    type: "POST",
                                    url: '/lc/message/doctor-add-message-delete.php',
                                    data: "ID_CLINIC=<?=$message?>&ID_DOCTOR=<?=$idClient?>",
                                    success: function (data) {
                                        // Вывод текста результата отправки
                                        $(formMs).html(data);
                                    }
                                });
                                return false;
                            });
                            $('#no_<?=$message?>').on('click', function () {
                                let formMs = $("#message-<?=$message?>");
                                $.ajax({
                                    type: "POST",
                                    url: '/lc/message/doctor-add-message-delete.php',
                                    data: "ID_CLINIC=<?=$message?>&ID_DOCTOR=<?=$idClient?>&DELETE=1",
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
                <?if($messages[0]==NULL){?><h4>У вас нет заявок на добавление в клинику</h4><?}?>
            </div>
        <?}?>
        <div class="personal-cabinet-content__schedule-page__block">
            <h4>Запись к врачам</h4>
            <div class="booking-block border">
                <?booking(4,$idClient,"RECORD") ?>
            </div>
        </div>
        <div class="personal-cabinet-content__schedule-page__block">
            <h4>Вызов врача домой</h4>
            <div class="booking-block border">
                <?booking(5,$idClient,"HOME") ?>
            </div>
        </div>
        <?if($arUser['UF_TYPE_USER']==6){?>
            <div class="personal-cabinet-content__schedule-page__block">
                <h4>Запись на услуги</h4>
                <div class="booking-block border">
                    <?booking(7,$idClient,"SERVICE") ?>
                </div>
            </div>
        <?}?>
    </div>
<?}else{?>
    <?include '../none-cabinet.php';?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

