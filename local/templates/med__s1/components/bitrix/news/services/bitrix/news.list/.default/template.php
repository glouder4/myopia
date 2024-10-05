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

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="blog-medium-left"><!--blog-medium-left-->
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="row  margin-top border-bottom" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                    <div style="display: none;" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!-- Blog box -->
                        <div class="blog-box wow ">
                            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                                <img alt="" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" class="img-responsive" />
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wow">

                        <div class="blog-box-title"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME']?></a></div>
                        <!-- <div class="post-meta">
                            <span class="post-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?> </span>

                        </div> -->
                        <div class="post-para">
                            <p><?=$arItem['PREVIEW_TEXT']?></p>
                        </div><!--end-post-para-->
                        <div class="r-more">
                            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo GetMessage("CT_BNL_GOTO_DETAIL")?> ></a>
                        </div>
                    </div>


                </div>




            <?endforeach;?>


        </div>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>

