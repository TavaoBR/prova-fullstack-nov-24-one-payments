<?=$this->layout("temas/loginCadastro", ['title' => $title])?>

<link href="<?=Assests("/")?>css/login.css" rel="stylesheet">

<?=validateSession("AcessoRestrito")?>
    
<div id="app" class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!-- Left Box -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <img src="<?=Assests("/")?>usuario/5987811.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-weight: 600;">Login</p>
                <small class="text-white text-wrap text-center" style="width: 17rem; font-weight: 600;">
                    Para entrar na plataforma, faça o login da sua conta
                </small>
            </div>
            <!-- Right Box -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4" v-if="errorMessage">
                        <div v-html="errorMessage"></div>
                    </div>
                    <form @submit.prevent="handleSubmit">
                        <div class="input-group mb-3">
                            <label for="usuario">Username</label>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" v-model="username" class="form-control form-control-lg bg-light fs-6" >
                        </div>
                        <div class="input-group mb-1">
                            <label for="senha">Senha</label>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" v-model="senha" class="form-control form-control-lg bg-light fs-6" >
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit">Logar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script src="<?=scriptsVueJs("usuario/login.js")?>"></script>
