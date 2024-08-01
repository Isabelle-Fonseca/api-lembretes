<?php

require('./../config.php');

$metodo = strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo ==='DELETE'){
   
    parse_str(file_get_contents("php://input"), $delete);

    $id = $delete['id'] ?? null;

    $id = filter_var($id,FILTER_VALIDATE_INT);

    if ($id) {
        $sql=$pdo->prepare("SELECT * FROM lembrete WHERE idLembrete=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount()>0){
            $sql = $pdo->prepare("DELETE FROM lembrete WHERE idLembrete=:id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            $array['result'] = 'Item excluído com sucesso!';
        }else{
            $array['error'] = 'Erro: Id Inexistente!';
        }
    } else {
        $array['error'] = 'Erro: Id nulo ou inválido!';
    }
}else{
    $array['error'] = 'Erro: Ação invalida - Método permitido apenas POST';
}
require('./../return.php');