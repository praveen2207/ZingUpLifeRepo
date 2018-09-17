<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <span  class="colorGrey">FAQ</span>
    </div>
    <div class="searchPro">
        <div class="row">
            <form class="" method="post" action="<?php echo base_url(); ?>search" novalidate="novalidate">
                <div class="col-xs-5 col-sm-3 col-md-3 resizeCol">
                    <input type="hidden" name="city" value="Bangalore"/>
                    <input type="text" class="form-control" id="zingInputCity" placeholder="Search for location" name="locations">
                </div>
                <div class="col-xs-5 col-sm-7 col-md-8 resizeCol pd">
                    <input type="text" class="form-control" id="zingInputCity" placeholder="Search for Services or Providers" name="keywords">
                </div>
                <div class="col-xs-2 col-sm-2  col-md-1 resizeCol pdLf">
                    <!--                    <a href="javascript:void(0);"type="button" class="btn zing-btn serBtn">Search</a>-->
                    <input type="submit" name="submit" value="Search" class="btn zing-btn serBtn"/>
                </div>
            </form>
        </div>
    </div>

    <div class="frequentlyBox">
        <h3>FREQUENTLY ASKED QUESTIONS</h3>
        
        <h4>For service users</h4>
        <ul>
            <?php
            $i = 0;
            if (!empty($customerfaqs)) {
                foreach ($customerfaqs as $key => $value) {
                	$i++;
                    ?>
                    <li>
                        <div class="iconPlay playBtn" id="button<?php echo $i; ?>">
                            <i class="glyphicon glyphicon-triangle-right" id="glyphiconRight<?php echo $i; ?>"></i>
                            <i class="glyphicon glyphicon-triangle-bottom" id="glyphiconBottom<?php echo $i; ?>"></i>
                        </div>
                        <p class="textBold"><?php echo $value->question; ?></p>
                        <p class="Greytext explainBox" id="info<?php echo $i; ?>"><?php echo $value->answer; ?></p>
                    </li>
                <?php
                }
            } else {
                ?>
                <li>
                    <p class="textBold"><h4 class="no_review_found">No Records Found</h4></p>
                </li>
			<?php } ?>
        </ul>
        <h4>For experts</h4>
         <ul>
            <?php
            if (!empty($smefaqs)) {
                foreach ($smefaqs as $key => $value) {
                	$i++;
                    ?>
                    <li>
                        <div class="iconPlay playBtn" id="button<?php echo $i; ?>">
                            <i class="glyphicon glyphicon-triangle-right" id="glyphiconRight<?php echo $i; ?>"></i>
                            <i class="glyphicon glyphicon-triangle-bottom" id="glyphiconBottom<?php echo $i; ?>"></i>
                        </div>
                        <p class="textBold"><?php echo $value->question; ?></p>
                        <p class="Greytext explainBox" id="info<?php echo $i; ?>"><?php echo $value->answer; ?></p>
                    </li>
                <?php
                }
            } else {
                ?>
                <li>
                    <p class="textBold"><h4 class="no_review_found">No Records Found</h4></p>
                </li>
			<?php } ?>
        </ul>
        <h4>For partners and service providers</h4>
         <ul>
            <?php
            if (!empty($providerfaqs)) {
                foreach ($providerfaqs as $key => $value) {
                	$i++;
                    ?>
                    <li>
                        <div class="iconPlay playBtn" id="button<?php echo $i; ?>">
                            <i class="glyphicon glyphicon-triangle-right" id="glyphiconRight<?php echo $i; ?>"></i>
                            <i class="glyphicon glyphicon-triangle-bottom" id="glyphiconBottom<?php echo $i; ?>"></i>
                        </div>
                        <p class="textBold"><?php echo $value->question; ?></p>
                        <p class="Greytext explainBox" id="info<?php echo $i; ?>"><?php echo $value->answer; ?></p>
                    </li>
                <?php
                }
            } else {
                ?>
                <li>
                    <p class="textBold"><h4 class="no_review_found">No Records Found</h4></p>
                </li>
			<?php } ?>
        </ul>
        
        
    </div>
</div>