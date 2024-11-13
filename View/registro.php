<?=$this->layout("temas/loginCadastro", ['title' => $title])?>

<link href="<?=Assests("/")?>css/form.css" rel="stylesheet">

<div id="app" class="container">
   <div class="row">
       <div class="col-12">
           <div class="my-5">
               <h3>Cadastro</h3>
           </div>
           <form class="file-upload" @submit.prevent="handleSubmit" enctype="multipart/form-data">
               <div class="row mb-5 gx-5">
                   <div class="col-xxl-8 mb-5 mb-xxl-0">
                       <div class="bg-secondary-soft px-4 py-5 rounded">
                           <div class="row g-3">
                               <h4 class="mb-4 mt-0">Informações</h4>
                               <div class="col-md-6">
                                   <label class="form-label">Nome Completo</label>
                                   <input type="text" v-model="nome_completo" class="form-control">
                               </div>
                               <div class="col-md-6">
                                   <label class="form-label">Nome de usuario</label>
                                   <input type="text" v-model="username" class="form-control">
                               </div>
                               <div class="col-md-6">
                                   <label class="form-label">Senha</label>
                                   <input type="password" v-model="senha" class="form-control" @keyup="validaSenha">
                               </div>
                               <div class="col-md-12">
                                   <label class="form-label">Regras da Senha</label>
                                   <ul style="list-style:none;">
                                       <li><i :class="senhaValidacoes.minimoChar ? 'fa-solid fa-circle-check text-success' : 'fa-solid fa-circle-xmark text-danger'"></i> Precisa conter no minimo 8 caracteres</li>
                                       <li><i :class="senhaValidacoes.numero ? 'fa-solid fa-circle-check text-success' : 'fa-solid fa-circle-xmark text-danger'"></i> Precisa conter número de 1 até 9</li>
                                       <li><i :class="senhaValidacoes.maiuscula ? 'fa-solid fa-circle-check text-success' : 'fa-solid fa-circle-xmark text-danger'"></i> Precisa conter uma letra Maiúscula (A ... Z)</li>
                                       <li><i :class="senhaValidacoes.minuscula ? 'fa-solid fa-circle-check text-success' : 'fa-solid fa-circle-xmark text-danger'"></i> Precisa conter letras Minúsculas (a ... z)</li>
                                       <li><i :class="senhaValidacoes.simbolo ? 'fa-solid fa-circle-check text-success' : 'fa-solid fa-circle-xmark text-danger'"></i> Precisa conter caracter especial (@ ou ! ou & ou ?)</li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-xxl-4">
                       <div class="bg-secondary-soft px-4 py-5 rounded">
                           <div class="row g-3">
                               <h4 class="mb-4 mt-0">Avatar</h4>
                               <div class="text-center">
                                   <div class="square position-relative display-2 mb-3">
                                       <img :src="imagePreview" alt="Sem avatar" width="250" height="250">
                                   </div>
                                   <input type="file" @change="previewImage"  accept="image/*" hidden id="customFile">
                                   <label class="btn btn-success-soft btn-block" for="customFile">Procurar imagem</label>
                                   <p class="text-muted mt-3 mb-0">De preferência uma foto sua</p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="gap-3 d-md-flex justify-content-md-start text-center">
                   <button type="submit" class="btn btn-success btn-lg">Salvar</button>
               </div>
           </form>
       </div>
   </div>
</div>

<script src="<?=scriptsVueJs("usuario/registro.js")?>"></script>