<div class="app-wrapper-footer">
    <div class="app-footer">
        <div class="app-footer__inner">
            <div class="app-footer-left">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="javascript:window.alert('Coming soon!')" class="nav-link">
                            Manual
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:window.alert('Coming soon!')" class="nav-link">
                            Help
                        </a>
                    </li>
                </ul>
            </div>
            <div class="app-footer-right">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="javascript:window.alert('Coming soon!')" class="nav-link">
                            Suggestion Box
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>    </div>

</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>res/assets/scripts/main.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!--  -->

<script type="text/javascript">
    $(document).ready(function (a) {
        $(".switch-sidebar-cs-class").on("click",function(){
            var t=a(this).attr("data-class");
            setCookie('sidebarformat',null,0);
            setCookie('sidebarformat',t,365);
        });
        $(".switch-header-cs-class").on("click",function(){
           var t=a(this).attr("data-class");
           setCookie('appbarformat',null,0);
           setCookie('appbarformat',t,365);
       });
        
        var appbarformat = getCookie('appbarformat');
        if (appbarformat) {
            var t = appbarformat;
            $(".app-header").addClass("header-shadow "+t);
        }
        
        var sidebarformat = getCookie('sidebarformat');
        if (sidebarformat) {
            var t = sidebarformat;
            $(".app-sidebar").addClass("header-shadow "+t);
        }
        
        
        function setCookie(name,value,days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
        function eraseCookie(name) {   
            document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }
        $('.select').select2();
        
        $('.searchable').select2();
        
        $('.table').DataTable({
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            stateSave: true
        });
    });
</script>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Test Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('labtest/editCategory/'. $one['id'])?>">
                    <div class="row">
                        <div class="position-relative row form-group col-sm-6">
                            <label for="exampleEmail"class="col-sm-4 col-form-label">Category Name</label>
                            <div class="col-sm-8">
                                <input name="cat_name" id="exampleEmail" type="text" value="<?php echo $one['cat_name']?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addPaymentMode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Mode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="<?php echo base_url('settings/add_paymentMode'); ?>" method="POST">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="examplePassword11" class="">Payment Mode</label>
                            <input name="payment_mode" id="cost" placeholder="Type Mode Name" type="text" class="form-control" >
                        </div>
                    </div>
                    <div class="position-relative form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="status" value="1" class="form-check-input"> Check to Activate Mode
                        </label>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Mode</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Radiology Category Modal -->
<div class="modal fade" id="radiology-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('radiology/addCategory')?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="position-relative row form-group col-sm-12">
                            <label for="exampleEmail"class="col-sm-8 col-form-label">Category Name</label>
                            <div class="col-sm-8">
                                <input name="cat_name" id="exampleEmail" type="text" placeholder="Category Name" class="form-control" required>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


