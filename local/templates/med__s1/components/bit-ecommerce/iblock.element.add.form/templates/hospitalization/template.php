<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath*/
/** @var CBitrixComponent $component */

$this->setFrameMode(false);
$firstBitMed = new CFirstbitMedOptions();
?>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-left contact2-wrap no-pad">
    <!--contact widgets-->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left no-pad">
        <!--Contact form-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad wow">
            <div style="padding-bottom:25px;" class="blog-box-title"><?= GetMessage("HS_TITLE") ?></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                <?if (!empty($arResult["ERRORS"])):?>
                    <?ShowError(implode("<br />", $arResult["ERRORS"]))?>
                <?endif;
                if (strlen($arResult["MESSAGE"]) > 0):?>
                    <?ShowNote($arResult["MESSAGE"])?>
                <?endif?>

                <form name="form"
                      class="contact2-page-form col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad contact-v1"
                      action="<?= POST_FORM_ACTION_URI ?>" method="POST" enctype="multipart/form-data">
                    <?= bitrix_sessid_post() ?>
                    <?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
                    <?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
                        <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
                            <?if($propertyID == "NAME"):?>
                                <input type="hidden" name="PROPERTY[<?=$propertyID?>][0]" value="<?=$arParams['TITLE_ELEMENT']."_".date("d.m.Y_H:i:s");?>"/>
                                <?continue;?>
                            <?endif?>
                            <?if(in_array($propertyID, array('MESSAGE_2', 'MESSAGE_3','NAME'))):?>
                                <?continue;?>
                            <?endif?>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 control-group">
                            <?
                            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"])
                            {
                                if (
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
                                    &&
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
                                )
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
                                elseif (
                                    (
                                        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
                                        ||
                                        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
                                    )
                                    &&
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
                                )
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
                            }
                            elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

                            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
                            {
                                $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
                                $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
                            }
                            else
                            {
                                $inputNum = 1;
                            }

                            if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
                                $INPUT_TYPE = "USER_TYPE";
                            else
                                $INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

                            switch ($INPUT_TYPE):
                                case "USER_TYPE":
                                    for ($i = 0; $i<$inputNum; $i++)
                                    {
                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                        {
                                            $value = $arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
                                            $description = $arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"] > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
                                        }
                                        elseif ($i == 0)
                                        {
                                            $value = $arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"] ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                            $description = "";
                                        }
                                        else
                                        {
                                            $value = "";
                                            $description = "";
                                        }
                                        echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
                                            array(
                                                $arResult["PROPERTY_LIST_FULL"][$propertyID],
                                                array(
                                                    "VALUE" => $value,
                                                    "DESCRIPTION" => $description,
                                                ),
                                                array(
                                                    "VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
                                                    "DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
                                                    "FORM_NAME"=>"iblock_add",
                                                ),
                                            ));
                                        ?><br /><?
                                    }
                                    break;
                                case "TAGS":
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:search.tags.input",
                                        "",
                                        array(
                                            "VALUE" => $arResult["ELEMENT"][$propertyID],
                                            "NAME" => "PROPERTY[".$propertyID."][0]",
                                            "TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
                                        ), null, array("HIDE_ICONS"=>"Y")
                                    );
                                    break;
                                case "HTML":
                                    $LHE = new CHTMLEditor;
                                    $LHE->Show(array(
                                        'name' => "PROPERTY[".$propertyID."][0]",
                                        'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
                                        'inputName' => "PROPERTY[".$propertyID."][0]",
                                        'content' => $arResult["ELEMENT"][$propertyID],
                                        'width' => '100%',
                                        'minBodyWidth' => 350,
                                        'normalBodyWidth' => 555,
                                        'height' => '200',
                                        'bAllowPhp' => false,
                                        'limitPhpAccess' => false,
                                        'autoResize' => true,
                                        'autoResizeOffset' => 40,
                                        'useFileDialogs' => false,
                                        'saveOnBlur' => true,
                                        'showTaskbars' => false,
                                        'showNodeNavi' => false,
                                        'askBeforeUnloadPage' => true,
                                        'bbCode' => false,
                                        'siteId' => SITE_ID,
                                        'controlsMap' => array(
                                            array('id' => 'Bold', 'compact' => true, 'sort' => 80),
                                            array('id' => 'Italic', 'compact' => true, 'sort' => 90),
                                            array('id' => 'Underline', 'compact' => true, 'sort' => 100),
                                            array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
                                            array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
                                            array('id' => 'Color', 'compact' => true, 'sort' => 130),
                                            array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
                                            array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
                                            array('separator' => true, 'compact' => false, 'sort' => 145),
                                            array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
                                            array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
                                            array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
                                            array('separator' => true, 'compact' => false, 'sort' => 200),
                                            array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
                                            array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
                                            array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
                                            array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
                                            array('separator' => true, 'compact' => false, 'sort' => 290),
                                            array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
                                            array('id' => 'More', 'compact' => true, 'sort' => 400)
                                        ),
                                    ));
                                    break;
                                case "T":
                                    for ($i = 0; $i<$inputNum; $i++)
                                    {

                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                        {
                                            $value = $arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                            if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == 'HTML')
                                                $value = $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"]["TEXT"];
                                        }
                                        elseif ($i == 0)
                                        {
                                            $value = $arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"] ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"]["TEXT"];
                                            if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == 'HTML')
                                                $value = $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"]["TEXT"];
                                        }
                                        else
                                        {
                                            $value = "";
                                        }
                                        ?>
                                        <textarea
                                            class="contact2-textarea"
                                            style="height:auto;"
                                            cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"
                                            rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>"
                                            name="PROPERTY[<?=$propertyID?>][<?=$i?>][VALUE][TEXT]"
                                            placeholder="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"] ? $arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"]:$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] ?>"
                                            ><?=$value?></textarea>
                                        <?
                                    }
                                    break;

                                case "S":
                                case "N":
                                    for ($i = 0; $i<$inputNum; $i++)
                                    {
                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                        {
                                            $value = $arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"] > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                        }
                                        elseif ($i == 0)
                                        {
                                            $value = $arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"] <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                        }
                                        else
                                        {
                                            $value = "";
                                        }
                                        ?>
                                        <input
                                            placeholder="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"] ? $arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"]:$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] ?>"
                                            class="contact2-textbox"
                                            type="text"
                                            name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>"
                                            /><?
                                        if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:main.calendar',
                                                '',
                                                array(
                                                    'FORM_NAME' => 'iblock_add',
                                                    'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
                                                    'INPUT_VALUE' => $value,
                                                ),
                                                null,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                            ?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
                                        endif
                                        ?><?
                                    }
                                    break;

                                case "F":
                                    for ($i = 0; $i<$inputNum; $i++)
                                    {
                                        $value = $arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                        ?>
                                        <input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
                                        <input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" /><br />
                                        <?

                                        if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
                                        {
                                            ?>
                                            <input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br />
                                            <?

                                            if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
                                            {
                                                ?>
                                                <img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
                                                <?
                                            }
                                            else
                                            {
                                                ?>
                                                <?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
                                                <?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
                                                [<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br />
                                                <?
                                            }
                                        }
                                    }

                                    break;
                                case "L":

                                    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
                                        $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
                                    else
                                        $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

                                    switch ($type):
                                        case "checkbox":
                                        case "radio":
												foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
												{
													$checked = false;
													if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
													{
														if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
														{
															foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
															{
																if ($arElEnum["VALUE"] == $key)
																{
																	$checked = true;
																	break;
																}
															}
														}
													}
													else
													{
														if ($arEnum["DEF"] == "Y") $checked = true;
													}
													if($propertyID=='AGREEMENT') {
														$agreementPropKey = $key;
														break;
													}
													?>
													<input
														class="contact2-textarea"
														placeholder="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?>"
														type="<?=$type?>"
														name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>"
														value="<?=$key?>"
														id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> />
													<label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label>

													<?
												}
                                            break;

                                        case "dropdown":
                                        case "multiselect":
                                            ?>
                                            <select name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
                                                <option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
                                                <?
                                                if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_PROPERTY"]) $sKey = "ELEMENT_PROPERTIES";
                                                else $sKey = "ELEMENT";

                                                foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
                                                {
                                                    $checked = false;
                                                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                                    {
                                                        foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
                                                        {
                                                            if ($key == $arElEnum["VALUE"])
                                                            {
                                                                $checked = true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if ($arEnum["DEF"] == "Y") $checked = true;
                                                    }
                                                    ?>
                                                    <option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
                                                    <?
                                                }
                                                ?>
                                            </select>
                                            <?
                                            break;

                                    endswitch;
                                    break;
                            endswitch;?>
                        </div>
                        <?endforeach;?>


                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 control-group">
                            <b class="mf-ok-text"><?= GetMessage("PER") ?></b><br><br>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-2">
                            <center><b class="mf-ok-text" style="padding: 0;"><?= GetMessage("PER_S") ?></b></center>
                        </div>
                        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-10 control-group">

                            <? echo CalendarDate("PROPERTY[MESSAGE_2][0]", $arResult["ELEMENT_PROPERTIES"]['MESSAGE_2'][0]["VALUE"]?$arResult["ELEMENT_PROPERTIES"]['MESSAGE_2'][0]["VALUE"]:date('d.m.Y'), "form", "15", "class=\"contact2-cal\"") ?>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-2">
                            <center><b class="mf-ok-text" style="padding: 0;"><?= GetMessage("PER_PO") ?></b></center>
                        </div>
                        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-10 control-group">
                            <? echo CalendarDate("PROPERTY[MESSAGE_3][0]", $arResult["ELEMENT_PROPERTIES"]['MESSAGE_3'][0]["VALUE"]?$arResult["ELEMENT_PROPERTIES"]['MESSAGE_3'][0]["VALUE"]:date('d.m.Y'), "form", "15", "class=\"contact2-cal\"") ?>
                        </div>
                        <?if(in_array('AGREEMENT', $arResult['PROPERTY_REQUIRED'])):
                            $enum_id = reset($arResult['PROPERTY_LIST_FULL']['AGREEMENT']['ENUM']);
                            ?>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 control-group">
                                <label><input type="checkbox" value="<?=$enum_id['ID']?>" name="PROPERTY[AGREEMENT][<?=$enum_id['ID']?>]">
                                    <?=$firstBitMed->getLegalText()?>
                                </label>
                            </div>
                        <?endif;?>
						<? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 control-group">
                            <br>

                            <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>">
                            <div class="mf-text"><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></div>
                            <img style="width: auto; height: auto;" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"  alt="CAPTCHA"><br>
                            <br>
                            <?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span>:
                            <input class="contact2-textbox" style="width: 180px;" type="text" name="captcha_word" size="30" maxlength="50" value="">
                        </div>
                        <? endif; ?>
                    <?endif?>
                    <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <section class="color-7" id="btn-click">
                            <div class="fa fa-envelope btn2-st2 btn-7 btn-7b iform-button">
                                <input class="iblock_submit" type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
                            </div>
                        </section>
                    </div>
                </form>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 column-element">
                    <center><b class="mf-ok-text"><?= GetMessage("TEXT") ?></b></center>
                </div>
            </div>
        </div>
    </div>
</div>