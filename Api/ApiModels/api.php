<?php
    include '../../Configurations/Database/config.php';
    
    class user {
    
        public $conn;
        public $user_id;
        public $public_id;
        public $username;
        public $user_email;
        public $password;
        public $registration_date;        
        
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
                $public_id = time();
                $username = $this->username;
                $user_email = $this->user_email;
                $password = password_hash($this->password, PASSWORD_DEFAULT);
                $occupation = $this->occupation;
                $gender = $this->gender;
                $dateofbirth = $this->dateofbirth;

                if ($public_id == "") { echo json_encode(array("alert"=>"Unavailable public_id")); }
                elseif ($username == "") { echo json_encode(array("alert"=>"Unavailable username")); }
                elseif ($user_email == "") { echo json_encode(array("alert"=>"Unavailable user_email")); }
                elseif ($password == "") { echo json_encode(array("alert"=>"Unavailable password")); }
                elseif ($occupation == "") { echo json_encode(array("alert"=>"Unavailable occupation")); }
                elseif ($gender == "") { echo json_encode(array("alert"=>"Unavailable gender")); }
                elseif ($dateofbirth == "") { echo json_encode(array("alert"=>"Unavailable dateofbirth")); }
                else {
                    $stmt = $this->conn->prepare("INSERT INTO users(public_id, username, user_email, password, occupation, gender, dateofbirth) VALUES(:public_id, :username, :user_email, :password, :occupation, :gender, :dateofbirth)");
                    $stmt->bindparam("public_id", $public_id); 
                    $stmt->bindparam("username", $username);
                    $stmt->bindparam("user_email", $user_email);
                    $stmt->bindparam("password", $password);
                    $stmt->bindparam("occupation", $occupation);
                    $stmt->bindparam("gender", $gender);
                    $stmt->bindparam("dateofbirth", $dateofbirth);
                    
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
                $public_id = $this->public_id;
                
                $stmt = $this->conn->prepare("SELECT `users`.`public_id`, `users`.`username`, `users`.`user_email`, `users`.`password`, `users`.`registration_date` FROM users");
                if($stmt->execute()) {
                    $num = $stmt->rowCount();
                    if($num > 0) {
                        $args = array();
                        $args['all_user_data'] = array();
                       
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);

                            $items = array("status" => "200", "public_id" => $public_id, "username" => $username, "user_email" => $user_email, "password" => $password);

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
                $public_id = $this->public_id;
                
                $stmt = $this->conn->prepare("SELECT `users`.`public_id`, `users`.`username`, `users`.`user_email`, `users`.`password`, `users`.`registration_date` FROM users WHERE `users`.`public_id`='$public_id' ");
                if($stmt->execute()) {
                    $num = $stmt->rowCount();
                    if($num > 0) {
                        $args = array();
                        $args['single_user'] = array();
                       
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);

                            $items = array("status" => "200", "public_id" => $public_id, "username" => $username, "user_email" => $user_email, "password" => $password);

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
                $public_id = $this->public_id;
                $username = $this->username;
                $user_email = $this->user_email;
                $password = password_hash($this->password, PASSWORD_DEFAULT);
                
                $stmt = $this->conn->prepare("UPDATE `users` SET `users`.`username` = :username, `users`.`user_email` = :user_email, `users`.`password` = :password WHERE `users`.`public_id` = :public_id ");
                $stmt->bindparam("public_id", $public_id);
                $stmt->bindparam("username", $username);
                $stmt->bindparam("user_email", $user_email);
                $stmt->bindparam("password", $password);
                
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
                $public_id = $this->public_id;
                
                $stmt = $this->conn->prepare("DELETE FROM `users` WHERE `users`.`public_id` = :public_id ");
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