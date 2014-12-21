<?php /* Smarty version 2.6.18, created on 2011-10-30 19:26:08
         compiled from homepage.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'homepage.tpl.php', 34, false),)), $this); ?>
<script type="text/javascript">
<?php $this->assign('i', 0); ?>
    var optControlAccess = new Array();
    <?php $_from = $this->_tpl_vars['BVS_LANG']['optControlAccess']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t'] => $this->_tpl_vars['y']):
?>
    optControlAccess[<?php echo $this->_tpl_vars['i']; ?>
] = new Array('<?php echo $this->_tpl_vars['t']; ?>
','<?php echo $this->_tpl_vars['y']; ?>
');
    <?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
    <?php endforeach; endif; unset($_from); ?>

</script>

<div class="mainBox" onmouseover="this.className = 'mainBox mainBoxHighlighted';" onmouseout="this.className = 'mainBox';">
        <div class="boxTop">
            <div class="btLeft">&#160;</div>
            <div class="btRight">&#160;</div>
        </div>

        <div class="boxContent titleSection">
            <div class="sectionIcon">&#160;</div>
            <div class="sectionTitle">
                <h4><?php echo $this->_tpl_vars['BVS_LANG']['lblManagerOf']; ?>
<strong>
                    <?php if ($_SESSION['role'] == 'Administrator'): ?><?php echo $this->_tpl_vars['BVS_LANG']['lblTitleFacic']; ?>
<?php endif; ?>
                    <?php if ($_SESSION['role'] == 'EditorOnly' || $_SESSION['role'] == 'AdministratorOnly' || $_SESSION['role'] == 'Editor'): ?><?php echo $this->_tpl_vars['BVS_LANG']['lblTitle']; ?>
<?php endif; ?>
                    <?php if ($_SESSION['role'] == 'Operator'): ?><?php echo $this->_tpl_vars['BVS_LANG']['lblTitlePlusFacic']; ?>
<?php endif; ?>
                </strong></h4>
                <span><?php echo $this->_tpl_vars['BVS_LANG']['lblTotalOf']; ?>
 <strong><?php echo $this->_tpl_vars['totalTitleRecords']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['lblTitleRegister']; ?>
</span>
            </div>
            <div class="sectionButtons">
                <div class="searchTitles">
                    <form id="searchTitlesForm" action="<?php echo $_SERVER['PHP_SELF']; ?>
?m=title" method="post">
                        <div class="stInput">
                            <label for="searchExpr"><?php echo $this->_tpl_vars['BVS_LANG']['lblTypeTitle']; ?>
</label>
                            <input type="text" name="searchExpr" id="searchExpr" value="" class="textEntry" />
                            <select name="indexes" class="textEntry">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optIndexesTitle']), $this);?>

                            </select>
				<span id="formRow01_help">
                                    <a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
"/></a>
				</span>
                        </div>
                        <a href="javascript:void(0);" class="defaultButton searchButton" onclick="doit('searchTitlesForm');">
                            <img src="<?php echo $this->_tpl_vars['BVS_CONF']['install_dir']; ?>
/public/images/common/mainBox_iconBorder.gif" alt="" title="" />
                            <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblSearch']; ?>
 </strong></span>
                        </a>
                    </form>
                </div>
                <a href="?m=title" class="defaultButton multiLine listButton">
                    <img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
                    <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblList']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['lblTitle']; ?>
</span>
                </a>
                <?php if ($_SESSION['role'] == 'Administrator'): ?>
                <a href="?m=title&amp;action=new" class="defaultButton multiLine newButton">
                    <img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
                    <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblNew']; ?>
</strong><?php echo $this->_tpl_vars['BVS_LANG']['lblTitle']; ?>
</span>
                </a>
                <?php endif; ?>
            </div>
            <div class="spacer">&#160;</div>
        </div>

        <div class="boxBottom">
            <div class="bbLeft">&#160;</div>
            <div class="bbRight">&#160;</div>
        </div>
	</div>
	
	<?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'Editor' || $_SESSION['role'] == 'EditorOnly'): ?>
	<div class="mainBox" onmouseover="this.className = 'mainBox mainBoxHighlighted';" onmouseout="this.className = 'mainBox';">
        <div class="boxTop">
            <div class="btLeft">&#160;</div>
            <div class="btRight">&#160;</div>
        </div>
        <div class="boxContent titlePlusSection">
            <div class="sectionIcon">&#160;</div>
            <div class="sectionTitle">
                <h4><?php echo $this->_tpl_vars['BVS_LANG']['lblManagerOf']; ?>
<strong><?php if ($_SESSION['role'] == 'Editor'): ?><?php echo $this->_tpl_vars['BVS_LANG']['lblTitlePlusFacic']; ?>
<?php else: ?><?php echo $this->_tpl_vars['BVS_LANG']['lblTitlePlusFacic']; ?>
<?php endif; ?></strong></h4>
                <span><?php echo $this->_tpl_vars['BVS_LANG']['lblTotalOf']; ?>
 <strong><?php echo $this->_tpl_vars['totalTitlePlusRecords']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['lblTitleRegister']; ?>
</span>
            </div>
            <div class="sectionButtons">
                 <div class="searchTitles">
                        <div class="stInput">
                            <label for="searchExpr"><?php echo $this->_tpl_vars['BVS_LANG']['lblTypeTitle']; ?>
</label>
                            <input type="text" id="freeText" name="freeText" style="display:block;" class="textEntry" />
                            <select id="AcquisitionMethod" style="display:none;" class="textEntry superTextEntry">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optAcquisitionMethod']), $this);?>

                            </select>
                            <select id="AcquisitionControl" style="display:none;" class="textEntry superTextEntry">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optAcquisitionControl']), $this);?>

                            </select>
                            <select id="AcquisitionPriority" style="display:none;" class="textEntry superTextEntry">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optAcquisitionPriority']), $this);?>

                            </select>
                            <form id="searchTitlePlusForm" action="<?php echo $_SERVER['PHP_SELF']; ?>
?" method="get">
                                <input type="hidden" name="m" id="m" value="titleplus" class="textEntry" />
                                <input type="hidden" name="searchExpr" id="searchExpr" value="" class="textEntry" />
                                <select name="indexes" id="indexes" class="textEntry" onchange="checkSelection();">
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optIndexesTitlePlus']), $this);?>

                                </select>
				<span id="formRow02_help">
                                    <a href="javascript:showHideDiv('formRow02_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
"/></a>
				</span>

                            </form>
                        </div>
                        <a href="javascript:void(0);" class="defaultButton searchButton" onclick="changeVal('freeText'); doit('searchTitlePlusForm');">
                            <img src="<?php echo $this->_tpl_vars['BVS_CONF']['install_dir']; ?>
/public/images/common/mainBox_iconBorder.gif" alt="" title="" />
                            <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblSearch']; ?>
</strong></span>
                        </a>
                     
                </div>
                <a href="?m=titleplus" class="defaultButton multiLine listButton">
                    <img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
                    <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblList']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['titlePlus']; ?>
 </span>
                </a>
                <!--a href="?m=title&amp;titleplus=new" class="defaultButton multiLine newButton">
                    <img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
                    <span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblNew2']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['titlePlus']; ?>
 </span>
                </a-->
            </div>
            <div class="spacer">&#160;</div>
            </div>
            
            <div class="boxBottom">
                <div class="bbLeft">&#160;</div>
                <div class="bbRight">&#160;</div>
            </div>
    </div>
	<?php endif; ?>

	<?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'AdministratorOnly'): ?>
	<div class="mainBox" onmouseover="this.className = 'mainBox mainBoxHighlighted';" onmouseout="this.className = 'mainBox';">
	<div class="boxTop">
		<div class="btLeft">&#160;</div>
		<div class="btRight">&#160;</div>
	</div>

	<div class="boxContent maskSection">
		<div class="sectionIcon">
			&#160;
		</div>
		<div class="sectionTitle">
			<h4><?php echo $this->_tpl_vars['BVS_LANG']['lblManagerOf']; ?>
 <strong>  <?php echo $this->_tpl_vars['BVS_LANG']['lblMasks']; ?>
 </strong></h4>
			<span><?php echo $this->_tpl_vars['BVS_LANG']['lblTotalOf']; ?>
 <strong><?php echo $this->_tpl_vars['totalMaskRecords']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['lblMasks2']; ?>
  </span>
		</div>
		<div class="sectionButtons">
			<a href="?m=mask" class="defaultButton listButton">
				<img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
				<span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblList']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['lblMasks']; ?>
</span>
			</a>
			<a href="?m=mask&amp;action=new" class="defaultButton multiLine newButton">
				<img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
				<span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblNew2']; ?>
</strong> <?php echo $this->_tpl_vars['BVS_LANG']['lblMask']; ?>
</span>
			</a>
		</div>
		<div class="spacer">&#160;</div>
	</div>

	<div class="boxBottom">
		<div class="bbLeft">&#160;</div>
		<div class="bbRight">&#160;</div>
	</div>
	</div>
	<?php endif; ?>
	
	<div class="mainBox" onmouseover="this.className = 'mainBox mainBoxHighlighted';" onmouseout="this.className = 'mainBox';">
	<div class="boxTop">
		<div class="btLeft">&#160;</div>
		<div class="btRight">&#160;</div>
	</div>
	
	<div class="boxContent toolSection">
		<div class="sectionIcon">&#160;</div>
		<div class="sectionTitle">
			<h4>&#160;<strong><?php echo $this->_tpl_vars['BVS_LANG']['lblUtility']; ?>
</strong></h4>
		</div>
		
			<div class="sectionButtons">
			<?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'AdministratorOnly'): ?>
			<a href="?m=users" class="defaultButton multiLine userButton">
				<img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
				<span><?php echo $this->_tpl_vars['BVS_LANG']['lblAdmUsers']; ?>
</span>
			</a>
			<a href="?m=library" class="defaultButton multiLine libraryButton">
				<img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
				<span><?php echo $this->_tpl_vars['BVS_LANG']['lblAdmLibrary']; ?>
</span>
			</a>
            <!--a href="javascript: EmDesenvolvimento('<?php echo $_SESSION['lang']; ?>
');" class="defaultButton multiLine importButton">
				<img src="public/images/common/mainBox_iconBorder.gif" alt="Em desenvolvimento" title="Em desenvolvimento" />
				<span><strong><?php echo $this->_tpl_vars['BVS_LANG']['lblImport']; ?>
</strong><?php echo $this->_tpl_vars['BVS_LANG']['lblTitle2']; ?>
</span>
			</a-->
			<?php endif; ?>
			<a href="?m=report" class="defaultButton multiLine reportButton">
				<img src="public/images/common/mainBox_iconBorder.gif" alt="Em desenvolvimento" title="Em desenvolvimento" />
				<span><?php echo $this->_tpl_vars['BVS_LANG']['lblServReport']; ?>
</span>
			</a>
			<a href="?m=maintenance" class="defaultButton multiLine databaseMaintenceButton">
				<img src="public/images/common/mainBox_iconBorder.gif" alt="Em desenvolvimento" title="Em desenvolvimento" />
				<span><?php echo $this->_tpl_vars['BVS_LANG']['lblServMaintance']; ?>
</span>
			</a>
		</div>
		
		<div class="spacer">&#160;</div>
	</div>

	<div class="boxBottom">
		<div class="bbLeft">&#160;</div>
		<div class="bbRight">&#160;</div>
	</div>
	</div>

	<div class="mainBox" onmouseover="this.className = 'mainBox mainBoxHighlighted';" onmouseout="this.className = 'mainBox';">
	<div class="boxTop">
		<div class="btLeft">&#160;</div>
		<div class="btRight">&#160;</div>
	</div>
	<div class="boxContent helpSection">
		<div class="sectionIcon">
			&#160;
		</div>
		<div class="sectionTitle">
			<h4>&#160;<strong><?php echo $this->_tpl_vars['BVS_LANG']['lblHelp']; ?>
</strong></h4>
		</div>
		<div class="sectionButtons">
			<a href="javascript: showMessage('<?php echo $_SESSION['lang']; ?>
');" class="defaultButton multiLine pdfButton">
				<img src="public/images/common/mainBox_iconBorder.gif" alt="" title="" />
				<span><?php echo $this->_tpl_vars['BVS_LANG']['lblRead']; ?>
 <strong><?php echo $this->_tpl_vars['BVS_LANG']['lblManual']; ?>
</strong></span>
			</a>
		</div>
		<div class="spacer">&#160;</div>
	</div>
	<div class="boxBottom">
		<div class="bbLeft">&#160;</div>
		<div class="bbRight">&#160;</div>
	</div>
            
        <div class="helpBG" id="formRow01_helpA" style="display: none;">
            <div class="helpArea">
                    <span class="exit"><a href="javascript:showHideDiv('formRow01_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
"></a></span>
                    <h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - <?php echo $this->_tpl_vars['BVS_LANG']['field']; ?>
 <?php echo $this->_tpl_vars['BVS_LANG']['lblSearchTitle']; ?>
</h2>
                    <div class="help_message">
                        <?php echo $this->_tpl_vars['BVS_LANG']['helpSearchTitle']; ?>

                    </div>
            </div>
        </div>
        <div class="helpBG" id="formRow02_helpA" style="display: none;">
            <div class="helpArea">
                    <span class="exit"><a href="javascript:showHideDiv('formRow02_helpA');" title="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['close']; ?>
"><img src="public/images/common/icon/defaultButton_cancel.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" title="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
"></a></span>
                    <h2><?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
 - <?php echo $this->_tpl_vars['BVS_LANG']['field']; ?>
 <?php echo $this->_tpl_vars['BVS_LANG']['lblSearchTitlePlus']; ?>
</h2>
                    <div class="help_message">
                        <?php echo $this->_tpl_vars['BVS_LANG']['helpSearchTitlePlus']; ?>

                    </div>
            </div>
        </div>
</div>