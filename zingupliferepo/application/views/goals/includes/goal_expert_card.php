<style>
.goal-card{
    background: #518ebd;
    color: white;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.5), 0 3px 1px -2px rgba(0,0,0,.5), 0 1px 5px 0 rgba(0,0,0,.6);
    font-family: 'Roboto','Helvetica','Arial',sans-serif!important;
    height:200px;
    overflow:hidden;
    }
    .margin-top-card{
          margin-top:17px;
    }
    .goalTitle{
        border-bottom: 1px solid white;
    }
   
</style>
                    <div class="col-lg-5 margin-top-card goal-card" >
                        <div class="row goalCard margin-right paddingGoals">
                            <div class="col-lg-12" style="min-height:125px;">
                                <span class="report-text goalTheme goalTitle"><?php echo $key;?></span><a class="pull-right" style="text-decoration:none;color:white;" title="View More" data-toggle="modal" data-target="#goalModal<?php echo $goalsMainIndex;?>"><i class="fa fa-eye"></i></a><br>
                                <?php $goalIndex = 1;?>
                                <?php foreach($value as $specificGoalKey => $specificGoalValue) {?>
                                <div class="col-lg-1 goalName"><?php echo ''.$goalIndex.'';?></div>
                                <div class="col-lg-11 goalName"><?php echo ''.trim($specificGoalValue["goal_name"]).".";?></div>
                                <?php $goalIndex++;
                              }?>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-1">
            
                    </div>
                    
                     
                    