<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// json que debe recibir
// {
//     "idDoctor": "2",
//     "idtipoCita": "2",
//     "fechaInicial": "2019-09-24",
//     "horaInicial": "09:00",
//     "fechaFinal": "2019-09-24",
//     "horaFinal": "10:00"
   
// }
$app = new \Slim\App;

//Get todos disponibilidadagenda
$app->get('/api/disponibilidAdagenda', function(Request $request, Response $response){

    $consulta = "SELECT * FROM disponibilidadagenda;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $disponibilidadagenda = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($disponibilidadagenda);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get disponibilidadagenda por id
$app->get('/api/disponibilidAdagenda/{id}', function(Request $request, Response $response){
    $iddisponibilidadagenda = $request->getAttribute('id');
    $consulta = "SELECT * FROM disponibilidadagenda WHERE id = $iddisponibilidadagenda;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $disponibilidadagenda = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($disponibilidadagenda);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo disponibilidadagenda
$app->post('/api/disponibilidadAgenda/nuevo', function(Request $request, Response $response){

    $idDoctor = $request->getParam('idDoctor');
    $idtipoCita = $request->getParam('idtipoCita');
    $fechaInicial = $request->getParam('fechaInicial');
    $horaInicial = $request->getParam('horaInicial');
    $fechaFinal = $request->getParam('fechaFinal');
    $horaFinal = $request->getParam('horaFinal');
    
    $consulta = "INSERT INTO disponibilidadagenda (idDoctor, idtipoCita, fechaInicial, horaInicial, fechaFinal, horaFinal) VALUES 
    (:idDoctor, :idtipoCita, :fechaInicial, :horaInicial, :fechaFinal, :horaFinal)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);

        $resultado->bindParam(':idDoctor', $idDoctor ); 
        $resultado->bindParam(':idtipoCita', $idtipoCita ); 
        $resultado->bindParam(':fechaInicial', $fechaInicial ); 
        $resultado->bindParam(':horaInicial', $horaInicial ); 
        $resultado->bindParam(':fechaFinal', $fechaFinal ); 
        $resultado->bindParam(':horaFinal', $horaFinal ); 
                
        $resultado->execute();
        echo json_encode("disponibilid adagenda guardado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar disponibilidadagenda 
$app->put('/api/disponibilidadAgenda/modificar/{id}', function(Request $request, Response $response){
    $iddisponibilidadagenda = $request->getAttribute('id');
    $idDoctor = $request->getParam('idDoctor');
    $idtipoCita = $request->getParam('idtipoCita');
    $fechaInicial = $request->getParam('fechaInicial');
    $horaInicial = $request->getParam('horaInicial');
    $fechaFinal = $request->getParam('fechaFinal');
    $horaFinal = $request->getParam('horaFinal');
    
    $consulta = "UPDATE disponibilidadagenda SET
       idDoctor = :idDoctor,
       idtipoCita = :idtipoCita,
       fechaInicial = :fechaInicial,
       horaInicial = :horaInicial,
       fechaFinal = :fechaFinal,
       horaFinal = :horaFinal
       WHERE id = $iddisponibilidadagenda";


    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':idDoctor', $idDoctor ); 
        $resultado->bindParam(':idtipoCita', $idtipoCita ); 
        $resultado->bindParam(':fechaInicial', $fechaInicial ); 
        $resultado->bindParam(':horaInicial', $horaInicial ); 
        $resultado->bindParam(':fechaFinal', $fechaFinal ); 
        $resultado->bindParam(':horaFinal', $horaFinal ); 
        
        $resultado->execute();
        echo json_encode("disponibilidad agenda modificado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// idDoctor`, `idtipoCita`, `fechaInicial`, `Param`, `tipo`, `tiempoSesion`, `param`
$app->delete('/api/disponibilidadAgenda/eliminar/{id}', function(Request $request, Response $response){
    $iddisponibilidadagenda = $request->getAttribute('id');
       $consulta = "DELETE FROM disponibilidadagenda
       WHERE id = $iddisponibilidadagenda";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("disponibilidad agenda eliminado");
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