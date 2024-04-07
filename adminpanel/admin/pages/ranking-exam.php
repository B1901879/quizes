<div class="app-main__outer">
    <div class="app-main__inner">
        <!-- View ranking page -->
        <?php 
        @$exam_id = $_GET['exam_id'];
        if($exam_id != "") {
            $selEx = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exam_id' ")->fetch(PDO::FETCH_ASSOC);
            $exam_course = $selEx['cou_id'];
            $selExmne = $conn->query("SELECT * FROM examinee_tbl et WHERE exmne_course='$exam_course'");
        ?>
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div><b class="text-primary">RANKING</b><br>
                        Course Name : <?php echo $selEx['ex_title']; ?><br><br>
                        <span class="border" style="padding:10px;color:black;background-color: yellow;">Excellence</span>
                        <span class="border" style="padding:10px;color:white;background-color: green;">Very Good</span>
                        <span class="border" style="padding:10px;color:white;background-color: blue;">Good</span>
                        <span class="border" style="padding:10px;color:white;background-color: red;">Failed</span>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                <thead>
                    <tr>
                        <th width="25%">Participant Fullname</th>
                        <th>Score / Over</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) {
                        $exmneId = $selExmneRow['exmne_id'];
                        $selAttempts = $conn->query("SELECT DISTINCT atmpAns FROM exam_answers WHERE axmne_id='$exmneId' AND exam_id='$exam_id'");
                        while ($attemptRow = $selAttempts->fetch(PDO::FETCH_ASSOC)) {
                            $attempt_id = $attemptRow['atmpAns'];
                            $selScore = $conn->query("SELECT COUNT(*) AS correct_answers FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$exam_id' AND ea.atmpAns='$attempt_id' AND ea.exans_status='new'");
                            $row = $selScore->fetch(PDO::FETCH_ASSOC);
                            $score = $row['correct_answers'];
                            $totalQuestions = $conn->query("SELECT COUNT(*) AS total_questions FROM exam_question_tbl WHERE exam_id='$exam_id'")->fetch(PDO::FETCH_ASSOC)['total_questions'];
                            $ans = $score . " / " . $totalQuestions;
                            $percentage = ($score / $totalQuestions) * 100;
                            $color = '';
                            if ($percentage >= 90) {
                                $color = 'yellow';
                            } elseif ($percentage >= 80) {
                                $color = 'green';
                            } elseif ($percentage >= 50) {
                                $color = 'blue';
                            } else {
                                $color = 'red';
                            }
                    ?>
                    <tr style="background-color: <?php echo $color; ?>; color: <?php echo $color === 'yellow' ? 'black' : 'white'; ?>">
                        <td><?php echo $selExmneRow['exmne_fullname']; ?></td>
                        <td><?php echo $ans; ?></td>
                        <td><?php echo number_format($percentage,2); ?>%</td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?>
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div><b>RANKING</b></div>
                </div>
            </div>
        </div> 
        <div class="col-md-12">
            <!-- Ranking page -->
            <div class="main-card mb-3 card">
                <div class="card-header">Quiz List</div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                        <thead>
                            <tr>
                                <th class="text-left pl-4">Quiz Title</th>
                                <th class="text-left ">Course</th>
                                <th class="text-left ">Description</th>
                                <th class="text-center" width="8%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $selExam = $conn->query("SELECT * FROM exam_tbl ORDER BY ex_id DESC ");
                            if($selExam->rowCount() > 0) {
                                while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td class="pl-4"><?php echo $selExamRow['ex_title']; ?></td>
                                    <td>
                                        <?php 
                                        $courseId =  $selExamRow['cou_id']; 
                                        $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$courseId' ");
                                        while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) {
                                            echo $selCourseRow['cou_name'];
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $selExamRow['ex_description']; ?></td>
                                    <td class="text-center">
                                        <a href="?page=ranking-exam&exam_id=<?php echo $selExamRow['ex_id']; ?>"  class="btn btn-success btn-sm">View</a>
                                    </td>
                                </tr>
                                <?php }
                            } else { ?>
                            <tr>
                                <td colspan="5">
                                    <h3 class="p-3">No Quiz Found</h3>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
        <?php } ?>
    </div>
</div>