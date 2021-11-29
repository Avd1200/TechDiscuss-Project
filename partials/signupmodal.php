
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign up for TechDiscuss Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="/Forum/partials/signuphandler.php">
            <div class="modal-body">
                <div class="form-group">
                  <label for="email">Username</label>
                  <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="signupemail">
                  <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="signupPassword">
                </div>
                <div class="form-group">
                  <label for="cpassword">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" name="signupcPassword">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
             </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
      </form>
    </div>
  </div>
</div>