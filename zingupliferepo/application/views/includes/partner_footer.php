<?php include_once 'footer_ui.php';?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/timer.jquery.js'></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-modal.js"></script>
<script type='text/javascript'  src="<?php echo base_url(); ?>assets/js/moment-with-locales.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/ion.calendar.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.plugin.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.datepick.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.bxslider.js"></script>
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
<script>
    $(document).ready(function () {
        $(".nav-toggle").click(function () {
            $("#show-content").toggle();
            return false;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.bxslider').bxSlider({
            auto: true,
            randomStart: true,
            infiniteLoop: true,
            mode: 'fade',
            captions: false,
            controls: false,
            pager: false

        });
        $('.testimonials').bxSlider({
            auto: true,
            randomStart: true,
            infiniteLoop: true,
            mode: 'horizontal',
            captions: true,
            controls: false,
            pager: true

        });
    });</script>

<script src="<?php echo base_url(); ?>assets/js/easyResponsiveTabs.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        //Horizontal Tab
        $('.offer-tab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $('.service-tab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });</script>

<script>
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";
        $(".menu li a").each(function () {
            if ($(this).next().length > 0) {
                $(this).addClass("parent");
            }
            ;
        })
        var menux = $('.menu li a.parent');
        $('<div class="more"><img src="' + base_url + 'assets/images/btn-hamburger.png" alt=""></div>').insertBefore(menux);
        $('.more').click(function () {
            $(this).parent('li').toggleClass('open');
        });
        $('.menu-btn').click(function () {
            $('nav').toggleClass('menu-open');
        });
    });</script>

<script src="<?php echo base_url(); ?>assets/js/classie.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modalEffects.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<a href="#0" class="cd-top">Top</a>


<script>
    $('#timer').timer({
        duration: '<?php
if ($booking_time_duration_length != '') {
    echo $booking_time_duration_length;
} else {
    
}
?>',
        callback: function () {
            var slot_id = '<?php
if (isset($choosed_booking_time)) {
    echo $choosed_booking_time;
} else {
    $choosed_booking_time = '';
}
?>';
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>change_slot_status',
                data: {slot_id: slot_id},
                dataType: "html",
                success: function (data) {

                }
            });
            $('#myModal').modal();
            $(".btn").click(function () {
                window.location = "<?php echo base_url(); ?>chooseBookingDate";
            });
            $('.timer').hide();
            $(".modal-backdrop").click(function () {
                window.location = "<?php echo base_url(); ?>chooseBookingDate";
            });
        },
        restart: false
    });</script>

<script>

    $(function () {

        $('.datepicker').datepick({
            minDate: new Date(),
            maxDate: new Date(2016, 12 - 1, 31),
            yearRange: '2015:2016',
            dateFormat: 'yyyy-mm-dd',
            altField: '#start_date', altFormat: 'yyyy-mm-dd',
            onSelect: showDate2
        });
    });
    function showDate2(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#start_date').val(current_date);
    }



    $(function () {

        $('.datepicker2').datepick({
            minDate: new Date(),
            maxDate: new Date(2016, 12 - 1, 31),
            yearRange: '2015:2016',
            dateFormat: 'yyyy-mm-dd',
            altField: '#end_date', altFormat: 'yyyy-mm-dd',
            onSelect: showDate3
        });
    });
    function showDate3(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#end_date').val(current_date);
    }

    $(function () {

        $('#inlineDatepicker').datepick({
            minDate: new Date(),
            maxDate: new Date(2016, 12 - 1, 31),
            yearRange: '2015:2016',
            dateFormat: 'yyyy-mm-dd',
            altField: '#booking_date', altFormat: 'yyyy-mm-dd',
            onDate: function (date) {
                //alert('bgfbg');
                var date_str = $.datepick.formatDate('yyyy-mm-dd', date);
                var dates_unselect = $(this).data("deselect").split(",");
                return {selectable: ($.inArray(date_str, dates_unselect) === -1)};
            },
            onSelect: showDate});
    });
    function showDate(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#booking_date').val(current_date);
    }

    $(function () {

        $('#inlineDatepicker1').datepick({
            minDate: new Date(),
            maxDate: new Date(2016, 12 - 1, 31), yearRange: '2015:2016',
            dateFormat: 'yyyy-mm-dd', altField: '#reschedule_date', altFormat: 'yyyy-mm-dd',
            onSelect: showDate1
        });
    });
    function showDate1(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#reschedule_date').val(current_date);
    }

</script>
<script src="<?php echo base_url(); ?>assets/home_page/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox({
            closeClick: false, // prevents closing when clicking INSIDE fancybox
            helpers: {
                overlay: {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
            },
            keys: {
                // prevents closing when press ESC button
                close: null
            }
        }).trigger('click');
    });</script>


