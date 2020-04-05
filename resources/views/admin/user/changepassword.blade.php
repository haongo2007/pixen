
<!-- popup change password -->
<div class="modal" id="popupchangePassword" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="alert alert-success print-success-msg" style="display:none">
                </div>
                <form id="form_change_password">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">New Password:</label>
                        <input type="password" class="form-control" name="new_password">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Confirm Password:</label>
                        <input type="password" class="form-control" name="confirm_password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit">Save</button>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-submit").click(function(e){
                e.preventDefault();
                console.log($('#form_change_password').serialize());
                // get all the inputs into an array.
                var $inputs = $('#form_change_password :input');
                // get an associative array of just the values.
                var values = {};
                $inputs.each(function() {
                    values[this.name] = $(this).val();
                });
                values['id'] = "{{ $userId }}";

                $.ajax({
                    url: "{{ route('admin.user.changepassword') }}",
                    type:'POST',
                    data: values,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            printSuccessMsg(data.success);
                            location.reload();
                        }
                        else {
                            printErrorMsg(data.error);
                        }
                    }
                });

            });

            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $(".print-success-msg").css('display','none');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

            function printSuccessMsg(msg) {
                $(".print-error-msg").css('display','none');
                $(".print-success-msg").css('display','block');
                $(".print-success-msg").html(msg);
            }
        });
    </script>

