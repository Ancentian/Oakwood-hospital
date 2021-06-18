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
                    <div class="card-body">
                        <table class="mb-0 table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Disease</th>
                                <th>Numbers</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;
                            foreach ($treatment as $one) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $one['treatment']; ?></td>
                                    <td><?php echo $one['total']; ?></td>
                                </tr>
                                <?php $i++;
                            } ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>