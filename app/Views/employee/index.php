<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Employee</h1>
<p class="mb-4">Create, Update, Delete Data Employee Here.</p>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Employee</h6>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-3 float-md-right" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Create
        </button>
        <div class="table-responsive">
            <table class="table table-bordered" id="employeeTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Office</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><b>Create Employee</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('employee/store') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="number" class="req">Employee ID</label>
                        <input type="text" class="form-control" id="number" name="number" placeholder="ex. S001" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="req">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ex. John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="req">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ex. john.doe@office.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="req">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="ex. +62 813-4567-890" required>
                    </div>
                    <div class="form-group">
                        <label for="office" class="req">Office</label>
                        <br>
                        <select name="office" id="office" class="form-control" required>
                            <option></option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bogor">Bogor</option>
                            <option value="Bandung">Bandung</option>
                        </select>
                    </div>
                    <p style="font-style: italic; font-size:small;"><span class="req"></span> required</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><b>Edit Employee</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="number" class="req">Employee ID</label>
                        <input type="text" class="form-control" id="number" name="number" placeholder="ex. S001" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="req">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ex. John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="req">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ex. john.doe@office.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="req">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="ex. +62 813-4567-890" required>
                    </div>
                    <div class="form-group">
                        <label for="office_edit" class="req">Office</label>
                        <br>
                        <select name="office_edit" id="office_edit" class="form-control" required>
                            <option></option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bogor">Bogor</option>
                            <option value="Bandung">Bandung</option>
                        </select>
                    </div>
                    <p style="font-style: italic; font-size:small;"><span class="req"></span> required</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $(document).ready(function() {
        const table = $('#employeeTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: true,
            order: [],
            ajax: '<?= site_url('employee') ?>',
            columns: [{
                    data: 'no',
                    searchable: false,
                    orderable: false,
                    className: 'text-center'
                },
                {
                    data: 'number'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone',
                    orderable: false,
                },
                {
                    data: 'office'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ]
        });

        $('#office').select2({
            dropdownParent: $('#createModal'),
            placeholder: 'Select Office',
            theme: 'bootstrap4',
        });

        $('#office_edit').select2({
            dropdownParent: $('#editModal'),
            placeholder: 'Select Office',
            theme: 'bootstrap4',
        });

        table.on('click', '.editButton', function() {
            var id = $(this).data('id');
            var url = '<?= site_url('employee/update') ?>/' + id;

            $.ajax({
                url: '<?= site_url('employee/edit') ?>/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false,
                            timerProgressBar: true
                        });
                        return;
                    }
                    $('#editModal form').attr('action', url);
                    $('#editModal #number').val(data.number);
                    $('#editModal #name').val(data.name);
                    $('#editModal #email').val(data.email);
                    $('#editModal #phone').val(data.phone);
                    $('#editModal #office_edit').val(data.office).trigger('change');
                    $('#editModal').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorThrown,
                        showConfirmButton: false,
                        timer: 2000,
                        allowOutsideClick: false,
                        timerProgressBar: true
                    });
                }
            });
        });

        table.on('click', '.deleteButton', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('employee/delete') ?>/' + id,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.error,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    allowOutsideClick: false,
                                    timerProgressBar: true
                                });
                                return;
                            }
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.success,
                                showConfirmButton: false,
                                timer: 1500,
                                allowOutsideClick: false,
                                timerProgressBar: true
                            });
                            table.ajax.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorThrown,
                                showConfirmButton: false,
                                timer: 2000,
                                allowOutsideClick: false,
                                timerProgressBar: true
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>