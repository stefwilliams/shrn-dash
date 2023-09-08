<?php

add_shortcode('highcharts', 'shrn_school_dash');


function shrn_school_dash() {
    
    $dash = new SHRN\Dash();
    return $dash->get_html();
    
    // $dash->render_chart();
}


// function render_highcharts()
// {


//     return <<<CHARTS
    
// <figure class="highcharts-figure">
//     <div id="stacked_grouped_container"></div>
//     <p class="highcharts-description">
//         Base: All respondents in years 7 to 11 who gave an answer, surveyed between September and December 2019 (n=101,694). 95% confidence intervals for categories with < 1,000 respondents available in Appendix </p>
// </figure>
// <hr />
// <figure class="highcharts-figure">
//     <div id="bar_spline_container"></div>
//     <p class="highcharts-description">
//         Did you know?<br />
//         Researchers from WISERD studied the sleep patterns of nearly 500 students in years 8 and 10 in Welsh secondary schools in 2012/1352. They found that the commonest bedtime for 14-15 year olds was 11pm, but 28% went to bed at or after midnight. Young people who did not have a regular bedtime were more likely to go to bed at or after midnight and young people from ethnic minority backgrounds were more likely to say they had no regular bedtime.
//         <br />
//         One year later, young people who had said they always felt tired when they went to school were significantly more likely to rate their wellbeing less favourably.
//     </p>
// </figure>
// <hr />
// <figure class="highcharts-figure">
//     <div id="bar_spline_container_2"></div>
//     <p class="highcharts-description">
//         Did you know?<br />
//         Breakfast provided to students of maintained schools should contain the following foods only: milk-based drinks or yoghurts; cereals –not sugar/chocolate/cocoa powder coated or flavoured; fruit and vegetables; and breads and toppings19.</p>
// </figure>
// <hr />
// <figure class="highcharts-figure">
//     <div id="bar_spline_container_3"></div>
//     <p class="highcharts-description">
//         Using data from the 2013 Health Behaviour in School-aged Children Survey in Wales, School Health Research Network researchers found that more positive student-teacher relationships were associated with better health outcomes for students, including higher rates of self-rated general health and life satisfaction, as well as lower rates of self-reported smoking, cannabis and alcohol2.
//         <br />You can find out more about this study in our Research Brief here: www.shrn.org.uk/research-briefing-sheets/
//     </p>
// </figure>
// <script>
//     Highcharts.chart('stacked_grouped_container', {

//         chart: {
//             type: 'column',
//         },

//         title: {
//             text: 'Figure 3.24 SDQ emotional problems scale score by gender and year group (%)',
//         },

//         xAxis: {
//             categories: ['Male', 'Female', 'Neither word describes me'],
//             offset: 30
//         },

//         yAxis: {
//             allowDecimals: false,
//             min: 0,
//             title: {
//                 text: 'Percentage'
//             },
//             stackLabels: {
//                 enabled: true,
//                 // style: {
//                 //   fontWeight: 'bold'
//                 // },
//                 verticalAlign: 'bottom',
//                 formatter: function() {
//                     // console.log(this);
//                     return this.stack;
//                 },
//                 y: -2,
//                 // allowOverlap: true,
//                 crop: false,
//                 overflow: 'allow',

//             }
//         },

//         tooltip: {
//             formatter: function() {
//                 return '<b>' + this.x + '</b><br/>' +
//                     this.series.name + ': ' + this.y + '<br/>' +
//                     'Total: ' + this.point.stackTotal;
//             }
//         },

//         plotOptions: {
//             column: {
//                 stacking: 'normal',
//                 events: {
//                     legendItemClick: function() {
//                         var series = this.chart.series;
//                         var name = this.name;

//                         // Highlight the data points with the same name across all series
//                         series.forEach(function(s) {
//                             if (s.name === name) {
//                                 if (s.visible) {
//                                     s.hide();
//                                 } else {
//                                     s.show();
//                                 }
//                             }
//                         });

//                         return false; // Cancel the default legend item click behavior
//                     },
//                 }
//             }
//         },

//         series: [{
//                 name: 'Very High',
//                 data: [9, 18, 47],
//                 stack: 'Yr 7',
//                 color: Highcharts.getOptions().colors[0]
//             }, {
//                 name: 'Very High',
//                 data: [10, 26, 42],
//                 stack: 'Yr 8',
//                 linkedTo: 0,
//                 color: Highcharts.getOptions().colors[0]
//             }, {
//                 name: 'Very High',
//                 data: [11, 30, 47],
//                 stack: 'Yr 9',
//                 linkedTo: 0,
//                 color: Highcharts.getOptions().colors[0]
//             }, {
//                 name: 'Very High',
//                 data: [12, 38, 41],
//                 stack: 'Yr 10',
//                 linkedTo: 0,
//                 color: Highcharts.getOptions().colors[0]
//             }, {
//                 name: 'Very High',
//                 data: [13, 39, 49],
//                 stack: 'Yr 11',
//                 linkedTo: 0,
//                 color: Highcharts.getOptions().colors[0]
//             },

