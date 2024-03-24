<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">




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

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            cursor: pointer; /* Adiciona cursor: pointer; para indicar que é clicável */
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #0c0303;
            width: 160px; /* Define a largura do dropdown */
            min-width: 160px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            top: 100%; /* Posiciona o dropdown abaixo do elemento pai */
            left: 0; /* Alinha o dropdown com o canto esquerdo do elemento pai */
        }

        .dropdown-menu a {
            text-align: center;
            font-weight: bolder;
            padding: 12px 33px;
            display: block;
            color: #f6f1f1;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #b74444;
        }

        .dropdown-menu button {
                    font-weight:  bold;
                    padding: 12px 63px;
                    display: block;
                    color: #ef9a9a;
                    text-decoration: none;
                    background-color: #dc3545;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                    }

.dropdown-menu button:hover {
    background-color: #b74444;
}


    </style>

    <title>@yield('title')</title>
</head>
<body>
           <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <header>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center red-header">
                <div class="d-flex align-items-center">


                    @auth
                     <img src="{{ Auth::user()->imageUser ? url("storage/" . Auth::user()->imageUser) : 'https://media.istockphoto.com/vectors/person-gray-photo-placeholder-man-vector-id1152265845?k=20&m=1152265845&s=170667a&w=0&h=RZF10k2BsiHIjCrVDuESMN9M7kb81k7cyk74F52jvdg=' }}" alt="Profile Image" class="profile-img" id="dropdown-icon">

                      @endauth

                    <a class="text-white" href="{{route('post-index')}}">
                    <h3>YAKUZA</h3>
                    </a>
                </div>

               @auth
<p>Olá, {{ Auth::user()->name }}

</p>

<div id="dropdown-menu" class="dropdown-menu ">



                    <a href="{{route('dashboard')}}">Dashboard</a>


                    <a href="{{route('user-index')}}">Usuários</a>




                    <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <button type="submit">Sair</button>
                    </form>


</div>


               @endauth


            </div>
        </div>
    </header>





@yield('conteudo')


<script>
          document.getElementById('dropdown-icon').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    if (dropdownMenu.style.display === 'block') {
        dropdownMenu.style.display = 'none';
    } else {
        dropdownMenu.style.display = 'block';
    }
});

</script>

</body>


</html>
