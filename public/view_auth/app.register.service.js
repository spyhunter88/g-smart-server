(function() {
	'use strict';

	angular
		.module('myApp')
		.factory('RegisterSvc', RegisterSvc);

	RegisterSvc.$inject = ['CoreSvc', 'CONFIG'];

	function RegisterSvc(CoreSvc, CONFIG) {
		var baseUrl = CONFIG.REMOTE_URL + 'api/user/register';
		var api = {
			register: function(user) {
				return CoreSvc.callApi('POST', baseUrl, null, user);
			}
		};

		return api;
	}

})();