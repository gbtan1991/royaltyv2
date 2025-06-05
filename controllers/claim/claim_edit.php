<?php 

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Claim.php';
require_once __DIR__ . '/../../config/session.php';

if(!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: claim_view.php?error=Missing claim ID');
    exit;
}

$claimModel = new Claim($pdo);
$claim = $claimModel->getClaimById($_GET['id']);

if(!$claim) {
    header('Location: claim_view.php?error=Claim not found');
    exit;

}

// Load the edit form
require_once __DIR__ . '/../../views/claim/edit_claim.php';
