<?php

$calendarName = "Zinguplife Calendar";
$sitename = "Zinguplife"; // For the Google Option
$siteurl = 'http://zinguplife.com/'; // For the Google Option
$timeZone = 'Asia/Kolkata'; // See PHP Timezones to find the correct format for your local timezone
$defaultEventLength = 2; // Length of event if no "length" or "end" is set (in hours)

$format = $_GET['format']; // Either "ical" or "google"
$filename = urldecode($_GET['fn']);
$created = date('Ymd\THis');
$start = urldecode(strtotime($_GET['start']));
$finish = (empty($_GET['finish']) ? (empty($_GET['length']) ? ($start + ($defaultEventLength * 3600)) : ($start + ($_GET['length'] * 3600))) : urldecode(strtotime($_GET['finish'])));
$url = urldecode($_GET['url']);
$imgstr = $_GET['imgurl'];
if (!empty($imgstr)) {
    $imgurl = file_get_contents($imgstr);
    $imdata = base64_encode($imgurl);
    $imname = (!empty($_GET['imgname']) ? $_GET['imgname'] : 'staticmap.png');
}

$toReplace = array(' ', "'", '.');
$replaceWith = array('_', '', '');
$filename = strtolower(str_replace($toReplace, $replaceWith, $filename));

switch ($format) {
    case 'ical': // Generate an ICS file compatible with Outlook 2007 and Apple iCal/Calendar

        $title = urldecode($_GET['title']);
        $location = str_replace(',', '\,', urldecode($_GET['loc']));
        header("Content-Type: text/Calendar");
        header("Content-Disposition: inline; filename=" . $filename . ".ics");

        echo "BEGIN:VCALENDAR\n";
        echo "METHOD:PUBLISH\n";
        echo "VERSION:2.0\n";
        echo "X-WR-CALNAME:" . $calendarName . "\n";
        echo "PRODID:-//JemWebDesign.co.uk//NONSGML Events//EN\n";
        echo "X-APPLE-CALENDAR-COLOR:#F64F00\n";
        echo "X-WR-TIMEZONE:Europe/London\n";
        echo "CALSCALE:GREGORIAN\n";
        echo "BEGIN:VEVENT\n";
        echo "CREATED:" . $created . "\n";
        echo "UID:" . $created . "-" . substr(md5(rand()), 0, 10) . "-jemwebdesign.co.uk\n";
        echo "DTEND;TZID=" . $timeZone . ":" . date('Ymd\THis', $finish) . "\n";
        echo "TRANSP:OPAQUE\n";
        echo "SUMMARY:" . $title . "\n";
        echo (!empty($_GET['imgurl']) ? "ATTACH;ENCODING=BASE64;VALUE=BINARY;X-APPLE-FILENAME=" . $imname . ":" . $imdata . "\n" : '');
        echo "DTSTART;TZID=" . $timeZone . ":" . date('Ymd\THis', $start) . "\n";
        echo "DTSTAMP:" . $created . "\n";
        echo "LOCATION:" . $location . "\n";
        echo (!empty($url) ? "URL;VALUE=URI:" . $url . "\n" : '');
        echo "END:VEVENT\n";
        echo "END:VCALENDAR\n";
        echo "\n";

        break;

    case 'google':

        $title = $_GET['title'];
        $location = $_GET['loc'];
        $goto = "http://www.google.com/calendar/event?action=TEMPLATE&text=" . $title . "&dates=" . date('Ymd\THis', $start) . "/" . date('Ymd\THis', $finish) . "&details=&location=" . $location . "&trp=true&sprop=" . urlencode($sitename) . "&sprop=name:" . urlencode($siteurl) . "";
        header("Location: " . $goto . "");
        break;
}
?>