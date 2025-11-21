# Probsolve Project Structure & Documentation

## Root Level Files
- **index.php** — Main entry point; typically redirects to frontend or displays landing page.
- **composer.json** — PHP dependency manager; lists required packages (if any).
- **package.json** — Node.js dependencies; used for Socket.io server and frontend tooling.
- **.htaccess** — Apache configuration; handles URL rewriting and routing.
- **about.md** — Project overview, vision, features, monetization, and tech stack documentation.
- **README.md** — Setup instructions, feature list, and implementation roadmap.
- **file structure.md** — Directory tree explaining the project layout.

---

## `/backend` — Server-side Logic & APIs

### `/backend/api` — REST API Endpoints
All JSON API endpoints for frontend consumption.

- **`/api/admin/`** — Admin-only endpoints
  - `moderation.php` — Approve/reject/flag content; returns moderation queue.
  - `users.php` — Ban/unban/delete users; list all users.

- **`/api/auth/`** — Authentication
  - `register.php` — Create new user account (validates, hashes password, inserts to DB).
  - `login.php` — Authenticate user (verifies credentials, sets session).
  - `logout.php` — Clear session and log out.

- **`/api/problems/`** — Problem CRUD
  - `create.php`, `list.php`, `get.php`, `update.php`, `delete.php` — Full CRUD for problems.

- **`/api/solutions/`** — Solution CRUD
  - `submit.php`, `list.php`, `get.php`, `update.php`, `delete.php` — Full CRUD for solutions.

- **`/api/users/`** — User management
  - `list.php`, `get.php`, `create.php`, `update.php`, `delete.php` — User CRUD.
  - `header-info.php` — Returns logged-in user info (username, role, unread notifications, wallet balance).

- **`/api/transactions/`** — Payment/escrow tracking
  - CRUD endpoints for transactions (payments, releases, refunds).

- **`/api/messages/`** — In-app messaging
  - `send.php`, `list.php`, `get.php` — Chat messages between users.

- **`/api/reviews/`** — User ratings
  - `create.php`, `list.php`, `get.php` — Solution and user reviews.

- **`/api/payments/`** — Payment processing
  - `simulate.php`, `process.php` — Simulated payment and escrow logic.

### `/backend/classes` — Business Logic Classes
PHP classes that handle data operations (abstracted from raw SQL).

- **User.php** — User registration, authentication, profile management.
  - `create()`, `getByUsername()`, `verifyPassword()`, `banUser()`, `unbanUser()`.

- **Problem.php** — Problem posting, fetching, status updates.
  - `create()`, `listAll()`, `get()`, `updateStatus()`.

- **Solution.php** — Solution submission and management.
  - `submit()`, `listForProblem()`, `approve()`, `reject()`.

- **Transaction.php** — Escrow and wallet management.
  - `create()`, `complete()`, `refund()`, `getWalletBalance()`.

- **Message.php** — Chat messaging.
  - `send()`, `listAll()`, `get()`.

- **Review.php** — Ratings and reviews.
  - `create()`, `listForUser()`, `get()`.

- **Moderation.php** — Content moderation.
  - `getModerationQueue()`, `approveContent()`, `rejectContent()`, `flagContent()`.

- **Notification.php** — Unread notification counting.
  - `countUnreadForUser()` — Counts pending messages or notifications.

### `/backend/config` — Configuration
- **database.php** — PDO database connection helper.
  - Reads `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS` from environment.
  - Returns a persistent PDO connection singleton.

### `/backend/functions` — Utility Functions
Reusable helper functions.

- **validation.php** — Input validation (email, password strength, etc.).
- **security.php** — CSRF tokens, sanitization, XSS prevention.
- **payment-simulator.php** — Mock payment logic (escrow hold/release/refund).
- **notifications.php** — Email and notification formatting.

### `/backend/middleware` — Request Filters
Pre-request checks and guards.

- **auth-check.php** — Verify session exists; redirect to login if not.
- **admin-check.php** — Verify user is admin; return 403 if not.
- **rate-limit.php** — Throttle requests per IP/user.
- **security.php** — CORS, security headers, CSRF validation.

### `/backend/services` — External Integrations
- **email-service.php** — Send transactional emails (confirmation, notifications).
- **ai-service.php** — Integration with OpenAI for auto-solution fallback.

---

## `/frontend` — User Interface & Client-side Code

### `/frontend/pages` — PHP Page Templates
User-facing pages (rendered server-side, enhanced with JS).

- **`/pages/auth/`** — Authentication pages
  - `login.php` — Login form; POST to `/backend/api/auth/login.php` via AJAX.
  - `register.php` — Registration form; POST to `/backend/api/auth/register.php` via AJAX.
  - `logout.php` — Clear session and redirect.

- **`/pages/asker/`** — Problem Poster Interface
  - `dashboard.php` — Overview of posted problems, solutions received, activity feed.
  - `post-problem.php` — Form to create a new problem.
  - `my-problems.php` — List of user's problems; manage and track solutions.

- **`/pages/solver/`** — Solution Provider Interface
  - `dashboard.php` — Earnings, reputation, available problems.
  - `browse-problems.php` — Filter and search for problems to solve.
  - `my-solutions.php` — Submitted solutions and their status.

- **`/pages/admin/`** — Admin Dashboard
  - `dashboard.php` — Platform stats, recent activity, user management, quick actions.
  - `moderation.php` — Content queue; approve/reject/flag user submissions.

