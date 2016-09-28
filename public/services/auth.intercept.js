(function() {
	'use strict';

	angular
		.module('myApp')
		.factory('authInterceptorService', AuthInterceptorService);

	AuthInterceptorService.$inject = ['$rootScope', '$q', '$injector'];

	function AuthInterceptorService($rootScope, $q, $injector) {
		var authInterceptorServiceFactory = {};

		var _response = function (response) {
			// console.log(response);
	        return response;
	    }

		var _responseError = function(response) {
			console.log('Get error response: ', response);

			var $state = $injector.get('$state');
			// Not authenticate
			if (response.status === 400) {
				// The token can not be parse
				if (response.error !== undefined && response.error != null && response.error == 'token_not_provided') {
					$state.go('auth');
				} else {
					console.log('Bad Request!', response);
				}
			} else if (response.status === 401) {
				$state.go('auth');
			} else if (response.status === 403) {
				$state.go('not_authorized');
			}

			return $q.reject(response);
		}
		
		authInterceptorServiceFactory.response = _response;
		authInterceptorServiceFactory.responseError = _responseError;
		return authInterceptorServiceFactory;
	} // END OF AuthInterceptorService

})();