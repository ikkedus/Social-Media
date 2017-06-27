<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/12/2017
 * Time: 10:42 PM
 */
require_once 'classes/projectProvider.php';
$p = new projectProvider();
$project = $p->getProject($_GET['projectId']);

if(isset($_POST) && !empty($_POST['title'])){
    require_once 'classes/projectProvider.php';
    require_once 'classes/project.php';
    require_once 'UploadHelper.php';
    $p = new projectProvider();
    $path = "";
    $error = "";
    $path = UploadHelper::GeneratePath( "uploads/".$_POST['title']);
    $editproject = new project($user->id,$_POST['title'],null,null,date("Y-m-d H:i:s"),$_POST['text'],$path,$project->id,0);
    $projectid = $p->updateProject($editproject);
    UploadHelper::UploadFile($path,$error);
}
?>
<section class="content-header">
    <h1>
        pas project aan
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">nieuwe project</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <form class="form-horizontal" method="post" action="/?page=editProject&admin=1&projectId=<?php echo $project->id;?>" enctype="multipart/form-data">
        <section class="row">
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Titel</label>
                <div class="col-md-4">
                    <input id="textinput" name="title" value="<?php echo $project->title; ?>" type="text" placeholder="titel" class="form-control input-md" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-4 control-label">File</label>
                <div class="col-md-4">
                    <input type="text" readonly="" class="form-control" placeholder="Zoek...">
                    <input type="file" name="inputFile" id="inputFile" multiple="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textarea">Omschrijving</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="text" name="text"><?php echo $project->description; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textarea"></label>
                <div class="col-md-4">
                    <BUTTON TYPE="submit" name="submit">Opslaan</BUTTON>
                </div>
            </div>
        </section>
    </form>
    <section class="">
      <a href="<?php echo "/?page=addEntry&admin=1&projectId=$project->id"; ?>" class="btn btn-primary">nieuwe entry maken</a>
    </section>
    <section class="entries box">
        <table class="table table-responsive table-condensed">
            <tr><th>#</th><th>post</th><th>datum</th><th></th></tr>
        <?php
        if($project->ownEntryList != null){
            foreach ($project->ownEntryList as &$value){
               echo "<tr>
               <th>$value->id</th>
               <th><p>$value->post </p></th>
               <th>$value->date</th>
               <th><a href=/?page=editEntry&admin=1&projectId=$project->id&entryId=$value->id class='btn-primary'>edit</a></th>
             </tr>";
            }
        }
        ?>
        </table>
    </section>
</section>
