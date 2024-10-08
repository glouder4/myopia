<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/*TAGS*/
if ($arParams["SEARCH_PAGE"])
{
    if ($arResult["FIELDS"] && isset($arResult["FIELDS"]["TAGS"]))
    {
        $tags = array();
        foreach (explode(",", $arResult["FIELDS"]["TAGS"]) as $tag)
        {
            $tag = trim($tag, " \t\n\r");
            if ($tag)
            {
                $url = CHTTP::urlAddParams(
                    $arParams["SEARCH_PAGE"],
                    array(
                        "tags" => $tag,
                    ),
                    array(
                        "encode" => true,
                    )
                );
                $tags[] = '<a href="'.$url.'">'.$tag.'</a>';
            }
        }
        $arResult["FIELDS"]["TAGS"] = implode(", ", $tags);
    }

}

/*VIDEO & AUDIO*/
$mediaProperty = trim($arParams["MEDIA_PROPERTY"]);
if ($mediaProperty)
{
	if (is_numeric($mediaProperty))
	{
		$propertyFilter = array(
			"ID" => $mediaProperty,
		);
	}
	else
	{
		$propertyFilter = array(
			"CODE" => $mediaProperty,
		);
	}

	$elementIndex = array();
	$elementIds = array();
    $elementIds[$arResult["IBLOCK_ID"]][] = $arResult["ID"];
    $elementIndex[$arResult["ID"]] = array(
        "index" => $i,
        "PROPERTIES" => array(),
    );

	if ($elementIds)
	{
		foreach ($elementIds as $iblockId => $ids)
		{
			CIBlockElement::GetPropertyValuesArray($elementIndex, $iblockId, array(
				"IBLOCK_ID" => $iblockId,
				"ID" => $ids,
			), $propertyFilter);
		}
		
		foreach ($elementIndex as $idx)
		{
			foreach ($idx["PROPERTIES"] as $property)
			{
				$url = '';
				if ($property["MULTIPLE"] == "Y" && $property["VALUE"])
				{
					$url = current($property["VALUE"]);
				}
				if ($property["MULTIPLE"] == "N" && $property["VALUE"])
				{
					$url = $property["VALUE"];
				}

				if (preg_match('/(?:youtube\\.com|youtu\\.be).*?[\\?\\&]v=([^\\?\\&]+)/i', $url, $matches))
				{
					$arResult[$idx["index"]]["VIDEO"] = 'https://www.youtube.com/embed/'.$matches[1].'/?rel=0&controls=0showinfo=0';
				}
				elseif (preg_match('/(?:vimeo\\.com)\\/([0-9]+)/i', $url, $matches))
				{
					$arResult[$idx["index"]]["VIDEO"] = 'https://player.vimeo.com/video/'.$matches[1];
				}
				elseif (preg_match('/(?:rutube\\.ru).*?\\/video\\/([0-9a-f]+)/i', $url, $matches))
				{
					$arResult[$idx["index"]]["VIDEO"] = 'http://rutube.ru/video/embed/'.$matches[1].'?sTitle=false&sAuthor=false';
				}
				elseif (preg_match('/(?:soundcloud\\.com)/i', $url, $matches))
				{
					$arResult[$idx["index"]]["SOUND_CLOUD"] = $url;
				}
			}
		}
	}
}

/*SLIDER*/
$sliderProperty = trim($arParams["SLIDER_PROPERTY"]);
if ($sliderProperty)
{
	if (is_numeric($sliderProperty))
	{
		$propertyFilter = array(
			"ID" => $sliderProperty,
		);
	}
	else
	{
		$propertyFilter = array(
			"CODE" => $sliderProperty,
		);
	}

	$elementIndex = array();
	$elementIds = array();
    $elementIds[$arResult["IBLOCK_ID"]][] = $arResult["ID"];
    $elementIndex[$arResult["ID"]] = array(
        "index" => $i,
        "PROPERTIES" => array(),
    );

	if ($elementIds)
	{
		foreach ($elementIds as $iblockId => $ids)
		{
			CIBlockElement::GetPropertyValuesArray($elementIndex, $iblockId, array(
				"IBLOCK_ID" => $iblockId,
				"ID" => $ids,
			), $propertyFilter);
		}
		
		foreach ($elementIndex as $idx)
		{
			foreach ($idx["PROPERTIES"] as $property)
			{
				$files = array();
				if ($property["MULTIPLE"] == "Y" && $property["VALUE"])
				{
					$files = $property["VALUE"];
				}
				if ($property["MULTIPLE"] == "N" && $property["VALUE"])
				{
					$files = array($property["VALUE"]);
				}

				if ($files)
				{
					$arResult[$idx["index"]]["SLIDER"] = array();
					foreach ($files as $fileId)
					{
						$file = CFile::GetFileArray($fileId);
						if ($file && $file["WIDTH"] > 0 && $file["HEIGHT"] > 0)
						{
							$arResult[$idx["index"]]["SLIDER"][] = $file;
						}
					}
				}
			}
		}
	}
}

/* THEME */
$arParams["TEMPLATE_THEME"] = trim($arParams["TEMPLATE_THEME"]);
if ($arParams["TEMPLATE_THEME"] != "")
{
	$arParams["TEMPLATE_THEME"] = preg_replace("/[^a-zA-Z0-9_\-\(\)\!]/", "", $arParams["TEMPLATE_THEME"]);
	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$arParams["TEMPLATE_THEME"] = COption::GetOptionString("main", "wizard_eshop_adapt_theme_id", "blue", SITE_ID);
	}
	if ($arParams["TEMPLATE_THEME"] != "")
	{
		if (!is_file($_SERVER["DOCUMENT_ROOT"].$this->GetFolder()."/themes/".$arParams["TEMPLATE_THEME"]."/style.css"))
			$arParams["TEMPLATE_THEME"] = "";
	}
}
if ($arParams["TEMPLATE_THEME"] == "")
	$arParams["TEMPLATE_THEME"] = "blue";

foreach ($arResult['PROPERTIES']['PRICE']['VALUE'] as $arPrice){
    $arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PREVIEW_TEXT");
    $arFilter = Array("IBLOCK_ID"=>$arResult['PROPERTIES']['PRICE']['LINK_IBLOCK_ID'], "ID"=>$arPrice, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arResult['PRICE'][$arPrice] =  $arFields;
    }
}
$NAME = $arResult['NAME'];
$NAME = mb_substr($NAME, 0, 40);

if(mb_strlen($arItem['NAME']) > 40){
    $arResult['NAME_IMPLODE'] =  $NAME."... ";
}else{
    $arResult['NAME_IMPLODE'] =  $NAME;
}
?>
		
