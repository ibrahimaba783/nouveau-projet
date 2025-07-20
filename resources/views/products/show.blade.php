@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-eye text-primary"></i> Détails du Produit</h5>
                <div class="btn-group">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" 
                          method="POST" 
                          style="display: inline;"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center mb-4">
                            <img src="{{ Storage::url($product->image) }}" 
                                 alt="{{ $product->nom }}" 
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="mb-3">{{ $product->nom }}</h2>
                        
                        <div class="mb-3">
                            <h4 class="text-success">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</h4>
                        </div>

                        @if($product->categorie)
                            <div class="mb-3">
                                <strong>Catégorie:</strong>
                                <span class="badge bg-secondary ms-2">{{ $product->categorie }}</span>
                            </div>
                        @endif

                        @if($product->details)
                            <div class="mb-3">
                                <strong>Description:</strong>
                                <p class="mt-2 text-muted">{{ $product->details }}</p>
                            </div>
                        @endif

                        <div class="mb-3">
                            <small class="text-muted">
                                <strong>Ajouté le:</strong> {{ $product->created_at->format('d/m/Y à H:i') }}<br>
                                @if($product->updated_at != $product->created_at)
                                    <strong>Dernière modification:</strong> {{ $product->updated_at->format('d/m/Y à H:i') }}
                                @endif
                            </small>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la Liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection