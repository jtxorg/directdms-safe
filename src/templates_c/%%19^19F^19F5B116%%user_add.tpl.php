<?php /* Smarty version 2.6.28, created on 2025-05-08 16:43:07
         compiled from /var/www/html//templates/common/user_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/html//templates/common/user_add.tpl', 40, false),)), $this); ?>
<form name="add_user" id="add_user" action="user.php" method="POST" enctype="multipart/form-data">
    <table border="0" cellspacing="5" cellpadding="5">
        <?php echo $this->_tpl_vars['onBeforeAddUser']; ?>

        <tr><td><b><?php echo $this->_tpl_vars['g_lang_label_last_name']; ?>
</b></td><td><input name="last_name" type="text" class="required" minlength="2" maxlength="255"></td></tr>
        <tr><td><b><?php echo $this->_tpl_vars['g_lang_label_first_name']; ?>
</b></td><td><input name="first_name" type="text" class="required" minlength="2" maxlength="255"></td></tr>
        <tr><td><b><?php echo $this->_tpl_vars['g_lang_username']; ?>
</b></td><td><input name="username" type="text" class="required" minlength="2" maxlength="25"></td></tr>
        <tr>
            <td><b><?php echo $this->_tpl_vars['g_lang_label_phone_number']; ?>
</b></td>
            <td>
                <input name="phonenumber" type="text" maxlength="20">
            </td>
        </tr>
        <tr>
            <td><b><?php echo $this->_tpl_vars['g_lang_label_example']; ?>
</b></td>
            <td><b>999 9999999</b></td>
        </tr>
        
        <?php if ($this->_tpl_vars['mysql_auth']): ?>
        <tr>
            <td><b><?php echo $this->_tpl_vars['g_lang_userpage_password']; ?>
</b></td>
            <td>
                <input name="password" type="text" value="<?php echo $this->_tpl_vars['rand_password']; ?>
" class="required" minlength="5" maxlength="32">
            </td>
        </tr>
        <?php endif; ?>
        
        <tr>
            <td><b><?php echo $this->_tpl_vars['g_lang_label_email_address']; ?>
</b></td>
            <td>
                <input name="Email" type="text" class="required email" maxlength="50">
            </td>
        </tr>
        <tr>

        <tr>
            <td><b><?php echo $this->_tpl_vars['g_lang_label_department']; ?>
</b></td>
            <td>
                <select name="department">
                    <?php $_from = $this->_tpl_vars['department_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['department_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['department_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['department_list']['iteration']++;
?>
                    <option value=<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>
        <tr>
            <td><b><?php echo $this->_tpl_vars['g_lang_label_is_admin']; ?>
?</b></td>
            <td>
                <input name="admin" type="checkbox" value="1" id="cb_admin">
            </td>
        </tr>
        <tr id="userReviewDepartmentRow">
            <td id="userReviewDepartmentLabelTd"><b><?php echo $this->_tpl_vars['g_lang_label_reviewer_for']; ?>
</b></td>
            <td id="userReviewDepartmentListTd">
                <select class="multiView" name="department_review[]" multiple="multiple" id="userReviewDepartmentsList" />
                <?php $_from = $this->_tpl_vars['department_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['department_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['department_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['department_list']['iteration']++;
?>
                    <option value=<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><b><?php echo $this->_tpl_vars['g_lang_userpage_can_add']; ?>
?</b></td>
            <td>
                <input name="can_add" type="checkbox" value="1" id="cb_can_add"  checked="checked">
            </td>
        </tr>
        <tr>
            <td><b><?php echo $this->_tpl_vars['g_lang_userpage_can_checkin']; ?>
?</b></td>
            <td>
                <input name="can_checkin" type="checkbox" value="1" id="cb_can_checkin"  checked="checked">
            </td>
        </tr>
        <tr>
            <td align="center">
                <div class="buttons">
                    <button id="submitButton" class="positive" type="Submit" name="submit" value="Add User"><?php echo $this->_tpl_vars['g_lang_userpage_button_add_user']; ?>
</button>
                </div>
            </td>
            <td>
                <div class="buttons">
                    <button id="cancelButton" class="negative cancel" type="Submit" name="cancel" value="Cancel"><?php echo $this->_tpl_vars['g_lang_userpage_button_cancel']; ?>
</button>
                </div>
            </td>
        </tr>
    </table>
</form>
<script>
    <?php echo '
    $(document).ready(function(){
        $(\'#submitButton\').click(function(){
            $(\'#add_user\').validate();
        })
    });
    '; ?>

</script>