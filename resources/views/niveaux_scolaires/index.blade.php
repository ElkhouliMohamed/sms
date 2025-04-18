
@extends('layouts.app')

@section('title', 'Niveaux Scolaires')

@section('content')
    <div class="w-full flex flex-col gap-6">
        <!-- Header -->
        <div class="bg-white p-6 rounded-lg shadow-md flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Niveaux Scolaires</h1>
            <a href="{{ route('niveaux_scolaires.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Ajouter Niveau Scolaire
            </a>
        </div>

        <!-- Niveaux Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Liste des Niveaux Scolaires</h2>
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
                            <th class="py-3 px-6 text-left">Description</th>
                            <th class="py-3 px-6 text-left">Ordre</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach ($niveaux as $niveau)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $niveau->nom }}</td>
                                <td class="py-3 px-6 text-left">{{ $niveau->description ?? 'Aucune' }}</td>
                                <td class="py-3 px-6 text-left">{{ $niveau->ordre }}</td>
                                <td class="py-3 px-6 text-center flex justify-center gap-2">
                                    <a href="{{ route('niveaux_scolaires.show', $niveau) }}" class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('niveaux_scolaires.edit', $niveau) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('niveaux_scolaires.destroy', $niveau) }}" method="POST" class="inline">
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
