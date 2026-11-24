# Shilpa Suraj WordPress theme

Drop this folder into WordPress. The manager then edits books, the homepage, and blogs from wp-admin. No extra paid CMS.

## Install on Hostinger

1. Hostinger hPanel → **Auto Installer** → **WordPress** (install in `public_html`, or a folder like `/wp` first if you want to test beside the old site).
2. Upload `wp-theme/shilpa-suraj` to `wp-content/themes/shilpa-suraj`.
3. Keep the existing `wp-content/uploads/` folder (covers and photos already live there).
4. wp-admin → **Appearance → Themes** → activate **Shilpa Suraj**.
5. wp-admin → **Settings → Permalinks** → save (Post name).

On first load the theme creates Home, About, Updates, Blog, the menu, 20 books (blurbs + Amazon/Goodreads), and 14 blog posts from the original HTML.

## What the manager uses

| Task | Where |
|---|---|
| Add / edit a book | **Books → Add Book** (cover, blurb, Amazon, Goodreads, tick *Show on homepage*) |
| Change landing page | **Homepage & site** (left menu) |
| Add a blog | **Posts → Add New** |
| Edit About / Updates | **Pages** |
| Give the manager access | **Users → Add User** → role **Editor** |

Do not give her Administrator unless she needs plugins/settings.

## Notes

- Homepage “Must Reads” = books with *Show on homepage* checked.
- Images: set **Featured image** on the book, or paste a cover URL.
- Old static HTML files in this repo are the previous site. WordPress replaces them once this theme is live.
