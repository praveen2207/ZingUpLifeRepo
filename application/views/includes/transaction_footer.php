<div class="footerBox">
    <footer>
        <div class="tophFooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo base_url(); ?>assets/new_design/image/footer-logo.png">
                    </div>
                    <div class="col-md-3">
                        <div>Would you like to receive FREE wellness updates by email?</div>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo base_url(); ?>assets/new_design/image/emailbc.png" class="emailbox">
                        <form class="form-inline" method="post" novalidate="novalidate" id="subscription">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="email" placeholder="Enter your e-mail address" name="email" id="subscription_email" class="form-control emailFooter">
                                    <span for="email" generated="true" class="subscription_error" id="email_subscription_error">This field is required</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="postalcode" name="zipcode" id="subscription_zipcode" class="form-control emailFooter">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn zing-btn exploreBtn" id="subscription_submit">Subscribe</button>
                                </div>
                            </div>
                        </form>
                        <span id="subscription_success"></span>
                    </div>
                </div> 
            </div>
        </div>
        <div class="bottom-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-inner-col">
                            <h3>Who are we?</h3>
                            <ul class="footer-menu">
                                <li><a href="<?php echo base_url(); ?>about_us">About us</a></li>
                                <li><a href="<?php echo base_url(); ?>workplace">Corporate Offerings</a></li>
                                <li><a href="<?php echo base_url(); ?>partner">Partner Login</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-inner-col">
                            <h3>Customer service</h3>
                            <ul class="footer-menu">
                                <li><a href="<?php echo base_url(); ?>faq">Frequently Asked Questions</a></li>
                                <!--                                                    <li><a href="javascript:void(0);">Pay</a></li>
                                                                                    <li><a href="javascript:void(0);">Change &amp; cancel</a></li>                                                             -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-inner-col">
                            <h3>Get in touch</h3>
                            <ul class="footer-menu">
                                <li>
                                <li><a href="mailto:info@zinguplife.com" class="button">info@zinguplife.com</a></li>
                                </li>
                            </ul>                        
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-inner-col">
                            <h3>Are you yet to register your business?</h3>                        
                            <ul class="footer-menu">
                                <li>
                                <li><a href="<?php echo base_url(); ?>vendor/registration" class="button"> Register with us </a></li>                          
                                </li>                                                                            
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <ul class="social-icon">
                        <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/new_design/image/fb-icon.png" alt=""></a></li>
                        <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/new_design/image/tw-icon.png" alt=""></a></li>
                        <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/new_design/image/gp-icon.png" alt=""></a></li>
                        <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/new_design/image/yt-icon.png" alt=""></a></li>
                        <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/new_design/image/in-icon.png" alt=""></a></li>
                    </ul>
                    © 2015 ZULPHS INFOTECH PVT. LTD. All rights reserved
                </div>
            </div>
        </div>
    </footer>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/jquery.scrolling-tabs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/custom.js"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/573dfae6f1297445545a4854/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-69869734-1', 'auto');
    ga('send', 'pageview');

</script>
<script type="text/javascript">
    $(".checkboxs").click(function () {
        $(this).toggleClass('checked')
    });
    $(document).ready(function () {
        $('.selectpicker1').selectpicker();
        $('.selectpicker2').selectpicker();
    });
</script>
<script>
    $(document).ready(function () {
        $('#dashDatePicker, #dashDatePicker01')
                .datepicker({
                    format: 'yyyy-mm-dd'
                })
                .on('changeDate', function (e) {
                   // alert('tgt');
                    // Set the value for the date input
                    $("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
                   // alert($("#embeddingDatePicker").getFormattedDate('yyyy-mm-dd'));
                      $("#reschedule_date").val($("#dashDatePicker").datepicker('getFormattedDate'));
                });
    });
</script>

<script type="text/javascript">
    $('#email_subscription_error').css('display', 'none');
    $('#subscription_success').hide();
    $("#subscription_submit").click(function () {
        var email = $('#subscription_email').val();
        var zipcode = $('#subscription_zipcode').val();
        if (email == '') {
            $('#email_subscription_error').css('display', 'block');
        } else {
            if (validateEmail(email)) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>subscribe',
                    data: {email: email, zipcode: zipcode},
                    //dataType: "html",
                    success: function (data) {
                        if (data === 'email error') {
                            $('#email_subscription_error').css('display', 'block');
                        } else if (data === 'subscribed') {
                            $('#subscription_success').html('');
                            $('#email_subscription_error').css('display', 'none');
                            $('#subscription_success').show();
                            $('#subscription_success').text('You have already subscribed.');
                        } else if (data === 'success') {
                            $('#subscription_success').html('');
                            $('#email_subscription_error').css('display', 'none');
                            $('#subscription_success').show();
                            $('#subscription_success').text('Thank you for subscribing to ZingUpLife.');
                        } else {

                        }

                    }
                });
            } else {
                $('#email_subscription_error').css('display', 'block');
                $('#email_subscription_error').text('Please enter a valid email address.');
            }
        }
        return false;
    });
    function validateEmail(sEmail) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }
</script>
<script>
    $('input,textarea').focus(function () {
        $(this).removeAttr('placeholder');
    });
