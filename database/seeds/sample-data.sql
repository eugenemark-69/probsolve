-- Probsolve Expanded Sample Data
-- Run this after creating the database schema

USE probsolve;

-- Sample users (password: 12345 in plain text for testing)
INSERT IGNORE INTO users (username, email, password_hash, role, is_verified, bio, reputation_points, created_at) VALUES 
('eugene', 'eugene@probsolve.com', '12345', 'user', 1, 'Senior software engineer with 8 years of experience. Specialized in backend systems and database optimization.', 1250, NOW() - INTERVAL 180 DAY),
('teejay', 'teejay@probsolve.com', '12345', 'user', 1, 'UI/UX designer and frontend developer. Love creating beautiful, functional interfaces.', 890, NOW() - INTERVAL 150 DAY),
('joey', 'joey@probsolve.com', '12345', 'user', 1, 'College student studying computer science. Always looking for help with projects and... other things.', 420, NOW() - INTERVAL 120 DAY),
('nicole', 'nicole@probsolve.com', '12345', 'user', 1, 'Psychology major with a passion for helping people understand relationships and emotions.', 680, NOW() - INTERVAL 100 DAY),
('alex', 'alex@probsolve.com', '12345', 'user', 1, 'Professional writer and editor. Can help with any writing project from academic papers to creative writing.', 950, NOW() - INTERVAL 130 DAY),
('mike', 'mike@probsolve.com', '12345', 'user', 1, 'Financial advisor and investment strategist. Happy to help with money management questions.', 1100, NOW() - INTERVAL 160 DAY),
('sarah', 'sarah@probsolve.com', '12345', 'user', 1, 'Chef and nutritionist. Love cooking and helping people eat healthier.', 720, NOW() - INTERVAL 110 DAY),
('david', 'david@probsolve.com', '12345', 'user', 1, 'Mechanical engineer and DIY enthusiast. Good at fixing things and solving practical problems.', 830, NOW() - INTERVAL 140 DAY);

-- Update user stats to reflect activity
UPDATE users SET 
  problems_posted = 25,
  solutions_submitted = 18,
  solutions_accepted = 12,
  last_login = NOW() - INTERVAL 1 DAY
WHERE username = 'joey';

UPDATE users SET 
  problems_posted = 8,
  solutions_submitted = 32,
  solutions_accepted = 28,
  last_login = NOW() - INTERVAL 2 DAY
WHERE username = 'eugene';

UPDATE users SET 
  problems_posted = 5,
  solutions_submitted = 45,
  solutions_accepted = 40,
  last_login = NOW() - INTERVAL 3 DAY
WHERE username = 'teejay';

UPDATE users SET 
  problems_posted = 12,
  solutions_submitted = 25,
  solutions_accepted = 22,
  last_login = NOW() - INTERVAL 1 DAY
WHERE username = 'nicole';

-- Sample problems with diverse topics including Joey's love advice request
INSERT IGNORE INTO problems (user_id, category_id, title, description, bounty, status, views_count, likes_count, comments_count, solutions_count, created_at) VALUES
-- Technology problems (existing)
(3, 1, 'Build a PHP REST API', 'Need to create a RESTful API for an e-commerce platform with authentication and role-based access control', 500.00, 'open', 45, 3, 2, 1, NOW() - INTERVAL 5 DAY),
(3, 1, 'Debug JavaScript async/await issues', 'My async functions are not working properly with promises. Getting unexpected behavior with error handling', 300.00, 'resolved', 78, 5, 4, 3, NOW() - INTERVAL 4 DAY),
(3, 3, 'Design a mobile app UI mockup', 'Need UI/UX design for a fitness tracking mobile application. Should include dashboard, profile, and workout pages', 1500.00, 'open', 120, 8, 5, 2, NOW() - INTERVAL 3 DAY),

-- Joey's personal/love problems (NEW)
(3, 6, 'How to tell someone you like them?', 'There''s this amazing person in my life (let''s call her Nicole) and I can''t seem to find the right words or timing to express my feelings. We talk regularly and get along well, but I''m terrified of ruining our friendship.', 100.00, 'open', 210, 15, 12, 6, NOW() - INTERVAL 2 DAY),
(3, 6, 'Signs someone might be interested in you?', 'How can you tell if someone sees you as more than just a friend? Are there specific behaviors or signals I should be looking for?', 75.00, 'open', 95, 7, 8, 4, NOW() - INTERVAL 1 DAY),
(3, 6, 'First date ideas for someone shy', 'Need creative but comfortable first date suggestions that won''t be too overwhelming for either of us.', 50.00, 'open', 63, 4, 5, 2, NOW() - INTERVAL 3 DAY),

