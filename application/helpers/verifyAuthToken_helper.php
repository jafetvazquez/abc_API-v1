<?php

// si no existe la función  'verifyAuthToken' la creamos
if(!function_exists('verifyAuthToken')){

    // se crea la función 'verifyAuthToken' con el token como param
    function verifyAuthToken($token){
        // se crea un nuevo JWT token
        $jwt = new JWT();
        // nueva clave secreta
        $jwtSecret = 'myloginSecret';
        // var para la verificacion donde se codifican las otras var creadas
        $verification = $jwt->decode($token, $jwtSecret, 'HS256');

        // creamos la var 'verification_json' para alamacenar el token en json
        $verification_json = $jwt->jsonEncode($verification);
        // mostramos el json con la verificacion
        return $verification_json;
    }

}

?>