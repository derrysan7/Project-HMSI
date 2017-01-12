<?php
class Database
{   
    private $host = "localhost";
    private $db_name = "hmsi";
    private $username = "hmsi";
    private $password = "JVhOHrdKkKdV9r98";
    private $db_port = "2222";
    public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->db_port . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>