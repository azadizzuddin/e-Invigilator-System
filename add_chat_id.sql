-- Add Chat ID to Invigilator
-- Run this in your database management tool (phpMyAdmin, MySQL Workbench, etc.)

-- First, let's see what invigilators exist
SELECT id, userID, userName, contact, chat_id FROM invigilators;

-- If you want to add chat_id to a specific invigilator by name
UPDATE invigilators 
SET chat_id = '1871585935' 
WHERE userName LIKE '%letmekms%';

-- Or if you want to add it to a specific userID
-- UPDATE invigilators 
-- SET chat_id = '1871585935' 
-- WHERE userID = 'YOUR_USER_ID';

-- Verify the update
SELECT id, userID, userName, contact, chat_id FROM invigilators WHERE chat_id = '1871585935'; 