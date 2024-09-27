<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/*TAGS*/
$arParams["TEMPLATE_THEME"] = "blue";
foreach ($arResult["ITEMS"] as $i => $arItem) {
    $res = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID']);
    if ($ar_res = $res->GetNext())
        $arResult['ITEMS'][$i]['IBLOCK_SECTION_NAME'] = $ar_res['NAME'];
    $PREVIEW_TEXT = $arItem['PREVIEW_TEXT'];
    $PREVIEW_TEXT = mb_substr($PREVIEW_TEXT, 0, 200);
    $PREVIEW_TEXT = rtrim($PREVIEW_TEXT, "!,.-");
    $PREVIEW_TEXT = mb_substr($PREVIEW_TEXT, 0, strrpos($PREVIEW_TEXT, ' '));
    if (mb_strlen($arItem['PREVIEW_TEXT']) > 200) {
        $arResult['ITEMS'][$i]['PREVIEW_TEXT_IMPLODE'] = $PREVIEW_TEXT . "... ";
    } else {
        $arResult['ITEMS'][$i]['PREVIEW_TEXT_IMPLODE'] = $PREVIEW_TEXT;
    }

    $NAME = $arItem['NAME'];
    $NAME = mb_substr($NAME, 0, 40);

    if (mb_strlen($arItem['NAME']) > 40) {
        $arResult['ITEMS'][$i]['NAME_IMPLODE'] = $NAME . "... ";
    } else {
        $arResult['ITEMS'][$i]['NAME_IMPLODE'] = $NAME;
    }

}
$res = CIBlock::GetByID($arParams['IBLOCK_ID']);
if ($ar_res = $res->GetNext()) {
    $arResult['IBLOCK_NAME'] = $ar_res['NAME'];
}

