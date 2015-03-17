<?php

class Qry {
        
        private $db = array();
        private $connection;

        function __construct(){
				
				$this->db['host']            	= 'localhost';                 
                $this->db['user']             	= 'root';
                $this->db['password']         	= '';
                $this->db['db']                 = 'security';
                
                $this->connect();
        }
        
        /*
         * This private function is called from the above constructor and creates the actual database connection.
         * */
        private function connect(){
                $db = $this->db;
                $mysqli = new mysqli($db['host'], $db['user'], $db['password'], $db['db']);
                
                if ($mysqli->connect_error) {
                    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
                }
                
                $this->connection = $mysqli;
        }


        /*
         * This function takes an raw SQL query as a string.
         * 
         * Example: 'SELECT * FROM person WHERE id=1'
         * */
        public static function run_query($query){
        	$con = new self();
                return $con->connection->query($query);
        }
        
        
        /*
         * Function takes a SQL query as a string and returns an array
         * 
         * Example: 'SELECT * FROM person';
         * */
        public static function q($query){
        	$con = new self();
          	$result = $con->connection->query($query);
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        
        /*
         * This function takes an SQL query as a string and returns the last inserted id
         * 
         * Example: 'INSERT INTO person VALUES ('David', 'test@david.dk', '2013-09-15', 1)'
         * */
        public static function qId($query){
        	$con = new self();
            $result = $con->connection->query($query);
            return $con->connection->insert_id;
        }
        
        
        public function free_result($result){
                $result->free();
        }
        public function close_connection($con){
                $con->close();
        }
        
}



