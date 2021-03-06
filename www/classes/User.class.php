<?php


class User {

    protected $id;
    protected $name;
    protected $role;

    public function __construct($id = NULL, $name = '', $role = '')
    {
        $this->setId($id);
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

    public function getId ()
    {
        return $this->id;
    }

    private function setId($id)
    {
        $this->id = $id;
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
            $this->setId($data['user_id']);

            return(true);

        }

        else return(false);

        $result->close();
        $conn->close();
    }

    public static function registerUser ($name, $surname, $mail, $pw, $address, $ccpp, $phone, $details = '-', $role = '-')
    {
        $db = new ConnectorSQL;
        $con = $db->getCon();

        // prepare and bind
        $stmt = $con->prepare("INSERT INTO tUser (user_name, user_last_name, user_mail, user_pw, user_address, user_post_code, user_phone, user_details, user_role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssiiss", $name, $surname, $mail, $pw, $address, $ccpp, $phone, $details, $role);
        $stmt->execute();
    

    }

    public static function registerGroup ($idGrupo, $idAsig, $idProfe, $idAlumno)
    {
        $db = new ConnectorSQL;
        $con = $db->getCon();

        if ($idGrupo == 0)
        {
            $query = "SELECT max(group_id) as maxi from tGroup";
            $result = mysqli_query($con, $query);

            if ($data = $result->fetch_array(MYSQLI_ASSOC))
                $idGrupo = $data['maxi'] + 1;
        }

        // prepare and bind
        $stmt = $con->prepare("INSERT INTO tGroup (group_id, group_subject_id, group_handle, group_member) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $idGrupo, $idAsig, $idProfe, $idAlumno);

        return $stmt->execute();
    

    }

    public static function modifyProfile($datos)
    {
        // print_r($datos);
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        foreach($datos as $campo => $valor){
            if ($campo != 'user_id' || !((in_array($_SESSION['role'], ['student', 'teacher'])) && $campo == 'user_role')){
                $query = "UPDATE tUser SET $campo = '$valor' where user_id = '{$datos['user_id']}'";
                $result = mysqli_query($conn, $query);  
                if (!$result) 
                    return false;
            }
        }   
    }

    public static function listGroups ()
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT distinct group_id from tGroup";
        $result = mysqli_query($conn, $query);

        if ($rows = $result->fetch_all(MYSQLI_ASSOC))  
        {
            return $rows;
        }

    }

    public static function listTeachers ()
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT * from tUser where user_role = 'teacher'";
        $result = mysqli_query($conn, $query);

