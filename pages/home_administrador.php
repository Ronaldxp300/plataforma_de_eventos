<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RP Events - Página Inicial</title>
    <link rel="stylesheet" href="../css/styless.css">
    <script>
        function confirmarExclusao() {
            return confirm("Tem certeza que deseja excluir este evento?");
        }

        function excluirRegistro(tabela, id) {
            if (confirmarExclusao()) {
                fetch(`../functions/gerenciamento.php?action=deletar_${tabela}&id=${id}`, { method: 'GET' })
                    .then(response => {
                        if (response.ok) {
                            location.reload(); 
                        } else {
                            alert("Ocorreu um erro ao excluir o registro.");
                        }
                    })
                    .catch(error => {
                        console.error("Erro ao excluir registro:", error);
                        alert("Ocorreu um erro ao excluir o registro.");
                    });
            }
        }
    </script>
</head>
<body>
<header>
        <h1>RP Events</h1>
        <form action="../functions/processar_busca.php" method="GET">
            <input type="text" id="busca" name="busca" placeholder="Buscar eventos...">
            <button type="submit">Pesquisar</button>
        </form>
        <button onclick="location.href='gerenciar_conta.php'" class="gerenciar_conta_btn">Gerenciar Conta</button>
        <button onclick="location.href='home.php'" class="logout">Sair</button>
    </header>
    
    <nav>
        <ul>
            <li><a href="#eventos">Eventos</a></li>
            <li><a href="#inscricoes">Inscrições</a></li>
            <li><a href="#participantes">Participantes</a></li>
        </ul>
    </nav>
    <section id="eventos">
        <h2>Eventos</h2>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Data</th>
                    <th>Local</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../functions/gerenciamento.php';
                $eventos = getEventos();
                foreach ($eventos as $evento) {
                    echo "<tr>";
                    echo "<td>" . $evento['titulo'] . "</td>";
                    echo "<td>" . $evento['data_evento'] . "</td>";
                    echo "<td>" . $evento['local'] . "</td>";
                    echo "<td><button onclick=\"excluirRegistro('evento', " . $evento['id'] . ")\">Deletar</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="criar_evento.php">Criar Novo Evento</a>
    </section>

    <section id="inscricoes">
        <h2>Inscrições</h2>
        <table>
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Participante</th>
                    <th>Status de Pagamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $inscricoes = getInscricoes();
                foreach ($inscricoes as $inscricao) {
                    $nomeEvento = getNomeEvento($inscricao['id_evento']);
                    $nomeParticipante = getNomeParticipante($inscricao['id_usuario']);
                
                    echo "<tr>";
                    echo "<td>" . $nomeEvento . "</td>";
                    echo "<td>" . $nomeParticipante . "</td>";
                    echo "<td>" . $inscricao['status_pagamento'] . "</td>";
                    echo "<td><button onclick=\"excluirRegistro('inscricao', " . $inscricao['id'] . ")\">Deletar</button></td>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
        </table>
        <a href="criar_inscricao.php">Criar Nova Inscrição</a>
    </section>

    <section id="participantes">
        <h2>Participantes</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo de Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $participantes = getParticipantes();
                foreach ($participantes as $participante) {
                    echo "<tr>";
                    echo "<td>" . $participante['nome'] . "</td>";
                    echo "<td>" . $participante['email'] . "</td>";
                    echo "<td>" . $participante['tipo_usuario'] . "</td>";
                    echo "<td><button onclick=\"excluirRegistro('participante', " . $participante['id'] . ")\">Deletar</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="criar_participante.php">Criar Novo Participante</a>
    </section>

    <footer>
        <p>RP Events - Todos os direitos reservados</p>
    </footer>
</body>
</html>
