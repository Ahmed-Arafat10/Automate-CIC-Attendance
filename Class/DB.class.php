<?php

class DB
{
    private const DB_NAME = "cic_attend" ; 
    private const DB_PASS = "Gingpariston241$$" ;
    private const DB_USER = "root" ;
    private const DB_HOST = "localhost" ;
    private $Con;

    public function __construct()
    {
        $this->Con = new mysqli(self::DB_HOST,self::DB_USER,self::DB_PASS,self::DB_NAME);
    }   
    public function CheckDB_Connection()
    {
        if(!$this->Con->connect_error) echo "Done connecting to DB";
        else $this->DB_Error();
    }
    public function DB_Error()
    {
        echo "Failed to co  nnect to MySQL DB" . $this->Con->connect_errno;
    }

    public function Close_Connection()
    {
            $this->Con->close();
    }

    public function GetCon()
    {
        return $this->Con;
    }
}
