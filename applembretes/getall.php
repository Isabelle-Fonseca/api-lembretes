<?php

require('./../config.php');


if ($_SERVER['REQUEST_METHOD']==='GET'){
    $sql=$pdo->query("SELECT * FROM lembrete");

    if($sql->rowCount()>0){
        $dados=$sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dados as $linhas){
            $array['result']=[
                'id'=>$linha['idLembrete'],
                'titulo'=>$linha['tituloLembrete']
            ];
        }
    }else{
        $array['error'] = 'Erro: Não há lembretes';
    }
}else{
    $array['error'] = 'Erro: Ação invalida - Método permitido apenas get';
}

require('./../return.php');