        if ($rows = $result->fetch_all(MYSQLI_ASSOC))  
        {
            return $rows;
        }

    }

    public static function listStudents ()
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT * from tUser where user_role = 'student'";
        $result = mysqli_query($conn, $query);

        if ($rows = $result->fetch_all(MYSQLI_ASSOC))  
        {
            return $rows;
        }

    }

    public static function listSubjects ()
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT * from tSubject";
        $result = mysqli_query($conn, $query);

        if ($rows = $result->fetch_all(MYSQLI_ASSOC))  
        {
            return $rows;
        }

    }

    public static function newGroup ()
    {
        ?>

        <!-- Section: Design Block -->
        <section class="container-sm text-center text-lg-start login-container">
        <form action="handin_group.php" method="POST">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 mt-4">

                    <h2>Grupo</h2>
                    <select name="group" id="group" class="form-select" required>
                        <option value="0">Nuevo</option>
                        <?php
                            $recursos = User::listGroups();
                            foreach ($recursos as $recurso)
                                echo "<option value='{$recurso['group_id']}'>{$recurso['group_id']}</option>";
                        ?>
                    </select>
                    <hr>
                    <h2>Asignatura</h2>
                    <select name="subject" id="subject" class="form-select" required>
                        <option value="" selected>Selecciona una</option>
                        <?php
                            $asignaturas = User::listSubjects();
                            foreach ($asignaturas as $asignatura)
                                echo "<option value='{$asignatura['subject_id']}'>{$asignatura['subject_name']}</option>";
                        ?>
                    </select>
                    <hr>
                    <h2>Profesor</h2>
                    <select name="handle" id="handle" class="form-select" required>
                        <option value="" selected>Selecciona uno</option>
                        <?php
                            $profesores = User::listTeachers();
                            foreach ($profesores as $profesor)
                                echo "<option value='{$profesor['user_id']}'>{$profesor['user_name']}</option>";
                        ?>
                    </select>
                    <hr>
                    <h2>Alumno</h2>
                    <select name="student" id="student" class="form-select" required>
                        <option value="" selected>Selecciona uno</option>
                        <?php
                            $alumnos = User::listStudents();
                            foreach ($alumnos as $alumno)
                                echo "<option value='{$alumno['user_id']}'>{$alumno['user_name']}</option>";
                        ?>
                    </select>
                    <hr>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary col-md-3">Crear Grupo</button>


                </div>
            </div>
        </form>
        </section>
        <!-- Section: Design Block -->

        <?php

    }

    public static function newUser ()
    {

        ?>
        <form action="handin_user.php" method='POST'>
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" alt='Relleno' src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"></span><span class="text-black-50"></span><span> </span></div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" name='edit' type="submit">Crear Usuario</button></div>
                        <input type="hidden" name="id" value="">
                    </div>
                    <div class="col-md-8 border-right">
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Perfil personal</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Nombre</label>
                                <input type="text" class="form-control" name='nombre' placeholder="Nombre" value="" required></div>
                                <div class="col-md-6"><label class="labels">Apellidos</label>
                                <input type="text" class="form-control" name='apellidos' value="" placeholder="Apellidos" required></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Telefono</label>
                                <input type="text" class="form-control" name='telefono' placeholder="Telefono" value="" required></div>
                                <div class="col-md-12 mt-3"><label class="labels">Direccion</label>
                                <input type="text" class="form-control" name='direccion' placeholder="Direccion" value="" required></div>
                                <div class="col-md-12 mt-3"><label class="labels">CCPP</label>
                                <input type="text" class="form-control" name='ccpp' placeholder="Codigo Postal" value="" required></div>
                                <div class="col-md-12 mt-3"><label class="labels">Email</label>
                                <input type="text" class="form-control" name='email' placeholder="email" value="" required></div>
                                <div class="col-md-12 mt-3"><label class="labels">Detalles</label>
                                <input type="text" class="form-control" name='detalles' placeholder="details" value=""></div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Contrase??a</label>
                                <input type="password" class="form-control" name='password' placeholder="contrase??a" value="" required></div>
                                
                                <div class="col-md-6"><label class="labels">Rol</label>
                                    <select class="form-control" name='rol' value="" <?=  in_array($_SESSION['role'], ['student', 'teacher']) ? 'disabled' : '' ?>>
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

    public function display_profile($id)
    {
        $connection = new ConnectorSQL();
        $conn = $connection->getCon();

        $query = "SELECT * from tUser where user_id = '$id'";

        $result = mysqli_query($conn, $query);

        if ($data = $result->fetch_array(MYSQLI_ASSOC)){
            
            // var_dump($data);

            ?>
            <form action="" method='POST'>
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" alt='Relleno' src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?= $data['user_name'] ?></span><span class="text-black-50"><?= $data['user_mail'] ?></span><span> </span></div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" name='edit' type="submit">Guardar Cambios</button></div>
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
                                <div class="col-md-6"><label class="labels">Contrase??a</label>
                                <input type="password" class="form-control" name='password' placeholder="contrase??a" value="<?= $data['user_pw'] ?>"></div>
                                
                                <div class="col-md-6"><label class="labels">Rol</label>
                                    <select class="form-control" name='rol' value="<?= $data['user_role'] ?>" <?=  in_array($_SESSION['role'], ['student', 'teacher']) ? 'disabled' : '' ?>>
                                    <option value="dev" <?= $data['user_role'] == 'dev' ? 'selected' : '' ?>>Desarrollador</option>
                                    <option value="admin" <?= $data['user_role'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                                    <option value="student" <?= $data['user_role'] == 'student' ? 'selected' : '' ?>>Estudiante</option>
                                    <option value="teacher" <?= $data['user_role'] == 'teacher' ? 'selected' : '' ?>>Profesor</option>
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