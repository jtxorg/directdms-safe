<?php /* Smarty version 2.6.28, created on 2025-05-06 23:14:31
         compiled from /var/www/html//templates/common/toBePublished.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/html//templates/common/toBePublished.tpl', 18, false),)), $this); ?>


<table>
		<tr>
		<td>
                        <div class="buttons">
                            <!--
		<button class="positive" type="button" name="submit" value="Authorize" onClick="checkedBoxesNumber(); authcomment()"><?php echo '<?php'; ?>
 echo msg('button_authorize')<?php echo '?>'; ?>
</button>
		<button class="negative" type="button" name="submit" value="Reject" onClick="checkedBoxesNumber(); rejectcomment()"><?php echo '<?php'; ?>
 echo msg('button_reject')<?php echo '?>'; ?>
</button>
		-->
                <button class="positive" type="submit" name="submit" value="commentAuthorize"><?php echo $this->_tpl_vars['g_lang_button_authorize']; ?>
</button>
		<button class="negative" type="submit" name="submit" value="commentReject"><?php echo $this->_tpl_vars['g_lang_button_reject']; ?>
</button>
                        </div>
                    <input type="hidden" name="mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lmode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
		<input type="hidden" name="Docflag" value="-1" />

     </table>
</form>
                <?php echo '
		<script text="text/javascript">
/*
 	function checkedBoxesNumber()
		{
                    	counter=0;
			record="";
			for(j=0; j<document.forms[0].elements.length; j++)
			{
				if(document.forms[0].elements[j].type == "checkbox")
				{
					counter++;
				}
			}
                        for(i=1; i<counter; i++)
			{
                                if(eval(\'document.forms[0].checkbox\' + i + \'.checked\') == true)
				{
					id=(eval(\'document.forms[0].checkbox\' + i + \'.value\'));
					document.table.fileid.value +="" + id +" ";
					record +="" + i +" ";
				}
			}

			document.table.checkedboxes.value = record;
			document.table.checkednumber.value = counter;
			alert("boxes " + document.table.checkedboxes.value  + " are selected");

		}



	function sendFields()
	{
		child_form = comment_window.document.author_note_form;
		child_form.subject.value = document.table.subject.value;
		child_form.to.value = document.table.to.value;
		child_form.comments.value = document.table.comments.value;
	}
	var comment_window;
	var comment_form;
	var checkboxes;
	function getComments()
	{

		if(document.table.isopen==1)
		{

			comment_window.focus();
		}
		else
		{
			box=document.table.checkedboxes.value;
			file=document.table.fileid.value;
			num_checkedbox = document.table.checkednumber.value;
			if(document.table.Docflag.value == 1)
			{
				comment_window = window.open(\'<?php echo $_SERVER[\'PHP_SELF\']; ?>?submit=comments&num=\'+ num_checkedbox +\'&idfield=\'+ file +\'&number=\'+ box +\'&mode=reviewer 1\', \'comment_wins\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=450,height=400\');
			}
			else if(document.table.Docflag.value == 0)
			{
				comment_window = window.open(\'<?php echo $_SERVER[\'PHP_SELF\']; ?>?submit=comments&num=\'+ num_checkedbox +\'&idfield=\'+ file +\'&number=\'+ box +\'&mode=reviewer 0\', \'comment_wins\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=450,height=400\');
			}
			else
			{
				comment_window = window.open(\'<?php echo $_SERVER[\'PHP_SELF\']; ?>?submit=comments&num=\'+ num_checkedbox +\'&idfield=\'+ file +\'&number=\'+ box +\'&mode=reviewer 2\', \'comment_wins\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=450,height=400\');
			}

			comment_window.focus();
			document.table.isopen.value=1;
			setTimeout("sendFields();", 500);
			document.table.isopen.value=0;
		}
	}
	function rejectcomment()
	{
		//add self.name="Parent";
		self.name="Parent";
		if(document.table.isopen.value != 1)
		{
			//alert("Please Provide Reasons Of Why The Document(s) Is Rejected");
			document.table.Docflag.value = 1;

			getComments();

		}
	}
	function authcomment()
	{
		//add self.name="Parent";
		self.name="Parent";
		if(document.table.isopen.value != 1)
		{
			document.table.Docflag.value = 0;

			getComments();
		}


	}
*/
	</script>
                '; ?>