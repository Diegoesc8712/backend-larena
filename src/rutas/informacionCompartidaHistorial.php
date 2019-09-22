<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
    // json que debe recibir
    // {
    //     "idHistorial": "2",
    //     "idInformacionCompartir": "2"
    //   }
$app = new \Slim\App;

//Get todos informacionCompartidaHistorial
$app->get('/api/informacionCompartidaHistorial', function(Request $request, Response $response){
    $consulta = "SELECT * FROM informacionCompartidaHistorial;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $informacionCompartidaHistorial = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($informacionCompartidaHistorial);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get informacionCompartidaHistorial por id
$app->get('/api/informacionCompartidaHistorial/{id}', function(Request $request, Response $response){
    $idinformacionCompartidaHistorial = $request->getAttribute('id');
    $consulta = "SELECT * FROM informacionCompartidaHistorial WHERE id = $idinformacionCompartidaHistorial;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $informacionCompartidaHistorial = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($informacionCompartidaHistorial);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo informacionCompartidaHistorial
$app->post('/api/informacionCompartidaHistorial/nuevo', function(Request $request, Response $response){
    $idHistorial = $request->getParam('idHistorial');
    $idInformacionCompartir = $request->getParam('idInformacionCompartir');
    
    $consulta = "INSERT INTO informacionCompartidaHistorial (idHistorial, idInformacionCompartir) VALUES 
    (:idHistorial, :idInformacionCompartir)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);

        $resultado->bindParam(':idHistorial', $idHistorial ); 
        $resultado->bindParam(':idInformacionCompartir', $idInformacionCompartir ); 
        
        $resultado->execute();
        echo json_encode("informacion Compartida Historial guardado");
        $resultado = null;
        $db = null;

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar informacionCompartidaHistorial 
$app->put('/api/informacionCompartidaHistorial/modificar/{id}', function(Request $request, Response $response){
    $idinformacionCompartidaHistorial = $request->getAttribute('id');
    $idHistorial = $request->getParam('idHistorial');
    $idInformacionCompartir = $request->getParam('idInformacionCompartir');
        
    $consulta = "UPDATE informacionCompartidaHistorial SET
       idHistorial = :idHistorial,
       idInformacionCompartir = :idInformacionCompartir
       WHERE id = $idinformacionCompartidaHistorial";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);

        $resultado->bindParam(':idHistorial', $idHistorial ); 
        $resultado->bindParam(':idInformacionCompartir', $idInformacionCompartir ); 
                
        $resultado->execute();
        echo json_encode("informacion Compartida Historial modificado");
        $resultado = null;
        $db = null;

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
$app->delete('/api/informacionCompartidaHistorial/eliminar/{id}', function(Request $request, Response $response){
    $idinformacionCompartidaHistorial = $request->getAttribute('id');
       $consulta = "DELETE FROM informacionCompartidaHistorial
       WHERE id = $idinformacionCompartidaHistorial";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("informacion Compartida Historial eliminado");
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