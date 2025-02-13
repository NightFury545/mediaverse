<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchMoviesCommand extends Command
{
    protected $signature = 'movies:fetch';
    protected $description = 'Fetch new movies from TMDb API and save to database';

    private string $apiUrl;
    private string $apiKey;
    private array $genresMap = [];
    private int $totalPages = 5;

    public function handle(): void
    {
        $this->apiUrl = config('services.tmdb.api_url');
        $this->apiKey = config('services.tmdb.api_key');

        $this->info('Fetching new movies from TMDb API...');

        $this->fetchGenres();

        for ($page = 1; $page <= $this->totalPages; $page++) {
            $this->info("Fetching page {$page} of new movies...");

            $response = Http::get("{$this->apiUrl}/movie/now_playing", [
                'api_key' => $this->apiKey,
                'language' => 'en-US',
                'page' => $page
            ]);

            if ($response->failed()) {
                $this->error("Failed to fetch page {$page} of new movies.");
                continue;
            }

            $movies = $response->json()['results'] ?? [];

            foreach ($movies as $movieData) {
                $this->processMovie($movieData);
            }
        }

        $this->info('New movies successfully fetched and stored.');
    }

    private function fetchGenres(): void
    {
        $response = Http::get("{$this->apiUrl}/genre/movie/list", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        if ($response->successful()) {
            $this->genresMap = collect($response->json()['genres'] ?? [])
                ->pluck('name', 'id')
                ->toArray();
        }
    }

    private function processMovie(array $movieData): void
    {
        $directorData = $this->fetchDirector($movieData['id']);
        $director = Director::firstOrCreate(
            ['name' => $directorData['name']],
            ['birth_date' => $directorData['birth_date'], 'profile_path' => $directorData['profile_path']]
        );

        $movieDetails = $this->fetchMovieDetails($movieData['id']);

        $movie = Movie::firstOrCreate(
            ['title' => $movieData['title']],
            [
                'description' => $movieData['overview'] ?? null,
                'release_date' => $movieData['release_date'] ?? null,
                'runtime' => $movieDetails['runtime'] ?? null,
                'poster_path' => $movieData['poster_path'] ?? null,
                'backdrop_path' => $movieData['backdrop_path'] ?? null,
                'api_rating' => $movieData['vote_average'] ?? 0,
                'director_id' => $director->id,
            ]
        );

        $this->attachActors($movie, $movieData['id']);
        $this->attachGenres($movie, $movieData['genre_ids'] ?? []);
    }

    private function fetchMovieDetails(int $movieId): array
    {
        $response = Http::get("{$this->apiUrl}/movie/{$movieId}", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        if ($response->failed()) {
            return ['runtime' => null];
        }

        $movieDetails = $response->json();
        return [
            'runtime' => $movieDetails['runtime'] ?? null, // Отримуємо runtime
        ];
    }

    private function fetchDirector(int $movieId): array
    {
        $response = Http::get("{$this->apiUrl}/movie/{$movieId}/credits", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        if ($response->failed()) {
            return ['name' => 'Unknown Director', 'birth_date' => null, 'profile_path' => null];
        }

        $crew = collect($response->json()['crew'] ?? []);
        $director = $crew->firstWhere('job', 'Director');

        if ($director && isset($director['id'])) {
            $directorDetails = $this->fetchPersonDetails($director['id']);
            return [
                'name' => $director['name'] ?? 'Unknown Director',
                'birth_date' => $directorDetails['birth_date'] ?? null,
                'profile_path' => $directorDetails['profile_path'] ?? null
            ];
        }

        return [
            'name' => 'Unknown Director',
            'birth_date' => null,
            'profile_path' => null
        ];
    }

    private function fetchActorDetails(int $actorId): array
    {
        $response = Http::get("{$this->apiUrl}/person/{$actorId}", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        if ($response->failed()) {
            return ['birth_date' => null, 'profile_path' => null];
        }

        $actorDetails = $response->json();
        return [
            'birth_date' => $actorDetails['birthday'] ?? null,
            'profile_path' => $actorDetails['profile_path'] ?? null
        ];
    }

    private function attachActors(Movie $movie, int $movieId): void
    {
        $response = Http::get("{$this->apiUrl}/movie/{$movieId}/credits", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        if ($response->failed()) {
            return;
        }

        $actors = collect($response->json()['cast'] ?? [])
            ->take(10)
            ->map(function ($actor) {
                $actorDetails = $this->fetchActorDetails($actor['id']);
                return Actor::firstOrCreate(
                    [
                        'name' => $actor['name'],
                        'birth_date' => $actorDetails['birth_date'],
                        'profile_path' => $actorDetails['profile_path']
                    ]
                );
            });

        $movie->actors()->sync($actors->pluck('id'));
    }

    private function attachGenres(Movie $movie, array $genreIds): void
    {
        $genres = collect($genreIds)
            ->map(fn($id) => Genre::firstOrCreate(['name' => $this->genresMap[$id] ?? 'Unknown']));

        $movie->genres()->sync($genres->pluck('id'));
    }

    private function fetchPersonDetails(int $personId): array
    {
        $response = Http::get("{$this->apiUrl}/person/{$personId}", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        if ($response->failed()) {
            return ['birth_date' => null, 'profile_path' => null];
        }

        $personDetails = $response->json();
        return [
            'birth_date' => $personDetails['birthday'] ?? null,
            'profile_path' => $personDetails['profile_path'] ?? null
        ];
    }
}
