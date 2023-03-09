<!DOCTYPE html>
<html>

<head>
    <title>Registro de Paciente</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <!-- <div class="doutor">
        <img src="dotor.png" alt="medico">
    </div> -->
    <h2>Registro de Paciente</h2>

    <div class="form">
        <form method="POST">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Nome completo" required><br><br>
            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" required><br><br>
            <label>Temperatura:</label>
            <input type="number" name="temperatura" step="0.1" placeholder="Temperatura" required><br><br>
            <label>Data/Hora da Última Medição:</label>
            <input type="datetime-local" name="data_hora" required><br><br>
            <input type="submit" value="Enviar">
        </form>
    </div>

</body>

</html>

<?php
//verifica se foram enviados dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //recebe os dados do formulário
    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nascimento'];
    $temperatura = $_POST['temperatura'];
    $data_hora = $_POST['data_hora'];

    //calcula o estado do paciente
    if ($temperatura < 25) {
        $estado = 'Óbito';
        //exclui os cookies
        setcookie('nome', '', time() - 3600);
        setcookie('data_nascimento', '', time() - 3600);
        setcookie('temperatura', '', time() - 3600);
        setcookie('data_hora', '', time() - 3600);
    } elseif ($temperatura < 35.4) {
        $estado = 'Hipotérmico';
        echo "Nome: ", $nome, "\r\n";
        echo "Data de nascimento: ", $data_nasc, "\r\n";
        echo "Data e hora da ultima medição: ", $data_hora, "\r\n";
        echo "Estado do paciente: ", $estado;
    } elseif ($temperatura < 37) {
        $estado = 'Normal';
        echo "Nome: ", $nome, "\r\n";
        echo "Data de nascimento: ", $data_nasc, "\r\n";
        echo "Data e hora da ultima medição: ", $data_hora, "\r\n";
        echo "Estado do paciente: ", $estado;
    } elseif ($temperatura < 37.6) {
        $estado = 'Febril';
        echo "Nome: ", $nome, "\r\n";
        echo "Data de nascimento: ", $data_nasc, "\r\n";
        echo "Data e hora da ultima medição: ", $data_hora, "\r\n";
        echo "Estado do paciente: ", $estado;
    } else {
        $estado = 'Febre';
        echo "Nome: ", $nome, "\r\n";
        echo "Data de nascimento: ", $data_nasc, "\r\n";
        echo "Data e hora da ultima medição: ", $data_hora, "\r\n";
        echo "Estado do paciente: ", $estado;
    }

    //grava os dados em cookies
    setcookie('nome', $nome, time() + (86400 * 30)); //expira em 30 dias
    setcookie('data_nascimento', $data_nasc, time() + (86400 * 30));
    setcookie('temperatura', $temperatura, time() + (86400 * 30));
    setcookie('data_hora', $data_hora, time() + (86400 * 30));
} else {
    //verifica se existem cookies
    if (isset($_COOKIE['nome'])) {
        $nome = $_COOKIE['nome'];
        $data_nasc = $_COOKIE['data_nascimento'];
        $temperatura = $_COOKIE['temperatura'];
        $data_hora = $_COOKIE['data_hora'];

        //calcula o estado do paciente
        if ($temperatura < 25) {
            $estado = 'Óbito';
            //exclui os cookies
            setcookie('nome', '', time() - 3600);
            setcookie('data_nascimento', '', time() - 3600);
            setcookie('temperatura', '', time() - 3600);
            setcookie('data_hora', '', time() - 3600);
        } elseif ($temperatura < 35.4) {
            $estado = 'Hipotérmico';
        } elseif ($temperatura < 37) {
            $estado = 'Normal';
        } elseif ($temperatura < 37.6) {
            $estado = 'Febril';
        } else {
            $estado = 'Febre';
        }
    }
}
?>