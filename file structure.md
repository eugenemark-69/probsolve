# Probsolve - Project File Structure (2025)
probsolve/
├── .htaccess
├── about.md
├── assets/
├── backend/
│   ├── api/
│   │   ├── admin/
│   │   │   ├── moderation.php
│   │   │   └── users.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   ├── logout.php
│   │   │   └── register.php
│   │   ├── comment-likes/
│   │   │   └── create.php
│   │   ├── comments/
│   │   │   ├── create.php
│   │   │   └── list.php
│   │   ├── messages/
│   │   │   ├── get.php
│   │   │   ├── list.php
│   │   │   └── send.php
│   │   ├── payments/
│   │   │   ├── process.php
│   │   │   └── simulate.php
│   │   ├── problems/
│   │   │   ├── create.php
│   │   │   ├── delete.php
│   │   │   ├── get.php
│   │   │   ├── like.php
│   │   │   ├── list.php
│   │   │   └── update.php
│   │   ├── reviews/
│   │   │   ├── create.php
│   │   │   ├── get.php
│   │   │   └── list.php
│   │   ├── solution-likes/
│   │   │   └── create.php
│   │   ├── solutions/
│   │   │   ├── delete.php
│   │   │   ├── get.php
│   │   │   ├── list.php
│   │   │   ├── submit.php
│   │   │   └── update.php
│   │   ├── transactions/
│   │   │   ├── create.php
│   │   │   ├── get.php
│   │   │   ├── list.php
│   │   │   └── update.php
│   │   ├── user/
│   │   │   └── header-info.php
│   │   └── users/
│   │       ├── create.php
│   │       ├── delete.php
│   │       ├── get.php
│   │       ├── list.php
│   │       └── update.php
│   ├── classes/
│   │   ├── Message.php
│   │   ├── Moderation.php
│   │   ├── Notification.php
│   │   ├── Problem.php
│   │   ├── Review.php
│   │   ├── Solution.php
│   │   ├── Transaction.php
│   │   └── User.php
│   ├── config/
│   │   └── database.php
│   ├── functions/
│   │   ├── notifications.php
│   │   ├── payment-simulator.php
│   │   ├── security.php
│   │   └── validation.php
│   ├── middleware/
│   │   ├── admin-check.php
│   │   ├── auth-check.php
│   │   ├── rate-limit.php
│   │   └── security.php
│   └── services/
│       ├── ai-service.php
│       └── email-service.php
├── composer.json
├── database/
│   ├── backups/
│   ├── migrations/
│   │   ├── 001_initial_tables.php
│   │   └── 002_add_new_features.php
│   ├── schema/
│   │   ├── indexes.sql
│   │   ├── probsolve_schema.sql
│   │   └── tables.sql
│   └── seeds/
│       ├── sample-data.sql
│       ├── problems.sql
│       ├── solutions.sql
│       └── users.sql
├── docs/
│   ├── api/
│   ├── deployment/
│   ├── SIGNUP_LOGIN_FIX.md
│   └── user-guides/
├── file structure.md
├── frontend/
│   ├── assets/
│   │   ├── css/
│   │   │   ├── bootstrap/
│   │   │   ├── custom/
│   │   │   │   ├── auth.css
│   │   │   │   ├── dashboard.css
│   │   │   │   ├── forms.css
│   │   │   │   ├── main.css
│   │   │   │   └── responsive.css
│   │   │   └── tailwind/
│   │   ├── icons/
│   │   ├── images/
│   │   └── js/
│   │       ├── bootstrap/
│   │       ├── custom/
│   │       │   ├── forms.js
│   │       │   └── main.js
│   │       └── socket.io/
│   │           └── client.js
│   ├── includes/
│   │   ├── footer.php
│   │   ├── header.php
│   │   ├── modals/
│   │   │   ├── auth.php
│   │   │   ├── chat.php
│   │   │   └── post-problem.php
│   │   └── navigation.php
│   ├── pages/
│   │   ├── admin/
│   │   │   ├── dashboard.php
│   │   │   └── moderation.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   ├── logout.php
│   │   │   └── register.php
│   │   ├── browse-problems.php
│   │   ├── dashboard.php
│   │   ├── problem-detail.php
│   │   ├── public/
│   │   │   ├── explore.php
│   │   │   ├── index.php
│   │   │   └── problem-gallery.php
│   │   ├── user/
│   │   │   ├── about.php
│   │   │   ├── notifications.php
│   │   │   ├── profile.php
│   │   │   └── settings.php
│   │   └── templates/
├── index.php
├── logs/
├── node_modules/
├── package.json
├── README.md
├── real-time/
│   ├── handlers/
│   └── server.js
├── scripts/
│   ├── backup-db.php
│   ├── seed-data.php
│   └── setup-db.php
├── summary.md
├── tests/
│   ├── Integration/
│   ├── Unit/
│   ├── api-test.php
│   ├── debug-signup.php
│   ├── test-db.php
│   ├── test-setup.php
│   └── verify-system.php
├── uploads/
│   ├── documents/
│   ├── profiles/
│   └── solutions/
└── vendor/



