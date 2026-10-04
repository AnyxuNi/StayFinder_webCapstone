<?php
declare(strict_types=1);

require_once '../config/database.php';
require_once '../config/app.php';
require_once '../includes/auth.php';
require_once '../includes/csrf.php';

require_role('owner');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    exit('Invalid listing ID.');
}

$stmt = $pdo->prepare(
    'SELECT * FROM properties WHERE id = ? AND owner_id = ? LIMIT 1'
);
$stmt->execute([$id, $_SESSION['user_id']]);
$property = $stmt->fetch();

if (!$property) {
    http_response_code(404);
    exit('Listing not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? null)) {
        exit('Invalid form request.');
    }

    if ($property['status'] !== 'pending') {
        exit('This listing cannot be submitted again.');
    }

    $stmt = $pdo->prepare(
        'UPDATE properties SET status = \'pending\' WHERE id = ? AND owner_id = ?'
    );
    $stmt->execute([$id, $_SESSION['user_id']]);

    header('Location: dashboard.php?submitted=1');
    exit;
}

$imgStmt = $pdo->prepare(
    'SELECT image_path FROM property_images WHERE property_id = ? ORDER BY id'
);
$imgStmt->execute([$id]);
$images = $imgStmt->fetchAll();

$pageTitle = 'Review Listing - StayFinder';
require_once '../includes/header.php';
$ownerStep = 5;
require_once 'flow.php';
?>

<div class="owner-form-shell">
<div class="owner-form-header">
    <h1>Review Your Listing</h1>
    <p>Check everything before submitting your property to the administrator.</p>
</div>
<div class="owner-form-card">

    <div class="owner-review-summary">
        <div>
            <?php if (!empty($images)): ?>
                <img src="<?= base_url($images[0]['image_path']) ?>" alt="Property image" class="owner-review-photo">
            <?php else: ?>
                <img src="<?= base_url('assets/img/placeholder.svg') ?>" alt="No property image" class="owner-review-photo">
            <?php endif; ?>
            <?php if (count($images) > 1): ?>
                <div class="image-grid" style="margin-top:10px;">
                    <?php foreach (array_slice($images, 1) as $image): ?>
                        <img src="<?= base_url($image['image_path']) ?>" alt="Property image" class="property-image">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="owner-review-details">
            <h2><?= htmlspecialchars($property['title'], ENT_QUOTES, 'UTF-8') ?></h2>
            <div class="review-price">₱<?= number_format((float)$property['price'], 2) ?>/month</div>
            <div class="owner-review-row"><strong>Location</strong><span><?= htmlspecialchars($property['location'], ENT_QUOTES, 'UTF-8') ?></span></div>
            <div class="owner-review-row"><strong>Property Type</strong><span><?= htmlspecialchars(ucwords(str_replace('_', ' ', $property['property_type'])), ENT_QUOTES, 'UTF-8') ?></span></div>
            <div class="owner-review-row"><strong>Capacity</strong><span><?= (int)$property['capacity'] ?> person(s)</span></div>
            <div class="owner-review-row"><strong>Gender</strong><span><?= htmlspecialchars(ucwords(str_replace('_', ' ', $property['gender_preference'])), ENT_QUOTES, 'UTF-8') ?></span></div>
            <h3 style="margin:18px 0 7px;">Description and Other Information</h3>
            <div class="owner-description"><?= nl2br(htmlspecialchars($property['description'] ?? '', ENT_QUOTES, 'UTF-8')) ?></div>
        </div>
    </div>

    <div class="owner-state warning"><div class="owner-state-icon">◷</div><div><h3>Ready for Administrator Review</h3><p>Your listing will remain pending until an administrator approves it.</p></div></div>

    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
        <div class="owner-actions"><button type="submit">Submit Listing →</button><a class="secondary-button" href="create-listing.php">Back & Edit</a></div>
    </form>
</div>
</div>

<?php require_once '../includes/footer.php'; ?>
