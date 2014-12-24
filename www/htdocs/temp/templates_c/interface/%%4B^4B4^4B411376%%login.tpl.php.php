<?php /* Smarty version 2.6.18, created on 2011-08-15 18:03:17
         compiled from login.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'login.tpl.php', 21, false),)), $this); ?>
<div class="loginForm">
	<div class="boxTop">
		<div class="btLeft">&#160;</div>
		<div class="btRight">&#160;</div>
	</div>
	<div class="boxContent">
	<form action="?action=signin&amp;lang=<?php if ($_GET['lang'] == ''): ?><?php echo $this->_tpl_vars['BVS_LANG']['LANGCODE']; ?>
<?php else: ?><?php echo $this->_tpl_vars['BVS_LANG']['metaLanguage']; ?>
<?php endif; ?>" enctype="multipart/form-data" name="formData" id="formData" class="form"  method="post">
		<input type="hidden" name="field[action]" id="action" value="do" />
		<div class="formRow">
			<label for="user"><?php echo $this->_tpl_vars['BVS_LANG']['lblUsername']; ?>
</label>
			<input type="text" name="field[username]" id="user" value="" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';" onblur="this.className = 'textEntry superTextEntry';" />
		</div>
		<div class="formRow">
			<label for="pwd"><?php echo $this->_tpl_vars['BVS_LANG']['lblPassword']; ?>
</label>
			<input type="password" name="field[password]" id="pwd" value="" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';" onblur="this.className = 'textEntry superTextEntry'; document.getElementById('selLibrary').focus();" />
		</div>
 		<div class="formRow">
			<label><?php echo $this->_tpl_vars['BVS_LANG']['library']; ?>
</label>
            <select name="field[selLibrary]" id="selLibrary" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblLibrary']; ?>
" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';" onblur="this.className = 'textEntry superTextEntry'; document.getElementById('btLogin').focus();">
                <option value="" label="<?php echo $this->_tpl_vars['BVS_LANG']['optSelValue']; ?>
"><?php echo $this->_tpl_vars['BVS_LANG']['optSelValue']; ?>
</option>
                <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['codesLibrary'],'selected' => $this->_tpl_vars['collectionLibrary'][$this->_tpl_vars['defaultLib']],'output' => $this->_tpl_vars['collectionLibrary']), $this);?>

            </select>
		</div>
		<div class="submitRow">
			<!--
			<div class="frLeftColumn">
				<div style="white-space: nowrap;">
					<input type="checkbox" name="setCookie" id="setCookie" value="yes" />
					<label for="setCookie" class="inline"><?php echo $this->_tpl_vars['BVS_LANG']['lblKeepMeSigned']; ?>
</label>
				</div>
				<a href="#"><?php echo $this->_tpl_vars['BVS_LANG']['lblForgetMyPassword']; ?>
?</a>
			</div>
			-->
			<div class="frRightColumn">
				<a href="javascript:doit('formData');" class="defaultButton goButton" id="btLogin">
					<img src="public/images/common/spacer.gif" alt="" title="" />
					<span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblLogIn']; ?>
</strong></span>
				</a>
			</div>
			<div class="spacer">&#160;</div>
		</div>
		<div class="spacer">&#160;</div>
	</form>
	</div>
	<div class="boxBottom">
		<div class="bbLeft">&#160;</div>
		<div class="bbRight">&#160;</div>
	</div>
</div>