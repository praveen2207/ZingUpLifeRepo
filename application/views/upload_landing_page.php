<!DOCTYPE html>
 
<html>
<head>
 <title>PHP MySQL Insert Tutorial</title>
        <script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
</head>
 
<body>
    <form role="form" action="<?php echo base_url();?>Upload_controller/upload_file" method='post' id='myform' enctype="multipart/form-data">
 <p>
 <input type='text' name='page_name' placeholder='page_name' id='page_name' />
 </p>
 
 <p>
 <input type='file' name='name_of_file' placeholder='' id='name_of_file' />
 </p>
 
 <input type='submit' id="submit" value="Upload"/>
 
 <p id='result'></p>
 </form>
</body>
</html>

