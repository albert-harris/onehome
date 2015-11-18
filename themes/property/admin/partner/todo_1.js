 /*
 * @Author: ghostkiss_boy
 * @Date:   2014-07-31 14:28:19
 * @Last Modified by:   ghostkiss_boy
 * @Last Modified time: 2014-08-26 11:10:27
 */


var app = angular.module('TestApp');

app.controller('TodoController', function($scope) {
    
    $scope.vouchers      = [{
        client_type:1
    }];
    
    $scope.addTodo = function() {
        $scope.vouchers.push({ client_type:1 });
    };
});
