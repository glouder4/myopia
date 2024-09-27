<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="about-us-version-two">
    <div class="slider-border">
        <div id="main_area">
            <!-- Slider -->
            <div id="slider slider-section ">
                <!-- Top part of the slider -->
                <div id="carousel-bounding-box">
                    <div class="carousel slide" id="photo-carousel">
                        <!-- Carousel items -->
                        <div class="carousel-inner carousel-inner-border">
                            <? foreach ($arResult["ITEMS"] as $i => $arItem): ?>
                                <?
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                <div class="<? if ($i == 0) { ?>active <? } ?>item" data-slide-number="<?= $i ?>"
                                     id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                    <img alt="" class="img-responsive" src="<?= $arItem['DETAIL_PICTURE']['SRC'] ?>"/>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <!-- Carousel nav -->
                        <a class="left left-arrow-section carousel-control" href="#photo-carousel" role="button"
                           data-slide="prev">
                            <span class="fa fa-arrow-left"></span>
                        </a>
                        <a class="right right-arrow-section carousel-control" href="#photo-carousel" role="button"
                           data-slide="next">
                            <span class="fa fa-arrow-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!--/Slider-->
        </div>
        <div class="hidden-xs" id="slider-thumbs">
            <!-- Bottom switcher of slider -->
            <ul class="hide-bullets">
                <? foreach ($arResult["ITEMS"] as $i => $arItem): ?>
                    <li class="thumbnail-img <? if ($i == 0) { ?>block1<? } ?>">
                        <a class="thumbnail thumbnail-setting" id="carousel-selector-<?= $i ?>"><img alt=""
                                                                                                     class="img-responsive"
                                                                                                     src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"/></a>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
</div>