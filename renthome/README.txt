StayFinder - Phase 3
===================

PHASE 3 FOCUS
- Browse filters are ONLY: Price, Location, Property Type, Capacity, and Gender.
- Location scope is Cabanatuan City, Nueva Ecija, with a barangay dropdown in the seeker filter and owner listing form.
- Property Type choices: Boarding House, Apartment, Dormitory.
- Electricity and water bill information, Wi-Fi, curfew, transportation, house rules, and other details are written in the listing Description. They are NOT filters.
- Property photo gallery.
- Saved/favorite listings for rent seekers.
- Rent seeker inquiry history and owner replies.
- Owner inquiry inbox.
- Basic notifications for new inquiries and replies.

SETUP
1. Replace the existing C:\xampp\htdocs\renthome\ folder with this project. The ZIP contains a top-level renthome folder.
2. Start Apache and MySQL in XAMPP.
3. Open http://localhost/phpmyadmin/
4. If you already installed Phase 2, select renthome_db and import:
   database/phase3_migration.sql
5. If starting from a clean database, import:
   database/renthome_db.sql
   then import:
   database/phase2_migration.sql
   then import:
   database/phase3_migration.sql
6. Open http://localhost/renthome/

TEST FLOW
A. Register a rent seeker and browse approved listings.
B. Test all five filters.
C. Open a property and check the photo gallery and description.
D. Save a listing, then open Saved Listings.
E. Send an inquiry.
F. Log in as owner and open Inquiries. Reply to the inquiry.
G. Log back in as rent seeker and check My Inquiries and Notifications.

IMPORTANT
- The database still contains older electricity/wifi/curfew/transportation columns for Phase 1/2 compatibility. Phase 3 no longer collects or filters those values separately; the listing description is the single place for those details.
- The system does not implement an online payment gateway in Phase 3.
- Keep uploads/properties/.htaccess in place to block script execution in the upload directory.


CLEAN BARANGAY FILTER BUILD
- The Seeker Browse page uses a single hard-coded barangay source: includes/cabanatuan_barangays.php.
- The Owner Create Listing page uses the same source.
- The Location filter default is “All Barangays”; it does not default to “Cabanatuan City, Nueva Ecija.”
- Search filters are ONLY Price, Barangay/Location, Property Type, Capacity, and Gender.
- Electricity/water bills, Wi-Fi, curfew, transportation, house rules, and other details belong in the listing description and are not filters.
- If your browser still shows the old dropdown, completely remove the old C:\xampp\htdocs\renthome folder before extracting this ZIP, then open http://localhost/renthome/browse.php and press Ctrl+F5.


Availability / deletion update:
- Owners can mark an approved listing Available (green) or Unavailable (red).
- Owners can permanently delete their own listings with a CSRF-protected POST action and confirmation.
- Unavailable listings remain visible with a red status badge, while the homepage/featured area shows available listings.
- Rent seekers cannot send a new inquiry for an unavailable listing.
- If the database was created before this update, run database/availability_migration.sql once.

LATEST UPDATE — OWNER MAYOR'S PERMIT + ADMIN UI

1. Run database/mayor_permit_migration.sql once in phpMyAdmin after selecting renthome_db.
2. Owner flow is now: Register -> Terms & Policies -> Mayor's Permit -> Create Listing -> Submit -> Admin Review -> Approved -> Public Listing.
3. An owner cannot open/create a listing until the Mayor's Permit has been uploaded.
4. Admin approval is blocked when the owner's Mayor's Permit is missing.
5. Owner dashboard availability buttons now use high-contrast green/red text-on-background styling. Delete Listing is also a high-contrast red button.
6. Admin Listings now has a Delete button. Admin Listing Review also has a permanent Delete Listing action.
7. Admin Dashboard and Listing Review were reorganized into a cleaner approval-focused layout.
8. Mayor's Permit files are protected from direct web access and are served only through owner/admin authenticated pages.
