<?php /* Smarty version 2.6.28, created on 2025-05-06 18:37:06
         compiled from /var/www/html//templates/common/settings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/html//templates/common/settings.tpl', 8, false),)), $this); ?>
        <form action="settings.php" method="POST" enctype="multipart/form-data" id="settingsForm">    
        <table class="form-table">        
            <tr>
                <th><?php echo $this->_tpl_vars['g_lang_label_name']; ?>
</th><th><?php echo $this->_tpl_vars['g_lang_value']; ?>
</th><th><?php echo $this->_tpl_vars['g_lang_label_description']; ?>
</th>
            </tr>
            <?php $_from = $this->_tpl_vars['settings_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
            <tr>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
                <td>
                <?php if ($this->_tpl_vars['i']['validation'] == 'bool'): ?>
                    <select name="<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <option value="True" <?php if ($this->_tpl_vars['i']['value'] == 'True'): ?> selected="selected"<?php endif; ?>>True</option>
                        <option value="False" <?php if ($this->_tpl_vars['i']['value'] == 'False'): ?> selected="selected"<?php endif; ?>>False</option>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'theme'): ?>
                    <select name="theme">
                        <?php $_from = $this->_tpl_vars['themes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['theme']):
?>
                            <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['theme'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['i']['value'] == $this->_tpl_vars['theme']): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['theme'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'language'): ?>
                    <select name="language">
                        <?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
                            <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['language'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['i']['value'] == $this->_tpl_vars['language']): ?> selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['language'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'file_expired_action'): ?>
                    <select name="file_expired_action">
                        <option value="1" <?php if ($this->_tpl_vars['i']['value'] == '1'): ?>selected="selected"<?php endif; ?>>Remove from file list until renewed</option>
                        <option value="2" <?php if ($this->_tpl_vars['i']['value'] == '2'): ?>selected="selected"<?php endif; ?>>Show in file list but non-checkoutable</option>
                        <option value="3" <?php if ($this->_tpl_vars['i']['value'] == '3'): ?>selected="selected"<?php endif; ?>>Send email to reviewer only</option>
                        <option value="4" <?php if ($this->_tpl_vars['i']['value'] == '4'): ?>selected="selected"<?php endif; ?>>Do Nothing</option>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'authen'): ?>
                    <select name="authen">
                        <option value="mysql" <?php if ($this->_tpl_vars['i']['value'] == 'mysql'): ?>selected="selected"<?php endif; ?>>MySQL</option>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'root_id'): ?>
                    <select name="root_id">
                        <?php $_from = $this->_tpl_vars['useridnums']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['useridnum']):
?>
                            <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['useridnum'][0])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['i']['value'] == $this->_tpl_vars['useridnum'][0]): ?> selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['useridnum'][1])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'smtp_password'): ?>
                    <input size="40" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" type="password" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                <?php else: ?>
                    <input size="40" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                <?php endif; ?>
                </td>
                <td><em><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</em></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
                <td colspan="3" align="center">
                    <div class="buttons">
                        <button class="positive" type="submit" name="submit" value="Save"><?php echo $this->_tpl_vars['g_lang_button_save']; ?>
</button>
                        <button class="negative" type="submit" name="submit" value="Cancel"><?php echo $this->_tpl_vars['g_lang_button_cancel']; ?>
</button>
                    </div>
                </td>
            </tr>
        </table>
        </form>