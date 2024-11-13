new Vue({
    el: '#app',
    data() {
        return {
            nome_completo: '',
            username: '',
            senha: '',
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
            // Prepara os dados para envio ao back-end
            const formData = new FormData();
            formData.append('nome_completo', this.nome_completo);
            formData.append('username', this.username);
            formData.append('senha', this.senha);
        
            if (this.avatar) {
                formData.append('avatar', this.avatar); // Adiciona a imagem ao FormData
            }
        
            try {
                const response = await fetch(`${dominio}/user/registro`, {
                    method: 'POST',
                    body: formData
                });
        
                // Verifica o tipo de conteúdo da resposta
                const contentType = response.headers.get("Content-Type");
                console.log("Content-Type:", contentType); // Verificar o tipo da resposta
        
                if (!response.ok) {
                    throw new Error(`Erro HTTP: ${response.status} - ${response.statusText}`);
                }
        
                // Ler o conteúdo da resposta antes de tentar fazer o JSON
                const text = await response.text();
                console.log("Resposta bruta:", text); // Log da resposta bruta
        
                // Se o conteúdo for JSON, converta
                if (contentType && contentType.includes("application/json")) {
                    const result = JSON.parse(text); // Tentar converter manualmente para JSON
        
                    // Verifica se a resposta JSON é bem-sucedida
                    if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso',
                            text: 'Cadastro realizado com sucesso!'
                        });
                    } else {
                        Swal.fire({
                            icon: result.icon,
                            title: result.title,
                            html: result.message || 'Ocorreu um erro durante o cadastro.'
                        });
                    }
                } else {
                    throw new Error("Resposta não é um JSON válido.");
                }
            } catch (error) {
                // Se houver erro ao tentar converter a resposta em JSON ou outro erro
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de conexão',
                    text: error.message || 'Não foi possível enviar os dados.'
                });
            }
        }
        
    }
});
