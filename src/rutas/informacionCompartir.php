<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// json que debe recibir
// {
//     "archivo": "archivo",
//     "url": "archivo.pdf",
//     "titulo": "archivo1",
//     "descripcion": "archivo1",
//     "param": "-",
//     "fecha": "2019-09-23"
   
// }
$app = new \Slim\App;

//Get todos informacionCompartir
$app->get('/api/informacionCompartir', function(Request $request, Response $response){

    $consulta = "SELECT * FROM informacionCompartir;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $informacionCompartir = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($informacionCompartir);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get informacionCompartir por id
$app->get('/api/informacionCompartir/{id}', function(Request $request, Response $response){
    $idinformacionCompartir = $request->getAttribute('id');
    $consulta = "SELECT * FROM informacionCompartir WHERE id = $idinformacionCompartir;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $informacionCompartir = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($informacionCompartir);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo informacionCompartir
$app->post('/api/informacionCompartir/nuevo', function(Request $request, Response $response){
    $archivo = $request->getParam('archivo');
    $url = $request->getParam('url');
    $titulo = $request->getParam('titulo');
    $descripcion = $request->getParam('descripcion');
    $param = $request->getParam('param');
    $fecha = $request->getParam('fecha');
    
    $consulta = "INSERT INTO informacionCompartir (archivo, url, titulo, descripcion, param, fecha) VALUES 
    (:archivo, :url, :titulo, :descripcion, :param, :fecha)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);

        $resultado->bindParam(':archivo', $archivo ); 
        $resultado->bindParam(':url', $url ); 
        $resultado->bindParam(':titulo', $titulo ); 
        $resultado->bindParam(':descripcion', $descripcion ); 
        $resultado->bindParam(':param', $param ); 
        $resultado->bindParam(':fecha', $fecha ); 
                
        $resultado->execute();
        echo json_encode("informacion Compartir guardada");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar informacionCompartir 
$app->put('/api/informacionCompartir/modificar/{id}', function(Request $request, Response $response){
    $idinformacionCompartir = $request->getAttribute('id');
    $archivo = $request->getParam('archivo');
    $url = $request->getParam('url');
    $titulo = $request->getParam('titulo');
    $descripcion = $request->getParam('descripcion');
    $param = $request->getParam('param');
    $fecha = $request->getParam('fecha');
    
    $consulta = "UPDATE informacionCompartir SET
       archivo = :archivo,
       url = :url,
       titulo = :titulo,
       descripcion = :descripcion,
       param = :param,
       fecha = :fecha
       WHERE id = $idinformacionCompartir";


    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':archivo', $archivo ); 
        $resultado->bindParam(':url', $url ); 
        $resultado->bindParam(':titulo', $titulo ); 
        $resultado->bindParam(':descripcion', $descripcion ); 
        $resultado->bindParam(':param', $param ); 
        $resultado->bindParam(':fecha', $fecha ); 
        
        $resultado->execute();
        echo json_encode("informacion Compartir modificado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// archivo`, `url`, `titulo`, `Param`, `tipo`, `tiempoSesion`, `param`
$app->delete('/api/informacionCompartir/eliminar/{id}', function(Request $request, Response $response){
    $idinformacionCompartir = $request->getAttribute('id');
       $consulta = "DELETE FROM informacionCompartir
       WHERE id = $idinformacionCompartir";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("informacion Compartir eliminado");
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