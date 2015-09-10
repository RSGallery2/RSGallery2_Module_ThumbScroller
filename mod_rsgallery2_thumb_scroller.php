<?php
 

/**
* RSGallery2 thumbnail scroller module:
* Shows latest galleries from the Joomla extension RSGallery2 (www.rsgallery2.nl).
* @copyright (C) 2012-2015 RSGallery2 Team
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @version 4.0.0
* @ Develpment in order of newest appearance
* @ Adapted for J! 3.x Thomas finnern
* @ Modified by Daniel Tulp DT^2 Joomla! based webdesign http://design.danieltulp.nl
* @ Modified by Radek Kafka to work in Joomla 1.5.x
* @ Module based on RSgallery thumbnailscroller by J van Kranenburg
* @ Which is based on: AKO Gallery Thumbnail Scroller
**/

// No direct access
defined('_JEXEC') or die;


// returns links to be used in Jroute() to images views inside galleries
require_once dirname(__FILE__) . '/Rsg2ImageRoutes.php';

// Initialise RSGallery2 and other variables
require_once(JPATH_BASE.'/administrator/components/com_rsgallery2/init.rsgallery2.php');

// Add styling
$document = JFactory::getDocument();
$url = JURI::base().'modules/mod_rsgallery2_latest_images/css/mod_rsgallery2_latest_images.css';
$document->addStyleSheet($url);

global $rsgConfig;

//--- Parameters --------------------------------------------------------------


/*
$Clickornot 	= 			$params->get( 'Clickornot',		'1');
$link2gal		= trim   (	$params->get( 'link2gal',		'dis'));
$Pause			= 			$params->get( 'Pause',			'1');
$useACL 		= 			$params->get( 'useACL',			'0');
$usegalselect 	= 			$params->get( 'usegalselect',	'0');
$galselect 		= 			$params->get( 'galselect');		
$Width			= intval (	$params->get( 'Width',			'80'));
$WidthUnit	 	= trim 	(	$params->get( 'widthunit',		'%'));
$Height			= intval (	$params->get( 'Height',			'150'));
$HeightUnit	 	= trim 	(	$params->get( 'heightunit',		'px'));
$PicsNum		= intval (	$params->get( 'PicsNum',		'5'));
$PickMethod		= trim   (	$params->get( 'PickMethod',		'Rand()'));
$ScrollDirection= trim   (	$params->get( 'ScrollDirection','up'));
$ScrollAmount	= intval (	$params->get( 'ScrollAmount',	'2'));
$ScrollDelay	= intval (	$params->get( 'ScrollDelay',	'50'));
$ScrollSpace	= intval (	$params->get( 'ScrollSpace',	'2'));
$BugSpace		= intval (	$params->get( 'BugSpace',		'10'));
$usecss			=			$params->get( 'usecss',			'1');
$css			=			$params->get( 'css');
*/

$UseACL              =		   $params->get( 'UseACL',			     '0');
$UseGallerySelection =		   $params->get( 'UseGallerySelection', '0');
$SelectGalleries     = trim   ($params->get( 'SelectGalleries',	 '');
$ScrollDirection     = trim   ($params->get( 'ScrollDirection',	 'up');
$ScrollAmount        = intval ($params->get( 'ScrollAmount',		 '');
$ScrollDelay         = intval ($params->get( 'ScrollDelay',		 '');

$ImageLinkType       =		   $params->get( 'ImageLinkType',		 '');
$DoPause             =		   $params->get( 'DoPause',			 '');

$ScrollWidth         = intval ($params->get( 'ScrollWidth',		 ''));
$ScrollWidthUnit     =		   $params->get( 'ScrollWidthUnit',	 '');

$ScrollHeight        = intval ($params->get( 'ScrollHeight',		 '');
$ScrollHeightUnit    =		   $params->get( 'ScrollHeightUnit',	 '');

$ImageNumber         = intval ($params->get( 'ImageNumber',		 '');
$ImageSource         =		   $params->get( 'ImageSource',		 '');

$ActivateUserCss     =		   $params->get( 'ActivateUserCss',	 '');
$UserCss             =		   $params->get( 'UserCss',			 '');


//// Include the syndicate functions only once
//require_once dirname(__FILE__) . '/helper.php';
 
//$hello = modHelloWorldHelper::getHello($params);
require JModuleHelper::getLayoutPath('mod_rsgallery2_thumb_scroller');