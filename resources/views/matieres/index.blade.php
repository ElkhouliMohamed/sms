<!-- resources/views/matieres/index.blade.php -->
@extends('layouts.app')

@section('title', 'Liste des Matières')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Liste des Matières</h1>

    <!-- Message de succès -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bouton pour créer une nouvelle matière -->
    <div class="mb-6">
        <a href="{{ route('matieres.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
            Ajouter une Matière
        </a>
    </div>

    <!-- Tableau des matières -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Classe</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignants</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($matieres as $matiere)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $matiere->nom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $matiere->description ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $matiere->classe->nom ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $matiere->enseignants->pluck('nom')->implode(', ') ?: 'Aucun' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('matieres.edit', $matiere) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Modifier</a>
                            <form action="{{ route('matieres.destroy', $matiere) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Voulez-vous vraiment supprimer cette matière ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            Aucune matière trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection