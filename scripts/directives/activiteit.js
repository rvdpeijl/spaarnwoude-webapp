app.directive('activiteit', function($rootScope) {
    return {
        restrict: 'E',
        link: function($scope, element, attrs) {

            var id = $scope.$eval(attrs.activiteitId),
                activiteiten = $scope.activiteiten,
                index = id - 1,
                activiteit = activiteiten[index];

            // maak foto wrapper en element
            var fotoWrapper = document.createElement('div'),
                foto = document.createElement('img');

            fotoWrapper.className = 'fotoWrapper';
            foto.className = 'foto';
            foto.src = 'data/uploads/' + id + '.png';
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
                console.log(id);
            };

            element[0].appendChild(fotoWrapper);
            element[0].appendChild(wrapper);
        }
    };
});