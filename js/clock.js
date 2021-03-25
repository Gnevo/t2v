function updateClock ( )
{
    var currentTime = new Date ();
    var currentYear = currentTime.getFullYear();
    var currentMonth = parseInt(currentTime.getMonth() + 1);
    var currentDate = currentTime.getDate();
    var currentHours = currentTime.getHours();
    var currentMinutes = currentTime.getMinutes();
    var currentSeconds = currentTime.getSeconds();
 
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
 
    // Compose the string for display
    var monthDisplay = currentMonth;
    if(("" + currentMonth).length <= 1)
        monthDisplay = '0' + currentMonth;
    var dateDisplay = currentDate;
    if(("" + currentDate).length <= 1)
        dateDisplay = '0' + currentDate;
    var hourDisplay = currentHours;
    if(("" + currentHours).length <= 1)
        hourDisplay = '0' + currentHours;
    var minutesDisplay = currentMinutes;
    if(("" + currentMinutes).length <= 1)
        minutesDisplay = '0' + currentMinutes;
    
    var currentTimeString = currentYear + "-" + monthDisplay + "-" + dateDisplay + " | " + hourDisplay + ":" + minutesDisplay;
 
    $("#clock").html(currentTimeString);
 
}
$(document).ready(function()
{
    updateClock();
    setInterval('updateClock()', 1000);
});

