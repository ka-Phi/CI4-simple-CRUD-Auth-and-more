<?= $this->extend('layouts/base_layout') ?>

<?= $this->section('content') ?>
<form action="/user/do_add" method="POST" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <?php if(session()->has('errors')) : ?>
        <?php foreach (session('errors') as $error) : ?>
            <p><?= $error ?></p>
        <?php endforeach ?>
    <?php endif ?>
    file : <input type="file" name="image" id="image" onchange="imgLoader()">
    <img src="image/image.png" id="img-preview" alt="">
    <br>
    username : <input type="text" name="username" value="<?= old('username') ?>">
    <br>
    password : <input type="password" name="password" value="<?= old('password') ?>">
    <br>
    <button type="submit">SUBMIT</button>
</form>
<?= $this->endSection() ?>
serius