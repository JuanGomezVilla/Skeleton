@echo off
title Generator

set /p filename=Filename: 
set /p folder=Folder: 
set LowerCaseMacro=for /L %%n in (1 1 2) do if %%n==2 (for %%# in (a b c d e f g h i j k l m n o p q r s t u v w x y z) do set "path=!path:%%#=%%#!") else setlocal enableDelayedExpansion ^& set path=
%LowerCaseMacro%%filename%



rem ORIGINAL FILE
(
    echo ^<?php
    echo.
    echo //Database connection, utils, config, repository and model
    echo require("Database/ContextDB.php"^);
    echo require("Utils/Utils.php"^);
    echo require("config.php"^);
    echo require("Repository/Repository.php"^);
    echo require("Repository/%folder%/%filename%Repository.php"^);
    echo require("Model/%folder%/%filename%Model.php"^);
    echo.
    echo //%filename% Controller
    echo require("Controller/%folder%/%filename%Controller.php"^);
    echo.
    echo ?^>
) > %path%.php

rem Creates the folder if doesnt exist
if not exist Controller\%folder% mkdir Controller\%folder%
if not exist Repository\%folder% mkdir Repository\%folder%
if not exist Model\%folder% mkdir Model\%folder%
if not exist View\%folder% mkdir View\%folder%
if not exist css mkdir css

rem Styles file
(
    echo.
) > css/%path%.css

rem Script file
(
    echo.
) > js/%path%.js


rem Controller
(
    echo ^<?php
    echo.
    echo session_start(^);
    echo.
    echo //Getting the response from the model
    echo $response = %filename%Model::get_response($config["use_error_handler"]^);
    echo.
    echo //If the response code is 200 (success^)
    echo if($response["code"] == 200^)^{
    echo     //Save the response data
    echo     $data = $response["data"];
    echo.
    echo     //Import %filename% View
    echo     require("View/%folder%/%filename%View.php"^);
    echo } else ^{
    echo     //ERROR CODE
    echo     $errorCode = $response["code"];
    echo.
    echo     //Error page
    echo     require("View/Error/ErrorView.php"^);
    echo }
    echo.
    echo ?^>
) > Controller/%folder%/%filename%Controller.php

rem Model
(
    echo ^<?php
    echo.
    echo class %filename%Model ^{
    echo.
    echo     public static function get_response($use_error_handler^)^{
    echo         //Handle with possible errors
    echo         try ^{
    echo             //Use an error handler, capture the repository and check the database connection
    echo             if($use_error_handler^) set_error_handler(function(^)^{throw new Exception("Unknown error", 500^);}^);
    echo             $repository = new %filename%Repository("your database name"^);
    echo             if(^^!$repository-^>isDatabaseConnection(^)^) throw new Exception("There is no connection with the database. Service Unavailable", 503^);
    echo.
    echo             //TODO
    echo.
    echo             //Successful request code and data
    echo             return ["code" =^> 200, "data" =^> []];
    echo         } catch(Exception $exception^)^{
    echo             //Exception request code and null data
    echo             return ["code" =^> $exception-^>getCode(^) ?? 500, "data" =^> null];
    echo         }
    echo     }
    echo }
    echo.
    echo ?^>
) > Model/%folder%/%filename%Model.php


rem Repository
(
    echo ^<?php
    echo.
    echo class %filename%Repository extends Repository ^{
    echo.    
    echo }
    echo.
    echo ?^>
) > Repository/%folder%/%filename%Repository.php

rem View
(
    echo ^<^^!DOCTYPE html^>
    echo ^<html lang="en"^>
    echo     ^<head^>
    echo         ^<^^!-- ^Title and icon --^>
    echo         ^<title^>%filename% - ^<?php ^echo $config["title"]; ?^>^<^/title^>
    echo         ^<link rel="icon" href="/assets/icon.ico"^>
    echo         ^<meta charset="UTF-8" ^/^>
    echo.
    echo         ^<^^!-- Settings --^>
    echo         ^<meta http-equiv="X-UA-Compatible" content="IE=edge" ^/^>
    echo         ^<meta name="viewport" content="width=device-width, initial-scale=1.0" ^/^>
    echo         ^<meta name="google" content="notranslate" ^/^>
    echo         ^<meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" ^/^>
    echo.
    echo         ^<^^!-- Styles --^>
    echo         ^<link rel="stylesheet" type="text/css" href="/css/themes/light.css"^>
    echo         ^<link rel="stylesheet" href="/css/main.css"^>
    echo         ^<link rel="stylesheet" href="/css/%path%.css"^>
    echo.
    echo         ^<^^!-- Scripts --^>
    echo         ^<script src="/js/%path%.js"^>^<^/script^>
    echo     ^<^/head^>
    echo     ^<body^>
    echo.        
    echo     ^<^/body^>
    echo ^<^/html^>
) > View/%folder%/%filename%View.php

echo.
echo Process finished...