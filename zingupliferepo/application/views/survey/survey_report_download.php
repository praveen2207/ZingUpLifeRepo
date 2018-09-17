<style>
    .green_heading{
        color:green;
        font-size: 12px;
        font-family: helvetica;
        font-weight:bold;
        line-height: 20px;
    }
    .orange_heading{
        color:orange;
        font-size: 12px;
        font-family: helvetica;
        font-weight:bold;
        line-height: 20px;
    }
    .green_heading_quote{
        color:green;
        font-size: 12px;
        font-family: helvetica;
        font-weight:bold;
        padding-left:10px;
        padding-right: 10px;
    }
    table {
        font-size: 12px;
        font-family: helvetica;
        width: 520px;
        text-align: justify;
    }
    ul { color: green;}
</style> 
<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="height:150px;">
          <img src="<?php echo base_url(); ?>assets/survey_new/img/page-1.png" alt="zinguplife.com" > 
        </td>
    </tr>
</table>

<table cellpadding="10" cellspacing="0" border="0">
    <tr>
        <td>
            <p><span class="green_heading">NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span> <?php echo ucfirst($user_details->name);?>
            <br><span class="green_heading">GENDER&nbsp;&nbsp;&nbsp;&nbsp;:</span> <?php echo $user_details->gender;?>
            <br><span class="green_heading">DATE COMPLETED:</span> <?php echo $survey_date->end_date; ?></p>
            
            <p><span  class="green_heading">Welcome, <?php echo ucfirst($user_details->name);?>!</span>
            <br>Congratulations, on completing your 8BAK-C<sup>TM</sup> personal well-being assessment.</p>
            <p>We're glad you've taken this first step towards knowing your state of well-being, across all dimensions, and will now know where you're doing well and what you can improve on. Good health and wellbeing is important to you, to your family, and to your future.</p>

            <p class="green_heading_quote">
                "Wellness is a conscious, deliberate process that requires a person to become aware of and make choices for a more satisfying lifestyle. Wellness is the process of creating and adapting patterns of behaviour that lead to improved health in the wellness dimensions and heightened life satisfaction." - (Swarbrick, 2006)
            </p>
            <p>The 8BAK-C assesses over 80 factors related to your wellbeing – across physical, emotional, intellectual, spiritual, social, occupational, environmental & financial dimensions – the 8 dimensions of human wellness as defined by the World Health Organization.</p>
            
            <p>On the following pages, you will find:</p>
            <ul>
                <li>The 8 Dimensions of Wellness</li>
                <li>Your Wellness summary and blueprint
                    <ul>
                        <li style="color:black;">Things I'm doing right </li>
                        <li style="color:black;">Where am I at risk? </li>
                    </ul>
                </li>
                <li>Your Personal Well-being Index & Action plan</li>
                <li>Using your 8BAK-C assessment results</li>
            </ul>
            <p>Thank you for learning more about your personal well-being, and for taking adequate steps towards holistic improvement!</p>
        </td>
    </tr>
</table>  


<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="height:150px;">
           
        </td>
    </tr>
    <tr>
        <td>
            <p><span class="green_heading">SECTION 1&nbsp;&nbsp;:&nbsp;&nbsp;</span>THE 8 DIMENSIONS OF WELLNESS
            </p>
        </td>
    </tr>
    <tr>
        <td>
           <img src="<?php echo base_url(); ?>assets/survey_new/img/Page-2.png" alt="zinguplife.com" > 
        </td>
    </tr>
    <tr>
        <td>
            <p><span  class="green_heading">Understanding your 8BAK-C wellness report</span></p>
            
            <p>The goal of the personal wellbeing blueprint and report is to identify risks, and to share relevant information you need to manage your wellness successfully. Your personalized report gives insight into your very own multi-dimensional wellness, and actions needed to achieve an optimal state of complete well-being.</p>
            
            <p>In the following report you will see a summary of your personal well-being, grouped by dimensions. All the results are followed by an interpretation of your scores.</p>
            
            <p>You can retake the assessment in 90 days.</p>

        </td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="height:100px;">
           
        </td>
    </tr>
    <tr>
        <td>
            <p><span class="green_heading">SECTION 2&nbsp;&nbsp;:&nbsp;&nbsp;</span>YOUR WELLNESS SUMMARY & BLUEPRINT
            </p>
        </td>
    </tr>
   
    <tr>
        <td>
            <p><span  class="green_heading">WHAT IS BODY MASS INDEX (BMI)?</span></p>
            
            <p>A simple calculator that compares height Vs weight and makes a general statement about whether your weight is considered to be in the 'healthy' range. BMI is based on statistical analysis of a sample population, and works well for the 'average' person. Knowing about maintaining a healthy BMI and ways to stay within the healthy zone will help you keep your BMI in control, having high energy levels, and to sustain good health.
