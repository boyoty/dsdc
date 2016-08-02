<?php
foreach ($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach;?>
<?php foreach ($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach;?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
<div class="box box-success">
	<div class="box-header">
        <i class="fa fa-sign-in"></i>
		<h3 class="box-title"><?php echo $this->systemmodel->get_menuname($this->uri->segment(1) . '/' . $this->uri->segment(2)); ?></h3>
	</div>
	<div class="box-body">
		<?php echo $output; ?>
	</div>
</div>