<!--<script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js" type="text/javascript"></script>-->

<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.timepicker.js"></script>  
<script type="text/javascript">
    $(function () {
        $('#business_type').multiselect({
            includeSelectAllOption: true});
        $('#btnSelected').click(function () {
            var selected = $("#lstFruits option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });</script>
<script type="text/javascript">
    $('#email_subscription_error').css('display', 'none');
    $('#subscription_success').hide();
    $("#subscription_submit").click(function () {
        var email = $('#subscription_email').val();
        var zipcode = $('#subscription_zipcode').val();
        if (email == '') {
            $('#email_subscription_error').css('display', 'block');
        } else {
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
        }
        return false;
    });

</script>
<script>
    $('input,textarea').focus(function () {
        $(this).removeAttr('placeholder');
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#check-text').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected').click(function () {
            var selected = $("#check-text option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });
</script> 

<script type="text/javascript">
    $(function () {
        $('body .slot_start_time').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('body .slot_end_time').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script>
    $(document).ready(function () {
        var count = 1;
        $("#add-block").click(function () {

            if (count <= 9) {
                var clone = $(".add-time-block:first").clone();
                clone.find('.slot_start_time').attr('value', '');
                clone.find('.slot_end_time').attr('value', '');
                //$(".add-time-block:first").clone().appendTo("#start-date-end-date");
                $("#start-date-end-date").append(clone);
                count++;
            }
            $(function () {
                $('body .slot_start_time').timepicker({
                    timeFormat: 'H:i',
                });
            });
            $(function () {
                $('body .slot_end_time').timepicker({
                    timeFormat: 'H:i'
                });
            });
            return false;
        });
    });
</script>


<script type="text/javascript">
    $(function () {
        $('#check-text1').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected1').click(function () {
            var selected = $("#check-text1 option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });
</script> 

<script type="text/javascript">
    $(function () {
        $('body .slot_start_time1').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('body .slot_end_time1').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script>
    $(document).ready(function () {
        var count = 1;
        $("#add-block1").click(function () {
            if (count <= 9) {
//                $(".add-time-block1:first").clone().appendTo("#start-date-end-date1");
//                count++;

                var clone = $(".add-time-block1:first").clone();
                clone.find('.slot_start_time1').attr('value', '');
                clone.find('.slot_end_time1').attr('value', '');
                //$(".add-time-block:first").clone().appendTo("#start-date-end-date");
                $("#start-date-end-date1").append(clone);
                count++;
            }
            $(function () {
                $('body .slot_start_time1').timepicker({
                    timeFormat: 'H:i'
                });
            });
            $(function () {
                $('body .slot_end_time1').timepicker({
                    timeFormat: 'H:i'
                });
            });
            return false;
        });
    });
    $('#slots-date').multiselect({
        includeSelectAllOption: true
    });
    $('#btnSelected1').click(function () {
        var selected = $("#slots-date option:selected");
        var message = "";
        selected.each(function () {
            message += $(this).text() + " " + $(this).val() + "\n";
        });
        alert(message);
    });


    $('#slots-date-picker').datepick({
        minDate: new Date(),
        dateFormat: 'yyyy-mm-dd',
        altField: '#slots-date-picker',
        altFormat: 'yyyy-mm-dd',
        onSelect: showDate2
    });

    function showDate2(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#slots-date-picker').val(current_date);
    }

    $('#slots-date-picker1').datepick({
        minDate: new Date(),
        dateFormat: 'yyyy-mm-dd',
        altField: '#slots-date-picker1',
        altFormat: 'yyyy-mm-dd',
        onSelect: showDate3
    });

    function showDate3(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#slots-date-picker1').val(current_date);
    }

    $('#slots-date-picker2').datepick({
        minDate: new Date(),
        dateFormat: 'yyyy-mm-dd',
        altField: '#slots-date-picker2',
        altFormat: 'yyyy-mm-dd',
        onSelect: showDate4
    });

    function showDate4(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#slots-date-picker2').val(current_date);
    }


</script>
<script>
    $(document).ready(function () {
        $("#add-block2").click(function () {

            //if (count <= 9) {
            var clone = $(".add-time-block2").clone();
            clone.find('.new_ctr').css('margin-top', '2%');
            clone.find('.name_ctr').attr('value', '');
            //$(".add-time-block:first").clone().appendTo("#start-date-end-date");
            $("#start-date-end-dates").append(clone);
            //count++;
            // }
            return false;
        });
    });
</script>

</body>
</html>

