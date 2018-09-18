

     <input type="hidden" name="answer_counts" id="answer_counts" value="<?php echo  count($answer_details_data); ?>" />

    <?php 

    if(empty($answer_details_data))
    {
     $answer_details_data=1;
    } 

    

    $j=1;
    for ($i=0; $i <count($answer_details_data); $i++) { 

    ?> 
    <div id="rowNums<?php echo $i; ?>">
        <div class="col-md-6">
            <div class="form-group answer_box">
                 <label>Answer Option <?php echo $j;?></label>
                <textarea class="form-control" type="text" placeholder="Text" name="answer_<?php echo $i;?>_text" ><?php echo $answer_details_data[$i]['answer_option_text'] ?></textarea>
                <div class="answer_img">    
                <input type="file" class="img_control" onchange="ans_check_image(this.value,this.id);"  accept='image/*' id="answer_<?php echo $i;?>_img" name="answer_<?php echo $i;?>_img" />
                </div>
                <input type="hidden" name="answer_<?php echo $i;?>_id" id="answer_<?php echo $i;?>_id" value="<?php echo $answer_details_data[$i]['answer_id'] ?>" />
                <div class="qType">

                <div class="ans_single" style="display:none">
                
                <input onkeypress="return float_validation(event, this.value)" class="form-control-short single_box" type="text" value="<?php echo $answer_details_data[$i]['answer_weightage'] ?>" placeholder="" <?php if($answer_details_data[$i]['answer_weightage']=="") echo "readonly" ?> id="answer_<?php echo $i;?>_single_text" name="answer_<?php echo $i;?>_single_text"/>

                <?php 

                    if($answer_details_data[$i]['correct_answer']!='N')
                    $add_class="checked"; 
                    else  
                    $add_class="";    

                 ?>
                
                <input type="radio" onclick="single_edit_click('answer_<?php echo $i;?>_single_text',this.value)"  value="<?php echo $answer_details_data[$i]['answer_id'] ?>" <?php echo $add_class; ?> class="single_field"  name="answer_radio">&nbsp;&nbsp;Answer
            </div>   
            <?php 


                    if($answer_details_data[$i]['correct_answer']!='N')
                    $add_class="checked"; 
                    else  
                    $add_class="";  

             ?>     
            <div class="ans_multiple" style="display:none">

                <input onkeypress="return float_validation(event, this.value)" class="form-control-short" type="text" placeholder="" value="<?php echo $answer_details_data[$i]['answer_weightage'] ?>" name="answer_<?php echo $i;?>_multi_text">&nbsp;

                <input value="<?php echo $answer_details_data[$i]['answer_id'] ?>"  type="checkbox"  <?php echo $add_class; ?> name="answer_multi_checkbox">&nbsp;&nbsp;Answers
            </div>  
            <div class="ans_weitage" style="display:none">

                <input onkeypress="return float_validation(event, this.value)" placeholder="Weightage" value="<?php echo $answer_details_data[$i]['answer_weightage'] ?>" class="form-control-short" type="input" name="answer_<?php echo $i;?>_weightage">

            </div>
        </div>
   </div>
       </div>
 </div>  
    <?php $j++; } ?>
 
 