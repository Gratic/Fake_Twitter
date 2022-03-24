<?php if (session('succes')): ?>
	<p><?php echo session('succes'); ?></p>
<?php endif; ?>

<?php if (session('erreur')): ?>
	<p><?php echo session('erreur'); ?></p>
<?php endif; ?>