
var listsAppControllers = angular.module('listsAppControllers', []);

listsAppControllers.controller('ListCtrl', ['$scope', function($scope) {
	var sortableEle;

	$scope.items = [
		{text:"Item One", done: false, pos: 1 },
		{text:"Item Two", done: false, pos: 2 },
		{text:"Item Three", done: false, pos: 3 }
	];

	$scope.addItem = function() {
		$scope.items.push({text:$scope.itemText, done: false});
		$scope.itemText = '';
		sortableEle.refresh();
	};

	$scope.checkDone = function(item) {
		item.done = !item.done;
	};

	$scope.removeItem = function(item) {
		if(item.confirm)
			$scope.items.splice($scope.items.indexOf(item), 1);
		else
			item.confirm = true;
	};

	$scope.dragStart = function(e, ui) {
		ui.item.data('start', ui.item.index());
	};

	$scope.dragEnd = function(e, ui) {
		var start = ui.item.data('start'),
			end = ui.item.index();

		$scope.items.splice(end, 0, $scope.items.splice(start, 1)[0]);

		$scope.$apply();
	};

	sortableEle = $('.list').sortable({
		start: $scope.dragStart,
		update: $scope.dragEnd
	});

}]);