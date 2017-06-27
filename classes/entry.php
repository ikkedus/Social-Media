<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/11/2017
 * Time: 4:59 AM
 */

class entry
{
    public $id;
    public $text;
    public $postedBy;
    public $date;
    public $type;

    public function __construct($id,$text,$postedBy,$date,$type){
      $this->id= $id;
      $this->text=$text;
      $this->postedBy=$postedBy;
      $this->date=$date;
      $this->type=$type;
    }
}
