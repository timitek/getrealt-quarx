/*
elixir((mix) => {
    mix.webpack('../../themes/getrealt/assets/js/app.js', './public/themes/getrealt/js');
});
*/

(function() {
    
    var listingService = function ($q, $http, restService) {
        
        this.index = function (constraints) {
            var deferred = $q.defer();
            
            var params = null;
            if (constraints) {
                params = {
                    'constraints': constraints
                };
            }

            restService.go({
                url: '/getrealt/listing',
                params: params
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });

            return deferred.promise;
        };

        this.indexDownload = function (constraints, format) {
            var deferred = $q.defer();

            var params = {
                    'format': format
                };
            
            if (constraints) {
                params.constraints = constraints;
            }
                
            restService.go({
                url: '/api/analytics/metric',
                enableCache: false,
                responseType: 'arraybuffer',
                params: params
            }).then(function (data) {
                deferred.resolve(data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });

            return deferred.promise;
        };
        
        this.show = function (id) {
            var deferred = $q.defer();

            restService.go({
                url: '/api/analytics/metric/' + id
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;s
            });

            return deferred.promise;
        };
        

        this.update = function (metric) {
            var deferred = $q.defer();

            restService.go({
                url: '/api/analytics/metric/' + metric.metricid,
                method: 'PUT',
                params: {
                    'attributes': metric
                }
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });

            return deferred.promise;
        };

        this.store = function (metric) {
            var deferred = $q.defer();

            restService.go({
                url: '/api/analytics/metric',
                method: 'POST',
                params: {
                    'attributes': metric
                }
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });

            return deferred.promise;
        };
    };
    
    var searchWidget = function ($scope, listingService) {
        
        $scope.advancedSearch = false;
        
        $scope.keywords = null;
        $scope.minPrice = null;
        $scope.maxPrice = null;
        $scope.includeResidential = true;
        $scope.includeLand = true;
        $scope.includeCommercial = true;
        
        $scope.search = function() {
            listingService.index().then(function (data) {
               alert(JSON.stringify(data)); 
            });
        };
    };    

    angular.module('getrealt', ['getrealt.rest'])
           .service('listingService', ['$q', '$http', 'restService', listingService])
           .controller('searchWidget', ['$scope', 'listingService', searchWidget]);

})();


