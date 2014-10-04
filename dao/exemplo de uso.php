<?php
include_once ‘Driver.php’;
include_once ‘AgendaDAO.php’;
include_once ‘Agenda.php’;
// instancio a classe Agenda
$agenda = new Agenda();
//setando os dados de contato
$agenda->setNome(“Elionai Moura”);
$agenda->setEmail(“nick.legal@gmail.com”);
$agenda->setTelefone(“9949-5123″);
// instancio a classe Data Access Object para Agenda
$DAO = new AgendaDAO();
// inserir contato na agenda
$DAO->Insere($agenda);
// apagar registro por id
$DAO->Deleta(1);
//para listar nome e email de todos os contatos
foreach ($DAO->Lista() as $contato){
echo $contato["nome"].” – “.$contato["email"].”<br/>”;
}
//para listar contato por nome
$a = “Elionai”;
foreach ($DAO->Lista(“SELECT * FROM agenda WHERE nome = ‘$a’”) as $row){
echo $row["nome"].” – “.$row["email"].”<br>”;
}