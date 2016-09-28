'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', [
  'ui.router',
  'ngMessages',
  'myApp.auth',
  'myApp.serverRequest',
  'myApp.version',
  'satellizer',
  /*
  'permission',
  'permission.ui',
  */
  'ui.bootstrap-slider',
  'frapontillo.bootstrap-switch',
  'ladda'
])

angular.module('myApp')
  .constant('CONFIG', {
    'APP_NAME' : 'Elastic Server',
    'APP_VERSION' : '1.0.0',
    'GOOGLE_ANALYTICS_ID' : '',
    'BASE_URL' : '',
    'REMOTE_URL': '',
    'SYSTEM_LANGUAGE' : ''
})

.config(['$urlRouterProvider', '$authProvider', '$httpProvider', 'CONFIG', function($urlRouterProvider, $authProvider, $httpProvider, CONFIG) {
	$authProvider.loginUrl = CONFIG.REMOTE_URL + 'api/authenticate';
	$urlRouterProvider.otherwise('/auth');

  // Inject interceptor
  $httpProvider.interceptors.push('authInterceptorService');
}])

.run(function ($rootScope, $state, $auth, $http, CONFIG) {
  
    $rootScope.logout = function() {
      $auth.logout().then(function() {
        localStorage.removeItem('user');
        $rootScope.currentUser = null;
        $state.go('auth');
      });
    };

    $rootScope.authenticate = function() {
      $http.get(CONFIG.REMOTE_URL + 'api/authenticate/user')
        .success(function(response) {
          var user = JSON.stringify(response.user);
          localStorage.setItem('user', user);
          $rootScope.currentUser = response.user;
        })
        .error(function(error) {
          $rootScope.logout();
        });
    };

    try {
      $rootScope.currentUser = JSON.parse(localStorage.getItem('user'));
    } catch (error) {
      $state.go('auth');
    }

    $rootScope.authenticate();
});