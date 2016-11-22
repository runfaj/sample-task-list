<!DOCTYPE html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Basic Tasks App</title>

        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <script src="bower_components/angular/angular.min.js"></script>
        <script src="bower_components/angular-route/angular-route.min.js"></script>
        
        <script src="js/app.js"></script>
        <script src="js/controllers.js"></script>
        <script src="js/services.js"></script>
        
        <style>
            .task-card {
                margin: 10px;
                background: #f8f8f8;
                padding: 10px;
                border: 1px solid #ddd;
            }
            .task-title {
                font-weight: bold;
            }
            .task-body {
                padding: 6px 0;
            }
            .task-labels {
                color: #999;
            }
        </style>
    </head>

    <body>
        <div ng-view></div>

        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>