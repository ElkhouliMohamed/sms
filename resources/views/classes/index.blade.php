@extends('layouts.app')

@section('title', 'Classes')

@section('content')
    <div class="w-full flex flex-col gap-6">
        <!-- Header -->
        <div class="bg-white p-6 rounded-lg shadow-md flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Classes</h1>
            <a href="{{ route('classes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Ajouter Classe
            </a>
        </div>

        <!-- Classes Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Liste des Classes</h2>
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Nom</th>
                            <th class="py-3 px-6 text-left">Niveau Scolaire</th>
                            <th class="py-3 px-6 text-left">Enseignants</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach ($classes as $classe)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $classe->nom }}</td>
                                <td class="py-3 px-6 text-left">{{ $classe->niveauScolaire->nom ?? 'Aucun' }}</td>
                                <td class="py-3 px-6 text-left">
                                    {{ $classe->teachers->pluck('prenom')->join(', ') ?: 'Aucun' }}
                                </td>
                                <td class="py-3 px-6 text-center flex justify-center gap-2">
                                    <a href="{{ route('classes.show', $classe) }}" class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('classes.edit', $classe) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('classes.destroy', $classe) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection