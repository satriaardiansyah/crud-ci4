<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active bg-warning" href="/"> CRUD Database Jquery AJAX </a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-item nav-link active text-light bg-primary" href="/user">  Data DummyJson </a>
                </div>
            </div>
        </nav>
        <h1>Formulir Tambah Data Users JQuery, AJAX</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nama kamu" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com"
                required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat kamu" required>
        </div>
        <button type="submit" class="btn btn-primary" id="tambah">Submit</button>
        <h1>Data Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <?php foreach ($all_data_user as $user) : ?>
                <tr data-id="<?= $user['id'] ?>">
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['alamat'] ?></td>
                    <td>
                        <button class="btn btn-warning edit-btn">Edit</button>
                        <button class="btn btn-danger delete-btn">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editUserId">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="editEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAlamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="editAlamat" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEdit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tambah').on('click', function(event) {
                event.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var alamat = $('#alamat').val();
                $.ajax({
                    url: '<?= base_url('/add-user') ?>',
                    type: 'POST',
                    data: {
                        name: name,
                        email: email,
                        alamat: alamat
                    },
                    success: function(response) {
                        var id = response.id;
                        var newRow = '<tr data-id="' + id + '">' +
                            '<td>' + name + '</td>' +
                            '<td>' + email + '</td>' +
                            '<td>' + alamat + '</td>' +
                            '<td>' +
                            '<button class="btn btn-warning edit-btn">Edit</button>' +
                            '<button class="btn btn-danger delete-btn">Delete</button>' +
                            '</td>' +
                            '</tr>';
                        $('#userTable').append(newRow);
                        $('#name').val('');
                        $('#email').val('');
                        $('#alamat').val('');
                    }
                });
            });

            $(document).on('click', '.edit-btn', function() {
                var row = $(this).closest('tr');
                var id = row.data('id');
                var name = row.find('td:eq(0)').text();
                var email = row.find('td:eq(1)').text();
                var alamat = row.find('td:eq(2)').text();

                $('#editUserId').val(id);
                $('#editName').val(name);
                $('#editEmail').val(email);
                $('#editAlamat').val(alamat);

                $('#editUserModal').modal('show');
            });

            $('#saveEdit').on('click', function() {
                var id = $('#editUserId').val();
                var name = $('#editName').val();
                var email = $('#editEmail').val();
                var alamat = $('#editAlamat').val();
                $.ajax({
                    url: '<?= base_url('users/edit') ?>/' + id,
                    type: 'POST',
                    data: {
                        name: name,
                        email: email,
                        alamat: alamat
                    },
                    success: function(response) {
                        var row = $('tr[data-id="' + id + '"]');
                        row.find('td:eq(0)').text(name);
                        row.find('td:eq(1)').text(email);
                        row.find('td:eq(2)').text(alamat);

                        $('#editUserModal').modal('hide');
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                var row = $(this).closest('tr');
                var id = row.data('id');
                $.ajax({
                    url: '<?= base_url('users/delete') ?>/' + id,
                    type: 'GET',
                    success: function(response) {
                        row.remove();
                    }
                });
            });
        });
    </script>
</body>

</html>
