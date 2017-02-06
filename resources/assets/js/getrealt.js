/*
elixir((mix) => {
    mix.webpack('../../themes/getrealt/assets/js/app.js', './public/themes/getrealt/js');
});
*/

(function() {
    
    var listingService = function ($q, $http, restService) {
        
        this.index = function (advancedSearch, keywords, minPrice, maxPrice, includeResidential, includeLand, includeCommercial) {
            var deferred = $q.defer();
            
            var params = {
                'keywords' : keywords
            };
            
            if (advancedSearch) {
                params.advancedSearch = advancedSearch;
                params.minPrice = minPrice;
                params.maxPrice = maxPrice;
                params.includeResidential = includeResidential; 
                params.includeLand = includeLand;
                params.includeCommercial = includeCommercial;
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
    };
    
    var searchWidget = function ($scope, eventFactory, listingService) {
        
        // Input variables
        $scope.advancedSearch = false;        
        $scope.keywords = null;
        $scope.minPrice = null;
        $scope.maxPrice = null;
        $scope.includeResidential = true;
        $scope.includeLand = true;
        $scope.includeCommercial = true;
        
        $scope.listings = null;
        
        $scope.search = function() {
            listingService.index(
                        $scope.advancedSearch,
                        $scope.keywords,
                        $scope.minPrice,
                        $scope.maxPrice,
                        $scope.includeResidential,
                        $scope.includeLand,
                        $scope.includeCommercial
                    ).then(function (data) {
               $scope.listings = data;
               eventFactory.refreshListings($scope.listings);
            });
        };
    };
    
    var listingsWidget = function ($scope, eventFactory) {
        $scope.listings = null;
        
        eventFactory.onRefreshListings($scope, function (listings) {
            $scope.listings = listings;
        });        
    };
    
    var eventFactory = function ($rootScope) {
        var REFRESH_LISTINGS = 'refreshListings';
        var refreshListings = function (listings) {
            $rootScope.$broadcast(REFRESH_LISTINGS, listings);
        };
        var onRefreshListings = function ($scope, handler) {
            $scope.$on(REFRESH_LISTINGS, function (event, message) {
                handler(message);
            });
        };     
        
        return {
            refreshListings: refreshListings,
            onRefreshListings: onRefreshListings
        };
        
    };

    angular.module('getrealt', ['getrealt.rest'])
           .factory('eventFactory', ['$rootScope', eventFactory])
           .service('listingService', ['$q', '$http', 'restService', listingService])
           .controller('searchWidget', ['$scope', 'eventFactory', 'listingService', searchWidget])
           .controller('listingsWidget', ['$scope', 'eventFactory', listingsWidget]);

})();


