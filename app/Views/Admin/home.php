<?= $this->extend('layouts/base_layout') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('pesan')) :?>
    <br>
    <span><?= session()->getFlashdata('pesan'); ?></span>
    <br>
<?php endif ?>
<a href="/user/add">TAMBAH USER</a>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Nama</th>
                <th>gambar</th>
                <th>point</th>
                <th>status</th>
                <th>create</th>
                <th>update</th>
                <th>delete</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($account as $a) :?>
                <tr>    
                <td><?= $a['username'] ?></td>
                <td><img src="image/<?= $a['image'] ?>" alt="<?= $a['image'] ?>"></td>
                <td><?= $a['point'] ?></td>
                <td><?= $a['status'] ?></td>
                <td><?= $a['created_at'] ?></td>
                <td><?= $a['updated_at'] ?></td>
                <td><?= $a['deleted_at'] ?></td>
                <td><a href="/user/<?= $a['id'] ?>">DETAIL</a></td>
                <!-- <td><a href="/user_no_query/<= $a ?>">DETAIL</a></td> -->
            <?php endforeach ?>
            </tr>
        </tbody>
        
    </table>
<?= $this->endSection() ?>