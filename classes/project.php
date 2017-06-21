<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/11/2017
 * Time: 5:03 AM
 */

class project
{
    public $id;
    public $projectOwner;
    public $title;
    public $files;
    public $entries;
    public $dateCreated;
    public $description;
    public $banner;
    /**
     * project constructor.
     * @param $projectOwner
     * @param $title
     * @param $files
     * @param $entries
     * @param $dateCreated
     */
    public function __construct($projectOwner, $title, $files, $entries, $dateCreated,$description,$banner,$id)
    {
        $this->id =$id;
        $this->projectOwner = $projectOwner;
        $this->title = $title;
        $this->files = $files;
        $this->banner = $banner;
        $this->entries = $entries;
        $this->dateCreated = $dateCreated;
        $this->description = $description;
    }
}