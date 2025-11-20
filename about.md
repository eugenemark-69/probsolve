# Probsolve - The Human Solution Marketplace

## Project Overview

**Tagline:** *Your Problems, Our Solutions. For a Price.*

**Vision:** Create a global, accessible, and human-centric platform where any problem, big or small, can be outsourced to a crowd of creative and knowledgeable problem-solvers.

**Unique Selling Proposition:** Hybrid of Fiverr, Reddit's r/Relationship_Advice, and micropayment-powered Q&A site focusing on impulse, empathy, drama, and creativity.

## Core User Roles

### 1. Problem Poster ("Asker")
- **Dramatic Daisy** (18-25): Social scripting needs, low budget (₱15-₱50)
- **Pragmatic Paul** (25-45): Practical life help, medium budget (₱50-₱200)  
- **Stressed-Out Student** (16-22): Homework help, quick advice

### 2. Solution Provider ("Solver")
- **Creative Wordsmith**: Writing, scripting, communication
- **Life-Hacker**: Personal finance, bureaucracy, DIY
- **Niche Expert**: Tutoring, informal professional advice

### 3. Platform Moderator/Admin
- Content moderation
- Payment management
- User support

## Core Features

### For Problem Posters (Askers)

#### User Onboarding
- Sign-up with email, Google, or Apple
- Minimal profile: Username, Bio, Rating
- Mandatory payment method verification
- Age verification for category restrictions

#### Problem Posting System
```
Problem Creation Form:
├── Category Selection (Writing, Social, Life Help, etc.)
├── Title Field
├── Detailed Description (Rich text editor)
├── Budget Setting (Fixed price or range)
├── Delivery Format Specification
├── Delivery Deadline (1hr, 24hr, 3 days)
├── Anonymity Toggle
└── Visibility Settings (Public/Private)
```

#### Solution Management
- **Solution Inbox**: Dedicated area for all submissions
- **Live Chat**: Secure in-app messaging with Solvers
- **Selection & Payment**: One-click solution acceptance
- **"None Good Enough" Refund**: Fair use refund policy

#### Post-Transaction Features
- Rating & Review system (1-5 stars)
- Tip functionality for exceptional work
- "Favorite Solver" list for future private jobs

### For Solution Providers (Solvers)

#### Solver Onboarding
- **Skill Tagging**: Select areas of expertise
- **Portfolio/Examples**: Optional but recommended
- **Solver Quiz**: Basic competency tests for sensitive categories
- **Credential Verification** for expert badges

#### Work Finding System
- **Problem Feed**: Filterable by category, budget, deadline
- **Smart Notifications**: Push/email for relevant problems
- **Bidding System**: Submit price pitches for range-budget problems

#### Solution Submission
- Rich text editor with file upload support
- "Submit as Draft" feature for preliminary feedback
- In-app chat for clarification before final submission

#### Earnings & Reputation
- **Wallet System**: Track earnings within platform
- **Withdrawal Options**: Bank, e-wallet, crypto (region-dependent)
- **Solver Dashboard**: Analytics on performance metrics
- **Public Profile**: Success rate, reviews, Problem Solver Rank

## Advanced & Viral Features

### 1. Problem Gallery / Public Feed
- Curated feed of interesting/anonymous problems
- Primary driver of viral content ("Explore" page)
- User permission-based display

### 2. CrowdVote™ System
- Community voting on multiple solutions
- Prize distribution: 1st(70%), 2nd(20%), 3rd(10%)
- Enhanced engagement through competition

### 3. Probsolve AI Integration
- Fallback AI solution if no human response within 1 hour
- Additional ₱10 charge for instant AI-generated solution
- Guaranteed response system

### 4. Urgent Delivery System
- "Crisis Mode": 50% premium for top placement
- Reduced delivery times
- Priority solver notifications

### 5. Solver Power-Ups
- Profile highlighting boosts
- "Top of Feed" placement purchases
- Paid visibility enhancements

### 6. Solution Templates
- Pre-packaged solutions for common problems
- Passive income stream for successful Solvers
- Standardized pricing for template use

## Payment & Transaction System

### Secure Escrow Model

