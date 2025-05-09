<?php /* Smarty version 2.6.28, created on 2025-05-07 23:57:58
         compiled from /var/www/html//templates/common/view_file.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/html//templates/common/view_file.tpl', 2, false),)), $this); ?>
<form action="view_file.php" name="view_file_form" method="get">
    <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['file_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
    <input type="hidden" name="mimetype" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['mimetype'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
    <br />
    <?php echo $this->_tpl_vars['g_lang_message_to_view_your_file']; ?>
 
        <a class="body" style="text-decoration:none" target="_new" href="view_file.php?submit=view&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['file_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&mimetype=<?php echo ((is_array($_tmp=$this->_tpl_vars['mimetype'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo $this->_tpl_vars['g_lang_button_click_here']; ?>
</a>
    <br><br>
    <div class="buttons">
        <button class="regular" type="submit" name="submit" value="Download">
            <?php echo $this->_tpl_vars['g_lang_message_if_you_are_unable_to_view2']; ?>

        </button>
    </div>
    <?php echo $this->_tpl_vars['g_lang_message_if_you_are_unable_to_view1']; ?>
<br />
    <?php echo $this->_tpl_vars['g_lang_message_if_you_are_unable_to_view2']; ?>

    <?php echo $this->_tpl_vars['g_lang_message_if_you_are_unable_to_view3']; ?>

</form>