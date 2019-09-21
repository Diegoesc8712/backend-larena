<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// json que debe recibir
    // {
    //     "idPaciente": "2",
    //     "idDoctor": "2",
    //     "idcita": "2",
    //     "diagnostico": "Paciente con gripa",
    //     "recomendaciones": "No salir solo",
    //     "observaciones": "Estar pendientes",
    //     "param": "-"
    // }
$app = new \Slim\App;

//Get todos historialPacientes
$app->get('/api/historialPacientes', function(Request $request, Response $response){

    $consulta = "SELECT * FROM historialPacientes;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $historialPacientes = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($historialPacientes);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get historialPacientes por id
$app->get('/api/historialPacientes/{id}', function(Request $request, Response $response){
    $idhistorialPacientes = $request->getAttribute('id');
    $consulta = "SELECT * FROM historialPacientes WHERE id = $idhistorialPacientes;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $historialPacientes = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($historialPacientes);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo historialPacientes
$app->post('/api/historialPacientes/nuevo', function(Request $request, Response $response){
    $idPaciente = $request->getParam('idPaciente');
    $idDoctor = $request->getParam('idDoctor');
    $idcita = $request->getParam('idcita');
    $diagnostico = $request->getParam('diagnostico');
    $recomendaciones = $request->getParam('recomendaciones');
    $observaciones = $request->getParam('observaciones');
    $param = $request->getParam('param');
    
    $consulta = "INSERT INTO historialPacientes (idPaciente, idDoctor, idcita, diagnostico, recomendaciones, observaciones, param) VALUES 
    (:idPaciente, :idDoctor, :idcita, :diagnostico, :recomendaciones, :observaciones, :param)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':idPaciente', $idPaciente ); 
        $resultado->bindParam(':idDoctor', $idDoctor ); 
        $resultado->bindParam(':idcita', $idcita ); 
        $resultado->bindParam(':diagnostico', $diagnostico ); 
        $resultado->bindParam(':recomendaciones', $recomendaciones ); 
        $resultado->bindParam(':observaciones', $observaciones ); 
        $resultado->bindParam(':param', $param ); 
        
        $resultado->execute();
        echo json_encode("historial Pacientes guardado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar historialPacientes 
$app->put('/api/historialPacientes/modificar/{id}', function(Request $request, Response $response){
    $idhistorialPacientes = $request->getAttribute('id');

    $idPaciente = $request->getParam('idPaciente');
    $idDoctor = $request->getParam('idDoctor');
    $idcita = $request->getParam('idcita');
    $diagnostico = $request->getParam('diagnostico');
    $recomendaciones = $request->getParam('recomendaciones');
    $observaciones = $request->getParam('observaciones');
    $param = $request->getParam('param');
    
    $consulta = "UPDATE historialpacientes SET
       idPaciente = :idPaciente,
       idDoctor = :idDoctor,
       idcita = :idcita,
       diagnostico = :diagnostico,
       recomendaciones = :recomendaciones,
       observaciones = :observaciones,
       param = :param
       WHERE id = $idhistorialPacientes";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':idPaciente', $idPaciente ); 
        $resultado->bindParam(':idDoctor', $idDoctor ); 
        $resultado->bindParam(':idcita', $idcita ); 
        $resultado->bindParam(':diagnostico', $diagnostico ); 
        $resultado->bindParam(':recomendaciones', $recomendaciones ); 
        $resultado->bindParam(':observaciones', $observaciones ); 
        $resultado->bindParam(':param', $param ); 
        
        $resultado->execute();
        echo json_encode("historial Pacientes modificado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// idPaciente`, `idDoctor`, `idcita`, `diagnostico`, `recomendaciones`, `observaciones`, `param`
$app->delete('/api/historialPacientes/eliminar/{id}', function(Request $request, Response $response){
    $idhistorialPacientes = $request->getAttribute('id');
       $consulta = "DELETE FROM historialPacientes
       WHERE id = $idhistorialPacientes";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("historial paciente eliminado");
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