<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/13/2017
 * Time: 12:43 AM
 */
require_once 'classes/projectProvider.php';
require_once 'classes/UserProvider.php';
require_once 'classes/user.php';
require_once 'classes/entry.php';
require_once 'classes/comment.php';
session_start();
if(!isset($_GET['function']) || !empty($_GET['function'])){
    $_GET['function']();
}

function removeEntry(){
    $p = new projectProvider();
    $p->deleteEntry($_POST['id']);
}
function createEntry(){
    $entry = new Entry();
    $entry->text = $_POST["text"];
    $entry->type = $_POST["type"];
    $p = new projectProvider();
    $p->createEntry($_POST['projectId'],$entry);
}
function updateEntry(){
    $entry = new Entry();
    $entry->id = $_POST["id"];
    $entry->text = $_POST["text"];
    $p = new projectProvider();
    $p->updateEntry($entry);
}
function getEntries(){
  $p = new projectProvider();
  echo $p->getEntries($_POST['projectId']);
}

function createComment(){
    $comment = new comment();
    $comment->text = $_POST['text'];
    $comment->postedBy = "Hiemler";
    $p = new projectProvider();
    $p->createComnment($_POST['projectId'],$comment);
}
function removeComment(){
    $p = new projectProvider();
    $p->removeComnment($_POST['Comment_Id']);
}
function getComments(){
    $p = new projectProvider();
    echo json_encode($p->getComnments($_POST['projectId']));
}
function createTestUser()
{
  $user = new user(0,'ikkedus','123',false,true,'martin','gragt','van der','a@a.nl');
  $u = new UserProvider();
  $u->createUser($user);
}
function createUser()
{
  $user = new user(0,
  $_POST['userName'],
  $_POST['passWord'],
  false,
  $_POST['admin'],
  $_POST['firstName'],
  $_POST['lastName'],
  $_POST['suffix'],
  $_POST['email']);
  $u = new UserProvider();
  $u->createUser($user);
}

function authenticate(){
  $u = new UserProvider();
  $dbuser= $u->authenticateUser("ikkedus","123");
  if($dbuser !=null){
      $user = new user($dbuser->id,$dbuser->username,"",false,$dbuser->admin,$dbuser->firstName,$dbuser->lastName,$dbuser->suffix,$dbuser->email);
      $_SESSION['user'] = ($user);
  }
}
