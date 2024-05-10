$(document).ready(function () {
    $('#cadastro').on('click', function () {
        window.location.href = '/provas/form';
    });
})

function carregaProvas() {
    return {
        provas: [],
        retornaProvas() {
            axios.get('/provas/list')
                .then(({data}) => {
                    this.provas = data.data;
                })
        },
        ativaProva(prova_id) {
            const prova = this.provas.find(prova => prova.prova_id === prova_id);
            axios.get(`/provas/ativa-desativa/${prova_id}`)
                .then(({data}) => {
                    if (data.tipo == 'error') {
                        Swal.fire({
                            title: 'Erro ao ativar prova',
                            text: 'Tente novamente mais tarde ou entre em contato com o suporte',
                            icon:'error'
                        })
                        return;
                    }
                    prova.bloqueado = !prova.bloqueado;
                    Swal.fire({
                        title: 'Prova ativada com sucesso!',
                        text: 'Agora esta prova será usada nos proximos vestibulares',
                        icon: 'success',
                    })
                    this.retornaProvas();
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Erro ao ativar prova',
                        text: 'Tente novamente mais tarde ou entre em contato com o suporte',
                        icon:'error'
                    })
                });
        }
    };
}
