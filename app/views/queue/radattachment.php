<embed src="<?php echo base_url() . 'uploads/radiology/' . $attach; ?>" width="100%" height="600px"/>

<script type="text/javascript" src="<?php echo base_url(); ?>res/assets/scripts/main.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.table').DataTable();
    });
</script>
</body>
</html>