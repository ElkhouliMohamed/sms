@extends('layouts.app')

@section('content')
<div class="w-full h-full flex items-center justify-center bg-gray-400">
    <div class="text-center space-y-6 px-4 max-w-screen">
        <h1 class="text-4xl sm:text-5xl font-bold">Bienvenue dans le système de gestion scolaire</h1>
        <p class="text-lg sm:text-xl max-w-2xl mx-auto">
            Gérez les étudiants, enseignants, emplois du temps, absences, et bien plus à partir d’un seul tableau de bord.
        </p>

        <div class="space-x-4">
            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-gray-100">
                Se connecter
            </a>
            <a href="{{ route('register') }}" class="inline-block px-6 py-3 border border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition">
                S'inscrire
            </a>
        </div>
    </div>
</div>
@endsection
