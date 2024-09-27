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
CJSCore::Init(Array("viewer"));
$this->setFrameMode(true);
?>


<div class="medical-theme-block col-md-8 col-sm-8 col-lg-8 col-xs-8" id="db-items">
    <h3><?= $arResult['PROPERTIES']['SERTIFIKATE']['NAME'] ?></h3>

    <? foreach ($arResult["ITEMS"] as $Sertificate):
    if($key % 3 == 0)
	    echo '<div style="width:100%;height: 0; clear: both;"></div>';
    ?>
    <div class="col-md-4 col-sm-6 col-lg-4 col-xs-12 buttons-elements" ">
    <div class="zoom-wrap">
        <center><h4><?= $Sertificate['NAME'] ?></h4></center>
        <img
            onload="this.parentNode.className='feed-com-img-wrap';"
            data-bx-viewer="image"
            data-bx-src="<?= $Sertificate['PREVIEW_PICTURE']['SRC'] ?>"
            data-bx-width="448"
            data-bx-height="300"
            class="img-responsive" src="<?= $Sertificate['PREVIEW_PICTURE']['SRC'] ?>">
    </div>
</div>
<? endforeach ?>
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