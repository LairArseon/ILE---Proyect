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

    public static function modifyProfile($datos)
    {
        // print_r($datos);
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        foreach($datos as $campo => $valor){
            if ($campo != 'user_id'){
                $query = "UPDATE tUser SET $campo = '$valor' where user_id = '{$datos['user_id']}'";
                $result = mysqli_query($conn, $query);  
            }
        }   
    }

    public function display_profile($mail)
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT * from tUser where user_mail = '$mail'";

        $result = mysqli_query($conn, $query);

        if ($data = $result->fetch_array(MYSQLI_ASSOC)){
            
            // var_dump($data);

            ?>
            <form action="" method='POST'>
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" alt='Relleno' src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?= $data['user_name'] ?></span><span class="text-black-50"><?= $mail ?></span><span> </span></div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" name='edit' type="submit">Save Profile</button></div>
                        <input type="hidden" name="id" value="<?= $data['user_id'] ?>">
                    </div>
                    <div class="col-md-8 border-right">
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Perfil personal</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Nombre</label>
                                <input type="text" class="form-control" name='nombre' placeholder="Nombre" value="<?= $data['user_name'] ?>"></div>
                                <div class="col-md-6"><label class="labels">Apellidos</label>
                                <input type="text" class="form-control" name='apellidos' value="<?= $data['user_last_name'] ?>" placeholder="Apellidos"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Telefono</label>
                                <input type="text" class="form-control" name='telefono' placeholder="Telefono" value="<?= $data['user_phone'] ?>"></div>
                                <div class="col-md-12 mt-3"><label class="labels">Direccion</label>
                                <input type="text" class="form-control" name='direccion' placeholder="Direccion" value="<?= $data['user_address'] ?>"></div>
                                <div class="col-md-12 mt-3"><label class="labels">CCPP</label>
                                <input type="text" class="form-control" name='ccpp' placeholder="Codigo Postal" value="<?= $data['user_post_code'] ?>"></div>
                                <div class="col-md-12 mt-3"><label class="labels">Email</label>
                                <input type="text" class="form-control" name='email' placeholder="email" value="<?= $data['user_mail'] ?>"></div>
                                <div class="col-md-12 mt-3"><label class="labels">Detalles</label>
                                <input type="text" class="form-control" name='detalles' placeholder="details" value="<?= $data['user_details'] ?>"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Contraseña</label>
                                <input type="password" class="form-control" name='password' placeholder="contraseña" value="<?= $data['user_pw'] ?>"></div>
                                <div class="col-md-6"><label class="labels">Rol</label>
                                    <select class="form-control" name='rol' value="<?= $data['user_role'] ?>">
                                    <option value="dev">Desarrollador</option>
                                    <option value="admin">Administrador</option>
                                    <option value="student">Estudiante</option>
                                    <option value="teacher">Profesor</option>
                                    </select>
                                </div>
                            

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        <?php
        }

        else return(false);

        $result->close();
        $conn->close();


    }

}