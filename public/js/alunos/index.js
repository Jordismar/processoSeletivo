function carregaAlunos() {
    return {
        alunos: [],
        retornaAlunos() {
            axios.get('/alunos/list')
                .then(({data}) => {
                    this.alunos = data.data;
                })
        },
        visualizar(aluno_id) {
          window.location.href = `provas/visualiza-prova-aluno/${aluno_id}`
        },
        gerenciaRedacoes(id) {
            axios.get(`/redacao/verifica-redacao/${id}`)
                .then(({data}) => {
                    if (!data.conteudo && !data.url) {
                        Swal.fire({
                            title: 'Este aluno não tem nenhuma redação vinculada',
                            text: 'Tente verificar a prova do aluno',
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        })
                        return;
                    }

                    Swal.fire({
                        title: 'Selecione uma das opções',
                        icon: 'info',
                        showCancelButton: !!data.url,
                        showConfirmButton: !!data.conteudo,
                        confirmButtonText: 'Redação Escrita',
                        cancelButtonText: 'Download'
                    })
                        .then(function (result) {
                            if (result.dismiss === Swal.DismissReason.cancel) {
                                axios.get('/redacao/download', {params: {url: data.url}, responseType: 'blob'})
                                    .then((response) => {
                                        const blob = new Blob([response.data], {type: 'application/pdf'});
                                        const url = window.URL.createObjectURL(blob);
                                        const link = document.createElement('a');

                                        link.href = url;
                                        link.setAttribute('download', 'redacao.pdf');
                                        document.body.appendChild(link);
                                        link.click();
                                    }).catch(() => {
                                    Swal.fire({
                                        title: 'Erro ao verificar redações',
                                        text: 'Tente novamente mais tarde ou entre em contato com o suporte',
                                        icon: 'error',
                                        confirmButtonText: 'Ok'
                                    })
                                });
                            } else if (result.value) {
                                Swal.fire(data.conteudo)
                            }
                        });
                }).catch((e) => {
                Swal.fire({
                    title: 'Erro ao verificar redações',
                    text: 'Tente novamente mais tarde ou entre em contato com o suporte',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            })
        }
    };
}
