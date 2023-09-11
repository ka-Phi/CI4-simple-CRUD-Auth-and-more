<?= $this->extend('layouts/base_layout') ?>

<?= $this->section('content') ?>
    <form action="<?= route_to("register") ?>" method="post">
        <input type="text" name="username">
        <input type="password" name="password">
        <buton type="submit">register</buton>
    </form>
<?= $this->endSection() ?>