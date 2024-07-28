<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <h1>Tambah Data User DummyJSON</h1>
        <form action="/user/add" method="post">
            <div class="mb-3">
                <label for="firstName" class="form-label">Nama Depan</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Nama depan" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Nama Belakang</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Nama belakang" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <h1>Data Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <?php foreach ($users['users'] as $user) : ?>
                <tr>
                    <td><?= esc($user['firstName']) . ' ' . esc($user['lastName']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= esc($user['age']) ?></td>
                    <td>
                        <form action="/user/update/<?= $user['id'] ?>" method="post">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                        <form action="/user/delete/<?= $user['id'] ?>" method="post">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Y7AO0Lr6NsZQO6jFfiP0fqHQvDrIMbHGEZSp5jURUpkt5l5GpxTfXcc5mnmfnWMA" crossorigin="anonymous"></script>
</body>

</html>
