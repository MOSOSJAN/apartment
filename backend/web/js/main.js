var $ = jQuery.noConflict();
$(document).ready(function($) {

    var SITE_URL= "http://adminka/backend/";
    function deletGallery(id,items){
        $.ajax({
            type: 'POST',
            url: '../deleteimg?id='+id,
            data: {item: items},
            success: function (data) {
                // Create HTML element with loaded data
                $('body').append(data);
            }
        });
    }

    //Logic to delete the item

    $('.img_link').on('click',function(e){

        var result = confirm("Want to delete?");

        if (result) {
            var href = $(this).attr('href');
            var items = $('.albom').attr('id');
            deletGallery(href,items);
            $(this).parent('.gallery_item').css('display','none');

        }
        e.preventDefault();
    });


    var chart = $('#revenue-chart');
    var pieChart = $('#donut-example');


    if(chart[0] != null) {
        $.getJSON(SITE_URL + 'statistics/month')
            .done(function(json) {

                var currentTime = new Date()
                var month = currentTime.getMonth() + 1;
                var year = currentTime.getFullYear();

                var gdata = [];
                var b =0;
                for(var i =0;i<= json.length;i++){
                    b = i+1;
                    gdata[i] = { y:  year+'-'+month+'-'+b, a: json[i]};
                }
                console.log(json[1]);
                new Morris.Line({
                    // ID of the element in which to draw the chart.
                    element: 'revenue-chart',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: gdata,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'y',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['a'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Value']
                });



            })
            .fail(function( jqxhr, textStatus, error ) {
                console.log(error);
            })

    }
    if(pieChart[0] != null) {
        $.getJSON(SITE_URL + 'statistics/browsers')
            .done(function(json) {

                var chrome = json.chrome;
                if(chrome == null) chrome = 0;

                var firefox = json.firefox;
                if(firefox == null) firefox = 0;

                var opera = json.opera;
                if(opera == null) opera = 0;

                var ie = json.ie;
                if(ie == null) ie = 0;

                var safari = json.safari;
                if(safari == null) safari = 0;


                Morris.Donut({
                    element: 'donut-example',
                    resize: true,
                    colors: ["#dd4b39","#00a65a", "#f39c12", "#00c0ef", "#3c8dbc"],
                    data: [
                        {label: "Chrome", value: chrome},
                        {label: "Internet explorer", value: ie},
                        {label: "Firefox", value: firefox},
                        {label: "Safari", value: safari},
                        {label: "Opera", value: opera},
                    ]
                });

            })
            .fail(function( jqxhr, textStatus, error ) {
                console.log(error);
            })
    }

    var barChart = $('#bar-example');
    if(barChart[0] != null) {



        $.getJSON(SITE_URL + 'statistics/platforms')
            .done(function(json) {

                var iPhone = json.iPhone;
                if(iPhone == null) iPhone = 0;

                var iPad = json.iPad;
                if(iPad == null) iPad = 0;

                var Android = json.Android;
                if(Android == null) Android = 0;

                var webOS = json.webOS;
                if(webOS == null) webOS = 0;

                var Windows = json.Windows;
                if(Windows == null) Windows = 0;


                Morris.Bar({
                    element: 'bar-example',
                    // resize: true,
                    barColors: ["#dd4b39", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#3c8dbc"],
                    data: [
                        {y: 2015, a: iPhone, b: Android, c: iPad, d: webOS, e: Windows},
                    ],
                    xkey: 'y',
                    ykeys: ['a', 'b', 'c', 'd', 'e'],
                    labels: ['Iphone', 'Android', 'Ipad', 'Web Os', 'Windows']
                });

            })
            .fail(function( jqxhr, textStatus, error ) {
                console.log(error);
            })


    }


    var worldMap = $('#world-map');
    if(worldMap[0] != null) {



        $.getJSON(SITE_URL + 'statistics/countries')
            .done(function(json) {


                var visitorsData = json;
                //World map by jvectormap
                $('#world-map').vectorMap({
                    map: 'world_mill_en',
                    backgroundColor: "transparent",
                    regionStyle: {
                        initial: {
                            fill: '#e4e4e4',
                            "fill-opacity": 1,
                            stroke: 'none',
                            "stroke-width": 0,
                            "stroke-opacity": 1
                        }
                    },
                    series: {
                        regions: [{
                            values: visitorsData,
                            scale: ["#92c1dc", "#ebf4f9"],
                            normalizeFunction: 'polynomial'
                        }]
                    },
                    onRegionLabelShow: function (e, el, code) {
                        if (typeof visitorsData[code] != "undefined")
                            el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
                    }
                });

            })
            .fail(function( jqxhr, textStatus, error ) {
                console.log(error);
            })


    }

    //$(".fc-day").click(function(){
    //    alert(456);
    //});
    $(document).on('click','.add_new',function(e){


       $.get('event/create',function(data){
            $('#modal').modal('show')
                .find('#modalContent')
                .html(data);
       });

        e.preventDefault();
    });

    $(document).on('click','.fc-day-grid-event',function(e){
        var href = $(this).attr('href');

        console.log(href);

        $.get(href,function(data){
            $('#modalView').modal('show')
                .find('#modalContent1')
                .html(data);
        });

        e.preventDefault();
    });



});