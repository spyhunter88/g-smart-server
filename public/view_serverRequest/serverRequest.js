'use strict';

angular.module('myApp.serverRequest', [])

.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider
	.state('serverRequest', {
		url: '/serverRequest',
		views: {
			'serverRequest': {
				templateUrl: 'view_serverRequest/serverRequest.html',
				controller: 'ServerRequestCtrl as serverRequest'
			}
		}
	})
}])

.controller('ServerRequestCtrl', ['$scope', 'ServerRequestSvc', function($scope, ServerRequestSvc) {
	$scope.error = false;
	$scope.success = false;
	$scope.errorText = "";

	var user = JSON.parse(localStorage.getItem('user'));
	$scope.email = user.email;

	$scope.svrRequest = {
		cpu: 1,
		ram: 1,
		ssd: 20,
		iops: 3000,
		bandwidth: 10,
		ip: 1,
		os: 'Linux'
	};
	$scope.price = {
		h_cpu: 300, m_cpu: 216000,
		h_ram: 200, m_ram: 144000,
		h_ssd: 200, m_ssd: 144000,
		h_iops: 100, m_iops: 72000,
		h_bw: 150, m_bw: 108000,
		h_ip: 100, m_ip: 72000,
		h_total: 1050, m_total: 756000
	}

	$scope.cpu = {
		min: 1,
		max: 30,
		step: 1
	};
	$scope.ram = {
		min: 1,
		max: 50,
		step: 1
	};
	$scope.ssd = {
		min: 20,
		max: 1000,
		step: 20
	};
	$scope.iops = {
		min: 3000,
		max: 15000,
		step: 200
	};
	$scope.bandwidth = {
		min: 10,
		max: 500,
		step: 10
	};
	$scope.ip = {
		min: 1,
		max: 50,
		step: 1
	};

	function _update_price() {
		$scope.price.h_cpu = $scope.svrRequest.cpu * 300;
		$scope.price.m_cpu = $scope.svrRequest.cpu * 300 * 720;
		$scope.price.h_ram = $scope.svrRequest.ram * 200;
		$scope.price.m_ram = $scope.svrRequest.ram * 200 * 720;
		$scope.price.h_ssd = $scope.svrRequest.ssd / 20 * 200;
		$scope.price.m_ssd = $scope.svrRequest.ssd / 20 * 200 * 720;
		$scope.price.h_iops = (($scope.svrRequest.iops / 200) - 14) * 100;
		$scope.price.m_iops = (($scope.svrRequest.iops / 200) - 14) * 100 * 720;
		$scope.price.h_bw = $scope.svrRequest.bandwidth * 150;
		$scope.price.m_bw = $scope.svrRequest.bandwidth * 150 * 720;
		$scope.price.h_ip = $scope.svrRequest.ip * 100;
		$scope.price.m_ip = $scope.svrRequest.ip * 100 * 720;

		// Total
		$scope.price.h_total = $scope.price.h_cpu + $scope.price.h_ram + $scope.price.h_ssd + 
								$scope.price.h_iops + $scope.price.h_bw + $scope.price.h_ip;
		$scope.price.m_total = $scope.price.m_cpu + $scope.price.m_ram + $scope.price.m_ssd + 
								$scope.price.m_iops + $scope.price.m_bw + $scope.price.m_ip;
	}

	$scope.$watch('svrRequest', _update_price, true);

	$scope.register = function() {
		// console.log($scope.svrRequest);
		$scope.laddaLoading = true;
		$scope.svrRequest.price_h = $scope.price.h_total;
		$scope.svrRequest.price_m = $scope.price.m_total;
		ServerRequestSvc.create($scope.svrRequest).then(
			function(data) {
				$scope.laddaLoading = false;
				if (data.error !== undefined) {
					$scope.success = false;
					$scope.error = true;
					$scope.errorText = data.message;
					return;
				}
				$scope.success = true;
				$scope.error = false;
			}, function(error) {
				$scope.laddaLoading = false;
				$scope.error = true;
				$scope.errorText = '[' + error.status + '] ' + error.statusText;
			}
		);
	}
}]);