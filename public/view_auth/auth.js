'use strict';

angular.module('myApp.auth', [])

.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider
	.state('auth', {
		url: '/auth',
		views: {
			'serverRequest': {
				templateUrl: 'view_auth/auth.html',
				controller: 'AuthCtrl as auth'
			}
		}
	})
	.state('register', {
		url: '/register',
		views: {
			'serverRequest': {
				templateUrl: 'view_auth/register.html',
				controller: 'RegisterCtrl as reg'
			}
		}
	})
}])

.controller('AuthCtrl', ['$auth', '$state', '$http', '$rootScope', 'CONFIG', function($auth, $state, $http, $rootScope, CONFIG) {
	var vm = this;

	vm.error = false;
	vm.errorText;

	if ($rootScope.currentUser != null) {
		$state.go('serverRequest');
	}

	vm.login = function(isValid) {
		if (!isValid) return;

		var credentials = {
			email: vm.email,
			password: vm.password
		};

		vm.laddaLoading = true;
		$auth.login(credentials).then(
			function(data) {
				vm.laddaLoading = false;
				if (data.data.error !== undefined) {
					vm.error = true;
					switch (data.data.error_code) {
						case 'invalid_credentials': vm.errorText = 'Thông tin đăng nhập không chính xác!'; break;
					}
					return;
				}
				console.log('Authenticate success: ', data);

				vm.checkAuthenticate();
			}, function(err) {
				vm.laddaLoading = false;
				console.log(err);
			}
		);
	} /* END OF login function */

	vm.checkAuthenticate = function() {
		$http.get(CONFIG.REMOTE_URL + 'api/authenticate/user')
			.success(function(response) {
				var user = JSON.stringify(response.user);
				localStorage.setItem('user', user);
				$rootScope.currentUser = response.user;
				$state.go('serverRequest');
			})
			.error(function(error) {
				vm.error = true;
				vm.errorText = error.errorText;
			});
	} /* END OF checkAuthenticate */
}])

.controller('RegisterCtrl', ['$state', 'RegisterSvc', function($state, RegisterSvc) {
	var vm = this;
	vm.result = false;
	vm.error = false;

	vm.register = function(isValid) {
		if (!isValid) return;

		var user = {
			name: vm.name,
			email: vm.email,
			password: vm.password,
			phone: vm.phone,
			company_name: vm.company_name,
			company_address: vm.company_address
		};

		vm.laddaLoading = true;
		RegisterSvc.register(user).then(
			function(data) {
				if (data.error !== undefined) {
					vm.error = true;
					vm.success = false;
					vm.errorText = data.message;
				}

				vm.success = true;
				vm.error = false;
				vm.text = true;
				vm.laddaLoading = false;
			}
			,function(error) {
				vm.error = true;
				vm.success = false;
				vm.laddaLoading = false;
				console.log(error);
			});
	};
}]);