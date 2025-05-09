<?php /* Smarty version 2.6.28, created on 2025-05-07 23:58:33
         compiled from /var/www/html//templates/common/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/html//templates/common/add.tpl', 7, false),)), $this); ?>


<script type="text/javascript" src="functions.js"></script>

<!-- file upload formu using ENCTYPE -->
<form id="addeditform" name="main" action="add.php" method="POST" enctype="multipart/form-data" onsubmit="return checksec();">
    <input type="hidden" id="db_prefix" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['db_prefix'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
<table border="0" cellspacing="5" cellpadding="5">
<?php $this->assign('i', '0'); ?>    
<?php $_from = $this->_tpl_vars['t_name']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name']):
        $this->_foreach['loop1']['iteration']++;
?>
    <input type="hidden" id="secondary<?php echo ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" name="secondary<?php echo ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" value="" /> <!-- CHM hidden and onsubmit added-->
    <input type="hidden" id="tablename<?php echo ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" name="tablename<?php echo ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" /> <!-- CHM hidden and onsubmit added-->
    <?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
<?php endforeach; endif; unset($_from); ?>
    <input id="i_value" type="hidden" name="i_value" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" /> <!-- CHM hidden and onsubmit added-->
    <tr>
        <td>
            <a class="body" tabindex=1 href="help.html#Add_File_-_File_Location" onClick="return popup(this, 'Help')" style="text-decoration:none"><?php echo $this->_tpl_vars['g_lang_label_file_location']; ?>
</a>
        </td>
        <td colspan=3>
            <input tabindex="0" name="file[]" type="file" multiple="multiple">
        </td>
    </tr>
    
<?php if ($this->_tpl_vars['is_admin'] == true): ?>
    <tr>

        <td>
            <?php echo $this->_tpl_vars['g_lang_editpage_assign_owner']; ?>

        </td>
        <td>
            <select name="file_owner">
            <?php $_from = $this->_tpl_vars['avail_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
                <option value="<?php echo $this->_tpl_vars['user']['id']; ?>
" <?php echo $this->_tpl_vars['user']['selected']; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['user']['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $this->_tpl_vars['g_lang_editpage_assign_department']; ?>

        </td>
        <td>
               
            <select name="file_department">
            <?php $_from = $this->_tpl_vars['avail_depts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dept']):
?>
                <option value="<?php echo $this->_tpl_vars['dept']['id']; ?>
" <?php echo $this->_tpl_vars['dept']['selected']; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['dept']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
    </tr>
<?php endif; ?>    
    <tr>
        <td>
            <a class="body" href="help.html#Add_File_-_Category"  onClick="return popup(this, 'Help')" style="text-decoration:none"><?php echo $this->_tpl_vars['g_lang_category']; ?>
</a>
        </td>
        <td colspan=3>
            <select tabindex=2 name="category" >
            <?php $_from = $this->_tpl_vars['cats_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>
                <option value="<?php echo $this->_tpl_vars['cat']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['cat']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
    </tr>
    <!-- Set Department rights on the file -->
    <tr id="departmentSelect">
        <td>
            <a class="body" href="help.html#Add_File_-_Department" onClick="return popup(this, 'Help')" style="text-decoration:none"><?php echo $this->_tpl_vars['g_lang_addpage_permissions']; ?>
</a>
        </td>
        <td colspan=3>
            <hr />
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../../templates/common/_filePermissions.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <hr />
        </td>
    </tr>
    <tr>
        <td>
            <a class="body" href="help.html#Add_File_-_Description" onClick="return popup(this, 'Help')" style="text-decoration:none"><?php echo $this->_tpl_vars['g_lang_label_description']; ?>
</a>
        </td>
        <td colspan="3"><input tabindex="5" type="Text" name="description" size="50"></td>
    </tr>

    <tr>
        <td>
            <a class="body" href="help.html#Add_File_-_Comment" onClick="return popup(this, 'Help')" style="text-decoration:none"><?php echo $this->_tpl_vars['g_lang_label_comment']; ?>
</a>
        </td>
        <td colspan="3"><textarea tabindex="6" name="comment" rows="4" onchange="this.value=enforceLength(this.value, 255);"></textarea></td>
    </tr>