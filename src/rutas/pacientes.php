<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
    // json que debe recibir
    // {
    //     "nombre": "magic",
    //     "correo": "magic@gmail.com",
    //     "estado": "A",
    //     "fecha": "2019-09-27",
    //     "telefono" : "8555555",
    //     "ciudad": "pasto",
    //     "genero" : "M",
    //     "fechaNacimiento" : "1987-12-14",
    //     "domicilio": "calle siempre viva",
    //     "EPS": "saludmortal",
    //     "numIdentificacion": "987654321",
    //     "politicas": "wssswswsws",
    //     "foto": "fotomagic.jpg"
    // }
$app = new \Slim\App;

//Get todos pacientes
$app->get('/api/pacientes', function(Request $request, Response $response){

    $consulta = "SELECT * FROM pacientes;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $pacientes = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($pacientes);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get pacientes por id
$app->get('/api/pacientes/{id}', function(Request $request, Response $response){
    $estadoes = $request->getAttribute('id');
    $consulta = "SELECT * FROM pacientes WHERE id = $estadoes;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $pacientes = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($pacientes);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo pacientes
$app->post('/api/pacientes/nuevo', function(Request $request, Response $response){

    $nombre = $request->getParam('nombre');
    $correo = $request->getParam('correo');
    $estado = $request->getParam('estado');
    $fecha = $request->getParam('fecha');
    $telefono = $request->getParam('telefono');
    $ciudad = $request->getParam('ciudad');
    $genero = $request->getParam('genero');
    $fechaNacimiento = $request->getParam('fechaNacimiento');
    $domicilio = $request->getParam('domicilio');
    $EPS = $request->getParam('EPS');
    $numIdentificacion = $request->getParam('numIdentificacion');
    $politicas = $request->getParam('politicas');
    $foto = $request->getParam('foto');
    
    
    $consulta = "INSERT INTO pacientes (nombre, correo, estado, fecha, telefono, ciudad, genero, fechaNacimiento, domicilio, EPS, numIdentificacion, politicas, foto) VALUES 
    (:nombre, :correo, :estado, :fecha, :telefono, :ciudad, :genero, :fechaNacimiento, :domicilio, :EPS, :numIdentificacion, :politicas, :foto)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':nombre', $nombre ); 
        $resultado->bindParam(':correo', $correo ); 
        $resultado->bindParam(':estado', $estado ); 
        $resultado->bindParam(':fecha', $fecha ); 
        $resultado->bindParam(':telefono', $telefono ); 
        $resultado->bindParam(':ciudad', $ciudad ); 
        $resultado->bindParam(':genero', $genero ); 
        $resultado->bindParam(':fechaNacimiento', $fechaNacimiento ); 
        $resultado->bindParam(':domicilio', $domicilio ); 
        $resultado->bindParam(':EPS', $EPS ); 
        $resultado->bindParam(':numIdentificacion', $numIdentificacion ); 
        $resultado->bindParam(':politicas', $politicas ); 
        $resultado->bindParam(':foto', $foto ); 
        
        $resultado->execute();
        echo json_encode("paciente guardado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar pacientes 
$app->put('/api/pacientes/modificar/{id}', function(Request $request, Response $response){
    $idpacientes = $request->getAttribute('id');

    $nombre = $request->getParam('nombre');
    $correo = $request->getParam('correo');
    $estado = $request->getParam('estado');
    $fecha = $request->getParam('fecha');
    $telefono = $request->getParam('telefono');
    $ciudad = $request->getParam('ciudad');
    $genero = $request->getParam('genero');
    $fechaNacimiento = $request->getParam('fechaNacimiento');
    $domicilio = $request->getParam('domicilio');
    $EPS = $request->getParam('EPS');
    $numIdentificacion = $request->getParam('numIdentificacion');
    $politicas = $request->getParam('politicas');
    $foto = $request->getParam('foto');
        
    $consulta = "UPDATE pacientes SET
       nombre = :nombre,
       correo = :correo,
       estado = :estado,
       fecha = :fecha,
       telefono = :telefono,
       ciudad = :ciudad,
       genero = :genero,
       fechaNacimiento = :fechaNacimiento,
       domicilio = :domicilio,
       EPS = :EPS,
       numIdentificacion = :numIdentificacion,
       politicas = :politicas,
       foto = :foto
       WHERE id = $idpacientes";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->bindParam(':nombre', $nombre ); 
        $resultado->bindParam(':correo', $correo ); 
        $resultado->bindParam(':estado', $estado ); 
        $resultado->bindParam(':fecha', $fecha ); 
        $resultado->bindParam(':telefono', $telefono ); 
        $resultado->bindParam(':ciudad', $ciudad ); 
        $resultado->bindParam(':genero', $genero ); 
        $resultado->bindParam(':fechaNacimiento', $fechaNacimiento ); 
        $resultado->bindParam(':domicilio', $domicilio ); 
        $resultado->bindParam(':EPS', $EPS ); 
        $resultado->bindParam(':numIdentificacion', $numIdentificacion ); 
        $resultado->bindParam(':politicas', $politicas ); 
        $resultado->bindParam(':foto', $foto ); 
        
        $resultado->execute();
        echo json_encode("paciente modificado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// nombre`, `correo`, `estado`, `fecha`, `ciudad`, `estado`, `genero`, `param`, `fechaNacimiento`, `telefono
$app->delete('/api/pacientes/eliminar/{id}', function(Request $request, Response $response){
    $estadoes = $request->getAttribute('id');
       $consulta = "DELETE FROM pacientes
       WHERE id = $estadoes";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("pacientes eliminado");
        }else{
            echo json_encode("no existe pacientes con este ID");
        }

        $resultado = null;
        $db = null;

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

?>