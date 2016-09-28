(function() {
	'use strict';
	
	angular
		.module('myApp')
		.factory('CoreSvc', CoreSvc);
		
	CoreSvc.$inject = ['$http','$q'];
	
	function CoreSvc($http, $q) {
		var svc = {
			callApi: function(_method, _url, _params, _data) {
				var deferred = $q.defer();

				$http({ method: _method, url: _url, params: _params, data: _data}).
					success(function(d, status, headers, config) {
						deferred.resolve(d);
					}).
					error(function(error) {
						deferred.reject(error);
					});

				return deferred.promise;
			}
		};

		return svc;
	}
	
})();