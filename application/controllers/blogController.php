<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class blogController extends CI_Controller{

    public function __construct(){

        // Se construte la clase padre
        parent::__construct();

        // cargamos el modelo authModel
        $this->load->model('blogModel');

        // cargamos el helper para verificar la autenticación
        $this->load->helper('verifyAuthToken');

        // headers
        header("Access-Control-Allow-Origin: *"); // acepta cualquier ip de origen
        header("Access-Control-Allow-Methods: GET, POST, PUT"); // metodos permitidos
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization"); // content permitido
    }


    // función para crear blog
    public function blog_post(){
        // si hay datos en la solicitud post
        if($this->input->post()){
            //se recuperan los valores y se guardan en las siguientes variables
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            $autor = $this->input->post('autor');
            $category = $this->input->post('category');
            $date = $this->input->post('date');

            // se crea un array con los datos recuperados
            $dataIn = array(
                'title' => $title,
                'content' => $content,
                'autor' => $autor,
                'category' => $category,
                'date' => $date,

            );

            //$dataJSON = json_encode($dataIn);
            
            //  usamos el modelo de authModel para enviar la info recabada
            $blogId = $this->blogModel->postBlogs($dataIn);

            // si el id del blog ingresado es válido
            if($blogId){
                // nos muetra el echo de success
                echo json_encode('data registered successfully');
            }else{
                // si hay algun error nos regresará un failed
                echo json_encode('data registration failed');
            }

        }
    }

    
    // funcion para actualizar data
    public function blog_edit($id){
        // verficamos la solicitud a traves de post
        if($this->input->method() == 'post'){
            // obtener la data a editrar desde id
            $newTitle = $this->input->post('title');
            $newAutor = $this->input->post('autor');
            $newContent = $this->input->post('content');
            $newCategory = $this->input->post('category');
            $newDate = $this->input->post('date');

            // creamos un array con la nueva data
            $newData = array(
                'title' => $newTitle,
                'autor' => $newAutor,
                'content' => $newContent,
                'category' => $newCategory,
                'date' => $newDate
            );

            // buscamos el id
            $this->db->where('id', $id);

            // hacemos cambio de info
            $res = $this->db->update('blogs', $newData);

            // var res para responder el proceso
            if($res){
                echo json_encode('data changed');
            }else{
                echo json_encode('data not changed');
            }
        }else{
            echo json_encode('error');
        }
        
    }


    // funcion para obtener blogs
    public function blogs(){
        // guarda los blogs de la peticion
        $blogs = $this->blogModel->getBlogs();
        // los muestra en json
        echo json_encode($blogs);
    }


    // función para buscar blogs
    public function searchBlogs(){
        // obtenemos el title a buscar
        $title = $this->input->get('title');
        // obtenemos otros filtros si existen
        $autor = $this->input->get('autor');
        $content = $this->input->get('content');
        $category = $this->input->get('category');
        $date = $this->input->get('date');
        

        $res = $this->blogModel->searchBlogs($title, $autor, $content, $category, $date);

        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    // funcion para obtenerblogs
    public function blog_get($id){
        // guarda los roles de la peticion
        $blog = $this->blogModel->getBlog($id);
        // los muestra en json
        $this->output->set_content_type('application/json')->set_output(json_encode($blog));
    }


    // funcion para eliminar blog
    public function deleteBlog($id){
        // cargamos el blog Model con la funcion eliminar
        //$this->load->blogModel('deleteBlog');
        $deleted = $this->blogModel->deleteBlog($id);

        if($deleted){
            // si es eliminado correctamente
            echo json_encode('blog eliminado');
        }else{
            echo json_encode('error');
        }
    }

}

?>