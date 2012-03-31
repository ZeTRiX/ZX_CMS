<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><? echo htmlspecialchars($fullnews[NAME]); ?> - RZ_Engine</title>
<meta name="DESCRIPTION" content="<? echo htmlspecialchars($fullnews[NAME]); ?>">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link href="/templates/default/css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="wrapper">
<header><div id="top_bg">
<div style="float:left;padding:1px 0 0 10px;"><a href="/" alt="RZ_Engine" title="RZ_Engine"><img align="center" src="/templates/default/diz/rzelogo.png"/></a></div>
<div id="top_menu">Любая<span class="dot">•</span>Информация</div>
</div></header>
<div id="main"><div id="content">
<? require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/sidebar.tpl');
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/content.tpl'); ?>