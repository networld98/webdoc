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
                клиник в поиске
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
                врачей в поиске
            </div>
        </div>
    </div>
    <div class="statistics__item">
        <div class="statistics__icon">
            <img alt="order" src="/local/templates/light_blue/assets/images/order_in_progress.svg">
        </div>
        <div class="statistics__block">
            <div class="statistics__number">
                <? $file = file_get_contents($_SERVER["DOCUMENT_ROOT"] .'/local/scripts/count_call.txt', true);?>
                <?=$file?>+
            </div>
            <div class="statistics__text">
                исходящих<br> звонков
            </div>
        </div>
    </div>
    <div class="statistics__item">
        <div class="statistics__icon">
            <img alt="like" src="/local/templates/light_blue/assets/images/influence_1_.svg">
        </div>
        <div class="statistics__block">
            <div class="statistics__number">
                <?
                $countReviews = 0;
                $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_API_REVIEWS_COUNT");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
                $arFilter = Array("IBLOCK_ID"=>array(9,10));
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                while($ob = $res->GetNextElement()){
                    $arFields = $ob->GetFields();
                    if($arFields['PROPERTY_API_REVIEWS_COUNT_VALUE']!=NULL){
                        $countReviews= $countReviews + $arFields['PROPERTY_API_REVIEWS_COUNT_VALUE'];
                    }
                }
                echo 1700+$countReviews,'+';
                ?>
            </div>
            <div class="statistics__text">
                честных отзывов
            </div>
        </div>
    </div>
</div>