//             {
//                 name: 'High',
//                 data: [6, 9, 6],
//                 stack: 'Yr 7',
//                 color: Highcharts.getOptions().colors[1]
//             }, {
//                 name: 'High',
//                 data: [6, 11, 12],
//                 stack: 'Yr 8',
//                 linkedTo: 1,
//                 color: Highcharts.getOptions().colors[1]
//             }, {
//                 name: 'High',
//                 data: [6, 12, 9],
//                 stack: 'Yr 9',
//                 linkedTo: 1,
//                 color: Highcharts.getOptions().colors[1]
//             }, {
//                 name: 'High',
//                 data: [7, 12, 9],
//                 stack: 'Yr 10',
//                 linkedTo: 1,
//                 color: Highcharts.getOptions().colors[1]
//             }, {
//                 name: 'High',
//                 data: [8, 13, 9],
//                 stack: 'Yr 11',
//                 linkedTo: 1,
//                 color: Highcharts.getOptions().colors[1]
//             },

//             {
//                 name: 'Slightly raised',
//                 data: [9, 11, 13],
//                 stack: 'Yr 7',
//                 color: Highcharts.getOptions().colors[2]
//             },
//             {
//                 name: 'Slightly raised',
//                 data: [9, 13, 13],
//                 stack: 'Yr 8',
//                 linkedTo: 2,
//                 color: Highcharts.getOptions().colors[2]
//             }, {
//                 name: 'Slightly raised',
//                 data: [10, 13, 9],
//                 stack: 'Yr 9',
//                 linkedTo: 2,
//                 color: Highcharts.getOptions().colors[2]
//             }, {
//                 name: 'Slightly raised',
//                 data: [10, 12, 10],
//                 stack: 'Yr 10',
//                 linkedTo: 2,
//                 color: Highcharts.getOptions().colors[2]
//             }, {
//                 name: 'Slightly raised',
//                 data: [11, 13, 9],
//                 stack: 'Yr 11',
//                 linkedTo: 2,
//                 color: Highcharts.getOptions().colors[2]
//             },

//             {
//                 name: 'Close to average',
//                 data: [76, 63, 34],
//                 stack: 'Yr 7',
//                 color: Highcharts.getOptions().colors[3]
//             }, {
//                 name: 'Close to average',
//                 data: [74, 50, 33],
//                 stack: 'Yr 8',
//                 linkedTo: 3,
//                 color: Highcharts.getOptions().colors[3]
//             }, {
//                 name: 'Close to average',
//                 data: [73, 45, 35],
//                 stack: 'Yr 9',
//                 linkedTo: 3,
//                 color: Highcharts.getOptions().colors[3]
//             }, {
//                 name: 'Close to average',
//                 data: [70, 37, 41],
//                 stack: 'Yr 10',
//                 linkedTo: 3,
//                 color: Highcharts.getOptions().colors[3]
//             }, {
//                 name: 'Close to average',
//                 data: [69, 35, 33],
//                 stack: 'Yr 11',
//                 linkedTo: 3,
//                 color: Highcharts.getOptions().colors[3]
//             },

//         ]
//     });

//     /** bar_spline_container from here */

//     Highcharts.chart('bar_spline_container', {

//         chart: {
//             type: 'column',
//         },

//         title: {
//             text: 'Fig. 16 The Sheppard Academy: Students  who usually go to bed at 11.30pm or later when they have school the next day',
//         },

//         xAxis: {
//             categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13', 'School Average'],
//             offset: 30
//         },

//         yAxis: {
//             allowDecimals: false,
//             min: 0,
//             title: {
//                 text: 'Percentage'
//             },
//             // dataLabels: {
//             //     enabled: true,
//             //     // style: {
//             //     //   fontWeight: 'bold'
//             //     // },
//             //     verticalAlign: 'bottom',
//             //     y: -2,
//             //     // allowOverlap: true,
//             //     // crop: false,
//             //     // overflow: 'allow',

//             // }
//         },

//         tooltip: {
//             formatter: function() {
//                 return '<b>' + this.x + '</b><br/>' +
//                     this.series.name + ': ' + this.y + '<br/>';
//             }
//         },

//         plotOptions: {

//         },

//         series: [{
//             type: 'column',
//             name: 'Male',
//             data: [7, 13, 32, 38, 50, 41, 52, 29]
//         }, {
//             type: 'column',
//             name: 'Female',
//             data: [4, 10, 34, 34, 35, 43, 52, 26]
//         }, {
//             type: 'column',
//             name: 'Total',
//             data: [6, 12, 34, 37, 44, 42, 53, 28]
//         }, {
//             type: 'spline',
//             name: 'National Female Average',
//             data: [9, 18, 30, 38, 43, 42, 46, 29],
//             marker: {
//                 lineWidth: 2,
//                 lineColor: Highcharts.getOptions().colors[3],
//                 fillColor: 'white'
//             }
//         }, {
//             type: 'spline',
//             name: 'National Male Average',
//             data: [11, 17, 29, 40, 49, 52, 56, 32],
//             marker: {
//                 lineWidth: 2,
//                 lineColor: Highcharts.getOptions().colors[4],
//                 fillColor: 'white'
//             }
//         }]
//     });

