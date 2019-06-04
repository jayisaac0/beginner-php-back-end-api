<?php
    include '../../Configurations/Database/config.php';
    
    class user {
    
        public $conn;
        public $gandertech_user_id;
        public $gandertech_public_id;
        public $gandertech_username;
        public $gandertech_user_email;
        public $gandertech_password;
        public $gandertech_registration_date;        
        
        public function __construct() {
            // make connection to the database.
            $database = new database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }
        
        public function runQuery($sql) {
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        public function setUrl($setUrl) {
            return $setUrl;
        
        }

        public function setHeaders($setHeaders) {
            return $setHeaders;
        
        }

        public function httpRequest() {
        // make http request
        
        }
        
        public function socketRequest() {
        // make socket request
        
        }
        
        public function processRequest() {
        // determine suutable request and use it
        
        }

        public function createTable() {
            //create table if does not exist.
            try {    
                $stmt = $this->conn->prepare();
                if($stmt->execute()) {
                   echo json_encode(array("status"=>"200", "message"=>"successfuly created"));
                }
            }catch(PDOException $e) {
                echo json_encode(array("status"=>"501", "message"=>"Error: '.$e->getMessage().'"));
            }
        }
        
        public function post() {
        // insert data into table
            try {
                $gandertech_public_id = time();
                $gandertech_username = $this->gandertech_username;
                $gandertech_user_email = $this->gandertech_user_email;
                $gandertech_password = password_hash($this->gandertech_password, PASSWORD_DEFAULT);
                $gandertech_occupation = $this->gandertech_occupation;
                $gandertech_gender = $this->gandertech_gender;
                $gandertech_dateofbirth = $this->gandertech_dateofbirth;

                if ($gandertech_public_id == "") { echo json_encode(array("alert"=>"Unavailable gandertech_public_id")); }
                elseif ($gandertech_username == "") { echo json_encode(array("alert"=>"Unavailable gandertech_username")); }
                elseif ($gandertech_user_email == "") { echo json_encode(array("alert"=>"Unavailable gandertech_user_email")); }
                elseif ($gandertech_password == "") { echo json_encode(array("alert"=>"Unavailable gandertech_password")); }
                elseif ($gandertech_occupation == "") { echo json_encode(array("alert"=>"Unavailable gandertech_occupation")); }
                elseif ($gandertech_gender == "") { echo json_encode(array("alert"=>"Unavailable gandertech_gender")); }
                elseif ($gandertech_dateofbirth == "") { echo json_encode(array("alert"=>"Unavailable gandertech_dateofbirth")); }
                else {
                    $stmt = $this->conn->prepare("INSERT INTO gandertech_users(gandertech_public_id, gandertech_username, gandertech_user_email, gandertech_password, gandertech_occupation, gandertech_gender, gandertech_dateofbirth) VALUES(:gandertech_public_id, :gandertech_username, :gandertech_user_email, :gandertech_password, :gandertech_occupation, :gandertech_gender, :gandertech_dateofbirth)");
                    $stmt->bindparam("gandertech_public_id", $gandertech_public_id); 
                    $stmt->bindparam("gandertech_username", $gandertech_username);
                    $stmt->bindparam("gandertech_user_email", $gandertech_user_email);
                    $stmt->bindparam("gandertech_password", $gandertech_password);
                    $stmt->bindparam("gandertech_occupation", $gandertech_occupation);
                    $stmt->bindparam("gandertech_gender", $gandertech_gender);
                    $stmt->bindparam("gandertech_dateofbirth", $gandertech_dateofbirth);
                    
                    if($stmt->execute()) {
                        echo json_encode(array("status"=>"200", "message"=>"successful"));
                    }else {
                       echo json_encode(array("status"=>"500", "message"=>"error"));
                    }                    
                }

            }catch(PDOException $e){
                echo json_encode(array("status"=>"500", "message"=>"Error: ".$e->getMessage().""));
            }
        
        }
        
        public function get() {
        //get database values from table
            try {
                $gandertech_public_id = $this->gandertech_public_id;
                
                $stmt = $this->conn->prepare("SELECT `gandertech_users`.`gandertech_public_id`, `gandertech_users`.`gandertech_username`, `gandertech_users`.`gandertech_user_email`, `gandertech_users`.`gandertech_password`, `gandertech_users`.`gandertech_registration_date` FROM gandertech_users");
                if($stmt->execute()) {
                    $num = $stmt->rowCount();
                    if($num > 0) {
                        $args = array();
                        $args['all_user_data'] = array();
                       
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);

                            $items = array("status" => "200", "gandertech_public_id" => $gandertech_public_id, "gandertech_username" => $gandertech_username, "gandertech_user_email" => $gandertech_user_email, "gandertech_password" => $gandertech_password);

                            array_push($args['all_user_data'], $items);
                        }
                        echo json_encode($args);
                    }else {
                       echo json_encode(array("status"=>"404", "message"=>"no records found"));
                    }
                    
                }
            
            }catch(PDOException $e) {
                echo json_encode(array("status"=>"500", "message"=>"Error: ".$e->getMessage().""));
            }
        }

        public function single_get() {
        //get database values from table
            try {
                $gandertech_public_id = $this->gandertech_public_id;
                
                $stmt = $this->conn->prepare("SELECT `gandertech_users`.`gandertech_public_id`, `gandertech_users`.`gandertech_username`, `gandertech_users`.`gandertech_user_email`, `gandertech_users`.`gandertech_password`, `gandertech_users`.`gandertech_registration_date` FROM gandertech_users WHERE `gandertech_users`.`gandertech_public_id`='$gandertech_public_id' ");
                if($stmt->execute()) {
                    $num = $stmt->rowCount();
                    if($num > 0) {
                        $args = array();
                        $args['single_user'] = array();
                       
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);

                            $items = array("status" => "200", "gandertech_public_id" => $gandertech_public_id, "gandertech_username" => $gandertech_username, "gandertech_user_email" => $gandertech_user_email, "gandertech_password" => $gandertech_password);

                            array_push($args['single_user'], $items);
                        }
                        echo json_encode($args);
                    }else {
                       echo json_encode(array("status"=>"404", "message"=>"no records found"));
                    }
                    
                }
            
            }catch(PDOException $e) {
                echo json_encode(array("status"=>"500", "message"=>"Error: ".$e->getMessage().""));
            }
        }
        
        public function put() {
        // update database table
            try {
                $gandertech_public_id = $this->gandertech_public_id;
                $gandertech_username = $this->gandertech_username;
                $gandertech_user_email = $this->gandertech_user_email;
                $gandertech_password = password_hash($this->gandertech_password, PASSWORD_DEFAULT);
                
                $stmt = $this->conn->prepare("UPDATE `gandertech_users` SET `gandertech_users`.`gandertech_username` = :gandertech_username, `gandertech_users`.`gandertech_user_email` = :gandertech_user_email, `gandertech_users`.`gandertech_password` = :gandertech_password WHERE `gandertech_users`.`gandertech_public_id` = :gandertech_public_id ");
                $stmt->bindparam("gandertech_public_id", $gandertech_public_id);
                $stmt->bindparam("gandertech_username", $gandertech_username);
                $stmt->bindparam("gandertech_user_email", $gandertech_user_email);
                $stmt->bindparam("gandertech_password", $gandertech_password);
                
                if($stmt->execute()) {
                    $num = $stmt->rowCount();
                    if($num > 0) {
                        echo json_encode(array("status"=>"200", "message"=>"updated"));
                        }else {
                        echo json_encode(array("status"=>"500", "message"=>"Error: Duplicate record"));
                    }
                }
                //return $stmt;
            }catch(PDOException $e) {
                echo json_encode(array("status"=>"500", "message"=>"Error: ".$e->getMessage()." "));
                //echo $e->getMessage();
            }
        }
        
        public function delete(){
        // delete database row.
            try {
                $gandertech_public_id = $this->gandertech_public_id;
                
                $stmt = $this->conn->prepare("DELETE FROM `gandertech_users` WHERE `gandertech_users`.`gandertech_public_id` = :gandertech_public_id ");
                //$stmt->bindparam(":1", $id);
                if($stmt->execute()) {

                    $num = $stmt->rowCount();
                    if($num > 0) {
                        echo json_encode(array("status"=>"200", "message"=>"successfuly deleted"));
                        }else {
                        echo json_encode(array("status"=>"500", "message"=> "Error: Record not found"));
                    }
                    
                }
                //return $stmt;
            }catch(PDOException $e) {
                echo json_encode(array("status"=>"500", "message"=>"Error: ".$e->getMessage().""));
            }
        }
    
    }
?>