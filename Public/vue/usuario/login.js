new Vue({
    el: '#app',
    data() {
        return {
            username: '',
            senha: '',
            errorMessage: ''
        };
    },
    methods: {
        async handleSubmit() {
            try {
                const response = await fetch(`${dominio}/user/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        username: this.username,
                        senha: this.senha
                    })
                });

                if (response.ok) {
                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login realizado com sucesso!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = `${dominio}/app`;  // Redireciona para a página de perfil
                        });
                    } else {
                        // Exibe a mensagem de erro retornada pelo back-end
                        Swal.fire({
                            icon: data.icon,
                            title: data.title,
                            html: data.message,
                        });
                    }
                } else {
                    this.errorMessage = 'Erro de conexão';
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro de conexão',
                        text: 'Não foi possível conectar ao servidor.',
                    });
                }
            } catch (error) {
                this.errorMessage = 'Erro de conexão';
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de conexão',
                    text: 'Não foi possível conectar ao servidor.',
                });
            }
        }
    }
});