</script>
<script type="text/javascript">

    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
    $(document).on('click', '.ntdelbutton', function () {
        $(this).parent('.tagcontent').remove();
        // console.log('infod');
    });
</script>
<script>
    $(document).ready(function () {
        $('#embeddingDatePicker')
                .datepicker({
                    format: 'mm/dd/yyyy'
                })
                .on('changeDate', function (e) {
                    // Set the value for the date input
                    $("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
                });
    });
</script>

<script language="javascript">
    $(function () {

        // add multiple select / deselect functionality
        $("#selectall").click(function () {
            $('.booking').attr('checked', this.checked);
            $(".bookAll").addClass("bookAllshow");

        });

        // if all checkbox are selected, check the selectall checkbox
        // and viceversa
        $(".booking").click(function () {

            if ($(".booking").length == $(".booking:checked").length) {
                $("#selectall").attr("checked", "checked");
                $(".bookAll").addClass("bookAllshow");
            } else {
                $("#selectall").removeAttr("checked");
                $(".bookAll").addClass("bookAllhide");
            }

        });
    });
</script>
<script>
    var base_url = "<?php echo base_url(); ?>";
    $('#update_profile_save').click(function () {
        $('body #edit_profile_error').hide();
        var name = $(".name_field").val();
        var age = $(".age_field").val();
        var phone = $(".phone_field").val();
        var city = $(".city_field").val();
        $.ajax({
            type: "POST",
            url: base_url + 'update_user_profile',
            data: {name: name, age: age, phone: phone, city: city},
            success: function (data) {
                var response = data.replace(/\"/g, "");
                if (response != 'success') {
                    $('#error_message_show').append("<div role='alert' class='alert  alert-dismissible col-xs-11 errorMessage reError' id='edit_profile_error'>\n\
                        <button aria-label='Close' data-dismiss='alert' class='close' type='button'><span aria-hidden='true'>×</span></button>\n\
                        <span>Error!</span>" + response + "</div>");
                    $(".basic_span").toggle();
                    $(".basic_Input").toggle();
                    $(".dasInput").toggleClass("top_pd_none");
                    $(".editBS").toggleClass("edit02");
                    $(".save_btn01").toggleClass("save_btn02");
                } else {
                    window.location.reload();
                }

            }
        });
        return false;
    });
</script>
<script>
    $('body').on('click', '#stars i', function () {
        var index = $(this).index();
        var star = index + 1;
        $('#rating_star').val(star);
    });
</script>
<script>
    $(document).ready(function () {
        //var upcoming_booking_dates = "<?php echo $upcoming_booking_dates; ?>";
        var upcoming_booking_dates = "2016-04-28,2016-04-28,2016-02-27";
        //console.log(upcoming_booking_dates);
        var upcoming_booking_dates_array = upcoming_booking_dates.split(',');

        var SelectedDates = {};
        $.each(upcoming_booking_dates_array, function (index, value) {
            SelectedDates[index] = value;
        });
        // console.log(SelectedDates);
        $('#dashDatePicker, #dashDatePicker01')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    beforeShowDay: function (date) {
                        /* var d = date;
                         var curr_date = ("0" + d.getDate()).slice(-2);
                         var curr_month = ("0" + ((d.getMonth()) + 1)).slice(-2);
                         //var curr_month = d.getMonth() + 1; //Months are zero based
                         var curr_year = d.getFullYear();
                         var formattedDate = curr_year + "-" + curr_month + "-" + curr_date;
                         // console.log("" + formattedDate + "");
                         //  console.log(SelectedDates);
                         // if ($.inArray(formattedDate, SelectedDates) !== -1) {
                         //                        if ($.inArray("2016-04-28", SelectedDates) !== -1) {
                         //                            console.log('1');
                         //                            return {
                         //                                classes: 'active'
                         //                            };
                         //                        } else {
                         //                            console.log('0');
                         //                        }
                         // console.log(formattedDate);
                         
                         $.each(SelectedDates, function (index, value) {
                         // console.log(value);
                         if (formattedDate === value) {
                         
                         } else {
                         console.log('0');
                         }
                         });*/

                        var date_str = formatDate('yyyy-mm-dd', date);
                        var dates_unselect = $(this).data("deselect").split(",");
                        return {selectable: ($.inArray(date_str, dates_unselect) === -1)};

                    }
                })
                .on('changeDate', function (e) {
                    // Set the value for the date input
                    $("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
                });
    });

</script>
<script type="text/javascript">

    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });

    $('.dashTab>.nav-tabs').scrollingTabs();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
        $("[id^=button]").click(function () {
            $('#info' + this.id.match(/\d+$/)[0]).toggle('1000');
            $('#glyphiconRight' + this.id.match(/\d+$/)[0]).toggleClass("hide");
            $('#glyphiconBottom' + this.id.match(/\d+$/)[0]).toggleClass("show");
        });
    });
</script>
<script>
    var base_url = "<?php echo base_url(); ?>";
    $('.search_category').click(function () {
        var category = $(this).attr('id');
        window.location.href = base_url + 'search/keyword=' + category + '';
    });
</script>
</body>
</html>