-- Life advice problems from various users
(4, 6, 'Dealing with anxiety in social situations', 'I get very anxious when meeting new people or in group settings. Looking for practical strategies to manage this.', 80.00, 'open', 88, 6, 7, 3, NOW() - INTERVAL 4 DAY),
(5, 6, 'How to negotiate a salary raise?', 'I''ve been at my company for 2 years and taken on additional responsibilities. What''s the best approach to ask for a raise?', 200.00, 'resolved', 145, 9, 11, 5, NOW() - INTERVAL 10 DAY),
(6, 9, 'Best way to save for a house?', 'As a first-time home buyer, what saving strategies and financial planning should I consider?', 150.00, 'open', 112, 7, 6, 2, NOW() - INTERVAL 7 DAY),
(7, 8, 'Healthy meal prep for busy people', 'Need easy, nutritious recipes that can be prepared in advance for someone with a hectic schedule.', 60.00, 'open', 76, 5, 4, 1, NOW() - INTERVAL 5 DAY),
(8, 9, 'Fixing leaky bathroom faucet', 'My bathroom faucet keeps dripping even after I tightened everything. Not sure what to try next.', 40.00, 'resolved', 54, 2, 3, 2, NOW() - INTERVAL 8 DAY),

-- More technology problems
(3, 1, 'Optimize database queries', 'MySQL queries are running slow. Need optimization for a database with 5 million records. Currently takes 30 seconds', 400.00, 'open', 67, 4, 3, 1, NOW() - INTERVAL 6 DAY),
(3, 7, 'Solve complex calculus problems', 'Need help solving 10 multivariable calculus problems for an exam. Include step-by-step solutions', 200.00, 'resolved', 89, 3, 2, 1, NOW() - INTERVAL 7 DAY),

-- Education problems
(3, 7, 'Write a research paper on machine learning', 'Need a 5000-word research paper on machine learning applications in healthcare with proper citations', 800.00, 'open', 34, 1, 1, 0, NOW() - INTERVAL 8 DAY),
(4, 7, 'Study techniques for memorization', 'What are the most effective study methods for memorizing large amounts of information?', 30.00, 'open', 56, 3, 4, 2, NOW() - INTERVAL 6 DAY);

-- Sample solutions for some problems (including love advice for Joey)
INSERT IGNORE INTO solutions (problem_id, solver_id, content, is_accepted, likes_count, submitted_at) VALUES
-- Solutions for Joey's love problems
(4, 4, 'Joey, as someone who studies relationships, I can tell you that honesty and timing are key. Choose a comfortable, private setting and be genuine about your feelings. Remember that even if the feelings aren''t mutual, a true friendship can withstand honesty. Start by saying something like, "I really value our friendship, and I''ve started developing deeper feelings for you."', 1, 8, NOW() - INTERVAL 1 DAY),
(4, 5, 'Write her a heartfelt letter! This gives you time to choose your words carefully and her time to process without pressure. It''s romantic and thoughtful.', 0, 5, NOW() - INTERVAL 1 DAY),
(5, 6, 'Look for these signs: she initiates conversations, remembers small details about you, makes time for you, physical touch (even small ones), and most importantly - she seems genuinely happy around you.', 0, 6, NOW() - INTERVAL 1 DAY),
(6, 7, 'For a shy person, I''d recommend: 1) Coffee walk in a park (less intense than sitting across a table), 2) Museum visit (gives you things to talk about), 3) Cooking something simple together at home.', 1, 4, NOW() - INTERVAL 2 DAY),

-- Solutions for other problems
(2, 1, 'The issue is likely with your error handling in async functions. Make sure you''re using try-catch blocks properly and handling promise rejections. Here''s an example of the correct pattern...', 1, 3, NOW() - INTERVAL 2 DAY),
(8, 6, 'For salary negotiation: 1) Research industry standards, 2) Document your accomplishments, 3) Schedule a formal meeting, 4) Be specific about your request, 5) Practice your talking points.', 1, 7, NOW() - INTERVAL 5 DAY),
(10, 8, 'For a leaky faucet, the issue is usually the washer or O-ring. Turn off water supply, disassemble the handle, and replace the worn parts. Home Depot has universal repair kits for under $20.', 1, 2, NOW() - INTERVAL 4 DAY);

