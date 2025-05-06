<?php /* Smarty version 2.6.28, created on 2025-05-06 18:10:28
         compiled from /var/www/html//templates/common/user_show.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/html//templates/common/user_show.tpl', 3, false),)), $this); ?>
<table border=0>
    <th><?php echo $this->_tpl_vars['g_lang_userpage_user_info']; ?>
</th>
        <tr><td><?php echo $this->_tpl_vars['g_lang_userpage_id']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->id)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td></tr>
        <tr><td><?php echo $this->_tpl_vars['g_lang_userpage_last_name']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td></tr>
        <tr><td><?php echo $this->_tpl_vars['g_lang_userpage_first_name']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td></tr>
        <tr><td><?php echo $this->_tpl_vars['g_lang_userpage_username']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->username)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td></tr>
        <tr><td><?php echo $this->_tpl_vars['g_lang_userpage_department']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->department)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td></tr>
        <tr><td><?php echo $this->_tpl_vars['g_lang_userpage_email']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->email)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td></tr>
        <tr><td><?php echo $this->_tpl_vars['g_lang_userpage_phone_number']; ?>
</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->phone)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td></tr>
        <tr>
            <td><?php echo $this->_tpl_vars['g_lang_userpage_admin']; ?>
</td>
            <td>
                <?php if ($this->_tpl_vars['isAdmin']): ?>
                    <?php echo $this->_tpl_vars['g_lang_userpage_yes']; ?>

                <?php else: ?>
                    <?php echo $this->_tpl_vars['g_lang_userpage_no']; ?>

                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $this->_tpl_vars['g_lang_userpage_reviewer']; ?>
</td>
            <td>
                <?php if ($this->_tpl_vars['isReviewer']): ?>
                    <?php echo $this->_tpl_vars['g_lang_userpage_yes']; ?>

                <?php else: ?>
                    <?php echo $this->_tpl_vars['g_lang_userpage_no']; ?>

                <?php endif; ?>
            </td>
        </tr>
    <form action="admin.php" method="POST" enctype="multipart/form-data">
        <tr>
            <td colspan="4" align="center">
                <div class="buttons">
                    <button class="regular" type="Submit" name=""
                            value="Back"><?php echo $this->_tpl_vars['g_lang_userpage_back']; ?>
</button>
                </div>
            </td>
        </tr>
    </form>
</table>