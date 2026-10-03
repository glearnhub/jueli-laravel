# Deploying Jueli Engineering Ltd to production

## 1. Requirements
- PHP 8.2+ with `gd`, `mbstring`, `intl`, `zip`, `pdo_mysql`, `fileinfo`, `xml`
- MySQL 8 / MariaDB 10.4+, Apache with `mod_rewrite` (Nginx works too, see the Laravel docs)
- A TLS certificate (AutoSSL / Let's Encrypt) for the domain

## 2. First-time setup
1. **Point the domain's document root at the `public/` folder.** If the host cannot do that, the
   root `.htaccess` forwards requests to `public/` as a fallback.
2. Upload the project (or `git clone` it), then:
   ```bash
   composer install --no-dev --optimize-autoloader
   cp .env.production.example .env        # then fill in APP_URL and the DB_* values
   php artisan key:generate
   ```
3. **Assets:** `public/build` is not in git. Run `npm ci && npm run build` locally and upload the
   `public/build/` folder (or build on the server if Node is available).
4. **Database + catalog:**
   ```bash
   php artisan migrate --seed --force
   php artisan storage:link
   ```
   With `APP_ENV=production` the seeder loads the product catalog (about 1,000 products with photos)
   but **no demo data**, and creates the admin from `ADMIN_EMAIL`/`ADMIN_PASSWORD`. If
   `ADMIN_PASSWORD` is empty a random strong password is **printed once** - save it.
5. `php artisan optimize` (or just run `bash deploy.sh`).
6. Log in at `https://your-domain/admin/`, change the password, then fill in
   **Settings → Website Settings** (phone, email, address, social links). The footer, contact page and
   WhatsApp buttons all read from there.

## 3. Updating the site
```bash
git pull
bash deploy.sh
```

## 4. Production checklist
- [ ] `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` is the real `https://` URL
- [ ] `.env` is **not** web-accessible (document root is `public/`) and is never committed
- [ ] Admin password changed from the seeded one; unused admin accounts removed
- [ ] Settings page filled in (phone, email, address, social links)
- [ ] Team members added in Admin → Team (production seeding adds none)
- [ ] `https://your-domain/sitemap.xml` submitted in Google Search Console
- [ ] Daily DB backup set up (cPanel Backup / `mysqldump` cron) - also back up `storage/app/public`
- [ ] Logs in `storage/logs/` are rotated daily (`LOG_STACK=daily`); check them occasionally
- [ ] `TRUSTED_PROXIES=*` only if the site sits behind Cloudflare or a load balancer you control

## 5. What is already built in
- Login throttling (10/min) and contact-form throttling (5/min)
- Security headers (nosniff, frame protection, referrer policy, HSTS over HTTPS); admin pages are
  `noindex`, `no-store`
- Role-based permissions on every admin area; activity log of admin actions
- CSV/Excel export protection against spreadsheet formula injection
- SEO: per-page titles/descriptions, canonical + Open Graph tags, `robots.txt`, `sitemap.xml`
- Branded error pages (403, 404, 419, 429, 500, 503) that work even if the database is down
- Health check endpoint at `/up` for uptime monitors
- Gzip, long-term caching for built assets, HTTP→HTTPS redirect (`public/.htaccess`)

## 6. Not included (decide if you need them)
- Email notification when a contact message arrives (messages are stored in Admin → Messages;
  configure `MAIL_*` and a notification if you want email alerts)
- Cookie-consent banner / privacy policy page (the site records anonymous page-view counts)
- Off-site backups and uptime monitoring
