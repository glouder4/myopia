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
<div class="row">
    <div id="<?= $this->GetEditAreaId($arResult['ID']); ?>" class="col-xs-12 col-sm-12 col-md-12 pull-left doctors-3col-tabs no-pad" >
        <div class="content-tabs tabs col-xs-12 col-sm-12">
            <ul class="nav nav-tabs tab-acc" id="myTab">
                <li <? if (!$arResult['SECTION_SELECTED']){ ?>class="active"<? } ?>>
                    <a href="<?= $arResult['LIST_PAGE_URL'] ?>"><?= GetMessage("OLD") ?></a>
                </li>
                <? foreach ($arResult["SECTION"] as $i => $arItem): ?>
                    <li <? if ($arItem["SELECTED"]) echo "class='active'"; ?>>
                        <a href="<?= $arItem['SECTION_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a></li>
                <? endforeach; ?>
            </ul>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 doctor-box">

            <div>
                <? if ($arResult['DETAIL_PICTURE']['SRC']) { ?><img alt="" class="img-responsive"
                                                                    src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" /><? } ?>
            </div>
            <div class="doc-name">
                <span class="doc-title"><?= $arResult['NAME'] ?></span>
                <hr/>
                <p><?= $arResult['DISPLAY_PROPERTIES']['STR_SPECIAL']['DISPLAY_VALUE'] ? $arResult['DISPLAY_PROPERTIES']['STR_SPECIAL']['DISPLAY_VALUE'] : $arResult['~PREVIEW_TEXT'] ?></p>

                <div class='clinic_block'>
                    <?= $arResult['DISPLAY_PROPERTIES']['IB_CLINIC']['DISPLAY_VALUE'] ?>
                </div>
                <?
                $APPLICATION->IncludeComponent('bit-ecommerce:shedule', '', array('INNER' => true, 'DOCTOR_ID' => $arResult['ID']), $component);
                ?>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 column-element">

            <p><?= $arResult['DETAIL_TEXT'] ?></p>

        </div>
        <?
        if ($arResult['PROPERTIES']['SERTIFIKATE']['VALUE'] == true) {
            ?>

            <div class="row">
                <div class="medical-theme-block col-md-12 col-sm-12 col-lg-12 col-xs-12 column-element" id="db-items">
                    <h3 class="col-xs-12"><?= $arResult['PROPERTIES']['SERTIFIKATE']['NAME'] ?></h3>

                    <? foreach ($arResult['PROPERTIES']['SERTIFIKATE']['VALUE'] as $Sertificate): ?>
                        <div class="col-md-4 col-sm-6 col-lg-4 col-xs-12 buttons-elements">
                            <img
                                data-bx-viewer="image"
                                data-bx-src="<?= CFile::GetPath($Sertificate) ?>?>"
                                data-bx-width="448"
                                data-bx-height="300"
                                class="img-responsive" src="<?= CFile::GetPath($Sertificate) ?>?>">
                        </div>
                    <? endforeach ?>
                    <div class="clear"></div>
                </div>
            </div>


        <? } ?>

    </div>
</div>

<script>
    BX.ready(function () {
        var obImageView = BX.viewElementBind(
            'db-items',
            {showTitle: true, lockScroll: false},
            function (node) {
                return BX.type.isElementNode(node) && (node.getAttribute('data-bx-viewer') || node.getAttribute('data-bx-image'));
            }
        );
    });
</script>
