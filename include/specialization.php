<?require_once $_SERVER['DOCUMENT_ROOT'] . '/include/Mobile_Detect.php';
$detect = new Mobile_Detect;
if ($detect->isMobile() && !$detect->isTablet()) {
    $specializationCount = 2;
}elseif($detect->isTablet()){
    $specializationCount = 4;
}elseif(!$detect->isMobile()){
    $specializationCount = 6;
}?>
<style>
    .specializations .nav {
        max-width: 100%;
        width: 100%;
    }
    @media (max-width: 450px){
        .specializations .nav-pills .nav-link.active, .specializations .nav-pills .nav-link {
            padding: 15px 0 6px;
            line-height: 1;
            text-align: center;
            display: block;
        }
    }

</style>
<ul class="nav nav-pills" id="pills-tab" role="tablist">
    <li class="nav-item"><a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Специализации врачей</a></li>
    <li class="nav-item"><a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Специализации клиник</a></li>
    <li class="nav-item"><a class="nav-link" id="pills-cosmetic-tab" data-toggle="pill" href="#pills-cosmetic" role="tab" aria-controls="pills-cosmetic" aria-selected="true">Косметологические услуги</a></li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="row">
            <?
            $doctors = [];
            $arSelect = array("NAME");
            $arFilter = array("IBLOCK_ID"=>11);
            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext())
            {
                $doctors[mb_strtoupper(substr($ar_result['NAME'], 0,1))][] = $ar_result['NAME'];
            }?>
            <?foreach (array_slice($doctors, 0, $specializationCount) as $key=> $doctor){?>
                <div class="col-xl-2 col-md-3 col-6">
                    <div class="col__heading">
                        <?=$key?>
                    </div>
                    <ul class="col__list">
                        <?foreach ($doctor as $specialization){?>
                            <li class="col__item"><a href="#"><?=mb_ucfirst($specialization)?></a></li>
                        <?}?>
                    </ul>
                </div>
            <?}?>
        </div>
        <div class="specializations__list expand">
            <div class="row">
                <?foreach (array_slice($doctors, $specializationCount) as $key=> $doctor){?>
                    <div class="col-xl-2 col-md-3 col-6">
                        <div class="col__heading">
                            <?=$key?>
                        </div>
                        <ul class="col__list">
                            <?foreach ($doctor as $specialization){?>
                                <li class="col__item"><a href="#"><?=mb_ucfirst($specialization)?></a></li>
                            <?}?>
                        </ul>
                    </div>
                <?}?>
            </div>
        </div>
        <div class="load_more">Показать ещё</div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="row">
            <?
            $clinicks = [];
            $arSelect = array("NAME");
            $arFilter = array("IBLOCK_ID"=>13);
            $res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array(), $arSelect);
            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $clinicks[mb_strtoupper(substr($arFields['NAME'], 0,1))][] = $arFields['NAME'];
            }?>
            <?
            foreach (array_slice($clinicks, 0, $specializationCount) as $key=> $clinick){?>
                <div class="col-xl-2 col-md-3 col-6">
                    <div class="col__heading">
                        <?=$key?>
                    </div>
                    <ul class="col__list">
                        <?foreach ($clinick as $specialization){?>
                            <li class="col__item"><a href="#"><?=mb_ucfirst($specialization)?></a></li>
                        <?}?>
                    </ul>
                </div>
            <?}?>
        </div>
        <div class="load_more">
            Показать ещё
        </div>
        <div class="specializations__list expand">
            <div class="row">
                <?
                foreach (array_slice($clinicks, $specializationCount) as $key=> $clinick){?>
                    <div class="col-xl-2 col-md-3 col-6">
                        <div class="col__heading">
                            <?=$key?>
                        </div>
                        <ul class="col__list">
                            <?foreach ($clinick as $specialization){?>
                                <li class="col__item"><a href="#"><?=mb_ucfirst($specialization)?></a></li>
                            <?}?>
                        </ul>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-cosmetic" role="tabpanel" aria-labelledby="pills-cosmetic-tab">
        <div class="row">
            <?
            $сosmetics = [];
            $arSelect = array("NAME","ID");
            $arFilter = array("IBLOCK_ID"=>25);
            $obSections = CIBlockSection::GetList(array("NAME" => "ASC"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext()) {
                $сosmetics[mb_strtoupper(substr($ar_result['NAME'], 0,1))][] = $ar_result['NAME'];
            }?>
            <?
            foreach (array_slice($сosmetics, 0, $specializationCount) as $key=> $сosmetic){?>
                <div class="col-xl-2 col-md-3 col-6">
                    <div class="col__heading">
                        <?=$key?>
                    </div>
                    <ul class="col__list">
                        <?foreach ($сosmetic as $specialization){?>
                            <li class="col__item"><a href="#"><?=mb_ucfirst($specialization)?></a></li>
                        <?}?>
                    </ul>
                </div>
            <?}?>
        </div>
        <div class="load_more">
            Показать ещё
        </div>
        <div class="specializations__list expand">
            <div class="row">
                <?
                foreach (array_slice($сosmetics, $specializationCount) as $key=> $сosmetics){?>
                    <div class="col-xl-2 col-md-3 col-6">
                        <div class="col__heading">
                            <?=$key?>
                        </div>
                        <ul class="col__list">
                            <?foreach ($сosmetics as $specialization){?>
                                <li class="col__item"><a href="#"><?=mb_ucfirst($specialization)?></a></li>
                            <?}?>
                        </ul>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div>