-- Add status and author_name columns to blog_posts
ALTER TABLE public.blog_posts ADD COLUMN IF NOT EXISTS status TEXT DEFAULT 'draft';
ALTER TABLE public.blog_posts ADD COLUMN IF NOT EXISTS author_name TEXT DEFAULT 'Sportika Team';

-- Update RLS policy to use status instead of is_published
DROP POLICY IF EXISTS "Published blog posts viewable by everyone" ON public.blog_posts;
CREATE POLICY "Published blog posts viewable by everyone" ON public.blog_posts FOR SELECT USING (status = 'published');
