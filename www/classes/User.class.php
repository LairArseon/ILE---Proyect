<?php


class User {

    protected $name;
    protected $role;

    public function __construct($name = '', $role = '')
    {
        $this->setName($name);
        $this->setRole($role);
    }

    public function setName ($name)
    {
        $this->name = $name;
    }

    public function getName () 
    {
        return $this->name;
    }

    public function setRole ($role)
    {
        $this->role = $role;
    }

    public function getRole ()
    {
        return $this->role;
    }

    public function tryLogin ($mail, $pw)
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT * from tUser where user_mail = '$mail' and user_pw = '$pw'";

        $result = mysqli_query($conn, $query);

        if ($data = $result->fetch_array(MYSQLI_ASSOC)){
            
            $this->setName($data['user_name']);
            $this->setRole($data['user_role']);

            return(true);

        }
        
        else return(false);

        $result->close();
        $conn->close();
    }

}