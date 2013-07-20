<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	<meta name="author" content="Ryan Schie" />
	<meta name="dcterms.rightsHolder" content="Ryan Schie" />
	<meta name="dcterms.dateCopyrighted" content="2013" />
	<meta name="robots" content="index, follow" />
	<meta name="description" content="A convenient location to store your lists, all saved to the cloud." />
	<meta name="keywords" content="list, lists, app, organization" />

	<title><?php echo (!empty($title)) ? $title . ' - ' : ''; ?>Lists App</title>

<!--	<link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />-->
	<link rel="stylesheet" href="<?php echo PUBLIC_HTML; ?>css/screen.css" type="text/css" media="screen,projection" />
	<link rel="stylesheet" href="<?php echo PUBLIC_HTML; ?>css/new.css" type="text/css" media="screen,projection" />

</head>

<body lang="en-US">
<div id="header">
	<h1><a href="./">Lists App</a></h1>
	<div id="account">
<!--		<p><a href="><?php //echo PUBLIC_HTML; ?>account/logout" class="button dark">Log Out</a> <a href="><?php //echo PUBLIC_HTML; ?>account" class="button dark">My Account</a></p>-->
	    <p><a href="<?php echo PUBLIC_HTML; ?>account/register" class="button dark">Sign Up</a> <a href="<?php echo PUBLIC_HTML; ?>account/login" class="button dark">Log In</a></p>
	</div>
	<div class="border"></div>
</div>

<div id="page-wrap">