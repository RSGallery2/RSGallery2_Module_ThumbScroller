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
// Number of  latest galleries to display = number of rows times the number of columns
$countrows			= (int) $params->get('countrows', 		'1');
$countcolumns		= (int) $params->get('countcolumns',	'1');
$count				= $countrows * $countcolumns;
// Select one or more galleries and set if their subgalleries (children) should be included
$galleryids			= $params->get('galleryids', 			'0'); //string, e.g. 3,8,42
$includeChildren	= $params->get('includechildren', 		'0');
// Display type of image to show: thumb (0), display (1), original (2)
$displaytype 		= (int) $params->get('displaytype', 	'0');
// CSS height and/or width attribute for the img and the div element (0=no attribute)
$imageheight 		= (int) $params->get('imageheight', 	'0');
$imagewidth 		= (int) $params->get('imagewidth', 		'0');
$divheight 			= (int) $params->get('divheight', 		'0');
$divwidth 			= (int) $params->get('divwidth', 		'0');
// ... for the div with class mod_rsgallery2_latest_galleries_name
$divNameHeight		= (int) $params->get('divnameheight', 	'0');
//$divNameWidth		= (int) $params->get('divnamewidth', 	'0');	// The width setting of the class mod_rsgallery2_latest_galleries_attibute would overrule this, so makes no sense to do this now?
// Display the gallery name
$displayname 		= $params->get('displayname', 			'0');
// Display the date and its format
$displaydate 		= $params->get('displaydate', 			'0');
$dateformat 		= $params->get('dateformat', 			'd-m-Y');
$ImageLinkType      = $params->get('imagelinktype', 		'0');

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

















//// Include the syndicate functions only once
//require_once dirname(__FILE__) . '/helper.php';
 
//$hello = modHelloWorldHelper::getHello($params);
require JModuleHelper::getLayoutPath('mod_rsgallery2_thumb_scroller');