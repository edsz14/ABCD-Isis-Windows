<?php /* Smarty version 2.6.18, created on 2011-08-15 18:03:17
         compiled from heading.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'heading.tpl.php', 11, false),)), $this); ?>
<div class="heading">
	<div class="institutionalInfo">
		<h1 class="logo"><a href="<?php echo $this->_tpl_vars['BVS_LANG']['institutionURL']; ?>
" title="<?php echo $this->_tpl_vars['BVS_LANG']['appLogo']; ?>
" target="_blank"><span><?php echo $this->_tpl_vars['BVS_LANG']['appLogo']; ?>
</span></a></h1>
		<h1><?php echo $this->_tpl_vars['BVS_LANG']['bannerTitle']; ?>
</h1>
		<h2><?php echo $this->_tpl_vars['BVS_LANG']['titleApp']; ?>
</h2>
	</div>	
	<div class="userInfo">
		<?php if ($_SESSION['identified']): ?>
			<span><?php if ($_SESSION['fullName']): ?> <?php echo $_SESSION['fullName']; ?>
 <?php else: ?> <?php echo $_SESSION['logged']; ?>
 <?php endif; ?> |</span>
            <?php if ($_GET['m'] == "" && $_SESSION['optLibrary'][1] != ""): ?>
                <?php echo ((is_array($_tmp=$_SESSION['library'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 28, "...") : smarty_modifier_truncate($_tmp, 28, "...")); ?>
 |
            <?php else: ?>
                <?php echo ((is_array($_tmp=$_SESSION['library'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 72, "...") : smarty_modifier_truncate($_tmp, 72, "...")); ?>
 |
            <?php endif; ?>

            <a href="?m=users&amp;edit=<?php echo $_SESSION['mfn']; ?>
"><?php echo $this->_tpl_vars['BVS_LANG']['myPreferences']; ?>
</a> |
	  		<a href="?action=signoff&amp;lang=<?php echo $_SESSION['lang']; ?>
" class="button_logout"><span><?php echo $this->_tpl_vars['BVS_LANG']['logOff']; ?>
</span></a>
		<?php else: ?>
		<?php if ($this->_tpl_vars['BVS_LANG']['metaLanguage'] != 'pt'): ?><a href="?lang=pt" target="_self"><?php echo $this->_tpl_vars['BVS_LANG']['portuguese']; ?>
</a> | <?php endif; ?>
		<?php if ($this->_tpl_vars['BVS_LANG']['metaLanguage'] != 'en'): ?><a href="?lang=en" target="_self"><?php echo $this->_tpl_vars['BVS_LANG']['english']; ?>
</a> | <?php endif; ?>
		<?php if ($this->_tpl_vars['BVS_LANG']['metaLanguage'] != 'es'): ?><a href="?lang=es" target="_self"><?php echo $this->_tpl_vars['BVS_LANG']['espanish']; ?>
</a> | <?php endif; ?>
		<?php if ($this->_tpl_vars['BVS_LANG']['metaLanguage'] != 'fr'): ?><a href="?lang=fr" target="_self"><?php echo $this->_tpl_vars['BVS_LANG']['french']; ?>
</a> | <?php endif; ?>
        <?php endif; ?>

	</div>
	<div class="spacer">&#160;</div>
</div>