<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/11/2017
 * Time: 12:47 AM
 */
//dit importeerd de database connection code.
require_once 'DatabaseConnection.php';

class projectProvider
{

    function getProject($id){]
        //wegens de gebruikte ORM laad ik de gegevens op deze manier R is de DatabaseConnection project is de tabel en id is de record die ik wil ophalen.
        $project =R::load('project',$id);
        return $project;
    }
    function getAllProjectsOfUser($id){
        return R::find('project',' project_owner = ? ',
            array( $id )
        );
    }
    function getAllProjects(){
      return R::loadAll('project');
    }
    function getEntry($id){
      $project =R::load('entry',$id);
      return $project;
    }
    //deze functie krijgt een model binnen van het type project
    function createNewProject($project)
    {
        //dispense zegt maak nieuwe record van het gegeven type in dit geval project.
        $projectObject = R::dispense('project');
        $projectObject->projectOwner = $project->projectOwner;
        $projectObject->title = $project->title;
        $projectObject->banner = $project->banner;
        if ($project->files != null) {
            foreach ($project->files as &$value) {
                //de orm heeft een namingconvention als ik own en list toevoeg aan een waardenaam weet hij dat het een one to many relatie is.
                //en zal hij dit automatich toepassen
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
        //dit geeft de orm opdracht om het nieuwe object te opslaan.
        return R::store($projectObject);
    }
    function updateProject($project){
        //om records aantepassen laad je ze eerst uit de database.
        //om ze vervolgens aan tepassen met wat logica.
        $dbproject = R::load('project',$project->id);
        $dbproject->title = (Empty($project->title) ? $dbproject->title : $project->title);
        $dbproject->description = (Empty($project->description) ? $dbproject->description : $project->description);
        $dbproject->projectOwner = (Empty($project->projectOwner) ? $dbproject->projectOwner : $project->projectOwner);
        $dbproject->dateLastUpdated = date("Y-m-d H:i:s");
        $dbproject->banner = (Empty($project->banner) ? $dbproject->banner : $project->banner);
        //en als je klaar bent op te slaan.
        R::store($dbproject);
    }
    function createEntry($projectId,$entry){
        $project =R::load('project',$projectId);
        //laad het project en voeg een object to. zodat de one to many relatie efficent werkt.
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
