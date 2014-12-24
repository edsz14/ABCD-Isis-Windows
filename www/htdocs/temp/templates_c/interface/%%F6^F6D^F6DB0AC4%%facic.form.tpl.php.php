<?php /* Smarty version 2.6.18, created on 2012-06-14 09:50:51
         compiled from facic.form.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'facic.form.tpl.php', 11, false),array('function', 'html_options', 'facic.form.tpl.php', 114, false),)), $this); ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>
?m=<?php echo $_GET['m']; ?>
&amp;title=<?php echo $this->_tpl_vars['titleCode']; ?>
&amp;edit=save" enctype="multipart/form-data" name="formData" id="formData" class="form"  method="post">

	<input type="hidden" name="gravar" id="gravar" value="false"/>
	<input type="hidden" name="mfn" value="<?php if ($_GET['edit']): ?><?php echo $_GET['edit']; ?>
<?php else: ?>New<?php endif; ?>"/>
	<input type="hidden" name="field[database]" value="FACIC"/>
	<input type="hidden" name="field[literatureType]" value="S"/>
	<input type="hidden" name="field[treatmentLevel]" value="F"/>
	<input type="hidden" name="field[centerCode]" value="<?php if ($this->_tpl_vars['dataRecord']['10']): ?><?php echo $this->_tpl_vars['dataRecord']['10']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['centerCode']; ?>
<?php endif; ?>"/>
	<input type="hidden" name="field[titleCode]" value="<?php if ($this->_tpl_vars['dataRecord']['30']): ?><?php echo $this->_tpl_vars['dataRecord']['30']; ?>
<?php else: ?><?php echo $this->_tpl_vars['titleCode']; ?>
<?php endif; ?>"/>	
	<input type="hidden" name="field[sequentialNumber]" value="<?php if ($this->_tpl_vars['dataRecord']['920']): ?><?php echo $this->_tpl_vars['dataRecord']['920']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['sequentialNumber']; ?>
<?php endif; ?>"/>
	<input type="hidden" name="field[creationDate]" value="<?php if ($this->_tpl_vars['dataRecord']['940']): ?><?php echo $this->_tpl_vars['dataRecord']['940']; ?>
<?php else: ?><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y%m%d") : smarty_modifier_date_format($_tmp, "%Y%m%d")); ?>
<?php endif; ?>"/>
	<?php if ($this->_tpl_vars['editRequest']): ?>
	<input type="hidden" name="field[changeDate]" value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y%m%d") : smarty_modifier_date_format($_tmp, "%Y%m%d")); ?>
"/>
	<?php endif; ?><?php echo $this->_tpl_vars['editRequest']; ?>

	<input type="hidden" name="field[documentalistCreation]" value="PFIDT"/>
	
	<div class="formHead">
	<?php if ($this->_tpl_vars['dataRecord']): ?>
		<h4><?php echo $this->_tpl_vars['BVS_LANG']['btEdFasc']; ?>
<?php echo $this->_tpl_vars['editRequest']; ?>
</h4>
	<?php else: ?>
		<h4><?php echo $this->_tpl_vars['BVS_LANG']['btAddFasc']; ?>
<?php echo $this->_tpl_vars['editRequest']; ?>
</h4>
	<?php endif; ?>

	<div id="formRowShortcut" class="formRow">
		<div class="fieldBlock">
			<?php if ($this->_tpl_vars['OBJECTS_TITLE']['pubTitle']): ?>
			<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblpublicationTitle']; ?>
</strong></label>
			<div class="frDataFields"><?php echo $this->_tpl_vars['OBJECTS_TITLE']['pubTitle']; ?>
</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['OBJECTS_TITLE']['ISSN']): ?>
			<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblissn']; ?>
</strong></label>
			<div class="frDataFields"><?php echo $this->_tpl_vars['OBJECTS_TITLE']['ISSN']; ?>
</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['OBJECTS_TITLE']['issnOnline']): ?>
			<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblissnOnline']; ?>
</strong></label>
			<div class="frDataFields"><?php echo $this->_tpl_vars['OBJECTS_TITLE']['issnOnline']; ?>
</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['OBJECTS_TITLE']['abrTitle']): ?>
			<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblabbreviatedTitle']; ?>
</strong></label>
			<div class="frDataFields">
				<?php echo $this->_tpl_vars['OBJECTS_TITLE']['abrTitle']; ?>

			</div>
			<?php endif; ?>
			<div class="spacer">&#160;</div>
		</div>
	</div>

		<div id="formRow01" class="formRow">
			<div class="fieldBlock">
				<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblYear']; ?>
</strong></label>
				<div class="frDataFields">
					<input type="text" name="field[year]" id="year" value="<?php if ($this->_tpl_vars['dataRecord']['911']): ?><?php echo $this->_tpl_vars['dataRecord']['911']; ?>
<?php elseif ($this->_tpl_vars['newDataRecord']['year']): ?><?php echo $this->_tpl_vars['newDataRecord']['year']; ?>
<?php else: ?><?php echo $_GET['yearFacic']; ?>
<?php endif; ?>" class="miniTextEntry" onfocus="this.className = 'textEntry miniTextEntryFocus';" onblur="this.className = 'miniTextEntry';" />
					<span id="formRow01_help">
						<a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
					</span>
					<div class="helpBG" id="formRow01_helpA" style="display: none;">
						<div class="helpArea">
							<span class="exit"><a href="javascript:showHideDiv('formRow01_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
							<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [911] <?php echo $this->_tpl_vars['BVS_LANG']['lblYear']; ?>
</h2>
							<div class="help_message">
								<?php echo $this->_tpl_vars['BVS_LANG']['helpFacicYear']; ?>

							</div>
						</div>
					</div>
				</div>
				<div class="spacer">&#160;</div>
			</div>

			<div class="fieldBlock">
				<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblVol']; ?>
</strong></label>
				<div class="frDataFields">
					<input type="text" name="field[volume]" id="volume" value="<?php if ($this->_tpl_vars['dataRecord']['912']): ?><?php echo $this->_tpl_vars['dataRecord']['912']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['volume']; ?>
<?php endif; ?>" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
					<span id="formRow02_help">
						<a href="javascript:showHideDiv('formRow02_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
					</span>
					<div class="helpBG" id="formRow02_helpA" style="display: none;">
						<div class="helpArea">
							<span class="exit"><a href="javascript:showHideDiv('formRow02_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
							<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [912] <?php echo $this->_tpl_vars['BVS_LANG']['lblVol']; ?>
</h2>
							<div class="help_message">
								<?php echo $this->_tpl_vars['BVS_LANG']['helpFacicVol']; ?>

							</div>
						</div>
					</div>
				</div>
				<div class="spacer">&#160;</div>
			</div>

			<div class="fieldBlock">
				<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['facic']; ?>
</strong></label>
				<div class="frDataFields">
					<input type="text" name="field[issue]" id="issue" value="<?php if ($this->_tpl_vars['dataRecord']['913']): ?><?php echo $this->_tpl_vars['dataRecord']['913']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['number']; ?>
<?php endif; ?>" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
					<span id="formRow03_help">
						<a href="javascript:showHideDiv('formRow03_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
					</span>
					<div class="helpBG" id="formRow03_helpA" style="display: none;">
						<div class="helpArea">
							<span class="exit"><a href="javascript:showHideDiv('formRow03_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
							<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [913] <?php echo $this->_tpl_vars['BVS_LANG']['facic']; ?>
</h2>
							<div class="help_message">
								<?php echo $this->_tpl_vars['BVS_LANG']['helpFacicName']; ?>

							</div>
						</div>
					</div>
				</div>
				<div class="spacer">&#160;</div>
			</div>
		
			<div class="fieldBlock">
				<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['mask']; ?>
</strong></label>
				<div class="frDataFields">
					<select id="selectMask" name="field[codeNameMask]" class="smallTextEntry">												
						<?php if ($this->_tpl_vars['dataRecord']['910']): ?>
							<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['collectionMask'],'output' => $this->_tpl_vars['collectionMask'],'selected' => $this->_tpl_vars['dataRecord']['910']), $this);?>

						<?php else: ?>
							<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['collectionMask'],'output' => $this->_tpl_vars['collectionMask'],'selected' => $this->_tpl_vars['newDataRecord']['codeNameMask']), $this);?>

						<?php endif; ?>
		 			</select>
					<span id="formRow04_help">
						<a href="javascript:showHideDiv('formRow04_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
					</span>
					<div class="helpBG" id="formRow04_helpA" style="display: none;">
						<div class="helpArea">
							<span class="exit"><a href="javascript:showHideDiv('formRow04_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
							<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [910] <?php echo $this->_tpl_vars['BVS_LANG']['mask']; ?>
</h2>
							<div class="help_message">
								<?php echo $this->_tpl_vars['BVS_LANG']['helpFacicMask']; ?>

							</div>
						</div>
					</div>
				</div>
				<div class="spacer">&#160;</div>
			</div>
		
			<div class="fieldBlock" >
				<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblPubType']; ?>
</strong></label>
				<div class="frDataFields">
					<select name="field[literatureType]" id="literatureType" class="smallTextEntry">
					<?php if ($this->_tpl_vars['dataRecord']['916']): ?>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optPubType'],'selected' => $this->_tpl_vars['dataRecord']['916']), $this);?>

					<?php else: ?>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optPubType'],'selected' => $this->_tpl_vars['newDataRecord']['publicationType']), $this);?>

					<?php endif; ?>
					</select>
					<span id="formRow05_help">
						<a href="javascript:showHideDiv('formRow05_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
					</span>
					<div class="helpBG" id="formRow05_helpA" style="display: none;">
						<div class="helpArea">
							<span class="exit"><a href="javascript:showHideDiv('formRow05_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
							<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [916] <?php echo $this->_tpl_vars['BVS_LANG']['lblPubType']; ?>
</h2>
							<div class="help_message">
								<?php echo $this->_tpl_vars['BVS_LANG']['helpFacicPubType']; ?>

							</div>
						</div>
					</div>
				</div>
				<div class="spacer">&#160;</div>
			</div>
			<div class="fieldBlock">
				<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblPubSt']; ?>
</strong></label>
				<div class="frDataFields">
					<select name="field[status]" id="status" class="smallTextEntry" onblur="selectNumOfCopys('status');">
					<?php if ($this->_tpl_vars['dataRecord']['914']): ?>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optPubSt'],'selected' => $this->_tpl_vars['dataRecord']['914']), $this);?>

					<?php else: ?>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optPubSt'],'selected' => $this->_tpl_vars['newDataRecord']['status']), $this);?>

					<?php endif; ?>
					</select>
					<span id="formRow06_help">
						<a href="javascript:showHideDiv('formRow06_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
					</span>
					<div class="helpBG" id="formRow06_helpA" style="display: none;">
						<div class="helpArea">
							<span class="exit"><a href="javascript:showHideDiv('formRow06_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
							<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [914] <?php echo $this->_tpl_vars['BVS_LANG']['lblPubEst']; ?>
</h2>
							<div class="help_message">
								<?php echo $this->_tpl_vars['BVS_LANG']['helpPubEst']; ?>

							</div>
						</div>
					</div>
				</div>
				<div class="spacer">&#160;</div>
			</div>

			<div class="fieldBlock">
				<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblQtd']; ?>
</strong></label>
				<div class="frDataFields">
					<input type="text" name="field[quantity]" id="quantity" value="<?php if ($this->_tpl_vars['dataRecord']['915']): ?><?php echo $this->_tpl_vars['dataRecord']['915']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['quantity']; ?>
<?php endif; ?>" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
					<span id="formRow07_help">
						<a href="javascript:showHideDiv('formRow07_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
					</span>
					<div class="helpBG" id="formRow07_helpA" style="display: none;">
						<div class="helpArea">
							<span class="exit"><a href="javascript:showHideDiv('formRow07_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
							<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [915] <?php echo $this->_tpl_vars['BVS_LANG']['lblQtd']; ?>
</h2>
							<div class="help_message">
								<?php echo $this->_tpl_vars['BVS_LANG']['helpQtd']; ?>

							</div>
						</div>
					</div>
				</div>
				<div class="spacer">&#160;</div>
			</div>
			<div class="spacer">&#160;</div>
		</div>
	</div>
	
<div class="formContent">		

		<div id="formRow08" class="formRow">
			<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblTextualDesignation']; ?>
</strong></label>
			<div class="frDataFields">
				<input type="text" name="field[textualDesignation]" id="textualDesignation" value="<?php if ($this->_tpl_vars['dataRecord']['925']): ?><?php echo $this->_tpl_vars['dataRecord']['925']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['textualDesignation']; ?>
<?php endif; ?>" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
				<span id="formRow08_help">
					<a href="javascript:showHideDiv('formRow08_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
				</span>

				<div class="helpBG" id="formRow08_helpA" style="display: none;">
					<div class="helpArea">
						<span class="exit"><a href="javascript:showHideDiv('formRow08_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
						<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [925] <?php echo $this->_tpl_vars['BVS_LANG']['lblTextualDesignation']; ?>
</h2>
						<div class="help_message">
							<?php echo $this->_tpl_vars['BVS_LANG']['helptextualDesignation']; ?>

						</div>
					</div>
				</div>
			</div>

			<div class="spacer">&#160;</div>
		</div>

        <div id="formRow09" class="formRow">
	        <label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblStandardizedDate']; ?>
</strong></label>
	        <div class="frDataFields">
	                <input type="text" name="field[standardizedDate]" id="standardizedDate" value="<?php if ($this->_tpl_vars['dataRecord']['926']): ?><?php echo $this->_tpl_vars['dataRecord']['926']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['standardizedDate']; ?>
<?php endif; ?>" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
	                <span id="formRow09_help">
	                        <a href="javascript:showHideDiv('formRow09_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
	                </span>
	                <div class="helpBG" id="formRow09_helpA" style="display: none;">
	                        <div class="helpArea">
	                                <span class="exit"><a href="javascript:showHideDiv('formRow09_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
	                                <h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [926] <?php echo $this->_tpl_vars['BVS_LANG']['lblStandardizedDate']; ?>
</h2>
	                                <div class="help_message">
	                                        <?php echo $this->_tpl_vars['BVS_LANG']['helpstandardizedDate']; ?>

	                                </div>
	                        </div>
	                </div>
	        </div>
	        <div class="spacer">&#160;</div>
        </div>
		
		
		
		<div id="formRow10" class="formRow">
			<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblInventoryNumber']; ?>
</strong></label>
			<div class="frDataFields">
				<input type="text" name="field[inventoryNumber]" id="inventoryNumber" value="<?php if ($this->_tpl_vars['dataRecord']['917']): ?><?php echo $this->_tpl_vars['dataRecord']['915']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['quantity']; ?>
<?php endif; ?>" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
				<span id="formRow10_help">
					<a href="javascript:showHideDiv('formRow10_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
				</span>
				<div class="helpBG" id="formRow10_helpA" style="display: none;">
					<div class="helpArea">
						<span class="exit"><a href="javascript:showHideDiv('formRow10_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
						<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [917] <?php echo $this->_tpl_vars['BVS_LANG']['lblInventoryNumber']; ?>
</h2>
						<div class="help_message">
							<?php echo $this->_tpl_vars['BVS_LANG']['helpInventoryNumber']; ?>

						</div>
					</div>
				</div>
			</div>
			<div class="spacer">&#160;</div>
		</div>
	
		<div id="formRow11" class="formRow">
			<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblEAddress']; ?>
</strong></label>
			<div class="frDataFields">
				<input type="text" name="field[eAddress]" id="eAddress" value="<?php if ($this->_tpl_vars['dataRecord']['918']): ?><?php echo $this->_tpl_vars['dataRecord']['918']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['quantity']; ?>
<?php endif; ?>" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow010').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow010').className = 'formRow';" />
				<span id="formRow11_help">
					<a href="javascript:showHideDiv('formRow11_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
				</span>
				<div class="helpBG" id="formRow11_helpA" style="display: none;">
					<div class="helpArea">
						<span class="exit"><a href="javascript:showHideDiv('formRow11_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
						<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [918] <?php echo $this->_tpl_vars['BVS_LANG']['lblEAddress']; ?>
</h2>
						<div class="help_message">
							<?php echo $this->_tpl_vars['BVS_LANG']['helpEAddress']; ?>

						</div>
					</div>
				</div>
			</div>
			<div class="spacer">&#160;</div>
		</div>

		<div id="formRow12" class="formRow">
			<label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblNote']; ?>
</strong></label>
			<div class="frDataFields">
				<textarea name="field[notes]" id="field12" rows="4" cols="50" class="textEntry singleTextEntry" onfocus="this.className = 'textEntry singleTextEntry textEntryFocus';document.getElementById('formRow08').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry singleTextEntry';document.getElementById('formRow08').className = 'formRow';"><?php if ($this->_tpl_vars['dataRecord']['900']): ?><?php echo $this->_tpl_vars['dataRecord']['900']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['notes']; ?>
<?php endif; ?></textarea>
				<span id="formRow12_help">
					<a href="javascript:showHideDiv('formRow12_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
				</span>
				<div class="helpBG" id="formRow12_helpA" style="display: none;">
					<div class="helpArea">
						<span class="exit"><a href="javascript:showHideDiv('formRow12_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
						<h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [900] <?php echo $this->_tpl_vars['BVS_LANG']['lblNote']; ?>
</h2>
						<div class="help_message">
							<?php echo $this->_tpl_vars['BVS_LANG']['helpFacicNote']; ?>

						</div>
					</div>
				</div>
			</div>
			<div class="spacer">&#160;</div>
		</div>


</div>
	
</form>