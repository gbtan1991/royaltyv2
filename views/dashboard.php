<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../models/Claim.php';
require_once __DIR__ . '/../helpers/format.php';
require_once __DIR__ . '/../helpers/randomizer.php';

if(!isset($_SESSION['admin_id'])){
    header('Location: ../public/login.php');
    exit();
}


// Page Title
$pageTitle = 'Dashboard';
$currentPage = 'dashboard';


// Fetching Models
$customerModel = new Customer($pdo);
$transactionModel = new transaction($pdo);
$claimModel = new Claim($pdo);

// GETTING THE START AND END DATE FOR THE WEEK
$dateRange = formatWeekRange();
$startDate = $dateRange['startDate'];
$endDate = $dateRange['endDate'];


// MINI CARDS MODULE


// MINI CARDS FUNCTION
$todaysTransactions = $transactionModel->getTodaysTotalAmount(); 
$weeklyTransactions = $transactionModel->getWeeklyTotalAmount();
$customerCount = $customerModel->getCustomerCount();
$newCustomerLastThreeDays = $customerModel->getNewCustomersLastThreeDays();
$customerTotalPoints = $customerModel->getAllCustomerPoints();
    

//MINI CARDS DATA
$miniCards = [
     ['label' => "Today's Earnings", 'content' => $todaysTransactions['total_amount'], 'logo' => 'fa-solid fa-money-bill-wave', 'iconPosition' => 'left', 'isCurrency' => true],
     ['label' => 'Weekly Earnings', 'content' => $weeklyTransactions['total_amount'], 'logo' => 'fa-solid fa-chart-simple', 'iconPosition' => 'right', 'isCurrency' => true],
     ['label' => 'Points can be redeemed', 'content' => $customerTotalPoints['total_points'], 'logo' => 'fa-solid fa-coins', 'iconPosition' => 'left', 'isCurrency' => false],
     ['label' => 'New Customers', 'content' => $newCustomerLastThreeDays['new_customers'], 'logo' => 'fa-solid fa-user-plus', 'iconPosition' => 'left', 'isCurrency' => false],
     ['label' => 'Total Customers', 'content' => $customerCount, 'logo' => 'fa-solid fa-users', 'iconPosition' => 'left', 'isCurrency' => false]

];


// CHARTS MODULE

// CHARTS FUNCTION
$dailyEarningsThisMonth = $transactionModel->getDailyEarningsThisMonth();
$dailyEarningsThisWeek = $transactionModel->getDailyEarningsThisWeek();



// CHART PREPARATION
$labels = [];
$totals = [];
$labels2 = [];
$totals2 = [];


foreach ($dailyEarningsThisMonth as $dailyEarningThisMonth) {
    $labels[] = date('m/d', strtotime($dailyEarningThisMonth['DATE']));
    $totals[] = $dailyEarningThisMonth['total'];
    // echo $dailyEarning['day'] . " " . $dailyEarning['total'] . "<br>"; -- THIS IS FOR TESTING
}

foreach ($dailyEarningsThisWeek as $dailyEarningThisWeek) {
    $labels2[] = date('m/d', strtotime($dailyEarningThisWeek['DATE']));
    $totals2[] = $dailyEarningThisWeek['total'];
}


// CHARTS DATA
$charts = [
    [
        'title' => 'Monthly Total Earnings',
        'chartId' => 'earningsChartThisMonth',
        'chartType' => 'line',
        'borderColor' => 'hsla(294, 83%, 27%, 1)',
        'backgroundColor' => 'hsla(294, 83%, 27%, 0.2)',
        'labelText' => 'Earnings for' . date('F Y'),
        'labels' => $labels,
        'data' => $totals
    ],

    [
        'title' => 'Weekly Total Earnings',
        'chartId' => 'earningsChartThisWeek',
        'chartType' => 'bar',
        'borderColor' => 'hsla(294, 83%, 27%, 1)',
        'backgroundColor' => 'hsla(294, 83%, 27%, 0.2)',
        'labelText' => 'Earnings for week of  '  ,
        'labels' => $labels2,
        'data' => $totals2
    ]
    ];


// LIST CARD MODULE

// LIST CARD FUNCTION
$customers = $customerModel->getLatestCustomers();
$topCustomers = $customerModel->getTopCustomerPoints(3);


//LIST CARD DATA
$listCards= [
    [
        'title' => 'Top Customers',
        'tableId' => 'topCustomersTable',
        'headers' => ['ID', 'Username', 'Accumulated Time (Hours)'],
        'data' => $topCustomers,
        'columns' => ['id', 'username', 'total_points'],
        'link' => 'customer.php'

    ],

    [
        'title' => 'Latest Customers',
        'tableId' => 'latestCustomersTable',
        'headers' => ['ID', 'Username', 'Full Name', 'Gender', 'Date Joined'],
        'data' => $customers,
        'columns' => ['id', 'username','fullname', 'gender', 'created_at'],
        'link' => 'customer.php'
    ],

    [
        'title' => 'Latest Claims',
        'tableId' => 'latestClaimsTable',
        'headers' => ['Claim ID', 'Username', 'Reward', 'Points used', 'Admin', 'Date Claimed'],
        'data' => $claimModel->getLatestClaims(),
        'columns' => ['id', 'customer_username', 'reward_name', 'points_used', 'admin_username', 'claim_date'],
        'link' => 'customer.php'
    ]
]


?>






<?php include __DIR__ . '../../partials/header.php'; ?>
<?php include __DIR__ . '../../partials/sidebar.php'; ?>

    


       
         
<div class="main-content">
<div class="card-container">
    <div class="mini-card-set">
        <?php foreach ($miniCards as $miniCard ) {
            extract($miniCard); // Extracts the variables from the array
            include __DIR__ . '../../partials/components/mini-card.php'; 
        }
        ?>

        
    </div>   
<div class="card-set">
    <?php foreach ($charts as $chart) {
        extract($chart); // Extracts the variables from the array
        include __DIR__ . '../../partials/components/graph-card.php'; 
    } ?>
    

    <div class="topCustomerList">


    </div>

</div>
<div class="list-card-set">
    <?php foreach ($listCards as $index => $listCard) {
        extract($listCard); // Extracts the variables from the array
        include __DIR__ . '../../partials/components/list-card.php'; 
    } ?>
</div>

</div>
    
  
            
           
                    
                </div>

                </div>
    
                </div>  

               

<script>
const chartsData = <?= json_encode($charts) ?>;

</script>
              

<?php include __DIR__ . '../../partials/footer.php'; ?>