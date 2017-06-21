<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/11/2017
 * Time: 6:04 AM
 */

if(isset($_POST) && !empty($_POST['title'])){
    require_once 'classes/projectProvider.php';
    require_once 'classes/project.php';
    require_once 'UploadHelper.php';
    $p = new projectProvider();
    $path = "";
    $error = "";
    $path = UploadHelper::GeneratePath( "uploads/".$_POST['title']);
    $project = new project(1,$_POST['title'],null,null,date("Y-m-d H:i:s"),$_POST['text'],$path);
    $projectid = $p->createNewProject($project);
    UploadHelper::UploadFile($path,$error);
}
?>
<section class="content-header">
    <h1>
        Maak een nieuwe project
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">nieuwe project</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <form class="form-horizontal" method="post" action="/?page=createproject&admin=a" enctype="multipart/form-data">
        <section class="row">
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Titel</label>
            <div class="col-md-4">
                <input id="textinput" name="title" type="text" placeholder="titel" class="form-control input-md" required="">
            </div>
        </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-4 control-label">File</label>
                <div class="col-md-4">
                    <input type="text" readonly="" class="form-control" placeholder="Browse...">
                    <input type="file" name="inputFile" id="inputFile" multiple="">
                </div>
            </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">Omschrijving</label>
            <div class="col-md-4">
                <textarea class="form-control" id="text" name="text">Omschrijving van het project</textarea>
            </div>
        </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textarea"></label>
                <div class="col-md-4">
                    <BUTTON TYPE="submit" name="submit">Make</BUTTON>
            </div>
            </div>
        </section>
    </form>
</section>