<?php

use phpDocumentor\Reflection\Types\Boolean;

class Comment
{
    //properties
    public int $id;
    public User $originalPoster;
    public String $publicText;
    public int $parentPostId;
    public int $articleId;
    public $db;

    //constructor
    public __construct($originalPoster, $publicText, $parentPostId, $articleId)
    {
        //initialize vars
        $this->originalPoster= $originalPoster;
        $this->$publicText= $publicText;
        $this->$parentPostId= $parentPostId;
        $this->$articleId= $articleId;
        $db = new Database();
    }

    //methods for Comment object.  ToComment($us, "texto");
    //con props de objeto:
    Register() : Boolean

    //con PARAMETROS DE METODO
    Register($user, $text, $responseTo=null ) : Boolean
    {
        //register a commmnent in the DB
        //the comment data is: user_id, text, news_id, active
        if(isset($responseTo))
        //the comment query is:
            $query =  "INSERT INTO comments (fk_users, text, fk_news, active) VALUES (:originalPoster, :publicText, 1) ";
        else
            $query =  "INSERT INTO comments (fk_users, text, fk_news, active) VALUES (:originalPoster, :publicText, :articleId, 1) ";

        //execuite the query
        $queryDB = $this->db->query($query);
        $this->db->bind(':originalPoster', $user);
        $this->db->bind(':publicText', $text);
       //// $this->db->bind(':parentPostyId', $responseTo);
        $this->db->bind(':articleId', $this->articleId);

        $result = $this->db->execute();

        return $result;
    }

}