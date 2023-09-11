<?= $this->extend('layouts/base_layout') ?>

<?= $this->section('content') ?>
nama : <?= $account['username'] ?>
<br>
point : <?= $account['point'] ?>
<br>
status : <?= $account['status'] ?>
<br>
create at : <?= $account['created_at'] ?>
<br>
update at : <?= $account['updated_at'] ?>
<br>
<br>
<br>
<a href="/user/update/<?= $account['id'] ?>">Update</a>
<br>
<form action="/user/delete/<?= $account['id'] ?>" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" onclick="return confirm('apakah anda yakin ingin menghapus?')">Delete</button>
</form>
<br>
<a href="/">kembali</a>
<?= $this->endSection() ?>