//     /** bar_spline_container_2 from here */

//     Highcharts.chart('bar_spline_container_2', {

//         chart: {
//             type: 'column',
//         },

//         title: {
//             text: 'Fig. 1 The Sheppard Academy: Students who usually eat breakfast every weekday',
//         },

//         xAxis: {
//             categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13', 'School Average'],
//             offset: 30
//         },

//         yAxis: {
//             allowDecimals: false,
//             min: 0,
//             title: {
//                 text: 'Percentage'
//             },
//             stackLabels: {
//                 enabled: true,
//                 // style: {
//                 //   fontWeight: 'bold'
//                 // },
//                 verticalAlign: 'bottom',
//                 formatter: function() {
//                     return this.stack;
//                 },
//                 y: -2,
//                 // allowOverlap: true,
//                 crop: false,
//                 overflow: 'allow',

//             }
//         },

//         tooltip: {
//             formatter: function() {
//                 return '<b>' + this.x + '</b><br/>' +
//                     this.series.name + ': ' + this.y + '<br/>';
//             }
//         },

//         plotOptions: {

//         },

//         series: [{
//             type: 'column',
//             name: 'Male',
//             data: [67, 63, 66, 50, 56, 50, 60, 61]
//         }, {
//             type: 'column',
//             name: 'Female',
//             data: [64, 55, 43, 43, 53, 50, 52, 50]
//         }, {
//             type: 'column',
//             name: 'Total',
//             data: [65, 59, 55, 46, 55, 50, 55, 55]
//         }, {
//             type: 'spline',
//             name: 'National Female Average',
//             data: [56, 49, 39, 38, 38, 48, 39, 49],
//             marker: {
//                 lineWidth: 2,
//                 lineColor: Highcharts.getOptions().colors[3],
//                 fillColor: 'white'
//             }
//         }, {
//             type: 'spline',
//             name: 'National Male Average',
//             data: [64, 59, 58, 55, 52, 55, 50, 59],
//             marker: {
//                 lineWidth: 2,
//                 lineColor: Highcharts.getOptions().colors[4],
//                 fillColor: 'white'
//             }
//         }]
//     });

//     /** bar_spline_container_3 from here */

//     Highcharts.chart('bar_spline_container_3', {

//         chart: {
//             type: 'column',
//         },

//         title: {
//             text: 'Fig. 12 The Sheppard Academy: Students  who “agree” or “strongly agree” that teachers care about them as a person',
//         },

//         xAxis: {
//             categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13', 'School Average'],
//             offset: 30
//         },

//         yAxis: {
//             allowDecimals: false,
//             min: 0,
//             title: {
//                 text: 'Percentage'
//             },
//             stackLabels: {
//                 enabled: true,
//                 // style: {
//                 //   fontWeight: 'bold'
//                 // },
//                 verticalAlign: 'bottom',
//                 formatter: function() {
//                     return this.stack;
//                 },
//                 y: -2,
//                 // allowOverlap: true,
//                 crop: false,
//                 overflow: 'allow',

//             }
//         },

//         tooltip: {
//             formatter: function() {
//                 return '<b>' + this.x + '</b><br/>' +
//                     this.series.name + ': ' + this.y + '<br/>';
//             }
//         },

//         plotOptions: {

//         },

//         series: [{
//                 type: 'column',
//                 name: 'Male',
//                 data: [45, 46, 42, 51, 38, 59, 38, 45]
//             }, {
//                 type: 'column',
//                 name: 'Female',
//                 data: [67, 44, 32, 46, 39, 47, 43, 45]
//             }, {
//                 type: 'column',
//                 name: 'Total',
//                 data: [54, 45, 35, 49, 38, 52, 41, 45]
//             }, {
//                 type: 'spline',
//                 name: 'National Female Average',
//                 data: [75, 63, 55, 52, 53, 65, 64, null],
//                 marker: {
//                     lineWidth: 2,
//                     lineColor: Highcharts.getOptions().colors[3],
//                     fillColor: 'white'
//                 }
//             },
//             {
//                 type: 'spline',
//                 name: 'National Female Average',
//                 data: [null, null, null, null, null, null, null, 57],
//                 linkedTo: 3,
//                 marker: {
//                     lineWidth: 2,
//                     lineColor: Highcharts.getOptions().colors[3],
//                     fillColor: 'white',
//                 },
//                 linkedTo: 3,
//             }, {
//                 type: 'spline',
//                 name: 'National Male Average',
//                 data: [75, 60, 52, 50, 51, 62, 63, null],
//                 marker: {
//                     lineWidth: 2,
//                     lineColor: Highcharts.getOptions().colors[4],
//                     fillColor: 'white'
//                 }
//             }, {
//                 type: 'spline',
//                 name: 'National Male Average',
//                 data: [null, null, null, null, null, null, null, 55],
//                 linkedTo: 4,
//                 marker: {
//                     lineWidth: 2,
//                     lineColor: Highcharts.getOptions().colors[4],
//                     fillColor: 'white'
//                 },
//                 linkedTo: 4,
//             }
//         ]
//     });
// </script>
// CHARTS;
// }
