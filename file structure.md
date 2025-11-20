# Probsolve - Project File Structure (2025)
probsolve/
├── about.md
├── assets/
├── backend/
│   ├── api/
│   │   ├── admin/
│   │   │   ├── moderation.php
│   │   │   └── users.php
│   │   ├── auth/
│   │   ├── messages/
│   │   ├── payments/
│   │   ├── problems/
│   │   ├── reviews/
│   │   ├── solutions/
│   │   ├── transactions/
│   │   └── users/
│   ├── classes/
│   │   ├── Message.php
│   │   ├── Moderation.php
│   │   ├── Problem.php
│   │   ├── Review.php
│   │   ├── Solution.php
│   │   ├── Transaction.php
│   │   └── User.php
│   ├── config/
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
│   ├── services/
│   │   ├── ai-service.php
│   │   └── email-service.php
├── composer.json
├── database/
│   ├── backups/
│   ├── migrations/
│   │   ├── 001_initial_tables.php
│   │   └── 002_add_new_features.php
│   ├── schema/
│   │   ├── indexes.sql
│   │   └── tables.sql
│   └── seeds/
│       ├── problems.sql
│       ├── solutions.sql
│       └── users.sql
├── docs/
│   ├── api/
│   ├── deployment/
│   └── user-guides/
├── file structure.md
├── frontend/
│   ├── assets/
│   │   ├── css/
│   │   │   ├── bootstrap/
│   │   │   ├── custom/
│   │   │   └── tailwind/
│   │   ├── icons/
│   │   ├── images/
│   │   └── js/
│   │       ├── bootstrap/
│   │       ├── custom/
│   │       └── socket.io/
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
│   │   ├── asker/
│   │   │   ├── dashboard.php
│   │   │   ├── my-problems.php
│   │   │   └── post-problem.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   ├── logout.php
│   │   │   └── register.php
│   │   ├── public/
│   │   │   ├── explore.php
│   │   │   ├── index.php
│   │   │   └── problem-gallery.php
│   │   └── solver/
│   │       ├── browse-problems.php
│   │       ├── dashboard.php
│   │       └── my-solutions.php
│   └── templates/
├── index.php
├── logs/
├── node_modules/
├── package.json
├── real-time/
│   ├── handlers/
│   └── server.js
├── scripts/
│   ├── backup-db.php
│   ├── seed-data.php
│   └── setup-db.php
├── tests/
│   ├── Integration/
│   └── Unit/
├── uploads/
│   ├── documents/
│   ├── profiles/
│   └── solutions/
├── vendor/