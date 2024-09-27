<?php
CModule::IncludeModule("iblock");
$rs = CIBlockElement::GetList(false, array("IBLOCK_ID"=>$arParams["IBLOCK_ID_DEPARTAMENT"]), false, false, array("ID","NAME","DETAIL_PAGE_URL", "PROPERTY_MAPS"));
while($ar = $rs->GetNext()){
    if($ar["PROPERTY_MAPS_VALUE"]){
        $arCoords = explode(',',$ar["PROPERTY_MAPS_VALUE"]);
        $arFields = array(
            "TEXT" => GetMessage("GO_TO",array("NAME" => $ar["NAME"])),
            "LON" => $arCoords[1],
            "LAT" => $arCoords[0],
            "URL" => $ar["DETAIL_PAGE_URL"],
        );

        if(intval($ar["PROPERTY_MAP_SCALE_VALUE"]))
            $arFields["SCALE"] = intval($ar["PROPERTY_MAP_SCALE_VALUE"]);

        if($ar["ID"] == $arParams["CURRENT_DEPARTAMENT_ID"]){
            unset($arFields["URL"]);
            $arFields["TEXT"] = $ar["NAME"];
            $arFields["IS_CENTER"] = true;
            $arFields["ICON"] = SITE_TEMPLATE_PATH."/images/location.png";
        }
        $arResult["POSITION"]["PLACEMARKS"][] = $arFields;
    }
}