# Probsolve - Project Overview & Quick Reference

## What is Probsolve?
A web platform that connects **problem posters (Askers)** with **problem solvers (Solvers)**, enabling knowledge exchange with secure payments via escrow and admin moderation.

---

## 📁 Directory Structure & Purpose

### Root Files
| File | Purpose |
|------|---------|
| `index.php` | Main entry point; landing page or dashboard redirect |
| `composer.json` | PHP dependencies (Composer) |
| `package.json` | Node.js dependencies (Socket.io, npm packages) |
| `.htaccess` | Apache URL rewriting & routing config |
| `about.md` | Project vision, features, and tech stack |
| `README.md` | Setup guide and feature roadmap |
| `summary.md` | Detailed structure documentation |
| `file structure.md` | Directory tree overview |
| `PROJECT_OVERVIEW.md` | This file; quick reference guide |

---

## 🔧 Backend (`/backend`)
Server-side logic, APIs, and business logic.

### `/backend/api` — REST Endpoints
JSON APIs that frontend consumes. Organized by feature:

| Endpoint | Files | Purpose |
|----------|-------|---------|
| `/api/auth/` | `login.php`, `register.php`, `logout.php` | User authentication |
| `/api/admin/` | `moderation.php`, `users.php` | Admin-only operations (ban users, moderate content) |
| `/api/problems/` | `create.php`, `list.php`, `get.php`, `update.php`, `delete.php`, `like.php` | Problem CRUD + liking |
| `/api/solutions/` | `submit.php`, `list.php`, `get.php`, `update.php`, `delete.php` | Solution CRUD |
| `/api/comments/` | `create.php`, `list.php` | Problem comments (Reddit-style) |
| `/api/comment-likes/` | `create.php` | Like/unlike comments |
| `/api/solution-likes/` | `create.php` | Like/unlike solutions |
| `/api/users/` | `create.php`, `get.php`, `list.php`, `update.php`, `delete.php` | User management |
| `/api/user/` | `header-info.php` | Fetch current user info (notifications, wallet, role) |
| `/api/transactions/` | `create.php`, `get.php`, `list.php`, `update.php` | Payment/escrow tracking |
| `/api/messages/` | `send.php`, `list.php`, `get.php` | In-app chat |
| `/api/reviews/` | `create.php`, `list.php`, `get.php` | User ratings & reviews |
| `/api/payments/` | `process.php`, `simulate.php` | Payment processing & simulation |

### `/backend/classes` — Business Logic
PHP classes encapsulating database operations and business rules.

| Class | Methods | Purpose |
|-------|---------|---------|
| `User.php` | `create()`, `getByUsername()`, `verifyPassword()`, `banUser()` | User management & auth |
| `Problem.php` | `create()`, `listAll()`, `get()`, `updateStatus()` | Problem lifecycle |
| `Solution.php` | `submit()`, `listForProblem()`, `approve()`, `reject()` | Solution handling |
| `Transaction.php` | `create()`, `complete()`, `refund()`, `getWalletBalance()` | Escrow & payments |
| `Message.php` | `send()`, `listAll()`, `get()` | Chat messaging |
| `Review.php` | `create()`, `listForUser()`, `get()` | Ratings & feedback |
| `Moderation.php` | `getModerationQueue()`, `approveContent()`, `rejectContent()`, `flagContent()` | Content moderation |
| `Notification.php` | `countUnreadForUser()` | Notification counting |

