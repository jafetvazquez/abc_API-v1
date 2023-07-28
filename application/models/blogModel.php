<?php 

// Creamos el modelo de autentificación
class blogModel extends CI_Model{

    // función para crear usuario, con el parametro de la data recabada
    function postBlogs($dataIn){
        // inserta el array de la data en la tabla blogs
        $this->db->insert('blogs', $dataIn);

        // regresa el id que guardará en la db
        return $this->db->insert_id();

    }


    // función para editar data
    function updateBlogs($id, $newTitle, $newAutor, $newContent, $newCategory, $newDate){
        // enviamos el id a modificar
        $this->db->where('id', $id);
        // regresará la data modificada
        return $this->db->update('blogs', $data);
    }



    // funcion para obtener roles
    function getBlogs(){
        // seleccionamos toda la db
        $this->db->select('*');
        // en la tabla users
        $this->db->from('blogs');
        // creamos la consulta para obtener la info
        $query = $this->db->get();

        // retornamos la consulta con el arreglo de usuarios
        return $query->result_array();
    }


    // funcion para obtener roles
    function searchBlogs($title = null, $autor = null, $content = null, $category = null, $date = null){
        // Buscamos el titulo abuscar
        if($title !== null){
            $this->db->like('title', $title);
        }
        // Creamos más filtros
        if($autor !== null){
            $this->db->where('autor', $autor);  
        }

        if($content !== null){
            $this->db->where('content', $content);
        }

        if($category !== null){
            $this->db->where('category', $category);
        }

        if($date !== null){
            $this->db->where('date', $date);
        }
        // creamos la consulta para obtener la info
        $query = $this->db->get('blogs');

        // retornamos la consulta con el arreglo de usuarios
        return $query->result_array();
    }


    // funcion para obtener blog
    function getBlog($id){
        // seleccionamos toda la db
        $this->db->where('id', $id);
        // en la tabla users
        $query = $this->db->get('blogs');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return null;
        }
    }


    // funcion para eliminar un blog
    function deleteBlog($id){
        // buscamos mediante id
        $this->db->where('id', $id);
        // en la tabla blogs
        $this->db->delete('blogs');

        return ($this->db->affected_rows() > 0);
    }

}

?>