/** Controllers for the app **/

var Controllers = angular.module('Controllers', []);

/** Main Controller - tied to index template **/
Controllers.controller('MainController', ['$scope', '$http', 'Task', function ($scope, $http, Task) {
    /** public variables **/
    
    //list of tasks to display
    $scope.tasks = [];
    //task currently being edited
    $scope.editingTask = {};
    //search term entered by user
    $scope.searchTerm = "";
    
    /** watches for user inputs **/
    
    //This will automatically run on initial page load
    $scope.$watch('searchTerm',getItems);
    
    /** public methods **/
    
    $scope.addTask = function() {
        /* sets the current task being edited to a new model */
        $scope.editingTask = {
            id: -1,
            title: '',
            body: '',
            labels: ''
        };
    };
    
    $scope.editTask = function(item) {
        /* sets the current task being edited to the selected item
         *     item: the item to edit
         */
        $scope.editingTask = angular.copy(item);
    };
    
    $scope.applyEdit = function() {
        /* save the task being edited and refresh list if successful */
        if($scope.editingTask.id == -1) {
            Task.add($scope.editingTask).then(function(data){
                getItems();
                $scope.cancelEdit();
            },function(data){
                alert('Error updating task');
            });            
        } else {
            Task.update($scope.editingTask).then(function(data){
                getItems();
                $scope.cancelEdit();
            },function(data){
                alert('Error updating task');
            });
        }
    };
    
    $scope.cancelEdit = function() {
        /* cancel edits and reset the editing task and close the modal */
        $scope.editingTask = {};
        jQuery('#task-modal').modal('toggle');
    };
    
    $scope.deleteTask = function(idx) {
        /* delete a task
         *    idx: the index in the list $scope.tasks to delete
         */
        var id = $scope.tasks[idx].id;
        Task.delete(id).then(function(data){
            $scope.tasks.splice(idx,1);
        },function(data){
            alert('Error deleting task');
        });
    };
    
    /** private methods **/
    
    function getItems() {
        /* get list of tasks. If search term defined,
         * then search for tasks, otherwise list all
         */
        if($scope.searchTerm.length > 2) {
            Task.search($scope.searchTerm).then(function(data){
                $scope.tasks = data.data;
            },function(data){
                alert('Error getting results.');
            });
        } else if ($scope.searchTerm.length == 0) {
            Task.list().then(function(data){
                $scope.tasks = data.data;
            },function(data){
                alert('Error getting tasks');
            });
        }
    }
}]);