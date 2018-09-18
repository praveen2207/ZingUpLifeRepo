 <style type="text/css">
        .events1 .nav>li.active>a,
        .events1 .nav>li.active>a:focus,
        .events1 .nav>li.active>a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
        }
        
        input[type=text] {
            width: 130px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }
        
        input[type=text]:focus {
            width: 100%;
        }
        
        .events1 .nav>li>a {
            margin-right: -22px;
            line-height: 1.42857143;
            border-radius: 0px;
            font-size: 13px;
            background-color: #fff padding: 11px 25px;
            font-weight: 300;
            border-bottom: 1px solid #ebebeb;
        }
        
        .events1 .nav>li>a {
            position: relative;
            display: block;
        }
        
        .events1 .nav-tabs>li {
            float: left;
            margin-bottom: -1px;
        }
        
        .events1 .nav>li {
            position: relative;
            display: block;
        }
        
        .events1 .tab-border .tab-content {
            border-left: 1px solid #ebebeb;
            border-right: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
            padding: 30px;
            margin-top: 40px;
            background-color: #fff;
        }
        
        .flatpickr-weekdays span {
            clear: none !important;
        }
        
        .flatpickr {
            width: 274px !important;
            font-size: 14px;
            height: 35px;
            padding-left: 10px;
        }
        
        .form-wrapper a {
            float: right;
            margin-right: 22px;
            /* margin-top: -20px; */
            position: relative;
            top: -51px;
        }
        
        .inner {
            background-color: #f9f9f9;
            padding: 17px;
            min-height: 235px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        
        .advisors figure {
            border-bottom: 0px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            min-height: 160px;
            background-color: #f8f8f8;
        }
        .marginTop{
            margin-top:20px;
        }
    </style>
<main role="main">
        <!-- intro-wrap -->
        <div id="main" style="background-color: #f4f2f2;">
   
            
            <section class="row section events1 marginTop">
                <div class="row-content buffer even clear-after">
                    <div class="column ten tab-border" style="width: 100.7%;">
                        <nav style="float:left;" class='scrtabs-tabs-movable-container'>
                            <ul class="nav reset" role="tablist" id="myTabs" style="margin-left:-11px;">
                                <li role="presentation" class="active"> <a data-target="#experts" aria-controls="experts" onclick="return false;">Strength & Energy</a></li>
                                <li role="presentation"> <a data-target="#spa" aria-controls="spa" onclick="return false">Thought Control</a></li>
                                <li role="presentation"> <a data-target="#yoga" aria-controls="yoga" onclick="return false">Relational Intimacy</a></li>
                                <li role="presentation"> <a data-target="#ayurveda" aria-controls="ayurveda" onclick="return false">Zest for Life</a></li>
                            </ul>
                        </nav>
                        <div class="tab-content sme-experts" style="min-height:500px;">
                            <div role="tabpanel" class="tab-pane experts_div active" id="experts">
                                <div class="row section advisors new-list" style="margin-top:50px; margin-bottom:70px;" added='old'>
                                   
                                    <?php
                                    $goalsMainIndex =0;
                                    foreach ($goals["STRENGTH_ENERGY"] as $key => $value) {
											//if ($key < 15) {
                                       
										    include('goal_expert_card.php');
												?>
										
												<?php
												$goalsMainIndex++;
											//}
										}
										?>
										<?php if(sizeof($goals["STRENGTH_ENERGY"])==0) {?>
										<div class="col-lg-12 text-center text-uppercase">NO Suggestions</div>
										<?php }?>
                                </div>
                               
                            </div>
                            <div role="tabpanel" class="tab-pane spa_div" id="spa">
                                <div class="row section advisors new-list" style="margin-top:50px; margin-bottom:70px;" added='old'>
									 <?php
								
									 foreach ($goals["THOUGHT_CONTROL"] as $key => $value) { 
												include('goal_expert_card.php');
										?>
										<?php
										$goalsMainIndex++;
 } ?>
										<?php if(sizeof($goals["THOUGHT_CONTROL"])==0) {?>
										<div class="col-lg-12 text-center text-uppercase">NO Suggestions</div>
										<?php }?>
                                </div>
                             
                            </div>
                            <div role="tabpanel" class="tab-pane yoga_div" id="yoga">
                                <div class="row section advisors new-list" style="margin-top:50px; margin-bottom:70px;" added='old'>
                                   <?php 
                                  
                                   foreach ($goals["RELATION_INTIMACY"] as $key => $value) { 
												include('goal_expert_card.php');
										?>
										<?php  $goalsMainIndex++;} ?>
										<?php if(sizeof($goals["RELATION_INTIMACY"])==0) {?>
										<div class="col-lg-12 text-center text-uppercase">NO Suggestions</div>
										<?php }?>
                                </div>
                             
                            </div>
                            <div role="tabpanel" class="tab-pane ayurveda_div" id="ayurveda">
                                <div class="row section advisors new-list" style="margin-top:50px; margin-bottom:70px;" added='old'>
									 <?php foreach ($goals["ZEST_FORLIFE"] as $key => $value) { 
												include('goal_expert_card.php');
										?>
										<?php  $goalsMainIndex++;} ?>
										<?php if(sizeof($goals["ZEST_FORLIFE"])==0) {?>
										<div class="col-lg-12 text-center text-uppercase">NO Suggestions</div>
										<?php }?>
                                </div>
                               
                            </div>
                     
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- id-main -->
    </main>