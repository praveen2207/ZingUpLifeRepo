<div class="main-container banner-main-ctr">
    <div class="featured-box">
        <div class="container">
            <div class="banner">
                <div class="banner-inner">
                    <ul class="bxslider">
                        <li><img src="<?php echo base_url(); ?>assets/images/new-age-478525_1280.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url(); ?>assets/images/singing-bowl-235266_1280.jpg" alt="" /></li>  
                        <li><img src="<?php echo base_url(); ?>assets/images/sport-1235019_1280.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url(); ?>assets/images/wellness-589773_1280.jpg" alt="" /></li>  
                    </ul>
                    <div class="banner-content new-banner-content">
                        <div class="container">
                            <div class="banner-content-inner">                	
                                <!-- <p>Find Wellness Centers and Treatments in <span>Bangalore</span></p> -->
                                <div class="location-search">
                                    <form class="" method="post" action="<?php echo base_url(); ?>search" novalidate="novalidate">
                                        <div class="row new-style">
                                            <div class="find-text location-field">
                                                <p>
                                                <p>
                                                    Find + Book<br>
                                                    <span class="well-text">Wellness centers, treatments & more</span>
                                                </p>
                                                <span class="h-arrow"><img src="<?php echo base_url(); ?>assets/images/ar.png" alt="" /></span>	
                                                </p>
                                            </div>
                                            <!-- <div class="location-field">
                                                <select  name="city">
                                                    <option value="Bangalore">Bangalore</option>
                                                </select>
                                            </div> -->
                                            <input type="hidden" name="city" value="Bangalore"/>
                                            <div class="location-field">
                                                <span>I want</span> <input type="text" placeholder="Spa, Yoga etc.." name="keywords"/>
                                            </div>
                                            <div class="location-field location-mark">
                                                <span>Near</span> <input type="text" placeholder="Bangalore, bellandur" name="locations"/>
                                            </div>
                                            <div class="location-button">
                                                <button type="submit" class="button" > Find <img src="<?php echo base_url(); ?>assets/images/se.png" alt="" /></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> 
        </div>

    </div>
