<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to Zingup</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <style type="text/css">

            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body {
                margin: 0 15px 0 15px;
            }

            p.footer {
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
            .error{
                color: red;
            }
            .success{
                color: green;
            }
            .logout{
                float: right;
                margin-right: 20px;
            }
            span{
                float: left;
            }
            b{
                float: right;
                text-align: left;
                width: 120px;
            }
            table.gridtable {
                font-family: verdana,arial,sans-serif;
                font-size:11px;
                color:#333333;
                border-width: 1px;
                border-color: #666666;
                border-collapse: collapse;
            }
            table.gridtable th {
                border-width: 1px;
                padding: 8px;
                border-style: solid;
                border-color: #666666;
                background-color: #dedede;
            }
            table.gridtable td {
                border-width: 1px;
                padding: 8px;
                border-style: solid;
                border-color: #666666;
                background-color: #ffffff;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1>My Bookings</h1>
            <div id="body">
                <a class="logout" href="<?php echo base_url(); ?>logout">Logout</a><br/><br/>
                <ul>
                    <li><a href="<?php echo base_url(); ?>my_profile">My Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>my_bookings">My Bookings</a></li>
                    <li><a href="<?php echo base_url(); ?>my_bookings">My Transactions</a></li>
                </ul>
                <br/><br/>

                <div style="">
                    <table class="gridtable">
                        <thead>
                        <th>S. No.</th>
                        <th>Booking Id</th>
                        <th>Booking Date</th>
                        <th>Program</th>
                        <th>Service</th>
                        <th>Slot Date</th>
                        <th>Slot Timings</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $value->id; ?></td>
                                    <td><?php echo $value->booking_date; ?></td>
                                    <td><?php echo $value->program; ?></td>
                                    <td><?php echo $value->services; ?></td>
                                    <td><?php echo $value->date; ?></td>
                                    <td><?php echo $value->start_time . '-' . $value->end_time; ?></td>
                                    <td><button type="button" class="btn btn-danger">Cancel</button></td>
                                    <td><button type="button" class="btn btn-warning">Modify</button></td>
                                    <td><button type="button" class="btn btn-info">View Details</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><br/><br/>

            <p class="footer">Footer</p>
        </div>

    </body>
</html>