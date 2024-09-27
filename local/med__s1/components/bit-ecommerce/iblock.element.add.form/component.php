<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
$this->setFrameMode(false);

if (empty($arParams["EVENT_NAME"])) {
    $arParams["EVENT_NAME"] = "FEEDBACK_FORM_MAIN";
}

if(empty($arParams["EVENT_MESSAGE_ID"])){
    $dbType = CEventMessage::GetList($by="ID", $order="DESC", array("TYPE_ID" => $arParams["EVENT_NAME"]));
    while($ar = $dbType->GetNext()){
        $arParams["EVENT_MESSAGE_ID"][$ar["ID"]] = $ar["ID"];
    }
}

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("CC_BIEAF_IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}
if(CModule::IncludeModule("firstbit.med"))
{
    $firstBitMed = new CFirstbitMedOptions();
}

if(!in_array('NAME', $arParams["PROPERTY_CODES"]))
    $arParams["PROPERTY_CODES"][] = "NAME";
if(!in_array('NAME', $arParams["PROPERTY_CODES_REQUIRED"]))
    $arParams["PROPERTY_CODES_REQUIRED"][] = "NAME";

$arElement = false;

if($arParams["IBLOCK_ID"] > 0)
{
	$arIBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"]);
	$bWorkflowIncluded = ($arIBlock["WORKFLOW"] == "Y") && CModule::IncludeModule("workflow");
	$bBizproc = ($arIBlock["BIZPROC"] == "Y") && CModule::IncludeModule("bizproc");
}
else
{
	$arIBlock = false;
	$bWorkflowIncluded = CModule::IncludeModule("workflow");
	$bBizproc = false;
}

$arParams["ID"] = intval($_REQUEST["CODE"]);
$arParams["MAX_FILE_SIZE"] = intval($arParams["MAX_FILE_SIZE"]);
$arParams["PREVIEW_TEXT_USE_HTML_EDITOR"] = $arParams["PREVIEW_TEXT_USE_HTML_EDITOR"] === "Y" && CModule::IncludeModule("fileman");
$arParams["DETAIL_TEXT_USE_HTML_EDITOR"] = $arParams["DETAIL_TEXT_USE_HTML_EDITOR"] === "Y" && CModule::IncludeModule("fileman");
$arParams["RESIZE_IMAGES"] = $arParams["RESIZE_IMAGES"]==="Y";

if(!is_array($arParams["PROPERTY_CODES"]))
{
	$arParams["PROPERTY_CODES"] = array();
}
else
{
	foreach($arParams["PROPERTY_CODES"] as $i=>$k)
		if(strlen($k) <= 0)
			unset($arParams["PROPERTY_CODES"][$i]);
}
$arParams["PROPERTY_CODES_REQUIRED"] = is_array($arParams["PROPERTY_CODES_REQUIRED"]) ? $arParams["PROPERTY_CODES_REQUIRED"] : array();
foreach($arParams["PROPERTY_CODES_REQUIRED"] as $key => $value)
	if(strlen(trim($value)) <= 0)
		unset($arParams["PROPERTY_CODES_REQUIRED"][$key]);

if($firstBitMed->getChBoxStatus()) {
    $arParams["PROPERTY_CODES_REQUIRED"][] = 'AGREEMENT';
    $arParams["PROPERTY_CODES"][] = 'AGREEMENT';
}

$arParams["USER_MESSAGE_ADD"] = trim($arParams["USER_MESSAGE_ADD"]);
if(strlen($arParams["USER_MESSAGE_ADD"]) <= 0)
	$arParams["USER_MESSAGE_ADD"] = GetMessage("IBLOCK_USER_MESSAGE_ADD_DEFAULT");

$arParams["USER_MESSAGE_EDIT"] = trim($arParams["USER_MESSAGE_EDIT"]);
if(strlen($arParams["USER_MESSAGE_EDIT"]) <= 0)
	$arParams["USER_MESSAGE_EDIT"] = GetMessage("IBLOCK_USER_MESSAGE_EDIT_DEFAULT");

if (!$bWorkflowIncluded)
{
	if ($arParams["STATUS_NEW"] != "N" && $arParams["STATUS_NEW"] != "NEW") $arParams["STATUS_NEW"] = "ANY";
}

if(!is_array($arParams["STATUS"]))
{
	if($arParams["STATUS"] === "INACTIVE")
		$arParams["STATUS"] = array("INACTIVE");
	else
		$arParams["STATUS"] = array("ANY");
}


$bAllowAccess = true;

$arResult["ERRORS"] = array();

if ($bAllowAccess)
{
	// get iblock sections list
	$rsIBlockSectionList = CIBlockSection::GetList(
		array("left_margin"=>"asc"),
		array(
			"ACTIVE"=>"Y",
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
		),
		false,
		array("ID", "NAME", "DEPTH_LEVEL")
	);
	$arResult["SECTION_LIST"] = array();
	while ($arSection = $rsIBlockSectionList->GetNext())
	{
		$arSection["NAME"] = str_repeat(" . ", $arSection["DEPTH_LEVEL"]).$arSection["NAME"];
		$arResult["SECTION_LIST"][$arSection["ID"]] = array(
			"VALUE" => $arSection["NAME"]
		);
	}

//	$COL_COUNT = intval($arParams["DEFAULT_INPUT_SIZE"]);
//	if($COL_COUNT < 1)
		$COL_COUNT = 30;
	// customize "virtual" properties
	$arResult["PROPERTY_LIST"] = array();
	$arResult["PROPERTY_LIST_FULL"] = array(
		"NAME" => array(
			"PROPERTY_TYPE" => "S",
			"MULTIPLE" => "N",
			"COL_COUNT" => $COL_COUNT,
		),

		"TAGS" => array(
			"PROPERTY_TYPE" => "S",
			"MULTIPLE" => "N",
			"COL_COUNT" => $COL_COUNT,
		),

		"DATE_ACTIVE_FROM" => array(
			"PROPERTY_TYPE" => "S",
			"MULTIPLE" => "N",
			"USER_TYPE" => "DateTime",
		),

		"DATE_ACTIVE_TO" => array(
			"PROPERTY_TYPE" => "S",
			"MULTIPLE" => "N",
			"USER_TYPE" => "DateTime",
		),

		"IBLOCK_SECTION" => array(
			"PROPERTY_TYPE" => "L",
			"ROW_COUNT" => "8",
			"MULTIPLE" => $arParams["MAX_LEVELS"] == 1 ? "N" : "Y",
			"ENUM" => $arResult["SECTION_LIST"],
		),

		"PREVIEW_TEXT" => array(
			"PROPERTY_TYPE" => ($arParams["PREVIEW_TEXT_USE_HTML_EDITOR"]? "HTML": "T"),
			"MULTIPLE" => "N",
			"ROW_COUNT" => "5",
			"COL_COUNT" => $COL_COUNT,
		),
		"PREVIEW_PICTURE" => array(
			"PROPERTY_TYPE" => "F",
			"FILE_TYPE" => "jpg, gif, bmp, png, jpeg",
			"MULTIPLE" => "N",
		),
		"DETAIL_TEXT" => array(
			"PROPERTY_TYPE" => ($arParams["DETAIL_TEXT_USE_HTML_EDITOR"]? "HTML": "T"),
			"MULTIPLE" => "N",
			"ROW_COUNT" => "5",
			"COL_COUNT" => $COL_COUNT,
		),
		"DETAIL_PICTURE" => array(
			"PROPERTY_TYPE" => "F",
			"FILE_TYPE" => "jpg, gif, bmp, png, jpeg",
			"MULTIPLE" => "N",
		),
	);

	// add them to edit-list
	foreach ($arResult["PROPERTY_LIST_FULL"] as $key => $arr)
	{
		if (in_array($key, $arParams["PROPERTY_CODES"])) $arResult["PROPERTY_LIST"][] = $key;
	}

	// get iblock property list
	$rsIBLockPropertyList = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
	while ($arProperty = $rsIBLockPropertyList->GetNext()) {
        // get list of property enum values
        if ($arProperty["PROPERTY_TYPE"] == "L") {
            $rsPropertyEnum = CIBlockProperty::GetPropertyEnum($arProperty["ID"]);
            $arProperty["ENUM"] = array();
            while ($arPropertyEnum = $rsPropertyEnum->GetNext()) {
                $arProperty["ENUM"][$arPropertyEnum["ID"]] = $arPropertyEnum;
            }
        }

        if ($arProperty["USER_TYPE"] == "HTML"){
            $arProperty["PROPERTY_TYPE"] = "T";
            $arProperty["ROW_COUNT"] = "5";
		}
        elseif(strlen($arProperty["USER_TYPE"]) > 0 )
		{
			$arUserType = CIBlockProperty::GetUserType($arProperty["USER_TYPE"]);
			if(array_key_exists("GetPublicEditHTML", $arUserType))
				$arProperty["GetPublicEditHTML"] = $arUserType["GetPublicEditHTML"];
			else
				$arProperty["GetPublicEditHTML"] = false;
		}
		else
		{
			$arProperty["GetPublicEditHTML"] = false;
		}

        if ($arProperty["PROPERTY_TYPE"] == "T") {
            if (empty($arProperty["COL_COUNT"])) $arProperty["COL_COUNT"] = "30";
            if (empty($arProperty["ROW_COUNT"])) $arProperty["ROW_COUNT"] = "5";
        }

		// add property to edit-list
		if (in_array($arProperty["CODE"], $arParams["PROPERTY_CODES"]))
			$arResult["PROPERTY_LIST"][] = $arProperty["CODE"];

        $arProperty["IS_PROPERTY"] = true;
		$arResult["PROPERTY_LIST_FULL"][$arProperty["CODE"]] = $arProperty;
	}
	// set starting filter value
	$arFilter = array("IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"], "SHOW_NEW" => "Y");

	// check type of user association to iblock elements and add user association to filter
	if ($arParams["ELEMENT_ASSOC"] == "PROPERTY_ID" && strlen($arParams["ELEMENT_ASSOC_PROPERTY"]) && is_array($arResult["PROPERTY_LIST_FULL"][$arParams["ELEMENT_ASSOC_PROPERTY"]]))
	{
		if ($USER->GetID())
			$arFilter["PROPERTY_".$arParams["ELEMENT_ASSOC_PROPERTY"]] = $USER->GetID();
		else
			$arFilter["ID"] = -1;
	}
	elseif ($USER->GetID())
	{
		$arFilter["CREATED_BY"] = $USER->GetID();
	}
	// additional bugcheck. situation can be found when property ELEMENT_ASSOC_PROPERTY does not exists and user is not registered
	else
	{
		$arFilter["ID"] = -1;
	}

	//check for access to current element
	if ($arParams["ID"] > 0)
	{
		if (empty($arFilter["ID"])) $arFilter["ID"] = $arParams["ID"];

		// get current iblock element

		$rsIBlockElements = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter);

		if ($arElement = $rsIBlockElements->Fetch())
		{
			$bAllowAccess = true;

			if ($bWorkflowIncluded)
			{
				$LAST_ID = CIBlockElement::WF_GetLast($arElement['ID']);
				if ($LAST_ID != $arElement["ID"])
				{
					$rsElement = CIBlockElement::GetByID($LAST_ID);
					$arElement = $rsElement->Fetch();
				}

				if (!in_array($arElement["WF_STATUS_ID"], $arParams["STATUS"]))
				{
					ShowError(GetMessage("IBLOCK_ADD_ACCESS_DENIED"));
					$bAllowAccess = false;
				}
			}
			else
			{
				if (in_array("INACTIVE", $arParams["STATUS"]) === true && $arElement["ACTIVE"] !== "N")
				{
					ShowError(GetMessage("IBLOCK_ADD_ACCESS_DENIED"));
					$bAllowAccess = false;
				}
			}
		}
		else
		{
			ShowError(GetMessage("IBLOCK_ADD_ELEMENT_NOT_FOUND"));
			$bAllowAccess = false;
		}
	}
	elseif ($arParams["MAX_USER_ENTRIES"] > 0 && $USER->GetID())
	{
		$rsIBlockElements = CIBlockElement::GetList(array(), $arFilter, false, false, array('ID'));
		$elements_count = $rsIBlockElements->SelectedRowsCount();
		if ($elements_count >= $arParams["MAX_USER_ENTRIES"])
		{
			ShowError(GetMessage("IBLOCK_ADD_MAX_ENTRIES_EXCEEDED"));
			$bHideAuth = true;
			$bAllowAccess = false;
		}
	}
}

