<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/patient/promotions/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/patient/promotions/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/patient/section/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/patient/section/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/detail/(.*)/(.*)#',
    'RULE' => 'ELEMENT_ID=$1',
    'ID' => '',
    'PATH' => '/detail.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/departament/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/departament/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/services/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/blogs/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blogs/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
