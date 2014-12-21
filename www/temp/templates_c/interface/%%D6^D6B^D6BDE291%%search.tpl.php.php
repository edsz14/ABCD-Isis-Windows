<?php /* Smarty version 2.6.18, created on 2014-12-20 19:13:59
         compiled from search.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'search.tpl.php', 11, false),)), $this); ?>
<div class="searchBox">

    <?php if ($_GET['m'] != 'facic'): ?>
		
		<?php if ($_GET['m'] == 'mask'): ?>
            <form action="?" class="form" id="searchForm" method="get">
                <input type="hidden" name="m" value="<?php if ($_GET['m']): ?><?php echo $_GET['m']; ?>
<?php endif; ?>"/>
                <label for="searchExpr"><strong><?php echo $this->_tpl_vars['BVS_LANG']['titleSearch']; ?>
</strong></label>
                <input type="text" name="searchExpr" id="searchExpr" value="<?php if ($this->_tpl_vars['searcExpr']): ?><?php echo $this->_tpl_vars['searcExpr']; ?>
<?php else: ?>$<?php endif; ?>" class="textEntry" onfocus="this.className = 'textEntry textEntryFocus';"  onblur="this.className = 'textEntry';" />
                <select name="indexes" class="textEntry">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optIndexesMask']), $this);?>

                </select>
                <input type="button" name="ok" value="<?php echo $this->_tpl_vars['BVS_LANG']['btSearch']; ?>
" class="submit" onclick="doit('searchForm');"/>
                <span id="formRow01_help">
                    <a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
"/></a>
                </span>
                <span class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperSearch']; ?>
</span>
            </form>
        
		<?php elseif ($_GET['m'] == 'title'): ?>
            <form action="?" class="form" id="searchForm" method="get">
                <input type="hidden" name="m" value="<?php if ($_GET['m']): ?><?php echo $_GET['m']; ?>
<?php endif; ?>"/>
                <label for="searchExpr"><strong><?php echo $this->_tpl_vars['BVS_LANG']['titleSearch']; ?>
</strong></label>
                <input type="text" name="searchExpr" id="searchExpr" value="<?php if ($this->_tpl_vars['searcExpr']): ?><?php echo $this->_tpl_vars['searcExpr']; ?>
<?php else: ?>$<?php endif; ?>" class="textEntry" onfocus="this.className = 'textEntry textEntryFocus';"  onblur="this.className = 'textEntry';" />
                <select name="indexes" class="textEntry">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optIndexesTitle']), $this);?>

                </select>
                <input type="button" name="ok" value="<?php echo $this->_tpl_vars['BVS_LANG']['btSearch']; ?>
" class="submit" onclick="doit('searchForm');"/>
                <span id="formRow01_help">
                    <a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
"/></a>
                </span>
                <span class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperSearch']; ?>
</span>
            </form>

		<?php elseif ($_GET['m'] == 'users'): ?>
            <form action="?" class="form" id="searchForm" method="get">
                <input type="hidden" name="m" value="<?php if ($_GET['m']): ?><?php echo $_GET['m']; ?>
<?php endif; ?>"/>
                <label for="searchExpr"><strong><?php echo $this->_tpl_vars['BVS_LANG']['titleSearch']; ?>
</strong></label>
                <input type="text" name="searchExpr" id="searchExpr" value="<?php if ($this->_tpl_vars['searcExpr']): ?><?php echo $this->_tpl_vars['searcExpr']; ?>
<?php else: ?>$<?php endif; ?>" class="textEntry" onfocus="this.className = 'textEntry textEntryFocus';"  onblur="this.className = 'textEntry';" />
                <select name="indexes" class="textEntry">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optIndexesUsers']), $this);?>

                </select>
                <input type="button" name="ok" value="<?php echo $this->_tpl_vars['BVS_LANG']['btSearch']; ?>
" class="submit" onclick="doit('searchForm');"/>
                <span id="formRow01_help">
                    <a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
"/></a>
                </span>
                <span class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperSearch']; ?>
</span>
            </form>

		<?php elseif ($_GET['m'] == 'titleplus'): ?>
             <form action="?" class="form" id="searchTitlePlusForm" method="get">
                <input type="hidden" name="m" value="<?php if ($_GET['m']): ?><?php echo $_GET['m']; ?>
<?php endif; ?>"/>
                <label><strong><?php echo $this->_tpl_vars['BVS_LANG']['titleSearch']; ?>
</strong></label>
                <input type="text" name="searchExpr" id="searchExpr" value="<?php if ($this->_tpl_vars['searcExpr']): ?><?php echo $this->_tpl_vars['searcExpr']; ?>
<?php else: ?>$<?php endif; ?>" class="textEntry" onfocus="this.className = 'textEntry textEntryFocus';"  onblur="this.className = 'textEntry';" />

                <select id="AcquisitionMethod" style="display:none;" class="textEntry">
                    <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['BVS_LANG']['optValAcq'],'output' => $this->_tpl_vars['BVS_LANG']['optAcquisitionMethod']), $this);?>

                </select>
                <select id="AcquisitionControl" style="display:none;" class="textEntry">
                    <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['BVS_LANG']['optValAcq'],'output' => $this->_tpl_vars['BVS_LANG']['optAcquisitionControl']), $this);?>

                </select>
                <select id="AcquisitionPriority" style="display:none;" class="textEntry">
                    <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['BVS_LANG']['optValAcq2'],'output' => $this->_tpl_vars['BVS_LANG']['optAcquisitionPriority']), $this);?>

                </select>
                <select name="indexes" id="indexes" class="textEntry" onchange="checkSelection('2');">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optIndexesTitlePlus']), $this);?>

                </select>
                <input type="button" name="ok" value="<?php echo $this->_tpl_vars['BVS_LANG']['btSearch']; ?>
" class="submit" onclick="changeVal('searchExpr'); doit('searchTitlePlusForm');"/>
                <span id="formRow01_help">
                    <a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
"/></a>
                </span>
                <span class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperSearch']; ?>
</span>
            </form>


		<?php elseif ($_GET['m'] == 'library'): ?>
            <form action="?" class="form" id="searchForm" method="get">
                <input type="hidden" name="m" value="<?php if ($_GET['m']): ?><?php echo $_GET['m']; ?>
<?php endif; ?>"/>
                <label for="searchExpr"><strong><?php echo $this->_tpl_vars['BVS_LANG']['titleSearch']; ?>
</strong></label>
                <input type="text" name="searchExpr" id="searchExpr" value="<?php if ($this->_tpl_vars['searcExpr']): ?><?php echo $this->_tpl_vars['searcExpr']; ?>
<?php else: ?>$<?php endif; ?>" class="textEntry" onfocus="this.className = 'textEntry textEntryFocus';"  onblur="this.className = 'textEntry';" />
                <select name="indexes" class="textEntry">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['BVS_LANG']['optIndexesLibrary']), $this);?>

                </select>
                <input type="button" name="ok" value="<?php echo $this->_tpl_vars['BVS_LANG']['btSearch']; ?>
" class="submit" onclick="doit('searchForm');"/>
                <span id="formRow01_help">
                    <a href="javascript:showHideDiv('formRow01_helpA')"><img src="public/images/common/icon/helper_bg.png" title="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
" alt="<?php echo $this->_tpl_vars['BVS_LANG']['help']; ?>
"/></a>
                </span>
                <span class="helper"><?php echo $this->_tpl_vars['BVS_LANG']['helperSearch']; ?>
</span>
            </form>
		<?php endif; ?>
        
    <?php endif; ?>

</div>