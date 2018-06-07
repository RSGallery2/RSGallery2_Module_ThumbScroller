<?php
/**
* RSGallery2 mod_rsgallery2_thumb_scroller: Scroll selected thumbnails from RSGallery2 images (www.rsgallery2.org).
* @copyright (C) 2015 RSGallery2 Team
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
**/

defined('_JEXEC') or die();

/*
echo '<h1>mod_rsgallery2_thumb_scroller</h1>' . '<br>';

echo '$UseACL              = ' . $UseACL . '<br>';
echo '$UseGallerySelection = ' . $UseGallerySelection . '<br>';
echo '$GalleryIds          = ' . $GalleryIds . '<br>';
echo '$ScrollDirection     = ' . $ScrollDirection . '<br>';
echo '$ScrollAmount        = ' . $ScrollAmount . '<br>';
echo '$ScrollDelay         = ' . $ScrollDelay . '<br>';

echo '$ImageLinkType       = ' . $ImageLinkType . '<br>';
echo '$DoPause             = ' . $DoPause . '<br>';

echo '$ScrollWidth         = ' . $ScrollWidth . '<br>';
echo '$ScrollWidthUnit     = ' . $ScrollWidthUnit . '<br>';

echo '$ScrollHeight        = ' . $ScrollHeight . '<br>';
echo '$ScrollHeightUnit    = ' . $ScrollHeightUnit . '<br>';

echo '$ImageCount          = ' . $ImageCount . '<br>';
echo '$ImageOrder          = ' . $ImageOrder . '<br>';

echo '$ActivateUserCss     = ' . $ActivateUserCss . '<br>';
echo '$UserCss             = ' . $UserCss . '<br>';



echo '$dbImage.count=' . count ($ImageList) . '<br>';


foreach ($ImageList as $dbImage) {
    echo 'Image Name= ' . $dbImage['name'] . '<br>';
}
*/

echo '<div class="mod_rsgallery2_latest_images">';

if($UserCss){
	echo '<style type="text/css">'.$UserCss.'</style>';
}
	  
// Set the marquee parameters.
echo '    <div class="rsg2_scroller" style="overflow:hidden; position:relative;" >';
echo '     <marquee behavior="scroll" direction="'.$ScrollDirection.'" height="'.$ScrollHeight.$ScrollHeightUnit.'" ';
echo '          width="'.$ScrollWidth.$ScrollWidthUnit.'" ScrollAmount="'.$ScrollAmount.'" scrolldelay="'.$ScrollDelay.'" ';
if ($DoPause){
	echo 'onmouseover=this.stop() onmouseout=this.start() ';
	}
echo '     > '; // end of marquee

echo '<div class="rsscroller_thumb">';

// Loop through the images.
foreach ($ImageList as $dbImage) {

    $Filename = $dbImage['name'];
    $LimitStart = $dbImage['ordering'] - 1;
    /*
        // Insert an <a> tag if the images are clickable.
        if ($Clickornot)
            {
            //display or gallery view
            if($link2gal == 'dis'){
                ?>
                <a title="<?php echo $dbImage->title;?>" href="<?php echo JRoute::_('index.php?option=com_rsgallery2&page=inline&Itemid='.$RSG2Itemid.'&id='.$dbImage->id.'&catid='.$dbImage->gallery_id.'&limitstart='.$limitstart);?>">
                <?php
                }
            elseif($link2gal == 'gal'){
            ?>
                <a title="<?php echo $dbImage->title;?>" href="<?php echo JRoute::_('index.php?option=com_rsgallery2&Itemid='.$RSG2Itemid.'&id='.$dbImage->id.'&catid='.$dbImage->gallery_id);?>">
                <?php
                }
            }
    */

    // The <img> tag
    echo "<img src='" . imgUtils::getImgThumb($Filename) . "' alt='" . $dbImage['title'] . "'>";
    // Insert a </a> tag if the images are clickable.
//	if ($Clickornot){echo "</a>";}
//	}
}
echo '        </marquee>';

echo '    </div>';
echo '</div>';

