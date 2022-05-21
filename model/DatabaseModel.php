<?php
    class database{
        private $conn;
        private $host_name;
        private $user_name;
        private $password;
        private $database_name;
        
        public function __construct($hostName, $userName, $pass, $databaseName)
        {
            $this->host_name = $hostName;
            $this->user_name = $userName;
            $this->password = $pass;
            $this->database_name = $databaseName;
        }

        // hàm kết nối
        public function connect(){
            if(!$this->conn){
                $this->conn = mysqli_connect($this->host_name, $this->user_name, $this->password, $this->database_name) or die('lỗi kết nối');
            }

            //xử lí tránh lỗi font tiếng việt
            mysqli_query($this->conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

        }

        // hàm ngắt kết nối
        public function dis_connect(){
            if($this->conn){
                mysqli_close($this->conn);
            }
        }

        // hàm thêm
        public function insert($table, $data){
            // kết nối
            $this->connect();
            // lưu trữ danh sách field
            $field_list = '';
            // lưu trữ danh sách giá trị tương ứng với field
            $value_list = '';

            // lặp qua data
            foreach($data as $key => $value){
                $field_list .= ",$key";
                $value_list .= ",$value";
            }
            // vì sau vòng lặp các biến $field_list và $value_list sẽ thừa 1 dấu ,
            // dùng hàm trim để xóa đi
            $sql = 'INSERT INTO'.$table.'('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
            return mysqli_query($this->conn, $sql);
        }   


        // hàm cập nhật
        public function update($table, $data, $where){
            // kết nối
            $this->connect();

            $sql = '';

            // lặp qua data
            foreach($data as $key => $value){
                $sql .= "$key  =  $value";
                /* $sql .= "$key = ". (string)mysql_escape_string($value) . ','; */
            }

            $sql = 'UPDATE'.$table.' SET '.trim($sql, ',').' WHERE '.$where;
            return mysqli_query($this->conn, $sql);
        }

        // hàm xóa
        public function remove($table, $where){
            //kết nối
            $this->connect();

            //delete
            $sql = "DELETE FROM $table WHERE $where";
            return mysqli_query($this->conn, $sql);
        }

        // hàm lấy danh sách
        public function get_list($sql){
            // Kết nối
            $this->connect();

            $result = mysqli_query($this->conn, $sql);

            if(!$result){
                die('Câu truy vấn bị sai');
            }

            $return = [];

            // Lặp qua kết quả để đưa vào mảng
            while ($row = mysqli_fetch_assoc($result)){
                $return[] = $row;
            }
 
            // Xóa kết quả khỏi bộ nhớ
            mysqli_free_result($result);
        
            return $return;
        }

        // Hàm lấy 1 record trong th lấy chi tiết tin
        public function get_row($sql){
            // Kết nối
            $this->connect();
        
            $result = mysqli_query($this->conn, $sql);
        
            if (!$result){
                die ('Câu truy vấn bị sai');
            }
        
            $row = mysqli_fetch_assoc($result);
        
            // Xóa kết quả khỏi bộ nhớ
            mysqli_free_result($result);
        
            if ($row){
                return $row;
            }
            return false;
        }
}
?>