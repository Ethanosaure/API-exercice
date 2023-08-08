<?php
require ('./models/model.php');

class controller 
{
    public function showAll()
    {
        $model = new model();
      echo json_encode($model->getAll());
       
        
    }
    public function show($id)
    {
        $model = new model();

        if ($model->get($id) === false){
            echo 'no element with id: '.$id.'';
            return http_response_code(404);
        } else {
           echo json_encode($model->get($id));
        }

        
    }
    public function add($title, $body, $author)
    {
        $model = new model();

        $model->addToDb($title, $body, $author);
    }
    public function CharliePuth($title, $author,$body, $id){
        $model = new model();

        if ($model->modify($title, $author, $body, $id) === false){
            echo 'cannot update post';
            http_response_code(400);
        } else {
            echo 'updated successfully';
            http_response_code(200);
        }


    }
    public function delete($id)
    {
    $model = new model();
    $model->deleting($id);
    echo 'element successfully removed';
    http_response_code(200);
    }
        
    }

?>
