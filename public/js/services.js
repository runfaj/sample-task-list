/** services for the app **/

var Services = angular.module('Services', []);

/** Task factory for interacting with tasks **/
Services.factory('Task', ['$http', function($http){
    /* list of available actions available from the api.
     * Each should be called as Task.XXXX().then(successFn, errorFn);
     */
    var obj = {
        list: function() {
            /** list all tasks **/
            return $http.get('/api/tasks');
        },
        add: function(data) {
            /** add task **/
            return $http.post('/api/tasks/', data);
        },
        update: function(data) {
            /** update task **/
            return $http.put('/api/tasks/'+data.id, data);
        },
        delete: function(id) {
            /** delete a task by id **/
            return $http.delete('/api/tasks/'+id);
        },
        search: function(term) {
            /** search for tasks by search term **/
            return $http.post('/api/tasks/search/',{"term":term});
        }
    };
    
    return obj;
}]);