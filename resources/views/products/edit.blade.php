@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit text-warning"></i> Modifier le Produit</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom du Produit <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" 
                                   name="nom" 
                                   value="{{ old('nom', $product->nom) }}" 
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="prix" class="form-label">Prix (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('prix') is-invalid @enderror" 
                                   id="prix" 
                                   name="prix" 
                                   value="{{ old('prix', $product->prix) }}" 
                                   step="0.01" 
                                   min="0" 
                                   required>
                            @error('prix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <select class="form-select @error('categorie') is-invalid @enderror" 
                                    id="categorie" 
                                    name="categorie">
                                <option value="">Sélectionner une catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie }}" 
                                            {{ old('categorie', $product->categorie) == $categorie ? 'selected' : '' }}>
                                        {{ $categorie }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Nouvelle Image (optionnel)</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/jpeg,image/png,image/jpg">
                            <div class="form-text">Formats acceptés: JPG, PNG. Taille max: 2 Mo. Laissez vide pour conserver l'image actuelle.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image actuelle -->
                    <div class="mb-3">
                        <label class="form-label">Image Actuelle:</label>
                        <div class="mt-2">
                            <img src="{{ Storage::url($product->image) }}" 
                                 alt="{{ $product->nom }}" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px; max-height: 200px; object-fit: cover;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="details" class="form-label">Détails du Produit</label>
                        <textarea class="form-control @error('details') is-invalid @enderror" 
                                  id="details" 
                                  name="details" 
                                  rows="4" 
                                  placeholder="Description détaillée du produit...">{{ old('details', $product->details) }}</textarea>
                        @error('details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Mettre à Jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection