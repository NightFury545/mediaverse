<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Filament\Widgets\ChartWidget;

class MediaStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Media Statistics';

    protected function getData(): array
    {
        $totalPosts = Post::count();
        $totalLikes = Like::count();
        $totalComments = Comment::count();

        return [
            'datasets' => [
                [
                    'label' => 'Statistics',
                    'data' => [$totalPosts, $totalLikes, $totalComments],
                    'backgroundColor' => ['#3498db', '#e74c3c', '#2ecc71'],
                ],
            ],
            'labels' => ['Posts', 'Likes', 'Comments'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
