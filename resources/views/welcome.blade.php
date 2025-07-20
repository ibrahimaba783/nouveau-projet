<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion de Produits - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-primary text-white">
                <div class="text-center">
                    <i class="fas fa-box fa-5x mb-4"></i>
                    <h1 class="display-4 mb-4">Gestion de Produits</h1>
                    <p class="lead">Gérez facilement vos produits avec notre application moderne et intuitive.</p>
                    <div class="row mt-5">
                        <div class="col-4">
                            <i class="fas fa-shield-alt fa-2x mb-2"></i>
                            <h6>Sécurisé</h6>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-mobile-alt fa-2x mb-2"></i>
                            <h6>Responsive</h6>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-bolt fa-2x mb-2"></i>
                            <h6>Rapide</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="card shadow-lg" style="width: 400px;">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Commencer</h3>
                        
                        @auth
                            <div class="text-center mb-4">
                                <p class="text-muted">Bonjour, {{ Auth::user()->name }}!</p>
                            </div>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="fas fa-tachometer-alt"></i> Tableau de Bord
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="fas fa-sign-in-alt"></i> Se Connecter
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg w-100">
                                <i class="fas fa-user-plus"></i> S'Inscrire
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>