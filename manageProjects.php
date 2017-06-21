
<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/12/2017
 * Time: 8:45 PM
 */
require_once 'classes/projectProvider.php';
$p = new projectProvider();
$projects = $p->getAllProjectsOfUser(1);

?>
<section class="content-header">
    <h1>
        Maak een nieuwe project
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">beheer projecten</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <section class="box">
        <table class="table table-condensed table-responsive">
            <tr><th>#</th><th>titel</th><th>aangemaakt op</th><th>laatste aanpassing</th><th></th></tr>
            <?php
            foreach($projects as $project){
                echo "<tr><td>$project->id</td><td>$project->title</td><td>$project->dateCreated</td><td>$project->dateLastUpdated</td><td><a href='/?page=editProject&admin=1&projectId=$project->id' class='btn btn-primary'><i class='glyphicon glyphicon-pencil'></i></a></td></tr>";
            }
            ?>
        </table>
    </section>
</section>