<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
}

.background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('/storage/sistem/fotoClã.jpg');
    background-size: cover;
    background-position: center;
    filter: blur(4px);
    z-index: -1;
}




.card {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card h2 {
    text-align: center;
    margin-bottom: 20px;
}

.input-group {
    margin-bottom: 15px;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
}

.input-group input {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
<div class="background"></div>
<div class="container">



    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <h2>YAKUZA</h2>
                <form action="{{ route('login-store') }}" method="POST">
                      @csrf
                           <div class="mb-3">
                              <label for="email" class="form-label">E-mail</label>
                              <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                              @error('email')
                              <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                             </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                        <label class="form-check-label" for="remember">Lembre-me</label>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Login</button>


                    <a href="{{route('user-created')}}" class="btn btn-danger btn-lg">Cadastro</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
