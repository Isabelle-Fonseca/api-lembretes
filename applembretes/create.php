<?php

require('./../config.php');

$metodo = strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo ==='POST'){
    $titulo = filter_input(INPUT_POST, 'titulo');
    $corpo = filter_input(INPUT_POST,'corpo');

    if($titulo && $corpo){
        $sql=$pdo->prepare("INSERT INTO lembrete (tituloLembrete, corpoLembrete) VALUES (:titulo,:corpo)");
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':corpo', $corpo);
        $sql->execute();

        //estou usando o metodo para obter o id do ultimo registro inserido
        $id = $pdo->lastInsertId();

        //desafio
        $array['result'] = [
            'id' => $id,
            'titulo' => $titulo,
            'corpo' => $corpo
        ];

    }else{
        $array['error'] = 'Erro: Valores nulos ou inválidos!';
    }

}else{
    $array['error'] = 'Erro: Ação invalida - Método permitido apenas POST';
}
require('./../return.php');