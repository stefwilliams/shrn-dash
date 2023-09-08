<?php

/**
 * Custom Plugin Template
 * File: dash-test.php
 *
 */

get_header();

// $args = array(
//     'post_type' => 'chart-mapping'
// );

// $mappings = get_posts($args);

// foreach ($mappings as $mapping) {
//     $meta = get_post_meta($mapping->ID);
//     pre_dump($meta);
// }

// pre_dump($mappings);

?>

<style>
    /** radio button show hide*/
    .radio_1,
    .radio_2 {
        display: none;
    }

    /* input#radio_1:checked + .radio_1, input#radio_2:checked + .radio_2 {
    display:block;
} */

    .radio_1:has(~ input#radio_1:checked),
    .radio_2:has(~ input#radio_2:checked) {
        display: block;
    }

    /** tabbed layout*/
    .h-tab {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .h-tab_tab-head {
        display: flex;
        flex-direction: row;
        margin: 0 0 30px 0;
        padding: 0;
        list-style: none;
        width: 100%;
    }

    .h-tab_tab-head li {
        font-size: 16px;
        margin: 0 0 1px 0;
        cursor: pointer;
        padding: 0px 20px;
        height: 32px;
        line-height: 31px;
        color: #333;
        border-bottom: 0px;
        overflow: hidden;
        position: relative;
    }

    .h-tab_tab-head li:hover {
        border-bottom: 3px solid #f5f5f5;
        color: #000;
    }

    .h-tab_tab-head li.active {
        border-bottom: 3px solid #94399e;
        background-color: #fff;
        color: #94399e;
        display: block;
    }

    .h-tab_tab-head .h-tab_container {
        width: 500px;
        min-height: 200px;
    }

    .h-tab_tab-head .h-tab_content {
        padding: 10px 20px;
        display: none;
    }

    .h-tab_tab-head .h-tab_content> :first-child {
        margin-top: 0;
    }

    .v-tab {
        display: flex;
    }

    .v-tab_tab-head {
        margin: 0;
        padding: 0;
        float: left;
        list-style: none;
        height: 32px;
        width: 125px;
    }

    .v-tab_tab-head li {
        margin: 0 0 1px 0;
        cursor: pointer;
        padding: 0px 10%;
        height: 32px;
        line-height: 31px;
        color: #333;
        border-bottom: 0px;
        overflow: hidden;
        position: relative;
        width: 80%;
    }

    .v-tab_tab-head li:hover {
        background-color: #f5f5f5;
        color: #000;
    }

    .v-tab_tab-head li.active {
        border-right: 3px solid #94399e;
        background-color: #fff;
        color: #94399e;
        display: block;
    }

    .v-tab_container {
        border-left: 1px solid #ccc;
        float: left;
        /* width: 500px; */
        min-height: 132px;
    }

    .v-tab_content {
        padding: 10px 20px;
        display: none;
    }

    .v-tab_content> :first-child {
        margin-top: 0;
    }

    body {
        padding: 50px;
        font-size: 14px;
        font-family: "Open Sans", sans-serif;
    }
</style>
<div class="dash">

    <ul class="h-tab_tab-head">
        <li class="active" rel="htab0">Sleep</li>
        <li rel="htab1">Bullying</li>
        <li rel="htab2">Mental Health Support</li>
    </ul>
    <div class="h-tab_container">
        <div id="htab0" class="h-tab_content">
            <div class="v-tab">
                <ul class="v-tab_tab-head">
                    <li class="active" rel="vtab_1_1">Gender / Year</li>
                    <li rel="vtab_1_2">Trends</li>
                    <li rel="vtab_1_3">Comparison</li>
                </ul>
                <div class="v-tab_container">
                    <div id="vtab_1_1" class="v-tab_content">
                        <figure class="highcharts-figure">
                            <div id="chart_container_1_1" class="chart_container"></div>

                        </figure>
                    </div>
                    <div id="vtab_1_2" class="v-tab_content">
                        <figure class="highcharts-figure">
                            <div id="chart_container_1_2" class="chart_container"></div>

                        </figure>
                    </div>
                    <div id="vtab_1_3" class="v-tab_content">
                        <figure class="highcharts-figure">
                            <div id="chart_container_1_3_1" class="chart_container radio_1"></div>
                            <div id="chart_container_1_3_2" class="chart_container radio_2"></div>
                            Sleep Habits vs
                            <input type="radio" name="chart_switch" id="radio_1" value="radio_1" checked="checked" />
                            <label for="radio_1">Bullying</label>

                            <input type="radio" name="chart_switch" id="radio_2" value="radio_2" />
                            <label for="radio_2">Mental Health Support</label>

                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div id="htab1" class="h-tab_content">
            <div class="v-tab">
                <ul class="v-tab_tab-head">
                    <li class="active" rel="vtab_2_1">Gender / Year</li>
                    <li rel="vtab_2_2">Trends</li>
                    <li rel="vtab_2_3">Comparison</li>
                </ul>
                <div class="v-tab_container">
                    <div id="vtab_2_1" class="v-tab_content">
                        <figure class="highcharts-figure">
                            <div id="chart_container_2_1" class="chart_container"></div>

                        </figure>
                    </div>
                    <div id="vtab_2_2" class="v-tab_content">
                        <figure class="highcharts-figure">
                            <div id="chart_container_2_2" class="chart_container"></div>

                        </figure>
                    </div>
                    <div id="vtab_2_3" class="v-tab_content">
                    </div>
                </div>
            </div>
        </div>
        <div id="htab2" class="h-tab_content">
            <div class="v-tab">
                <ul class="v-tab_tab-head">
                    <li class="active" rel="vtab_3_1">Gender / Year</li>
                    <li rel="vtab_3_2">Trends</li>
                    <li rel="vtab_3_3">Comparison</li>
                </ul>
                <div class="v-tab_container">
                    <div id="vtab_3_1" class="v-tab_content">
                        <figure class="highcharts-figure">
                            <div id="chart_container_3_1" class="chart_container"></div>

                        </figure>
                    </div>
                    <div id="vtab_3_2" class="v-tab_content">
                        <figure class="highcharts-figure">
                            <div id="chart_container_3_2" class="chart_container"></div>

                        </figure>
                    </div>
                    <div id="vtab_3_3" class="v-tab_content">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {

        jQuery(".h-tab_content").hide();
        jQuery(".h-tab_content:first").show();

        jQuery(".h-tab_tab-head li").click(function() {

            jQuery(".h-tab_content").hide();
            var activeTab = jQuery(this).attr("rel");
            jQuery("#" + activeTab).fadeIn();

            var activeSubTab = jQuery('#' + activeTab).find('li.active').attr("rel");
            jQuery('#' + activeSubTab).fadeIn();

            jQuery(".h-tab_tab-head li").removeClass("active");
            jQuery(this).addClass("active");

        });


        jQuery(".v-tab_content").hide();
        jQuery(".v-tab_content:first").show();

        jQuery(".v-tab_tab-head li").click(function() {

            jQuery(".v-tab_content").hide();
            var activeTab = jQuery(this).attr("rel");
            jQuery("#" + activeTab).fadeIn();
            jQuery(this).siblings().removeClass("active");
            jQuery(this).addClass("active");


        });
    });
</script>


<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <article>

            <p>Hi Sheppards Academy</p>
            <p>Welcome to your SHRN data dashboard</p>
            <div class="wp-block-columns is-layout-flex wp-container-3">
                <div class="wp-block-column is-layout-flow">
                    <h2 class="wp-block-heading">About the Dashboard</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis leo tortor, accumsan in justo sagittis, ullamcorper egestas orci. Nulla vitae pretium nibh. Donec consequat pellentesque augue, eu cursus arcu condimentum et. Maecenas faucibus, tellus et porta eleifend, nisi leo iaculis lectus, eu elementum eros justo vitae justo. Nunc et massa id tellus commodo luctus vel at tortor. Curabitur elit diam, venenatis non lectus quis, pharetra viverra nulla. Vestibulum maximus pellentesque sem, quis ullamcorper velit maximus facilisis. Donec feugiat tincidunt egestas. Nam feugiat nulla elementum lacus feugiat aliquet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin vitae porta libero. Fusce dolor velit, efficitur non porttitor sed, maximus eu massa.</p>
                </div>
                <div class="wp-block-column is-layout-flow">
                    <figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
                        <div class="wp-block-embed__wrapper">
                            <iframe title="Data Dashboard Demo: New Features + Q&amp;A" width="640" height="360" src="https://www.youtube.com/embed/_12TdWh5PL4?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>
                        </div>
                    </figure>
                </div>
            </div>


            <figure class="highcharts-figure">
                <div id="stacked_grouped_container"></div>
                <p class="highcharts-description">
                    Base: All respondents in years 7 to 11 who gave an answer, surveyed between September and December 2019 (n=101,694). 95% confidence intervals for categories with < 1,000 respondents available in Appendix </p>
            </figure>
            <hr />
            <figure class="highcharts-figure">
                <div id="bar_spline_container"></div>
                <p class="highcharts-description">
                    Did you know?<br />
                    Researchers from WISERD studied the sleep patterns of nearly 500 students in years 8 and 10 in Welsh secondary schools in 2012/1352. They found that the commonest bedtime for 14-15 year olds was 11pm, but 28% went to bed at or after midnight. Young people who did not have a regular bedtime were more likely to go to bed at or after midnight and young people from ethnic minority backgrounds were more likely to say they had no regular bedtime.
                    <br />
                    One year later, young people who had said they always felt tired when they went to school were significantly more likely to rate their wellbeing less favourably.
                </p>
            </figure>
            <hr />
            <figure class="highcharts-figure">
                <div id="bar_spline_container_2"></div>
                <p class="highcharts-description">
                    Did you know?<br />
                    Breakfast provided to students of maintained schools should contain the following foods only: milk-based drinks or yoghurts; cereals –not sugar/chocolate/cocoa powder coated or flavoured; fruit and vegetables; and breads and toppings19.</p>
            </figure>
            <hr />
            <figure class="highcharts-figure">
                <div id="bar_spline_container_3"></div>
                <p class="highcharts-description">
                    Using data from the 2013 Health Behaviour in School-aged Children Survey in Wales, School Health Research Network researchers found that more positive student-teacher relationships were associated with better health outcomes for students, including higher rates of self-rated general health and life satisfaction, as well as lower rates of self-reported smoking, cannabis and alcohol2.
                    <br />You can find out more about this study in our Research Brief here: www.shrn.org.uk/research-briefing-sheets/
                </p>
            </figure>
        </article>
    </div>
</div>
<script>
    // jQuery(document).ready(function() {
    //     jQuery("figure.highcharts-figure").children(".chart_container").each(function(index) {
    //         console.log(jQuery(this));
    //     });
    // });

    // function ColumnFormatter() {
    //     return '<b>' + this.x + '</b><br/>' + 
    //     this.series.name + ': ' + this.y + '<br/>';
    // }

    var test_obj = {

        chart: {
            type: 'column',
        },

        title: {
            text: 'Students  who usually go to bed at 11.30pm or later when they have school the next day',
        },

        xAxis: {
            categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13'],
            // offset: 230
        },

        yAxis: {
            // allowDecimals: false,
            // min: 0,
            title: {
                text: 'Percentage'
            },
        },

        tooltip: {
            // formatter: ColumnFormatter,
        },
        credits: {
            enabled: false
        },
        plotOptions: {

        },
        series: [{
            type: 'column',
            name: 'Male',
            color: '#000066',
            data: [7, 13, 32, 38, 50, 41, 52]
        }, {
            type: 'column',
            name: 'Female',
            color: '#66CC33',
            data: [4, 10, 34, 34, 35, 43, 52]
        }, {
            type: 'column',
            name: 'Total',
            color: '#FF9933',
            data: [6, 12, 34, 37, 44, 42, 53]
        }, {
            type: 'spline',
            name: 'National Male Average',
            data: [14, 24, 35, 47, 55, 58, 60],
            color: '#000066',
            // marker: {
            //     // lineWidth: 2,
            //     // lineColor: '#000066',
            //     // fillColor: 'white'
            // }
        }, {
            type: 'spline',
            name: 'National Female Average',
            data: [15, 28, 40, 47, 53, 55, 56],
            color: '#66CC33',
            // marker: {
            //     // lineWidth: 2,
            //     // lineColor: '#66CC33',
            //     // fillColor: 'white'
            // }
        }]

    };

    console.log(test_obj);


    Highcharts.chart('chart_container_1_1', {

        chart: {
            type: 'column',
        },

        title: {
            text: 'Students who usually go to bed at 11.30pm or later when they have school the next day',
        },

        xAxis: {
            categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13'],
            // offset: 230
        },

        yAxis: {
            // allowDecimals: false,
            // min: 0,
            title: {
                text: 'Percentage'
            },
            max: 100
        },

        tooltip: {
            // formatter: ColumnFormatter,
        },
        credits: {
            enabled: false
        },
        plotOptions: {

        },
        series: [{
            type: 'column',
            name: 'Male',
            color: '#000066',
            data: [7, 13, 32, 38, 50, 41, 52]
        }, {
            type: 'column',
            name: 'Female',
            color: '#66CC33',
            data: [4, 10, 34, 34, 35, 43, 52]
        }, {
            type: 'column',
            name: 'Total',
            color: '#FF9933',
            data: [6, 12, 34, 37, 44, 42, 53]
        }, {
            type: 'spline',
            name: 'National Male Average',
            data: [14, 24, 35, 47, 55, 58, 60],
            color: '#000066',
            // marker: {
            //     // lineWidth: 2,
            //     // lineColor: '#000066',
            //     // fillColor: 'white'
            // }
        }, {
            type: 'spline',
            name: 'National Female Average',
            data: [15, 28, 40, 47, 53, 55, 56],
            color: '#66CC33',
            // marker: {
            //     // lineWidth: 2,
            //     // lineColor: '#66CC33',
            //     // fillColor: 'white'
            // }
        }]

    });
    Highcharts.chart('chart_container_2_1', {

        chart: {
            type: 'column',
        },

        title: {
            text: 'The Sheppard Academy: Students  who feel they are bullied at school',
        },

        xAxis: {
            categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13'],
            offset: 30
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Percentage'
            },
        },

        tooltip: {
            // formatter: function() {
            //     return '<b>' + this.x + '</b><br/>' +
            //         this.series.name + ': ' + this.y + '<br/>';
            // }
        },

        plotOptions: {

        },
        series: [{
            type: 'column',
            name: 'Male',
            data: [32, 28, 29, 33, 41, 29, 33]
        }, {
            type: 'column',
            name: 'Female',
            data: [23, 35, 28, 53, 44, 24, 17]
        }, {
            type: 'column',
            name: 'Total',
            data: [29, 31, 28, 43, 47, 26, 27]
        }, {
            type: 'spline',
            name: 'National Male Average',
            data: [32, 32, 27, 26, 24, 24, 22],
            // marker: {
            //     lineWidth: 2,
            //     lineColor: Highcharts.getOptions().colors[4],
            //     fillColor: 'white'
            // }
        }, {
            type: 'spline',
            name: 'National Female Average',
            data: [36, 40, 37, 32, 27, 26, 25],
            // marker: {
            //     lineWidth: 2,
            //     lineColor: Highcharts.getOptions().colors[3],
            //     fillColor: 'white'
            // }
        }]

    });
    Highcharts.chart('chart_container_3_1', {

        chart: {
            type: 'column',
        },

        title: {
            text: 'The Sheppard Academy: Students  who feel they are bullied at school',
        },

        xAxis: {
            categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13'],
            offset: 30
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Percentage'
            },
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>';
            }
        },

        plotOptions: {

        },
        series: [{
            type: 'column',
            name: 'Male',
            data: [85, 61, 67, 62, 56, 58, 45]
        }, {
            type: 'column',
            name: 'Female',
            data: [86, 74, 64, 53, 42, 48, 51]
        }, {
            type: 'column',
            name: 'Total',
            data: [86, 66, 65, 57, 48, 53, 48]
        }, {
            type: 'spline',
            name: 'National Male Average',
            data: [78, 71, 66, 58, 55, 54, 51],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[4],
                fillColor: 'white'
            }
        }, {
            type: 'spline',
            name: 'National Female Average',
            data: [79, 67, 56, 47, 43, 40, 39],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }]

    });

    Highcharts.chart('chart_container_1_2', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Sleep trends over time'
        },
        // subtitle: {
        //     text: 'Source: ' +
        //         '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
        //         'target="_blank">Wikipedia.com</a>'
        // },
        xAxis: {
            categories: ['2017', '2019', '2021']
        },
        yAxis: {
            title: {
                text: 'Percentage (%)'
            },
        },
        // plotOptions: {
        //     line: {
        //         dataLabels: {
        //             enabled: true
        //         },
        //         // enableMouseTracking: false
        //     }
        // },
        series: [{
            type: '',
            name: 'Male',
            data: [29, 29, 30],
            color: '#000066',
        }, {
            name: 'Female',
            color: '#66CC33',
            data: [30, 26, 25]
        }, {
            name: 'Total',
            color: '#FF9933',
            data: [29, 28, 27]
        }]
    });

    Highcharts.chart('chart_container_2_2', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Bullying trends over time'
        },
        // subtitle: {
        //     text: 'Source: ' +
        //         '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
        //         'target="_blank">Wikipedia.com</a>'
        // },
        xAxis: {
            categories: ['2017', '2019', '2021']
        },
        yAxis: {
            title: {
                text: 'Percentage (%)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                // enableMouseTracking: false
            }
        },
        series: [{
            name: 'Male',
            data: [32, 32, 30]
        }, {
            name: 'Female',
            data: [35, 34, 31]
        }, {
            name: 'Total',
            data: [34, 35, 31]
        }]
    });

    Highcharts.chart('chart_container_3_2', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Mental Health trends over time'
        },
        // subtitle: {
        //     text: 'Source: ' +
        //         '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
        //         'target="_blank">Wikipedia.com</a>'
        // },
        xAxis: {
            categories: ['2017', '2019', '2021']
        },
        yAxis: {
            title: {
                text: 'Percentage (%)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                // enableMouseTracking: false
            }
        },
        series: [{
            name: 'Male',
            data: [65, 64, 60]
        }, {
            name: 'Female',
            data: [61, 61, 60]
        }, {
            name: 'Total',
            data: [63, 62, 60]
        }]
    });


    Highcharts.chart('chart_container_1_3_1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Comparing Sleep Habits',
            align: 'left',
        },
        // subtitle: {
        //     text: 'Source: <a ' +
        //         'href="https://en.wikipedia.org/wiki/List_of_continents_and_continental_subregions_by_population"' +
        //         'target="_blank">Wikipedia.org</a>',
        //     align: 'left'
        // },
        xAxis: {
            categories: ['Has not been bullied at school', 'Has been bullied at school'],
            // title: {
            //     text: null
            // },
            // gridLineWidth: 1,
            // lineWidth: 0
        },
        yAxis: {
            // min: 0,
            // title: {
            //     text: '',
            //     // align: 'high'
            // },
            labels: {
                overflow: 'justify'
            },
            // gridLineWidth: 0
        },
        tooltip: {
            // valueSuffix:
        },
        plotOptions: {
            bar: {
                // borderRadius: '50%',
                dataLabels: {
                    enabled: true
                },
                groupPadding: 0.1
            }
        },
        legend: {
            // layout: 'vertical',
            // align: 'right',
            // verticalAlign: 'top',
            // x: -40,
            // y: 80,
            // floating: true,
            // borderWidth: 1,
            // backgroundColor:
            //     Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            // shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: "% who usually go to bed at 11:30 or later when they have school the next day",
            data: [34, 40]
        }]

        //     name: 'Year 1990',
        //     data: [631, 727, 3202, 721, 26]
        // }, {
        //     name: 'Year 2000',
        //     data: [814, 841, 3714, 726, 31]
        // }, {
        //     name: 'Year 2010',
        //     data: [1044, 944, 4170, 735, 40]
        // }, {
        //     name: 'Year 2018',
        //     data: [1276, 1007, 4561, 746, 42]
        // }]
    });

    Highcharts.chart('chart_container_1_3_2', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Comparing Sleep Habits',
            // align: 'left',
        },
        // subtitle: {
        //     text: 'Source: <a ' +
        //         'href="https://en.wikipedia.org/wiki/List_of_continents_and_continental_subregions_by_population"' +
        //         'target="_blank">Wikipedia.org</a>',
        //     align: 'left'
        // },
        xAxis: {
            categories: ["% who 'agree' or 'strongly agree' that there is support at school for students who feel unhappy, worried or unable to cope"],
            // title: {
            //     text: 'sth here',
            // },
            // gridLineWidth: 1,
            // lineWidth: 0
        },
        yAxis: {
            // min: 0,
            title: {
                text: 'Percentage',
                // align: 'high'
            },
            labels: {
                overflow: 'justify'
            },
            max: 100
            // gridLineWidth: 0
        },
        tooltip: {
            // valueSuffix:
        },
        plotOptions: {
            bar: {
                // borderRadius: '50%',
                dataLabels: {
                    enabled: true
                },
                // groupPadding: 0.1
            }
        },
        legend: {
            // layout: 'vertical',
            // align: 'right',
            // verticalAlign: 'top',
            // x: -40,
            // y: 80,
            // floating: true,
            // borderWidth: 1,
            // backgroundColor:
            //     Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            // shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
                name: "Has not been bullied at school",
                data: [55],
                color: '#000066',
                // color: '#000066',
            },
            {
                name: "Has been bullied at school",
                data: [65],
                color: '#66CC33',
                // color: '#000066',
            },
        ]



        //     name: 'Year 1990',
        //     data: [631, 727, 3202, 721, 26]
        // }, {
        //     name: 'Year 2000',
        //     data: [814, 841, 3714, 726, 31]
        // }, {
        //     name: 'Year 2010',
        //     data: [1044, 944, 4170, 735, 40]
        // }, {
        //     name: 'Year 2018',
        //     data: [1276, 1007, 4561, 746, 42]
        // }]
    });


    Highcharts.chart('stacked_grouped_container', {

        chart: {
            type: 'column',
        },

        title: {
            text: 'Figure 3.24 SDQ emotional problems scale score by gender and year group (%)',
        },

        xAxis: {
            categories: ['Male', 'Female', 'Neither word describes me'],
            offset: 30
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Percentage'
            },
            stackLabels: {
                enabled: true,
                // style: {
                //   fontWeight: 'bold'
                // },
                verticalAlign: 'bottom',
                formatter: function() {
                    // console.log(this);
                    return this.stack;
                },
                y: -2,
                // allowOverlap: true,
                crop: false,
                overflow: 'allow',

            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal',
                events: {
                    legendItemClick: function() {
                        var series = this.chart.series;
                        var name = this.name;

                        // Highlight the data points with the same name across all series
                        series.forEach(function(s) {
                            if (s.name === name) {
                                if (s.visible) {
                                    s.hide();
                                } else {
                                    s.show();
                                }
                            }
                        });

                        return false; // Cancel the default legend item click behavior
                    },
                }
            }
        },

        series: [{
                name: 'Very High',
                data: [9, 18, 47],
                stack: 'Yr 7',
                color: Highcharts.getOptions().colors[0]
            }, {
                name: 'Very High',
                data: [10, 26, 42],
                stack: 'Yr 8',
                linkedTo: 0,
                color: Highcharts.getOptions().colors[0]
            }, {
                name: 'Very High',
                data: [11, 30, 47],
                stack: 'Yr 9',
                linkedTo: 0,
                color: Highcharts.getOptions().colors[0]
            }, {
                name: 'Very High',
                data: [12, 38, 41],
                stack: 'Yr 10',
                linkedTo: 0,
                color: Highcharts.getOptions().colors[0]
            }, {
                name: 'Very High',
                data: [13, 39, 49],
                stack: 'Yr 11',
                linkedTo: 0,
                color: Highcharts.getOptions().colors[0]
            },

            {
                name: 'High',
                data: [6, 9, 6],
                stack: 'Yr 7',
                color: Highcharts.getOptions().colors[1]
            }, {
                name: 'High',
                data: [6, 11, 12],
                stack: 'Yr 8',
                linkedTo: 1,
                color: Highcharts.getOptions().colors[1]
            }, {
                name: 'High',
                data: [6, 12, 9],
                stack: 'Yr 9',
                linkedTo: 1,
                color: Highcharts.getOptions().colors[1]
            }, {
                name: 'High',
                data: [7, 12, 9],
                stack: 'Yr 10',
                linkedTo: 1,
                color: Highcharts.getOptions().colors[1]
            }, {
                name: 'High',
                data: [8, 13, 9],
                stack: 'Yr 11',
                linkedTo: 1,
                color: Highcharts.getOptions().colors[1]
            },

            {
                name: 'Slightly raised',
                data: [9, 11, 13],
                stack: 'Yr 7',
                color: Highcharts.getOptions().colors[2]
            },
            {
                name: 'Slightly raised',
                data: [9, 13, 13],
                stack: 'Yr 8',
                linkedTo: 2,
                color: Highcharts.getOptions().colors[2]
            }, {
                name: 'Slightly raised',
                data: [10, 13, 9],
                stack: 'Yr 9',
                linkedTo: 2,
                color: Highcharts.getOptions().colors[2]
            }, {
                name: 'Slightly raised',
                data: [10, 12, 10],
                stack: 'Yr 10',
                linkedTo: 2,
                color: Highcharts.getOptions().colors[2]
            }, {
                name: 'Slightly raised',
                data: [11, 13, 9],
                stack: 'Yr 11',
                linkedTo: 2,
                color: Highcharts.getOptions().colors[2]
            },

            {
                name: 'Close to average',
                data: [76, 63, 34],
                stack: 'Yr 7',
                color: Highcharts.getOptions().colors[3]
            }, {
                name: 'Close to average',
                data: [74, 50, 33],
                stack: 'Yr 8',
                linkedTo: 3,
                color: Highcharts.getOptions().colors[3]
            }, {
                name: 'Close to average',
                data: [73, 45, 35],
                stack: 'Yr 9',
                linkedTo: 3,
                color: Highcharts.getOptions().colors[3]
            }, {
                name: 'Close to average',
                data: [70, 37, 41],
                stack: 'Yr 10',
                linkedTo: 3,
                color: Highcharts.getOptions().colors[3]
            }, {
                name: 'Close to average',
                data: [69, 35, 33],
                stack: 'Yr 11',
                linkedTo: 3,
                color: Highcharts.getOptions().colors[3]
            },

        ]
    });

    /** bar_spline_container from here */

    Highcharts.chart('bar_spline_container', {

        chart: {
            type: 'column',
        },

        title: {
            text: 'Fig. 16 The Sheppard Academy: Students  who usually go to bed at 11.30pm or later when they have school the next day',
        },

        xAxis: {
            categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13', 'School Average'],
            offset: 30
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Percentage'
            },
            // dataLabels: {
            //     enabled: true,
            //     // style: {
            //     //   fontWeight: 'bold'
            //     // },
            //     verticalAlign: 'bottom',
            //     y: -2,
            //     // allowOverlap: true,
            //     // crop: false,
            //     // overflow: 'allow',

            // }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>';
            }
        },

        plotOptions: {

        },

        series: [{
            type: 'column',
            name: 'Male',
            data: [7, 13, 32, 38, 50, 41, 52, 29]
        }, {
            type: 'column',
            name: 'Female',
            data: [4, 10, 34, 34, 35, 43, 52, 26]
        }, {
            type: 'column',
            name: 'Total',
            data: [6, 12, 34, 37, 44, 42, 53, 28]
        }, {
            type: 'spline',
            name: 'National Female Average',
            data: [9, 18, 30, 38, 43, 42, 46, 29],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, {
            type: 'spline',
            name: 'National Male Average',
            data: [11, 17, 29, 40, 49, 52, 56, 32],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[4],
                fillColor: 'white'
            }
        }]
    });

    /** bar_spline_container_2 from here */

    Highcharts.chart('bar_spline_container_2', {

        chart: {
            type: 'column',
        },

        title: {
            text: 'Fig. 1 The Sheppard Academy: Students who usually eat breakfast every weekday',
        },

        xAxis: {
            categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13', 'School Average'],
            offset: 30
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Percentage'
            },
            stackLabels: {
                enabled: true,
                // style: {
                //   fontWeight: 'bold'
                // },
                verticalAlign: 'bottom',
                formatter: function() {
                    return this.stack;
                },
                y: -2,
                // allowOverlap: true,
                crop: false,
                overflow: 'allow',

            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>';
            }
        },

        plotOptions: {

        },

        series: [{
            type: 'column',
            name: 'Male',
            data: [67, 63, 66, 50, 56, 50, 60, 61]
        }, {
            type: 'column',
            name: 'Female',
            data: [64, 55, 43, 43, 53, 50, 52, 50]
        }, {
            type: 'column',
            name: 'Total',
            data: [65, 59, 55, 46, 55, 50, 55, 55]
        }, {
            type: 'spline',
            name: 'National Female Average',
            data: [56, 49, 39, 38, 38, 48, 39, 49],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, {
            type: 'spline',
            name: 'National Male Average',
            data: [64, 59, 58, 55, 52, 55, 50, 59],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[4],
                fillColor: 'white'
            }
        }]
    });

    /** bar_spline_container_3 from here */

    Highcharts.chart('bar_spline_container_3', {

        chart: {
            type: 'column',
        },

        title: {
            text: 'Fig. 12 The Sheppard Academy: Students  who “agree” or “strongly agree” that teachers care about them as a person',
        },

        xAxis: {
            categories: ['Year 7', 'Year 8', 'Year 9', 'Year 10', 'Year 11', 'Year 12', 'Year 13', 'School Average'],
            offset: 30
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Percentage'
            },
            stackLabels: {
                enabled: true,
                // style: {
                //   fontWeight: 'bold'
                // },
                verticalAlign: 'bottom',
                formatter: function() {
                    return this.stack;
                },
                y: -2,
                // allowOverlap: true,
                crop: false,
                overflow: 'allow',

            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>';
            }
        },

        plotOptions: {

        },

        series: [{
                type: 'column',
                name: 'Male',
                data: [45, 46, 42, 51, 38, 59, 38, 45]
            }, {
                type: 'column',
                name: 'Female',
                data: [67, 44, 32, 46, 39, 47, 43, 45]
            }, {
                type: 'column',
                name: 'Total',
                data: [54, 45, 35, 49, 38, 52, 41, 45]
            }, {
                type: 'spline',
                name: 'National Female Average',
                data: [75, 63, 55, 52, 53, 65, 64, null],
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[3],
                    fillColor: 'white'
                }
            },
            {
                type: 'spline',
                name: 'National Female Average',
                data: [null, null, null, null, null, null, null, 57],
                linkedTo: 3,
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[3],
                    fillColor: 'white',
                },
                linkedTo: 3,
            }, {
                type: 'spline',
                name: 'National Male Average',
                data: [75, 60, 52, 50, 51, 62, 63, null],
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[4],
                    fillColor: 'white'
                }
            }, {
                type: 'spline',
                name: 'National Male Average',
                data: [null, null, null, null, null, null, null, 55],
                linkedTo: 4,
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[4],
                    fillColor: 'white'
                },
                linkedTo: 4,
            }
        ]
    });
</script>
<?php wp_footer(); ?>