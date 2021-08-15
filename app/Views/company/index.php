<?= $this->extend('layout/templates'); ?>
<?= $this->Section('content'); ?>

<!-- Form Company -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class="fas fa-server"></i> CRUD Company</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Company Table
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> Add data</a>

                    <?php
                    $errors = session()->getFlashdata('failed');
                    if (!empty($errors)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-times"></i> Failed</strong> data not added to database.
                            <ul>
                                <?php foreach ($errors as $e) { ?>
                                    <li><?= esc($e); ?></li>
                                <?php } ?>
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashData('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-check"></i> Success</strong> <?= session()->getFlashData('success'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Province</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($company as $c) : ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><?= esc($c['COMPANYNAME']); ?></td>
                                        <td><?= esc($c['ADDRESS']); ?></td>
                                        <td><?= esc($c['CITY']); ?></td>
                                        <td><?= esc($c['PROVINCE']); ?></td>

                                        <td class="text-center" width="20%">
                                            <a href="" class="btn btn-info btn-sm mb-1" data-toggle="modal" data-target="#updatemodal<?= $c['COMPANYID']; ?>">
                                                Update
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#deleteModal<?= $c['COMPANYID']; ?>">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Tambah Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('company/add_data') ?>
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Company ID</label>
                        <input type="text" name="companyid" id="companyid" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" name="companyname" id="companyname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" name="address" id="address" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="position">City</label>
                        <input type="text" name="city" id="city" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="age">Province</label>
                        <input type="text" name="province" id="province" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete modal -->
    <?php foreach ($company as $c) : ?>
        <div class="modal fade" id="deleteModal<?= $c['COMPANYID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-circle"></i> Delete Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('company/delete_data/' . $c['COMPANYID']); ?>
                        <?= csrf_field(); ?>

                        <p>Click the submit button to delete data (<?= $c['COMPANYNAME']; ?>)..!!!</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm">Submit</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Update modal -->
    <?php foreach ($company as $c) : ?>
        <div class="modal fade" id="updatemodal<?= $c['COMPANYID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-circle"></i> Update Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('company/update_data/' . $c['COMPANYID']); ?>
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="name">Company ID</label>
                            <input type="text" name="companyid" id="companyid" class="form-control" value="<?= $c['COMPANYID']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" name="companyname" id="companyname" class="form-control" value="<?= $c['COMPANYNAME']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Address</label>
                            <input type="text" name="address" id="address" class="form-control" value="<?= $c['ADDRESS']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="position">City</label>
                            <input type="text" name="city" id="city" class="form-control" value="<?= $c['CITY']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="age">Province</label>
                            <input type="text" name="province" id="province" class="form-control" value="<?= $c['PROVINCE']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?= $this->endSection(); ?>