<?php /* Smarty version 2.6.18, created on 2014-12-20 19:13:32
         compiled from navigation.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'breadcrumb', 'navigation.tpl.php', 3, false),array('function', 'html_options', 'navigation.tpl.php', 130, false),)), $this); ?>
<div class="sectionInfo">
    <div class="breadcrumb">
        <?php echo smarty_function_breadcrumb(array('total' => $this->_tpl_vars['totalRecords']), $this);?>

    </div>
	
	<?php if ($_SESSION['identified']): ?>
		<div id="actionsButtons" class="actions">
		<?php if (! isset ( $this->_tpl_vars['sMessage'] )): ?>	
			<?php if ($_GET['edit'] || $_GET['action']): ?>
				<?php if ($_GET['m'] == 'title'): ?>
				<div id="BackNext" style="display:none">
                                    <a href="javascript: desligabloco2();" class="defaultButton multiLine nextButton">
                                        <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="" />
                                        <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['btNext']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['btStep']; ?>
</span>
                                    </a>
				</div>
				<?php endif; ?>
				<a href="javascript: submitForm('<?php echo $_GET['m']; ?>
', '<?php echo $_SESSION['lang']; ?>
');"  class="defaultButton saveButton" >
					<img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="<?php echo $this->_tpl_vars['BVS_LANG']['btSaveRecord']; ?>
" />
					<span><strong><?php echo $this->_tpl_vars['BVS_LANG']['btSaveRecord']; ?>
</strong></span>
				</a>

				<a href="javascript:cancelAction('?m=<?php echo $this->_tpl_vars['listRequest']; ?>
<?php if ($this->_tpl_vars['titleCode']): ?>&amp;title=<?php echo $this->_tpl_vars['titleCode']; ?>
<?php endif; ?><?php if ($_GET['searchExpr']): ?>&amp;searchExpr=<?php echo $_GET['searchExpr']; ?>
<?php endif; ?>')" id="cancelButton" class="defaultButton cancelButton">
					<img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" />
					<span><strong><?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
</strong></span>
				</a>
			<?php else: ?>
				<?php if ($_GET['m']): ?>
					<?php if ($this->_tpl_vars['listRequestReport'] != 'report' && $_GET['m'] != 'facic' && $_GET['m'] != 'titleplus'): ?>
						<!--a href="?m=<?php echo $this->_tpl_vars['listRequest']; ?>
<?php if ($this->_tpl_vars['titleCode']): ?>&amp;title=<?php echo $this->_tpl_vars['titleCode']; ?>
<?php endif; ?>&amp;action=new" class="defaultButton multiLine newButton" <?php if ($this->_tpl_vars['titleCode']): ?> OnClick="javascript: desligabloco1();" <?php endif; ?>-->
                                            <?php if ($_GET['m'] == 'title'): ?>
                                                <?php if ($_SESSION['role'] == 'Administrator'): ?>
                                                    <a href="?m=<?php echo $this->_tpl_vars['listRequest']; ?>
<?php if ($this->_tpl_vars['titleCode']): ?>&amp;title=<?php echo $this->_tpl_vars['titleCode']; ?>
<?php endif; ?>&amp;action=new" id="show" class="defaultButton multiLine newButton">
                                                        <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="" />
                                                        <span><?php echo $this->_tpl_vars['BVS_LANG']['btInsertRecord']; ?>
 <?php echo $this->_tpl_vars['BVS_LANG'][$this->_tpl_vars['listRequest']]; ?>
</span>
                                                    </a>
                                                <?php endif; ?>

                                                <a href="javascript: fullExportMenu('menuRegisters'); " id="show" class="defaultButton multiLine exportTitleButton">
                                                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="" />
                                                    <span><?php echo $this->_tpl_vars['BVS_LANG']['lblExportTitle']; ?>
</span>
                                                </a>
                                                
                                                <a href="javascript: fullExportMenu('menuCatalog'); " id="show" class="defaultButton multiLine exportCatalogButton">
                                                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="" />
                                                    <span><?php echo $this->_tpl_vars['BVS_LANG']['lblExportCatalog']; ?>
</span>
                                                </a>

                                            <?php else: ?>
                                                <a href="?m=<?php echo $this->_tpl_vars['listRequest']; ?>
<?php if ($this->_tpl_vars['titleCode']): ?>&amp;title=<?php echo $this->_tpl_vars['titleCode']; ?>
<?php endif; ?>&amp;action=new" id="show" class="defaultButton multiLine newButton ">
                                                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="" />
                                                    <span><?php echo $this->_tpl_vars['BVS_LANG']['btInsertRecord']; ?>
 <?php echo $this->_tpl_vars['BVS_LANG'][$this->_tpl_vars['listRequest']]; ?>
</span>
                                                </a>

                                            <?php endif; ?>
					<?php elseif ($_GET['m'] == 'facic'): ?>
						
						<a id="saveFacic" href="#"  class="defaultButton saveButton" >
                                                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="<?php echo $this->_tpl_vars['BVS_LANG']['btSaveRecord']; ?>
" />
                                                    <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['btSaveRecord']; ?>
</strong></span>
						</a>
						
						<a id="displayCollection" href="#" class="defaultButton multiLine newButton">
                                                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="" />
                                                    <span><?php echo $this->_tpl_vars['BVS_LANG']['lblViewHldg']; ?>
</span>
						</a>
						<a id="addRow" href="#" class="defaultButton multiLine newButton">
                                                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="" />
                                                    <span><?php echo $this->_tpl_vars['BVS_LANG']['btInsertRecord']; ?>
</span>
						</a>
						
						<a id="addRows" href="#" class="defaultButton multiLine newButton">
                                                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="" />
                                                    <span><?php echo $this->_tpl_vars['BVS_LANG']['lblInsertRange']; ?>
</span>
						</a>

                                                <a href="javascript:cancelAction('?m=<?php if ($_GET['listRequest']): ?><?php echo $_GET['listRequest']; ?>
<?php else: ?>title<?php endif; ?><?php if ($_GET['searchExpr']): ?>&amp;searchExpr=<?php echo $_GET['searchExpr']; ?>
<?php endif; ?>')" id="cancelButton" class="defaultButton cancelButton">
                                                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" />
                                                    <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
</strong></span>
                                                </a>

                                        <?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
                            <?php if ($_GET['action'] == 'signin' || $_GET['m'] != ""): ?>
            <?php if ($_GET['action'] != 'delete'): ?>
                <?php if ($_GET['m'] && $_GET['action']): ?>
                    <?php if ($_GET['m'] != 'titleplus'): ?>
                        <a href="?m=<?php echo $_GET['m']; ?>
" class="defaultButton multiLine backButton">
                   <?php else: ?>
                        <a href="?m=title" class="defaultButton multiLine backButton">
                   <?php endif; ?>
                <?php else: ?>
                    <?php if ($_GET['edit'] && $_GET['m'] != 'preferences'): ?>
                       <a href="?m=<?php echo $_GET['m']; ?>
<?php if ($_GET['searchExpr']): ?>&amp;searchExpr=<?php echo $_GET['searchExpr']; ?>
<?php endif; ?>"  class="defaultButton multiLine backButton">
                    <?php else: ?>
                        <?php if ($_GET['m'] != 'facic'): ?>
                            <a href="index.php" class="defaultButton multiLine backButton">
                        <?php else: ?>
                           <a href="?m=<?php if ($_GET['listRequest']): ?><?php echo $_GET['listRequest']; ?>
<?php else: ?>title<?php endif; ?>" class="defaultButton multiLine backButton">
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
                    <img src="public/images/common/defaultButton_iconBorder.gif" alt="" title="<?php echo $this->_tpl_vars['BVS_LANG']['btSaveRecord']; ?>
" />
                    <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['btBackAction']; ?>
</strong></span>
                </a>
            <?php endif; ?>
            <?php endif; ?>


             <?php if ($_GET['m'] == "" && $_SESSION['optLibrary'][1] != ""): ?>
             <div>
                <select name="role" id="role" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblRole']; ?>
" style="display:none;">
                     <?php if ($_SESSION['role'] == 'Administrator'): ?>
                        <option value="<?php echo $_SESSION['role']; ?>
" selected="selected"><?php echo $_SESSION['role']; ?>
</option>
                     <?php else: ?>
                        <option value="" label="<?php echo $this->_tpl_vars['BVS_LANG']['optSelValue']; ?>
" selected="selected"><?php echo $this->_tpl_vars['BVS_LANG']['optSelValue']; ?>
</option>
                        <?php echo smarty_function_html_options(array('values' => $_SESSION['optRole'],'output' => $_SESSION['optRole']), $this);?>

                     <?php endif; ?>
                </select>
                <select name="library" id="library" title="<?php echo $this->_tpl_vars['BVS_LANG']['lblLibrary']; ?>
" class="textEntry" onchange="changeLib('<?php echo $_SESSION['lang']; ?>
', '<?php echo $this->_tpl_vars['BVS_LANG']['msgLibChange']; ?>
');">
                    <option value="" label="<?php echo $this->_tpl_vars['BVS_LANG']['optSelValue']; ?>
"><?php echo $this->_tpl_vars['BVS_LANG']['optSelValue']; ?>
</option>
                    <?php echo smarty_function_html_options(array('values' => $_SESSION['optLibraryDir'],'output' => $_SESSION['optLibrary']), $this);?>

                </select>
            </div>
            <?php endif; ?>


		</div>
    <?php endif; ?>
	
	<div class="spacer">&#160;</div>

</div>