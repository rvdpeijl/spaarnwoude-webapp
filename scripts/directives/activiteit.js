app.directive('activiteit', function($rootScope) {
    return {
        restrict: 'E',
        link: function($scope, element, attrs) {
        var colors = {
            beleven: {
                hex: '#f18a01'
            },
            doen: {
                hex: '#b7037e'
            },
            genieten: {
                hex: '#32aadf'
            },
            verblijven: {
                hex: '#dbdb00'
            }
        };
            var id = $scope.$eval(attrs.activiteitId),
                activiteiten = $scope.activiteiten,
                activiteit = $scope.singleHandler.filter(id);

            var logo = document.createElement('img');
            logo.className = 'logo';
            logo.src = $rootScope.config.url + activiteit.images.logo;

            var link = document.createElement('a');
            link.className = "link";
            link.href= activiteit.website;
            link.target = "_blank";
            
            // maak foto wrapper en element
            var fotoWrapper = document.createElement('div');
            var foto = document.createElement('img');
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
            knop.style.backgroundColor = colors[activiteit.categorie].hex;
            knop.onclick = function() {
                $scope.singleHandler.showSingle(id);
            };

            element[0].appendChild(fotoWrapper);
            fotoWrapper.appendChild(link);
            link.appendChild(logo);
            element[0].appendChild(wrapper);
        }
    };
});