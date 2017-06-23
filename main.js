$(document).ready(function() {

    var date_input=$('input[name="run-date"]'); //our date input has the name "add-run-date"
    date_input.datepicker({
        format: 'mm/dd/yyyy',
        orientation: "auto",
        todayHighlight: true,
        autoclose: true,
    });

    $(".delete-run-button").click(function(event) {
        var id_to_delete = event.target.id;

        $.ajax({
            type: 'POST',
            url: '../ajax/delete-run.php',
            data: {delete_id: id_to_delete},
            success: function(response) {
                console.log(response);
                window.location.reload(true);
            }
        });
    });

    // EDIT Run Button Clicked
    // First needs to find row from DB
    // Seconds needs to put response into edit form
    $(".edit-run-button").click(function(event) {
        var row_to_edit = event.target.id;
        //console.log(id_to_edit);

        $.ajax({
            type: 'POST',
            url: '../ajax/row-to-edit.php',
            data: {edit_id: row_to_edit},
            success: function(response) {
                response = JSON.parse(response);
                var runDate = response.run_date;
                var runMiles = response.run_miles;
                var runTime = response.run_time;
                var runCity = response.run_city;
                var runState = response.run_state;

                var runHours = Math.floor(runTime / 3600);
                var leftoverSeconds = runTime - (runHours * 3600);
                var runMinutes = Math.floor(leftoverSeconds / 60);
                var finalSeconds = runTime - ((runHours * 3600) + (runMinutes * 60));

                console.log(finalSeconds);

                $('#edit-run-date').val(runDate);
                $('#edit-run-miles').val(runMiles);
                $('#edit-run-hours-select').val(runHours);
                $('#edit-run-minutes-select').val(runMinutes);
                $('#edit-run-seconds-select').val(finalSeconds);
                $('#edit-run-city').val(runCity);
                $('#edit-run_state_select').val(runState);
            }
        });
    });

    // Edit Run Form Submitted
    $(".edit-run-submit").click(function(event) {
        console.log(event);
    });

});


function userWeather(zipcode) {
    //$(".zipcode").html(zipcode);
    //console.log(zipcode);

    var ajax_url = "http://api.wunderground.com/api/1327244ae3ca9b7d/conditions/q/" + zipcode + ".json";

    $.ajax( {
        url: ajax_url,
        dataType: "json",
        success: function(response) {
            //console.log(response);
            var weather_output = "<p>Local Weather in " + response.current_observation.display_location.city + "</p>";
            weather_output += "<p><img src='http://icons.wxug.com/i/c/k/rain.gif' class='weather_icon'>" + response.current_observation.temp_f + "&deg;";
            weather_output += "<img src='../images/wundergroundLogo_4c_horz.png' class='weather_logo'></p>";


            $(".weather-info").html(weather_output);
        }
    });
}