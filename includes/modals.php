<!-- Modal For Add Feedback -->
<div class="modal fade" id="viewFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="viewFeedbackLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewFeedbackLabel">Your Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
       
          $stmt = $conn->prepare("SELECT * FROM feedbacks_tbl WHERE exmne_id = :studentId ORDER BY feedback_id DESC");
          $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
          $stmt->execute();
          $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

          if ($feedbacks) {
            echo "<ul class='list-group'>";
            foreach ($feedbacks as $feedback) {
              echo "<li class='list-group-item'>";
              echo "<strong>Date: </strong>" . htmlspecialchars($feedback['feedback_date']) . "<br>"; // Replace 'feedback_date' with your actual column name for the date
              echo "<strong>Feedback: </strong>" . htmlspecialchars($feedback['feedback_content']); // Replace 'feedback_content' with your actual column name for feedback
              echo "</li>";
            }
            echo "</ul>";
          } else {
            echo "<p>No feedback available.</p>";
          }
        ?>
          <div class="form-group">
           <textarea name="myFeedbacks" class="form-control" rows="3" placeholder="Input your feedback here.."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
   </form>
  </div>
</div>