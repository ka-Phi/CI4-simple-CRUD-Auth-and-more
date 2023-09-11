<?= $this->extend('layouts/base_layout') ?>

<?= $this->section('content') ?>
<form action="/user/do_update/<?= $account['id'] ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <?= $validation->listErrors(); ?>
    <?= $validation->getError('username') ?>
    <input type="hidden" name="oldImage" value="<?= $account['image']; ?>">
    file : <input type="file" name="image" id="image"` onchange="imgLoader()">
    <img src="image/<?= $account['image'] ?>" id="img-preview" alt="">
    <br>
    username : <input type="text" name="username" value="<?= old('username') ? old('username') : $account['username'] ?>" id="">
    <br>
    password : <input type="password" name="password" value="<?= old('password') ? old('password') : $account['password'] ?>" id="">
    <br>
    point : <input type="number" name="point" value="<?= old('point') ? old('point') : $account['point'] ?>" id="">
    <br>
    status : <input type="number" name="status" value="<?= old('status') ? old('status') : $account['status'] ?>" id="">
    <br>
    <button type="submit">SUBMIT</button>
</form>
<?= $this->endSection() ?>