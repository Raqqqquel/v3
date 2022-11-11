<?php
// Ampliación 3 
namespace App\response;

class HTTPResponse
{
    public static function json(int $status, $data)
    {
        $response = array();
        switch (gettype($data)) {
            case 'array':
                foreach ($data as $dto) {
                    $response[] = $dto->jsonSerialize();
                }
                break;

            case 'object':
                $response = $data->jsonSerialize();
                break;

            case 'string':
                $response = [
                    'message' => $data
                ];
                break;

           case 'boolean':
                if ($data == true){
                    $response = [
                    'message' => "Operación realizada correctamente",
                    'status' => $status
                    ];
                } else {
                    $response = [
                    'message' => "No se ha podido realizar la operación",
                    'status' => $status
                    ];
                }
                
            default:
                break;
        }
        
        header("Content-Type: application/json; charset=utf-8");
        header("Accept-Language: es");
        // http_response_code($code);
        echo json_encode($response);
    }
}
