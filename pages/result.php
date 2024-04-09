<?php

$atmpAnsid = isset($_GET['atmpAnsid']) ? $_GET['atmpAnsid'] : null;

$examId = isset($_GET['id']) ? $_GET['id'] : null;
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId'")->fetch(PDO::FETCH_ASSOC);

// Fetch the score and result percentage for the specific attempt
$attemptScoreQuery = "
    SELECT COUNT(*) AS correct_answers 
    FROM exam_question_tbl eqt 
    INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id 
    WHERE ea.axmne_id='$exmneId' 
    AND ea.exam_id='$examId' 
    AND ea.exans_status='new' 
    AND eqt.exam_answer = ea.exans_answer
    AND ea.atmpAns = '$atmpAnsid'
";
$selAttemptScore = $conn->query($attemptScoreQuery);
$row = $selAttemptScore->fetch(PDO::FETCH_ASSOC);
$attemptCorrectAnswers = $row['correct_answers'];

// Total number of questions for the specific attempt
$totalQuestionsAttempt = $selExam['ex_questlimit_display'];

// Calculate and output the result percentage for the specific attempt
$attemptResultPercentage = ($attemptCorrectAnswers / $totalQuestionsAttempt) * 100;
$attemptResultPercentageFormatted = number_format($attemptResultPercentage, 2) . "%";
?>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div id="refreshData">
            <div class="col-md-12">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>
                                <?php echo $selExam['ex_title']; ?>
                                <div class="page-title-subheading">
                                    <?php echo $selExam['ex_description']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row col-md-12">
                    <h1 class="text-primary">RESULT</h1>
                </div>

                <div class="row col-md-6 float-left">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Your Answer</h5>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                                <?php 
                               $selQuest = $conn->query("SELECT eqt.*, ea.*, ea.exans_answer AS examinee_answer, eqt.exam_answer AS correct_answer FROM ( SELECT DISTINCT eqt_id, exam_id FROM exam_question_tbl WHERE exam_id = $examId ) AS distinct_eqt INNER JOIN exam_question_tbl eqt ON distinct_eqt.eqt_id = eqt.eqt_id INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE ea.axmne_id = $exmneId AND ea.atmpAns = $atmpAnsid");
                                $i = 1;
                                while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td>
                                            <b><p><?php echo $i++; ?> ) <?php echo $selQuestRow['exam_question']; ?></p></b>
                                            <label class="pl-4 text-success">
                                                Your Answer : 
                                                <?php 
    if($selQuestRow['exam_answer'] != $selQuestRow['examinee_answer'])
    { ?>
        <span style="color:red"><?php echo $selQuestRow['examinee_answer']; ?> (Incorrect)</span>
        <br>
        Correct Answer: <span style="color:black"><?php echo $selQuestRow['correct_answer']; ?></span>
    <?php }
    else
    { ?>
        <span style="color:green"><?php echo $selQuestRow['examinee_answer']; ?> (Correct)</span>
    <?php }
?>
                                            </label>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 float-left">
                    <div class="card mb-3 widget-content bg-night-fade">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h5>Score </h5></div>
                                <div class="widget-subheading" style="color: transparent;">/</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white">
                                    <span><?php echo $attemptCorrectAnswers; ?>/<?php echo $totalQuestionsAttempt; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 float-left">
                    <div class="card mb-3 widget-content bg-happy-green">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h5>Result Percentage</h5></div>
                                <div class="widget-subheading" style="color: transparent;">/</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white">
                                    <?php echo $attemptResultPercentageFormatted; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
