<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/11/2017
 * Time: 12:47 AM
 */

require_once 'DatabaseConnection.php';

class UserProvider
{
  function createUser($newUser){
    if(!$this->checkIfExists($newUser->userName)){
        $user = R::dispense('user');
        $user->userName = $newUser->userName;
        $user->passWord = $newUser->passWord;
        $user->email = $newUser->email;
        $user->isDeleted = $newUser->isDeleted;
        $user->admin = $newUser->admin;
        $user->firstName = $newUser->firstName;
        $user->lastName =$newUser->lastName;
        $user->suffix = $newUser->suffix;
        R::store($user);
    }
  }
  function checkIfExists($username){
      $user = R::findOne('user','is_deleted =0 && user_name = "'.$username.'"');
      return $user != null;
  }
  function deleteUser($id){
      $user = R::load('user',$id);
      $user->isDeleted = true;
  }
  function updateUser($editUser){
      $user = R::load('user',$editUser->id);
      $user->userName = $editUser->userName;
      $user->passWord = $editUser->passWord;
      $user->email = $editUser->email;
      $user->isAdmin = $editUser->$isAdmin;
      $user->firstName = $editUser->$firstName;
      $user->lastName =$editUser->$lastName;
      $user->suffix = $editUser->$suffix;
  }
  function authenticateUser($userName,$passWord){
    $user = R::findOne('user','is_deleted =0 && user_name = "'.$userName.'" && pass_word = "'.$passWord.'"');
    $user->passWord = null;
    return $user;
  }
}
?>
