<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // SUPPRIMEZ cette ligne qui cause l'erreur :
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $products = Product::where('user_id', Auth::id())
                          ->paginate(10);
        $totalProducts = Product::where('user_id', Auth::id())->count();
        
        return view('products.index', compact('products', 'totalProducts'));
    }

    public function create()
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $categories = ['Électronique', 'Vêtements', 'Alimentation', 'Maison', 'Sport', 'Autres'];
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'details' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'categorie' => 'nullable|string'
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'details' => $request->details,
            'image' => $imagePath,
            'categorie' => $request->categorie,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('products.index')
                        ->with('success', 'Produit créé avec succès!');
    }

    public function show(Product $product)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier que l'utilisateur possède ce produit
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier que l'utilisateur possède ce produit
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $categories = ['Électronique', 'Vêtements', 'Alimentation', 'Maison', 'Sport', 'Autres'];
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier que l'utilisateur possède ce produit
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categorie' => 'nullable|string'
        ]);

        $data = [
            'nom' => $request->nom,
            'prix' => $request->prix,
            'details' => $request->details,
            'categorie' => $request->categorie,
        ];

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
                        ->with('success', 'Produit mis à jour avec succès!');
    }

    public function destroy(Product $product)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier que l'utilisateur possède ce produit
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
                        ->with('success', 'Produit supprimé avec succès!');
    }
}