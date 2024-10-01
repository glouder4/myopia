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
<div class="subtitle col-xs-12 col-sm-12 col-md-6 col-md-offset-3 pull-left news-sub icontact-widg">
    <a id="form" name="form"></a>
    <center><?= GetMessage("TITLE") ?></center>
</div>
<div class="col-xs-12 col-lg-12  col-sm-12 col-md-12 pull-left contact2-wrap no-pad">
    <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12 pull-left no-pad">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad wow">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad">
                <?if (!empty($arResult["ERRORS"])):?>
                    <?ShowError(implode("<br />", $arResult["ERRORS"]))?>
                <?endif;
                if (strlen($arResult["MESSAGE"]) > 0):?>
                    <?ShowNote($arResult["MESSAGE"])?>
                <?endif?>
                <form class="contact2-page-form col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad contact-v1" action="<?= POST_FORM_ACTION_URI ?>" method="POST" enctype="multipart/form-data">
                    <?= bitrix_sessid_post() ?>
                    <input type="hidden" name="PROPERTY[NAME][0]" value="<?=$arParams['TITLE_ELEMENT']."_".date("d.m.Y_H:i:s");?>"/>

                    <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 control-group">
                        <input
                            class="contact2-textbox"
                            type="text"
                            name="PROPERTY[AUTHOR][0]"
                            placeholder="<?= $arResult["PROPERTY_LIST_FULL"]["AUTHOR"]["HINT"]?$arResult["PROPERTY_LIST_FULL"]["AUTHOR"]["HINT"]:$arResult["PROPERTY_LIST_FULL"]["AUTHOR"]["NAME"]?>"
                            value="<?= $arResult["ELEMENT_PROPERTIES"]["AUTHOR"][0]["VALUE"]?>"
                            />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 control-group">
                        <input
                            class="contact2-textbox"
                            type="text"
                            name="PROPERTY[TEL][0]"
                            placeholder="<?= $arResult["PROPERTY_LIST_FULL"]["TEL"]["HINT"]?$arResult["PROPERTY_LIST_FULL"]["TEL"]["HINT"]:$arResult["PROPERTY_LIST_FULL"]["TEL"]["NAME"];?>"
                            value="<?= $arResult["ELEMENT_PROPERTIES"]["TEL"][0]["VALUE"]?>"
                            />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 control-group">
                        <input
                            class="contact2-textbox"
                            type="email"
                            name="PROPERTY[EMAIL][0]"
                            placeholder="<?= $arResult["PROPERTY_LIST_FULL"]["EMAIL"]["HINT"]?$arResult["PROPERTY_LIST_FULL"]["EMAIL"]["HINT"]:$arResult["PROPERTY_LIST_FULL"]["EMAIL"]["NAME"]?>"
                            value="<?= $arResult["ELEMENT_PROPERTIES"]["EMAIL"][0]["VALUE"]?>"
                            />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <textarea
                            class="contact2-textarea"
                            style="height: 150px;"
                            name="PROPERTY[MESSAGE][0][VALUE][TEXT]"
                            placeholder="<?= $arResult["PROPERTY_LIST_FULL"]["MESSAGE"]["HINT"]?$arResult["PROPERTY_LIST_FULL"]["MESSAGE"]["HINT"]:$arResult["PROPERTY_LIST_FULL"]["MESSAGE"]["NAME"]?>"
                            cols="40"><?= $arResult["ELEMENT_PROPERTIES"]["MESSAGE"][0]["VALUE"]["TEXT"]?></textarea>
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
                    <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
					
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <section class="color-7" id="btn-click">
                            <div class="fa fa-envelope btn2-st2 btn-7 btn-7b" style="padding: 0;">
                                <input class="iblock_submit" type="submit" name="iblock_submit" value="<?=GetMessage("MFT_SUBMIT")?>" />
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>