</div>
<div class="main-container">
    <div class="featured-box">
        <div class="container">
            <div class="featured-content">
                <?php if (!empty($services)) { ?>
                    <div class="featured-list">
                        <ul>
                            <li>
                                <div class="featured-inner">
                                    <a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[0]->slug; ?>">
                                        <div class="featured-img"><img src="<?php echo base_url(); ?>assets/images/IB133571-SM100963.jpg" alt="" /></div>
                                        <div class="featured-details"><strong>Spa</strong>
                                            <p><a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[0]->slug; ?>">Escape into another world, rejuvenate</a></p>

                                        </div>
    <!--                                        <a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[0]->slug; ?>" class="button">View All SPA’s here..</a>-->
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="featured-inner">
                                    <a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[1]->slug; ?>">
                                        <div class="featured-img"><img src="<?php echo base_url(); ?>assets/images/IB133571-SM124503.jpg" alt="" /></div>
                                        <div class="featured-details"><strong>Ayurvedic Treatments</strong>
                                            <p><a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[1]->slug; ?>">Oldest healthcare system in the world</a></p>

                                        </div>
    <!--                                        <a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[1]->slug; ?>" class="button">Explore Ayurveda Centers here..</a>-->
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="featured-inner">
                                    <a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[2]->slug; ?>">
                                        <div class="featured-img"><img src="<?php echo base_url(); ?>assets/images/IB133571-SM395723.jpg" alt="" /></div>
                                        <div class="featured-details"><strong>Yoga</strong>
                                            <p><a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[2]->slug; ?>">Complete essence of the way of life</a></p>

                                        </div>
    <!--                                        <a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[2]->slug; ?>" class="button">Find the Yoga Studios here..</a>-->
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="featured-inner">
                                    <a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[3]->slug; ?>">
                                        <div class="featured-img"><img src="<?php echo base_url(); ?>assets/images/IB133571-SM342933.jpg" alt="" /></div>
                                        <div class="featured-details"><strong>Fitness</strong>
                                            <p><a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[2]->slug; ?>">Enjoy the glow of good health everyday</a></p>

                                        </div>
    <!--                                        <a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[3]->slug; ?>" class="button">Get Fit! Find it here..</a>-->
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="content-inner">
                <div class="row">
                    <div class="col-xs-12">
                        <!--                        <div class="home-content">
                                                    <div class="home-content-inner">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <div class="home-content-col">
                                                                    <h3>Indira Nagar</h3>
                                                                    <ul>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=spa&location=Indiranagar">SPAs</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=ayurvedic_treatments&location=Indiranagar">Ayurvedic Treatments</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=yoga&location=Indiranagar">Yoga Studios</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=fitness&location=Indiranagar">Health and Fitness</a></li>
                                                                    </ul>
                                                                    <a href="<?php echo base_url(); ?>search/keyword=all&location=Indiranagar">View All</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div class="home-content-col">
                                                                    <h3>Koramangala</h3>
                                                                    <ul>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=spa&location=Koramangala">SPAs</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=ayurvedic_treatments&location=Koramangala">Ayurvedic Treatments</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=yoga&location=Koramangala">Yoga Studios</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=fitness&location=Koramangala">Health and Fitness</a></li>
                                                                    </ul>
                                                                    <a href="<?php echo base_url(); ?>search/keyword=all&location=Koramangala">View All</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div class="home-content-col">
                                                                    <h3>HSR Layout</h3>
                                                                    <ul>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=spa&location=HSR Layout">SPAs</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=ayurvedic_treatments&location=HSR Layout">Ayurvedic Treatments</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=yoga&location=HSR Layout">Yoga Studios</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=fitness&location=HSR Layout">Health and Fitness</a></li>
                                                                    </ul>
                                                                    <a href="<?php echo base_url(); ?>search/keyword=all&location=HSR Layout">View All</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div class="home-content-col last">
                                                                    <h3>Jaya Nagar</h3>
                                                                    <ul>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=spa&location=Jaya Nagar">SPAs</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=ayurvedic_treatments&location=Jaya Nagar">Ayurvedic Treatments</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=yoga&location=Jaya Nagar">Yoga Studios</a></li>
                                                                        <li><a href="<?php echo base_url(); ?>search/keyword=fitness&location=Jaya Nagar">Health and Fitness</a></li>
                                                                    </ul>
                                                                    <a href="<?php echo base_url(); ?>search/keyword=all&location=HSR Layout">View All</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                </div>                        -->
                        <div class="our-experts center head-bg">
                            <h1>Consult with wellness specialists</h1>
                            <ul class="our-expert-list row">
                                <li class="col-xs-3">
                                    <div class="our-expert-inner">
                                        <div class="our-expert-img">
                                            <a href="<?php echo base_url(); ?>sme">
                                                <div class="expert-img"><img src="<?php echo base_url(); ?>assets/images/experts/expert01.jpg" class="circle-img" alt="" /></div>
                                                <h3>Naren</h3>
                                                <p>Leading Fitness Evangelist and Celebrity Trainer, <br />Bangalore</p>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-3">
                                    <div class="our-expert-inner">
                                        <div class="our-expert-img">
                                            <a href="<?php echo base_url(); ?>sme">
                                                <div class="expert-img"><img src="<?php echo base_url(); ?>assets/images/experts/expert02.jpg" class="circle-img" alt="" /></div>
                                                <h3>Fleur</h3>
                                                <p>Flexibility and Body Balance Trainer <br />Bangalore</p>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-3">
                                    <div class="our-expert-inner">
                                        <div class="our-expert-img">
                                            <a href="<?php echo base_url(); ?>sme">
                                                <div class="expert-img"><img src="<?php echo base_url(); ?>assets/images/experts/expert03.jpg" class="circle-img" alt="" /></div>
                                                <h3>Zoya</h3>
                                                <p>Wellness Ambasador, <br />Mumbai</p>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-3">
                                    <div class="our-expert-inner">
                                        <div class="our-expert-img">
                                            <a href="<?php echo base_url(); ?>sme">
                                                <div class="expert-img"><img src="<?php echo base_url(); ?>assets/images/experts/expert04.jpg" class="circle-img" alt="" /></div>
                                                <h3>​Vivian George</h3>
                                                <p>Physical Transformation Specialist</p>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                        <div class="testimonials-div center head-bg">
                            <h1>Testimonials</h1>
                            <div class="testimonials-content">

                                <ul class="testimonials">
                                    <li>
                                        <div class="testmonial-slide">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <div class="testimonial-head"><img src="<?php echo base_url(); ?>assets/images/testimonial-user1.jpg" alt="" /></div>
                                                </div>
                                                <div class="col-xs-10">
                                                    <div class="testimonial-inn">
                                                        <p>Over 3 epic weeks, Naren and Fleur skilfully got me fanatical about holistic wellness, and not just fitness. My ’best shape ever’ stage is now within sight.</p>
                                                        <p class="tesimonial-name">Mannat Sharma, 28</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="testmonial-slide">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <div class="testimonial-head"><img src="<?php echo base_url(); ?>assets/images/testimonial-user2.jpg" alt="" /></div>
                                                </div>
                                                <div class="col-xs-10">
                                                    <div class="testimonial-inn">
                                                        <p>ZingUpLife is an incredible platform to discover curated wellness services in the neighborhood, as well as consult with leading specialists. You’ve made it to my bookmarked list.</p>
                                                        <p class="tesimonial-name">Ridhi Bakshi, 32</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="testmonial-slide">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <div class="testimonial-head"><img src="<?php echo base_url(); ?>assets/images/testimonial-user3.jpg" alt="" /></div>
                                                </div>
                                                <div class="col-xs-10">
                                                    <div class="testimonial-inn">
                                                        <p>ZingUp is an effortless, honest-to-goodness way to keeping my mind, body and spirit at their peak. The online experts are accomplished and sincere. Highly recommended</p>
                                                        <p class="tesimonial-name">Nitin Kalra, 38</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>  
                        </div>
                        <div class="bottom-box">
                            <div class="bottom-box-inner center head-bg">
                                <h1>Knowledge Base</h1>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="box-inner">
                                            <a href="http://localhost/zinguplife/knowledgebase/" target="_blank">
                                                <div class="box-img knowledge_base_image_ctr">
                                                    <img src="<?php echo base_url(); ?>assets/images/11.png" alt="" />
                                                </div>
                                                <h6 class='knowledge_base_image_text'>ABOUT OMEGA 3 FISH OILS, AND ZINC SUPPLEMENTS</h6>
                                                <span class='extra_desc'><strong>DIET & NUTRITION</strong></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="box-inner">
                                            <a href="http://localhost/zinguplife/knowledgebase/" target="_blank">
                                                <div class="box-img knowledge_base_image_ctr">
                                                    <img src="<?php echo base_url(); ?>assets/images/12.png" alt="" />
                                                </div>
                                                <h6 class='knowledge_base_image_text'>DETOXIFICATION:NATURAL REMEDIES FOR CLEANSING YOUR BODY</h6>
                                                <span class='extra_desc'><strong>DE-TOX & DE-STRESS</strong></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="box-inner">
                                            <a href="http://localhost/zinguplife/knowledgebase/" target="_blank">
                                                <div class="box-img knowledge_base_image_ctr">
                                                    <img src="<?php echo base_url(); ?>assets/images/13.png" alt="" />
                                                </div>
                                                <h6 class='knowledge_base_image_text'>FITNESS CENTRE'S:AN INVESTIGATION</h6>
                                                <span class='extra_desc'><strong>FITNESS</strong></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="box-inner">
                                            <a href="http://localhost/zinguplife/knowledgebase/" target="_blank">
                                                <div class="box-img knowledge_base_image_ctr">
                                                    <img src="<?php echo base_url(); ?>assets/images/14.png" alt="" />
                                                </div>
                                                <h6 class='knowledge_base_image_text'>KILLING THE KILLER, THIS NEW FINANCIAL YEAR</h6>
                                                <span class='extra_desc'><strong>MIND BODY SOUL</strong></span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bottom-box">
                            <div class="bottom-box-inner center head-bg">
                                <h1>Our Partners</h1>
                                <ul class="home-logo">
                                    <li>
                                        <a href="<?php echo base_url(); ?>coming_soon" class="logo1">                    		

                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>coming_soon" class="logo2">                    		

                                        </a>
                                    </li>
                                    <!--<li>
                                        <a href="<?php echo base_url(); ?>coming_soon" class="logo3">                    		

                                        </a>
                                    </li>-->
                                    <li>
                                        <a href="<?php echo base_url(); ?>coming_soon" class="logo4">                    		

                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>coming_soon" class="logo5">                    		

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            

        </div>
    </div>
</div>
