<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>Student RESULT</div>
                </div>
            </div>
        </div>        

        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Student Result</div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Quiz Name</th>
                                <th>Scores</th>
                                <th>Ratings</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
$selExmne = $conn->query("SELECT * FROM examinee_tbl et INNER JOIN exam_attempt ea ON et.exmne_id = ea.exmne_id ORDER BY ea.examat_id DESC ");

if($selExmne->rowCount() > 0) {
    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { 
        $eid = $selExmneRow['exmne_id'];
        ?>
        <tr>
            <td><?php echo $selExmneRow['exmne_fullname']; ?></td>
            <td>
                <?php 
                $exam_id = $selExmneRow['exam_id'];
                $selExamTitle = $conn->query("SELECT ex_title FROM exam_tbl WHERE ex_id='$exam_id'");
                $exam_title = $selExamTitle->fetch(PDO::FETCH_ASSOC)['ex_title'];
                echo $exam_title;
                ?>
            </td>
            
            <td>
                <?php 
                
                $attempt_id = $selExmneRow['atmpAns'];
                $totalQuestionsAttempted = $conn->query("SELECT COUNT(*) AS total_attempted FROM exam_answers WHERE axmne_id='$eid' AND exam_id='$exam_id' AND atmpAns='$attempt_id' AND exans_status='new'")->fetch(PDO::FETCH_ASSOC)['total_attempted'];
                $selScore = $conn->query("SELECT COUNT(*) AS correct_answers FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer WHERE ea.axmne_id='$eid' AND ea.exam_id='$exam_id' AND ea.atmpAns='$attempt_id' AND ea.exans_status='new'");
                $row = $selScore->fetch(PDO::FETCH_ASSOC);
                $score = $row['correct_answers'];
                echo "$score/{$totalQuestionsAttempted}";
                ?>
            </td>
            <td>
                <?php 
                $totalQuestionsAttempted = $conn->query("SELECT COUNT(*) AS total_attempted FROM exam_answers WHERE axmne_id='$eid' AND exam_id='$exam_id' AND atmpAns='$attempt_id' AND exans_status='new'")->fetch(PDO::FETCH_ASSOC)['total_attempted'];
                $rating = ($score / $totalQuestionsAttempted) * 100;
                echo number_format($rating, 2) . "%";
                ?>
            </td>
        </tr>
        <?php 
    }
} else { ?>
    <tr>
        <td colspan="2">
            <h3 class="p-3">No Course Found</h3>
        </td>
    </tr>
<?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
