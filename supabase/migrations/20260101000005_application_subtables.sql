-- Add missing columns to player_applications
ALTER TABLE public.player_applications ADD COLUMN IF NOT EXISTS nationality TEXT;
ALTER TABLE public.player_applications ADD COLUMN IF NOT EXISTS website TEXT;
ALTER TABLE public.player_applications ADD COLUMN IF NOT EXISTS category_id INTEGER;
ALTER TABLE public.player_applications ADD COLUMN IF NOT EXISTS experience_years INTEGER;
ALTER TABLE public.player_applications ADD COLUMN IF NOT EXISTS bio TEXT;
ALTER TABLE public.player_applications ADD COLUMN IF NOT EXISTS player_id BIGINT;

-- Add application_id to related tables so applications can store sub-data before approval
ALTER TABLE public.player_career_history ADD COLUMN IF NOT EXISTS application_id BIGINT;
ALTER TABLE public.player_achievements ADD COLUMN IF NOT EXISTS application_id BIGINT;
ALTER TABLE public.player_statistics ADD COLUMN IF NOT EXISTS application_id BIGINT;
ALTER TABLE public.player_galleries ADD COLUMN IF NOT EXISTS application_id BIGINT;
ALTER TABLE public.player_videos ADD COLUMN IF NOT EXISTS application_id BIGINT;
ALTER TABLE public.player_social_links ADD COLUMN IF NOT EXISTS application_id BIGINT;

-- Make player_id nullable in related tables (since application sub-entries won't have player_id yet)
ALTER TABLE public.player_career_history ALTER COLUMN player_id DROP NOT NULL;
ALTER TABLE public.player_achievements ALTER COLUMN player_id DROP NOT NULL;
ALTER TABLE public.player_statistics ALTER COLUMN player_id DROP NOT NULL;
ALTER TABLE public.player_galleries ALTER COLUMN player_id DROP NOT NULL;
ALTER TABLE public.player_videos ALTER COLUMN player_id DROP NOT NULL;
ALTER TABLE public.player_social_links ALTER COLUMN player_id DROP NOT NULL;
