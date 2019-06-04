<?php
    include '../../Configurations/Database/config.php';
    include 'jwt.php';
    
    class Authentication {
    
        public $conn;
        public $gandertech_user_id;
        public $gandertech_public_id;
        public $gandertech_username;
        public $gandertech_password;
        
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

        public function generate_token() {
            try {
                $gandertech_username = $this->gandertech_username;
                $gandertech_password = $this->gandertech_password;
            
                $stmt = $this->conn->prepare("SELECT * FROM gandertech_users WHERE `gandertech_users`.`gandertech_username`='$gandertech_username' ");
                $stmt->execute(array(':gandertech_username'=>$gandertech_username));
                $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                if($stmt->rowCount() == 1) {
                    if ($userRow['gandertech_user_status'] == 0) {
                        echo json_encode(array("status"=>"200", "message"=>"user is not active."));
                    }else {
                        if (password_verify($gandertech_password, $userRow['gandertech_password'])) {
                            $paylod = [
                                'iat' => time(),
                                'iss' => 'localhost',
                                'exp' => time() + (15*60),
                                'gandertech_public_id' => $userRow['gandertech_public_id'],
                                'gandertech_private_ssl_key' => 'MIIEpQIBAAKCAQEA3Tz2mr7SZiAMfQyuvBjM9Oi..Z1BjP5CE/Wm/Rr500PRK+Lh9x5eJPo5CAZ3/ANBE0sTK0ZsDGMak2m1g7..3VHqIxFTz0Ta1d+NAjwnLe4nOb7/eEJbDPkk05ShhBrJGBKKxb8n104o/..PdzbFMIyNjJzBM2o5y5A13wiLitEO7nco2WfyYkQzaxCw0AwzlkVHiIyC..71pSzkv6sv+4IDMbT/XpCo8L6wTarzrywnQsh+etLD6FtTjYbbrvZ8RQM..Hg2qxraAV++HNBYmNWs0duEdjUbJK+ZarypXI9TtnS4o1Ckj7POfljiQI..IBAFyidxtqRQyv5KrDkbJ+q+rsJxQlaipn2M4lGuQJEfIxELFDyd3XpxP..Un/82NZNXlPmRIopXs2T91jiLZEUKQw+n73j26adTbteuEaPGSrTZxBLR..yssO0wWomUyILqVeti6AkL0NJAuKcucHGqWVgUIa4g1haE0ilcm6dWUDo..fd+PpzdCJf1s4NdUWKYV2GJcutGQb+jqT5DTUqAgST7N8M28rwjK6nVMI..BUpP0xpPnuYDyPOw6x4hBt8DZQYyduzIXBXRBKNiNdv8fum68/5klHxp6..4HRkMUL958UVeljUsTBFQlO9UCgYEA/VqzXVzlz8K36VSTMPEhB5zBATV..PRiXtYK1YpYV4/jSUjvvT4hP8uoYNC+BlEMi98LtnxZIh0V4rqHDsScAq..VyeSLH0loKMZgpwFEmbEIDnEOD0nKrfT/9K9sPYgvB43wsLEtUujaYw3W..Liy0WKmB8CgYEA34xn1QlOOhHBn9Z8qYjoDYhvcj+a89tD9eMPhesfQFw..rsfGcXIonFmWdVygbe6Doihc+GIYIq/QP4jgMksE1ADvczJSke92ZfE2i..fitBpQERNJO0BlabfPALs5NssKNmLkWS2U2BHCbv4DzDXwiQB37KPOL1c..kBHfF2/htIs20d1UVL+PK+aXKwguI6bxLGZ3of0UH+mGsSl0mkp7kYZCm..OTQtfeRqP8rDSC7DgAkHc5ajYqh04AzNFaxjRo+M3IGICUaOdKnXd0Fda..QwfoaX4QlRTgLqb7ANZTzM9WbmnYoXrx17kZlT3lsCgYEAm757XI3WJVj..WoLj1+v48WyoxZpcaiuv9bT4Cj+lXRS+gdKHK+SH7J3x2CRHVS+WH/SVC..DxuybvebDoT0TkKiCjBWQaGzCaJqZa+POHK0klvS+9ln0/6k539p95tfX..X4TCzbVG6+gJiX0yszYfehn5MCgYEAkMiKuWHCsVyCab3RUf6XA9gd3qY..fCTIGtS1tR5PgFIV+GengiVoWchkj8SBHZz1n1xLN7KDf8ySU06MDggB..hJ+gXJKy+gf3mF5KmjDtkpjGHQzPF6vOe907y5NQLvVFGXUq/FIJZxB8k.fJdHEm2M4'
                            ];

                            $jwt = JWT::encode($paylod, "gandertech_secret_key");
                            echo json_encode(array("status"=>"Login successful", "jwt" => $jwt));
                        }else {
                            echo json_encode(array("status"=>"200", "message"=>"Password is not correct."));
                        }
                    }
                }else {
                   echo json_encode(array("status"=>"404", "message"=>"no records found"));
                }
            } catch (Exception $e) {
                
            }
        }

        public function single_get() {
        //get database values from table
            try {
                $id = $this->id;
                
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE id='1' ");
                if($stmt->execute()) {
                    $num = $stmt->rowCount();
                    if($num > 0) {
                        $args = array();
                        $args['singleData'] = array();
                       
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);

                            $items = array("status" => "200", "id" => $id, "sname" => $sname, "password" => $spassword
                            );

                            array_push($args['singleData'], $items);
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
        

    
    }
?>