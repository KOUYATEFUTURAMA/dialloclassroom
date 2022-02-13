(function($) {
    'use strict';

    //======================
    // Preloder
    //======================
    $(window).on('load', function() {
        // $('#status').fadeOut();
        $('#preloader').fadeOut();
        // $('body').delay(500).css({'overflow':'visible'});
    });


    //======================
    // Mobile menu 
    //======================
    $('#mobile-menu-toggler').on('click', function(e) {
        e.preventDefault();
        $('nav.navbar > ul').slideToggle();
    })
    $('.has-menu-child').append('<i class="menu-dropdown ti-angle-down"></i>');

    $('.langbtn').on('click', function(e) {
        e.preventDefault();
        $('ul.list-unstyled.dropdown-menu').slideToggle();
    })
    //======================
    // Partners carousel
    //====================== 
    
    function sliderHeight(){              
        var sliderContainer = $('.owl-stage-outer').height();
        var slideHeightLg = sliderContainer + 500;
        var slideHeightSm = sliderContainer + 200;        
        function sliderHeightre(){
            var windowWidght = $(window).width();
            if(windowWidght > 768){
                $('.hero-slider .item').css('height', slideHeightLg)
            }else{
                $('.hero-slider .item').css('height', slideHeightSm)
            }
        }
        $(window).on('resize load', function(){
            sliderHeightre()
        });

    }
   
    sliderHeight();

    $('.hero-slider').owlCarousel({
        autoplay: true,
        dots: false,
        items: 4,
        loop: true,
        margin: 1,
        nav: false,
        smartSpeed: 500,
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 1
            },
            768: {
                items: 1
            }
        }
    });

    //======================
    // Partners carousel
    //======================
    $('.yacht-slider').owlCarousel({
        autoplay: false,
        dots: true,
        items: 5,
        loop: true,
        margin: 1,
        nav: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 1
            },
            768: {
                items: 1
            }
        }
    });

    //======================
    // Partners carousel
    //======================
    $('.partners-caro').owlCarousel({
        autoplay: true,
        dots: false,
        items: 4,
        loop: true,
        margin: 1,
        nav: false,
        smartSpeed: 500,
        responsive: {
            0: {
                items: 2,
                margin: 10
            },
            400: {
                items: 3,
                margin: 20
            },
            768: {
                items: 4,
                margin: 30
            }
        }
    });

    //======================
    // Testimonial
    //======================
    $('.test-caro').owlCarousel({
        autoplay: true,
        dots: true,
        items: 2,
        nav: false,
        margin: 30,
        navText: ['<i class="ti-arrow-left"></i>', '<i class="ti-arrow-right"></i>'],
        smartSpeed: 500,
        responsive: {
            0: {
                items: 1,
                margin: 10
            },
            400: {
                items: 1,
                margin: 20
            },
            768: {
                items: 2,
                margin: 30
            }
        }
    });

    if ($(window).width() <= 991) {
        $('.menu-dropdown').on('click', function() {
            $(this).prev().slideToggle('slow');
            $(this).toggleClass('ti-angle-down ti-angle-up')
        })



    }

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    //======================
    // GOOGLE MAP SCRIPT
    //======================
    function init() {
        var locations = [
            ['Bondi Beach', -33.890542, 151.274856, 4],
            ['Coogee Beach', -33.923036, 151.259052, 5],
            ['Cronulla Beach', -34.028249, 151.157507, 3],
            ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
            ['Maroubra Beach', -33.950198, 151.259302, 1],
            ['Wedding cake island', -31.582010, 152.593790, 6],
            ['Parramatta River', -33.821770, 151.079346, 7]
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(-33.92, 151.25),
            mapTypeId: google.maps.MapTypeId.ROADMAP,


            styles: [{
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#193341"
                }]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#2c5a71"
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#29768a"
                }, {
                    "lightness": -37
                }]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#406d80"
                }]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#406d80"
                }]
            }, {
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "visibility": "on"
                }, {
                    "color": "#3e606f"
                }, {
                    "weight": 2
                }, {
                    "gamma": 0.84
                }]
            }, {
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [{
                    "weight": 0.6
                }, {
                    "color": "#1a3541"
                }]
            }, {
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#2c5a71"
                }]
            }]
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: '../images/marker.png',
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }


    }
    if ($('#map').length > 0) {
        google.maps.event.addDomListener(window, 'load', init);
    }


    //======================
    // RANGE SLIDER
    //======================

    (function($) {
        "use strict";
        var DEBUG = false, // make true to enable debug output
            PLUGIN_IDENTIFIER = "RangeSlider";

        var RangeSlider = function(element, options) {
            this.element = element;
            this.options = options || {};
            this.defaults = {
                output: {
                    prefix: '', // function or string
                    suffix: 'M', // function or string
                    format: function(output) {
                        return output;
                    }
                },
                change: function(event, obj) {}
            };
            // This next line takes advantage of HTML5 data attributes
            // to support customization of the plugin on a per-element
            // basis.
            this.metadata = $(this.element).data('options');
        };

        RangeSlider.prototype = {

            ////////////////////////////////////////////////////
            // Initializers
            ////////////////////////////////////////////////////

            init: function() {
                if (DEBUG && console) console.log('RangeSlider init');
                this.config = $.extend(true, {}, this.defaults, this.options, this.metadata);

                var self = this;
                // Add the markup for the slider track
                this.trackFull = $('<div class="track track--full"></div>').appendTo(self.element);
                this.trackIncluded = $('<div class="track track--included"></div>').appendTo(self.element);
                this.inputs = [];

                $('input[type="range"]', this.element).each(function(index, value) {
                    var rangeInput = this;
                    // Add the ouput markup to the page.
                    rangeInput.output = $('<output>').appendTo(self.element);
                    // Get the current z-index of the output for later use
                    rangeInput.output.zindex = parseInt($(rangeInput.output).css('z-index')) || 1;
                    // Add the thumb markup to the page.
                    rangeInput.thumb = $('<div class="slider-thumb">').prependTo(self.element);
                    // Store the initial val, incase we need to reset.
                    rangeInput.initialValue = $(this).val();
                    // Method to update the slider output text/position
                    rangeInput.update = function() {
                        if (DEBUG && console) console.log('RangeSlider rangeInput.update');
                        var range = $(this).attr('max') - $(this).attr('min'),
                            offset = $(this).val() - $(this).attr('min'),
                            pos = offset / range * 100 + '%',
                            transPos = offset / range * -100 + '%',
                            prefix = typeof self.config.output.prefix == 'function' ? self.config.output.prefix.call(self, rangeInput) : self.config.output.prefix,
                            format = self.config.output.format($(rangeInput).val()),
                            suffix = typeof self.config.output.suffix == 'function' ? self.config.output.suffix.call(self, rangeInput) : self.config.output.suffix;

                        // Update the HTML
                        $(rangeInput.output).html(prefix + '' + format + '' + suffix);
                        $(rangeInput.output).css('left', pos);
                        $(rangeInput.output).css('transform', 'translate(' + transPos + ',0)');

                        // Update the IE hack thumbs
                        $(rangeInput.thumb).css('left', pos);
                        $(rangeInput.thumb).css('transform', 'translate(' + transPos + ',0)');

                        // Adjust the track for the inputs
                        self.adjustTrack();
                    };

                    // Send the current ouput to the front for better stacking
                    rangeInput.sendOutputToFront = function() {
                        $(this.output).css('z-index', rangeInput.output.zindex + 1);
                    };

                    // Send the current ouput to the back behind the other
                    rangeInput.sendOutputToBack = function() {
                        $(this.output).css('z-index', rangeInput.output.zindex);
                    };

                    ///////////////////////////////////////////////////
                    // IE hack because pointer-events:none doesn't pass the 
                    // event to the slider thumb, so we have to make our own.
                    ///////////////////////////////////////////////////
                    $(rangeInput.thumb).on('mousedown', function(event) {
                        // Send all output to the back
                        self.sendAllOutputToBack();
                        // Send this output to the front
                        rangeInput.sendOutputToFront();
                        // Turn mouse tracking on
                        $(this).data('tracking', true);
                        $(document).one('mouseup', function() {
                            // Turn mouse tracking off
                            $(rangeInput.thumb).data('tracking', false);
                            // Trigger the change event
                            self.change(event);
                        });
                    });

                    // IE hack - track the mouse move within the input range
                    $('body').on('mousemove', function(event) {
                        // If we're tracking the mouse move
                        if ($(rangeInput.thumb).data('tracking')) {
                            var rangeOffset = $(rangeInput).offset(),
                                relX = event.pageX - rangeOffset.left,
                                rangeWidth = $(rangeInput).width();
                            // If the mouse move is within the input area
                            // update the slider with the correct value
                            if (relX <= rangeWidth) {
                                var val = relX / rangeWidth;
                                $(rangeInput).val(val * $(rangeInput).attr('max'));
                                rangeInput.update();
                            }
                        }
                    });

                    // Update the output text on slider change
                    $(this).on('mousedown input change touchstart', function(event) {
                        if (DEBUG && console) console.log('RangeSlider rangeInput, mousedown input touchstart');
                        // Send all output to the back
                        self.sendAllOutputToBack();
                        // Send this output to the front
                        rangeInput.sendOutputToFront();
                        // Update the output
                        rangeInput.update();
                    });

                    // Fire the onchange event 
                    $(this).on('mouseup touchend', function(event) {
                        if (DEBUG && console) console.log('RangeSlider rangeInput, change');
                        self.change(event);
                    });

                    // Add this input to the inputs array for use later
                    self.inputs.push(this);
                });

                // Reset to set to initial values
                this.reset();

                // Return the instance
                return this;
            },

            sendAllOutputToBack: function() {
                $.map(this.inputs, function(input, index) {
                    input.sendOutputToBack();
                });
            },

            change: function(event) {
                if (DEBUG && console) console.log('RangeSlider change', event);
                // Get the values of each input
                var values = $.map(this.inputs, function(input, index) {
                    return {
                        value: parseInt($(input).val()),
                        min: parseInt($(input).attr('min')),
                        max: parseInt($(input).attr('max'))
                    };
                });

                // Sort the array by value, if we have 2 or more sliders
                values.sort(function(a, b) {
                    return a.value - b.value;
                });

                // call the on change function in the context of the rangeslider and pass the values
                this.config.change.call(this, event, values);
            },

            reset: function() {
                if (DEBUG && console) console.log('RangeSlider reset');
                $.map(this.inputs, function(input, index) {
                    $(input).val(input.initialValue);
                    input.update();
                });
            },

            adjustTrack: function() {
                if (DEBUG && console) console.log('RangeSlider adjustTrack');
                var valueMin = Infinity,
                    rangeMin = Infinity,
                    valueMax = 0,
                    rangeMax = 0;

                // Loop through all input to get min and max
                $.map(this.inputs, function(input, index) {
                    var val = parseInt($(input).val()),
                        min = parseInt($(input).attr('min')),
                        max = parseInt($(input).attr('max'));

                    // Get the min and max values of the inputs
                    valueMin = (val < valueMin) ? val : valueMin;
                    valueMax = (val > valueMax) ? val : valueMax;
                    // Get the min and max possible values
                    rangeMin = (min < rangeMin) ? min : rangeMin;
                    rangeMax = (max > rangeMax) ? max : rangeMax;
                });

                // Get the difference if there are 2 range input, use max for one input.
                // Sets left to 0 for one input and adjust for 2 inputs
                if (this.inputs.length > 1) {
                    this.trackIncluded.css('width', (valueMax - valueMin) / (rangeMax - rangeMin) * 100 + '%');
                    this.trackIncluded.css('left', (valueMin - rangeMin) / (rangeMax - rangeMin) * 100 + '%');
                } else {
                    this.trackIncluded.css('width', valueMax / (rangeMax - rangeMin) * 100 + '%');
                    this.trackIncluded.css('left', '0%');
                }
            }
        };

        RangeSlider.defaults = RangeSlider.prototype.defaults;

        $.fn.RangeSlider = function(options) {
            if (DEBUG && console) console.log('$.fn.RangeSlider', options);
            return this.each(function() {
                var instance = $(this).data(PLUGIN_IDENTIFIER);
                if (!instance) {
                    instance = new RangeSlider(this, options).init();
                    $(this).data(PLUGIN_IDENTIFIER, instance);
                }
            });
        };

    })(jQuery);


    var rangeSlider = $('#length, #price');
    if (rangeSlider.length > 0) {
        rangeSlider.RangeSlider({
            output: {
                format: function(output) {
                    return output.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                },
                suffix: function(input) {
                    return parseInt($(input).val()) == parseInt($(input).attr('max')) ? this.config.maxSymbol : '';
                }
            }
        });
    }


    var bsbtn = $('.bstn');
    var aSearch = $('.a-search');
    $(bsbtn).on('click', function(e) {
        $(bsbtn).removeClass('active');
        $(this).addClass('active')
        e.preventDefault();
    });
    $(aSearch).on('click', function(e) {
        $('.advance-search-area').slideToggle()
        e.preventDefault();
    });




    /*
     *
     * COMPARE
     *
     * */
    var tiems = $('.p-body li');
    var itembox = $('.p-body');
    $(tiems).on('mouseenter', function() {
        var index = $(this).index();
        $('.p-body li').css('background', 'transparent')
        var i;
        for (i = 0; i < itembox.length; i++) {
            $('.p-body').eq(i).find('li').eq(index).css('background', '#f3f3f3')
        }
    })
    $(tiems).on('mouseout', function() {
        $('.p-body li').css('background', 'transparent')
    })
    /*
     *
     * TITLE BAR ANIMATION
     *
     * */
    if ($('.page-feature').length > 0) {
        setTimeout(function() {
            var x = 0;
            var y = 0;
            var banner = jQuery(".page-feature");
            banner.css('backgroundPosition', x + 'px');
            window.setInterval(function() {
                banner.css("backgroundPosition", x + 'px');
                x--;
                // y++;
            }, 70);

        }, 1000);
    }

    /*
     *
     * SWITCHER CONFIG
     *
     * */
    var imported = document.createElement('script');
    var styleE = document.createElement('link');
    imported.src = 'inc/switcher/js/switcher.js';
    styleE.href = 'inc/switcher/css/switcher.css';
    styleE.rel = 'stylesheet';
    document.head.appendChild(imported);
    document.head.appendChild(styleE);


})(jQuery)