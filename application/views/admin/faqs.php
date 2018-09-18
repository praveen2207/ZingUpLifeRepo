<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">FAQ - Support</h3>
</div>

<div class="row-fluid order-row">
    <?php if (!empty($all_faqs)) { ?>
        <div class="message faq-con">
            <form>
                <label class="f-search">Search:</label>
                <div class="faq-search">
                    <input type="text" id="faq_search" name="search" class="search" placeholder="Enter text here"/>
                    <button type="button" name="se" id="se" class="search-button"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>

        <div class="faq-section clear">

            <div class="panel-group panel-group1" id="accordion"> <!-- accordion 1 -->

                <?php
                foreach ($all_faqs as $key => $value) {
                    if ($key == 0) {
                        $primary_class = 'panel-primary';
                        $in = 'in';
                        $selected = 'sel';
                    } else {
                        $primary_class = '';
                        $in = '';
                        $selected = '';
                    }
                    ?>
                    <div class="panel panel1 panel<?php echo $value->id; ?> <?php echo ' ' . $primary_class; ?>">
                        <div class="panel-heading panel-heading1"> <!-- panel-heading -->
                            <h4 class="panel-title panel-title1"> <!-- title 1 -->
                                <a data-toggle="collapse" data-parent="#accordion" href="#accordionOne<?php echo $value->id; ?>" class="blue faq-link <?php echo $selected; ?>">
                                    <span class="q-icon blue">Q.</span><?php echo $value->question; ?></a>
                            </h4>
                        </div>
                        <!-- panel body -->
                        <div id="accordionOne<?php echo $value->id; ?>" class="panel-collapse panel-collapse1 collapse <?php echo $in; ?>">
                            <div class="panel-body panel-body1">
                                <?php echo $value->answer; ?>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>

            </div>

        </div>
    <?php } else {
        ?>
        <div class="panel panel1 panel">
            <div class="panel-heading panel-heading1"> <!-- panel-heading -->
                <h4 class="panel-title"> <!-- title 1 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordionOne" class="blue faq-link">
                        <span class="q-icon blue">Currently no faqs are available, we will update it soon !!!</span></a>
                </h4>
            </div>
            <!-- panel body -->
            <div id="accordionOne" class="panel-collapse panel-collapse1 collapse">
                <div class="panel-body panel-body1"> </div>
            </div>
        </div>
    <?php } ?>
</div>