-- Update problems with selected solutions
UPDATE problems SET selected_solution_id = 1 WHERE id = 4;
UPDATE problems SET selected_solution_id = 6 WHERE id = 2;
UPDATE problems SET selected_solution_id = 7 WHERE id = 8;
UPDATE problems SET selected_solution_id = 8 WHERE id = 10;

-- Sample conversations (including Joey and Nicole)
INSERT IGNORE INTO conversations (user1_id, user2_id, problem_id, last_message_at, created_at) VALUES
(3, 4, 4, NOW() - INTERVAL 2 HOUR, NOW() - INTERVAL 3 DAY),
(1, 3, 2, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 5 DAY),
(2, 3, 3, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 4 DAY),
(3, 5, 4, NOW() - INTERVAL 5 HOUR, NOW() - INTERVAL 2 DAY);

-- Sample messages between Joey and Nicole
INSERT IGNORE INTO messages (conversation_id, sender_id, content, is_read, sent_at) VALUES
(1, 3, 'Hey Nicole, thanks so much for your advice on my problem. It was really thoughtful.', 1, NOW() - INTERVAL 3 DAY),
(1, 4, 'Of course, Joey! I could tell it was really important to you. How are you feeling about everything?', 1, NOW() - INTERVAL 3 DAY + INTERVAL 10 MINUTE),
(1, 3, 'Still pretty nervous tbh. What if I mess everything up?', 1, NOW() - INTERVAL 3 DAY + INTERVAL 25 MINUTE),
(1, 4, 'That''s completely normal! Remember that being vulnerable takes courage. The right person will appreciate your honesty.', 1, NOW() - INTERVAL 3 DAY + INTERVAL 40 MINUTE),
(1, 3, 'Would you maybe want to get coffee sometime and talk more about this? As friends of course', 1, NOW() - INTERVAL 2 DAY),
(1, 4, 'I''d like that :) How about Thursday afternoon?', 1, NOW() - INTERVAL 2 DAY + INTERVAL 5 MINUTE),
(1, 3, 'Thursday works great! 2pm at Central Perk?', 1, NOW() - INTERVAL 2 DAY + INTERVAL 15 MINUTE),
(1, 4, 'Perfect! See you then 😊', 1, NOW() - INTERVAL 2 DAY + INTERVAL 20 MINUTE),
(1, 3, 'Hey, just confirming we''re still on for today?', 1, NOW() - INTERVAL 2 HOUR),
(1, 4, 'Yes! Looking forward to it. Running 5 minutes late but will be there!', 1, NOW() - INTERVAL 1 HOUR);

-- Sample reviews
INSERT IGNORE INTO reviews (transaction_id, reviewer_id, reviewed_user_id, rating, comment, created_at) VALUES
(1, 3, 4, 5, 'Nicole gave amazing advice that was both professional and compassionate. Really helped me gain confidence!', NOW() - INTERVAL 1 DAY),
(2, 3, 1, 5, 'Eugene fixed my JavaScript issues quickly and explained everything clearly. Highly recommended!', NOW() - INTERVAL 2 DAY);

-- Sample notifications
INSERT IGNORE INTO notifications (user_id, type, related_id, title, content, is_read, created_at) VALUES
(3, 'new_solution', 1, 'New solution to your problem', 'Nicole posted a solution to "How to tell someone you like them?"', 1, NOW() - INTERVAL 1 DAY),
(3, 'message', 1, 'New message from Nicole', 'Nicole sent you a new message', 1, NOW() - INTERVAL 2 HOUR),
(4, 'solution_accepted', 1, 'Your solution was accepted!', 'Joey accepted your solution to "How to tell someone you like them?"', 0, NOW() - INTERVAL 12 HOUR);

-- Update user ratings based on reviews
UPDATE users SET rating = 5.0 WHERE username = 'nicole';
UPDATE users SET rating = 4.8 WHERE username = 'eugene';
UPDATE users SET rating = 4.6 WHERE username = 'teejay';

-- Add some problem likes
INSERT IGNORE INTO problem_likes (problem_id, user_id, created_at) VALUES
(4, 4, NOW() - INTERVAL 1 DAY),
(4, 5, NOW() - INTERVAL 1 DAY),
(4, 6, NOW() - INTERVAL 2 DAY),
(1, 1, NOW() - INTERVAL 3 DAY);

-- Add some bookmarks
INSERT IGNORE INTO bookmarks (user_id, problem_id, created_at) VALUES
(3, 8, NOW() - INTERVAL 2 DAY), -- Joey bookmarked salary negotiation advice
(4, 6, NOW() - INTERVAL 1 DAY); -- Nicole bookmarked first date ideas