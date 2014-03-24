app.directive('activiteit', function($rootScope) {
    return {
        restrict: 'E',
        link: function($scope, element, attrs) {

            var id = $scope.$eval(attrs.activiteitId),
                activiteiten = $scope.activiteiten,
                activiteit = $scope.singleHandler.filter(id);

            // maak foto wrapper en element
            var fotoWrapper = document.createElement('div'),
                foto = document.createElement('img');

            fotoWrapper.className = 'fotoWrapper';
            foto.className = 'foto';
            foto.src = $rootScope.config.url + activiteit.images.big;
            fotoWrapper.appendChild(foto);

            // maak titel wrapper en element
            var wrapper = document.createElement('div'),
                titel = document.createElement('p'),
                knop = document.createElement('button');
            
            titel.innerHTML = activiteit.naam;
            wrapper.className = 'wrapper';
            wrapper.appendChild(titel);
            wrapper.appendChild(knop);
            knop.innerHTML = 'Bekijk';
            
            knop.onclick = function() {
                $scope.singleHandler.showSingle(id);
            };

            element[0].appendChild(fotoWrapper);
            element[0].appendChild(wrapper);
        }
    };
});