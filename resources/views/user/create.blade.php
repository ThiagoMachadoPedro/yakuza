@vite(['resources/sass/app.scss', 'resources/js/app.js'])


<style>
           header {
            width: 100%;
            background-color: #dc3545;
            color: white;
            padding: 19px;
            margin-bottom: 20px;
            position: relative; /* Adiciona position: relative; */
        }
         body {
        font-size: 1.2rem;
    }

    /* Estilização para dispositivos móveis */
    @media (max-width: 768px) {
        /* Colocar os inputs um abaixo do outro */
        .mb-3 {
            margin-bottom: 1rem;
        }

        /* Centralizar botões */
        .btn {
            width: 100%;
        }
}
</style>


 <header>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center red-header">
                <div class="d-flex align-items-center">
                    <h3>YAKUZA</h3>
                </div>

</div>
            </div>

    </header>



      <div class="container">
    <h1>Cadastro de Usuário</h1>

    @include('components/mensagens')


    <form action="{{route('user-store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nick" class="form-label">Nick</label>
                    <input type="text" class="form-control" id="nick" name="nick" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="imageUser" class="form-label">Foto de Perfil</label>
                    <input type="file" class="form-control" id="imageUser" name="imageUser" accept="image/*" required>
                </div>
            </div>

            {{-- implementar depoois quem poder ver essa opção
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="access_level" class="form-label">Selecione uma opção:</label>
                    <select class="form-select" id="access_level" name="access_level" aria-label="Selecione uma opção">
                        <option selected>Selecione...</option>
                        <option value="1">ADMIN</option>
                        <option value="2">USUÁRIO</option>
                    </select>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary ">Cadastrar e Logar</button>
        <a href="{{route('login-index')}}" class="btn btn-warning ">Voltar ao Login</a>
        {{-- implementar para voltar ao login
        <a href="{{route('index')}}"></a> --}}
    </form>
</div>
