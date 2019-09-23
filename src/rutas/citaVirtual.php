<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// json que debe recibir
// {
//     "idCita": "1",
//     "estado": "A",
//     "param": "-",
//     "fecha": "2019-09-23"
//     }

$app = new \Slim\App;

//Get todos citaVirtual
$app->get('/api/citaVirtual', function(Request $request, Response $response){

    $consulta = "SELECT * FROM citaVirtual;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $citaVirtual = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($citaVirtual);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get citaVirtual por id
$app->get('/api/citaVirtual/{id}', function(Request $request, Response $response){
    $idcitaVirtual = $request->getAttribute('id');
    $consulta = "SELECT * FROM citaVirtual WHERE id = $idcitaVirtual;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $citaVirtual = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($citaVirtual);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo citaVirtual
$app->post('/api/citaVirtual/nuevo', function(Request $request, Response $response){
    
    $idCita = $request->getParam('idCita');
    $estado = $request->getParam('estado');
    $param = $request->getParam('param');
    $fecha = $request->getParam('fecha');
    
    $consulta = "INSERT INTO citaVirtual (idCita, estado, param, fecha) VALUES 
    (:idCita, :estado, :param, :fecha)";

try{
    $db = new db();
    $db = $db->conectar();
    $resultado = $db->prepare($consulta);
    
    $resultado->bindParam(':idCita', $idCita ); 
    $resultado->bindParam(':estado', $estado ); 
    $resultado->bindParam(':param', $param ); 
    $resultado->bindParam(':fecha', $fecha ); 
    
    $resultado->execute();
    echo json_encode("cita Virtual guardado");
    $resultado = null;
    $db = null;
    
} catch (PDOException $e) {
    
    echo '{"error" : {"text":'.$e->getMessage().'}';
}
});

//modificar citaVirtual 
$app->put('/api/citaVirtual/modificar/{id}', function(Request $request, Response $response){
    // idCita`, `estado`, `param`, `fecha
    $idcitaVirtual = $request->getAttribute('id');
    
    $idCita = $request->getParam('idCita');
    $estado = $request->getParam('estado');
    $param = $request->getParam('param');
    $fecha = $request->getParam('fecha');
    
    $consulta = "UPDATE citaVirtual SET
       idCita = :idCita,
       estado = :estado,
       param = :param,
       fecha = :fecha
       WHERE id = $idcitaVirtual";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':idCita', $idCita ); 
        $resultado->bindParam(':estado', $estado ); 
        $resultado->bindParam(':param', $param ); 
        $resultado->bindParam(':fecha', $fecha ); 
        
        $resultado->execute();
        echo json_encode("cita Virtual modificado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// idPaciente`, `idDoctor`, `idcita`, `diagnostico`, `recomendaciones`, `observaciones`, `param`
$app->delete('/api/citaVirtual/eliminar/{id}', function(Request $request, Response $response){
    $idcitaVirtual = $request->getAttribute('id');
       $consulta = "DELETE FROM citaVirtual
       WHERE id = $idcitaVirtual";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("cita Virtual eliminado");
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