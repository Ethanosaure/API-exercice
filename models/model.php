<?php

require_once('connect.php');


class model{

    public function __construct()
    {
        $this->bdd = connect::connect();
    }
    public function getAll()
    {
        $request = 'SELECT * FROM posts';
        $statement = $this->bdd->prepare($request);
        $statement->execute();

        return  $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

}


?>