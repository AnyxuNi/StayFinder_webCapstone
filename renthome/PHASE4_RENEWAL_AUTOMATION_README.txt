STAYFINDER PHASE 4 - AUTOMATIC RENEWAL REMINDERS & EXPIRATION NOTICES

This phase adds daily renewal maintenance for approved listings.

WHAT IT DOES
- Sends a renewal reminder when a listing is within 7 days of expiry.
- Sends a stronger reminder when it is within 3 days.
- Sends an expiration notice after the validity period ends.
- Prevents duplicate notices for the same listing expiration cycle.
- Expired listings remain in the database; existing public queries already hide expired listings.
- Adds an Admin Dashboard button so an administrator can run the check manually.

AUTOMATIC SCHEDULING ON XAMPP / WINDOWS
The application cannot create a Windows Task Scheduler job by itself. Set the task once on the development PC:

1. Open Windows Task Scheduler.
2. Choose Create Basic Task.
3. Name it: StayFinder Renewal Automation.
4. Trigger: Daily. A convenient time is 12:05 AM.
5. Action: Start a program.
6. Program/script:
   C:\xampp\php\php.exe
7. Add arguments:
   C:\xampp\htdocs\renthome\tasks\renewal_automation.php
8. Start in:
   C:\xampp\htdocs\renthome
9. Finish and test with Run.

MANUAL TEST
From Command Prompt:

C:\xampp\php\php.exe C:\xampp\htdocs\renthome\tasks\renewal_automation.php

You should see counts for checked listings, reminders, expired notices, skipped notices, and errors.

DATABASE
The application automatically creates renewal_notice_log if it is missing. A manual migration is also included at:

database/phase4_renewal_automation_migration.sql

SCOPE
This automation only manages StayFinder's listing-validity and renewal-service workflow. It does not process rent, deposits, utilities, reservations, or other renter-to-owner financial transactions.