### `/backend/config` — Configuration
- `database.php` — PDO connection singleton; reads DB credentials from environment

### `/backend/functions` — Utility Functions
Reusable helpers for validation, security, and payments.

| Function | Purpose |
|----------|---------|
| `validation.php` | Email, password, input validation |
| `security.php` | CSRF tokens, XSS prevention, sanitization |
| `payment-simulator.php` | Mock escrow hold/release/refund logic |
| `notifications.php` | Email & notification formatting |

### `/backend/middleware` — Request Guards
Pre-request checks before route execution.

| Middleware | Purpose |
|-----------|---------|
| `auth-check.php` | Verify session exists; redirect if not |
| `admin-check.php` | Verify user is admin; 403 if not |
| `rate-limit.php` | Throttle requests per IP/user |
| `security.php` | CORS headers, security headers, CSRF validation |

### `/backend/services` — External Integrations
- `email-service.php` — Send transactional emails (signup, notifications)
- `ai-service.php` — OpenAI integration for auto-solution fallback

---

## 🎨 Frontend (`/frontend`)
User-facing pages, UI components, and client-side code.

### `/frontend/pages` — Page Templates
Server-rendered PHP pages with JS enhancement.

| Route | Files | Purpose |
|-------|-------|---------|
| `/auth/` | `login.php`, `register.php`, `logout.php` | Authentication pages |
| `/` | `dashboard.php` | Unified dashboard (post problems & see solutions) |
| `/` | `browse-problems.php` | Browse and filter problems |
| `/` | `problem-detail.php` | View single problem with comments, solutions, likes |
| `/user/` | `profile.php`, `settings.php`, `about.php`, `notifications.php` | User account pages |
| `/admin/` | `dashboard.php`, `moderation.php` | Platform management (admin only) |
| `/public/` | `index.php`, `explore.php`, `problem-gallery.php` | Landing & browsing (no auth) |

### `/frontend/includes` — Reusable Components
PHP partials included across pages.

| File | Purpose |
|------|---------|
| `header.php` | Navigation bar, user menu, notifications, wallet balance |
| `footer.php` | Footer with links, social, company info |
| `navigation.php` | Quick nav (Post Problem, Find Problems, stats) |
| `modals/auth.php` | Login/signup modal dialogs |
| `modals/post-problem.php` | Create problem modal |
| `modals/chat.php` | In-app messaging modal |

### `/frontend/assets` — Static Resources

#### `/assets/css/` — Stylesheets
| Folder/File | Purpose |
|-------------|---------|
| `bootstrap/` | Bootstrap framework CSS |
| `tailwind/` | Tailwind utility CSS |
| `custom/main.css` | Global styles |
| `custom/dashboard.css` | Dashboard layouts & cards |
| `custom/forms.css` | Form styling |
| `custom/auth.css` | Authentication page styles |
| `custom/responsive.css` | Mobile/responsive overrides |

#### `/assets/js/` — JavaScript
| Folder/File | Purpose |
|-------------|---------|
| `bootstrap/` | Bootstrap JS plugins (modals, dropdowns) |
| `custom/main.js` | Global utils (notifications, tooltips, validation) |
| `custom/forms.js` | Form logic (budget calc, validation) |
| `socket.io/client.js` | Real-time chat & notifications |

#### `/assets/` — Media
| Folder | Purpose |
|--------|---------|
| `images/` | Static images, logos, backgrounds |
| `icons/` | SVGs, favicons, icon files |

### `/frontend/templates/` — Unused
Reserved for future reusable template components.

---

## 💾 Database (`/database`)
Schema, migrations, seeds, and backups.

