<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        //$this->load->model('User_model', 'use');
    }

    public function users_get(){
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        ];

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $users ) )
            {
                $this->response( $users[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }


    /*public function users_get(){

        // Solicitar id
        $id = $this->input->get( 'id' );

        if(!empty($id)){

            // se crea la var data para asignar el resultado si existe el id
            $data = $this->use->get_by_id($id)->result();

            // if para saber si la var data tiene info
            if($data){

                // Mensaje en caso de encontra la data mediante el id
                $response['error'] = false;
                $response['message'] = 'success get data by id';
                $response['data'] = $data;
    
            }else{
    
                // Mensaje en caso de no encontrar data
                $response['error'] = true;
                $response['error'] = 'failded get data';
    
            }

        }else{

            // se crea la var data para solicitar toda la info
            $data = $this->use->get_all()->result();

            if($data){

                // Mensaje en caso de encontra toda la info
                $response['error'] = false;
                $response['message'] = 'success get all data';
                $response['data'] = $data;
    
            }else{
    
                // Mensaje en caso de no encontrar info
                $response['error'] = true;
                $response['error'] = 'failded get data';
            }
        }

        // response con el HTTP status code (200->OK)
        $this->response($response, 200);
        
    }*/



}