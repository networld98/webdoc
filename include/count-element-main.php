<?
CModule::IncludeModule("iblock");

$iblock_id = 3;
function count_element($iblock){
    $arFilter = Array("IBLOCK_ID"=>$iblock, "ACTIVE"=>"Y");
    $res_count = CIBlockElement::GetList(Array(), $arFilter, Array(), false, Array());
    echo $res_count;
}
?>

<div class="statistics__items">
    <div class="statistics__item">
        <div class="statistics__icon">
            <img alt="build" src="/local/templates/light_blue/assets/images/hospital_building.svg">
        </div>
        <div class="statistics__block">
            <div class="statistics__number">
                <? count_element(9)?>+
            </div>
            <div class="statistics__text">
                клиник в нашей базе
            </div>
        </div>
    </div>
    <div class="statistics__item">
        <div class="statistics__icon">
            <img alt="doctor" src="/local/templates/light_blue/assets/images/doctor_3_.svg">
        </div>
        <div class="statistics__block">
            <div class="statistics__number">
                <? count_element(10)?>+
            </div>
            <div class="statistics__text">
                врачей в нашей базе
            </div>
        </div>
    </div>
    <div class="statistics__item">
        <div class="statistics__icon">
            <img alt="order" src="/local/templates/light_blue/assets/images/order_in_progress.svg">
        </div>
        <div class="statistics__block">
            <div class="statistics__number">
                5162+
            </div>
            <div class="statistics__text">
                пациента записались
            </div>
        </div>
    </div>
    <div class="statistics__item">
        <div class="statistics__icon">
            <img alt="like" src="/local/templates/light_blue/assets/images/influence_1_.svg">
        </div>
        <div class="statistics__block">
            <div class="statistics__number">
                1750+
            </div>
            <div class="statistics__text">
                отзывов
            </div>
        </div>
    </div>
</div>