<!DOCTYPE html>
<html>
<head>
    <title>Preview Import</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h4>Preview Data Excel</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Wilayah</th>
                <th>Jenis</th>
                <th>Parent</th>
                <th>Parent_id</th>
            </tr>
        </thead>
        <tbody>

            <?php if (!empty($data)): ?>
                <?php foreach ($data as $i => $row): ?>
                    <tr>
                        <td><?= $row['id']?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['jenis'] ?></td>
                        <td><?= $row['parent'] ?></td>
                        <td><?= $row['parent_id'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>