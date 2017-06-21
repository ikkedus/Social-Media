<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/8/2017
 * Time: 1:47 AM
 */
require_once 'timelineHelper.php';
require_once 'classes/projectProvider.php';
$p = new projectProvider();
$project = $p->getProject($_GET['project_id']);
//echo '<pre>';
//echo var_dump($project);
//echo '</pre>';
?>
<section class="row">
    <section class="col-md-offset-5 col-md-2">
        <section class="circleimage">
            <img src="<?php echo $project['banner'];?>">
        </section>
    </section>
</section>
<section class="row">
    <section class="col-md-offset-5 col-md-2">
        <section class="projectTitle">
            <h2><?php echo $project['title'];?></h2>
            <h3>Team Whiskers</h3>
        </section>
    </section>
</section>
<section class="row">
    <section class="col-md-offset-2 col-md-8">
      <p><?php echo $project['description'];?></p>
    </section>
</section>
<section class="row">
    <section class="col-md-offset-2 col-md-8">
        makers
    </section>
</section>
<section class="row">
   <section class="col-md-offset-2 col-md-8">
       <ul class="timeline">
            <?php
               if($project->ownEntryList != null){
                   foreach ($project->ownEntryList as &$value){
                       TimeLineHelper::makeItem($value['date'],'comment',$value['type'],$value['post']);
                   }
               }
            ?>
       </ul>
   </section>
    <section class="col-md-offset-2 col-md-8">

            <section class="comment_area">
                <section class="comments">
                    <section id="commentTemplate" class="row">
                        <section class="col-md-2 col-sm-2">
                            <img src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="anonymous"/>
                        </section>
                        <section class="col-md-10 col-sm-10">
                            <section class="panel panel-default">
                                <section class="panel-heading">
                                    Anonymous posted
                                </section>
                                <section class="panel-body">
                                    <p>
                                        hello world
                                    </p>
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
                <section data-id="<?php echo $project->id; ?>" class="commentInput form-group">
                    <input type="text" placeholder="Comment" class="form-control">
                    <button class="btn btn-primary" type="submit">Send</button>
                </section>
            </section>
    </section>
</section>
<script>
    $(function () {
        init();
        $('.commentInput').find('button').click(function (e) {
           e.preventDefault();
            $.ajax({url: "/Api.php?function=createComment",
                type: "POST",
                data: ({'projectId':<?php echo $project->id; ?>,'text':$('.commentInput').find('input').val()}),
                success: function(result){
                }});
            loadComments();
        });
    });
    function init() {
        loadComments();
    }
    function loadComments() {
        $.ajax({url: "/Api.php?function=getComments",
            type: "POST",
            data: ({'projectId':<?php echo $project->id; ?>}),
            success: function(result){
            var data = objectToArray($.parseJSON(result));
            for (var i = 0; i < data.length; i++) {
              var d = data[i];
              var template  = fillTemplate(d).clone();
              $('.comments').append(template.removeAttr('id'));
            }
        }});
    }
    function fillTemplate(data) {
        $('#commentTemplate p').html(data.text);
        $('#commentTemplate').find('.panel-heading').html(data.postedBy+'<i>'+data.date+'</i>');
        return $('#commentTemplate');
    }
    function objectToArray(obj) {
        var array = $.map(obj, function(value, index) {
        return [value];
      });
      return array;
    }

</script>
