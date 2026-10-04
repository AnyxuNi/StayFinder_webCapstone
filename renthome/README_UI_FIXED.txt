StayFinder UI Fixed

This build keeps the Phase 3 functionality and Cabanatuan barangay filters, while refreshing the public seeker, owner/manager, and administrator interfaces to match the supplied wireframes more closely.

IMPORTANT INSTALLATION
1. Stop Apache if you are currently editing the folder.
2. Rename your current C:\xampp\htdocs\renthome folder to renthome_backup.
3. Extract this ZIP directly into C:\xampp\htdocs\. The final folder must be C:\xampp\htdocs\renthome\ (not renthome\renthome).
4. Start Apache and MySQL in XAMPP.
5. Open http://localhost/renthome/
6. Hard-refresh the browser with Ctrl+F5.

The stylesheet is loaded with a version query so the refreshed interface is less likely to be hidden by an old browser cache.

Database is not replaced by this UI-only update. Keep your existing renthome_db database.

Latest UI/Workflow Update:
- Added required Mayor's Permit upload after owner Terms & Policies.
- Added owner dashboard permit status card.
- Improved owner availability and delete button contrast.
- Added admin listing deletion controls.
- Redesigned admin dashboard and listing approval/review interface.
- Added permit verification to the admin approval process.
