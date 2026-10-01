<?php

namespace Database\Seeders;

use App\Services\SupabaseService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlayerSeeder extends Seeder
{
    protected SupabaseService $supabase;

    public function __construct()
    {
        $this->supabase = app(SupabaseService::class);
    }

    public function run(): void
    {
        $this->command->info('Seeding players...');

        // Get categories
        $categories = $this->supabase->serviceFrom('categories')->select('id,name,slug')->get();
        $catMap = [];
        foreach ($categories as $cat) {
            $catMap[$cat['slug']] = $cat['id'];
        }

        $this->command->info('Found ' . count($catMap) . ' categories: ' . implode(', ', array_keys($catMap)));

        // Delete existing seed data (by slug prefix)
        $this->cleanExistingData();

        // Define players
        $players = $this->getPlayerData($catMap);

        foreach ($players as $index => $playerData) {
            $this->command->info("Seeding player " . ($index + 1) . "/{$this->getPlayerCount()}: {$playerData['first_name']} {$playerData['last_name']}");

            $related = $playerData['_related'] ?? [];
            unset($playerData['_related']);

            // Insert player
            $result = $this->supabase->serviceFrom('players')->insert($playerData);
            $playerId = $result[0]['id'] ?? null;

            if (!$playerId) {
                $this->command->error("Failed to insert player: {$playerData['first_name']} {$playerData['last_name']}");
                continue;
            }

            // Insert related data
            $this->insertRelatedData($playerId, $related);
        }

        $this->command->info('Player seeding complete!');
    }

    protected function getPlayerCount(): int
    {
        return 10;
    }

    protected function cleanExistingData(): void
    {
        $slugs = [
            'marcus-rivera', 'aisha-johnson', 'yuki-tanaka', 'arjun-patel',
            'elena-petrova', 'kwame-asante', 'sofia-rossi', 'liam-obrien',
            'diego-morales', 'kaya-demir',
        ];

        foreach ($slugs as $slug) {
            try {
                $player = $this->supabase->serviceFrom('players')->select('id')->where('slug', 'eq', $slug)->first();
                if ($player) {
                    $id = $player['id'];
                    // Delete related data first
                    foreach (['player_career_history', 'player_achievements', 'player_statistics', 'player_skills', 'player_galleries', 'player_videos', 'player_social_links'] as $table) {
                        try {
                            $this->supabase->serviceFrom($table)->where('player_id', 'eq', $id)->delete();
                        } catch (\Exception $e) {}
                    }
                    // Delete player
                    $this->supabase->serviceFrom('players')->where('id', 'eq', $id)->delete();
                }
            } catch (\Exception $e) {}
        }
    }

    protected function insertRelatedData(int $playerId, array $related): void
    {
        // Career history
        foreach ($related['career'] ?? [] as $entry) {
            $entry['player_id'] = $playerId;
            try { $this->supabase->serviceFrom('player_career_history')->insert($entry); } catch (\Exception $e) {}
        }

        // Achievements
        foreach ($related['achievements'] ?? [] as $entry) {
            $entry['player_id'] = $playerId;
            try { $this->supabase->serviceFrom('player_achievements')->insert($entry); } catch (\Exception $e) {}
        }

        // Statistics
        foreach ($related['statistics'] ?? [] as $entry) {
            $entry['player_id'] = $playerId;
            try { $this->supabase->serviceFrom('player_statistics')->insert($entry); } catch (\Exception $e) {}
        }

        // Skills
        foreach ($related['skills'] ?? [] as $entry) {
            $entry['player_id'] = $playerId;
            try { $this->supabase->serviceFrom('player_skills')->insert($entry); } catch (\Exception $e) {}
        }

        // Gallery
        foreach ($related['gallery'] ?? [] as $entry) {
            $entry['player_id'] = $playerId;
            try { $this->supabase->serviceFrom('player_galleries')->insert($entry); } catch (\Exception $e) {}
        }

        // Social links
        foreach ($related['social_links'] ?? [] as $entry) {
            $entry['player_id'] = $playerId;
            try { $this->supabase->serviceFrom('player_social_links')->insert($entry); } catch (\Exception $e) {}
        }
    }

    protected function getPlayerData(array $catMap): array
    {
        $baseUrl = '/images/players/';
        $galleryUrl = '/images/gallery/';

        return [
            // ==========================================
            // 1. MARCUS RIVERA - Football (Soccer)
            // ==========================================
            [
                'first_name' => 'Marcus',
                'last_name' => 'Rivera',
                'slug' => 'marcus-rivera',
                'photo' => $baseUrl . 'marcus-rivera.png',
                'bio' => 'Dynamic forward with over 8 years of professional experience across top-tier leagues in Brazil and Europe. Known for explosive pace, clinical finishing, and the ability to create chances from nothing. A natural leader on the pitch who thrives under pressure and has a proven track record of delivering in crucial matches.',
                'date_of_birth' => '1998-03-15',
                'gender' => 'male',
                'nationality' => 'Brazilian',
                'category_id' => $catMap['football'] ?? null,
                'sport' => 'Football',
                'position' => 'Striker',
                'city' => 'Sao Paulo',
                'country' => 'Brazil',
                'is_featured' => true,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'FC Sao Paulo',
                'current_league' => 'Brasileirao Serie A',
                'email' => 'marcus.rivera@example.com',
                'phone' => '+55 11 98765 4321',
                'website' => 'https://marcusrivera.example.com',
                'height_cm' => 182,
                'weight_kg' => 78,
                '_related' => [
                    'career' => [
                        ['team_name' => 'FC Sao Paulo', 'league' => 'Brasileirao Serie A', 'position' => 'Striker', 'start_year' => 2021, 'end_year' => null, 'appearances' => 95, 'goals' => 48],
                        ['team_name' => 'SC Corinthians', 'league' => 'Brasileirao Serie A', 'position' => 'Forward', 'start_year' => 2018, 'end_year' => 2021, 'appearances' => 72, 'goals' => 31],
                        ['team_name' => 'Santos FC Youth', 'league' => 'Youth League', 'position' => 'Striker', 'start_year' => 2015, 'end_year' => 2018, 'appearances' => 45, 'goals' => 38],
                    ],
                    'achievements' => [
                        ['title' => 'Brasileirao Top Scorer', 'description' => 'Led the league with 22 goals in the 2023 season', 'year' => 2023, 'award_type' => 'individual'],
                        ['title' => 'Copa do Brasil Champion', 'description' => 'Won the national cup with FC Sao Paulo', 'year' => 2022, 'award_type' => 'team'],
                        ['title' => 'Player of the Month', 'description' => 'Brasileirao Player of the Month - October', 'year' => 2023, 'award_type' => 'individual'],
                    ],
                    'statistics' => [
                        ['stat_key' => 'Goals Scored', 'stat_value' => '117', 'season' => 'Career'],
                        ['stat_key' => 'Assists', 'stat_value' => '43', 'season' => 'Career'],
                        ['stat_key' => 'Appearances', 'stat_value' => '212', 'season' => 'Career'],
                        ['stat_key' => 'Goals Per Game', 'stat_value' => '0.55', 'season' => '2023'],
                        ['stat_key' => 'Shot Accuracy', 'stat_value' => '68%', 'season' => '2023'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Finishing', 'rating' => 95],
                        ['skill_name' => 'Pace', 'rating' => 90],
                        ['skill_name' => 'Dribbling', 'rating' => 85],
                        ['skill_name' => 'Passing', 'rating' => 78],
                        ['skill_name' => 'Heading', 'rating' => 82],
                        ['skill_name' => 'Free Kicks', 'rating' => 75],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'football-action.png', 'caption' => 'Scoring the winning goal in the Copa do Brasil final', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/marcusrivera'],
                        ['platform' => 'twitter', 'url' => 'https://twitter.com/marcusrivera'],
                    ],
                ],
            ],

            // ==========================================
            // 2. AISHA JOHNSON - Basketball
            // ==========================================
            [
                'first_name' => 'Aisha',
                'last_name' => 'Johnson',
                'slug' => 'aisha-johnson',
                'photo' => $baseUrl . 'aisha-johnson.png',
                'bio' => 'Elite point guard with exceptional court vision and playmaking ability. A three-time All-Star who has represented Team USA in international competitions. Known for her lightning-fast breaks, three-point accuracy, and defensive tenacity. Off the court, she is an active mentor for youth basketball programs.',
                'date_of_birth' => '1999-07-22',
                'gender' => 'female',
                'nationality' => 'American',
                'category_id' => $catMap['basketball'] ?? null,
                'sport' => 'Basketball',
                'position' => 'Point Guard',
                'city' => 'Chicago',
                'country' => 'United States',
                'is_featured' => true,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'Chicago Sky',
                'current_league' => 'WNBA',
                'email' => 'aisha.johnson@example.com',
                'phone' => '+1 312 555 0142',
                'website' => 'https://aishajohnson.example.com',
                'height_cm' => 175,
                'weight_kg' => 65,
                '_related' => [
                    'career' => [
                        ['team_name' => 'Chicago Sky', 'league' => 'WNBA', 'position' => 'Point Guard', 'start_year' => 2021, 'end_year' => null, 'appearances' => 102, 'goals' => 0],
                        ['team_name' => 'UConn Huskies', 'league' => 'NCAA', 'position' => 'Point Guard', 'start_year' => 2017, 'end_year' => 2021, 'appearances' => 128, 'goals' => 0],
                    ],
                    'achievements' => [
                        ['title' => 'WNBA All-Star', 'description' => 'Three-time WNBA All-Star selection (2022, 2023, 2024)', 'year' => 2024, 'award_type' => 'individual'],
                        ['title' => 'NCAA Championship', 'description' => 'Led UConn to the national championship title', 'year' => 2020, 'award_type' => 'team'],
                        ['title' => 'Assists Leader', 'description' => 'Led the WNBA in assists per game with 8.2', 'year' => 2023, 'award_type' => 'individual'],
                    ],
                    'statistics' => [
                        ['stat_key' => 'Points Per Game', 'stat_value' => '18.4', 'season' => '2024'],
                        ['stat_key' => 'Assists Per Game', 'stat_value' => '8.2', 'season' => '2024'],
                        ['stat_key' => 'Three-Point %', 'stat_value' => '41.2%', 'season' => '2024'],
                        ['stat_key' => 'Steals Per Game', 'stat_value' => '2.1', 'season' => '2024'],
                        ['stat_key' => 'Career Points', 'stat_value' => '3,240', 'season' => 'Career'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Court Vision', 'rating' => 96],
                        ['skill_name' => 'Three-Point Shooting', 'rating' => 90],
                        ['skill_name' => 'Ball Handling', 'rating' => 93],
                        ['skill_name' => 'Defense', 'rating' => 85],
                        ['skill_name' => 'Free Throws', 'rating' => 88],
                        ['skill_name' => 'Leadership', 'rating' => 92],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'basketball-action.png', 'caption' => 'Going up for a layup against the New York Liberty', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/aishajohnson'],
                        ['platform' => 'twitter', 'url' => 'https://twitter.com/aishajohnson'],
                    ],
                ],
            ],

            // ==========================================
            // 3. YUKI TANAKA - Tennis
            // ==========================================
            [
                'first_name' => 'Yuki',
                'last_name' => 'Tanaka',
                'slug' => 'yuki-tanaka',
                'photo' => $baseUrl . 'yuki-tanaka.png',
                'bio' => 'Rising star in professional tennis with a powerful baseline game and exceptional footwork. Has reached the quarterfinals of two Grand Slam tournaments and consistently ranks among the top 30 players worldwide. Known for her mental toughness and ability to turn matches around from difficult positions.',
                'date_of_birth' => '2001-11-08',
                'gender' => 'female',
                'nationality' => 'Japanese',
                'category_id' => $catMap['tennis'] ?? null,
                'sport' => 'Tennis',
                'position' => 'Singles',
                'city' => 'Tokyo',
                'country' => 'Japan',
                'is_featured' => true,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'Independent',
                'current_league' => 'WTA Tour',
                'email' => 'yuki.tanaka@example.com',
                'phone' => '+81 3 1234 5678',
                'website' => 'https://yukitanaka.example.com',
                'height_cm' => 168,
                'weight_kg' => 58,
                '_related' => [
                    'career' => [
                        ['team_name' => 'WTA Tour', 'league' => 'Professional', 'position' => 'Singles', 'start_year' => 2019, 'end_year' => null],
                        ['team_name' => 'Japan Fed Cup Team', 'league' => 'International', 'position' => 'Singles', 'start_year' => 2020, 'end_year' => null],
                    ],
                    'achievements' => [
                        ['title' => 'WTA Quarterfinalist', 'description' => 'Reached quarterfinals at the Australian Open', 'year' => 2024, 'award_type' => 'individual'],
                        ['title' => 'Japan Open Champion', 'description' => 'Won the Japan Open WTA 500 title', 'year' => 2023, 'award_type' => 'individual'],
                        ['title' => 'WTA Ranking Top 30', 'description' => 'Achieved career-high ranking of World No. 27', 'year' => 2024, 'award_type' => 'individual'],
                    ],
                    'statistics' => [
                        ['stat_key' => 'Win Rate', 'stat_value' => '67%', 'season' => '2024'],
                        ['stat_key' => 'Titles Won', 'stat_value' => '3', 'season' => 'Career'],
                        ['stat_key' => 'Ace Count', 'stat_value' => '342', 'season' => '2024'],
                        ['stat_key' => 'First Serve %', 'stat_value' => '72%', 'season' => '2024'],
                        ['stat_key' => 'Current Ranking', 'stat_value' => '#29', 'season' => '2024'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Baseline Play', 'rating' => 92],
                        ['skill_name' => 'Serve', 'rating' => 85],
                        ['skill_name' => 'Footwork', 'rating' => 94],
                        ['skill_name' => 'Backhand', 'rating' => 90],
                        ['skill_name' => 'Net Play', 'rating' => 78],
                        ['skill_name' => 'Mental Toughness', 'rating' => 91],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'tennis-action.png', 'caption' => 'Competing at the Japan Open final', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/yukitanaka'],
                        ['platform' => 'twitter', 'url' => 'https://twitter.com/yukitanaka'],
                    ],
                ],
            ],

            // ==========================================
            // 4. ARJUN PATEL - Cricket
            // ==========================================
            [
                'first_name' => 'Arjun',
                'last_name' => 'Patel',
                'slug' => 'arjun-patel',
                'photo' => $baseUrl . 'arjun-patel.png',
                'bio' => 'Explosive right-handed batsman with a flair for aggressive stroke play. Has represented India in international T20 matches and is known for his ability to accelerate scoring in the death overs. A reliable fielder and occasional off-spin bowler who brings energy and enthusiasm to every match.',
                'date_of_birth' => '1997-05-30',
                'gender' => 'male',
                'nationality' => 'Indian',
                'category_id' => $catMap['cricket'] ?? null,
                'sport' => 'Cricket',
                'position' => 'Batsman',
                'city' => 'Mumbai',
                'country' => 'India',
                'is_featured' => false,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'Mumbai Indians',
                'current_league' => 'Indian Premier League',
                'email' => 'arjun.patel@example.com',
                'phone' => '+91 98765 43210',
                'website' => null,
                'height_cm' => 176,
                'weight_kg' => 72,
                '_related' => [
                    'career' => [
                        ['team_name' => 'Mumbai Indians', 'league' => 'Indian Premier League', 'position' => 'Top Order Batsman', 'start_year' => 2020, 'end_year' => null],
                        ['team_name' => 'Mumbai Cricket Team', 'league' => 'Ranji Trophy', 'position' => 'Batsman', 'start_year' => 2017, 'end_year' => 2020],
                    ],
                    'achievements' => [
                        ['title' => 'IPL Emerging Player', 'description' => 'Named Emerging Player of the IPL season', 'year' => 2022, 'award_type' => 'individual'],
                        ['title' => 'Fastest Fifty', 'description' => 'Scored the fastest fifty of the tournament in 18 balls', 'year' => 2023, 'award_type' => 'individual'],
                        ['title' => 'Ranji Trophy Champion', 'description' => 'Part of the Mumbai team that won the Ranji Trophy', 'year' => 2019, 'award_type' => 'team'],
                    ],
                    'statistics' => [
                        ['stat_key' => 'Batting Average', 'stat_value' => '38.5', 'season' => '2024'],
                        ['stat_key' => 'Strike Rate', 'stat_value' => '156.2', 'season' => '2024'],
                        ['stat_key' => 'Total Runs', 'stat_value' => '4,280', 'season' => 'Career'],
                        ['stat_key' => 'Centuries', 'stat_value' => '8', 'season' => 'Career'],
                        ['stat_key' => 'Highest Score', 'stat_value' => '142*', 'season' => 'Career'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Batting', 'rating' => 92],
                        ['skill_name' => 'Power Hitting', 'rating' => 95],
                        ['skill_name' => 'Running Between Wickets', 'rating' => 85],
                        ['skill_name' => 'Fielding', 'rating' => 80],
                        ['skill_name' => 'Spin Bowling', 'rating' => 55],
                        ['skill_name' => 'Concentration', 'rating' => 88],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'cricket-action.png', 'caption' => 'Hitting a six during the IPL match at Wankhede Stadium', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/arjunpatel'],
                    ],
                ],
            ],

            // ==========================================
            // 5. ELENA PETROVA - Swimming
            // ==========================================
            [
                'first_name' => 'Elena',
                'last_name' => 'Petrova',
                'slug' => 'elena-petrova',
                'photo' => $baseUrl . 'elena-petrova.png',
                'bio' => 'Olympic-caliber freestyle swimmer specializing in the 200m and 400m events. Multiple national champion with a powerful stroke technique and exceptional endurance. Has represented her country at two Olympic Games and holds national records in the 400m freestyle. Dedicated to pushing the boundaries of competitive swimming.',
                'date_of_birth' => '2000-02-14',
                'gender' => 'female',
                'nationality' => 'Russian',
                'category_id' => $catMap['swimming'] ?? null,
                'sport' => 'Swimming',
                'position' => 'Freestyle',
                'city' => 'Moscow',
                'country' => 'Russia',
                'is_featured' => false,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'CSKA Moscow',
                'current_league' => 'Russian Swimming League',
                'email' => 'elena.petrova@example.com',
                'phone' => '+7 495 123 4567',
                'website' => 'https://elenapetrova.example.com',
                'height_cm' => 178,
                'weight_kg' => 64,
                '_related' => [
                    'career' => [
                        ['team_name' => 'CSKA Moscow', 'league' => 'Russian Swimming League', 'position' => 'Freestyle', 'start_year' => 2018, 'end_year' => null],
                        ['team_name' => 'National Team', 'league' => 'International', 'position' => 'Freestyle', 'start_year' => 2019, 'end_year' => null],
                    ],
                    'achievements' => [
                        ['title' => 'Olympian', 'description' => 'Represented Russia at the 2024 Summer Olympics', 'year' => 2024, 'award_type' => 'individual'],
                        ['title' => 'National Record Holder', 'description' => 'Set national record in 400m freestyle (4:03.21)', 'year' => 2023, 'award_type' => 'individual'],
                        ['title' => 'European Championship Silver', 'description' => 'Silver medal in 200m freestyle at European Championships', 'year' => 2023, 'award_type' => 'individual'],
                    ],
                    'statistics' => [
                        ['stat_key' => '200m Freestyle PB', 'stat_value' => '1:56.42', 'season' => '2024'],
                        ['stat_key' => '400m Freestyle PB', 'stat_value' => '4:03.21', 'season' => '2023'],
                        ['stat_key' => '800m Freestyle PB', 'stat_value' => '8:28.15', 'season' => '2023'],
                        ['stat_key' => 'National Titles', 'stat_value' => '7', 'season' => 'Career'],
                        ['stat_key' => 'Training Hours/Week', 'stat_value' => '30', 'season' => 'Current'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Freestyle Technique', 'rating' => 96],
                        ['skill_name' => 'Endurance', 'rating' => 94],
                        ['skill_name' => 'Starts', 'rating' => 88],
                        ['skill_name' => 'Turns', 'rating' => 90],
                        ['skill_name' => 'Underwater Kicks', 'rating' => 85],
                        ['skill_name' => 'Race Strategy', 'rating' => 91],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'swimming-action.png', 'caption' => 'Competing in the 400m freestyle final at nationals', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/elenapetrova'],
                    ],
                ],
            ],

            // ==========================================
            // 6. KWAME ASANTE - Athletics (Sprinting)
            // ==========================================
            [
                'first_name' => 'Kwame',
                'last_name' => 'Asante',
                'slug' => 'kwame-asante',
                'photo' => $baseUrl . 'kwame-asante.png',
                'bio' => 'Lightning-fast sprinter specializing in the 100m and 200m events. A national champion and continental medalist who has consistently broken the 10-second barrier in the 100m. Known for his explosive starts and powerful acceleration phase. Aspires to compete at the World Athletics Championships and Olympic Games.',
                'date_of_birth' => '1999-09-03',
                'gender' => 'male',
                'nationality' => 'Ghanaian',
                'category_id' => $catMap['athletics'] ?? null,
                'sport' => 'Athletics',
                'position' => 'Sprinter',
                'city' => 'Accra',
                'country' => 'Ghana',
                'is_featured' => true,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'Accra Athletics Club',
                'current_league' => 'World Athletics',
                'email' => 'kwame.asante@example.com',
                'phone' => '+233 24 123 4567',
                'website' => null,
                'height_cm' => 185,
                'weight_kg' => 80,
                '_related' => [
                    'career' => [
                        ['team_name' => 'Accra Athletics Club', 'league' => 'World Athletics', 'position' => 'Sprinter', 'start_year' => 2018, 'end_year' => null],
                        ['team_name' => 'National Team', 'league' => 'International', 'position' => 'Sprinter', 'start_year' => 2019, 'end_year' => null],
                    ],
                    'achievements' => [
                        ['title' => 'African Championships Bronze', 'description' => 'Bronze medal in 100m at the African Athletics Championships', 'year' => 2024, 'award_type' => 'individual'],
                        ['title' => 'National Champion 100m', 'description' => 'Won the Ghanaian national title in the 100m sprint', 'year' => 2023, 'award_type' => 'individual'],
                        ['title' => 'Sub-10 Second Barrier', 'description' => 'Broke the 10-second barrier in the 100m with a time of 9.97s', 'year' => 2023, 'award_type' => 'individual'],
                    ],
                    'statistics' => [
                        ['stat_key' => '100m PB', 'stat_value' => '9.97s', 'season' => '2023'],
                        ['stat_key' => '200m PB', 'stat_value' => '20.15s', 'season' => '2024'],
                        ['stat_key' => '60m Indoor PB', 'stat_value' => '6.52s', 'season' => '2024'],
                        ['stat_key' => 'World Ranking', 'stat_value' => '#45', 'season' => '2024'],
                        ['stat_key' => 'Reaction Time Avg', 'stat_value' => '0.142s', 'season' => '2024'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Acceleration', 'rating' => 96],
                        ['skill_name' => 'Top Speed', 'rating' => 94],
                        ['skill_name' => 'Start Technique', 'rating' => 92],
                        ['skill_name' => 'Speed Endurance', 'rating' => 85],
                        ['skill_name' => 'Race Strategy', 'rating' => 80],
                        ['skill_name' => 'Flexibility', 'rating' => 82],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'athletics-action.png', 'caption' => 'Crossing the finish line at the African Championships', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/kwameasante'],
                        ['platform' => 'twitter', 'url' => 'https://twitter.com/kwameasante'],
                    ],
                ],
            ],

            // ==========================================
            // 7. SOFIA ROSSI - Volleyball
            // ==========================================
            [
                'first_name' => 'Sofia',
                'last_name' => 'Rossi',
                'slug' => 'sofia-rossi',
                'photo' => $baseUrl . 'sofia-rossi.png',
                'bio' => 'Dynamic outside hitter with a powerful arm swing and exceptional vertical leap. A key player for the Italian national team, known for her ability to score from any position on the court. Combines athletic prowess with tactical intelligence, making her one of the most versatile attackers in European volleyball.',
                'date_of_birth' => '1998-06-18',
                'gender' => 'female',
                'nationality' => 'Italian',
                'category_id' => $catMap['volleyball'] ?? null,
                'sport' => 'Volleyball',
                'position' => 'Outside Hitter',
                'city' => 'Milan',
                'country' => 'Italy',
                'is_featured' => false,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'Imoco Volley Conegliano',
                'current_league' => 'Serie A1 Femminile',
                'email' => 'sofia.rossi@example.com',
                'phone' => '+39 02 1234 5678',
                'website' => 'https://sofiarossi.example.com',
                'height_cm' => 186,
                'weight_kg' => 70,
                '_related' => [
                    'career' => [
                        ['team_name' => 'Imoco Volley Conegliano', 'league' => 'Serie A1 Femminile', 'position' => 'Outside Hitter', 'start_year' => 2021, 'end_year' => null],
                        ['team_name' => 'Italian National Team', 'league' => 'International', 'position' => 'Outside Hitter', 'start_year' => 2020, 'end_year' => null],
                        ['team_name' => 'Volley Bergamo', 'league' => 'Serie A1 Femminile', 'position' => 'Outside Hitter', 'start_year' => 2017, 'end_year' => 2021],
                    ],
                    'achievements' => [
                        ['title' => 'Serie A1 Champion', 'description' => 'Won the Italian Serie A1 league title', 'year' => 2023, 'award_type' => 'team'],
                        ['title' => 'CEV Champions League Silver', 'description' => 'Silver medal at the CEV Champions League', 'year' => 2024, 'award_type' => 'team'],
                        ['title' => 'Best Outside Hitter', 'description' => 'Named Best Outside Hitter at the European Championship', 'year' => 2023, 'award_type' => 'individual'],
                    ],
                    'statistics' => [
                        ['stat_key' => 'Kills Per Set', 'stat_value' => '4.2', 'season' => '2024'],
                        ['stat_key' => 'Hitting %', 'stat_value' => '43.8%', 'season' => '2024'],
                        ['stat_key' => 'Aces', 'stat_value' => '38', 'season' => '2024'],
                        ['stat_key' => 'Vertical Leap', 'stat_value' => '320cm', 'season' => 'Current'],
                        ['stat_key' => 'Blocks Per Set', 'stat_value' => '0.6', 'season' => '2024'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Spiking', 'rating' => 94],
                        ['skill_name' => 'Serving', 'rating' => 88],
                        ['skill_name' => 'Passing', 'rating' => 85],
                        ['skill_name' => 'Blocking', 'rating' => 80],
                        ['skill_name' => 'Court Awareness', 'rating' => 91],
                        ['skill_name' => 'Jumping', 'rating' => 95],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'volleyball-action.png', 'caption' => 'Spiking during the Serie A1 final match', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/sofiarossi'],
                    ],
                ],
            ],

            // ==========================================
            // 8. LIAM O'BRIEN - Hockey (Ice Hockey)
            // ==========================================
            [
                'first_name' => 'Liam',
                'last_name' => "O'Brien",
                'slug' => 'liam-obrien',
                'photo' => $baseUrl . 'liam-obrien.png',
                'bio' => 'Reliable and agile goaltender with quick reflexes and excellent positioning. Has played professionally in the AHL and ECHL, known for his butterfly style and ability to make critical saves under pressure. A vocal leader in the locker room who brings calm confidence to the crease in high-stakes situations.',
                'date_of_birth' => '1997-01-25',
                'gender' => 'male',
                'nationality' => 'Canadian',
                'category_id' => $catMap['hockey'] ?? null,
                'sport' => 'Hockey',
                'position' => 'Goaltender',
                'city' => 'Toronto',
                'country' => 'Canada',
                'is_featured' => false,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'Toronto Marlies',
                'current_league' => 'AHL',
                'email' => 'liam.obrien@example.com',
                'phone' => '+1 416 555 0198',
                'website' => null,
                'height_cm' => 190,
                'weight_kg' => 88,
                '_related' => [
                    'career' => [
                        ['team_name' => 'Toronto Marlies', 'league' => 'AHL', 'position' => 'Goaltender', 'start_year' => 2021, 'end_year' => null],
                        ['team_name' => 'Newfoundland Growlers', 'league' => 'ECHL', 'position' => 'Goaltender', 'start_year' => 2019, 'end_year' => 2021],
                    ],
                    'achievements' => [
                        ['title' => 'AHL All-Star', 'description' => 'Selected for the AHL All-Star game', 'year' => 2024, 'award_type' => 'individual'],
                        ['title' => 'ECHL Goaltender of the Year', 'description' => 'Named the top goaltender in the ECHL', 'year' => 2021, 'award_type' => 'individual'],
                        ['title' => 'Kelly Cup Champion', 'description' => 'Won the ECHL Kelly Cup with the Growlers', 'year' => 2021, 'award_type' => 'team'],
                    ],
                    'statistics' => [
                        ['stat_key' => 'Save Percentage', 'stat_value' => '.921', 'season' => '2024'],
                        ['stat_key' => 'Goals Against Avg', 'stat_value' => '2.34', 'season' => '2024'],
                        ['stat_key' => 'Shutouts', 'stat_value' => '5', 'season' => '2024'],
                        ['stat_key' => 'Wins', 'stat_value' => '28', 'season' => '2024'],
                        ['stat_key' => 'Career Save %', 'stat_value' => '.915', 'season' => 'Career'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Butterfly Technique', 'rating' => 93],
                        ['skill_name' => 'Reflexes', 'rating' => 95],
                        ['skill_name' => 'Positioning', 'rating' => 90],
                        ['skill_name' => 'Puck Handling', 'rating' => 72],
                        ['skill_name' => 'Mental Resilience', 'rating' => 92],
                        ['skill_name' => 'Rebound Control', 'rating' => 88],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'hockey-action.png', 'caption' => 'Making a spectacular glove save during the AHL playoffs', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/liamobrien'],
                        ['platform' => 'twitter', 'url' => 'https://twitter.com/liamobrien'],
                    ],
                ],
            ],

            // ==========================================
            // 9. DIEGO MORALES - Boxing
            // ==========================================
            [
                'first_name' => 'Diego',
                'last_name' => 'Morales',
                'slug' => 'diego-morales',
                'photo' => $baseUrl . 'diego-morales.png',
                'bio' => 'Aggressive welterweight boxer with devastating punching power and relentless pressure. Undefeated in his first 18 professional bouts with 14 knockouts. Known for his body work and ability to wear down opponents over the rounds. Trains at the renowned Morales Boxing Academy founded by his father.',
                'date_of_birth' => '1998-12-05',
                'gender' => 'male',
                'nationality' => 'Mexican',
                'category_id' => $catMap['boxing'] ?? null,
                'sport' => 'Boxing',
                'position' => 'Welterweight',
                'city' => 'Mexico City',
                'country' => 'Mexico',
                'is_featured' => false,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'Morales Boxing Academy',
                'current_league' => 'Professional Boxing',
                'email' => 'diego.morales@example.com',
                'phone' => '+52 55 1234 5678',
                'website' => null,
                'height_cm' => 175,
                'weight_kg' => 69,
                '_related' => [
                    'career' => [
                        ['team_name' => 'Morales Boxing Academy', 'league' => 'Professional', 'position' => 'Welterweight', 'start_year' => 2019, 'end_year' => null],
                        ['team_name' => 'National Amateur Team', 'league' => 'Amateur', 'position' => 'Welterweight', 'start_year' => 2016, 'end_year' => 2019],
                    ],
                    'achievements' => [
                        ['title' => 'WBC Continental Champion', 'description' => 'Won the WBC Continental Americas welterweight title', 'year' => 2024, 'award_type' => 'individual'],
                        ['title' => 'Undefeated Record', 'description' => 'Maintained an undefeated record of 18-0 with 14 KOs', 'year' => 2024, 'award_type' => 'individual'],
                        ['title' => 'National Amateur Champion', 'description' => 'Won the Mexican national amateur boxing championship', 'year' => 2018, 'award_type' => 'individual'],
                    ],
                    'statistics' => [
                        ['stat_key' => 'Record', 'stat_value' => '18-0', 'season' => 'Career'],
                        ['stat_key' => 'Knockouts', 'stat_value' => '14', 'season' => 'Career'],
                        ['stat_key' => 'KO Ratio', 'stat_value' => '77.8%', 'season' => 'Career'],
                        ['stat_key' => 'Rounds Boxed', 'stat_value' => '112', 'season' => 'Career'],
                        ['stat_key' => 'Title Fights', 'stat_value' => '2', 'season' => 'Career'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Punching Power', 'rating' => 94],
                        ['skill_name' => 'Footwork', 'rating' => 85],
                        ['skill_name' => 'Defense', 'rating' => 80],
                        ['skill_name' => 'Body Work', 'rating' => 92],
                        ['skill_name' => 'Stamina', 'rating' => 88],
                        ['skill_name' => 'Jab', 'rating' => 86],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'boxing-action.png', 'caption' => 'Celebrating after winning the WBC Continental title', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/diegomorales'],
                        ['platform' => 'twitter', 'url' => 'https://twitter.com/diegomorales'],
                    ],
                ],
            ],

            // ==========================================
            // 10. KAYA DEMIR - MMA
            // ==========================================
            [
                'first_name' => 'Kaya',
                'last_name' => 'Demir',
                'slug' => 'kaya-demir',
                'photo' => $baseUrl . 'kaya-demir.png',
                'bio' => 'Well-rounded mixed martial artist with a strong wrestling base and developing striking game. Competes in the lightweight division and is known for his ground-and-pound technique and submission defense. Has trained at top camps in the US and Turkey. A disciplined athlete who approaches every fight with meticulous game planning.',
                'date_of_birth' => '1996-08-12',
                'gender' => 'male',
                'nationality' => 'Turkish',
                'category_id' => $catMap['mma'] ?? null,
                'sport' => 'MMA',
                'position' => 'Lightweight',
                'city' => 'Istanbul',
                'country' => 'Turkey',
                'is_featured' => false,
                'is_published' => true,
                'is_approved' => true,
                'current_team' => 'Demir Fight Club',
                'current_league' => 'Professional MMA',
                'email' => 'kaya.demir@example.com',
                'phone' => '+90 212 123 4567',
                'website' => 'https://kayademir.example.com',
                'height_cm' => 178,
                'weight_kg' => 70,
                '_related' => [
                    'career' => [
                        ['team_name' => 'Demir Fight Club', 'league' => 'Professional MMA', 'position' => 'Lightweight', 'start_year' => 2018, 'end_year' => null],
                        ['team_name' => 'National Wrestling Team', 'league' => 'Freestyle Wrestling', 'position' => '70kg', 'start_year' => 2013, 'end_year' => 2018],
                    ],
                    'achievements' => [
                        ['title' => 'Regional MMA Champion', 'description' => 'Won the regional lightweight championship belt', 'year' => 2023, 'award_type' => 'individual'],
                        ['title' => 'National Wrestling Silver', 'description' => 'Silver medal at the Turkish national freestyle wrestling championships', 'year' => 2017, 'award_type' => 'individual'],
                        ['title' => 'Fight of the Night', 'description' => 'Earned Fight of the Night bonus in professional debut', 'year' => 2018, 'award_type' => 'individual'],
                    ],
                    'statistics' => [
                        ['stat_key' => 'Record', 'stat_value' => '12-3', 'season' => 'Career'],
                        ['stat_key' => 'Knockouts', 'stat_value' => '4', 'season' => 'Career'],
                        ['stat_key' => 'Submissions', 'stat_value' => '5', 'season' => 'Career'],
                        ['stat_key' => 'Decisions', 'stat_value' => '3', 'season' => 'Career'],
                        ['stat_key' => 'Avg Fight Time', 'stat_value' => '9:42', 'season' => 'Career'],
                    ],
                    'skills' => [
                        ['skill_name' => 'Wrestling', 'rating' => 95],
                        ['skill_name' => 'Ground & Pound', 'rating' => 90],
                        ['skill_name' => 'Striking', 'rating' => 78],
                        ['skill_name' => 'Submission Defense', 'rating' => 88],
                        ['skill_name' => 'Cardio', 'rating' => 85],
                        ['skill_name' => 'Takedown Defense', 'rating' => 91],
                    ],
                    'gallery' => [
                        ['image_url' => $galleryUrl . 'mma-action.png', 'caption' => 'Executing a takedown during the regional championship bout', 'sort_order' => 1],
                    ],
                    'social_links' => [
                        ['platform' => 'instagram', 'url' => 'https://instagram.com/kayademir'],
                        ['platform' => 'twitter', 'url' => 'https://twitter.com/kayademir'],
                    ],
                ],
            ],
        ];
    }
}
