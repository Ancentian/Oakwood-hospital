<div class="app-main__outer">
    <div class="app-main__inner">

        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success-msg')) { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
                <?php } ?>
                <?php if ($this->session->flashdata('error-msg')) { ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
                <?php } ?>
                <div class="main-card mb-3 card">
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>DEFINE
                        YOUR WORKFLOW

                    </div>
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Offered?</th>
                                <th>Department offering</th>
                            </tr>
                            </thead>
                            <tbody>
                            <form method="post" action="<?php echo base_url(); ?>workflow/update">
                                <?php $i = 1;
                                foreach ($workflow as $one) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $one['name']; ?></td>
                                        <td><input type="checkbox"
                                                   name="<?php echo 'offered_' . $one['id']; ?>" <?php if ($one['is_offered'] == 'yes') {
                                                echo "checked";
                                            } ?>></td>
                                        <td>
                                            <select class="select form-control"  name="department_<?php echo $one['id']; ?>" class="form-control">
                                                <option>--Select</option>

                                                <?php foreach ($dpts as $dpt) { ?>
                                                    <option value="<?php echo $dpt['id']; ?>" <?php if ($one['department'] == $dpt['id']) {
                                                        echo "selected";
                                                    } ?>><?php echo $dpt['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>

                                    </tr>
                                    <?php $i++;
                                } ?>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" class="btn btn-success"></td>
                                </tr>
                            </form>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>