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
CUtil::InitJSCore(array('fx'));
CJSCore::Init(Array("viewer"));
?>
    <div id="blog-medium-left">
        <div id="blog-full-width-post">
<?/*?>
            <div class="blog-box-title"><?= $arResult['NAME'] ?></div>
<?*/?>

            <div class="post-meta">
                <span class="post-date"><? echo $arResult["DISPLAY_ACTIVE_FROM"] ?> </span>
            </div>
            <p class="para1"><?= $arResult['DETAIL_TEXT'] ?></p>


            <div class="carousel-inner">

                <div class="item active">
                    <? if ($arResult['DETAIL_PICTURE']['SRC']) { ?> <img
                        src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>"" alt=""><? } ?>

                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= $arResult["LIST_PAGE_URL"] ?>"
                           class="back-btn"><?= GetMessage('BIT_GO_BACK') ?></a>
                    </div>
                    <div class="ya-share2 col-lg-6 col-md-6 col-sm-6 col-xs-12"
                         data-services="vkontakte,facebook,odnoklassniki,moimir,twitter" data-counter=""></div>
                </div>
            </div>
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
<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>