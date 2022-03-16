<?php

//PHP API
//Använd Postman för test.
//POST med PARAM skickar värden direkt i länken och hamnar i $_GET
//POSTMAN Om APIKEY finns i headern och har rätt värde
if(isset($_SERVER['HTTP_APIKEY']))
{
    if ($_SERVER['HTTP_APIKEY'] == "1284GTY678XSW32FVZS.FVG567YHJUswqazxf42njuygt4376hdw57y")
    {
        //echo "RÄTT KEY!!";
    }
    else
    {
        //Kan inte använda API:et
        header('No access', true, 401);
        exit("NO!");
    }
}
else
{
    //Kan inte använda API:et
    header('No access', true, 401);
    var_dump($_SERVER);
    exit("NO!");
}
//Delar upp url:en för funktioner inom api:et
$arr = explode('/',$_GET['url']);
if (!count($arr) == 2)
{
    //Kan inte använda API:et
    header('No access', true, 401);
    exit("NO!");
}
//Routern för API:et
switch ($_SERVER['REQUEST_METHOD'])
{
    case "POST":
        try {
            require_once "controller/" .$arr[0] . ".Controller.php";
            $className = $arr[0] . "Controller";
            $controller = new $className();
            echo $controller->{$arr[1]}();
        } catch (\Throwable $th) {
            header('No access', true, 401);
            exit("NO!");
        }
        break;
    case "GET":
        echo "Du skickade en GET REQUEST";
        break;
    case "DELETE":
        echo "Du skickade en DELETE REQUEST <br>";
        break;
    case "PUT":
        echo "Du skickade en PUT REQUEST <br>";
        break;
    default:
        echo "SERVERN STÖDJER INTE ". $_SERVER['REQUEST_METHOD'];
    break;
}
?>