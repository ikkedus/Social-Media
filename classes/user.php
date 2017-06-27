<?php

class user
{
  public $id;
  public $userName;
  public $passWord;
  public $isDeleted;
  public $admin;
  public $firstName;
  public $lastName;
  public $suffix;
  public $email;

  public function __construct($id,$userName,$passWord,$isDeleted,$admin,$firstName,$lastName,$suffix,$email){
    $this->id = $id;
    $this->userName = $userName;
    $this->passWord = $passWord;
    $this->isDeleted = $isDeleted;
    $this->admin = $admin;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->suffix = $suffix;
    $this->email = $email;
  }
  public static function fullName($firstName,$lastName,$suffix){
    $fullname =   $firstName;
    if(!Empty(  $suffix)){
      $fullname .= " ". $suffix;
    }
    $fullname .= " ". $lastName;
    return $fullname;
  }
}
