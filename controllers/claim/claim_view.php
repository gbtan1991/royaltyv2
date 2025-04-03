<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Claim.php';


if(!isset($_SESSION['admin'])) {
    header('Location: ../../public/login.php');
    exit();
}

$claimModel = new Claim($pdo);
$claims = $claimModel->getAllClaims();

require_once __DIR__ . '/../../views/claim/claim_view.php';

