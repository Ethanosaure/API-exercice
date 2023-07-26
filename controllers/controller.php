<?php
require ('./models/model.php');

class controller 
{
    public function showAll()
    {
        $model = new model();

       var_dump($model->getAll());
        
    }
    public function show($id)
    {
        $model = new model();

        if ($model->get($id) === false){
            echo 'no element with id: '.$id.'';
        } else {
            var_dump($model->get($id));
        }

        
    }
    public function add($title, $body, $author)
    {
        $model = new model();

        $model->addToDb($title, $body, $author);
    }
}

?>
