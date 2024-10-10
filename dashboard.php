<?php 
// Database connection
include('conn.php');

// Start session
session_start();

// Directly access the logged-in student's ID
$exmneId = $_SESSION['examineeSession']['exmne_id']; // Adjusted to access the correct session variable

// Fetch the newest 5 quiz attempts and their scores
$quizScoreQuery = "
    SELECT ea.atmpAns, COUNT(*) AS correct_answers, ex.ex_questlimit_display
    FROM exam_answers ea
    INNER JOIN exam_question_tbl eqt ON ea.quest_id = eqt.eqt_id
    INNER JOIN exam_tbl ex ON ea.exam_id = ex.ex_id
    WHERE ea.axmne_id = '$exmneId'
    AND eqt.exam_answer = ea.exans_answer
    GROUP BY ea.atmpAns, ea.exam_id
    ORDER BY ea.atmpAns DESC
    LIMIT 5
";
$selQuizScore = $conn->query($quizScoreQuery);

// Initialize arrays for attempts and correct answers
$attempts = [];
$correctAnswers = [];
$totalQuestions = [];

// Fetch attempts
while ($row = $selQuizScore->fetch(PDO::FETCH_ASSOC)) {
    $attempts[] = "Attempt " . $row['atmpAns'];
    $correctAnswers[] = $row['correct_answers'];
    $totalQuestions[] = $row['ex_questlimit_display'];
}

// Reverse the arrays for display
$attempts = array_reverse($attempts);
$correctAnswers = array_reverse($correctAnswers);
$totalQuestions = array_reverse($totalQuestions);

// Predictive Data for SPM based on past performance
if (count($correctAnswers) > 0) {
    $averageScore = array_sum($correctAnswers) / count($correctAnswers);
    $predictedSPMScore = ($averageScore / max($totalQuestions)) * 100; // Predict based on percentage
} else {
    $predictedSPMScore = 0; // Default value if no attempts
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .app-main__inner {
            width: 80%;
            margin: 0 auto;
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
        }
        h4 {
            text-align: center;
        }
        .refresh-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .refresh-button:hover {
            background-color: #45a049;
        }
        /* Flexbox layout for graphs */
        .chart-container {
            display: flex;
            justify-content: space-between;
        }
        .chart {
            flex: 1;
            margin: 0 10px; /* Adds spacing between charts */
        }
        canvas {
            max-width: 100%; /* Ensure the canvas fits the container */
        }
    </style>
</head>
<body>
    <div class="app-main__inner">
        <h1>Performance Dashboard</h1>

        <button class="refresh-button" onclick="location.reload();">Refresh Data</button>

        <!-- Check for attempts -->
        <?php if (empty($attempts)): ?>
            <h4>You have not done any quiz yet, Do a quiz now!</h4>
        <?php else: ?>
            <!-- Graph 1: Newest 5 Attempts - Score Comparison -->
            <div class="chart-container">
                <div class="chart">
                    <h4>Latest 5 Quiz Attempts - Score Comparison</h4>
                    <canvas id="scoreComparisonChart"></canvas>
                </div>

                <!-- Predictive Graph: Estimated SPM Result -->
                <div class="chart">
                    <h4>Predicted SPM Score Based on Past Performance</h4>
                    <canvas id="predictedSPMChart"></canvas>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        <?php if (!empty($attempts)): ?>
            // Graph 1: Newest 5 Attempts - Score Comparison
            var ctx1 = document.getElementById('scoreComparisonChart').getContext('2d');
            var scoreComparisonChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($attempts); ?>,
                    datasets: [{
                        label: 'Correct Answers',
                        data: <?php echo json_encode($correctAnswers); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: <?php echo max($totalQuestions); ?>
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Score Comparison'
                        }
                    }
                }
            });

            // Predictive Graph: Predicted SPM Score
            var ctx3 = document.getElementById('predictedSPMChart').getContext('2d');
            var predictedSPMChart = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($attempts); ?>,
                    datasets: [{
                        label: 'Predicted SPM Score',
                        data: Array(<?php echo count($attempts); ?>).fill(<?php echo $predictedSPMScore; ?>),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Predicted SPM Score'
                        }
                    }
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>

