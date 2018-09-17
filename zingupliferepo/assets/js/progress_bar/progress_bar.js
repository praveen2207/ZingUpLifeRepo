$(document).ready(function() {
    var x = document.getElementsByClassName("my-progress-bar");
    for (let i=0; i<x.length; i++) {
        $(x[i]).circularProgress({
            line_width: 10,
            color: "red",
            starting_position: 0, // 12.00 o' clock position, 25 stands for 3.00 o'clock (clock-wise)
            percent: 0, // percent starts from
            percentage: true,
        }).circularProgress('animate', 75, 1000);
      }
});
