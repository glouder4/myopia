<?php
    $rsSites = CSite::GetList($by="sort", $order="asc", array("DEFAULT" => 'Y'));
    while ($arSite = $rsSites->Fetch()) {
        $SITE = $arSite;
    }
    $CUR_COLOR_MAIN = COption::GetOptionString("firstbit.med", "FIRSTBIT_MED_COLOR_MAIN", false, $SITE['LID']);
    $CUR_COLOR_MAIN_ADD = COption::GetOptionString("firstbit.med", "FIRSTBIT_MED_COLOR_MAIN_ADD", false, $SITE['LID']);

    ?>
<style>
    a,
    a:hover,
    .auth_panel .fa-user:before,
    .auth_panel a:hover span,
    .dropdown-menu >li >a:hover,
    .catagory-list li a .about-list-arrows,
    .dept-tabs-icon,
    .catagory-list li a:hover,
    .event-date,
    .icon-box-3:hover .icon-box2-title,
    .service-box a,
    .doc-name-class,
    .post-meta-top li,
    .dept-icon,
    .dept-details-butt,
    ul.left-menu li a,
    .tabs-left .nav-tabs >li.active >a,
    .tabs-left .nav-tabs >li.active >a:hover{
        color: <?=$CUR_COLOR_MAIN;?>;
    }
    li.flexMenu-viewMore >a{
        color: <?=$CUR_COLOR_MAIN;?>!important;
    }
    .auth_panel a:hover span,
    .auth_panel_submenu{
        border-bottom-color: <?=$CUR_COLOR_MAIN;?>;
    }
    ::selection,
    .navbar-default .navbar-nav >li >a:before,
    .bread-crumb,
    .catagory-list li a:hover .about-list-arrows,
    .appointment-form-title,
    .news-button,
    .iconbox-readmore,
    .icon-box-3:hover .iconbox-readmore,
    .service-title .fa,
    #home-page-version-five .purchase-btn,
    .inner-page-butt-blue,
    .ui-accordion-header-active .dept-icon,
    .purchase-strip-blue.dept-apponit-butt .btn,
    ul.left-menu li.selected,
    ul.left-menu li.selected a,
    ul.left-menu li:hover,
    ul.left-menu li:hover a,
    input.auth-sumbit.btn,
    .collapse-widget-side .ui-state-default .collapse-cheveron:before,
    .collapse-widget-side .ui-state-default .collapse-cheveron:after,
    .tabs-left .nav-tabs >li.active >a .dept-tabs-icon{
        background: <?=$CUR_COLOR_MAIN;?>;
    }
    .dropdown-menu >.active >a,
    input.iblock_submit,
    #scrollUp,
    .dept-details-butt,
    .dept-details-butt:hover,
    #shedule_form .clinics .clinic .open_doctors{
        background-color: <?=$CUR_COLOR_MAIN;?>;
    }
    .dept-details-butt{
        color: white;
    }
    .tabs-left >.nav-tabs >li >a:hover .dept-tabs-icon,
    .ui-state-active,
    .collapse-widget-side .ui-state-active{
        background-color: <?=$CUR_COLOR_MAIN;?>!important;
    }
    .iconbox-readmore,
    .icon-box-3:hover .iconbox-readmore,
    #home-page-version-five .medical-theme-block,
    .inner-page-butt-blue,
    .purchase-strip-blue.dept-apponit-butt .btn,
    .dept-details-butt,
    ul.left-menu li{
        border-color: <?=$CUR_COLOR_MAIN;?>;
    }
    .inner-page-butt-blue,
    .appointment-form .btn-7{
        box-shadow: 0 2px <?=$CUR_COLOR_MAIN_ADD;?>;
    }
    .service-box .rot-y .panel-icon:after{
        border-top-color: <?=$CUR_COLOR_MAIN;?>;
    }
    .service-box p{
        border-bottom-color: <?=$CUR_COLOR_MAIN;?>;
    }

    @media screen and (max-width: 767px) {
        .dept-tabs-icon {
            color: <?=$CUR_COLOR_MAIN;?> !important;
        }
        .tabs-left .nav-tabs >li.active >a .dept-tabs-icon,
        .tabs-left .nav-tabs >li.active >a:hover .dept-tabs-icon{
            background: <?=$CUR_COLOR_MAIN;?>!important;
        }
    }
    @media screen and (min-width: 768px) {
        .dropdown-menu {
            border-top-color: <?=$CUR_COLOR_MAIN;?> !important;
        }
    }
    @media screen and (min-width: 992px) {
        .navbar-default .navbar-nav > .active > a:before {
            background: <?=$CUR_COLOR_MAIN;?>;
        }
        .navbar-default .navbar-nav >.active >a{
            color: <?=$CUR_COLOR_MAIN;?>;
        }
    }
    @media screen and (min-width: 768px) and (max-width: 991px) {
        .tabs-left .nav-tabs >li.active >a .dept-tabs-icon,
        .tabs-left .nav-tabs >li.active >a:hover .dept-tabs-icon{
            background: <?=$CUR_COLOR_MAIN;?> !important;
        }
        .dept-tabs-icon,
        .tabs-left .nav-tabs >li.active >a,
        .tabs-left .nav-tabs >li.active >a{
            color: <?=$CUR_COLOR_MAIN;?> !important;
        }
    }

    .icon-boxwrap2{
        background-color: <?=$CUR_COLOR_MAIN;?>;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0, <?=$CUR_COLOR_MAIN;?>), color-stop(50%, <?=$CUR_COLOR_MAIN;?>), color-stop(51%, <?=$CUR_COLOR_MAIN_ADD;?>), color-stop(100%, <?=$CUR_COLOR_MAIN_ADD;?>));
        background: -webkit-linear-gradient(top, <?=$CUR_COLOR_MAIN;?> 0, <?=$CUR_COLOR_MAIN;?> 50%, <?=$CUR_COLOR_MAIN_ADD;?> 51%, <?=$CUR_COLOR_MAIN_ADD;?> 100%);
        background: -moz-linear-gradient(top, <?=$CUR_COLOR_MAIN;?> 0, <?=$CUR_COLOR_MAIN;?> 50%, <?=$CUR_COLOR_MAIN_ADD;?> 51%, <?=$CUR_COLOR_MAIN_ADD;?> 100%);
        background: -o-linear-gradient(top, <?=$CUR_COLOR_MAIN;?> 0, <?=$CUR_COLOR_MAIN;?> 50%, <?=$CUR_COLOR_MAIN_ADD;?> 51%, <?=$CUR_COLOR_MAIN_ADD;?> 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0, <?=$CUR_COLOR_MAIN;?>), color-stop(50%, <?=$CUR_COLOR_MAIN;?>), color-stop(51%, <?=$CUR_COLOR_MAIN_ADD;?>), to(<?=$CUR_COLOR_MAIN_ADD;?>));
        background: linear-gradient(top, <?=$CUR_COLOR_MAIN;?> 0, <?=$CUR_COLOR_MAIN;?> 50%, <?=$CUR_COLOR_MAIN_ADD;?> 51%, <?=$CUR_COLOR_MAIN_ADD;?> 100%);
    }
</style>
