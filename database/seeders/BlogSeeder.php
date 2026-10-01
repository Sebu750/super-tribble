<?php

namespace Database\Seeders;

use App\Services\SupabaseService;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    protected SupabaseService $supabase;

    public function __construct()
    {
        $this->supabase = app(SupabaseService::class);
    }

    public function run(): void
    {
        $this->command->info('Seeding blog posts...');

        // Get blog categories
        $categories = $this->supabase->serviceFrom('blog_categories')->select('id,name,slug')->get();
        $catMap = [];
        foreach ($categories as $cat) {
            $catMap[$cat['slug']] = $cat['id'];
        }

        $this->command->info('Found ' . count($catMap) . ' blog categories: ' . implode(', ', array_keys($catMap)));

        // Clean existing seed data
        $this->cleanExistingData();

        $posts = $this->getPostsData($catMap);

        foreach ($posts as $index => $post) {
            $this->command->info("Seeding post " . ($index + 1) . "/" . count($posts) . ": {$post['title']}");

            try {
                $this->supabase->serviceFrom('blog_posts')->insert($post);
            } catch (\Exception $e) {
                $this->command->error("Failed: {$e->getMessage()}");
            }
        }

        $this->command->info('Blog seeding complete!');
    }

    protected function cleanExistingData(): void
    {
        $slugs = [
            'building-champion-mentality',
            '2026-world-cup-qualifiers-recap',
            'marcus-rivera-from-streets-to-stardom',
            '5-drills-to-improve-your-vertical-jump',
            'inside-the-arena-an-interview-with-kwame-asante',
            'sportika-launches-player-verification',
            'youth-sports-development-programs-2026',
            'swimming-techniques-that-break-records',
        ];

        foreach ($slugs as $slug) {
            try {
                $this->supabase->serviceFrom('blog_posts')->where('slug', 'eq', $slug)->delete();
            } catch (\Exception $e) {}
        }
    }

    protected function getPostsData(array $catMap): array
    {
        $img = '/images/blog/';

        return [
            // ==========================================
            // 1. Player Spotlight - Featured Post
            // ==========================================
            [
                'title' => 'Marcus Rivera: From the Streets of Sao Paulo to Football Stardom',
                'slug' => 'marcus-rivera-from-streets-to-stardom',
                'content' => "Every great football story starts somewhere. For Marcus Rivera, it was the dusty pickup games in the favelas of Sao Paulo, where a worn-out ball and bare feet were all you needed to dream big.\n\nBorn on March 15, 1998, Marcus grew up in a household where football was more than a sport -- it was a way of life. His father, a former semi-professional player, introduced him to the game at age four. By eight, he was already turning heads in local youth tournaments.\n\n\"I remember playing on concrete fields with no shoes,\" Marcus recalls. \"Those conditions taught me to be quick, to be creative, and to never give up on a ball.\"\n\n**The Rise Through the Ranks**\n\nMarcus's talent was undeniable. At 15, he was invited to join the Santos FC youth academy -- the same academy that produced legends like Neymar and Robinho. It was a life-changing moment.\n\n\"Leaving home at 15 was hard,\" he admits. \"But I knew this was my chance. I trained harder than anyone. I was the first one at practice and the last one to leave.\"\n\nBy 18, Marcus had caught the attention of SC Corinthians, one of Brazil's biggest clubs. He signed his first professional contract in 2018 and never looked back.\n\n**The Numbers Speak**\n\nOver his career, Marcus has scored 117 goals in 212 appearances. His 2023 season was nothing short of spectacular -- 22 goals that made him the Brasileirao top scorer, along with a Copa do Brasil championship with FC Sao Paulo.\n\nHis playing style is a blend of raw talent and disciplined technique. As a striker, he combines explosive pace with clinical finishing, making him one of the most feared forwards in Brazilian football.\n\n**Off the Pitch**\n\nMarcus is equally committed to giving back. He runs a youth football program in Sao Paulo that provides free training and equipment to underprivileged children.\n\n\"Football gave me everything,\" he says. \"Now it's my turn to give back. Every kid deserves a chance to dream.\"\n\nMarcus's story is a testament to what happens when talent meets determination. From the streets of Sao Paulo to the bright lights of professional football, he has proven that with hard work and belief, anything is possible.",
                'excerpt' => 'The incredible journey of Brazilian striker Marcus Rivera, from playing barefoot in the favelas to becoming the Brasileirao top scorer and a champion with FC Sao Paulo.',
                'featured_image' => $img . 'player-spotlight.png',
                'category_id' => $catMap['player-spotlight'] ?? null,
                'author_name' => 'Carlos Mendes',
                'status' => 'published',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => '2026-09-28 10:00:00',
                'meta_title' => 'Marcus Rivera: From Streets to Football Stardom - Sportika Blog',
                'meta_description' => 'The incredible journey of Brazilian striker Marcus Rivera, from playing barefoot in the favelas to becoming a football champion.',
            ],

            // ==========================================
            // 2. Training Tips
            // ==========================================
            [
                'title' => '5 Drills to Improve Your Vertical Jump and Dominate on the Court',
                'slug' => '5-drills-to-improve-your-vertical-jump',
                'content' => "Whether you're a basketball player looking to dunk, a volleyball player wanting to spike higher, or simply an athlete aiming to improve overall explosiveness, increasing your vertical jump can transform your game.\n\nAfter consulting with sports scientists and professional strength coaches, we've compiled five proven drills that deliver measurable results.\n\n**1. Depth Jumps**\n\nDepth jumps are a plyometric exercise that trains your muscles to produce maximum force in minimum time. Stand on a box 30-45cm high, step off, and immediately jump as high as possible upon landing.\n\nStart with 3 sets of 5 reps. The key is minimizing ground contact time -- think of the floor as hot lava.\n\n**2. Bulgarian Split Squats**\n\nThis unilateral exercise addresses strength imbalances between your legs. With your rear foot elevated on a bench, perform a deep lunge with your front leg. Hold dumbbells for added resistance.\n\nAim for 3 sets of 8-10 reps per leg. Focus on driving through your heel and exploding upward.\n\n**3. Jump Rope Intervals**\n\nDon't underestimate the jump rope. It builds calf strength, ankle stability, and rhythmic coordination -- all essential for jumping higher.\n\nTry 30 seconds of double-unders followed by 30 seconds of rest. Repeat for 5-8 rounds.\n\n**4. Box Jumps with Band Resistance**\n\nAttach a resistance band to a low anchor point and loop it around your waist. Perform box jumps while the band provides downward resistance. This forces your hips and glutes to work harder.\n\nUse a box height of 50-60cm and perform 4 sets of 6 reps.\n\n**5. Contrast Training: Heavy Squats into Jump Squats**\n\nThis advanced technique pairs a heavy back squat (3-5 reps at 80% 1RM) immediately with 5 unweighted jump squats. The heavy load potentiates your nervous system, making the subsequent jumps more explosive.\n\nRest 2-3 minutes between sets and perform 4 rounds.\n\n**Consistency is Key**\n\nIncorporating these drills 2-3 times per week will yield noticeable improvements within 6-8 weeks. Track your vertical jump monthly using a vertec or wall-mark method to measure progress.\n\nRemember: proper warm-up, adequate rest, and good nutrition are just as important as the drills themselves. Your body needs fuel and recovery to adapt and grow stronger.",
                'excerpt' => 'Expert-approved drills that will help athletes of all sports increase their vertical jump, build explosive power, and elevate their performance.',
                'featured_image' => $img . 'training-tips.png',
                'category_id' => $catMap['training-tips'] ?? null,
                'author_name' => 'Dr. Sarah Chen',
                'status' => 'published',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => '2026-09-25 08:00:00',
                'meta_title' => '5 Drills to Improve Your Vertical Jump - Sportika Blog',
                'meta_description' => 'Expert-approved drills to increase your vertical jump and explosive power for basketball, volleyball, and more.',
            ],

            // ==========================================
            // 3. Tournaments
            // ==========================================
            [
                'title' => '2026 World Cup Qualifiers: The Matches That Defined a Generation',
                'slug' => '2026-world-cup-qualifiers-recap',
                'content' => "The road to the 2026 FIFA World Cup has been nothing short of spectacular. With the expanded 48-team format, more nations than ever are dreaming of football's ultimate prize, and the qualifiers have delivered drama, upsets, and breathtaking moments.\n\n**South America: Brazil's Resurgence**\n\nAfter a disappointing 2022 campaign, Brazil has roared back under new management. Marcus Rivera's 22-goal season has been instrumental, and the Selecao sit comfortably at the top of the CONMEBOL standings.\n\nThe highlight was a stunning 4-1 victory over Argentina at the Maracana, where Rivera scored a hat-trick that had the stadium erupting. \"This team has something special,\" said coach Dorival Junior. \"We play with joy and freedom.\"\n\n**Europe: The Battle for spots**\n\nUEFA's qualifying groups have produced some of the most competitive football in recent memory. France, England, and Spain look strong, but it's the emergence of smaller nations like Ukraine and Austria that has added spice to the draw.\n\n**Africa: A New Era**\n\nThe CAF qualifiers have been a showcase of African football's depth. Ghana, led by sprinter-turned-forward Kwame Asante's cousin Kofi Asante, has been the revelation. Nigeria, Senegal, and Morocco all look capable of making deep runs.\n\n**What to Watch**\n\nWith qualifying still underway, several key matchups remain. Keep an eye on:\n\n- Brazil vs. Argentina (return leg) -- a potential title decider\n- France vs. England -- a clash of European titans\n- Ghana vs. Nigeria -- the battle for West African supremacy\n\nThe 2026 World Cup promises to be the most diverse and exciting tournament in history. These qualifiers are just the beginning.",
                'excerpt' => 'A comprehensive look at the most dramatic moments, standout performances, and key results from the 2026 World Cup qualifying campaign.',
                'featured_image' => $img . 'tournament.png',
                'category_id' => $catMap['tournaments'] ?? null,
                'author_name' => 'James O\'Brien',
                'status' => 'published',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => '2026-09-22 14:00:00',
                'meta_title' => '2026 World Cup Qualifiers Recap - Sportika Blog',
                'meta_description' => 'The most dramatic moments and key results from the 2026 World Cup qualifying campaign across all continents.',
            ],

            // ==========================================
            // 4. Interviews
            // ==========================================
            [
                'title' => 'Inside the Arena: An Exclusive Interview with Sprinter Kwame Asante',
                'slug' => 'inside-the-arena-an-interview-with-kwame-asante',
                'content' => "Kwame Asante is not just fast -- he's electric. The 27-year-old Ghanaian sprinter broke the 10-second barrier in the 100m with a time of 9.97 seconds, joining an elite club of sub-10 sprinters. We sat down with him at his training base in Accra to talk about his journey, his mindset, and what drives him.\n\n**Q: Kwame, take us back to the beginning. How did you get into sprinting?**\n\nA: I grew up in Accra and I was always the fastest kid. In school, I won every race. My PE teacher, Coach Mensah, saw something in me and convinced my parents to let me join the Accra Athletics Club. I was 14.\n\n**Q: What was your training like in those early days?**\n\nA: Brutal. We trained on a dirt track before we got access to a proper facility. I'd wake up at 5am for morning sessions, go to school, then come back for afternoon drills. But I loved every minute of it.\n\n**Q: Breaking the 10-second barrier -- what did that moment feel like?**\n\nA: I didn't even know my time until I looked at the scoreboard. When I saw 9.97, I just dropped to my knees. All the early mornings, the sacrifices, the injuries -- it all came flooding back. That moment was for my family, my coach, and everyone who believed in me.\n\n**Q: Who is your biggest inspiration?**\n\nA: Usain Bolt, obviously. But honestly, it's my mother. She worked three jobs to buy my first pair of running spikes. She never missed a race. Everything I do is to make her proud.\n\n**Q: What advice would you give to young athletes?**\n\nA: Be patient. Everyone wants instant results, but greatness takes time. Trust your training, trust your coaches, and never compare your chapter one to someone else's chapter twenty.\n\n**Q: What's next for Kwame Asante?**\n\nA: The World Athletics Championships and then the Olympics. I want to stand on that podium. I believe I can win a medal. Why not?\n\nKwame's determination is palpable. With his explosive speed and grounded mentality, the future of Ghanaian athletics is in very capable hands.",
                'excerpt' => 'Ghanaian sprinter Kwame Asante opens up about breaking the 10-second barrier, his journey from Accra to the world stage, and his Olympic ambitions.',
                'featured_image' => $img . 'interview.png',
                'category_id' => $catMap['interviews'] ?? null,
                'author_name' => 'Amara Osei',
                'status' => 'published',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => '2026-09-18 09:00:00',
                'meta_title' => 'Interview with Sprinter Kwame Asante - Sportika Blog',
                'meta_description' => 'Ghanaian sprinter Kwame Asante shares his journey, mindset, and Olympic ambitions in this exclusive interview.',
            ],

            // ==========================================
            // 5. News
            // ==========================================
            [
                'title' => 'Sportika Launches Player Verification Program to Build Trust in Athletic Profiles',
                'slug' => 'sportika-launches-player-verification',
                'content' => "In a major step toward building trust and credibility in online athlete profiles, Sportika has announced the launch of its Player Verification Program. The initiative will ensure that all athlete profiles on the platform are authentic, accurate, and maintained by the players themselves.\n\n**What is the Verification Program?**\n\nThe program introduces a multi-step verification process:\n\n1. **Identity Verification** -- Players submit government-issued ID to confirm their identity.\n2. **Credential Review** -- Our team reviews career history, statistics, and achievements for accuracy.\n3. **Profile Approval** -- Once verified, profiles receive a blue checkmark badge visible to all visitors.\n\n**Why It Matters**\n\n\"Trust is everything in sports,\" said Sportika CEO Maria Santos. \"When a scout looks at a player's profile, they need to know the information is real. Our verification program gives them that confidence.\"\n\nThe rise of fake profiles and exaggerated statistics on social platforms has been a growing concern in the sports industry. Sportika's program directly addresses this by creating a gold standard for athlete representation online.\n\n**How It Works for Players**\n\nExisting players will go through a re-verification process over the next 60 days. New registrations will be verified as part of the standard sign-up process.\n\nVerified profiles will benefit from:\n- Increased visibility in search results\n- A verified badge on their profile\n- Priority placement in the players directory\n- Access to exclusive features and opportunities\n\n**Industry Response**\n\nThe program has already received positive feedback from sports agents, scouts, and athletic organizations. \"This is exactly what the industry needs,\" said sports agent David Kim. \"Finally, a platform where I can trust the data I'm looking at.\"\n\nThe verification program is free for all players, reinforcing Sportika's commitment to making professional sports representation accessible to athletes worldwide.",
                'excerpt' => 'Sportika introduces a comprehensive player verification program with identity checks, credential reviews, and verified badges to build trust in athletic profiles.',
                'featured_image' => $img . 'sports-news.png',
                'category_id' => $catMap['news'] ?? null,
                'author_name' => 'Sportika Team',
                'status' => 'published',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => '2026-09-15 11:00:00',
                'meta_title' => 'Sportika Launches Player Verification Program - Sportika Blog',
                'meta_description' => 'Sportika introduces verified player profiles with identity checks and credential reviews to build trust in athletic representation.',
            ],

            // ==========================================
            // 6. Events
            // ==========================================
            [
                'title' => 'Youth Sports Development Programs to Watch in 2026',
                'slug' => 'youth-sports-development-programs-2026',
                'content' => "Investing in youth sports is investing in the future. Across the globe, innovative development programs are emerging that not only produce better athletes but build better humans. Here are five programs making waves in 2026.\n\n**1. Right to Dream Academy (Ghana)**\n\nBased in West Africa, Right to Dream has been developing world-class football talent for over two decades. The academy combines elite football training with academic excellence, sending graduates to top universities and professional clubs worldwide.\n\nNotable alumni include Kamaldeen Sulemana (Southampton) and Mohammed Kudus (West Ham).\n\n**2. NBA Academy Africa (Senegal)**\n\nThe NBA's basketball development center in Saly, Senegal, identifies and nurtures the continent's best young basketball talent. The program offers world-class coaching, education, and a pathway to professional basketball.\n\nSeveral alumni have been drafted into the NBA or signed with European clubs.\n\n**3. Olympic Solidarity Scholarships (Global)**\n\nThe International Olympic Committee's scholarship program provides funding for promising athletes from developing nations to access training facilities, coaching, and competition opportunities.\n\nIn 2026, the program has expanded to include combat sports and swimming, with over 2,000 athletes receiving support.\n\n**4. Cricket for Good (India)**\n\nRun by the BCCI, this program brings cricket coaching to rural India, identifying talent from villages and small towns that might otherwise go unnoticed. It has already produced several Ranji Trophy players.\n\n**5. Play Rugby Foundation (South Africa)**\n\nUsing rugby as a vehicle for social change, this program operates in underserved communities across South Africa. It combines rugby coaching with life skills education, keeping young people engaged and off the streets.\n\n**How You Can Get Involved**\n\nMany of these programs accept donations, volunteers, and partnerships. If you're an athlete or sports professional, consider:\n- Mentoring young athletes\n- Donating equipment\n- Organizing coaching clinics\n- Spreading awareness through your platform\n\nThe next generation of champions is being built today. These programs prove that with the right support, talent can emerge from anywhere.",
                'excerpt' => 'Discover five youth sports development programs around the world that are shaping the next generation of athletes and making a social impact.',
                'featured_image' => $img . 'community.png',
                'category_id' => $catMap['events'] ?? null,
                'author_name' => 'Priya Sharma',
                'status' => 'published',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => '2026-09-10 07:00:00',
                'meta_title' => 'Youth Sports Development Programs to Watch in 2026 - Sportika Blog',
                'meta_description' => 'Five youth sports development programs worldwide that are shaping the next generation of athletes and creating social impact.',
            ],

            // ==========================================
            // 7. Training Tips - Swimming
            // ==========================================
            [
                'title' => 'Swimming Techniques That Break Records: What the Pros Do Differently',
                'slug' => 'swimming-techniques-that-break-records',
                'content' => "In competitive swimming, the difference between gold and silver is often measured in hundredths of a second. We analyzed the techniques of elite swimmers, including Olympic medalist Elena Petrova, to understand what separates the good from the great.\n\n**The Underwater Phase**\n\nElite swimmers spend more time underwater than you think. After each turn and start, the underwater dolphin kick phase is critical. Top swimmers maintain tight, fast kicks for up to 15 meters -- the maximum allowed before surfacing.\n\n\"The underwater phase is where races are won,\" says Petrova. \"I spend an extra hour after every practice working on my dolphin kick.\"\n\n**Catch and Pull Mechanics**\n\nThe most efficient swimmers have a high-elbow catch that maximizes the surface area of the forearm and hand pulling through the water. This creates more propulsion per stroke.\n\nKey points:\n- Enter the water with fingertips first\n- Anchor your forearm before pulling\n- Pull in an S-pattern, not a straight line\n- Exit the hand at the thigh with a strong push\n\n**Turn Optimization**\n\nA fast turn can save 0.3-0.5 seconds per lap. Elite swmers approach the wall at full speed, execute a tight tuck, push off powerfully on their side, and streamline immediately into the underwater kick.\n\nPractice drills:\n1. Approach turns at 90% speed, focusing on tight rotation\n2. Push-off drills: push off the wall in streamline and count kicks to 15m\n3. Video analysis: record turns from above and below water\n\n**Breathing Patterns**\n\nBreathing disrupts your streamline and slows you down. The best swimmers minimize breathing in critical race sections. In the 100m freestyle, many elite swimmers breathe only 4-6 times total.\n\nTraining tip: Practice breathing every 3 strokes in training, then every 5 strokes during race-pace sets to build comfort with reduced breathing.\n\n**Race Strategy**\n\nThe best swimmers don't go all-out from the start. They negative-split -- swimming the second half faster than the first. This requires discipline and excellent pacing.\n\nFor the 200m freestyle:\n- First 50m: Controlled speed, focus on technique\n- Second 50m: Build pace gradually\n- Third 50m: Push hard, maintain form\n- Final 50m: Empty the tank\n\nImplementing these techniques takes time and consistent practice. Work with your coach to identify one or two areas to focus on each training cycle, and you'll see the improvements add up.",
                'excerpt' => 'An in-depth analysis of the swimming techniques used by elite competitors, from underwater dolphin kicks to race pacing strategies.',
                'featured_image' => $img . 'training-tips.png',
                'category_id' => $catMap['training-tips'] ?? null,
                'author_name' => 'Dr. Sarah Chen',
                'status' => 'published',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => '2026-09-05 10:00:00',
                'meta_title' => 'Swimming Techniques That Break Records - Sportika Blog',
                'meta_description' => 'Learn the techniques elite swimmers use to break records, from underwater kicks to race pacing strategies.',
            ],

            // ==========================================
            // 8. News - Community
            // ==========================================
            [
                'title' => 'How Digital Platforms Are Changing the Way Scouts Discover Athletic Talent',
                'slug' => 'digital-platforms-changing-scouting',
                'content' => "The days of scouts relying solely on in-person evaluations are fading. Digital platforms like Sportika are revolutionizing how athletic talent is discovered, evaluated, and recruited across all sports.\n\n**The Old Model**\n\nTraditionally, talent identification was geographically limited. Scouts attended local games, tournaments, and combines. If you weren't in the right place at the right time, your talent might go unnoticed.\n\nThis system favored athletes from wealthy regions with strong sports infrastructure, leaving countless talented individuals in underserved communities invisible to recruiters.\n\n**The Digital Shift**\n\nOnline athlete profiles have changed the equation. Now, a sprinter in Accra, a footballer in Sao Paulo, or a basketball player in Chicago can showcase their abilities to a global audience.\n\nKey features that make digital platforms effective:\n\n- **Video highlights** -- Game footage and training videos let scouts evaluate technique and athleticism remotely\n- **Verified statistics** -- Data-backed profiles provide objective performance metrics\n- **Direct communication** -- Players and scouts can connect without intermediaries\n- **Global reach** -- A single profile can be viewed by teams and organizations worldwide\n\n**Real-World Impact**\n\nConsider the story of Aisha Johnson, whose basketball highlights on Sportika caught the attention of a WNBA scout who wouldn't have attended her local games. Or Yuki Tanaka, whose tennis profile helped her secure a sponsorship deal with a European sports brand.\n\n\"We've completely changed our recruitment process,\" said one European football club's head of scouting. \"We now review over 500 digital profiles for every 50 in-person evaluations. It's more efficient and we've found talent we would have missed.\"\n\n**What's Next**\n\nThe integration of AI-powered analytics, virtual tryouts, and data-driven performance predictions will further transform the landscape. Platforms are beginning to offer:\n\n- Automated performance comparisons across regions\n- Injury risk assessments based on training data\n- Personality and teamwork evaluations through structured interviews\n\nThe democratization of talent discovery is not just good for athletes -- it's good for sports. When the best talent rises regardless of geography, everyone wins.",
                'excerpt' => 'Digital athlete platforms are transforming talent discovery by connecting players with scouts globally, breaking down geographic barriers in sports recruitment.',
                'featured_image' => $img . 'sports-news.png',
                'category_id' => $catMap['news'] ?? null,
                'author_name' => 'Sportika Team',
                'status' => 'published',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => '2026-09-01 12:00:00',
                'meta_title' => 'How Digital Platforms Are Changing Talent Scouting - Sportika Blog',
                'meta_description' => 'Digital athlete platforms are transforming how scouts discover talent globally, breaking geographic barriers in sports.',
            ],
        ];
    }
}
