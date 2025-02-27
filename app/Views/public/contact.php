<?= $this->extend('defaults/default') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h5>İletişim</h5> 
<?php var_dump($page["contact"]) ?>
<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?= $this->endSection() ?>
