<?php /* Smarty version 2.6.28, created on 2025-05-07 23:57:51
         compiled from /var/www/html//templates/common/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/html//templates/common/details.tpl', 3, false),)), $this); ?>
<table border="0" width=100% cellspacing="4" cellpadding="1">
    <form name="data">
        <input type="hidden" name="to" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['to_value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
        <input type="hidden" name="subject" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['subject_value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
        <input type="hidden" name="comments" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['comments_value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
    </FORM>
    <tr>
        <td align="right">
            <?php if ($this->_tpl_vars['file_detail']['file_unlocked']): ?>
                <img src="images/file_unlocked.png" alt="" border="0" align="absmiddle">
            <?php else: ?>
                <img src="images/file_locked.png" alt="" border="0" align="absmiddle">
            <?php endif; ?>
        </td>
        <td align="left">
            <span style="font-size: larger; "><?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['realname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
        </td>
    </tr>
    <tr>
        <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_category']; ?>
:</th><td><?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['category'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
    </tr>

    <?php echo $this->_tpl_vars['file_detail']['udf_details_display']; ?>


    <tr>
        <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_label_size']; ?>
:</th><td><?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['filesize'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
    </tr>
    <tr>
        <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_label_created_date']; ?>
:</th><td> <?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['created'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
    </tr>
    <tr>
        <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_owner']; ?>
:</th>
        <td>
            <a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['owner_email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
?Subject=Regarding%20your%20document:<?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['realname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&Body=Hello%20<?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['owner_fullname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['owner'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
        </td>
    </tr>
    <tr>
        <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_label_description']; ?>
:</th><td> <?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
    </tr>
    <tr>
    <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_label_comment']; ?>
:</th><td> <?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['comment'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
    </tr>
    <tr>
        <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_revision']; ?>
:</th><td> <div id="details_revision"><?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['revision'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div></td>
    </tr>
<?php if ($this->_tpl_vars['file_detail']['file_under_review']): ?>
    <tr>
        <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_label_reviewer']; ?>
:</th>
        <td> <?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['reviewer'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
 (<a href='javascript:showMessage()'><?php echo $this->_tpl_vars['g_lang_message_reviewers_comments_re_rejection']; ?>
</a>)</td>
    </tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['file_detail']['status'] > 0): ?>
    <tr>
        <th valign=top align=right><?php echo $this->_tpl_vars['g_lang_detailspage_file_checked_out_to']; ?>
:</th><td><a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['checkout_person_email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
?Subject=Regarding%20your%20checked-out%20document:<?php echo ((is_array($_tmp=$this->_tpl_vars['file_detail']['realname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&Body=Hello%20<?php echo ((is_array($_tmp=$this->_tpl_vars['checkout_person_full_name'][$this->_tpl_vars['fullname']][0])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['checkout_person_full_name'][1])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['checkout_person_full_name'][0])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></td>
    </tr>
<?php endif; ?>

<!-- available actions -->
    <tr>
        <td colspan="2" align="center">
            <table border="0" cellspacing="5" cellpadding="5">
                <tr>
                <!-- inner table begins -->
                <!-- view option available at all time, place it outside the block -->
                <?php if ($this->_tpl_vars['view_link'] != ''): ?>
                    <td align="center">
                        <div class="buttons">
                            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['view_link'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="positive"><img src="images/view.png" alt="view"/><?php echo $this->_tpl_vars['g_lang_detailspage_view']; ?>
</a>
                        </div>
                    </td>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['sign_link'] != ''): ?>
                    <td align="center">
                        <div class="buttons">
                            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['sign_link'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="regular">Send & Sign</a>
                        </div>
                    </td>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['check_out_link'] != ''): ?>
                    <td align="center">
                        <div class="buttons">
                            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['check_out_link'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="regular"><img src="images/check-out.png" alt="check out"/><?php echo $this->_tpl_vars['g_lang_detailspage_check_out']; ?>
</a>
                        </div>
                    </td>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['edit_link'] != ''): ?>
                    <td align="center">
                        <div class="buttons">
                            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['edit_link'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="regular"><img src="images/edit.png" alt="edit"/><?php echo $this->_tpl_vars['g_lang_detailspage_edit']; ?>
</a>
                        </div>
                    </td>
                    <td align="center">
                        <div class="buttons">
                            <a href="javascript:my_delete()" class="negative"><img src="images/delete.png" alt="delete"/><?php echo $this->_tpl_vars['g_lang_detailspage_delete']; ?>
</a>
                        </div>
                    </td>
                <?php endif; ?>
                    <td align="center">
                        <div class="buttons">
                            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['history_link'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="regular"><img src="images/history.png" alt="history"/><?php echo $this->_tpl_vars['g_lang_detailspage_history']; ?>
</a>
                        </div>
                    </td>

                </tr>
                <!-- inner table ends -->
            </table>
        </td>
    </tr>
</table>
<?php echo '
<script type="text/javascript">
    var message_window;
    var mesg_window_frm;
    function my_delete()
    {
        if(window.confirm("'; ?>
<?php echo $this->_tpl_vars['g_lang_detailspage_are_sure']; ?>
<?php echo '")) {   
        window.location = "'; ?>
<?php echo $this->_tpl_vars['my_delete_link']; ?>
<?php echo '";
        }
    }
    function sendFields()
    {
        mesg_window_frm = message_window.document.author_note_form;
        if(mesg_window_frm) {
                    mesg_window_frm.to.value = document.data.to.value;
                    mesg_window_frm.subject.value = document.data.subject.value;
                    mesg_window_frm.comments.value = document.data.comments.value;
                }
    }
    function showMessage()
    {
        message_window = window.open(\''; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_link'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo '\' , \'comment_wins\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=450,height=200\');
        message_window.focus();
        setTimeout("sendFields();", 500);
    }
</script>
'; ?>
