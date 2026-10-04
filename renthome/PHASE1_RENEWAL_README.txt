STAYFINDER - PHASE 1: THREE-MONTH LISTING VALIDITY
===================================================

This ZIP contains Phase 1 only. It adds the foundation for the three-month
listing validity/renewal system without adding payment processing yet.

WHAT WAS ADDED
---------------
1. Database fields on properties:
   - listing_expires_at
   - last_renewed_at
   - renewal_count
2. Existing approved listings receive an initial expiration date of
   created_at + 3 months when the migration is run.
3. New listings receive a 3-month expiration date automatically when the
   administrator approves them.
4. Owner Dashboard shows the listing validity date and days remaining.
5. Public listing queries no longer treat an expired listing as active.
   The record is retained in the database; it is NOT permanently deleted.
6. includes/renewal.php contains the shared three-month date rules that later
   phases will use for renewal and notification automation.

HOW TO INSTALL
--------------
1. Back up your renthome_db database first.
2. Make sure XAMPP MySQL/MariaDB is running.
3. Open phpMyAdmin and select renthome_db.
4. Open database/renewal_phase1_migration.sql and run it.
5. Copy/replace the files from this ZIP into:
      C:\xampp\htdocs\renthome\
6. Open:
      http://localhost/renthome/owner/dashboard.php

IMPORTANT
---------
- Phase 1 does NOT process GCash, bank transfers, or renewal payments yet.
- Phase 1 does NOT send the 7-day reminder yet.
- Phase 1 does NOT run a scheduled expiration job yet.
- Those are intentionally reserved for the next phases.

TESTING PHASE 1
---------------
A) Create/submit a listing and have an admin approve it.
B) The approved listing should receive an expiration date exactly 3 months
   from approval.
C) The owner dashboard should show the expiration date and days remaining.
D) Existing approved listings get an expiration date from their created_at
   value when the migration is first run.

If you want to test expiration immediately, temporarily change a listing's
listing_expires_at in phpMyAdmin to a date/time in the past. The listing should
no longer be treated as active by public browsing/detail/inquiry checks.

NEXT PHASE
----------
Phase 2 will add the owner renewal screen and payment-submission records,
while keeping payment verification under the administrator until the
payment gateway/webhook phase is ready.
