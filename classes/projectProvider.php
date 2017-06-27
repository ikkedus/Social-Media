<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/11/2017
 * Time: 12:47 AM
 */

require_once 'DatabaseConnection.php';

class projectProvider
{
    function getProject($id){
        $project =R::load('project',$id);
        return $project;
    }
    function getAllProjectsOfUser($id){

        return R::find('project',' project_owner = ? ',
            array( $id )
        );
    }
    function createNewProject($project)
    {
        $projectObject = R::dispense('project');
        $projectObject->projectOwner = $project->projectOwner;
        $projectObject->title = $project->title;
        $projectObject->banner = $project->banner;
        if ($project->files != null) {
            foreach ($project->files as &$value) {
                $projectObject->ownFileList[] = $this->createFileEntryObject($value);
            }
        }
        if($project->entries != null){
            foreach ($project->entries as &$value) {
                 $projectObject->ownEntryList[] = $this->createEntryObject($value);
         }
        }
        $projectObject->dateCreated = date("Y-m-d H:i:s");
        $projectObject->dateLastUpdated = date("Y-m-d H:i:s");
        $projectObject->description = $project->description;
        return R::store($projectObject);
    }
    function updateProject($project){
        $dbproject = R::load('project',$project->id);
        $dbproject->title = (Empty($project->title) ? $dbproject->title : $project->title);
        $dbproject->description = (Empty($project->description) ? $dbproject->description : $project->description);
        $dbproject->projectOwner = (Empty($project->projectOwner) ? $dbproject->projectOwner : $project->projectOwner);
        $dbproject->dateLastUpdated = date("Y-m-d H:i:s");
        $dbproject->banner = (Empty($project->banner) ? $dbproject->banner : $project->banner);
        R::store($dbproject);
    }
    function createEntry($projectId,$entry){
        $project =R::load('project',$projectId);
        $project->ownEntryList[] = $this->createEntryObject($entry);
        R::store($project);
    }
    function createEntryObject($entry){
        $projectEntry = R::dispense('entry');
        $projectEntry->postedBy= $entry->postedBy;
        $projectEntry->post=$entry->text;
        $projectEntry->date=date("Y-m-d H:i:s");
        $projectEntry->type = $entry->type;
        R::store($projectEntry);
        return $projectEntry;
    }
    function updateEntry($entry){
        $dbentry =R::load('entry',$entry['id']);
        $dbentry->postedBy = $_SESSION['user']['id'];
        $dbentry->post=$entry['text'];
        $dbentry->date=date("Y-m-d H:i:s");
        $dbentry->type=$entry['type'];
        R::store($dbentry);
    }
    function updateEntries($entries){
        foreach ($entries as &$value){
            $this->updateEntry($value);
        }
    }
    function createFileEntry($projectId,$fileEntry){
        $project =R::load('project',$projectId);
        $project->ownFileList[] = $this->createFileEntryObject($fileEntry);
        R::store($project);
    }
    function createFileEntryObject($fileEntry){
        $file = R::dispense('file');
        $file->uploadedBy=$_SESSION['user']['id'];
        $file->uploadedOn=date("Y-m-d H:i:s");
        $file->title=$fileEntry->title;
        R::store($file);
        return $file;
    }
    function deleteProject($id){
        $project =R::load('project',$id);
        R::trash($project);
    }
    function deleteEntry($id){
        $entry =R::load('entry',$id);
        R::trash($entry);
    }
    function deleteFileEntry($id){
        $file =R::load('file',$id);
        R::trash($file);
    }
    function createComnment($project_id,$comment){
        $project =R::load('project',$project_id);
        $newComment = R::dispense('comment');
        $newComment->text = $comment->text;
        R::store($newComment);
        $project->ownCommentsList[]=$newComment;
        R::store($project);
    }
    function getComnments($id){
        return R::find('comment',' project_id = ? ',
            array( $id )
        );
    }
    function getEntries($id){
      $project =R::load('project',$id);
      return $project->ownEntryList;
    }
    function removeComnment($id){
        $comment = R::load('comment',$id);
        R::trash($comment);
    }
}
