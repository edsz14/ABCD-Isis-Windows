<?php /* Smarty version 2.6.18, created on 2010-08-31 07:58:16
         compiled from messages.tpl.php */ ?>
<img src="public/images/common/spacer.gif" alt="" title="" />
<div class="mContent">
<?php if ($this->_tpl_vars['sMessage']['success']): ?>
    <h4><?php echo $this->_tpl_vars['BVS_LANG']['mSuccess']; ?>
</h4>
<?php else: ?>	
    <h4><?php echo $this->_tpl_vars['BVS_LANG']['mFail']; ?>
</h4>
<?php endif; ?>

<?php if ($this->_tpl_vars['sMessage']['success']): ?>
    <p><?php echo $this->_tpl_vars['sMessage']['message']; ?>
</p>
    <div id="loading">&nbsp;</div>
<?php else: ?>
    <?php if ($this->_tpl_vars['sMessage']['warning']): ?>
        <p><strong><?php echo $this->_tpl_vars['sMessage']['message']; ?>
</strong></p>
        <div>
            <span><?php echo $this->_tpl_vars['BVS_LANG']['doYouComfirmThisAction']; ?>
</span>
            <ul>
                <li><a href="?m=<?php echo $_GET['m']; ?>
<?php if ($_GET['title']): ?>&title=<?php echo $_GET['title']; ?>
<?php endif; ?>&delete=<?php echo $_GET['id']; ?>
"><strong><?php echo $this->_tpl_vars['BVS_LANG']['confirmAction']; ?>
</strong></a></li>
                <li><a href="?m=<?php echo $_GET['m']; ?>
<?php if ($_GET['title']): ?>&title=<?php echo $_GET['title']; ?>
<?php endif; ?>"><strong><?php echo $this->_tpl_vars['BVS_LANG']['btCancelAction']; ?>
</strong></a></li>
            </ul>
        </div>
    <?php else: ?>
        <p><strong><?php echo $this->_tpl_vars['BVS_LANG']['msg_op_fail']; ?>
</strong></p>
        <div>
            <code>Error #<?php echo $this->_tpl_vars['sMessage']['NErro']; ?>
: <?php echo $this->_tpl_vars['sMessage']['message']; ?>
</code>
        </div>
        <span><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>
<?php echo $this->_tpl_vars['BVS_CONF']['install_dir']; ?>
<?php if ($_GET['m']): ?>?m=<?php echo $_GET['m']; ?>
<?php endif; ?>"><strong><?php echo $this->_tpl_vars['BVS_LANG']['btBackAction']; ?>
</strong></a></span>
    <?php endif; ?>
<?php endif; ?>

</div>
<div class="spacer">&#160;</div>