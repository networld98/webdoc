<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Уведомления");

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
<? include '../menu.php';?>
<?if($idClient !=NULL){?>
    <div class="personal-cabinet-content__price-page">
        <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
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
            <?if($messages[0]==NULL){?><h4>У вас нет уведомлений</h4><?}?>
        </div>
    </div>
<?}else{?>
    <?include '../none-cabinet.php';?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

