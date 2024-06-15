<?php

require_once("conn.php");
include("paciente.php");

if (isset($_POST['recebe_dados'])) {

    $dataRecebida = $_POST['dataDeNascimento']; // 'aaaa-mm-dd'
    $dataNascimentoFormatada = DateTime::createFromFormat('Y-m-d', $dataRecebida);
    if (!$dataNascimentoFormatada) {
        die('Data de nascimento inválida.');
    }
    $dataFormatada = $dataNascimentoFormatada->format('d/m/Y');


   
    

    try {
        
        
        $genero = Genero::tryFrom($_POST['genero']) ?? throw new Exception('Gênero inválido.');
        $sexo = Sexo::tryFrom($_POST['sexo']) ?? throw new Exception('Sexo inválido.');
        $uf = UF::tryFrom($_POST['uf']) ?? throw new Exception('UF inválido.');
        $doenca = Doenca::tryFrom($_POST['doenca']) ?? throw new Exception('Doença inválida.');
        $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';
        $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : '';
        
        
        
        
        $novoPaciente = Paciente::create(
            $_POST['nome'],
            $_POST['rg'],
            $_POST['cns'],
            $_POST['telefone'],
            $_POST['cep'],
            $_POST['endereco'],
            $_POST['bairro'],
            $_POST['numero'], 
            $_POST['cidade'],
            $_POST['nomeMae'],
            $_POST['email'],
            $genero,
            $sexo,
            $uf,
            $doenca,
            $dataFormatada,
            $comentario,
            $complemento
        );
        
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $sql = "INSERT INTO paciente (nome, rg, cns, telefone, cep, endereco, bairro, numero, cidade, nome_Mae, email, genero, sexo, uf, doenca, data_Nascimento, comentario, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $nome = $novoPaciente->getNome();
    $rg = $novoPaciente->getRg();
    $cns = $novoPaciente->getCns();
    $telefone = $novoPaciente->getTelefone();
    $cep = $novoPaciente->getCep();
    $endereco = $novoPaciente->getEndereco();
    $bairro = $novoPaciente->getBairro();
    $numero = $novoPaciente->getNumero();
    $cidade = $novoPaciente->getCidade();
    $nomeMae = $novoPaciente->getNomeMae();
    $email = $novoPaciente->getEmail();
    $generoValue = $novoPaciente->getGenero()->value;
    $sexoValue = $novoPaciente->getSexo()->value;
    $ufValue = $novoPaciente->getUf()->value;
    $doencaValue = $novoPaciente->getDoenca()->value;
    $dataDeNascimento = $novoPaciente->getDataDeNascimento();
    $comentario = $novoPaciente->getComentario();
    $complemento = $novoPaciente->getComplemento();

    $stmt->bind_param("ssssssssssssssssss",
    $nome,
    $rg,
    $cns,
    $telefone,
    $cep,
    $endereco,
    $bairro,
    $numero,
    $cidade,
    $nomeMae,
    $email,
    $generoValue,
    $sexoValue,
    $ufValue,
    $doencaValue,
    $dataDeNascimento,
    $comentario,  
    $complemento   
);

     if ($stmt->execute()) {
        echo "Paciente adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar paciente: " . $stmt->error;
    }
}

?>
