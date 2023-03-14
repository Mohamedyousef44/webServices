<?php

require_once('./config.php');
require_once('./model/MySQLHandler.php');
require_once('./utils/returnResponse.php');

use db\mysql\MySQLHandler as SQL  ;

$method = $_SERVER["REQUEST_METHOD"];
$url = $_SERVER["REQUEST_URI"];
$parts = explode('/' , $url);
$resource = isset($parts[4]) ? $parts[4] : "";
$resource_id = (isset($parts[5]) && is_numeric($parts[5])) ? $parts[5] : 0 ;

$obj = new SQL('products');


if($obj->connect()){

    if($resource != 'products'){

        returnRes(["error :Resource dosn't exist"], 404);
    
    }else{
    
        if($method == "GET"){
            
            $data = $obj->get_record_by_id($resource_id);
            if(empty($data)) returnRes(["error :Resource dosn't exist"] , 404) ;
            else returnRes($data , 200);
        
        }elseif($method == "POST"){
    
            $post = json_decode(file_get_contents('php://input'), true);
            $data = $obj->save($post);
            if($data) returnRes(['added successfully'] , 200);
            else returnRes(['try again later'] , 404);
           
        }elseif($method == "PUT"){

            $put = json_decode(file_get_contents('php://input'), true);
            if(empty($obj ->get_record_by_id($resource_id))) returnRes(["error :Resource dosn't exist"] , 404);
            else{

                $obj->update($put , $resource_id );
                returnRes($put, 200);

            }
            

        }elseif($method == "DELETE"){

            if(empty($obj ->get_record_by_id($resource_id))) returnRes(["error :Resource dosn't exist"] , 404);
            else{

                $obj->delete($resource_id );
                returnRes(['deleted successfully'], 200);

            }

           

        }else{
        
            returnRes(['method not allowed'], 405);
    
        }
    }


}else{

    returnRes(["error: internal server error!"], 500);
}

?>

