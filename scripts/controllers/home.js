'use strict';

app.controller('HomeCtrl', function ($scope, $rootScope, $interval, weerData, activiteiten) {
    $scope.weer = {};
    weerData.success(function(data) {
        $scope.getWeather(data);
    });

    $scope.interval = null;

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
                        }
                    };
                }
            });
            return activiteit;
        },
        closeSingle: function(evt) {
            if(evt.target.id == "single" || evt.target.className == "close") {
                $rootScope.singleHidden = true;
            }
        }
    };

}).animation('.slide-animation', function () {
    return {
        beforeAddClass: function (element, className, done) {
            var scope = element.scope();

            if (className == 'ng-hide') {
                var finishPoint = element.parent().width();
                if(scope.direction !== 'right') {
                    finishPoint = -finishPoint;
                }
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

                TweenMax.fromTo(element, 0.5, { left: startPoint }, {left: 0, onComplete: done });
            }
            else {
                done();
            }
        }
    };
});