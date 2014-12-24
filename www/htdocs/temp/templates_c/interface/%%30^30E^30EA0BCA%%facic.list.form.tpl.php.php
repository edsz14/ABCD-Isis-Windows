<?php /* Smarty version 2.6.18, created on 2012-06-14 09:50:06
         compiled from facic.list.form.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'facic.list.form.tpl.php', 89, false),array('modifier', 'truncate', 'facic.list.form.tpl.php', 176, false),)), $this); ?>
<form id="facicForm" class="form">

    <input type="hidden" id="formFacic_recordId" value="" />
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
                    <div class="frDataFields"><?php echo $this->_tpl_vars['OBJECTS_TITLE']['abrTitle']; ?>
</div>
                <?php endif; ?>
                <div class="spacer">&#160;</div>
            </div>
	</div>

        <div id="formRow01" class="formRow">

            <div class="fieldBlock">
                <label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblYear']; ?>
&nbsp;</strong></label>
                <input type="text" name="field[year]" id="formFacic_year" value="<?php if ($this->_tpl_vars['dataRecord']['911']): ?><?php echo $this->_tpl_vars['dataRecord']['911']; ?>
<?php elseif ($this->_tpl_vars['newDataRecord']['year']): ?><?php echo $this->_tpl_vars['newDataRecord']['year']; ?>
<?php else: ?><?php echo $_GET['yearFacic']; ?>
<?php endif; ?>" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
                <span id="formRow01_help">
                    <a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
                </span>
                <div class="helpBG" id="formRow01_helpA" style="display: none;">
                    <div class="helpArea">
                        <span class="exit"><a href="javascript:showHideDiv('formRow01_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
                        <h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [911] <?php echo $this->_tpl_vars['BVS_LANG']['lblYear']; ?>
</h2>
                        <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpFacicYear']; ?>
</div>
                    </div>
                </div>
                <div class="frDataFields">
                    <label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblVol']; ?>
&nbsp;</strong></label>
                    <input type="text" name="field[volume]" id="formFacic_volume" value="<?php if ($this->_tpl_vars['dataRecord']['912']): ?><?php echo $this->_tpl_vars['dataRecord']['912']; ?>
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
                            <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpFacicVol']; ?>
</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fieldBlock">
                <label><strong><?php echo $this->_tpl_vars['BVS_LANG']['facic']; ?>
</strong></label>
                <div class="frDataFields">
                        <input type="text" name="field[issue]" id="formFacic_issue" value="<?php if ($this->_tpl_vars['dataRecord']['913']): ?><?php echo $this->_tpl_vars['dataRecord']['913']; ?>
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
                    <select  id="formFacic_mask" name="field[codeNameMask]" class="smallTextEntry">
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
                            <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpFacicMask']; ?>
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
                    <select name="field[literatureType]" id="formFacic_pubType" class="smallTextEntry">
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
                            <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpFacicPubType']; ?>
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
                    <select name="field[status]" id="formFacic_status" class="smallTextEntry" onblur="selectNumOfCopys('status');">
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
                            <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpPubEst']; ?>
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
                    <input type="text" name="field[quantity]" id="formFacic_quantity" value="<?php if ($this->_tpl_vars['dataRecord']['915']): ?><?php echo $this->_tpl_vars['dataRecord']['915']; ?>
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
                            <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpQtd']; ?>
</div>
                        </div>
                    </div>
                </div>
                <div class="spacer">&#160;</div>
            </div>
        </div>
		
        <div id="formRow08" class="formRow">
            <label><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['BVS_LANG']['lblTextualDesignation'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 46, "...") : smarty_modifier_truncate($_tmp, 46, "...")); ?>
</strong></label>
            <div class="frDataFields">
                <input type="text" name="field[textualDesignation]" id="formFacic_textualDesignation" value="<?php if ($this->_tpl_vars['dataRecord']['925']): ?><?php echo $this->_tpl_vars['dataRecord']['925']; ?>
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
                        <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helptextualDesignation']; ?>
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
                <input type="text" name="field[standardizedDate]" id="formFacic_standardizedDate" value="<?php if ($this->_tpl_vars['dataRecord']['926']): ?><?php echo $this->_tpl_vars['dataRecord']['926']; ?>
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
                        <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpstandardizedDate']; ?>
</div>
                    </div>
                </div>
            </div>
            <div class="spacer">&#160;</div>
        </div>
		
        <!-- NAO DEIXAR ESPACO NEM QUEBRA DE LINHA ENTRE ESTE DOIS DIV A SEGUIR
            div id=template e div id=frDFRow_counter -->
        <div id="template">
            <div id="frDFRow_counter" class="formRow">
                <div class="frDataFields">
                    <input type="text" name="template_field[inventoryNumber][]" value="" id="template_formFacic_inventoryNumber_counter" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
                    <span id="template_remove_counter">
                        <a href="javascript:removeFieldInventory('frDFRow_counter');" class="singleButton eraseButton">
                            <span class="sb_lb">&#160;</span>
                            <img src="public/images/common/spacer.gif" alt="spacer" title="" /><?php echo $this->_tpl_vars['BVS_LANG']['btDeleteRecord']; ?>

                            <span class="sb_rb">&#160;</span>
                        </a>
                    </span>
                    <span id="template_insert_counter">
                        <a href="javascript:insertFieldInventoryRepeat('frDFRowIns', '_NewCounter'); " class="singleButton okButton">
                            <span class="sb_lb">&#160;</span>
                            <img src="public/images/common/spacer.gif" alt="spacer" title="" /><?php echo $this->_tpl_vars['BVS_LANG']['btInsertRecord']; ?>

                            <span class="sb_rb">&#160;</span>
                        </a>
                    </span>
                </div>
                <div class="spacer">&#160;</div>
            </div>
        </div>
		
        <div id="formRow10" class="formRow">
            <label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblInventoryNumber']; ?>
</strong></label>
            <div class="frDataFields">
                <input type="text" name="field[inventoryNumber][]" id="formFacic_inventoryNumber_0" value="" class="smallTextEntry" onfocus="this.className = 'textEntry smallTextEntry textEntryFocus';" onblur="this.className = 'smallTextEntry';" />
                <span id="formRow10_help">
                    <a href="javascript:showHideDiv('formRow10_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
                </span>
                <span id="insert_0">
                    <a href="javascript:insertFieldInventoryRepeat('frDFRowIns', 1); "  class="singleButton okButton">
                        <span class="sb_lb">&#160;</span>
                        <img src="public/images/common/spacer.gif" alt="spacer" title="" /><?php echo $this->_tpl_vars['BVS_LANG']['btInsertRecord']; ?>

                        <span class="sb_rb">&#160;</span>
                    </a>
                </span>
                <div class="helpBG" id="formRow10_helpA" style="display: none;">
                    <div class="helpArea">
                        <span class="exit"><a href="javascript:showHideDiv('formRow10_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
                        <h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [917] <?php echo $this->_tpl_vars['BVS_LANG']['lblInventoryNumber']; ?>
</h2>
                        <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpInventoryNumber']; ?>
</div>
                    </div>
                </div>
            </div>
            <div class="spacer">&#160;</div>
        </div>

        <div id="frDFRowIns"></div>
        <div id="formRow11" class="formRow">
            <label><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblEAddress']; ?>
</strong></label>
            <div class="frDataFields">
                <input type="text" name="field[eAddress]" id="formFacic_eAddress" value="<?php if ($this->_tpl_vars['dataRecord']['918']): ?><?php echo $this->_tpl_vars['dataRecord']['918']; ?>
<?php else: ?><?php echo $this->_tpl_vars['newDataRecord']['quantity']; ?>
<?php endif; ?>" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';document.getElementById('formRow11').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry superTextEntry';document.getElementById('formRow11').className = 'formRow';" />
                <span id="formRow11_help">
                        <a href="javascript:showHideDiv('formRow11_helpA')"><img src="public/images/common/icon/helper_bg.png" title="help" alt="help" /></a>
                </span>
                <div class="helpBG" id="formRow11_helpA" style="display: none;">
                    <div class="helpArea">
                        <span class="exit"><a href="javascript:showHideDiv('formRow11_helpA');" title="Fechar"><img src="public/images/common/icon/defaultButton_cancel.png" alt="cancel" /></a></span>
                        <h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - [918] <?php echo $this->_tpl_vars['BVS_LANG']['lblEAddress']; ?>
</h2>
                        <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpEAddress']; ?>
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
                <textarea name="field[notes]" id="formFacic_notes" rows="4" cols="50" class="textEntry singleTextEntry" onfocus="this.className = 'textEntry singleTextEntry textEntryFocus';document.getElementById('formRow08').className = 'formRow formRowFocus';" onblur="this.className = 'textEntry singleTextEntry';document.getElementById('formRow08').className = 'formRow';"><?php if ($this->_tpl_vars['dataRecord']['900']): ?><?php echo $this->_tpl_vars['dataRecord']['900']; ?>
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
                        <div class="help_message"><?php echo $this->_tpl_vars['BVS_LANG']['helpFacicNote']; ?>
</div>
                    </div>
                </div>
            </div>
            <div class="spacer">&#160;</div>
        </div>
        
</div>
</form>