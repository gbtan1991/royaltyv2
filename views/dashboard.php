<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../helpers/format.php';
require_once __DIR__ . '/../helpers/randomizer.php';

if(!isset($_SESSION['admin_id'])){
    header('Location: ../public/login.php');
    exit();
}


// Page Title

$pageTitle = 'Dashboard';
$currentPage = 'dashboard';

// Fetching Customers

$customerModel = new Customer($pdo);
$transactionModel = new transaction($pdo);

$customers = $customerModel->getLatestCustomers();
$topCustomers = $customerModel->getTopCustomerPoints(3);


//M Mini Cards Functions

$todaysTransactions = $transactionModel->getTodaysTotalAmount(); 
$weeklyTransactions = $transactionModel->getWeeklyTotalAmount();
$customerCount = $customerModel->getCustomerCount();
$newCustomerLastThreeDays = $customerModel->getNewCustomersLastThreeDays();
$customerTotalPoints = $customerModel->getAllCustomerPoints();
    

//  Mini Card Data
$miniCards = [
     ['label' => "Today's Earnings", 'content' =>"P " . $todaysTransactions['total_amount'], 'logo' => 'fa-solid fa-money-bill-wave', 'iconPosition' => 'left'],
     ['label' => 'Weekly Earnings', 'content' =>"P " . $weeklyTransactions['total_amount'], 'logo' => 'fa-solid fa-chart-simple', 'iconPosition' => 'right'],
     ['label' => 'Points can be redeemed', 'content' => $customerTotalPoints['total_points'], 'logo' => 'fa-solid fa-coins', 'iconPosition' => 'left'],
     ['label' => 'New Customers', 'content' => $newCustomerLastThreeDays['new_customers'], 'logo' => 'fa-solid fa-user-plus', 'iconPosition' => 'left'],
     ['label' => 'Total Customers', 'content' => $customerCount, 'logo' => 'fa-solid fa-users', 'iconPosition' => 'left']

];


// CALLING THE MODULES FOR THE CHARTS
$dailyEarningsThisMonth = $transactionModel->getDailyEarningsThisMonth();
$dailyEarningsThisWeek = $transactionModel->getDailyEarningsThisWeek();


// Preparing data for the chart
$labels = [];
$totals = [];

$labels2 = [];
$totals2 = [];


foreach ($dailyEarningsThisMonth as $dailyEarningThisMonth) {
    $labels[] = $dailyEarningThisMonth['day'];
    $totals[] = $dailyEarningThisMonth['total'];
    // echo $dailyEarning['day'] . " " . $dailyEarning['total'] . "<br>"; -- THIS IS FOR TESTING
}

foreach ($dailyEarningsThisWeek as $dailyEarningThisWeek) {
    $labels2[] = $dailyEarningThisWeek['day'];
    $totals2[] = $dailyEarningThisWeek['total'];
}

// GETTING THE START AND END DATE FOR THE WEEK
$dateRange = formatWeekRange();

$startDate = $dateRange['startDate'];
$endDate = $dateRange['endDate'];



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

</div>


          
            
    
      
    
   
    <div style="display: flex; gap: 20px">
        <div>
            <h3>Latest Customers</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= htmlspecialchars($customer['id']) ?></td>
                        <td><?= htmlspecialchars($customer['username']) ?></td>
                        <td><?= htmlspecialchars($customer['fullname']) ?></td>
                        <td><?= formatGender($customer['gender']) ?></td>
                       
                        
                    </tr>
                    <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No Customers Found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div>
        
        <h3>Top Customers</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Accumulated Time (Hours)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($topCustomers)): ?>
                    <?php foreach ($topCustomers as $customer): ?>
                        <tr>
                            <td><?= htmlspecialchars($customer['id']) ?></td>
                            <td><?= htmlspecialchars($customer['username']) ?></td>
                            <td><?= formatHoursFromPoints($customer['total_points']) ?></td>
                            <!-- Assuming each 1 point = 30 mins, so total_points / 2 gives hours -->
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No top customers found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
            
            
           
                    
                </div>

                </div>
    
                </div>  

               

<script>
const labels = <?php echo json_encode($days); ?>;
const data = <?php echo json_encode($totals); ?>;

const ctx = document.getElementById('earningsChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Daily Earnings',
            data: data,
            borderColor: 'hsla(294, 83%, 27%, 1)',
            backgroundColor: 'hsla(33, 23%, 83%, 1)',
            fill: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


</script>
              

<?php include __DIR__ . '../../partials/footer.php'; ?>