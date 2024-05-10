$(document).ready(function () {
    $('input[type="checkbox"]').on('change', function() {
        const questaoId = $(this).closest('.questao').data('questao-id');
        $('input[type="checkbox"][data-questao-id="' + questaoId + '"]').not(this).prop('checked', false);
    });
});
function enviarProva() {
    const dados = $('input[name*="alternativas"]').map(function(){return $(this).is(':checked') ? $(this).val() : undefined;}).get();

    axios.post('/vestibular/enviar-prova', dados)
        .then(({data}) => {
            if (data.tipo == 'error') {
                Swal.fire({
                    title: 'Error ao enviar sua prova',
                    text: 'Tente novamente mais tarde ou entre em contato com o suporte',
                    icon:'error'
                })
                return ;
            }
            if (!data.aprovado) {
                Swal.fire({
                    title: 'Infelizmente você não foi aprovado',
                    text: 'Tente novamente mais tarde',
                    icon:'warning'
                })

                window.location.href = '/vestibular'
            } else {
                Swal.fire({
                    title: 'Parabens você foi aprovado',
                    icon: 'success'
                })
                window.location.href = '/aprovado';
            }
        }).catch(() => {
        Swal.fire({
            title: 'Error ao enviar sua prova',
            text: 'Tente novamente mais tarde ou entre em contato com o suporte',
            icon:'error'
        })
    })
}
