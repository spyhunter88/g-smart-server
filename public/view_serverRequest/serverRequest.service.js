(function() {
	'use strict';

	angular
		.module('myApp')
		.factory('ServerRequestSvc', ServerRequestSvc);

	ServerRequestSvc.$inject = ['CoreSvc', 'CONFIG'];

	function ServerRequestSvc(CoreSvc, CONFIG) {
		var url = CONFIG.REMOTE_URL + 'api/serverrequest/create';

		var api = {
			create: function(server) {
				return CoreSvc.callApi('POST', url, null, {server: server});
			}
		}

		return api;
	}

})();