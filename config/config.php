<?php
class Config
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";

    private $DB_NAME = "php-10";
    private $STUDENT_TABLE = "students";
    private $USER_TABLE = "users";
    private $DEPT_TABLE = "department";
    private $MEMBER_TABLE = "members";
    private $MEDIA_TABLE = "media";

    public $conn;

    public function connect()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME); // return bool

        return $this->conn;
    }

    public function insertStudent($name, $age, $course)
    {
        $this->connect();

        $query = "INSERT INTO $this->STUDENT_TABLE (name,age,course) VALUES('$name', $age, '$course');";


        $res = mysqli_query($this->conn, $query); //  return bool

        return $res;
    }

    public function fetchAllStudents()
    {
        $this->connect();

        $query = "SELECT * FROM $this->STUDENT_TABLE;";

        $res = mysqli_query($this->conn, $query); // return obj of mysqli_result class 

        return $res;
    }

    public function fetchSingleStudent($id)
    {
        $this->connect();

        $query = "SELECT * FROM $this->STUDENT_TABLE WHERE id=$id;";

        $res = mysqli_query($this->conn, $query); // return obj of mysqli_result class 

        return $res;
    }

    public function deleteStudent($id)
    {
        $this->connect();

        $result = $this->fetchSingleStudent($id);

        $data = mysqli_fetch_assoc($result);

        if ($data) {
            $query = "DELETE FROM $this->STUDENT_TABLE WHERE id=$id;";

            $res = mysqli_query($this->conn, $query); // return true / number of deleted record 1

            return $res;
        } else {
            return false;
        }

    }

    public function updateStudent($name, $age, $course, $id)
    {
        $this->connect();

        $result = $this->fetchSingleStudent($id);

        $data = mysqli_fetch_assoc($result);

        if ($data) {

            $query = "UPDATE $this->STUDENT_TABLE SET name='$name', age=$age, course='$course' WHERE id=$id;";


            $res = mysqli_query($this->conn, $query); //  return bool

            return $res;
        } else {
            return false;
        }

    }

    // Auth USER

    public function singUp($name, $email, $password)
    {
        $this->connect();

        // password_hash(raw_password, algoridhm)  return hased Password (string)
        $hased_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO $this->USER_TABLE (name,email,password) VALUES('$name', '$email', '$hased_password');";


        $res = mysqli_query($this->conn, $query); //  return bool

        return $res;
    }

    public function signIn($email, $password)
    {
        $this->connect();

        $query = "SELECT * FROM $this->USER_TABLE WHERE email='$email';";

        $res = mysqli_query($this->conn, $query);

        $result = mysqli_fetch_assoc($res);

        if ($result) {
            $hased_password = $result['password'];

            // password_verify(raw_password, hased_password)  return bool
            $passwordVerify = password_verify($password, $hased_password);

            return $passwordVerify;

        } else {
            return false;
        }
    }


    // Department Table

    public function insertDepartment($name)
    {
        $this->connect();

        $query = "INSERT INTO $this->DEPT_TABLE (name) VALUES('$name');";


        return mysqli_query($this->conn, $query); //  return bool
    }

    public function insertMembers($name, $dept_id)
    {
        $this->connect();

        $query = "INSERT INTO $this->MEMBER_TABLE (name,department_id) VALUES('$name', $dept_id);";


        return mysqli_query($this->conn, $query); //  return bool
    }


    // Media Table

    public function insertMedia($name)
    {
        $this->connect();

        $query = "INSERT INTO $this->MEDIA_TABLE (name) VALUES('$name');";


        $res = mysqli_query($this->conn, $query); //  return bool

        return $res;
    }

    public function fetchSingleMedia($id)
    {
        $this->connect();

        $query = "SELECT * FROM $this->MEDIA_TABLE WHERE id=$id;";

        $res = mysqli_query($this->conn, $query); // return obj of mysqli_result class 

        $record = mysqli_fetch_assoc($res);

        if ($record) {
            return $record;
        } else {
            return false;
        }
    }

    public function deleteMedia($id)
    {
        $this->connect();

        $record = $this->fetchSingleMedia($id);

        if ($record) {
            $file_name = $record['name'];

            $isMediaDeleted = unlink("../../upload/" . $file_name);

            if ($isMediaDeleted) {

                $query = "DELETE FROM $this->MEDIA_TABLE WHERE id=$id;";

                $res = mysqli_query($this->conn, $query); //  return bool

                return $res;
            } else {
                return false;
            }
        } else {
            return false;
        }


    }


}
?>