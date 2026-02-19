# Lunar Change Log

Track key project changes.

## Deployment
- Added server-side DreamHost deploy repo at `~/repos/lunar.git` with `post-receive` hook deploying to `~/norman-love.com/lunar`.
- Configured local `origin` push URLs to push both GitHub and DreamHost deploy remote in one `git push origin main`.
- Disabled fragile local `post-push` hook dependency (`core.hooksPath` unset).

## css-updates
- Branch created for local styling improvements to `/lunar/`.
- Style lunar page: linked stylesheet in `index.php`, replaced invalid `html5` tag usage, improved typography/colors/spacing, and made transit table responsive.
