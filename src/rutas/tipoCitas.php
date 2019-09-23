<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// json que debe recibir
// {
//     "especialidad": "psicologia",
//     "cede": "bogota",
//     "valor": "150.000",
//     "Param": "-",
//     "tipo": "D",
//     "tiempoSesion": "01:00"
   
// }
$app = new \Slim\App;

//Get todos tipoCitas
$app->get('/api/tipoCitas', function(Request $request, Response $response){

    $consulta = "SELECT * FROM tipoCitas;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $tipoCitas = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($tipoCitas);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get tipoCitas por id
$app->get('/api/tipoCitas/{id}', function(Request $request, Response $response){
    $idtipoCitas = $request->getAttribute('id');
    $consulta = "SELECT * FROM tipoCitas WHERE id = $idtipoCitas;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $tipoCitas = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($tipoCitas);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo tipoCitas
$app->post('/api/tipoCitas/nuevo', function(Request $request, Response $response){

    $especialidad = $request->getParam('especialidad');
    $cede = $request->getParam('cede');
    $valor = $request->getParam('valor');
    $Param = $request->getParam('Param');
    $tipo = $request->getParam('tipo');
    $tiempoSesion = $request->getParam('tiempoSesion');
        
    $consulta = "INSERT INTO tipocitas (especialidad, cede, valor, Param, tipo, tiempoSesion) VALUES 
    (:especialidad, :cede, :valor, :Param, :tipo, :tiempoSesion)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':especialidad', $especialidad ); 
        $resultado->bindParam(':cede', $cede ); 
        $resultado->bindParam(':valor', $valor ); 
        $resultado->bindParam(':Param', $Param ); 
        $resultado->bindParam(':tipo', $tipo ); 
        $resultado->bindParam(':tiempoSesion', $tiempoSesion ); 
                
        $resultado->execute();
        echo json_encode("tipo Citas guardado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar tipoCitas 
$app->put('/api/tipoCitas/modificar/{id}', function(Request $request, Response $response){
    $idtipoCitas = $request->getAttribute('id');

    $especialidad = $request->getParam('especialidad');
    $cede = $request->getParam('cede');
    $valor = $request->getParam('valor');
    $Param = $request->getParam('Param');
    $tipo = $request->getParam('tipo');
    $tiempoSesion = $request->getParam('tiempoSesion');
    
    $consulta = "UPDATE tipoCitas SET
       especialidad = :especialidad,
       cede = :cede,
       valor = :valor,
       Param = :Param,
       tipo = :tipo,
       tiempoSesion = :tiempoSesion
       WHERE id = $idtipoCitas";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':especialidad', $especialidad ); 
        $resultado->bindParam(':cede', $cede ); 
        $resultado->bindParam(':valor', $valor ); 
        $resultado->bindParam(':Param', $Param ); 
        $resultado->bindParam(':tipo', $tipo ); 
        $resultado->bindParam(':tiempoSesion', $tiempoSesion ); 
        
        $resultado->execute();
        echo json_encode("tipo Citas modificado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// especialidad`, `cede`, `valor`, `Param`, `tipo`, `tiempoSesion`, `param`
$app->delete('/api/tipoCitas/eliminar/{id}', function(Request $request, Response $response){
    $idtipoCitas = $request->getAttribute('id');
       $consulta = "DELETE FROM tipoCitas
       WHERE id = $idtipoCitas";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("tipo Citas eliminado");
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