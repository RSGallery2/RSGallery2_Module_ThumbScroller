<?php
 

/**
* RSGallery2 thumbnail scroller module:
* Shows latest galleries from the Joomla extension RSGallery2 (www.rsgallery2.org).
* @copyright (C) 2012-2019 RSGallery2 Team
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

// Returns lists of galleries and images 
require_once dirname(__FILE__) . '/Rsg2DbSelections.php';

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

$UseACL              =		   $params->get( 'UseACL',			    '0');
$UseGallerySelection =		   $params->get( 'UseGallerySelection', '0');
$GalleryIds          = trim   ($params->get( 'SelectGalleries',	    ''));
$ScrollDirection     = trim   ($params->get( 'ScrollDirection',	    'up'));
$ScrollAmount        = intval ($params->get( 'ScrollAmount',		''));
$ScrollDelay         = intval ($params->get( 'ScrollDelay',		    ''));

$ImageLinkType       =		   $params->get( 'ImageLinkType',		'');
$DoPause             =		   $params->get( 'DoPause',			    '');

$ScrollWidth         = intval ($params->get( 'ScrollWidth',	  	    ''));
$ScrollWidthUnit     =		   $params->get( 'ScrollWidthUnit',	    '');

$ScrollHeight        = intval ($params->get( 'ScrollHeight',		''));
$ScrollHeightUnit    =		   $params->get( 'ScrollHeightUnit',	'');

$ImageCount          = intval ($params->get( 'ImageNumber',  	    ''));
$ImageOrder          =		   $params->get( 'ImageSource',		    '');

$ActivateUserCss     =		   $params->get( 'ActivateUserCss',	    '');
$UserCss             =		   $params->get( 'UserCss',			    '');

$IncludeChildren	 =         $params->get( 'includechildren',    '0');


//--- Image links preparation -------------------------------------------

$Rsg2DbSelections = new Rsg2DbSelections ();

//--- Db image selections preparation -------------------------------------------

$Rsg2ImageRoutes = new Rsg2ImageRoutes ();

//--- Take View Access into account -------------------------------------------

$user 		= JFactory::getUser();
$groups		= $user->getAuthorisedViewLevels();
$groupsIN 	= implode(", ",array_unique ($groups));
$superAdmin = $user->authorise('core.admin');

//--- Select specific galleries and possibly subs -----------------------------

// Selection requested ?
if ($GalleryIds) {
	$galleryArray = explode(',', $GalleryIds);
    
	// Include children?
	if ($includeChildren) {
        
		// All galleries
		$allGalleries = $Rsg2DbSelections->ListOfAllGalleriesOrdered (); 
		
		// Collect children -> 2dim. array $children[parentid][]
		// Establish the hierarchy by first getting the children 
		$children = array();
		if ( $allGalleries ) {
			foreach ( $allGalleries as $v ) {
				$pt     = $v->parent;
				$list   = @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}
		}
        
		// Function to build children tree list 
		function treerecurse($ParentId,  $list, &$children, $maxlevel=20, $level=0) {
			// if there are children for this id and the max.level isn't reached
			if (@$children[$ParentId] && $level <= $maxlevel) {
				// Add each child to the $list and ask for its children
				foreach ($children[$ParentId] as $v) {
					$id = $v->id;	//gallery id
					$list[$id] = $v;
					$list[$id]->level = $level;
					//$list[$id]->children = count(@$children[$id]);
					$list = treerecurse($id,  $list, $children, $maxlevel, $level+1);
				}
			}
			return $list;
		}

		// Get the children of the user selected galleries
		$extendedSelection = $galleryArray;
		foreach ($galleryArray as $galUser) {
            // Get list of galleries with (grand)children in the right order and with level info
    		$recursiveGalleriesList = treerecurse( $galUser, array(), $children, 20, 0 );
			foreach ($recursiveGalleriesList as $gal) {
				array_push($extendedSelection, $gal->id);
			}
		}
		$gallerySelection = implode(", ",array_unique ($extendedSelection));
	} else {	// Don't include children
		$gallerySelection = implode(", ",array_unique ($galleryArray));
	}
} else {
	// No 'where' clause needed to limit the search of galleries from
	$gallerySelection = 0;
}

//--- Query images -----------------------------------------------------

// Query to get limited ($count) number of latest images
$ImageList = $Rsg2DbSelections->ImageNamesLimitedAndOrdered ($ImageCount, $gallerySelection, $ImageOrder);
if(!$ImageList){
	// Error handling
	// ToDo: Ask module admin if a message is required (?debug) and to provide this error message
	// enque message
}

//--- Output ------------------------------------------------------------------
 
require JModuleHelper::getLayoutPath('mod_rsgallery2_thumb_scroller');


