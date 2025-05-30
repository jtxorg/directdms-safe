<?php /* Smarty version 2.6.28, created on 2025-04-23 23:54:47
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'header.tpl', 5, false),)), $this); ?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title><?php echo ((is_array($_tmp=$this->_tpl_vars['g_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['page_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</title>
<?php echo '
        <script type="text/javascript">
        <!--
        function popup(mylink, windowname)
        {
            if (! window.focus)return true;
            var href;
            if (typeof(mylink) == \'string\')
                href=mylink;
            else
                href=mylink.href;
            window.open(href, windowname, \'width=300,height=500,scrollbars=yes\');
            return false;
        }
        //-->
        </script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../../templates/common/head_include.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link type="text/css" rel="stylesheet" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/templates/default/css/default.css">
    </head>
    <body >
        <!-- ----------------begin_draw_menu----------------- -->
<!-- ----------------UID is <?php echo $this->_tpl_vars['uid']; ?>
 ----------------- -->
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left">
            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/out.php">
                <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/images/logo.png" style="width:300px" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['site_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['site_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" border="0">
            </a>
        </td>
        <td align="right" >
            <p>
                <div class="buttons">
                    <?php if ($this->_tpl_vars['can_checkin'] || $this->_tpl_vars['isadmin'] == 'yes'): ?>
                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/in.php" class="regular"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/images/import-2.png" alt="check in"/><?php echo $this->_tpl_vars['g_lang_button_check_in']; ?>
</a>
                <?php endif; ?>
                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/search.php" class="regular"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/images/find-new-users.png" alt="search"/><?php echo $this->_tpl_vars['g_lang_search']; ?>
</a>
                <?php if ($this->_tpl_vars['can_add'] || $this->_tpl_vars['isadmin'] == 'yes'): ?>
                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/add.php" class="regular"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/images/plus.png" alt="add file"/><?php echo $this->_tpl_vars['g_lang_button_add_document']; ?>
</a>
                <?php endif; ?>
            <?php if ($this->_tpl_vars['isadmin'] == 'yes'): ?>
                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/admin.php" class="positive"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/images/control.png" alt="admin"/><?php echo $this->_tpl_vars['g_lang_label_admin']; ?>
</a>
            <?php endif; ?>
                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['g_base_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/logout.php" class="negative"><?php echo $this->_tpl_vars['g_lang_logout']; ?>
</a>
            </div>
            </p>
        </td>
    </tr>
</table>
<?php if ($this->_tpl_vars['g_demo'] == 'True'): ?>
    <h1>Demo resets once per hour</h1>
<?php endif; ?>
<!-- ----------------end_draw_menu----------------- -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/linkcontrol.css">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
<tr>
<?php if ($this->_tpl_vars['userName']): ?>
<td bgcolor="#0000A0" align="left" valign="middle" width="10">
<span class="statusbar"><?php echo ((is_array($_tmp=$this->_tpl_vars['userName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></td>
<?php endif; ?>

<td bgcolor="#0000A0" align="left" valign="middle" width="10">
<a class="statusbar" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/out.php" style="text-decoration:none"><?php echo $this->_tpl_vars['g_lang_home']; ?>
</a></td>
<td bgcolor="#0000A0" align="left" valign="middle" width="10">
<a class="statusbar" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/profile.php" style="text-decoration:none"><?php echo $this->_tpl_vars['g_lang_preferences']; ?>
</a></td>
<td bgcolor="#0000A0" align="left" valign="middle" width="10">
<a class="statusbar" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/help.html" onClick="return popup(this, 'Help')" style="text-decoration:none"><?php echo $this->_tpl_vars['g_lang_help']; ?>
</a></td>
<td bgcolor="#0000A0" align="middle" valign="middle" width="0"><font size="3" face="Arial" color="White">|</font></td>
<td bgcolor="#0000A0" align="left" valign="middle"><?php echo $this->_tpl_vars['breadCrumb']; ?>
</td>
<td bgcolor="#0000A0" align="right" valign="middle">
    <b><font size="-2" face="Arial" color="White"><?php echo $this->_tpl_vars['g_lang_message_last_message']; ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['lastmessage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</font></b>
</td>
</tr>
</table>
<div id="content">
<?php if ($this->_tpl_vars['lastmessage'] != ''): ?>
    <div id="last_message"><?php echo ((is_array($_tmp=$this->_tpl_vars['lastmessage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
<?php endif; ?>