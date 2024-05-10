$(document).ready(function () {
    $('#redigir').on('click', function () {
        $('.redigi_editor').removeAttr('hidden');
        tinymce.init({
            selector: '#editor',
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'help'
            ],
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons | help',
            menu: {
                favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
            },
            menubar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    });

    $('#store').on('click', function () {
        let redacao = tinymce.get('editor').getContent()

        axios.post('/redacao/store', {redacao})
            .then(({data}) => {
                if (data.tipo == 'error') {
                    Swal.fire({
                        title: 'Erro ao salvar sua redação!',
                        text: 'Tente novamente mais tarde ou entre em contato com o suporte.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                    return;
                }
                Swal.fire({
                    title: 'Parabéns, sua redação foi salva com sucesso!',
                    text: 'Clique em confirmar para concluir',
                    icon: 'success',
                    confirmButtonText: 'Confirmar'
                }).then(() => {
                    window.location.href = '/aprovado';
                })
            })

    })

    $('#upload').on('click', function () {
        Swal.fire({
            title: "Insira sua redação",
            input: "file",
            inputAttributes: {
                "accept": ".doc,.pdf",
                "aria-label": "Upload your profile picture"
            }
        }).then((file) => {
            const formData = new FormData();
            formData.append('file', file.value);
            axios.post('/redacao/upload',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(({data}) => {
                if (data.tipo == 'error') {
                    Swal.fire({
                        title: 'Erro ao salvar sua redação!',
                        text: 'Tente novamente mais tarde ou entre em contato com o suporte.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                    return;
                }
                Swal.fire({
                    title: 'Parabéns, sua redação foi salva com sucesso!',
                    text: 'Clique em confirmar para concluir',
                    icon: 'success',
                    confirmButtonText: 'Confirmar'
                }).then(() => {
                    window.location.href = '/aprovado';
                })
            })
        });
    })
})
