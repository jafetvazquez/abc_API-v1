<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class authController extends CI_Controller{

    public function __construct(){

        // Se construte la clase padre
        parent::__construct();

        // cargamos el modelo authModel
        $this->load->model('authModel');

        // cargamos el helper para verificar la autenticación
        $this->load->helper('verifyAuthToken');

        // headers
        header("Access-Control-Allow-Origin: *"); // acepta cualquier ip de origen
        header("Access-Control-Allow-Methods: GET, POST, PUT"); // metodos permitidos
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding"); // content permitido
    }

    // función login donde ingresamos los datos v1
    public function login(){
        // creamos var jwt para almacenar el token
        $jwt = new JWT();
        // clave secreta
        $JwtSecretKey = "myloginSecret";

        // creamos var email para guardar el input email
        $email = $this->input->post('email');
        // creamos var password para guardar el input password
        $password = $this->input->post('password');

        // creamos la var res usando el modelo de autentificación
        $res = $this->authModel->check_login($email, $password);
        //$dataJSON = json_decode($res);

        // creamos la var $payload para asignar el tiempo que durará el token
        $payload = [
            'exp' => time() + (60 * 60),
            'data' => $res,
        ];

        // si res es falso:
        if($res === false){
            // mostrará echo de usuario no encontrado
            $error = 'User not found';
            echo ($error);
        }else{
            // si existe creará el token cifrado con el modelo de autetificacion
            $token = $jwt->encode($payload, $JwtSecretKey, 'HS256');

            $allData = array(
                "data" => $res,
                "token" => $token
            );

            // se muestra mediante un json
            // echo json_encode($allData);
            $this->output->set_content_type('application/json')->set_output(json_encode($allData));

        }

    }


    // función para crear user
    public function signUp(){
        // si hay datos en la solicitud post
        if($this->input->post()){
            //se recuperan los valores y se guardan en las siguientes variables
            $name = $this->input->post('name');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $rol = 'user';

            // se crea un array con los datos recuperados
            $dataIn = array(
                'name' => $name,
                'username' => $username,
                'password' => md5($password),
                'email' => $email,
                'rol' => $rol,

            );

            //$dataJSON = json_encode($dataIn);
            
            //  usamos el modelo de authModel para enviar la info recabada
            $userId = $this->authModel->signUp($dataIn);

            // si el id de usuario es válido
            if($userId){
                // nos muetra el echo de success
                echo json_encode('user registered successfully');
            }else{
                // si hay algun error nos regresará un failed
                echo json_encode('user registration failed');
            }

        }
    }

    
    // funcion para obtener usuarios
    public function users_get(){
        // enviamos el header 'Authorization' a traves de la var $headerToken
        $headerToken = $this->input->get_request_header('Authorization');
        // separamos el string en un array de dos elementos y se guardan en $splitToken
        $splitToken = explode(" ", $headerToken);
        // asignamos a la var $token el segundo elemento de $splitToken, que en este caso es el token jwt
        $token = $splitToken[1];

        // creamos un try catch para detectar errores
        try{
            // usamos el token para verificar con ayuda del helper verifyAuthToken enviando el parametro $token
            $token = verifyAuthToken($token);

            // si el token coincide
            if($token){
                // creamos una var para guardar los usuarios
                $users = $this->authModel->getUsers();
                // los mostramos como json
                echo json_encode($users);
            }

        }catch(Exception $e){
            // mostramos el error
            //echo "Error: " . $e->getMessage();

            // error personaliado con http status 401=>Unauthorized
            $error = array(
                "status" => 401,
                "message" => "Invalid token provided",
                "success" => false
            );

            // lo mostramos como json
            echo json_encode($error);
        }
    }

    // funcion para obtener usuarios
    public function roles_get(){
        // guarda los roles de la peticion
        $roles = $this->authModel->getRoles();
        // los muestra en json
        echo json_encode($roles);
    }


    // funcion para obtener usuarios
    public function user_get($id){
        // guarda los roles de la peticion
        $user = $this->authModel->getUser($id);
        // los muestra en json
        $this->output->set_content_type('application/json')->set_output(json_encode($user));
    }


}

?>