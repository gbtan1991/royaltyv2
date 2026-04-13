
<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Claim.php';


// Check if transaction ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php?page=claim_view&error=Missing Transaction Id');
    exit;
}

$claimId = $_GET['id'];
$claimModel = new Claim($pdo);

if ($claimModel->deleteClaim($claimId)) {
    header('Location: index.php?page=claim_view&success=Transaction Deleted Successfully');
    exit;
} else {
    header('Location: index.php?page=claim_view&error=Failed to Delete Transaction');
    exit;
}
    



?>