<?php

class User
{

    public function getList()
    {
        $dbconn = new DatabaseConnection('localhost','user','password');
        $results = $dbconn->query('select name from user order by name');
                
        return $results;
    }

}