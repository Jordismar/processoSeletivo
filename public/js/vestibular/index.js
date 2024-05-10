$(document).ready(function () {
    $('#cpf').mask('000.000.000-00', {reverse: true});
    $('#telefone').mask('(00) 00000-0000');

    let div_enem = $('#div_enem');
    let div_nota = $('#div_nota');

    $('select[name="escolaridade_id"]').on('change', function () {
        div_enem.attr('hidden', 'true');

        if ($(this).val() == 1) {
            div_enem.removeAttr('hidden')
        } else if ($(this).val() == 2 || $(this).val() == 3) {
            Swal.fire({
                title: 'Você está isento de vestibular!',
                text: 'Escolha a melhor opção',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Transferencia ',
                cancelButtonText: 'Novo Curso '
            })
                .then(function (result) {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        manipula('matricula');
                    } else if (result.value) {
                        manipula('matricula');
                    }
                });
        }
    });

    $('#enem').on('change', function () {
        div_nota.attr('hidden', 'true');
        if ($(this).val() == 1) {
            div_nota.removeAttr('hidden')
        } else if ($(this).val() == 2) {
            Swal.fire({
                title: 'Você precisar fazer o vestibular online',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Prova Online',
                cancelButtonText: 'Redação'
            })
                .then(function (result) {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        manipula('redacao');
                    } else if (result.value) {
                        manipula('prova');
                    }
                });
        }
    });

    $('#nota_enem').on('change', function () {
        if ($(this).val() >= 400) {
            Swal.fire({
                title: 'Parabéns você foi aprovado!',
                text: 'Clique em confirmar para concluir',
                icon: 'success',
                confirmButtonText: 'Confirmar',
            })
                .then(() => {
                    manipula('aprovado');
                })
        } else if ($(this).val() != "" && $(this).val() < 400) {
            Swal.fire({
                title: 'Você precisar fazer o vestibular online',
                text: 'Selecione uma das opções abaixo para prosseguir',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Prova Online',
                cancelButtonText: 'Redação'
            })
                .then(function (result) {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        manipula('redacao');
                    } else if (result.value) {
                        manipula('prova');
                    }
                });
        }
    })

    function manipula(data) {
        axios.post('/vestibular/manipula', {
            opcao: data,
            nota_enem: $('#nota_enem').val(),
            escolaridade_id: $('#escolaridade_id').val()
        }).then(({data}) => {
            window.location.href = data.url;
        }).catch(() => {
            Swal.fire({
                title: 'Erro ao manipular suas informações',
                text: 'Tente novamente mais tarde ou entre em contato com o suporte',
                icon: 'erroe',
                confirmButtonText: 'Ok',
            })
        })
    }
});
