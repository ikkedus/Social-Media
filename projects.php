<?php
require_once 'classes/projectProvider.php';
$p = new projectProvider();
$projects = $p->getAllProject();
 ?>

 <section class="row">
   <?php
     foreach ($project->ownEntryList as &$value){
         TimeLineHelper::makeItem($value['date'],'comment',$value['type'],$value['post']);
     }
   ?>
 </section>
