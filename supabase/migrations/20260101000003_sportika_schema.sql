-- =============================================
-- SPORTIKA: Sport Categories
-- =============================================
CREATE TABLE IF NOT EXISTS public.categories (
    id BIGSERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    slug TEXT UNIQUE NOT NULL,
    description TEXT,
    icon TEXT,
    image TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
CREATE INDEX IF NOT EXISTS idx_categories_slug ON public.categories(slug);
ALTER TABLE public.categories ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Categories are viewable by everyone" ON public.categories FOR SELECT USING (true);
CREATE POLICY "Admins can manage categories" ON public.categories FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Players Directory
-- =============================================
CREATE TABLE IF NOT EXISTS public.players (
    id BIGSERIAL PRIMARY KEY,
    user_id UUID REFERENCES public.profiles(id) ON DELETE SET NULL,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    slug TEXT UNIQUE NOT NULL,
    photo TEXT,
    bio TEXT,
    date_of_birth DATE,
    gender TEXT CHECK (gender IN ('male', 'female', 'other')),
    nationality TEXT,
    -- Sport info
    category_id INTEGER REFERENCES public.categories(id) ON DELETE SET NULL,
    sport TEXT NOT NULL,
    position TEXT,
    -- Location
    city TEXT,
    country TEXT,
    -- Status
    is_featured BOOLEAN DEFAULT FALSE,
    is_published BOOLEAN DEFAULT FALSE,
    is_approved BOOLEAN DEFAULT FALSE,
    -- Current team
    current_team TEXT,
    current_league TEXT,
    -- Contact
    email TEXT,
    phone TEXT,
    website TEXT,
    -- CV
    cv_url TEXT,
    -- Stats summary
    height_cm INTEGER,
    weight_kg INTEGER,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL,
    updated_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
CREATE INDEX IF NOT EXISTS idx_players_slug ON public.players(slug);
CREATE INDEX IF NOT EXISTS idx_players_sport ON public.players(sport);
CREATE INDEX IF NOT EXISTS idx_players_published ON public.players(is_published);
CREATE INDEX IF NOT EXISTS idx_players_featured ON public.players(is_featured);
CREATE INDEX IF NOT EXISTS idx_players_category ON public.players(category_id);
ALTER TABLE public.players ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Published players are viewable by everyone" ON public.players FOR SELECT USING (is_published = true);
CREATE POLICY "Admins can view all players" ON public.players FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);
CREATE POLICY "Admins can manage players" ON public.players FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);
CREATE TRIGGER update_players_updated_at BEFORE UPDATE ON public.players FOR EACH ROW EXECUTE FUNCTION public.update_updated_at();

