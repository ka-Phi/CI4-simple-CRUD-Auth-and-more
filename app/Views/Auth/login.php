<?= $this->extend('layouts/base_layout') ?>

<?= $this->section('content') ?>
    <form action="<?= route_to("login") ?>" method="post">
        <input type="text" name="username">
        <input type="password" name="password">
        <buton type="submit">Login</buton>
    </form>
<?= $this->endSection() ?>