**Step-by-Step Flow:**
1. **Asker posts problem** with ₱100 bounty
2. **Payment authorized**: ₱110 charged (₱100 + ₱10 fee) → Held in escrow
3. **Solvers submit solutions**
4. **Asker selects winning solution**
5. **Funds released**:
   - Solver receives ₱90 (₱100 - 10% commission)
   - Platform keeps ₱10 fee
6. **Solver withdraws** earnings to external account

**Refund Protection:**
- "None Good Enough" refund option for Askers
- Monthly limits to prevent abuse
- Full escrow release back to Asker

## Quality Assurance System

### Solver Verification Layers

**Reputation Building:**
- Public rating & review system
- Success rate percentage display
- Problem Solver Rank badges (Newbie → Pro → Expert → Guru)

**Skill Validation:**
- Self-tagged skill categories
- Category-specific competency quizzes
- Portfolio and example submissions
- "Verified Expert" badge program with credential verification

**Quality Control:**
- "Draft & Chat" system for work validation
- Economic disincentive for poor quality (no payment)
- Automated quality flagging for high rejection rates
- Plagiarism and spam reporting system

## Monetization Strategy

### Revenue Streams

1. **Platform Commission**: 10-15% on successful transactions
2. **Probsolve AI Fees**: 100% of AI solution charges (after API costs)
3. **Premium Subscriptions**:
   - **Probsolve Plus** (Askers): Monthly fee for enhanced refunds, reduced fees, expert access
   - **Solver Pro** (Solvers): Monthly fee for early problem access, advanced analytics, power-ups
4. **Boosted Problems**: Pay-to-promote problem visibility
5. **Verification Fees**: One-time fee for "Verified Expert" badges
6. **Withdrawal Fees**: Small flat fee on cash-outs to external accounts

## Safety & Moderation System

### Multi-Layer Protection

**Pre-Moderation:**
- AI-powered content scanning for illegal/harmful keywords
- Automated category restrictions for minors
- Real-time content filtering

**In-Platform Safety:**
- Strict no-contact policy (all communication in-app)
- Automated detection of external contact information
- Robust reporting and flagging system

**Post-Moderation & Enforcement:**
- 24/7 human moderation team
- Three-strike policy for violations
- Payment hold during dispute resolution
- Permanent banning for serious offenses

**Legal Protection:**
- Mandatory disclaimers for non-professional advice
- Comprehensive Terms of Service
- Clear privacy policy and data handling
- Age verification systems

## Technical Architecture

### Technology Stack

**Frontend:**
- Plain HTML + CSS + JavaScript
   php
   Bootstrap
   Tailwind CSS




**Backend:**
- php/javascript most of the bcakend will be php
- MySQL database (XAMPP compatible)
- Redis for caching and sessions

**Real-time Features:**
- Socket.io for live chat and notifications
- Real-time problem feed updates

**Payments & Integration:**
- since this is prototype its ganna be a simulation
- OpenAI API for AI solutions


### MySQL Database Schema (XAMPP Compatible)

**Core Tables:**
```sql
-- Users table
users (id, username, email, password_hash, role, rating, created_at, is_verified)

-- Problems table  
problems (id, user_id, category, title, description, budget, deadline, status, is_anonymous)

-- Solutions table
solutions (id, problem_id, solver_id, content, status, submitted_at, is_draft)

-- Transactions table
transactions (id, problem_id, solver_id, amount, platform_fee, status, completed_at)

-- Messages table
messages (id, problem_id, from_user, to_user, content, sent_at)

-- Reviews table
reviews (id, transaction_id, rating, comment, created_at)
```

## Implementation Phases

### Phase 1: MVP (3-4 months)
- Core problem/solution posting
- Basic escrow payment system
- Essential moderation tools
- Single market launch (Philippines)

### Phase 2: Growth (6-12 months)
- Viral features (Problem Gallery, CrowdVote)
- Subscription models
- Probsolve AI integration
- Market expansion

### Phase 3: Scale (18+ months)
- Native mobile applications
- Verified Expert program
- Advanced analytics
- Global localization

## Success Metrics

### Key Performance Indicators
- Transaction completion rate
- User retention (both Askers and Solvers)
- Average solution quality rating
- Platform revenue growth
- Viral content sharing rate

This comprehensive specification provides a complete roadmap for building Probsolve as a secure, engaging, and profitable marketplace for human problem-solving.