-- =============================================
-- SPORTIKA: Player Career History
-- =============================================
CREATE TABLE IF NOT EXISTS public.player_career_history (
    id BIGSERIAL PRIMARY KEY,
    player_id BIGINT NOT NULL REFERENCES public.players(id) ON DELETE CASCADE,
    team_name TEXT NOT NULL,
    league TEXT,
    position TEXT,
    start_year INTEGER,
    end_year INTEGER,
    appearances INTEGER,
    goals INTEGER,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.player_career_history ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Career history viewable for published players" ON public.player_career_history FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.players WHERE players.id = player_id AND is_published = true)
);
CREATE POLICY "Admins can manage career history" ON public.player_career_history FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Player Achievements
-- =============================================
CREATE TABLE IF NOT EXISTS public.player_achievements (
    id BIGSERIAL PRIMARY KEY,
    player_id BIGINT NOT NULL REFERENCES public.players(id) ON DELETE CASCADE,
    title TEXT NOT NULL,
    description TEXT,
    year INTEGER,
    award_type TEXT,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.player_achievements ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Achievements viewable for published players" ON public.player_achievements FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.players WHERE players.id = player_id AND is_published = true)
);
CREATE POLICY "Admins can manage achievements" ON public.player_achievements FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Player Statistics
-- =============================================
CREATE TABLE IF NOT EXISTS public.player_statistics (
    id BIGSERIAL PRIMARY KEY,
    player_id BIGINT NOT NULL REFERENCES public.players(id) ON DELETE CASCADE,
    season TEXT,
    stat_key TEXT NOT NULL,
    stat_value TEXT NOT NULL,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.player_statistics ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Stats viewable for published players" ON public.player_statistics FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.players WHERE players.id = player_id AND is_published = true)
);
CREATE POLICY "Admins can manage stats" ON public.player_statistics FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Player Skills
-- =============================================
CREATE TABLE IF NOT EXISTS public.player_skills (
    id BIGSERIAL PRIMARY KEY,
    player_id BIGINT NOT NULL REFERENCES public.players(id) ON DELETE CASCADE,
    skill_name TEXT NOT NULL,
    rating INTEGER DEFAULT 0 CHECK (rating >= 0 AND rating <= 100),
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.player_skills ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Skills viewable for published players" ON public.player_skills FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.players WHERE players.id = player_id AND is_published = true)
);
CREATE POLICY "Admins can manage skills" ON public.player_skills FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Player Gallery
-- =============================================
CREATE TABLE IF NOT EXISTS public.player_galleries (
    id BIGSERIAL PRIMARY KEY,
    player_id BIGINT NOT NULL REFERENCES public.players(id) ON DELETE CASCADE,
    image_url TEXT NOT NULL,
    caption TEXT,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.player_galleries ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Gallery viewable for published players" ON public.player_galleries FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.players WHERE players.id = player_id AND is_published = true)
);
CREATE POLICY "Admins can manage gallery" ON public.player_galleries FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Player Videos
-- =============================================
CREATE TABLE IF NOT EXISTS public.player_videos (
    id BIGSERIAL PRIMARY KEY,
    player_id BIGINT NOT NULL REFERENCES public.players(id) ON DELETE CASCADE,
    video_url TEXT NOT NULL,
    title TEXT,
    description TEXT,
    video_type TEXT DEFAULT 'youtube' CHECK (video_type IN ('youtube', 'vimeo', 'direct')),
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.player_videos ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Videos viewable for published players" ON public.player_videos FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.players WHERE players.id = player_id AND is_published = true)
);
CREATE POLICY "Admins can manage videos" ON public.player_videos FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Player Social Links
-- =============================================
CREATE TABLE IF NOT EXISTS public.player_social_links (
    id BIGSERIAL PRIMARY KEY,
    player_id BIGINT NOT NULL REFERENCES public.players(id) ON DELETE CASCADE,
    platform TEXT NOT NULL,
    url TEXT NOT NULL,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.player_social_links ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Social links viewable for published players" ON public.player_social_links FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.players WHERE players.id = player_id AND is_published = true)
);
CREATE POLICY "Admins can manage social links" ON public.player_social_links FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Player Applications (Registration)
-- =============================================
CREATE TABLE IF NOT EXISTS public.player_applications (
    id BIGSERIAL PRIMARY KEY,
    -- Personal info
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT,
    date_of_birth DATE,
    gender TEXT CHECK (gender IN ('male', 'female', 'other')),
    photo TEXT,
    -- Location
    city TEXT,
    country TEXT,
    -- Sport info
    sport TEXT NOT NULL,
    position TEXT,
    -- History
    playing_history TEXT,
    current_team TEXT,
    current_league TEXT,
    -- Details
    achievements TEXT,
    statistics TEXT,
    education TEXT,
    skills TEXT,
    certifications TEXT,
    -- Media
    gallery TEXT, -- JSON array of image URLs
    videos TEXT, -- JSON array of video URLs
    social_links TEXT, -- JSON object
    cv_url TEXT,
    -- Status
    status TEXT DEFAULT 'pending' CHECK (status IN ('pending', 'under_review', 'approved', 'rejected')),
    admin_notes TEXT,
    reviewed_by UUID REFERENCES public.profiles(id) ON DELETE SET NULL,
    reviewed_at TIMESTAMPTZ,
    -- Links to created player
    player_id BIGINT REFERENCES public.players(id) ON DELETE SET NULL,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL,
    updated_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
CREATE INDEX IF NOT EXISTS idx_applications_status ON public.player_applications(status);
ALTER TABLE public.player_applications ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Users can create applications" ON public.player_applications FOR INSERT WITH CHECK (true);
CREATE POLICY "Admins can view all applications" ON public.player_applications FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);
CREATE POLICY "Admins can manage applications" ON public.player_applications FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);
CREATE TRIGGER update_applications_updated_at BEFORE UPDATE ON public.player_applications FOR EACH ROW EXECUTE FUNCTION public.update_updated_at();

-- =============================================
-- SPORTIKA: Blog Categories
-- =============================================
CREATE TABLE IF NOT EXISTS public.blog_categories (
    id BIGSERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    slug TEXT UNIQUE NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
CREATE INDEX IF NOT EXISTS idx_blog_categories_slug ON public.blog_categories(slug);
ALTER TABLE public.blog_categories ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Blog categories viewable by everyone" ON public.blog_categories FOR SELECT USING (true);
CREATE POLICY "Admins can manage blog categories" ON public.blog_categories FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Blog Posts (replaces old posts table)
-- =============================================
CREATE TABLE IF NOT EXISTS public.blog_posts (
    id BIGSERIAL PRIMARY KEY,
    title TEXT NOT NULL,
    slug TEXT UNIQUE NOT NULL,
    content TEXT,
    excerpt TEXT,
    featured_image TEXT,
    category_id INTEGER REFERENCES public.blog_categories(id) ON DELETE SET NULL,
    author_id UUID REFERENCES public.profiles(id) ON DELETE SET NULL,
    is_featured BOOLEAN DEFAULT FALSE,
    is_published BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMPTZ,
    meta_title TEXT,
    meta_description TEXT,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL,
    updated_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
CREATE INDEX IF NOT EXISTS idx_blog_posts_slug ON public.blog_posts(slug);
CREATE INDEX IF NOT EXISTS idx_blog_posts_published ON public.blog_posts(is_published);
CREATE INDEX IF NOT EXISTS idx_blog_posts_featured ON public.blog_posts(is_featured);
CREATE INDEX IF NOT EXISTS idx_blog_posts_category ON public.blog_posts(category_id);
ALTER TABLE public.blog_posts ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Published blog posts viewable by everyone" ON public.blog_posts FOR SELECT USING (is_published = true);
CREATE POLICY "Admins can view all blog posts" ON public.blog_posts FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);
CREATE POLICY "Admins can manage blog posts" ON public.blog_posts FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);
CREATE TRIGGER update_blog_posts_updated_at BEFORE UPDATE ON public.blog_posts FOR EACH ROW EXECUTE FUNCTION public.update_updated_at();

