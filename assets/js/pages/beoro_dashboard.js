/* [ ---- Beoro Admin - dashboard ---- ] */

    $(document).ready(function() {
        //* todo list
        beoro_todoList.init();
        //* pageviews chart
        beoro_charts.pages();
        //* sales chart
        beoro_charts.sales();
        //* users chart
        beoro_charts.users();
        //* small gallery grid
        beoro_gal_grid.small();
        //* responsive carousel
        beoro_rcarousel.init();
        //* chat
        beoro_chat.init();
        //* calendar
        beoro_calendar.widget();
    });

    //* responsive carousel
    beoro_rcarousel = {
        init: function() {
            if($('.slidewrap').length) {
                $('.slidewrap').rcarousel({
                    addPagination: true,
                    addNav : false,
                    rotate : true,
                    speed: 600,
                    autoHeight: true
                }).on({
                    'rcarousel-beforemove' : function() {
                        
                    },
                    'rcarousel-aftermove' : function(ui) {
                        console.log($(ui.target).find('.rcarousel-active-slide').height());
                        $('.slidewrap .slider').height($(ui.target).filter('.rcarousel-active-slide').height());
                    }
                });
            }
        }
    };

    //* todo list
    beoro_todoList = {
        init: function() {
            if($('.todo-list').length) {
                beoro_todoList.checkCompleted();
                beoro_todoList.completeTask();
                beoro_todoList.dragTasks();
                beoro_todoList.countTasks();
                beoro_todoList.countAll();
            }
        },
        checkCompleted: function() {
            $('.todo-list li').each(function() {
                $(this).find('.todo-check').attr('checked',false);
                if($(this).hasClass('completed')) {
                    $(this).find('.todo-check').attr('checked',true);
                }
            });
        },
        completeTask: function() {
            $('.todo-list').off('click','input.todo-check').on('click','input.todo-check',function(e){
                if( $(this).is(':checked') ) {
                    $(this).closest('li').addClass('completed');
                } else {
                    $(this).closest('li').removeClass('completed');
                }
                beoro_todoList.countTasks();
                beoro_todoList.countAll();
            });
        },
        countTasks: function() {
            $('.todo-list ul').each(function(){
                $(this).closest('ul').prev('h4').children('.todo-nb').html($(this).closest('ul').children('li').not('.completed').length)
            });
        },
        countAll: function() {
            var todoItems = $('.todo-list ul li').length;
            $('.jQ-todoAll-count').text(todoItems);
        },
        dragTasks: function() {
            $(".todo-list ul").sortable({
                connectWith: ".connectedSortable",
                stop: function(event, ui) {
                    beoro_todoList.countTasks();
                }
            }).disableSelection();
        }
    };

    //* chat
    beoro_chat = {
        init: function() {
            //send on button press
            $('.ch-message-send').click(function(e) {
                e.preventDefault();
                beoro_chat.sendMsg();
            });
            // send on enter key press
            $('.ch-message-input').keypress(function (e) {
                if (e.which == 13) {
                    e.preventDefault();
                    beoro_chat.sendMsg();
                }
            });
        },
        sendMsg: function() {
            var messageInput = $('.ch-message-input');
            var messageVal = messageInput.val();
            var messageVal = messageVal.replace(/^\s+/, '').replace(/\s+$/, '');
            if( messageVal != '' ) {
                var msg_cloned = $('#ch-message-temp').clone();
                $('.ch-messages').append(msg_cloned).find('#ch-message-temp').addClass('ch-messages-added');
                $('.ch-messages-added').find('.ch-text').text(messageVal);
                $('.ch-messages-added').find('.ch-time').text(moment().format('HH:mm'));
                messageInput.val('');
                $('.ch-messages-added').attr('id','').removeClass('ch-messages-added').show();
                $('.ch-messages').stop().animate({
                    scrollTop: msg_cloned.offset().top
                }, 600);
                $('.ch-message-input').closest('.control-group').removeClass('error');
            } else {
                $('.ch-message-input').closest('.control-group').addClass('error');
            }
        }
    }

    //* charts
    beoro_charts = {
        pages: function() {
            if($('#ch_pages').length) {

                var elem = $('#ch_pages');

                var d1 = [
                    [new Date('10/10/2012').getTime(),2200],
                    [new Date('10/11/2012').getTime(),2400],
                    [new Date('10/12/2012').getTime(),1500],
                    [new Date('10/13/2012').getTime(),1100],
                    [new Date('10/14/2012').getTime(),1340],
                    [new Date('10/15/2012').getTime(),1000],
                    [new Date('10/16/2012').getTime(),2510],
                    [new Date('10/17/2012').getTime(),3510],
                    [new Date('10/18/2012').getTime(),2000],
                    [new Date('10/19/2012').getTime(),1800],
                    [new Date('10/21/2012').getTime(),1200],
                    [new Date('10/22/2012').getTime(),2400],
                    [new Date('10/23/2012').getTime(),2800],
                    [new Date('10/24/2012').getTime(),3200]
                ];

                // add 2h to match utc+2
                for (var i = 0; i < d1.length; ++i) {d1[i][0] += 60 * 120 * 1000};

                var ds = new Array();

                ds.push({
                    label: "Data 1", data:d1
                });

                var options = {
                    grid: {
                        hoverable: true,
                        borderWidth: 0,
                        color: "#666",
                        labelMargin: 10,
                        axisMargin: 0,
                        mouseActiveRadius: 10,
                        
                    },
                    series: {
                        lines: { show: true, lineWidth: 2, fill: true },
                        points: {
                            show: true,
                            radius: 3,
                            symbol: "circle",
                            fill: true
                        }
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: "%s - %y",
                        shifts: {
                            x: 20,
                            y: 0
                        },
                        defaultTheme: false
                    },
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d/%m",
                        labelWidth: "40"
                    },
                    yaxis: { min: 0 },
                    legend: {
                        noColumns: 0,
                        position: "ne"
                    },
                    colors: ["#ffad33","#bd3501"]
                };

                $.plot(elem, ds, options);

            }
        },
        sales : function() {
            if($('#ch_sales').length) {
                var elem = $('#ch_sales');

                var d1 = [
                    [new Date('09/23/2012').getTime(),350],
                    [new Date('09/24/2012').getTime(),422],
                    [new Date('09/25/2012').getTime(),550],
                    [new Date('09/26/2012').getTime(),608],
                    [new Date('09/27/2012').getTime(),681],
                    [new Date('09/28/2012').getTime(),591],
                    [new Date('09/29/2012').getTime(),510]
                ];

                var d2 = [
                    [new Date('09/23/2012').getTime(),1200],
                    [new Date('09/24/2012').getTime(),1400],
                    [new Date('09/25/2012').getTime(),1500],
                    [new Date('09/26/2012').getTime(),1200],
                    [new Date('09/27/2012').getTime(),1340],
                    [new Date('09/28/2012').getTime(),1421],
                    [new Date('09/29/2012').getTime(),1510]
                ];

                var d3 = [
                    [new Date('09/23/2012').getTime(),120],
                    [new Date('09/24/2012').getTime(),100],
                    [new Date('09/25/2012').getTime(),180],
                    [new Date('09/26/2012').getTime(),140],
                    [new Date('09/27/2012').getTime(),153],
                    [new Date('09/28/2012').getTime(),184],
                    [new Date('09/29/2012').getTime(),226]
                ];

                // add 2h to match utc+2
                for (var i = 0; i < d1.length; ++i) {d1[i][0] += 60 * 120 * 1000};
                for (var i = 0; i < d2.length; ++i) {d2[i][0] += 60 * 120 * 1000};
                for (var i = 0; i < d3.length; ++i) {d3[i][0] += 60 * 120 * 1000};

                var ds = new Array();

                ds.push({
                    label: "Data 1",
                    data:d1,
                    bars: {
                        show: true, 
                        barWidth: 60 * 220 * 1000, 
                        order: 1,
                        lineWidth : 2,
                        fill: 1
                    }
                });
                ds.push({
                    label: "Data 2",
                    data:d2,
                    bars: {
                        show: true, 
                        barWidth: 60 * 220 * 1000, 
                        order: 2,
                        fill: 1
                    }
                });
                ds.push({
                    label: "Data 3",
                    data:d3,
                    bars: {
                        show: true, 
                        barWidth: 60 * 220 * 1000, 
                        order: 3,
                        fill: 1
                    }
                });
                
                var options = {
                    grid: {
                        hoverable: true,
                        borderWidth: 0,
                        color: "#666",
                        labelMargin: 10,
                        axisMargin: 0,
                        mouseActiveRadius: 10
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: "%s - %y",
                        shifts: {
                            x: 20,
                            y: 0
                        },
                        defaultTheme: false
                    },
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d/%m"
                    },
                    legend: {
                        noColumns: 0,
                        position: "ne"
                    },
                    colors: ["#0094bb","#86ae00","#f2b705","#ffad33","#bd3501"]
                };
                
                $.plot(elem, ds, options);
            }
        },
        users : function() {
            if($('#ch_users').length) {
                var elem = $('#ch_users');

                var d1 = [
                    [new Date('11/08/2012').getTime(),1200],
                    [new Date('11/09/2012').getTime(),1400],
                    [new Date('11/10/2012').getTime(),1500],
                    [new Date('11/11/2012').getTime(),1285],
                    [new Date('11/12/2012').getTime(),1340],
                    [new Date('11/13/2012').getTime(),1421],
                    [new Date('11/14/2012').getTime(),1212],
                    [new Date('11/15/2012').getTime(),1408],
                    [new Date('11/16/2012').getTime(),1567],
                    [new Date('11/17/2012').getTime(),1238],
                    [new Date('11/18/2012').getTime(),1340],
                    [new Date('11/19/2012').getTime(),1401],
                    [new Date('11/20/2012').getTime(),1491],
                    [new Date('11/21/2012').getTime(),1510]
                ];

                var d2 = [
                    [new Date('11/08/2012').getTime(),350],
                    [new Date('11/09/2012').getTime(),422],
                    [new Date('11/10/2012').getTime(),550],
                    [new Date('11/11/2012').getTime(),608],
                    [new Date('11/12/2012').getTime(),946],
                    [new Date('11/13/2012').getTime(),489],
                    [new Date('11/14/2012').getTime(),284],
                    [new Date('11/15/2012').getTime(),354],
                    [new Date('11/16/2012').getTime(),497],
                    [new Date('11/17/2012').getTime(),603],
                    [new Date('11/18/2012').getTime(),650],
                    [new Date('11/19/2012').getTime(),570],
                    [new Date('11/20/2012').getTime(),520],
                    [new Date('11/21/2012').getTime(),380]
                ];

                // add 2h to match utc+2
                for (var i = 0; i < d1.length; ++i) {d1[i][0] += 60 * 120 * 1000};
                for (var i = 0; i < d2.length; ++i) {d2[i][0] += 60 * 120 * 1000};

                var ds = new Array();

                ds.push({
                    label: "Data 1", data:d1
                });
                ds.push({
                    label: "Data 2", data:d2
                });

                var options = {
                    grid: {
                        hoverable: true,
                        borderWidth: 0,
                        color: "#666",
                        labelMargin: 10,
                        axisMargin: 0,
                        mouseActiveRadius: 10
                    },
                    series: {
                        lines: { show: true,lineWidth: 2 },
                        points: {
                            show: true,
                            radius: 3,
                            symbol: "circle",
                            fill: true
                        }
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: "%s - %y",
                        shifts: {
                            x: 20,
                            y: 0
                        },
                        defaultTheme: false
                    },
                    xaxis: {
                        mode: "time",
                        minTickSize: [1, "day"],
                        timeformat: "%d/%m",
                        labelWidth: "40"
                    },
                    yaxis: { min: 0 },
                    legend: {
                        noColumns: 0,
                        position: "ne"
                    },
                    colors: ["#0094bb","#86ae00","#f2b705","#ffad33"]
                };

                $.plot(elem, ds, options);
            }
        }
    };

    //* gallery grid
    beoro_gal_grid = {
        small: function() {
            if($('#small_grid').length) {
                //* small gallery grid
                $('#small_grid ul').imagesLoaded(function() {
                    
                    var filter = '',
                        handler;
                    
                    // Prepare layout options.
                    var options = {
                        autoResize: true, // This will auto-update the layout when the browser window is resized.
                        container: $('#small_grid'), // Optional, used for some extra CSS styling
                        offset: 4, // Optional, the distance between grid items
                        flexibleItemWidth: false
                    };

                    // This function filters the grid when a change is made.
                    var refresh = function() {
                        // Clear our previous handler.
                        if(handler) {
                          handler.wookmarkClear();
                          handler = null;
                        }
                        
                        // This hides all grid items ("inactive" is a CSS class that sets opacity to 0).
                        $('#small_grid ul li').addClass('inactive');
                        
                        // Create a new layout selector with our filter.
                        handler = $(filter);
                        
                        // This shows the items we want visible.
                        handler.removeClass("inactive");
                        
                        // This updates the layout.
                        handler.wookmark(options);
                    }

                    /**
                     * This function checks all filter options to see which ones are active.
                     * If they have changed, it also calls a refresh (see above).
                     */
                    var updateFilters = function() {
                        var oldFilter = filter;
                        filter = '';
                        var filters = [];
                        
                        // Collect filter list.
                        var lis = $('#small-filters li');
                        var i=0, length=lis.length, li;
                        for(; i<length; i++) {
                          li = $(lis[i]);
                          if(li.hasClass('active')) {
                            filters.push('#small_grid ul li.'+li.attr('data-filter'));
                          }
                        }

                        // If no filters active, set default to show all.
                        if(filters.length == 0) {
                          filters.push('#small_grid ul li');
                        }
                        
                        // Finalize our filter selector for jQuery.
                        filter = filters.join(', ');
                        
                        // If the filter has changed, update the layout.
                        if(oldFilter != filter) {
                          refresh();
                        }
                    };

                    /**
                     * When a filter is clicked, toggle it's active state and refresh.
                     */
                    var onClickFilter = function(event) {
                        var item = $(event.currentTarget);
                        $('#small-filters li').removeClass('active');
                        item.toggleClass('active');
                        updateFilters();
                    }

                    // Capture filter click events.
                    $('#small-filters li').click(onClickFilter);
                    
                    // Do initial update (shows all items).
                    updateFilters();

                    $('#small_grid ul li > a').attr('rel', 'gallery').colorbox({
                        maxWidth        : '80%',
                        maxHeight       : '80%',
                        initialWidth    : '100',
                        initialHeight   : '100',
                        opacity         : '0.4', 
                        loop            : false,
                        fixed           : true,
                        scrolling       : false
                    });
                    
                    $('#small_grid ul li > a').append('<span class="zoomOverlay" />');
                    
                });
            }
        }
    };

    //* calendar
    beoro_calendar = {
        widget: function () {
            if( $('#calendar_widget').length ) {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                $('#calendar_widget').fullCalendar({
                    header: {
                        left: 'month,agendaWeek,agendaDay',
                        center: 'title',
                        right: 'prev,next'
                    },
                    buttonText: {
                        prev: '<i class="icon-chevron-left icon-white cal_prev" />',
                        next: '<i class="icon-chevron-right icon-white cal_next" />'
                    },
                    editable: true,
                    firstDay: 1, // 0 - Sunday, 1 - Monday
                    events: [
                        {
                            title: 'All Day Event',
                            start: new Date(y, m, 1),
                        },
                        {
                            title: 'Long Event',
                            start: new Date(y, m, d-5),
                            end: new Date(y, m, d-2),
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: new Date(y, m, d-3, 16, 0),
                            allDay: false,
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: new Date(y, m, d+4, 16, 0),
                            allDay: false,
                        },
                        {
                            title: 'Lunch',
                            start: new Date(y, m, d, 12, 0),
                            end: new Date(y, m, d, 14, 0),
                            allDay: false,
                        },
                        {
                            title: 'Birthday Party',
                            start: new Date(y, m, d+1, 19, 0),
                            end: new Date(y, m, d+1, 22, 30),
                            allDay: false
                        },
                        {
                            title: 'Click for Google',
                            start: new Date(y, m, 11),
                            end: new Date(y, m, 13),
                            url: 'http://google.com/'
                        }
                    ]
                });
            }
        }
    };