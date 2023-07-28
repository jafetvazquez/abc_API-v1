<?php 

// Creamos el modelo de autentificación
class authModel extends CI_Model{

    // función que revisa los datos ingresados y los que están en la db
    function check_login($email, $password){

        // seleccionará toda la data
        $this->db->select('*');
        // de la tabla users
        $this->db->from('users');
        // donde el email ingresado ses igual al alamcenado
        $this->db->where('email', $email);
        // donde el password ingresado ses igual al alamcenado
        $this->db->where('password', md5($password));

        // consulta en la db
        $query = $this->db->get();

        // si hay alguna columna con los datos ingresados
        if($query->num_rows() > 0){
            // Nos regresará el resultado
            return $query->result_array();
            //return true;

        }else{
            // si no retorna false
            return false;
        }

    }


    // función para crear usuario, con el parametro de la data recabada
    function signUp($dataIn){
        // inserta el array de la data en la tabla users
        $this->db->insert('users', $dataIn);

        // regresa el id que guardará en la db
        return $this->db->insert_id();

    }


    // función para obtener los usuarios
    function getUsers(){
        // seleccionamos toda la db
        $this->db->select('*');
        // en la tabla users
        $this->db->from('users');
        // creamos la consulta para obtener la info
        $query = $this->db->get();

        // retornamos la consulta con el arreglo de usuarios
        return $query->result_array();
    }


    // funcion para obtener roles
    function getRoles(){
        // seleccionamos toda la db
        $this->db->select('*');
        // en la tabla users
        $this->db->from('roles');
        // creamos la consulta para obtener la info
        $query = $this->db->get();

        // retornamos la consulta con el arreglo de usuarios
        return $query->result_array();
    }


    // funcion para obtener user
    function getUser($id){
        // seleccionamos toda la db
        $this->db->where('id', $id);
        // en la tabla users
        $query = $this->db->get('users');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return null;
        }
    }

}

?>