-- =============================================
-- SPORTIKA: Contact Submissions
-- =============================================
CREATE TABLE IF NOT EXISTS public.contacts (
    id BIGSERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    subject TEXT,
    message TEXT NOT NULL,
    inquiry_type TEXT DEFAULT 'general' CHECK (inquiry_type IN ('general', 'player', 'partnership', 'media', 'other')),
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.contacts ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Anyone can submit contact forms" ON public.contacts FOR INSERT WITH CHECK (true);
CREATE POLICY "Admins can view contacts" ON public.contacts FOR SELECT USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);
CREATE POLICY "Admins can manage contacts" ON public.contacts FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);

-- =============================================
-- SPORTIKA: Website Settings
-- =============================================
CREATE TABLE IF NOT EXISTS public.settings (
    id BIGSERIAL PRIMARY KEY,
    key TEXT UNIQUE NOT NULL,
    value TEXT,
    type TEXT DEFAULT 'text' CHECK (type IN ('text', 'boolean', 'number', 'json', 'image')),
    group_name TEXT DEFAULT 'general',
    label TEXT,
    description TEXT,
    updated_at TIMESTAMPTZ DEFAULT NOW() NOT NULL
);
ALTER TABLE public.settings ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Settings viewable by everyone" ON public.settings FOR SELECT USING (true);
CREATE POLICY "Admins can manage settings" ON public.settings FOR ALL USING (
    EXISTS (SELECT 1 FROM public.profiles WHERE profiles.id = auth.uid() AND profiles.role = 'admin')
);
CREATE TRIGGER update_settings_updated_at BEFORE UPDATE ON public.settings FOR EACH ROW EXECUTE FUNCTION public.update_updated_at();

-- =============================================
-- SPORTIKA: Default Settings
-- =============================================
INSERT INTO public.settings (key, value, type, group_name, label) VALUES
    ('site_name', 'Sportika', 'text', 'general', 'Site Name'),
    ('site_tagline', 'Where Athletes Shine', 'text', 'general', 'Site Tagline'),
    ('site_description', 'Sportika is the premier platform for athletes to showcase their talent and connect with opportunities.', 'text', 'general', 'Site Description'),
    ('contact_email', 'hello@sportika.com', 'text', 'contact', 'Contact Email'),
    ('contact_phone', '+1 234 567 8900', 'text', 'contact', 'Contact Phone'),
    ('contact_address', '123 Sports Avenue, Athletic City', 'text', 'contact', 'Contact Address'),
    ('facebook_url', '', 'text', 'social', 'Facebook URL'),
    ('twitter_url', '', 'text', 'social', 'Twitter URL'),
    ('instagram_url', '', 'text', 'social', 'Instagram URL'),
    ('youtube_url', '', 'text', 'social', 'YouTube URL'),
    ('linkedin_url', '', 'text', 'social', 'LinkedIn URL')
ON CONFLICT (key) DO NOTHING;

-- =============================================
-- SPORTIKA: Seed Categories
-- =============================================
INSERT INTO public.categories (name, slug, sort_order) VALUES
    ('Football', 'football', 1),
    ('Basketball', 'basketball', 2),
    ('Tennis', 'tennis', 3),
    ('Cricket', 'cricket', 4),
    ('Swimming', 'swimming', 5),
    ('Athletics', 'athletics', 6),
    ('Volleyball', 'volleyball', 7),
    ('Hockey', 'hockey', 8),
    ('Boxing', 'boxing', 9),
    ('MMA', 'mma', 10)
ON CONFLICT (slug) DO NOTHING;

-- =============================================
-- SPORTIKA: Seed Blog Categories
-- =============================================
INSERT INTO public.blog_categories (name, slug) VALUES
    ('News', 'news'),
    ('Player Spotlight', 'player-spotlight'),
    ('Tournaments', 'tournaments'),
    ('Training Tips', 'training-tips'),
    ('Interviews', 'interviews'),
    ('Events', 'events')
ON CONFLICT (slug) DO NOTHING;
