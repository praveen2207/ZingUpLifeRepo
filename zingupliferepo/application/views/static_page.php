
<?php if (isset($static_pages_content)) { ?>
    <div class="main-container">
        <div class="content">
            <div class="container">
                <div class="static_page_images">
                    <img src="<?php echo $static_pages_gallery_path . $static_pages_content['gallery']->page_id . '/' . $static_pages_content['gallery']->images; ?>"/>
                </div>
                <div class="page-head center">
                    <h1><?php echo $static_pages_content['content']->title; ?></h1>
                </div>
                <div class="content-inner">
                    <div class="row">
                        <div class="col-xs-11 mar-auto">
                            <?php if (isset($static_pages_content['content'])) { ?>
                                <p>
                                    <?php echo $static_pages_content['content']->content; ?>
                                </p>

                            <?php }
                            ?>
                        <?php } else { ?>
                            <div class="row con-row error-row"><p class="page-error">No Record Found</p><a href="javascript: window.history.go(-1)" id="" class="back">Back</a></div>
                        <?php } ?>
                    </div>

                </div>            

            </div>
        </div>
    </div>