- **`/pages/public/`** — Public Pages (no auth required)
  - `index.php` — Landing page.
  - `explore.php` — Browse public problems and solver profiles.
  - `problem-gallery.php` — Curated feed of interesting problems.

### `/frontend/includes` — Reusable Components
Modular PHP snippets included across pages.

- **header.php** — Navigation bar, user dropdown, notifications badge, wallet balance.
  - Fetches `/backend/api/user/header-info.php` via AJAX for dynamic updates.

- **footer.php** — Footer with links, social icons, company info.

- **navigation.php** — Quick navigation bar (Post Problem, Find Problems, stats).

- **`/includes/modals/`** — Bootstrap Modal Dialogs
  - `auth.php` — Login and registration modals.
  - `post-problem.php` — Create problem modal.
  - `chat.php` — In-app messaging modal.

### `/frontend/assets` — Static Files

- **`/assets/css/`** — Stylesheets
  - `bootstrap/` — Bootstrap framework CSS.
  - `tailwind/` — Tailwind utility CSS.
  - `custom/` — Custom styles
    - `main.css` — Global styles.
    - `dashboard.css` — Dashboard layouts and cards.
    - `forms.css` — Form styling.
    - `auth.css` — Authentication page styles.
    - `responsive.css` — Mobile/responsive overrides.

- **`/assets/js/`** — JavaScript
  - `bootstrap/` — Bootstrap JS plugins (dropdowns, modals, etc.).
  - `custom/` — Custom scripts
    - `main.js` — Global utilities (notifications, tooltips, form validation, Socket.io initialization).
    - `forms.js` — Form-specific logic (budget calculator, validation).
  - `socket.io/` — Real-time features
    - `client.js` — Socket.io client; listens for chat, notifications, problem updates.

- **`/assets/images/`** — Static images (logos, backgrounds, etc.).
- **`/assets/icons/`** — Icon files (favicons, SVGs, etc.).

### `/frontend/templates` — Unused (Placeholder)
Reserved for future template components.

---

## `/database` — Database Schema & Data

### `/database/schema` — Database Structure
- **tables.sql** — Core table definitions (users, problems, solutions, transactions, messages, reviews).
- **indexes.sql** — Performance indexes on frequently queried columns.
- **probsolve_schema.sql** — Complete schema in one file (includes everything).

### `/database/migrations` — Version Control for Schema
- **001_initial_tables.php** — Initial schema creation.
- **002_add_new_features.php** — Future schema updates (versioning).

### `/database/seeds` — Sample Data
- **users.sql** — Sample user records (demo accounts).
- **problems.sql** — Sample problems for testing.
- **solutions.sql** — Sample solutions.

### `/database/backups` — Database Backups
- Automated/manual backups stored here (for disaster recovery).

---

## `/real-time` — Socket.io Server (Node.js)

- **server.js** — Node.js + Socket.io server.
  - Listens on port 3000 (or env var).
  - Relays chat messages, notifications, and real-time updates to all connected clients.

- **`/handlers/`** — Event handlers (placeholder for extensibility).

---

## `/scripts` — Utility & Admin Scripts

- **setup-db.php** — Initialize database (run once on first install).
- **seed-data.php** — Populate database with demo/test data.
- **backup-db.php** — Automated database backup script (can be scheduled via cron).

---

## `/uploads` — User-Generated Files

- **`/profiles/`** — User profile pictures.
- **`/documents/`** — Problem attachments, reference files.
- **`/solutions/`** — Solution attachments, code files, etc.

---

## `/logs` — Application Logs

- **error.log** — PHP errors and exceptions.
- **access.log** — HTTP request log.
- **payments.log** — Payment transaction log.

---

## `/tests` — Automated Tests

- **`/Unit/`** — Unit tests for individual classes (User, Problem, Solution, etc.).
- **`/Integration/`** — Integration tests for API workflows (register → login → post problem → submit solution, etc.).

---

## `/docs` — Documentation

- **`/api/`** — API endpoint documentation (request/response examples).
- **`/deployment/`** — Server setup, environment config, deployment steps.
- **`/user-guides/`** — User-facing guides for Askers, Solvers, and Admins.

---

## `/vendor` — Composer Dependencies
- Installed PHP packages (if using Composer).

---

## `/node_modules` — NPM Dependencies
- Installed Node.js packages (Socket.io, etc.).

---

## Summary

| Layer | Purpose |
|-------|---------|
| **`/backend/api/`** | JSON endpoints consumed by frontend |
| **`/backend/classes/`** | Business logic (database operations) |
| **`/backend/config/`** | Environment and DB setup |
| **`/backend/middleware/`** | Request guards (auth, rate limit, CORS) |
| **`/backend/services/`** | External integrations (email, AI) |
| **`/frontend/pages/`** | User-facing PHP pages |
| **`/frontend/includes/`** | Reusable components (header, modals) |
| **`/frontend/assets/`** | CSS, JS, images |
| **`/database/`** | Schema, migrations, seeds, backups |
| **`/real-time/`** | Socket.io server for live updates |
| **`/scripts/`** | Admin utilities (setup, backup) |
| **`/uploads/`** | User files (profiles, documents) |
| **`/logs/`** | Application logs |
| **`/tests/`** | Automated tests |
| **`/docs/`** | Project documentation |

This structure follows a **clean backend-frontend separation**: APIs are stateless and reusable, frontend is thin and mostly presentational, and business logic is centralized in classes for easy testing and maintenance.



