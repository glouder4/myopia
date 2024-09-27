<?php
$arSecMetaProp = $arResult['SECTION_META_PROPERTY'];

if ($arSecMetaProp["ELEMENT_META_DESCRIPTION"])
    $APPLICATION->SetPageProperty("description", $arSecMetaProp["ELEMENT_META_DESCRIPTION"]);

if ($arSecMetaProp["ELEMENT_META_KEYWORDS"])
    $APPLICATION->SetPageProperty("keywords", $arSecMetaProp["ELEMENT_META_KEYWORDS"]);

if ($arSecMetaProp["SECTION_META_TITLE"])
    $APPLICATION->SetPageProperty("title", $arSecMetaProp["SECTION_META_TITLE"]);

if ($arSecMetaProp["SECTION_PAGE_TITLE"])
    $APPLICATION->SetTitle($arSecMetaProp["SECTION_PAGE_TITLE"]);
