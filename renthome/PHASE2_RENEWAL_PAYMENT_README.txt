STAYFINDER - PHASE 2: RENEWAL + PAYMENT SUBMISSION

WHAT THIS PHASE ADDS
- A renewal_payments table for StayFinder listing renewal/service-fee payments.
- Renewal fee is currently configured as PHP 20.00 in includes/renewal.php.
- Owner renewal page: owner/renew.php
- Secure payment-proof submission: owner/submit-renewal.php
- Payment methods: GCash and Bank Transfer.
- Payment reference number and JPG/PNG/PDF proof upload (maximum 5 MB).
- Duplicate pending renewal submissions are blocked for the same listing.
- Owner dashboard shows a renewal action when a listing has 30 days or less remaining.
- A pending verification badge is shown after payment proof is submitted.

IMPORTANT SCOPE NOTE
This phase records payments made to StayFinder for its renewal/service fee only.
It does NOT process rent, deposits, utilities, or renter-to-owner payments.

INSTALLATION
1. BACK UP your current C:\xampp\htdocs\renthome folder and renthome_db first.
2. Copy this ZIP's files into C:\xampp\htdocs\renthome\ and replace the existing project files.
3. In phpMyAdmin, select renthome_db.
4. Import/run database/renewal_phase2_migration.sql.
5. Make sure C:\xampp\htdocs\renthome\uploads\payment_proofs exists and is writable by Apache.
6. Test as an owner using an approved listing:
   http://localhost/renthome/owner/dashboard.php

TEST FLOW
1. Use an approved listing with an expiration date within 30 days, or temporarily adjust its listing_expires_at in phpMyAdmin for testing.
2. Click Renew Listing.
3. Select GCash or Bank Transfer.
4. Enter a test reference number.
5. Upload a JPG, PNG, or PDF proof (<= 5 MB).
6. Submit.
7. Confirm the dashboard shows Payment Pending Verification.
8. Confirm a renewal payment record appears in renewal_payments with status=pending.

WHAT DOES NOT HAPPEN YET
- The listing is NOT renewed automatically after submission.
- Admin verification UI is not included yet.
- No real GCash/bank gateway is connected yet.
- 7-day automatic notifications and scheduled expiration processing are Phase 3/4.

The intended next phase is ADMIN PAYMENT VERIFICATION. After an admin verifies a
payment, the system will extend the listing by 3 months and record the verification.
