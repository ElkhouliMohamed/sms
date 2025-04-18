<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        

        // Tableaux Niveaux Scolaires
        Schema::create('niveaux_scolaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique(); // e.g., "Primaire", "Secondaire"
            $table->text('description')->nullable();
            $table->integer('ordre')->default(0); // For sorting levels
            $table->timestamps();
        });

        // Tableaux Classes
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // e.g., "Grade 1", "Classe 6ème"
            $table->foreignId('niveau_scolaire_id')->constrained('niveaux_scolaires')->onDelete('restrict');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tableaux Enseignants (Teachers)
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('prenom');
            $table->string('nom_de_famille');
            $table->string('telephone', 20)->nullable();
            $table->string('email')->unique();
            $table->string('adresse')->nullable();
            $table->timestamps();
        });

        // Tableaux Pivot Class-Teacher
        Schema::create('class_teacher', function (Blueprint $table) {
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->primary(['class_id', 'teacher_id']);
            $table->timestamps();
        });

        // Tableaux Élèves
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users')->onDelete('cascade');
            $table->string('prenom');
            $table->string('nom_de_famille');
            $table->string('image')->nullable();
            $table->string('telephone', 20);
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('pays')->nullable();
            $table->string('sexe', 10)->nullable(); // 'masculin' ou 'feminin'
            $table->string('etat_civil', 20)->nullable(); // 'celibataire', 'marie', 'divorce', etc.
            $table->string('nationalite')->nullable();
            $table->string('numero_identite')->nullable();
            $table->string('nom_tuteur')->nullable();
            $table->string('telephone_tuteur')->nullable();
            $table->string('adresse_tuteur')->nullable();
            $table->date('date_de_naissance');
            $table->foreignId('classe_id')->constrained('classes')->onDelete('restrict');
            $table->timestamps();
        });

        // Tableaux Parents
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users')->onDelete('cascade');
            $table->string('prenom');
            $table->string('nom_de_famille');
            $table->string('telephone', 20);
            $table->timestamps();
        });

        // Tableaux Pivot Parent-Élève
        Schema::create('parent_eleve', function (Blueprint $table) {
            $table->foreignId('parent_id')->constrained('parents')->onDelete('cascade');
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->primary(['parent_id', 'eleve_id']);
            $table->timestamps();
        });

        // Tableaux Matières
        Schema::create('matieres', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->foreignId('classe_id')->constrained('classes')->onDelete('restrict');
            $table->foreignId('enseignant_id')->constrained('teachers')->onDelete('restrict'); // Updated to teachers
            $table->timestamps();
        });

        // Tableaux Absences
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('restrict');
            $table->date('date');
            $table->text('raison')->nullable();
            $table->timestamps();
        });

        // Tableaux Notes
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('restrict');
            $table->decimal('note', 5, 2);
            $table->date('date_examen');
            $table->timestamps();
        });

        // Tableaux Paiements
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->date('date_paiement');
            $table->enum('type_paiement', ['scolarite', 'transport', 'autre']);
            $table->enum('statut', ['en_attente', 'complete', 'echoue']);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tableaux Transports
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string('numero_vehicule', 50);
            $table->string('nom_chauffeur');
            $table->text('description_trajet');
            $table->timestamps();
        });

        // Tableaux Pivot Élève-Transport
        Schema::create('eleve_transport', function (Blueprint $table) {
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->foreignId('transport_id')->constrained('transports')->onDelete('restrict');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->primary(['eleve_id', 'transport_id']);
            $table->timestamps();
        });

        // Tableaux Emplois du temps
        Schema::create('emplois_du_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained('classes')->onDelete('restrict');
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('restrict');
            $table->enum('jour', ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche']);
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('titre_fichier')->nullable();
            $table->string('chemin_fichier')->nullable();
            $table->enum('type_fichier', ['pdf', 'image'])->nullable();
            $table->string('extension_fichier', 10)->nullable();
            $table->unsignedBigInteger('taille_fichier')->nullable();
            $table->timestamps();
        });

        // Tableaux Comptables
        Schema::create('comptables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users')->onDelete('cascade');
            $table->string('prenom');
            $table->string('nom_de_famille');
            $table->string('telephone', 20);
            $table->timestamps();
        });

        // Tableaux Documents Employés
        Schema::create('documents_employes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users')->onDelete('cascade');
            $table->string('titre');
            $table->string('chemin_fichier');
            $table->enum('type_fichier', ['pdf', 'image']);
            $table->string('extension_fichier', 10);
            $table->unsignedBigInteger('taille_fichier');
            $table->timestamps();
        });
        Schema::create('matiere_enseignant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matiere_id')->constrained()->onDelete('cascade');
            $table->foreignId('enseignant_id')->constrained('teachers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_employes');
        Schema::dropIfExists('comptables');
        Schema::dropIfExists('emplois_du_temps');
        Schema::dropIfExists('eleve_transport');
        Schema::dropIfExists('transports');
        Schema::dropIfExists('paiements');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('absences');
        Schema::dropIfExists('matieres');
        Schema::dropIfExists('parent_eleve');
        Schema::dropIfExists('parents');
        Schema::dropIfExists('eleves');
        Schema::dropIfExists('class_teacher');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('niveaux_scolaires');
        Schema::dropIfExists('users');
    }
};