We recommend you speak with your medical practitioner to determine your healthy weight range.</p>
        </td> 
    </tr>
    <tr>
        <td>
        <?php if( file_exists(FCPATH . 'survey_images/healthprofile1/'.$id.'/healthprofile1.png')) { ?>
                <img src="<?php echo base_url(); ?>survey_images/healthprofile1/<?php echo $id; ?>/healthprofile1.png" alt="graph" width='200px' height='200px'/>
                <br/>
        <?php } ?>
        </td>
    </tr>
</table>


<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td>
            <?php if( file_exists(FCPATH . 'survey_images/healthprofile2/'.$id.'/healthprofile2.png')) { ?>
                <h3>THINGS I'M DOING RIGHT</h3>
                <img src="<?php echo base_url(); ?>survey_images/healthprofile2/<?php echo $id; ?>/healthprofile2.png" alt="graph" width='200px' height='200px'/>
                <br/>
        <?php } else {?>
                <h3 class="green_heading">THINGS I'M DOING RIGHT</h3>

                <p><?php echo $max[0]->wellness_element; ?></p>
                <p><?php echo $max[1]->wellness_element; ?></p>
                <p><?php echo $max[2]->wellness_element; ?></p>
                <p><?php echo $max[3]->wellness_element; ?></p>
                <p><?php echo $max[4]->wellness_element; ?></p>
                <p><?php echo $max[5]->wellness_element; ?></p>
                <p><?php echo $max[6]->wellness_element; ?></p>
                <p><?php echo $max[7]->wellness_element; ?></p>
                <p><?php echo $max[8]->wellness_element; ?></p>
                <p><?php echo $max[9]->wellness_element; ?></p>

        <?php } ?>
        </td>
    </tr>
    <tr>
        <td>
        <?php if( file_exists(FCPATH . 'survey_images/healthprofile3/'.$id.'/healthprofile3.png')) { ?>
            <h3 class="orange_heading">WHERE AM I AT RISK?</h3>
                <img src="<?php echo base_url(); ?>survey_images/healthprofile3/<?php echo $id; ?>/healthprofile3.png" alt="graph" width='200px' height='200px'/>
                <br/>
        <?php } else {?>
                <h3 >WHERE AM I AT RISK?</h3>
                <p><?php echo $min[0]->wellness_element; ?></p>
                <p><?php echo $min[1]->wellness_element; ?></p>
                <p><?php echo $min[2]->wellness_element; ?></p>
                <p><?php echo $min[3]->wellness_element; ?></p>
                <p><?php echo $min[4]->wellness_element; ?></p>
                <p><?php echo $min[5]->wellness_element; ?></p>
                <p><?php echo $min[6]->wellness_element; ?></p>
                <p><?php echo $min[7]->wellness_element; ?></p>
                <p><?php echo $min[8]->wellness_element; ?></p>
                <p><?php echo $min[9]->wellness_element; ?></p>

        <?php } ?>
        </td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td>
           <?php if( file_exists(FCPATH . 'survey_images/healthprofile4/'.$id.'/healthprofile4.jpg')) { ?>
                <img src="<?php echo base_url(); ?>/survey_images/healthprofile4/<?php echo $id; ?>/healthprofile4.jpg" alt="graph" style='page-break-after:auto;' height='200px' />
        <?php  }?>
        </td>
    </tr>
</table>