### `/database/schema` — Database Structure
| File | Purpose |
|------|---------|
| `tables.sql` | Core table definitions (users, problems, solutions, etc.) |
| `indexes.sql` | Performance indexes on frequently queried columns |
| `probsolve_schema.sql` | Complete schema in one file (master copy) |

### `/database/migrations` — Version Control
PHP scripts to apply schema changes in order.

| File | Purpose |
|------|---------|
| `001_initial_tables.php` | Initial schema creation |
| `002_add_new_features.php` | Future schema updates (v2 features) |

### `/database/seeds` — Sample Data
SQL data for testing and demo.

| File | Purpose |
|------|---------|
| `users.sql` | Demo user accounts |
| `problems.sql` | Sample problems |
| `solutions.sql` | Sample solutions |

### `/database/backups/` — Disaster Recovery
Automated/manual database backups stored here.

---

## ⚡ Real-Time (`/real-time`)
Node.js Socket.io server for live chat and notifications.

| File | Purpose |
|------|---------|
| `server.js` | Socket.io server (port 3000); handles chat, notifications, updates |
| `handlers/` | Event handler modules (extensible) |

---

## 🛠️ Scripts (`/scripts`)
Utility scripts for setup, seeding, and maintenance.

| Script | Purpose |
|--------|---------|
| `setup-db.php` | Initialize database (run once on install) |
| `seed-data.php` | Populate DB with demo data |
| `backup-db.php` | Automated backup script (can be scheduled via cron) |

---

## 📤 Uploads (`/uploads`)
User-generated file storage.

| Folder | Purpose |
|--------|---------|
| `profiles/` | User profile pictures |
| `documents/` | Problem attachments, reference files |
| `solutions/` | Solution files, code, attachments |

---

## 📝 Logs (`/logs`)
Application logging.

| Log | Purpose |
|-----|---------|
| `error.log` | PHP errors, exceptions, stack traces |
| `access.log` | HTTP request log |
| `payments.log` | Payment transaction log |

---

## ✅ Tests (`/tests`)
Automated testing suites.

| Folder | Purpose |
|--------|---------|
| `/Unit/` | Unit tests for classes (User, Problem, etc.) |
| `/Integration/` | API workflow tests (signup → login → post → solve) |

Root test files:
- `api-test.php` — Manual API testing script
- `debug-signup.php` — Debug signup issues
- `test-db.php` — Database connectivity test
- `test-setup.php` — Setup verification
- `verify-system.php` — System requirements check

---

## 📚 Documentation (`/docs`)
Project documentation and guides.

| Folder | Purpose |
|--------|---------|
| `/api/` | API endpoint docs (request/response examples) |
| `/deployment/` | Server setup, environment config, deployment steps |
| `/user-guides/` | User guides for Askers, Solvers, Admins |

Special files:
- `SIGNUP_LOGIN_FIX.md` — Bug fixes and authentication notes

---

## 📦 Dependencies

| Folder | Purpose |
|--------|---------|
| `/vendor/` | Composer (PHP) dependencies |
| `/node_modules/` | npm (Node.js) dependencies (Socket.io, etc.) |

---

## 🏗️ Architecture Summary

```
┌─────────────────────────────────────┐
│      FRONTEND (User Interface)       │
│  /frontend/pages, assets, includes  │
└────────────┬────────────────────────┘
             │ AJAX/REST
┌────────────▼────────────────────────┐
│   BACKEND (APIs & Business Logic)    │
│  /backend/api, classes, middleware  │
└────────────┬────────────────────────┘
             │ SQL
┌────────────▼────────────────────────┐
│      DATABASE (MySQL/PostgreSQL)    │
│     /database/schema, migrations    │
└─────────────────────────────────────┘

       REAL-TIME (Socket.io)
    /real-time/server.js (port 3000)
    Handles live chat & notifications
```

---

## 🔄 Key User Flows

