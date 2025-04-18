@extends('layouts.app')

@section('title', 'Ajouter Élève')

@section('content')
    <div class="w-full flex flex-col gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Ajouter Nouvel Élève</h1>
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="prenom" class="block text-gray-700">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="w-full border-gray-300 rounded-lg" required>
                        @error('prenom') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="nom_de_famille" class="block text-gray-700">Nom de Famille</label>
                        <input type="text" name="nom_de_famille" id="nom_de_famille" class="w-full border-gray-300 rounded-lg" required>
                        @error('nom_de_famille') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-lg" required>
                        @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700">Mot de Passe</label>
                        <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-lg" required>
                        @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-gray-700">Confirmer Mot de Passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded-lg" required>
                    </div>
                    <div>
                        <label for="image" class="block text-gray-700">Photo</label>
                        <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-lg">
                        @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="telephone" class="block text-gray-700">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" class="w-full border-gray-300 rounded-lg" required>
                        @error('telephone') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="adresse" class="block text-gray-700">Adresse</label>
                        <textarea name="adresse" id="adresse" class="w-full border-gray-300 rounded-lg"></textarea>
                        @error('adresse') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="ville" class="block text-gray-700">Ville</label>
                        <input type="text" name="ville" id="ville" class="w-full border-gray-300 rounded-lg">
                        @error('ville') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="code_postal" class="block text-gray-700">Code Postal</label>
                        <input type="text" name="code_postal" id="code_postal" class="w-full border-gray-300 rounded-lg">
                        @error('code_postal') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="pays" class="block text-gray-700">Pays</label>
                        <input type="text" name="pays" id="pays" class="w-full border-gray-300 rounded-lg">
                        @error('pays') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="sexe" class="block text-gray-700">Sexe</label>
                        <select name="sexe" id="sexe" class="w-full border-gray-300 rounded-lg">
                            <option value="">Sélectionner</option>
                            <option value="masculin">Masculin</option>
                            <option value="feminin">Féminin</option>
                        </select>
                        @error('sexe') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="etat_civil" class="block text-gray-700">État Civil</label>
                        <select name="etat_civil" id="etat_civil" class="w-full border-gray-300 rounded-lg">
                            <option value="">Sélectionner</option>
                            <option value="celibataire">Célibataire</option>
                            <option value="marie">Marié</option>
                            <option value="divorce">Divorcé</option>
                            <option value="veuf">Veuf</option>
                        </select>
                        @error('etat_civil') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="nationalite" class="block text-gray-700">Nationalité</label>
                        <input type="text" name="nationalite" id="nationalite" class="w-full border-gray-300 rounded-lg">
                        @error('nationalite') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="numero_identite" class="block text-gray-700">Numéro d'Identité</label>
                        <input type="text" name="numero_identite" id="numero_identite" class="w-full border-gray-300 rounded-lg">
                        @error('numero_identite') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="nom_tuteur" class="block text-gray-700">Nom du Tuteur</label>
                        <input type="text" name="nom_tuteur" id="nom_tuteur" class="w-full border-gray-300 rounded-lg">
                        @error('nom_tuteur') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="telephone_tuteur" class="block text-gray-700">Téléphone du Tuteur</label>
                        <input type="text" name="telephone_tuteur" id="telephone_tuteur" class="w-full border-gray-300 rounded-lg">
                        @error('telephone_tuteur') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="adresse_tuteur" class="block text-gray-700">Adresse du Tuteur</label>
                        <textarea name="adresse_tuteur" id="adresse_tuteur" class="w-full border-gray-300 rounded-lg"></textarea>
                        @error('adresse_tuteur') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="date_de_naissance" class="block text-gray-700">Date de Naissance</label>
                        <input type="date" name="date_de_naissance" id="date_de_naissance" class="w-full border-gray-300 rounded-lg" required>
                        @error('date_de_naissance') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="classe_id" class="block text-gray-700">Classe</label>
                        <select name="classe_id" id="classe_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Sélectionner Classe</option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                        @error('classe_id') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="parent_ids" class="block text-gray-700">Parents</label>
                        <select name="parent_ids[]" id="parent_ids" class="w-full border-gray-300 rounded-lg" multiple>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->nom_complet }}</option>
                            @endforeach
                        </select>
                        @error('parent_ids') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        Créer Élève
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection