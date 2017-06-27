<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/11/2017
 * Time: 6:04 AM
 */

if(isset($_POST) && !empty($_POST['text'])){
    require_once 'classes/projectProvider.php';
    require_once 'classes/entry.php';
    $p = new projectProvider();
    $entry = new entry(0, $_POST['text'],$user->id,0,"commit");
    $p->createEntry($_GET['projectId'],$entry);
    echo "<section class='box box-header'>
    succes
    </section>";
}
?>
<section class="content-header">
    <h1>
        Maak een nieuwe entry
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li class="active">nieuwe entry</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <form class="form-horizontal" method="post" action="<?php echo"/?page=addEntry&admin=1&projectId=".$_GET['projectId']; ?>" enctype="multipart/form-data">
        <section class="row">
        <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">text</label>
            <div class="col-md-4">
                <textarea class="form-control" id="text" name="text">voer in nieuwe entry</textarea>
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
