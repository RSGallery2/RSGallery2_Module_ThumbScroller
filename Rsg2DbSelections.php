<?php
/**
 * Class Rsg2DbSelections
 * Contains functions to select images, galleries from the RSGallery2 database
 * Returns lists
 * @copyright (C) 2015 RSGallery2 Team
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version 4.0.1
 */
class Rsg2DbSelections
{	
	/**
	* Get a list of all galleries (id/parent) ordered by parent/ordering
	*/
    public function ListOfAllGalleriesOrdered ()
    {
		$database = JFactory::getDBO();
		$query = $database->getQuery(true);
        
		$query->select('id, parent')
		    ->from('#__rsgallery2_galleries')
		    ->order('parent, ordering');
		$database->setQuery( $query );

        $allGalleries = $database->loadObjectList();
        return $allGalleries;
    }
	
	/**
	* Get limited ($count) number of latest images
	* if $gallerySelection is given only requested galleries will be returned
	*/
    public function LatestImagesLimited ($count=0, $gallerySelection=null)
    {
		$database = JFactory::getDBO();
		$query = $database->getQuery(true);
        
		$query->select('*')
			->from('#__rsgallery2_files')
			->where('published = 1');

		/*	NOTE TODO Access should be checked for galleries, not for images
			// If user is not a Super Admin then use View Access Levels
			if (!$superAdmin) { // No View Access check for Super Administrators
				$query->where('access IN ('.$groupsIN.')'); //@todo use trash state: published=-2
			}
		*/
		
		// Select only galleries from what user wants
		if ($gallerySelection) {
			$query->where('gallery_id IN ('.$gallerySelection.')');
		}

		$query->order('date DESC');
		
		// $count is the number of results to return
		$database->setQuery($query, 0, $count);			
		$ImageList = $database->loadAssocList();

// ToDo: database error		
		
		return $ImageList;
	}	


	public function ImageNamesLimitedAndOrdered ($count=0, $gallerySelection=null, $ImageOrder=0)
	{
		$database = JFactory::getDBO();
		$query = $database->getQuery(true);
        
		$query->select('*')
			->from('#__rsgallery2_files')
			->where('published = 1');
		
		// Select only galleries from what user wants
		if ($gallerySelection) {
			$query->where('gallery_id IN ('.$gallerySelection.')');
		}
		// Select only galleries from what user wants
		if ($ImageOrder) {
			$query->order ($ImageOrder);
		}		
		
		// $count is the number of results to return
		$database->setQuery($query, 0, $count);			
		$ImageList = $database->loadAssocList();

// ToDo: database error		
		
		return $ImageList;
		
	}











	
}