### User Flow (Unified Model)
1. **Signup/Login** → `/auth/register.php` → `/backend/api/auth/register.php`
2. **Post Problem** → `/dashboard.php` → Post Problem Modal → `/backend/api/problems/create.php`
3. **Browse Problems** → `/browse-problems.php` → `/backend/api/problems/list.php`
4. **View Problem & Solutions** → `/problem-detail.php` → `/backend/api/problems/get.php`
5. **Add Comments** → Comment form → `/backend/api/comments/create.php`
6. **Like Comments** → Like button → `/backend/api/comment-likes/create.php`
7. **Like Problems** → Like button → `/backend/api/problems/like.php`
8. **Submit Solution** → `/backend/api/solutions/submit.php`
9. **Accept Solution & Pay** → Escrow via `/backend/api/payments/process.php`

### Admin Flow
1. **Login** → Admin auth check
2. **Moderation Dashboard** → `/admin/moderation.php` → `/backend/api/admin/moderation.php`
3. **Ban Users / Flag Content** → Admin endpoints

---

## 🔐 Security Layers

| Layer | Location | Protects Against |
|-------|----------|------------------|
| **Session Auth** | `/backend/middleware/auth-check.php` | Unauthorized access |
| **Role-Based Access** | `/backend/middleware/admin-check.php` | User escalation |
| **Rate Limiting** | `/backend/middleware/rate-limit.php` | Brute force, DOS |
| **CSRF Protection** | `/backend/functions/security.php` | Cross-site requests |
| **Input Validation** | `/backend/functions/validation.php` | SQL injection, XSS |
| **Content Moderation** | `/backend/classes/Moderation.php` | Abuse, spam |

---



## 📊 Database Tables (Overview)
Core tables managed by classes:
- `users` — User accounts, roles (user/admin), profile pictures, reputation
- `problems` — Problem posts with status, bounty, category, like/comment counts
- `solutions` — Solutions submitted to problems, likes tracking
- `comments` — Comments on problems (Reddit-style, nested/threaded support)
- `comment_likes` — Likes on individual comments
- `problem_likes` — Likes on problem posts
- `solution_likes` — Likes on solution posts
- `transactions` — Payment records, escrow holds, releases
- `messages` — In-app chat messages
- `reviews` — User ratings and feedback
- `categories` — Problem categories (Technology, Design, Education, etc.)
- `tags` — Problem tags for filtering
- `problem_tags` — Junction table for problem-tag relationships
- `conversations` — User-to-user chat conversations
- `bookmarks` — Saved/bookmarked problems
- `notifications` — User notifications
- `reports` — Content moderation reports

---

## 🔴 Reddit-Like Features (v2.0)

### Comments System
- **Problem Comments**: Users can comment on any problem post
- **Nested Comments**: Support for threaded/nested replies (via `parent_comment_id`)
- **Comment Likes**: Users can like individual comments
- **Endpoints**:
  - `POST /api/comments/create.php` — Post new comment
  - `GET /api/comments/list.php` — List comments for problem
  - `POST /api/comment-likes/create.php` — Like/unlike comment

### Like System
- **Problem Likes**: Toggle like on problem posts (with counter)
- **Comment Likes**: Toggle like on comments (with counter)
- **Solution Likes**: Toggle like on solutions (with counter)
- **Endpoints**:
  - `POST /api/problems/like.php` — Like/unlike problem
  - `POST /api/comment-likes/create.php` — Like/unlike comment
  - `POST /api/solution-likes/create.php` — Like/unlike solution

### Profile Features
- **Profile Pictures**: User avatar upload support (`profile_picture` field in users table)
- **User Stats**: Display problem count, solutions count, rating on profiles
- **User Pages**: `/user/profile.php`, `/user/settings.php`

### Problem Detail Page
- **Single Page View**: `/problem-detail.php?id={id}`
- **Components**:
  - Problem info (title, description, bounty, category, status)
  - Author info with profile picture
  - Like button with count
  - Comments section with all user comments
  - Solutions section with all submitted solutions
  - Real-time like count updates via AJAX

### Category & Organization
- **9 Categories**: Technology, Business, Design, Marketing, Legal, Personal, Education, Health, Other
- **Bounty System**: Optional payment amount for incentivizing solutions
- **Status Tracking**: open, resolved, cancelled

---



