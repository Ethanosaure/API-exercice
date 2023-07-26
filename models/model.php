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
    public function get($id)
    {
        $request = 'SELECT * FROM posts WHERE id = :id';
        $statement = $this->bdd->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result === 'false'){
            return false;
        }

        return $result;
    }

}


?>