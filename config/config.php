<?php
class Config
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";

    private $DB_NAME = "php-10";

    public $conn;

    public function connect()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME); // return bool

        return $this->conn;
    }

    public function insertStudent($name, $age, $course)
    {
        $this->connect();

        $query = "INSERT INTO students (name,age,course) VALUES('$name', $age, '$course');";


        $res = mysqli_query($this->conn, $query); //  return bool

        return $res;
    }

    public function fetchAllStudents()
    {
        $this->connect();

        $query = "SELECT * FROM students;";

        $res = mysqli_query($this->conn, $query); // return obj of mysqli_result class 

        return $res;
    }

    public function fetchSingleStudent($id)
    {
        $this->connect();

        $query = "SELECT * FROM students WHERE id=$id;";

        $res = mysqli_query($this->conn, $query); // return obj of mysqli_result class 

        return $res;
    }

    public function deleteStudent($id)
    {
        $this->connect();

        $result = $this->fetchSingleStudent($id);

        $data = mysqli_fetch_assoc($result);

        if ($data) {
            $query = "DELETE FROM students WHERE id=$id;";

            $res = mysqli_query($this->conn, $query); // return true / number of deleted record 1

            return $res;
        } else {
            return false;
        }

    }

    public function updateStudent($name, $age, $course, $id)
    {
        $this->connect();

        $query = "UPDATE students SET name='$name', age=$age, course='$course' WHERE id=$id;";


        $res = mysqli_query($this->conn, $query); //  return bool

        return $res;
    }
}
?>