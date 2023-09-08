jQuery(document).ready(function () {
    // Get all divs with class 'chart_container'
    var chartDivs = document.getElementsByClassName('chart_container');
    // Loop through each chart div
    for (var i = 0; i < chartDivs.length; i++) {
        var div = chartDivs[i];

        // Get the ID and data-config value
        var divId = div.id;
        var config = div.getAttribute('data-config');
        // Parse the data-config value as JSON
        var chartConfig = JSON.parse(config);
        // // Initialize Highcharts for the div using the config
        Highcharts.chart(divId, chartConfig);
    }

});     