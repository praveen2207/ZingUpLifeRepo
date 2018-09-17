<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-wrap="false">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        <li data-target="#carousel-example-generic" data-slide-to="4"></li>

    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?php echo base_url(); ?>assets/images/home-banner.jpg" alt="First Slide">

        </div>
        <div class="item">
            <img src="<?php echo base_url(); ?>assets/images/home-banner1.jpg" alt="Second Slide">

        </div>
        <div class="item">
            <img src="<?php echo base_url(); ?>assets/images/home-banner2.jpg" alt="Third Slide">

        </div>
        <div class="item">
            <img src="<?php echo base_url(); ?>assets/images/home-banner2.jpg" alt="Fourth Slide">

        </div>
        <div class="item">
            <img src="<?php echo base_url(); ?>assets/images/home-banner2.jpg" alt="Fifth Slide">

        </div>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a>
</div> <!-- Carousel -->



<h5 class="category"><?php if (isset($services)) {
    echo $services->service_name;
} ?></h5>
<div class="row con-row category-row">

    <h2 class="con-offer con-location">Location</h2>
<?php foreach ($locations as $key => $value) { ?>
        <div class="span4">
            <a href="<?php echo base_url() . $service . '/location/' . $value->suburb; ?>"><h2><?php echo $value->area_name; ?></h2></a>
        </div>    
<?php } ?>
</div>

<div class="row con-row1">
    <div class="hero-unit">
        <h3>How it Works</h3>
        <p class="con-p con-p-first"><span class="con-span">01</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and 
            typesetting industry.
        </p>
        <hr>
        <p class="con-p"><span class="con-span">02</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and 
            typesetting industry.
        </p>
        <hr>
        <p class="con-p"><span class="con-span">03</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and 
            typesetting industry.
        </p>
        <hr>
        <p class="con-p"><span class="con-span">04</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and 
            typesetting industry.
        </p>


    </div>
</div>
