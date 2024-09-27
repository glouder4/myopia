<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
    <div style="min-height:366px;" class="fade tab-pane active in" id="<?= $arResult['ID'] ?>">
        <div class="map">
            <?$APPLICATION->IncludeComponent("bitrix:map.yandex.view", "departament", Array(
                "IBLOCK_ID_DEPARTAMENT" => $arResult['IBLOCK_ID'],
                "CURRENT_DEPARTAMENT_ID" => $arResult['ID'],
                "INIT_MAP_TYPE" => "MAP",	// Стартовый тип карты
                "MAP_DATA" => "",
                "MAP_WIDTH" => "100%",	// Ширина карты
                "MAP_HEIGHT" => "400",	// Высота карты
                "CONTROLS" => array(	// Элементы управления
                    0 => "ZOOM",
                    1 => "SMALLZOOM",
                ),
                "OPTIONS" => array(	// Настройки
//                    0 => "ENABLE_SCROLL_ZOOM",
                    1 => "ENABLE_DBLCLICK_ZOOM",
                    2 => "ENABLE_DRAGGING",
                ),
                "MAP_ID" => "depmap_".$arResult['ID'],	// Идентификатор карты
                "COMPONENT_TEMPLATE" => "departament"
            ),
                $component
            );?>
        </div>
        <br>
        <p id="<?= $this->GetEditAreaId($arResult['ID']); ?>"><?= $arResult['DETAIL_TEXT'] ?></p>
        <div class="table-elements">
            <table class="table table-bordered table-striped table-responsive">
                <thead>
                <? if ($arResult['PROPERTIES']['ADRES']['VALUE'] || $arResult['PROPERTIES']['PHONE']['VALUE'] || $arResult['PROPERTIES']['EMAIL']['VALUE'] || $arResult['PROPERTIES']['SOC']['VALUE']) {
                    ?>
                    <th colspan="2">
                        <? echo GetMessage("DEP_1") ?>:
                    </th>
                <? } ?>
                </thead>
                <tbody>
                <? if ($arResult['PROPERTIES']['ADRES']['VALUE']) {
                    ?>
                    <tr>
                        <td><? echo GetMessage("DEP_2") ?>:</td>
                        <td><?= $arResult['PROPERTIES']['ADRES']['VALUE'] ?></td>
                    </tr>
                <? } ?>
                <? if ($arResult['PROPERTIES']['PHONE']['VALUE']) {
                    ?>
                    <tr>
                        <td><? echo GetMessage("DEP_3") ?></td>
                        <td><?= $arResult['PROPERTIES']['PHONE']['VALUE'] ?></td>
                    </tr>
                <? } ?>
                <? if ($arResult['PROPERTIES']['EMAIL']['VALUE']) {
                    ?>
                    <tr>
                        <td><? echo GetMessage("DEP_4") ?></td>
                        <td><?= $arResult['PROPERTIES']['EMAIL']['VALUE'] ?></td>
                    </tr>
                <? } ?>
                <? if ($arResult['PROPERTIES']['SOC']['VALUE']) {
                    ?>
                    <tr>
                        <td><? echo GetMessage("DEP_5") ?></td>
                        <td><?= $arResult['PROPERTIES']['SOC']['VALUE'] ?></td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        </div>
    </div>
