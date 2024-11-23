<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Sales</h1>
<p class="mb-4">Create, Update, Delete Data Sales Here.</p>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Sales</h6>
    </div>
    <div class="card-body">
        <h5><b>Filter :</b></h5>
        <div class="row col-md-6 col-sm-12">
            <div class="form-group col">
                <label for="dateSpesific">Spesific Date</label>
                <input type="date" class="form-control" id="dateSpesific" name="dateSpesific" placeholder="Click Here">
            </div>
            <div class="form-group col">
                <label for="dateStart">Start Date</label>
                <input type="date" class="form-control" id="dateStart" name="dateStart" placeholder="Click Here">
            </div>
            <div class="form-group col">
                <label for="dateEnd">End Date</label>
                <input type="date" class="form-control" id="dateEnd" name="dateEnd" placeholder="Click Here">
            </div>
        </div>
        <button type="button" class="btn btn-primary mb-3 float-md-right" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Create
        </button>
        <div class="table-responsive">
            <table class="table table-bordered" id="salesTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Client ID</th>
                        <th>Employee</th>
                        <th>Item</th>
                        <th>Order Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
                <h5 class="modal-title" id="createModalLabel"><b>Create Sales</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('sales/store') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="employee" class="req">Employee</label>
                        <select name="employee" id="employee" required class="form-control">
                            <option></option>
                            <?php foreach ($data['employee'] as $employee) : ?>
                                <option value="<?= $employee['number'] ?>"><?= $employee['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="item" class="req">Item</label>
                            <select name="item" id="item" required class="form-control">
                                <option></option>
                                <?php foreach ($data['item'] as $item) : ?>
                                    <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="price" class="req">Item Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Choose Item First" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_date" class="req">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" placeholder="Click Here" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="client" class="req">Client ID</label>
                            <input type="text" class="form-control" id="client" name="client" placeholder="ex. C00001" required>
                        </div>
                        <div class="form-group col-8">
                            <label for="client_name" class="req">Client Name</label>
                            <input type="text" class="form-control" id="client_name" name="client_name" placeholder="ex. John Doe" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="client_email" class="req">Client Email</label>
                            <input type="email" class="form-control" id="client_email" name="client_email" placeholder="ex. john.doe@gmail.com" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_phone" class="req">Client Phone</label>
                            <input type="text" class="form-control" id="client_phone" name="client_phone" placeholder="ex. +62 812-3456-789" required>
                        </div>
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
                <h5 class="modal-title" id="editModalLabel"><b>Edit Sales</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="employee">Employee</label>
                        <input type="text" name="employee" id="employee" class="form-control" readonly>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="item">Item</label>
                            <input type="text" name="item" id="item" class="form-control" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="price">Item Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Choose Item First" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_date" class="req">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" placeholder="Click Here" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="client" class="req">Client ID</label>
                            <input type="text" class="form-control" id="client" name="client" placeholder="ex. C00001" required>
                        </div>
                        <div class="form-group col-8">
                            <label for="client_name" class="req">Client Name</label>
                            <input type="text" class="form-control" id="client_name" name="client_name" placeholder="ex. John Doe" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="client_email" class="req">Client Email</label>
                            <input type="email" class="form-control" id="client_email" name="client_email" placeholder="ex. john.doe@gmail.com" required>
                        </div>
                        <div class="form-group col">
                            <label for="client_phone" class="req">Client Phone</label>
                            <input type="text" class="form-control" id="client_phone" name="client_phone" placeholder="ex. +62 812-3456-789" required>
                        </div>
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
        const table = $('#salesTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: true,
            order: [],
            ajax: {
                url: '<?= site_url('sales') ?>',
                type: 'GET',
                data: function(d) {
                    d.dateStart = $('#dateStart').val();
                    d.dateEnd = $('#dateEnd').val();
                    d.dateSpesific = $('#dateSpesific').val();
                }
            },
            columns: [{
                    data: 'no',
                    name: 'no',
                    searchable: false,
                    orderable: false,
                    className: 'text-center'
                },
                {
                    data: 'id_client',
                    name: 'id_client',
                },
                {
                    data: 'employee',
                    name: 'employees.name',
                },
                {
                    data: 'item',
                    name: 'id_item',
                },
                {
                    data: 'order_date',
                    name: 'order_date',
                    searchable: false,
                },
                {
                    data: 'client_name',
                    name: 'client_name',
                },
                {
                    data: 'client_email',
                    name: 'client_email',
                },
                {
                    data: 'client_phone',
                    name: 'client_phone',
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ]
        });

        table.on('click', '.editButton', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '<?= site_url('sales/edit') ?>',
                type: 'GET',
                dataType: 'JSON',
                data: {
                    id: id
                },
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
                    $('#editModal form').attr('action', '<?= site_url('sales/update') ?>/' + id);
                    $('#editModal #employee').val(data.employee.name);
                    $('#editModal #item').val(data.item.name);
                    $('#editModal #price').val(data.item.price);
                    $('#editModal #order_date').val(data.order_date);
                    $('#editModal #client').val(data.id_client);
                    $('#editModal #client_name').val(data.client_name);
                    $('#editModal #client_email').val(data.client_email);
                    $('#editModal #client_phone').val(data.client_phone);
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
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('sales/delete') ?>/' + id,
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

        $('#dateStart, #dateEnd, #dateSpesific').on('change', function() {
            table.ajax.reload();
        });

        function initSelect2(atrb, modal, text) {
            $(atrb).select2({
                theme: 'bootstrap4',
                placeholder: 'Choose ' + text,
                allowClear: true,
                dropdownParent: $(modal)
            });
        }

        $('#createModal').on('shown.bs.modal', function() {
            initSelect2('#createModal #employee', '#createModal', 'Employee');
            initSelect2('#createModal #item', '#createModal', 'Item');
        });

        // $('#editModal').on('shown.bs.modal', function() {
        //     initSelect2('#editModal #employee', '#editModal', 'Employee');
        //     initSelect2('#editModal #item', '#editModal', 'Item');
        // });

        function itemChange(atrb) {
            $(atrb).on('change', function() {
                var item = $(this).val();
                var price = <?= json_encode($data['item']) ?>;
                price.forEach(function(data) {
                    if (data.name == item) {
                        $(atrb).parent().next().find('input').val(data.price);
                    }
                });
            });
        }

        itemChange('#item');
        itemChange('#editModal #item');

        function initMask(atrb) {
            $(atrb + ' #client').mask('C00000', {
                translation: {
                    'C': {
                        pattern: /[C]/,
                        fallback: 'C'
                    }
                }
            });

            $(atrb + ' #client_phone').mask('+62 999-9999-99999');
        }

        initMask('#createModal');
        initMask('#editModal');
    });
</script>

<?= $this->endSection() ?>