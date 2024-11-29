<?php
// Database connection
include('conn.php');

// Start session
session_start();

// Directly access the logged-in student's ID
$exmneId = $_SESSION['examineeSession']['exmne_id'];

// Fetch all quiz attempts for the student (exam_id = 28)
$quizScoreQuery = "
    SELECT ea.atmpAns, COUNT(*) AS correct_answers, ex.ex_questlimit_display
    FROM exam_answers ea
    INNER JOIN exam_question_tbl eqt ON ea.quest_id = eqt.eqt_id
    INNER JOIN exam_tbl ex ON ea.exam_id = ex.ex_id
    WHERE ea.axmne_id = '$exmneId'
    AND ea.exam_id = 28  -- Filter for exam_id = 28
    AND eqt.exam_answer = ea.exans_answer
    GROUP BY ea.atmpAns, ea.exam_id, ex.ex_questlimit_display
    ORDER BY ea.atmpAns DESC
    LIMIT 5
";
$selQuizScore = $conn->query($quizScoreQuery);

// Initialize arrays for attempts, correct answers, and total questions
$attempts = [];
$correctAnswers = [];
$totalQuestions = [];
$performanceProgress = [];

// Fetch attempts and calculate performance progress
while ($row = $selQuizScore->fetch(PDO::FETCH_ASSOC)) {
    $attempts[] = "Attempt " . $row['atmpAns'];
    $correctAnswers[] = $row['correct_answers'];
    $totalQuestions[] = $row['ex_questlimit_display'];
    $performanceProgress[] = ($row['correct_answers'] / $row['ex_questlimit_display']) * 100; // Calculate percentage performance
}

// Reverse arrays for displaying in chronological order
$attempts = array_reverse($attempts);
$correctAnswers = array_reverse($correctAnswers);
$totalQuestions = array_reverse($totalQuestions);
$performanceProgress = array_reverse($performanceProgress);

// Get the latest 5 attempts for the most recent performance graph
$latestAttempts = array_slice($attempts, 0, 5);
$latestCorrectAnswers = array_slice($correctAnswers, 0, 5);
$latestTotalQuestions = array_slice($totalQuestions, 0, 5);

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
        .chart-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .chart {
            flex: 1;
            margin: 0 10px;
            min-width: 300px;
            max-width: 45%;
        }
        canvas {
            max-width: 100%;
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
            <div class="chart-container">
                <!-- Graph 1: Latest 5 Attempts (Bar Chart) -->
                <div class="chart">
                    <h4>Latest 5 Quiz Attempts</h4>
                    <canvas id="latestAttemptsChart"></canvas>
                </div>

                <!-- Graph 2: Predicted SPM Result (Line Chart) -->
                <div class="chart">
                    <h4>Predicted SPM Score Based on Past Performance</h4>
                    <canvas id="predictedSPMChart"></canvas>
                </div>
            </div>

            <!-- Graph 3: Overall Performance Progress (Enlarged) -->
            <div class="chart-container">
                <div class="chart" style="flex: 1 1 100%; max-width: 100%;">
                    <h4>Overall Performance Progress</h4>
                    <canvas id="performanceProgressChart"></canvas>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        <?php if (!empty($attempts)): ?>
            // Graph 1: Latest 5 Attempts (Bar Chart - Correct Answers out of Total)
            var ctx1 = document.getElementById('latestAttemptsChart').getContext('2d');
            var latestAttemptsChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($latestAttempts); ?>,
                    datasets: [{
                        label: 'Correct Answers (out of 40)',
                        data: <?php echo json_encode($latestCorrectAnswers); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 40
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Latest 5 Quiz Attempts (Correct Answers out of 40)'
                        }
                    }
                }
            });

            // Graph 2: Predicted SPM Score (Line Chart)
            var ctx2 = document.getElementById('predictedSPMChart').getContext('2d');
            var predictedSPMChart = new Chart(ctx2, {
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

            // Graph 3: Overall Performance Progress (Enlarged Line Chart)
            var ctx3 = document.getElementById('performanceProgressChart').getContext('2d');
            var performanceProgressChart = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($attempts); ?>,
                    datasets: [{
                        label: 'Overall Performance Progress (%)',
                        data: <?php echo json_encode($performanceProgress); ?>,
                        borderColor: 'rgba(54, 162, 235, 1)',
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
                            text: 'Overall Performance Progress'
                        }
                    }
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>