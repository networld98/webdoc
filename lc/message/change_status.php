<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("form");
// сформируем массив фильтра
$arFilter = Array(
    "ID"                       => "",       // ID статуса равен 1 или 4
    "ID_EXACT_MATCH"           => "N",           // точное совпадение для ID
    "ACTIVE"                   => "Y",           // флаг активности
    "TITLE"                    => $_POST['STATUS'], // заголовок
    "TITLE_EXACT_MATCH"        => "N",           // точное совпадение для TITLE
);

// получим список всех статусов формы, соответствующих фильтру
$rsStatuses = CFormStatus::GetList(
    $_POST['FORM'],
    $by="s_id",
    $order="desc",
    $arFilter,
    $is_filtered
    );
while ($arStatus = $rsStatuses->Fetch())
{
    CFormResult::SetStatus($_POST['RESULT'], $arStatus['ID']);
}
if($_POST['STATUS'] == "ACCEPTED"){
    $statusOld = 'CANSELED';
}elseif($_POST['STATUS'] == "CANSELED"){
    $statusOld = 'ACCEPTED';
}

?>
<div class="personal-cabinet-content__doctors-page-box-item__desc-switch">
    <div class="toggle reverse_switch">
        <input type="checkbox" id="normal_<?=$_POST['RESULT']?>" <?if($_POST['STATUS']!='ACCEPTED'){?>checked<?}?> name="STATUS_TITLE_<?=$_POST['RESULT']?>" class="swith" value="<?=$statusOld?>" type="checkbox"/>
        <label class="toggle-item" for="normal_<?=$_POST['RESULT']?>"></label>
        <input type="hidden" name="STATUS" value="STATUS_TITLE_<?=$_POST['RESULT']?>">
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#normal_<?=$_POST['RESULT']?>').on('click', function () {
            let formMs = $("#result-form<?=$_POST['RESULT']?>");
            let statusNow = $(this).val();
            $.ajax({
                type: "POST",
                url: '/lc/message/change_status.php',
                data: "RESULT=<?=$_POST['RESULT']?>&FORM=<?=$_POST['FORM']?>&STATUS="+statusNow,
                success: function (data) {
                    // Вывод текста результата отправки
                    $(formMs).html(data).animate({transition: .3s ease;
                    }, 1500 );
                }
            });
            return false;
        });
    });
</script>