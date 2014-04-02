'use strict';

app.controller('HomeCtrl', function ($scope, $rootScope, facebook, $interval, weerData, activiteiten) {
    $scope.weer = {};
    $rootScope.kaartLoaded = 0;
    $scope.weerIterator = [
        { niks:'0'},
        { niks:'1'},
        { niks:'2'}
    ]
    
    weerData.success(function(data) {
        $scope.getWeather(data);
        
    });

    $scope.interval = null;
    $('.prev').hide()
    $scope.interval = $interval(function() {
        $scope.nextSlide();
    }, 4000);

    $scope.getWeather = function getWeather(weather) {
        $scope.weer.vandaag = weather.list[0];
        $scope.weer.vandaag.dag = 'Vandaag';

        $scope.weer.morgen = weather.list[1];
        $scope.weer.morgen.dag = 'Morgen';

        $scope.weer.overmorgen = weather.list[2];
        $scope.weer.overmorgen.dag = 'Overmorgen';
    };

    $scope.direction = 'left';
    $scope.currentIndex = 0;
    
    $scope.directionDag = 'right'
    $scope.currentDagIndex = 0;


    $scope.setCurrentSlideIndex = function (index) {
        $scope.direction = (index > $scope.currentIndex) ? 'left' : 'right';
        $scope.currentIndex = index;
    };

    $scope.isCurrentSlideIndex = function (index) {
        return $scope.currentIndex === index;
    };

    $scope.nextSlide = function () {
        $scope.direction = 'left';
        $scope.currentIndex = ($scope.currentIndex < $scope.activiteiten.length - 1) ? ++$scope.currentIndex : 0;
    };

    $scope.prevSlide = function () {
        $scope.direction = 'right';
        $scope.currentIndex = ($scope.currentIndex > 0) ? --$scope.currentIndex : $scope.activiteiten.length - 1;
    };



    $scope.setCurrentDagIndex = function (index) {
        
        $scope.directionDag = (index > $scope.currentDagIndex) ? 'left' : 'right';
        $scope.currentDagIndex = index;
    };

    $scope.isCurrentDagIndex = function (index) {
        return $scope.currentDagIndex === index;
    };

    $scope.nextDag = function () {
        
        $scope.currentDagIndex = ($scope.currentDagIndex < $scope.weerIterator.length - 1) ? ++$scope.currentDagIndex : 0;
        if ($scope.currentDagIndex > 0) {
            $('.prev').show()
        } else {
            $scope.directionDag = 'left';
        }

        if ($scope.currentDagIndex == 2) {
            $('.next').hide()
        }
        
    };

    $scope.prevDag = function () {
        $scope.currentDagIndex = ($scope.currentDagIndex > 0) ? --$scope.currentDagIndex : $scope.weerIterator.length - 1;
        if ($scope.currentDagIndex < 2) {
            $('.next').show();
        } else {
            $scope.directionDag = 'left';
        }

        if($scope.currentDagIndex == 0) {

            $('.prev').hide();
        }

    };

    $scope.pauseAnimation = function () {
        // $interval.cancel($scope.interval);
    };

    // $scope.startAnimation = function ($interval) {
    //     $scope.interval = $interval(function() {
    //         $scope.nextSlide();
    //     }, 4000);
    // };

    $scope.activiteit = {
        naam: ''
    };

    $scope.singleHandler = {
        showSingle: function(id) {
            $rootScope.$apply($rootScope.singleHidden = false);
            this.getActivity(id);
        },
        getActivity: function(id) {
            $scope.$apply($scope.activiteit = this.filter(id));
        },
        filter: function(id) {
            var activiteit = {};
            $scope.activiteiten.forEach(function(item) {
                if (item.aID == id) {
                    activiteit = {
                        aID: item.aID,
                        naam: item.naam,
                        categorie: item.categorie,
                        organisatie: item.organisatie,
                        images: {
                            big: item.big_image1
                        },
                        long_desc: item.long_desc
                    };
                }
            });
            return activiteit;
        },
        closeSingle: function(evt) {
            if(evt.target.id == "single" || evt.target.className == "close" || evt.target.id == "openKaart") {
                $rootScope.singleHidden = true;
            }
        }
    };

    /////////////////////////////////// ANIMATIONS ///////////////////////////////////
    ///////                                                                    ///////
    //////////////////////////////////////////////////////////////////////////////////

    // var fbContainer = $('#fbContainer');

    // TweenMax.set(fbContainer, {opacity: 0});
    // TweenMax.to(fbContainer, 0.5, {alpha: 1, delay: 1});

    $rootScope.$watch('fbLoggedIn', function(newVal, oldVal) {
        var fbContainer = $('.loggedIn');
        TweenMax.set(fbContainer, {opacity: 0});
        if (newVal === true && $rootScope.facebookUserImages) {
            TweenMax.to(fbContainer, 0.5, {alpha: 1, delay: 1});
        } else {
            TweenMax.set(fbContainer, {opacity: 0});
        }
    });

}).animation('.slide-animation', function () {
    return {
        beforeAddClass: function (element, className, done) {
            var scope = element.scope();

            if (className == 'ng-hide') {
                var finishPoint = element.parent().width();
                if(scope.direction !== 'right') {
                    finishPoint = -finishPoint;
                }
                // if(scope.directionDag !== 'right') {
                //     finishPoint = -finishPoint;
                // }

                TweenMax.to(element, 0.5, {left: finishPoint, onComplete: done });
            }
            else {
                done();
            }
        },
        removeClass: function (element, className, done) {
            var scope = element.scope();

            if (className == 'ng-hide') {
                element.removeClass('ng-hide');

                var startPoint = element.parent().width();
                if(scope.direction === 'right') {
                    startPoint = -startPoint;
                }
                // var startPoint = element.parent().width();
                // if(scope.directionDag === 'right') {
                //     startPoint = -startPoint;
                // }

                TweenMax.fromTo(element, 0.5, { left: startPoint }, {left: 0, onComplete: done });
            }
            else {
                done();
            }
        }
    };
});