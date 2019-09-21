<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
    // json que debe recibir
    // {
    //     "idtipoCita": "2",
    //     "idPaciente": "2",
    //     "idDoctor": "2",
    //     "fecha": "2019-09-22",
    //     "hora": "11:00:00",
    //     "estado": "A",
    //     "formaPago" : "T",
    //     "param": "-",
    //     "fechaSolicitud" : "2019-09-18 06:21:12",
    //     "tipoCita" : "psicologia"
    // }
$app = new \Slim\App;

//Get todos citas
$app->get('/api/citas', function(Request $request, Response $response){

    $consulta = "SELECT * FROM citas;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $citas = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($citas);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get citas por id
$app->get('/api/citas/{id}', function(Request $request, Response $response){
    $idcitas = $request->getAttribute('id');
    $consulta = "SELECT * FROM citas WHERE id = $idcitas;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $citas = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($citas);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo citas
$app->post('/api/citas/nueva', function(Request $request, Response $response){

    $idtipoCita = $request->getParam('idtipoCita');
    $idPaciente = $request->getParam('idPaciente');
    $idDoctor = $request->getParam('idDoctor');
    $fecha = $request->getParam('fecha');
    $hora = $request->getParam('hora');
    $estado = $request->getParam('estado');
    $formaPago = $request->getParam('formaPago');
    $param = $request->getParam('param');
    $fechaSolicitud = $request->getParam('fechaSolicitud');
    $tipoCita = $request->getParam('tipoCita');
    
    $consulta = "INSERT INTO citas (idtipoCita, idPaciente, idDoctor, fecha, hora, estado, formaPago, param, fechaSolicitud, tipoCita) VALUES 
    (:idtipoCita, :idPaciente, :idDoctor, :fecha, :hora, :estado, :formaPago, :param, :fechaSolicitud, :tipoCita)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
    
        $resultado->bindParam(':idtipoCita', $idtipoCita ); 
        $resultado->bindParam(':idPaciente', $idPaciente ); 
        $resultado->bindParam(':idDoctor', $idDoctor ); 
        $resultado->bindParam(':fecha', $fecha ); 
        $resultado->bindParam(':hora', $hora ); 
        $resultado->bindParam(':estado', $estado ); 
        $resultado->bindParam(':formaPago', $formaPago ); 
        $resultado->bindParam(':param', $param ); 
        $resultado->bindParam(':fechaSolicitud', $fechaSolicitud ); 
        $resultado->bindParam(':tipoCita', $tipoCita ); 
        
        $resultado->execute();
        echo json_encode("cita guardado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar citas 
$app->put('/api/citas/modificar/{id}', function(Request $request, Response $response){
    $idcitas = $request->getAttribute('id');
    
    $idtipoCita = $request->getParam('idtipoCita');
    $idPaciente = $request->getParam('idPaciente');
    $idDoctor = $request->getParam('idDoctor');
    $fecha = $request->getParam('fecha');
    $hora = $request->getParam('hora');
    $estado = $request->getParam('estado');
    $formaPago = $request->getParam('formaPago');
    $param = $request->getParam('param');
    $fechaSolicitud = $request->getParam('fechaSolicitud');
    $tipoCita = $request->getParam('tipoCita');
    
    $consulta = "UPDATE citas SET
       idtipoCita = :idtipoCita,
       idPaciente = :idPaciente,
       idDoctor = :idDoctor,
       fecha = :fecha,
       hora = :hora,
       estado = :estado,
       formaPago = :formaPago,
       param = :param,
       fechaSolicitud = :fechaSolicitud,
       tipoCita = :tipoCita
       WHERE id = $idcitas";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':idtipoCita', $idtipoCita ); 
        $resultado->bindParam(':idPaciente', $idPaciente ); 
        $resultado->bindParam(':idDoctor', $idDoctor ); 
        $resultado->bindParam(':fecha', $fecha ); 
        $resultado->bindParam(':hora', $hora ); 
        $resultado->bindParam(':estado', $estado ); 
        $resultado->bindParam(':formaPago', $formaPago ); 
        $resultado->bindParam(':param', $param ); 
        $resultado->bindParam(':fechaSolicitud', $fechaSolicitud ); 
        $resultado->bindParam(':tipoCita', $tipoCita ); 
        
        $resultado->execute();
        echo json_encode("cita modificada");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// idtipoCita`, `idPaciente`, `idDoctor`, `fecha`, `hora`, `estado`, `formaPago`, `param`, `fechaSolicitud`, `tipoCita
$app->delete('/api/citas/eliminar/{id}', function(Request $request, Response $response){
    $idcitas = $request->getAttribute('id');
       $consulta = "DELETE FROM citas
       WHERE id = $idcitas";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("cita eliminada");
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