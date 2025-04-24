<?php /* Smarty version 2.6.28, created on 2025-04-23 23:54:47
         compiled from footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'footer.tpl', 18, false),)), $this); ?>
</div>
</div>
</div>
<?php if ($this->_tpl_vars['g_demo'] == 'True'): ?>
<script type="text/javascript"><!--
 google_ad_client = "ca-pub-3696425351841264";
 /* 728x90_ODM_Demo */
 google_ad_slot = "8419809005";
 google_ad_width = 728;
 google_ad_height = 90;
 //-->
 </script>
 <script type="text/javascript"
 src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
 </script>
<?php endif; ?>
<hr>
    <a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['g_site_mail'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['g_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a><p />
    <a href="http://www.avidian.com/" target="_new">Avidian</a><br />
</body>
</html>
