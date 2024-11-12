new Vue({
    el: '#app',
    data() {
        return {
            nome_completo: '',
            username: '',
            senha: '',
            confirmaSenha: '',
            imagePreview: '', // Para pré-visualização da imagem
            avatar: null, // Para armazenar o arquivo de imagem
            senhaValidacoes: {
                minimoChar: false,
                numero: false,
                maiuscula: false,
                minuscula: false,
                simbolo: false
            }
        };
    },
    methods: {
        validaSenha() {
            const senha = this.senha;
            this.senhaValidacoes.minimoChar = senha.length >= 8;
            this.senhaValidacoes.numero = /\d/.test(senha);
            this.senhaValidacoes.maiuscula = /[A-Z]/.test(senha);
            this.senhaValidacoes.minuscula = /[a-z]/.test(senha);
            this.senhaValidacoes.simbolo = /[@!&?]/.test(senha);
        },
        previewImage(event) {
            const file = event.target.files[0];
            this.avatar = file; // Armazena o arquivo no data para envio posterior
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        async handleSubmit() {
            if (this.senha !== this.confirmaSenha) {
                Swal.fire({
                    icon: 'error',
                    title: 'Senha',
                    text: 'As senhas não correspondem.'
                });
                return;
            }

            // Prepara os dados para envio ao back-end
            const formData = new FormData();
            formData.append('nome_completo', this.nome_completo);
            formData.append('username', this.username);
            formData.append('senha', this.senha);
            if (this.avatar) {
                formData.append('avatar', this.avatar); // Adiciona a imagem ao FormData
            }

            try {
                const response = await fetch(`${dominio}/user/cadastro`, {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Cadastro realizado com sucesso!'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: result.message
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de conexão',
                    text: 'Não foi possível enviar os dados.'
                });
            }
        }
    }
});
