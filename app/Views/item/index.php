<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Item</h1>
<p class="mb-4">Create, Update, Delete Data Item Here.</p>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Item</h6>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-3 float-md-right" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Create
        </button>
        <div class="table-responsive">
            <table class="table table-bordered" id="itemTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Price</th>
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
                <h5 class="modal-title" id="createModalLabel"><b>Create Item</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('item/store') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="req">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ex. Item A" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="req">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" id="price" name="price" placeholder="ex. 100.000" required>
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
                <h5 class="modal-title" id="editModalLabel"><b>Edit Item</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="req">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ex. Item A" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="req">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" id="price" name="price" placeholder="ex. 100.000" required>
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
        const table = $('#itemTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: true,
            order: [],
            ajax: '<?= site_url('item') ?>',
            columns: [{
                    data: 'no',
                    searchable: false,
                    orderable: false,
                    className: 'text-center'
                },
                {
                    data: 'name'
                },
                {
                    data: 'price',
                    className: 'text-left'
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
            var name = $(this).data('name');
            var price = $(this).data('price');
            var url = '<?= site_url('item/update') ?>/' + id;

            $('#editModal form').attr('action', url);
            $('#editModal #name').val(name);
            $('#editModal #price').val(price);
            $('#editModal').modal('show');
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
                        url: '<?= site_url('item/delete') ?>/' + id,
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

        function initMask(atrb) {
            $(atrb + ' #price').mask('000.000.000.000.000', {
                reverse: true
            });
        }

        initMask('#createModal');
        initMask('#editModal');
    });
</script>

<?= $this->endSection() ?>