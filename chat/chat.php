<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$usuario = $_SESSION['usuario'];

include_once './config.php';
include_once './conexao_singleton/BD.class.php';
BD::conn();

$acao = $_POST['acao'];

switch ($acao){
    case 'inserir':
        $para = $_POST['para'];
        $mensagem = strip_tags($_POST['mensagem']);

        $pegar_nome = BD::conn()->prepare("SELECT `nome` FROM `tb_usuario` WHERE id_usuario = ?");
        $pegar_nome->execute(array($usuario['id_usuario']));
        $ft = $pegar_nome->fetchObject();

        $inserir = BD::conn()->prepare("INSERT INTO `tb_mensagem` (id_de, id_para, mensagem, data) VALUES(?,?,?,NOW())");
        if($inserir->execute(array($usuario['id_usuario'], $para, $mensagem))){
                echo '<li><span>'.$ft->nome.' disse:</span><p>'.$mensagem.'</p></li>';
        }
    break;
        
    case 'verificar':
            $ids = (isset($_POST['ids'])) ? $_POST['ids'] : '';
            $users = (isset($_POST['users'])) ? $_POST['users'] : '';
            $retorno = array();
            
            if($users != ''){
                    foreach($users as $indice => $id_u){
                            $sel = BD::conn()->prepare("SELECT horario, limite FROM `tb_usuario` WHERE id_usuario = ?");
                            $sel->execute(array($id_u));
                            $fet = $sel->fetchObject();

                            $atual = date('Y-m-d H:i:s');
                            $mais1 = date('Y-m-d H:i:s', strtotime('+1 min'));

                            if($id_u == $usuario['id_usuario']){
                                    $up = BD::conn()->prepare("UPDATE `tb_usuario` SET limite = ? WHERE id = ?");
                                    $up->execute(array($mais1, $id_u));
                            }

                            if($atual >= $fet->limite)
                                    $retorno['useronoff'][$id_u] = 'off';
                            else
                                    $retorno['useronoff'][$id_u] = 'on';

                    }
            }
            
            if($ids == ''){
                if(isset($retorno['mensagens']))
                        $retorno['mensagens'] == '';
            }else{
                foreach($ids as $indice => $id){
                        $selecionar = BD::conn()->prepare("SELECT * FROM `tb_mensagem` WHERE id_de = ? AND id_para = ? OR id_de = ? AND id_para = ?");
                        $selecionar->execute(array($usuario['id_usuario'], $id, $id, $usuario['id_usuario']));

                        $mensagem = '';
                        while($ft = $selecionar->fetchObject()){
                                $nome = BD::conn()->prepare("SELECT nome FROM `tb_usuario` WHERE id_usuario = ?");
                                $nome->execute(array($ft->id_de));
                                $name = $nome->fetchObject();

                                $mensagem .= '<li><span>'.$name->nome.' disse:</span><p>'.$ft->mensagem.'</p></li>';
                        }
                        $retorno['mensagens'][$id] = $mensagem;
                    }
            }

            $verificar = BD::conn()->prepare("SELECT id_de FROM `tb_mensagem` WHERE id_para = ? AND lido = ? GROUP BY id_de");
            $verificar->execute(array($usuario['id_usuario'], 0));

            if($verificar->rowCount() == 0){
                if(isset($retorno['nao_lidos']))
                    $retorno['nao_lidos'] == '';
            }else{
                    while($user = $verificar->fetchObject()){
                            $retorno['nao_lidos'][] = $user->id_de;
                    }
            }
            $retorno = json_encode($retorno);
            echo $retorno;
    break;
    
        case 'mudar_status':
                $user = $_POST['user'];
                $mudar_st = BD::conn()->prepare("UPDATE `tb_mensagem` SET lido = '1' WHERE id_de = ? AND id_para = ?");
                $mudar_st->execute(array($user, $usuario['id_usuario']));
        break;
}