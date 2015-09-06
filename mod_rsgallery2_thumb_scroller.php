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


//// Include the syndicate functions only once
//require_once dirname(__FILE__) . '/helper.php';
 
//$hello = modHelloWorldHelper::getHello($params);
require JModuleHelper::getLayoutPath('mod_rsgallery2_thumb_scroller');