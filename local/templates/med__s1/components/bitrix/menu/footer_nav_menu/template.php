<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if (!empty($arResult)): ?>

    <ul class="nav navbar-nav" >
        <?
        $previousLevel = 0;
        foreach($arResult as $arItem) { ?>
            <li>
                <a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
            </li>
        <?php }
        ?>
    <ul>


<?php
    endif;;
?>
