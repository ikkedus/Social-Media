<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 6/8/2017
 * Time: 3:53 AM
 */
class TimeLineHelper{
    public static function makeItem($date,$icon,$header,$body,$id){
        ?>
        <!-- timeline time label -->
           <li class="time-label">
            <span class="bg-red">
             <?php echo $date;?>
            </span>
           </li>
           <!-- /.timeline-label -->

           <!-- timeline item -->
           <li>
               <!-- timeline icon -->
               <i class="fa fa-envelope bg-blue"></i>
               <div class="timeline-item">
                   <span class="time"><i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $date;?> </span>
                   <h3 class="timeline-header"><a href="#"><?php echo $header; ?></a> ...</h3>
                   <div class="timeline-body">
                    <?php echo $body; ?>
                    </div>
               </div>
           </li>
        <?php
    }

}
