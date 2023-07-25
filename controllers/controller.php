<?php
require ('./models/model.php');

class controller 
{
    public function show()
    {
        $model = new model();

       var_dump($model->getAll());
        
    }
}

?>
