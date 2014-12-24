<?php /* Smarty version 2.6.18, created on 2011-08-15 18:03:17
         compiled from footer.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'redirect_page', 'footer.tpl.php', 13, false),)), $this); ?>
<div class="footer">
	<div class="systemInfo">
		<strong><?php echo $this->_tpl_vars['BVS_LANG']['titleApp']; ?>
 v<?php echo $this->_tpl_vars['BVS_CONF']['version']; ?>
</strong>
		<span>&copy; <?php echo $this->_tpl_vars['BVS_CONF']['copyright']; ?>
 - <?php echo $this->_tpl_vars['BVS_LANG']['institutionName']; ?>
</span>
		<a href="<?php echo $this->_tpl_vars['BVS_LANG']['institutionURL']; ?>
" target="_blank"><?php echo $this->_tpl_vars['BVS_LANG']['institutionURL']; ?>
</a>
	</div>
	<!--div class="distributorLogo">
		<a href="<?php echo $this->_tpl_vars['BVS_CONF']['authorURI']; ?>
" target="_blank"><span><?php echo $this->_tpl_vars['BVS_CONF']['metaAuthor']; ?>
</span></a>
	</div-->
	<div class="spacer">&#160;</div>
</div>
<?php if ($this->_tpl_vars['sMessage']['success']): ?>
	<?php echo smarty_function_redirect_page(array('time' => 3,'get' => $_GET), $this);?>

<?php endif; ?>