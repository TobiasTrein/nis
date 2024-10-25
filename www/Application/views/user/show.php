<main>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2" style="margin-top:50px">
                <h2 class="text-center">Detalhes do Cidadão</h2>

                <!-- Tabela de Cidadão -->
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">NIS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if (!empty($data['user'])) { ?>
                            <tr>
                                <td><?=htmlspecialchars($data['user'][0]['name'])?></td>
                                <td class="nis"><?=htmlspecialchars($data['user'][0]['nis'])?></td>
                            </tr>
                    <?php
                        } else { ?>
                            <tr>
                                <td colspan="2" class="text-center">Nenhum cidadão cadastrado.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Botão Voltar -->
                <div class="text-center mt-3">
                    <a href="/nis/user/" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('.nis').each(function() {
            var nis = $(this).text().trim();
            // Adiciona a máscara
            var formattedNis = nis.replace(/^(\d{3})(\d{5})(\d{2})(\d{1})$/, '$1.$2.$3-$4');
            $(this).text(formattedNis);
        });
    });
</script>