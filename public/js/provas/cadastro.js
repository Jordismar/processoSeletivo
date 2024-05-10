function dataProva() {
    return {
        nome_prova: '',
        informacao_prova: '',
        ativada: false,
        questoes: [{
            descricao: '',
            alternativas: [
                {
                    descricao: '',
                    correta: false
                },
                {
                    descricao: '',
                    correta: false
                },
                {
                    descricao: '',
                    correta: false
                },
                {
                    descricao: '',
                    correta: false
                },
                {
                    descricao: '',
                    correta: false
                },
            ],
        }],
        marcarUnico(questao, altIndex) {
            questao.alternativas.forEach((alternativa, index) => {
                if (index !== altIndex) {
                    alternativa.correta = false;
                }
            });
        },
        addQuestao() {
            if (this.questoes.length > 9) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Limite de questões atingidas',
                    confirmButtonText: 'Ok'
                })
                return;
            }
            this.questoes.push({
                descricao: '',
                alternativas: [
                    {
                        descricao: '',
                        correta: false
                    },
                    {
                        descricao: '',
                        correta: false
                    },
                    {
                        descricao: '',
                        correta: false
                    },
                    {
                        descricao: '',
                        correta: false
                    },
                    {
                        descricao: '',
                        correta: false
                    },
                ],
            })
        },
        salvaProva() {
            axios.post('/provas/store', {
                questoes: this.questoes,
                nome_prova: this.nome_prova,
                informacao_prova: this.informacao_prova,
                ativada: this.ativada
            })
                .then(({data}) => {
                    if (data.tipo == 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: data.mensagem,
                            text: 'Tente novamente mais tarde ou verifique suas questões',
                            confirmButtonText: 'Ok'
                        })
                        return;
                    }
                    Swal.fire({
                        title: data.mensagem,
                        icon: 'success'
                    })
                    window.location.href = '/provas';
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao cadastrar sua prova',
                        text: 'Tente novamente mais tarde ou verifique suas questões',
                        confirmButtonText: 'Ok'
                    })
                })
        }
    };
}

