<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
    // json que debe recibir
    // {
    //     "nombre": "magic",
    //     "correo": "magic@gmail.com",
    //     "estado": "A",
    //     "estadoVisible": "V",
    //     "foto": "fotomagic.jpg",
    //     "titulo" : "Siquiatra",
    //     "descripcion" : "master",
    //     "telefono" : "8555555",
    //     "numIdentificacion": "999999",
    //     "param": "-",
    //     "fecha": "2019-09-27",
    //     "tarjetaProfesional": "333333"
    // }
$app = new \Slim\App;

//Get todos doctores
$app->get('/api/doctores', function(Request $request, Response $response){

    $consulta = "SELECT * FROM doctores;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $doctores = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($doctores);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//Get doctores por id
$app->get('/api/doctores/{id}', function(Request $request, Response $response){
    $estadoes = $request->getAttribute('id');
    $consulta = "SELECT * FROM doctores WHERE id = $estadoes;";

    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $doctores = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($doctores);

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//crear nuevo doctores
$app->post('/api/doctores/nuevo', function(Request $request, Response $response){

    $nombre = $request->getParam('nombre');
    $correo = $request->getParam('correo');
    $estado = $request->getParam('estado');
    $estadoVisible = $request->getParam('estadoVisible');
    $foto = $request->getParam('foto');
    $titulo = $request->getParam('titulo');
    $descripcion = $request->getParam('descripcion');
    $telefono = $request->getParam('telefono');
    $numIdentificacion = $request->getParam('numIdentificacion');
    $param = $request->getParam('param');
    $fecha = $request->getParam('fecha');
    $tarjetaProfesional = $request->getParam('tarjetaProfesional');
        
    $consulta = "INSERT INTO doctores (nombre, correo, estado, estadoVisible, foto, titulo, descripcion, telefono, numIdentificacion, param, fecha, tarjetaProfesional) VALUES 
    (:nombre, :correo, :estado, :estadoVisible, :foto, :titulo, :descripcion, :telefono, :numIdentificacion, :param, :fecha, :tarjetaProfesional)";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':nombre', $nombre ); 
        $resultado->bindParam(':correo', $correo ); 
        $resultado->bindParam(':estado', $estado ); 
        $resultado->bindParam(':estadoVisible', $estadoVisible ); 
        $resultado->bindParam(':foto', $foto ); 
        $resultado->bindParam(':titulo', $titulo ); 
        $resultado->bindParam(':descripcion', $descripcion ); 
        $resultado->bindParam(':telefono', $telefono ); 
        $resultado->bindParam(':numIdentificacion', $numIdentificacion ); 
        $resultado->bindParam(':param', $param ); 
        $resultado->bindParam(':fecha', $fecha ); 
        $resultado->bindParam(':tarjetaProfesional', $tarjetaProfesional ); 
        
        $resultado->execute();
        echo json_encode("doctor guardado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



//modificar doctores 
$app->put('/api/doctores/modificar/{id}', function(Request $request, Response $response){
    $iddoctores = $request->getAttribute('id');
    
    $nombre = $request->getParam('nombre');
    $correo = $request->getParam('correo');
    $estado = $request->getParam('estado');
    $estadoVisible = $request->getParam('estadoVisible');
    $foto = $request->getParam('foto');
    $estado = $request->getParam('estado');
    $titulo = $request->getParam('titulo');
    $descripcion = $request->getParam('descripcion');
    $telefono = $request->getParam('telefono');
    $param = $request->getParam('param');
    $fecha = $request->getParam('fecha');
    $tarjetaProfesional = $request->getParam('tarjetaProfesional');

    
    $consulta = "UPDATE doctores SET
       nombre = :nombre,
       correo = :correo,
       estado = :estado,
       estadoVisible = :estadoVisible,
       foto = :foto,
       estado = :estado,
       titulo = :titulo,
       descripcion = :descripcion,
       telefono = :telefono,
       param = :param,
       fecha = :fecha,
       tarjetaProfesional = :tarjetaProfesional
       WHERE id = $iddoctores";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        
        $resultado->bindParam(':nombre', $nombre ); 
        $resultado->bindParam(':correo', $correo ); 
        $resultado->bindParam(':estado', $estado ); 
        $resultado->bindParam(':estadoVisible', $estadoVisible ); 
        $resultado->bindParam(':foto', $foto ); 
        $resultado->bindParam(':estado', $estado ); 
        $resultado->bindParam(':titulo', $titulo ); 
        $resultado->bindParam(':descripcion', $descripcion ); 
        $resultado->bindParam(':telefono', $telefono ); 
        $resultado->bindParam(':param', $param ); 
        $resultado->bindParam(':fecha', $fecha ); 
        $resultado->bindParam(':tarjetaProfesional', $tarjetaProfesional ); 
        
        $resultado->execute();
        echo json_encode("doctor modificado");
        $resultado = null;
        $db = null;
        
    } catch (PDOException $e) {
        
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

//eliminar cliente
// nombre`, `correo`, `estado`, `estadoVisible`, `foto`, `estado`, `titulo`, `param`, `descripcion`, `telefono
$app->delete('/api/doctores/eliminar/{id}', function(Request $request, Response $response){
    $estadoes = $request->getAttribute('id');
       $consulta = "DELETE FROM doctores
       WHERE id = $estadoes";

    try{
        $db = new db();
        $db = $db->conectar();
        $resultado = $db->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            echo json_encode("doctor eliminado");
        }else{
            echo json_encode("no existe doctor con este ID");
        }

        $resultado = null;
        $db = null;

    } catch (PDOException $e) {
      
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

?>