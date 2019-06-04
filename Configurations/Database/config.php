<?php
class Database
{   
	
    private $gandertech_host = "localhost";
    private $gandertech_db_name = "";
    private $gandertech_username = "root";
    private $gandertech_password = "";
    public $conn;
     
    public function dbConnection() {
     
	      $this->conn = null;   
	       
        try {
        $this->conn = new PDO("mysql:host=" . $this->gandertech_host . ";dbname=" . $this->gandertech_db_name, $this->gandertech_username, $this->gandertech_password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		    catch(PDOException $e)
		    {
            //echo "Connection error: " . $e->getMessage();
            if($e->getMessage()) {
                echo json_encode(array("status"=>"500", "message"=>"could not establish connection"));
            }else {
                echo json_encode(array("status"=>"200", "message"=>"connection establshed"));
            }
         }
         
        return $this->conn;
    }
}
?>