if ($bAllowAccess)
{
	// process POST data
	if ($_POST["bxajaxid"] == $arParams["AJAX_ID"] && check_bitrix_sessid() && (!empty($_REQUEST["iblock_submit"]) || !empty($_REQUEST["iblock_apply"])))
	{
		$SEF_URL = $_REQUEST["SEF_APPLICATION_CUR_PAGE_URL"];
		$arResult["SEF_URL"] = $SEF_URL;
			
			if( isset($_REQUEST["PROPERTY"]['EMAIL'][0]) AND $_REQUEST["PROPERTY"]['EMAIL'][0] != '' ):

				$emailPreg = !preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/", $_REQUEST["PROPERTY"]['EMAIL'][0]);

				if( $emailPreg ){
					$arResult['ERRORS'][0] = 'Email введен не по формату!';
				}

			endif;

			if( isset($_REQUEST["PROPERTY"]['TEL'][0]) AND $_REQUEST["PROPERTY"]['TEL'][0] != '' ):

				$phonePreg = preg_replace('/[^0-9]/', '', $_REQUEST["PROPERTY"]['TEL'][0]);

				if( !preg_match("/^[0-9]{10,11}+$/", $phonePreg) ){
					$arResult['ERRORS'][0] = 'Телефон введен не по формату!';
				}

			endif;

		$arProperties = $_REQUEST["PROPERTY"];

		$arUpdateValues = array();
		$arUpdatePropertyValues = array();

		// process properties list
		foreach ($arParams["PROPERTY_CODES"]  as $i => $propertyCODE)
		{
			$arPropertyValue = $arProperties[$propertyCODE];
			// check if property is a real property, or element field
			if ($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["IS_PROPERTY"])
			{
				// for non-file properties
				if ($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["PROPERTY_TYPE"] != "F")
				{
					// for multiple properties
					if ($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["MULTIPLE"] == "Y")
					{
						$arUpdatePropertyValues[$propertyCODE] = array();

						if (!is_array($arPropertyValue))
						{
							$arUpdatePropertyValues[$propertyCODE][] = $arPropertyValue;
						}
						else
						{
							foreach ($arPropertyValue as $key => $value)
							{
								if (
									$arResult["PROPERTY_LIST_FULL"][$propertyCODE]["PROPERTY_TYPE"] == "L" && intval($value) > 0
									||
									$arResult["PROPERTY_LIST_FULL"][$propertyCODE]["PROPERTY_TYPE"] != "L" && !empty($value)
								)
								{
									$arUpdatePropertyValues[$propertyCODE][] = $value;
								}
							}
						}
					}
					// for single properties
					else
					{
						if ($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["PROPERTY_TYPE"] != "L")
							$arUpdatePropertyValues[$propertyCODE] = $arPropertyValue[0];
						else
							$arUpdatePropertyValues[$propertyCODE] = $arPropertyValue;
					}
				}
				// for file properties
				else
				{
					$arUpdatePropertyValues[$propertyCODE] = array();
					foreach ($arPropertyValue as $key => $value)
					{
						$arFile = $_FILES["PROPERTY_FILE_".$propertyCODE."_".$key];
						$arFile["del"] = $_REQUEST["DELETE_FILE"][$propertyCODE][$key] == "Y" ? "Y" : "";
						$arUpdatePropertyValues[$propertyCODE][$key] = $arFile;

						if(($arParams["MAX_FILE_SIZE"] > 0) && ($arFile["size"] > $arParams["MAX_FILE_SIZE"]))
							$arResult["ERRORS"][] = GetMessage("IBLOCK_ERROR_FILE_TOO_LARGE");
					}

					if (empty($arUpdatePropertyValues[$propertyCODE]))
						unset($arUpdatePropertyValues[$propertyCODE]);
				}
			}
			else
			{
				// for "virtual" properties
				if ($propertyCODE == "IBLOCK_SECTION")
				{
					if (!is_array($arProperties[$propertyCODE]))
						$arProperties[$propertyCODE] = array($arProperties[$propertyCODE]);
					$arUpdateValues[$propertyCODE] = $arProperties[$propertyCODE];

					if ($arParams["LEVEL_LAST"] == "Y" && is_array($arUpdateValues[$propertyCODE]))
					{
						foreach ($arUpdateValues[$propertyCODE] as $section_id)
						{
							$rsChildren = CIBlockSection::GetList(
								array("SORT" => "ASC"),
								array(
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
									"SECTION_ID" => $section_id,
								),
								false,
								array("ID")
							);
							if ($rsChildren->SelectedRowsCount() > 0)
							{
								$arResult["ERRORS"][] = GetMessage("IBLOCK_ADD_LEVEL_LAST_ERROR");
								break;
							}
						}
					}

					if ($arParams["MAX_LEVELS"] > 0 && count($arUpdateValues[$propertyCODE]) > $arParams["MAX_LEVELS"])
					{
						$arResult["ERRORS"][] = str_replace("#MAX_LEVELS#", $arParams["MAX_LEVELS"], GetMessage("IBLOCK_ADD_MAX_LEVELS_EXCEEDED"));
					}
				}
				else
				{
					if($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["PROPERTY_TYPE"] == "F")
					{
						$arFile = $_FILES["PROPERTY_FILE_".$propertyCODE."_0"];
						$arFile["del"] = $_REQUEST["DELETE_FILE"][$propertyCODE][0] == "Y" ? "Y" : "";
						$arUpdateValues[$propertyCODE] = $arFile;
						if ($arParams["MAX_FILE_SIZE"] > 0 && $arFile["size"] > $arParams["MAX_FILE_SIZE"])
							$arResult["ERRORS"][] = GetMessage("IBLOCK_ERROR_FILE_TOO_LARGE");
					}
					elseif($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["PROPERTY_TYPE"] == "HTML")
					{
						if($propertyCODE == "DETAIL_TEXT")
							$arUpdateValues["DETAIL_TEXT_TYPE"] = "html";
						if($propertyCODE == "PREVIEW_TEXT")
							$arUpdateValues["PREVIEW_TEXT_TYPE"] = "html";
						$arUpdateValues[$propertyCODE] = $arProperties[$propertyCODE][0];
					}
					else
					{
						if($propertyCODE == "DETAIL_TEXT")
							$arUpdateValues["DETAIL_TEXT_TYPE"] = "text";
						if($propertyCODE == "PREVIEW_TEXT")
							$arUpdateValues["PREVIEW_TEXT_TYPE"] = "text";
						$arUpdateValues[$propertyCODE] = $arProperties[$propertyCODE][0];
					}
				}
			}
		}

        // check required properties
		foreach ($arParams["PROPERTY_CODES_REQUIRED"] as $key => $propertyCODE)
		{
			$bError = false;
			$propertyValue = $arResult["PROPERTY_LIST_FULL"][$propertyCODE]["IS_PROPERTY"] ? $arUpdatePropertyValues[$propertyCODE] : $arUpdateValues[$propertyCODE];

			if($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["USER_TYPE"] != "")
				$arUserType = CIBlockProperty::GetUserType($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["USER_TYPE"]);
			else
				$arUserType = array();


			//Files check
			if ($arResult["PROPERTY_LIST_FULL"][$propertyCODE]['PROPERTY_TYPE'] == 'F')
			{
				//New element
				if ($arParams["ID"] <= 0)
				{
					$bError = true;
					if(is_array($propertyValue))
					{
						if(array_key_exists("tmp_name", $propertyValue) && array_key_exists("size", $propertyValue))
						{
							if($propertyValue['size'] > 0)
							{
								$bError = false;
							}
						}
						else
						{
							foreach ($propertyValue as $arFile)
							{
								if ($arFile['size'] > 0)
								{
									$bError = false;
									break;
								}
							}
						}
					}
				}
				//Element field
				elseif ($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["IS_PROPERTY"])
				{
					if ($propertyValue['size'] <= 0)
					{
						if (intval($arElement[$propertyCODE]) <= 0 || $propertyValue['del'] == 'Y')
							$bError = true;
					}
				}
				//Element property
				else
				{
                    $dbProperty = CIBlockElement::GetProperty(
						$arElement["IBLOCK_ID"],
						$arParams["ID"],
						"sort", "asc",
						array("CODE" => $propertyCODE)
					);

					$bCount = 0;
					while ($arProperty = $dbProperty->Fetch())
						$bCount++;

					foreach ($propertyValue as $arFile)
					{
						if ($arFile['size'] > 0)
						{
							$bCount++;
							break;
						}
						elseif ($arFile['del'] == 'Y')
						{
							$bCount--;
						}
					}

					$bError = $bCount <= 0;
				}
			}
			elseif(array_key_exists("GetLength", $arUserType))
			{
				$len = 0;
				if(is_array($propertyValue) && !array_key_exists("VALUE", $propertyValue))
				{
					foreach($propertyValue as $value)
					{
						if(is_array($value) && !array_key_exists("VALUE", $value))
							foreach($value as $val)
								$len += call_user_func_array($arUserType["GetLength"], array($arResult["PROPERTY_LIST_FULL"][$propertyCODE], array("VALUE" => $val)));
						elseif(is_array($value) && array_key_exists("VALUE", $value))
							$len += call_user_func_array($arUserType["GetLength"], array($arResult["PROPERTY_LIST_FULL"][$propertyCODE], $value));
						else
							$len += call_user_func_array($arUserType["GetLength"], array($arResult["PROPERTY_LIST_FULL"][$propertyCODE], array("VALUE" => $value)));
					}
				}
				elseif(is_array($propertyValue) && array_key_exists("VALUE", $propertyValue))
				{
					$len += call_user_func_array($arUserType["GetLength"], array($arResult["PROPERTY_LIST_FULL"][$propertyCODE], $propertyValue));
				}
				else
				{
					$len += call_user_func_array($arUserType["GetLength"], array($arResult["PROPERTY_LIST_FULL"][$propertyCODE], array("VALUE" => $propertyValue)));
				}

				if($len <= 0)
					$bError = true;

			}
			//multiple property
			elseif ($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["MULTIPLE"] == "Y" || $arResult["PROPERTY_LIST_FULL"][$propertyCODE]["PROPERTY_TYPE"] == "L")
			{
				if(is_array($propertyValue))
				{
					$bError = true;
					foreach($propertyValue as $value)
					{
						if(strlen($value) > 0)
						{
							$bError = false;
							break;
						}
					}
				}
				elseif(strlen($propertyValue) <= 0)
				{
					$bError = true;
				}
			}
			//single
			elseif (is_array($propertyValue) && array_key_exists("VALUE", $propertyValue))
			{
				if(!strlen($propertyValue["VALUE"]))
					$bError = true;
			}
			elseif (!is_array($propertyValue))
			{
				if(!strlen($propertyValue))
					$bError = true;
			}

			if ($bError)
			{

				$arResult["ERRORS"][] = str_replace("#PROPERTY_NAME#", $arResult["PROPERTY_LIST_FULL"][$propertyCODE]["IS_PROPERTY"] ? $arResult["PROPERTY_LIST_FULL"][$propertyCODE]["NAME"] : (!empty($arParams["CUSTOM_TITLE_".$propertyCODE]) ? $arParams["CUSTOM_TITLE_".$propertyCODE] : GetMessage("IBLOCK_FIELD_".$propertyCODE)), GetMessage("IBLOCK_ADD_ERROR_REQUIRED"));
			}
		}

		// check captcha
		if ($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0)
		{
			if (!$APPLICATION->CaptchaCheckCode($_REQUEST["captcha_word"], $_REQUEST["captcha_sid"]))
			{
				$arResult["ERRORS"][] = GetMessage("IBLOCK_FORM_WRONG_CAPTCHA");
			}
		}

		if (empty($arResult["ERRORS"]))
		{
			if ($arParams["ELEMENT_ASSOC"] == "PROPERTY_ID")
				$arUpdatePropertyValues[$arParams["ELEMENT_ASSOC_PROPERTY"]] = $USER->GetID();
			$arUpdateValues["MODIFIED_BY"] = $USER->GetID();

			$arUpdateValues["PROPERTY_VALUES"] = $arUpdatePropertyValues;
			// update existing element
			$oElement = new CIBlockElement();
			if ($arParams["ID"] > 0)
			{
				$sAction = "EDIT";

				$bFieldProps = array();
				foreach($arUpdateValues["PROPERTY_VALUES"] as $prop_id=>$v)
				{
					$bFieldProps[$prop_id]=true;
				}
				$dbPropV = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $arParams["ID"], "sort", "asc", Array("ACTIVE"=>"Y"));
				while($arPropV = $dbPropV->Fetch())
				{
					if(!array_key_exists($arPropV["CODE"], $bFieldProps) && $arPropV["PROPERTY_TYPE"] != "F")
					{
						if($arPropV["MULTIPLE"] == "Y")
						{
							if(!array_key_exists($arPropV["CODE"], $arUpdateValues["PROPERTY_VALUES"]))
								$arUpdateValues["PROPERTY_VALUES"][$arPropV["CODE"]] = array();
							$arUpdateValues["PROPERTY_VALUES"][$arPropV["CODE"]][$arPropV["PROPERTY_VALUE_ID"]] = array(
								"VALUE" => $arPropV["VALUE"],
								"DESCRIPTION" => $arPropV["DESCRIPTION"],
							);
						}
						else
						{
							$arUpdateValues["PROPERTY_VALUES"][$arPropV["CODE"]] = array(
								"VALUE" => $arPropV["VALUE"],
								"DESCRIPTION" => $arPropV["DESCRIPTION"],
							);
						}
					}
				}

				if (!$res = $oElement->Update($arParams["ID"], $arUpdateValues, $bWorkflowIncluded, true, $arParams["RESIZE_IMAGES"]))
				{
					$arResult["ERRORS"][] = $oElement->LAST_ERROR;
				}
			}
			// add new element
			else
			{
				$arUpdateValues["IBLOCK_ID"] = $arParams["IBLOCK_ID"];

				// set activity start date for new element to current date. Change it, if ya want ;-)
				if (strlen($arUpdateValues["DATE_ACTIVE_FROM"]) <= 0)
				{
					$arUpdateValues["DATE_ACTIVE_FROM"] = ConvertTimeStamp(time()+CTimeZone::GetOffset(), "FULL");
				}

				$sAction = "ADD";
				if (!$arParams["ID"] = $oElement->Add($arUpdateValues, $bWorkflowIncluded, true, $arParams["RESIZE_IMAGES"]))
				{
					$arResult["ERRORS"][] = $oElement->LAST_ERROR;
				}

				if (!empty($_REQUEST["iblock_apply"]) && strlen($SEF_URL) > 0)
				{
					if (strpos($SEF_URL, "?") === false) $SEF_URL .= "?edit=Y";
					elseif (strpos($SEF_URL, "edit=") === false) $SEF_URL .= "&edit=Y";
					$SEF_URL .= "&CODE=".$arParams["ID"];
				}
			}
		}

		if($bBizproc && empty($arResult["ERRORS"]))
		{
			$arBizProcWorkflowId = array();
			foreach($arDocumentStates as $arDocumentState)
			{
				if(strlen($arDocumentState["ID"]) <= 0)
				{
					$arErrorsTmp = array();

					$arBizProcWorkflowId[$arDocumentState["TEMPLATE_ID"]] = CBPDocument::StartWorkflow(
						$arDocumentState["TEMPLATE_ID"],
						array("iblock", "CIBlockDocument", $arParams["ID"]),
						$arBizProcParametersValues[$arDocumentState["TEMPLATE_ID"]],
						$arErrorsTmp
					);

					foreach($arErrorsTmp as $e)
						$arResult["ERRORS"][] = $e["message"];
				}
			}
		}

		if($bBizproc && empty($arResult["ERRORS"]))
		{
			$arDocumentStates = null;
			CBPDocument::AddDocumentToHistory(array("iblock", "CIBlockDocument", $arParams["ID"]), $arUpdateValues["NAME"], $USER->GetID());
		}

		// redirect to element edit form or to elements list
		if (empty($arResult["ERRORS"]))
		{
            $arEventFields = array();
            foreach($arUpdateValues["PROPERTY_VALUES"] as $idProp => $v){
                if($arResult["PROPERTY_LIST_FULL"][$idProp]["CODE"]){
                    $arEventFields[$arResult["PROPERTY_LIST_FULL"][$idProp]["CODE"]] =  $v;

                    if($arResult["PROPERTY_LIST_FULL"][$idProp]["PROPERTY_TYPE"] == "L")
                        $arEventFields[$arResult["PROPERTY_LIST_FULL"][$idProp]["CODE"]] =  $arResult["PROPERTY_LIST_FULL"][$idProp]["ENUM"][$v]["VALUE"];
                }
            };
            if(!empty($arParams["EVENT_MESSAGE_ID"]))
            {
                foreach($arParams["EVENT_MESSAGE_ID"] as $v)
                    if(IntVal($v) > 0)
                        CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arEventFields, "N", IntVal($v));
            }

			if (!empty($_REQUEST["iblock_submit"]))
			{
				if (strlen($arParams["LIST_URL"]) > 0)
				{
					$sRedirectUrl = $arParams["LIST_URL"];
				}
				else
				{
					if (strlen($SEF_URL) > 0)
					{
						$SEF_URL = str_replace("edit=Y", "", $SEF_URL);
						$SEF_URL = str_replace("?&", "?", $SEF_URL);
						$SEF_URL = str_replace("&&", "&", $SEF_URL);
						$sRedirectUrl = $SEF_URL;
					}
					else
					{
						$sRedirectUrl = $APPLICATION->GetCurPageParam("", array("edit", "CODE", "strIMessage"), $get_index_page=false);
					}

				}
			}
			else
			{
				if (strlen($SEF_URL) > 0)
					$sRedirectUrl = $SEF_URL;
				else
					$sRedirectUrl = $APPLICATION->GetCurPageParam("edit=Y&CODE=".$arParams["ID"], array("edit", "CODE", "strIMessage"), $get_index_page=false);
			}

			$sAction = $sAction == "ADD" ? "ADD" : "EDIT";
			$sRedirectUrl .= (strpos($sRedirectUrl, "?") === false ? "?" : "&")."strIMessage=";
			$sRedirectUrl .= urlencode($arParams["USER_MESSAGE_".$sAction]);

            if($arParams["RESTART_BUFFER"] == 'Y'){
			    $sRedirectUrl .= "&restartbuffer=y";
//                if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST["strIMessage"]) && is_string($_REQUEST["strIMessage"]))
//                    $arResult["MESSAGE"] = htmlspecialcharsbx($_REQUEST["strIMessage"]);

            }

//            if($_REQUEST["test"] == 'y'){
//                echo '<pre>'; print_r($sRedirectUrl);echo '</pre>';
//                echo '<pre>'; print_r($arParams);echo '</pre>';
//                echo '<pre>'; print_r($_REQUEST);echo '</pre>';
//            die('ddd');
//            }

			LocalRedirect($sRedirectUrl);
			exit();
		}
	}

	//prepare data for form

	$arResult["PROPERTY_REQUIRED"] = is_array($arParams["PROPERTY_CODES_REQUIRED"]) ? $arParams["PROPERTY_CODES_REQUIRED"] : array();

	if ($arParams["ID"] > 0)
	{
		// $arElement is defined before in elements rights check
		$rsElementSections = CIBlockElement::GetElementGroups($arElement["ID"]);
		$arElement["IBLOCK_SECTION"] = array();
		while ($arSection = $rsElementSections->GetNext())
		{
			$arElement["IBLOCK_SECTION"][] = array("VALUE" => $arSection["ID"]);
		}

		$arResult["ELEMENT"] = array();
		foreach($arElement as $key => $value)
		{
			$arResult["ELEMENT"]["~".$key] = $value;
			if(!is_array($value) && !is_object($value))
				$arResult["ELEMENT"][$key] = htmlspecialcharsbx($value);
			else
				$arResult["ELEMENT"][$key] = $value;
		}

		//Restore HTML if needed
		if(
			$arParams["DETAIL_TEXT_USE_HTML_EDITOR"]
			&& array_key_exists("DETAIL_TEXT", $arResult["ELEMENT"])
			&& strtolower($arResult["ELEMENT"]["DETAIL_TEXT_TYPE"]) == "html"
		)
			$arResult["ELEMENT"]["DETAIL_TEXT"] = $arResult["ELEMENT"]["~DETAIL_TEXT"];

		if(
			$arParams["PREVIEW_TEXT_USE_HTML_EDITOR"]
			&& array_key_exists("PREVIEW_TEXT", $arResult["ELEMENT"])
			&& strtolower($arResult["ELEMENT"]["PREVIEW_TEXT_TYPE"]) == "html"
		)
			$arResult["ELEMENT"]["PREVIEW_TEXT"] = $arResult["ELEMENT"]["~PREVIEW_TEXT"];


		//$arResult["ELEMENT"] = $arElement;

		// load element properties
		$rsElementProperties = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $arElement["ID"], $by="sort", $order="asc");
		$arResult["ELEMENT_PROPERTIES"] = array();
		while ($arElementProperty = $rsElementProperties->Fetch())
		{
			if(!array_key_exists($arElementProperty["ID"], $arResult["ELEMENT_PROPERTIES"]))
				$arResult["ELEMENT_PROPERTIES"][$arElementProperty["ID"]] = array();

			if(is_array($arElementProperty["VALUE"]))
			{
				$htmlvalue = array();
				foreach($arElementProperty["VALUE"] as $k => $v)
				{
					if(is_array($v))
					{
						$htmlvalue[$k] = array();
						foreach($v as $k1 => $v1)
							$htmlvalue[$k][$k1] = htmlspecialcharsbx($v1);
					}
					else
					{
						$htmlvalue[$k] = htmlspecialcharsbx($v);
					}
				}
			}
			else
			{
				$htmlvalue = htmlspecialcharsbx($arElementProperty["VALUE"]);
			}

			$arResult["ELEMENT_PROPERTIES"][$arElementProperty["ID"]][] = array(
				"ID" => htmlspecialcharsbx($arElementProperty["ID"]),
				"VALUE" => $htmlvalue,
				"~VALUE" => $arElementProperty["VALUE"],
				"VALUE_ID" => htmlspecialcharsbx($arElementProperty["PROPERTY_VALUE_ID"]),
				"VALUE_ENUM" => htmlspecialcharsbx($arElementProperty["VALUE_ENUM"]),
			);
		}

		// process element property files
		$arResult["ELEMENT_FILES"] = array();
		foreach ($arResult["PROPERTY_LIST"] as $propertyCODE)
		{
			$arProperty = $arResult["PROPERTY_LIST_FULL"][$propertyCODE];
			if ($arProperty["PROPERTY_TYPE"] == "F")
			{
				$arValues = array();
				if ($arResult["PROPERTY_LIST_FULL"][$propertyCODE]["IS_PROPERTY"])
				{
					foreach ($arResult["ELEMENT_PROPERTIES"][$propertyCODE] as $arProperty)
					{
						$arValues[] = $arProperty["VALUE"];
					}
				}
				else
				{
					$arValues[] = $arResult["ELEMENT"][$propertyCODE];
				}

				foreach ($arValues as $value)
				{
					if ($arFile = CFile::GetFileArray($value))
					{
						$arFile["IS_IMAGE"] = CFile::IsImage($arFile["FILE_NAME"], $arFile["CONTENT_TYPE"]);
						$arResult["ELEMENT_FILES"][$value] = $arFile;
					}
				}
			}
		}

		$bShowForm = true;
	}
	else
	{
		$bShowForm = true;
	}

	if ($bShowForm)
	{
		// prepare form data if some errors occured
		if (!empty($arResult["ERRORS"]))
		{
			foreach ($arUpdateValues as $key => $value)
			{
				if ($key == "IBLOCK_SECTION")
				{
					$arResult["ELEMENT"][$key] = array();
					if(!is_array($value))
					{
						$arResult["ELEMENT"][$key][] = array("VALUE" => htmlspecialcharsbx($value));
					}
					else
					{
						foreach ($value as $vkey => $vvalue)
						{
							$arResult["ELEMENT"][$key][$vkey] = array("VALUE" => htmlspecialcharsbx($vvalue));
						}
					}
				}
				elseif ($key == "PROPERTY_VALUES")
				{
					//Skip
				}
				elseif ($arResult["PROPERTY_LIST_FULL"][$key]["PROPERTY_TYPE"] == "F")
				{
					//Skip
				}
				elseif ($arResult["PROPERTY_LIST_FULL"][$key]["PROPERTY_TYPE"] == "HTML")
				{
					$arResult["ELEMENT"][$key] = $value;
				}
				else
				{
					$arResult["ELEMENT"][$key] = htmlspecialcharsbx($value);
				}
			}

			foreach ($arUpdatePropertyValues as $key => $value)
			{
				if ($arResult["PROPERTY_LIST_FULL"][$key]["PROPERTY_TYPE"] != "F")
				{
					$arResult["ELEMENT_PROPERTIES"][$key] = array();
					if(!is_array($value))
					{
						$value = array(
							array("VALUE" => $value),
						);
					}
					foreach($value as $vv)
					{
						if(is_array($vv))
						{
							if(array_key_exists("VALUE", $vv))
								$arResult["ELEMENT_PROPERTIES"][$key][] = array(
									"~VALUE" => $vv["VALUE"],
									"VALUE" => !is_array($vv["VALUE"])? htmlspecialcharsbx($vv["VALUE"]): $vv["VALUE"],
								);
							else
								$arResult["ELEMENT_PROPERTIES"][$key][] = array(
									"~VALUE" => $vv,
									"VALUE" => $vv,
								);
						}
						else
						{
							$arResult["ELEMENT_PROPERTIES"][$key][] = array(
								"~VALUE" => $vv,
								"VALUE" => htmlspecialcharsbx($vv),
							);
						}
					}
				}
			}
		}

		// prepare captcha
		if ($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0)
		{
			$arResult["CAPTCHA_CODE"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
		}

		$arResult["MESSAGE"] = '';
		if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST["strIMessage"]) && is_string($_REQUEST["strIMessage"]))
			$arResult["MESSAGE"] = htmlspecialcharsbx($_REQUEST["strIMessage"]);

		$this->includeComponentTemplate();
	}
}
if (!$bAllowAccess && !$bHideAuth)
{
	//echo ShowError(GetMessage("IBLOCK_ADD_ACCESS_DENIED"));
	$APPLICATION->AuthForm("");
}
