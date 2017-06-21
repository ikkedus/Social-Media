<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/19/2017
 * Time: 4:51 PM
 */

class comment
{
    public $text;
    public $postedBy;
    public $postedOn;
    public $projectId;

    /**
     * comment constructor.
     * @param $text
     * @param $postedBy
     * @param $postedOn
     * @param $projectId
     */
    public function __construct($text, $postedBy, $postedOn, $projectId)
    {
        $this->text = $text;
        $this->postedBy = $postedBy;
        $this->postedOn = $postedOn;
        $this->projectId = $projectId;
    }
}