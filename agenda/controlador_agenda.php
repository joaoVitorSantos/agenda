<?php
//a função incrementa um novo contato no arquivo json
    function cadastrar($nome, $email, $telefone){
        $contatosAuxiliar = pegarContatos();

        $contato = [
            'id'      => uniqid(),
            'nome'    => $nome,
            'email'   => $email,
            'telefone'=> $telefone
        ];

        array_push($contatosAuxiliar, $contato);//adiciona um novo item ao array

        $novoJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
        file_put_contents('contatos.json', $novoJson);



        //$contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);//o arquivo Json é convertido em um array
        //file_put_contents('contatos.json', $contatosJson);//transforma os dados do array para um arquivo em .JSON

        enviar_header();//vai direcionar os dados para a página inicial

    }

    function pegarContatos(){
        $contatosAuxiliar = file_get_contents('contatos.json'); // lê o arquivo json
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);// transforma o arquivo json para array

        return $contatosAuxiliar;// retorna um array
    }

    function excluirContato($id){
        $contatosAuxiliar = pegarContatos();

        foreach ($contatosAuxiliar as $posicao => $contato){
            if($id == $contato['id']) {
                unset($contatosAuxiliar[$posicao]);
            }
        }

        novoJson($contatosAuxiliar, $jsonNovo);

        enviar_header();
    }

    function buscarContatoParaEditar($id){

        $contatosAuxiliar = pegarContatos();

        foreach ($contatosAuxiliar as $contato){
            if ($contato['id'] == $id){
                return $contato;
            }
        }
    }

    function salvarContatoEditado($id, $nome, $email, $telefone){
        $contatosAuxiliar = pegarContatos();

        foreach ($contatosAuxiliar as $posicao => $contato){
            if ($contato['id'] == $id){

                $contatosAuxiliar[$posicao]['nome']     = $nome;
                $contatosAuxiliar[$posicao]['email']    = $email;
                $contatosAuxiliar[$posicao]['telefone'] = $telefone;

                break;
            }
        }
        novoJson($contatosAuxiliar);

        enviar_header();

    }

    function enviar_header(){
        header('Location: index.phtml');
    }

    function buscarContato($nome){
        //Pego os contatos;
        $contatosAuxiliar = pegarContatos();

        $contatosEncontrados = [];

        //Para cada contatoAuxiliar como contato...;
        foreach ($contatosAuxiliar as $contato){
        //Se e o id do contato é o mesmo que estou procurando
        if ($contato['nome'] == $nome){
            //retorne para mim o contato com seus dados;
            $contatosEncontrados[] = $contato;
        }
    }

    return $contatosEncontrados;
    }

    function novoJson($primeiroJson){

        $novoJson = json_encode($primeiroJson, JSON_PRETTY_PRINT);
        file_put_contents('contatos.json', $novoJson);

        return $novoJson;
    }

    switch($_GET['acao']){
        case "editar":
            salvarContatoEditado($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
            break;

        case "cadastrar":
            cadastrar($_POST['nome'], $_POST['email'], $_POST['telefone']);
            break;

        case "excluir":
            excluirContato($_GET['id']);
            break;


    }