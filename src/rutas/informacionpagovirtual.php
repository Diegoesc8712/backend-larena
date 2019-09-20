<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

//Get todos informacionpagovirtual
$app->get('/api/informacionpagovirtual', function(Request $request, Response $response){
    $consulta = "SELECT * FROM informacionpagovirtual;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $informacionpagovirtual = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($informacionpagovirtual);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get informacionpagovirtual por id
$app->get('/api/informacionpagovirtual/{id}', function(Request $request, Response $response){
    $idinformacionpagovirtual = $request->getAttribute('id');
    $consulta = "SELECT * FROM informacionpagovirtual WHERE id = $idinformacionpagovirtual;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $informacionpagovirtual = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($informacionpagovirtual);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo informacionpagovirtual
$app->post('/api/informacionpagovirtual/nuevo', function(Request $request, Response $response){
    $entidadPago = $request->getParam('entidadPago');
    $link = $request->getParam('link');
    
    $consulta = "INSERT INTO informacionpagovirtual (entidadPago, link) VALUES 
    (:entidadPago, :link)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);

        $resultado->bindParam(':entidadPago', $entidadPago ); 
        $resultado->bindParam(':link', $link ); 
        
        $resultado->execute();
        echo json_encode("informacion pago virtual guardado");
        $resultado = null;
        $db = null;

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar informacionpagovirtual 
$app->put('/api/informacionpagovirtual/modificar/{id}', function(Request $request, Response $response){
    $idinformacionpagovirtual = $request->getAttribute('id');
    $entidadPago = $request->getParam('entidadPago');
    $link = $request->getParam('link');
        
    $consulta = "UPDATE informacionpagovirtual SET
       entidadPago = :entidadPago,
       link = :link
       WHERE id = $idinformacionpagovirtual";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);

        $resultado->bindParam(':entidadPago', $entidadPago ); 
        $resultado->bindParam(':link', $link ); 
                
        $resultado->execute();
        echo json_encode("informacion pago virtual modificado");
        $resultado = null;
        $db = null;

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
$app->delete('/api/informacionpagovirtual/eliminar/{id}', function(Request $request, Response $response){
    $idinformacionpagovirtual = $request->getAttribute('id');
       $consulta = "DELETE FROM informacionpagovirtual
       WHERE id = $idinformacionpagovirtual";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("informacion pago virtual eliminado");
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