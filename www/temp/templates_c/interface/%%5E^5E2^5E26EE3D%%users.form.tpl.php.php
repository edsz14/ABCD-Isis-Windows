<?php /* Smarty version 2.6.18, created on 2012-12-27 06:47:39
         compiled from users.form.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'users.form.tpl.php', 129, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['dataRecord']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <?php $this->assign($this->_tpl_vars['k'], $this->_tpl_vars['v']); ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($_SESSION['logged'] == $this->_tpl_vars['1'][0] || $_SESSION['role'] == 'Administrator'): ?>
<div class="yui-skin-sam">

<div id="collectionDialog" >
      <div class="hd"><?php echo $this->_tpl_vars['BVS_LANG']['titleApp']; ?>
</div>
        <div class="bd">
        <div id="collectionDisplayed"></div>
      </div>
    </div>
</div>
<script type="text/javascript">

YAHOO.widget.DataTable.MSG_LOADING = "<div class='loading'><div><?php echo $this->_tpl_vars['BVS_LANG']['MSG_LOADING']; ?>
</div></div>";
YAHOO.widget.DataTable.MSG_ERROR = "<?php echo $this->_tpl_vars['BVS_LANG']['MSG_ERROR']; ?>
";

<?php echo '
YAHOO.namespace("example.container");

function init() {
	var handleOK = function() {
		window.location.reload();
	};
        
	YAHOO.example.container.collectionDialog = new YAHOO.widget.Dialog("collectionDialog",
							{ width : "50em",
							  fixedcenter : true,
							  visible : false,
							  constraintoviewport : true,
							  buttons : [ { text:"OK", handler:handleOK } ]
							});

	YAHOO.example.container.collectionDialog.render();
}
YAHOO.util.Event.onDOMReady(init);
'; ?>

</script>

<div id="listRecords" class="listTable"></div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>
?m=<?php echo $_GET['m']; ?>
&amp;edit=save" enctype="multipart/form-data" name="formData" id="formData" class="form"  method="post" >	

<div class="formHead">
	<?php if ($_GET['edit']): ?>
	<input type="hidden" name="mfn" value="<?php echo $_GET['edit']; ?>
"/>
	<?php endif; ?>
	<input type="hidden" name="gravar" id="gravar" value="false"/>
        <input type="hidden"  name="myRole" id="myRole" value="<?php echo $_SESSION['role']; ?>
"/>

	<div id="formRow01" class="formRow" <?php if ($_SESSION['role'] != 'Administrator'): ?>style="display: none;"<?php endif; ?>>
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lblUsername']; ?>
</label>
		<div class="frDataFields">
			<input  type="text" name="field[username]" id="username" value="<?php echo $this->_tpl_vars['1'][0]; ?>
"  title="* <?php echo $this->_tpl_vars['BVS_LANG']['lblUsername']; ?>
" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow01').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow01').className = 'formRow';"  />
			<div class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperUserName']; ?>
</div>
			<div id="usernameError" style="display: none;" class="inlineError"><?php echo $this->_tpl_vars['BVS_LANG']['requiredField']; ?>
</div>
			<span id="formRow01_help">
				<a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow01_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow01_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [1] <?php echo $this->_tpl_vars['BVS_LANG']['lblUsername']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpUser']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>
	
	<div id="formRow02" class="formRow" >
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lblPassword']; ?>
</label>
		<div class="frDataFields">
			<input type="password" name="field[passwd]" id="passwd" value="" title="*  <?php echo $this->_tpl_vars['BVS_LANG']['lblPassword']; ?>
" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow02').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow02').className = 'formRow';"  />
			<div class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperUserName']; ?>
</div>
			<div id="passwdError" style="display: none;" class="inlineError"><?php echo $this->_tpl_vars['BVS_LANG']['requiredField']; ?>
</div>
			<div id="difPasswdError" style="display: none;" class="inlineError"><?php echo $this->_tpl_vars['BVS_LANG']['difPass']; ?>
</div>
			<span id="formRow02_help">
				<a href="javascript:showHideDiv('formRow02_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow02_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow02_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [3] <?php echo $this->_tpl_vars['BVS_LANG']['lblPassword']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpPassword']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>

	<div id="formRow03" class="formRow">
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lblcPassword']; ?>
</label>
		<div class="frDataFields">
			<input type="password" name="cpasswd" id="cpasswd" value="" title="*  <?php echo $this->_tpl_vars['BVS_LANG']['lblcPassword']; ?>
" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow03').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow03').className = 'formRow'; " />
			<div class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperUserName']; ?>
</div>
			<div id="cpasswdError" style="display: none;" class="inlineError"><?php echo $this->_tpl_vars['BVS_LANG']['requiredField']; ?>
</div>
			<span id="formRow03_help">
				<a href="javascript:showHideDiv('formRow02_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow03_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow03_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [3] <?php echo $this->_tpl_vars['BVS_LANG']['lblcPassword']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpcPassword']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>

<?php if ($_GET['edit'] != 1): ?>
<div id="formRow14" class="formRow" <?php if ($_SESSION['role'] != 'Administrator'): ?>style="display: none;"<?php endif; ?>>
        <label for="role"><?php echo $this->_tpl_vars['BVS_LANG']['lblRole']; ?>
</label>
            <div class="frDataFields">
                <div class="frDFRow">
                    <div id="roleLib">
                        <!-- Role -->
                        <div class="frDFColumn">
                            <label class="inline"><?php echo $this->_tpl_vars['BVS_LANG']['lblRole']; ?>
</label><br/>
                            <select name="role" id="role" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblRole']; ?>
" class="textEntry">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optRole']), $this);?>

                            </select>
                            <a href="javascript:showHideDiv('formRow04_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help"/></a>
                        </div>
                        <!-- /Role -->
                        <!-- Library -->
                        <div class="frDFColumn">
                            <label class="inline"><?php echo $this->_tpl_vars['BVS_LANG']['lblLibrary']; ?>
</label><br/>
                            <select name="library" id="library" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblLibrary']; ?>
" class="textEntry">
                                <option value="" label="<?php echo $this->_tpl_vars['BVS_LANG']['optSelValue']; ?>
" selected="selected"><?php echo $this->_tpl_vars['BVS_LANG']['optSelValue']; ?>
</option>
                                <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['codesLibrary'],'output' => $this->_tpl_vars['collectionLibrary']), $this);?>

                            </select>
                            <a href="javascript:showHideDiv('formRow05_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help"/></a>
                        </div>
                        <!-- /Library -->
                        <!-- Help -->
                        <div class="helpBG" id="formRow04_helpA" style="display: none;">
                            <div class="helpArea">
                                <span class="exit"><a href="javascript:showHideDiv('formRow04_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png"></a></span>
                                <h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [4] <?php echo $this->_tpl_vars['BVS_LANG']['lblRole']; ?>
</h2>
                                <div class="help_message">
                                    <?php echo $this->_tpl_vars['BVS_LANG']['helpRole']; ?>

                                </div>
                            </div>
                        </div>
                        <div class="helpBG" id="formRow05_helpA" style="display: none;">
                            <div class="helpArea">
                                <span class="exit"><a href="javascript:showHideDiv('formRow05_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png"></a></span>
                                <h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [5] <?php echo $this->_tpl_vars['BVS_LANG']['lblLibrary']; ?>
</h2>
                                <div class="help_message">
                                    <?php echo $this->_tpl_vars['BVS_LANG']['helpLibrary']; ?>

                                </div>
                            </div>
                        </div>
                        <!-- /Help -->
                        <div class="spacer">&#160;</div>
                        <a href="javascript:InsertLineSelect('role', 'library', '<?php echo $_SESSION['lang']; ?>
');" class="singleButton okButton">
                            <span class="sb_lb">&#160;</span>
                            <img src="public/images/common/spacer.gif" title="spacer" />
                            <?php echo $this->_tpl_vars['BVS_LANG']['btInsertRecord']; ?>

                            <span class="sb_rb">&#160;</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php unset($this->_sections['iten']);
$this->_sections['iten']['name'] = 'iten';
$this->_sections['iten']['loop'] = is_array($_loop=$this->_tpl_vars['4']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iten']['show'] = true;
$this->_sections['iten']['max'] = $this->_sections['iten']['loop'];
$this->_sections['iten']['step'] = 1;
$this->_sections['iten']['start'] = $this->_sections['iten']['step'] > 0 ? 0 : $this->_sections['iten']['loop']-1;
if ($this->_sections['iten']['show']) {
    $this->_sections['iten']['total'] = $this->_sections['iten']['loop'];
    if ($this->_sections['iten']['total'] == 0)
        $this->_sections['iten']['show'] = false;
} else
    $this->_sections['iten']['total'] = 0;
if ($this->_sections['iten']['show']):

            for ($this->_sections['iten']['index'] = $this->_sections['iten']['start'], $this->_sections['iten']['iteration'] = 1;
                 $this->_sections['iten']['iteration'] <= $this->_sections['iten']['total'];
                 $this->_sections['iten']['index'] += $this->_sections['iten']['step'], $this->_sections['iten']['iteration']++):
$this->_sections['iten']['rownum'] = $this->_sections['iten']['iteration'];
$this->_sections['iten']['index_prev'] = $this->_sections['iten']['index'] - $this->_sections['iten']['step'];
$this->_sections['iten']['index_next'] = $this->_sections['iten']['index'] + $this->_sections['iten']['step'];
$this->_sections['iten']['first']      = ($this->_sections['iten']['iteration'] == 1);
$this->_sections['iten']['last']       = ($this->_sections['iten']['iteration'] == $this->_sections['iten']['total']);
?>
            <div class="frDataFields">
                <div class="frDFRow">
                    <div id="roleLib">
                        <div id="frDataFieldsRole<?php echo $this->_sections['iten']['index']; ?>
" class="frDFColumn">
                            <input type="text" name="field[role][]" id="role" value="<?php echo $this->_tpl_vars['4'][$this->_sections['iten']['index']]; ?>
" readonly="readonly" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblRole']; ?>
" class="textEntry">
                        </div>
                        <div id="frDataFieldsLibrary<?php echo $this->_sections['iten']['index']; ?>
" class="frDFColumn">
                            <input type="text" name="field[library][]" id="library" value="<?php echo $this->_tpl_vars['5'][$this->_sections['iten']['index']]; ?>
" readonly="readonly" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblLibrary']; ?>
" class="textEntry" >
                            <input type="hidden" name="field[libraryDir][]" id="libraryDir" value="<?php echo $this->_tpl_vars['6'][$this->_sections['iten']['index']]; ?>
" readonly="readonly">
                            <a href="javascript:removeRow('frDataFieldsRole<?php echo $this->_sections['iten']['index']; ?>
'); removeRow('frDataFieldsLibrary<?php echo $this->_sections['iten']['index']; ?>
');" class="singleButton eraseButton">
                                <span class="sb_lb">&#160;</span>
                                <img src="public/images/common/spacer.gif" title="spacer" /><?php echo $this->_tpl_vars['BVS_LANG']['btDeleteRecord']; ?>

                                <span class="sb_rb">&#160;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; else: ?>
                <?php if ($this->_tpl_vars['4']): ?>
                <div class="frDataFields">
                    <div class="frDFRow">
                        <div id="roleLib">
                            <div id="frDataFieldsrolep" class="frDFColumn">
                                <select name="field[role][]" id="role" readonly="readonly" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblRole']; ?>
" class="textEntry">
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optRole'],'selected' => $this->_tpl_vars['4'][$this->_sections['iten']['index']]), $this);?>

                                </select>
                            </div>
                            <div id="frDataFieldslibraryp" class="frDFColumn">
                                <select name="field[library][]" id="library" readonly="readonly" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblLibrary']; ?>
" class="textEntry">
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optRole'],'selected' => $this->_tpl_vars['5'][$this->_sections['iten']['index']]), $this);?>

                                </select>
                                <a href="javascript:removeRow('frDataFieldsLibraryp'); removeRow('frDataFieldsRolep');" class="singleButton eraseButton">
                                    <span class="sb_lb">&#160;</span>
                                    <img src="public/images/common/spacer.gif" title="spacer" /><?php echo $this->_tpl_vars['BVS_LANG']['btDeleteRecord']; ?>

                                    <span class="sb_rb">&#160;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
            <div id="frDataFieldsrole" style="display:block!important">&#160;</div>
        <div class="spacer">&#160;</div>
    </div>
   <div class="spacer">&#160;</div>
<?php endif; ?>


</div>
<div class="formContent">
	<div id="formRow06" class="formRow">
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lblFullname']; ?>
</label>
		<div class="frDataFields">
			<input type="text" name="field[fullname]" id="fullname" value="<?php echo $this->_tpl_vars['8'][0]; ?>
" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow06').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow06').className = 'formRow';" />
			<div id="fullnameError" style="display: none;" class="inlineError"><?php echo $this->_tpl_vars['BVS_LANG']['requiredField']; ?>
</div>
			<span id="formRow06_help">
				<a href="javascript:showHideDiv('formRow06_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow06_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow06_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [8] <?php echo $this->_tpl_vars['BVS_LANG']['lblFullname']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpFullname']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>

	<div id="formRow07" class="formRow" <?php if ($_SESSION['role'] != 'Administrator'): ?>style="display: none;"<?php endif; ?>>
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lblUsersAcr']; ?>
</label>
		<div class="frDataFields">
			<input type="text" name="field[userAcr]" id="userAcr" value="<?php echo $this->_tpl_vars['2'][0]; ?>
" title="*  <?php echo $this->_tpl_vars['BVS_LANG']['lblUsersAcr']; ?>
" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow07').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow07').className = 'formRow';" />
			<div class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperUserName']; ?>
</div>
			<div id="userAcrError" style="display: none;" class="inlineError"><?php echo $this->_tpl_vars['BVS_LANG']['requiredField']; ?>
</div>
			<span id="formRow07_help">
				<a href="javascript:showHideDiv('formRow07_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow07_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow07_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [2] <?php echo $this->_tpl_vars['BVS_LANG']['lblUsersAcr']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpUsersAcr']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>


	<div id="formRow04" class="formRow" >
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lblEmail']; ?>
</label>
		<div class="frDataFields">
			<input name="field[email]" id="email" value="<?php echo $this->_tpl_vars['11'][0]; ?>
" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow04').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow04').className = 'formRow';" />
			<div id="emailError" style="display: none;" class="inlineError"><?php echo $this->_tpl_vars['BVS_LANG']['requiredField']; ?>
</div>
			<span id="formRow04_help">
				<a href="javascript:showHideDiv('formRow04_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow04_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow04_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [11] <?php echo $this->_tpl_vars['BVS_LANG']['lblEmail']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpEmail']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>

   
	<div id="formRow08" class="formRow" <?php if ($_SESSION['role'] != 'Administrator'): ?>style="display: none;"<?php endif; ?>>
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lblInstitution']; ?>
</label>
		<div class="frDataFields">
			<input type="text" name="field[institution]" id="institution" value="<?php echo $this->_tpl_vars['9'][0]; ?>
" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow08').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow08').className = 'formRow';" />
			<div class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperUserName']; ?>
</div>
			<div id="institutionError" style="display: none;" class="inlineError"><?php echo $this->_tpl_vars['BVS_LANG']['requiredField']; ?>
</div>
			<span id="formRow08_help">
				<a href="javascript:showHideDiv('formRow08_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow08_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow08_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [9] <?php echo $this->_tpl_vars['BVS_LANG']['lblInstitution']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpInstitution']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>

	<div id="formRow10" class="formRow" <?php if ($_SESSION['role'] != 'Administrator'): ?>style="display: none;"<?php endif; ?>>
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lblNotes']; ?>
</label>
		<div class="frDataFields">
			<textarea name="field[notes]" id="notes" class="textEntry singleTextEntry" rows="4" cols="50" onfocus="this.className = 'textEntry singleTextEntry textEntryFocus';document.getElementById('formRow10').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry singleTextEntry';document.getElementById('formRow10').className = 'formRow';" ><?php echo $this->_tpl_vars['10'][0]; ?>
</textarea>
			<span id="formRow10_help">
				<a href="javascript:showHideDiv('formRow10_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow10_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow10_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [10] <?php echo $this->_tpl_vars['BVS_LANG']['lblNotes']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpNotes']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>

        <?php if ($_SESSION['role'] != 'Administrator' || $_GET['edit'] == 1): ?>
    	<div id="formRow01" class="formRow" >
		<label><?php echo $this->_tpl_vars['BVS_LANG']['lang']; ?>
</label>
		<div class="frDataFields">
                    <?php if ($this->_tpl_vars['BVS_LANG']['metaLanguage'] != 'pt'): ?><a href="#" onclick="changeLanguage('pt','3','<?php echo $_SESSION['mfn']; ?>
');" target="_self"><?php echo $this->_tpl_vars['BVS_LANG']['portuguese']; ?>
</a> |<?php endif; ?>
            <?php if ($this->_tpl_vars['BVS_LANG']['metaLanguage'] != 'en'): ?><a href="#" onclick="changeLanguage('en','3','<?php echo $_SESSION['mfn']; ?>
');" target="_self"><?php echo $this->_tpl_vars['BVS_LANG']['english']; ?>
</a> | <?php endif; ?>
            <?php if ($this->_tpl_vars['BVS_LANG']['metaLanguage'] != 'es'): ?><a href="#" onclick="changeLanguage('es','3','<?php echo $_SESSION['mfn']; ?>
');" target="_self"><?php echo $this->_tpl_vars['BVS_LANG']['espanish']; ?>
</a> | <?php endif; ?>
            <?php if ($this->_tpl_vars['BVS_LANG']['metaLanguage'] != 'fr'): ?><a href="#" onclick="changeLanguage('fr','3','<?php echo $_SESSION['mfn']; ?>
');" target="_self"><?php echo $this->_tpl_vars['BVS_LANG']['french']; ?>
</a><?php endif; ?>
			<span id="formRow01_help">
				<a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" /></a>
			</span>
		</div>
		<div class="helpBG" id="formRow01_helpA" style="display: none;">
			<div class="helpArea">
				<span class="exit"><a href="javascript:showHideDiv('formRow01_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" /></a></span>
				<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - <?php echo $this->_tpl_vars['BVS_LANG']['lang']; ?>
</h2>
				<div class="help_message">
					<?php echo $this->_tpl_vars['BVS_LANG']['helpLang']; ?>

				</div>
			</div>
		</div>
		<div class="spacer">&#160;</div>
	</div>
        <?php endif; ?>
	
</div>
</form>
<?php else: ?>
    <div id="middle" class="middle message mAlert">
        <img src="public/images/common/spacer.gif" alt="" title="" />
        <div class="mContent">
            <h4><?php echo $this->_tpl_vars['BVS_LANG']['mFail']; ?>
</h4>
            <p><strong><?php echo $this->_tpl_vars['sMessage']['message']; ?>
</strong></p>
            <p><strong><?php echo $this->_tpl_vars['BVS_LANG']['msg_op_fail']; ?>
</strong></p>
            <div>
                <code><?php echo $this->_tpl_vars['BVS_LANG']['error404']; ?>
</code>
            </div>
            <span><a href="index.php"><strong><?php echo $this->_tpl_vars['BVS_LANG']['btBackAction']; ?>
</strong></a></span>
        </div>
        <div class="spacer">&#160;</div>
    </div>
<?php endif; ?>