<main>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2" style="margin-top:50px">
                <h2 class="text-center">Cadastro de NIS</h2>

                <!-- Alerta de Sucesso -->
                <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                    <strong>Sucesso!</strong> NIS válido gerado para o cidadão.
                </div>
                
                <!-- Formulário de Pesquisa -->
                <div class="search-input">
                    <form class="d-flex" method="GET" action="" onsubmit="redirectToShowPage(event)">
                        <input class="form-control me-2" type="search" maxlength="14" placeholder="Digite o NIS para buscar" aria-label="Pesquisar" name="nis">
                        <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
                    </form>
                </div>

                <!-- Formulário de Cadastro -->
                <div class="mb-4">
                  <h4>Adicionar Novo Cidadão</h4>
                  <form method="POST" action="/nis/user/create">
                    <div class="row g-3 align-items-center">
                      <div class="col-auto">
                        <input type="text" class="form-control" placeholder="Nome" name="name" required>
                      </div>
                      <div class="col-auto">
                        <button id="sub" type="submit" class="btn btn-success">Cadastrar</button>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- Tabela de Cidadãos -->
                <h4>Lista de Cidadãos</h4>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">NIS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // Verifica se há usuários cadastrados
                            if (!empty($data['users'])) { 
                                // coloca em ordem alfabética
                                usort($data['users'], function($a, $b) {
                                    return strcmp($a['name'], $b['name']);
                                });
                                // lista usuários
                                foreach ($data['users'] as $user) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['name']) ?></td>
                                        <td class="nis"><?= htmlspecialchars($user['nis']) ?></td>
                                    </tr>
                          <?php } 
                            } else { ?>
                                <tr>
                                    <td colspan="2" class="text-center">Nenhum cidadão cadastrado.</td>
                                </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    // Alert de sucesso ao cadastrar
    $(document).ready(function() {
        if (sessionStorage.getItem('success') === '1') { // Verifica se a sessão de sucesso foi definida
            $("#success-alert").fadeIn(500).delay(2000).fadeOut(500);
            sessionStorage.removeItem('success'); // Remove a sessão após exibir
        } else {
            $("#success-alert").hide();
        }

        $("#sub").click(function() {
            sessionStorage.setItem('success', '1'); // Define a sessão de sucesso
            $("#success-alert").fadeIn(500).delay(2000).fadeOut(500);
        });
    });

    // Adiciona a máscara do NIS
    $(document).ready(function() {
        $('.nis').each(function() {
            var nis = $(this).text().trim();
            var formattedNis = nis.replace(/^(\d{3})(\d{5})(\d{2})(\d{1})$/, '$1.$2.$3-$4');
            $(this).text(formattedNis);
        });
    });

    // Redirecionamento após pesquisa
    function redirectToShowPage(event) {
        event.preventDefault(); // Impede o envio do formulário padrão
        const nis = document.querySelector('input[name="nis"]').value.trim();
        if (nis) {
            window.location.href = `/nis/user/show/${nis}`;
        } else {
            alert('Por favor, insira um NIS válido.'); // Mensagem de erro
        }
    }
</script>