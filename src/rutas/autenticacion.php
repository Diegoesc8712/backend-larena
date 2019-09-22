<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// json que debe recibir
// {
//     "correo": "Alejolopez@gmail.com",
//     "contrasena": "987654",
//     "tipoUsuario": "paciente",
//     "idUsuario": "2",
//     "fechaActualizacion": "2019-09-11 09:23:22"
// }

$app = new \Slim\App;

//Get todos autenticacion
$app->get('/api/autenticacion', function(Request $request, Response $response){

    $consulta = "SELECT * FROM autenticacion;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $autenticacion = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($autenticacion);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get autenticacion por id
$app->get('/api/autenticacion/{id}', function(Request $request, Response $response){
    $idautenticacion = $request->getAttribute('id');
    $consulta = "SELECT * FROM autenticacion WHERE id = $idautenticacion;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $autenticacion = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($autenticacion);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo autenticacion
$app->post('/api/autenticacion/nuevo', function(Request $request, Response $response){
    $correo = $request->getParam('correo');
    $contrasena = $request->getParam('contrasena');
    $tipoUsuario = $request->getParam('tipoUsuario');
    $idUsuario = $request->getParam('idUsuario');
    $fechaActualizacion = $request->getParam('fechaActualizacion');
    
    $consulta = "INSERT INTO autenticacion (correo, contrasena, tipoUsuario, idUsuario, fechaActualizacion) VALUES 
    (:correo, :contrasena, :tipoUsuario, :idUsuario, :fechaActualizacion)";

try{
    $db = new db();
    $db = $db->conectar();
    $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':correo', $correo ); 
        $resultado->bindParam(':contrasena', $contrasena ); 
        $resultado->bindParam(':tipoUsuario', $tipoUsuario ); 
        $resultado->bindParam(':idUsuario', $idUsuario ); 
        $resultado->bindParam(':fechaActualizacion', $fechaActualizacion ); 
        
        $resultado->execute();
        echo json_encode("autenticación guardado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//modificar autenticacion 
$app->put('/api/autenticacion/modificar/{id}', function(Request $request, Response $response){
    $idautenticacion = $request->getAttribute('id');
    
    $correo = $request->getParam('correo');
    $contrasena = $request->getParam('contrasena');
    $tipoUsuario = $request->getParam('tipoUsuario');
    $idUsuario = $request->getParam('idUsuario');
    $fechaActualizacion = $request->getParam('fechaActualizacion');

    $consulta = "UPDATE autenticacion SET
       correo = :correo,
       contrasena = :contrasena,
       tipoUsuario = :tipoUsuario,
       idUsuario = :idUsuario,
       fechaActualizacion = :fechaActualizacion
       WHERE id = $idautenticacion";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':correo', $correo ); 
        $resultado->bindParam(':contrasena', $contrasena ); 
        $resultado->bindParam(':tipoUsuario', $tipoUsuario ); 
        $resultado->bindParam(':idUsuario', $idUsuario ); 
        $resultado->bindParam(':fechaActualizacion', $fechaActualizacion ); 
        
        $resultado->execute();
        echo json_encode("autenticacion modificado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// idPaciente`, `idDoctor`, `idcita`, `diagnostico`, `recomendaciones`, `observaciones`, `param`
$app->delete('/api/autenticacion/eliminar/{id}', function(Request $request, Response $response){
    $idautenticacion = $request->getAttribute('id');
       $consulta = "DELETE FROM autenticacion
       WHERE id = $idautenticacion";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("autenticacion eliminado");
        }else{
            echo json_encode("no existe informacion pago virtual con este ID");
        }

        $resultado = null;
        $db = null;

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

?>