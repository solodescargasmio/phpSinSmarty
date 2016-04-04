<?php /* Smarty version Smarty-3.1.20, created on 2016-03-07 17:06:04
         compiled from "vistas\archivos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3229556d70584ca2dd8-77427740%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db9c9eaab4fece275db5bd7b70bdf3e566b8e324' => 
    array (
      0 => 'vistas\\archivos.tpl',
      1 => 1457314009,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3229556d70584ca2dd8-77427740',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56d70584e11130_70852995',
  'variables' => 
  array (
    'archivos' => 0,
    'archivo' => 0,
    'cedula' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d70584e11130_70852995')) {function content_56d70584e11130_70852995($_smarty_tpl) {?> <link href="css/dashboard.css" rel="stylesheet" type="text/css">
<font style="font-weight: bold;"><div> <h4>Archivo actuales de paciente</h4>
    
    <?php if (isset($_smarty_tpl->tpl_vars['archivos']->value)) {?>
    <?php  $_smarty_tpl->tpl_vars['archivo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['archivo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['archivos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['archivo']->key => $_smarty_tpl->tpl_vars['archivo']->value) {
$_smarty_tpl->tpl_vars['archivo']->_loop = true;
?>
        <div class="encuadro">
        <h5><?php echo $_smarty_tpl->tpl_vars['archivo']->value->getNombre();?>
</h5>
        <?php if (strcmp($_smarty_tpl->tpl_vars['archivo']->value->getExtension(),"jpg")==0||strcmp($_smarty_tpl->tpl_vars['archivo']->value->getExtension(),"png")==0) {?>
<img src="./multimedia/<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getNombre();?>
.<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getExtension();?>
" width="250" height="120">
        <?php } else { ?>
            
               <!-- <video id="conejito" controls preload="metadata">
                    <source src="./multimedia/<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getNombre();?>
.<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getExtension();?>
" type="video/<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getExtension();?>
" />
    </video>
    <embed type="video/webm" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/" 
       src="./multimedia/<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getNombre();?>
.webm" width="250" height="120" autostart="1" 
ShowStatusBar="1" ShowControls="3" DisplaySize="4" wmode="transparent">-->

    <video width="250" height="120" controls>
  <source src="./multimedia/<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getNombre();?>
.webm" type="video/webm">
Tu navegador no soporta este tipo de video.
</video>
    
        <?php }?>
        <a class="btn btn-primary btn-lg btn-block" href="descargas.php? archivo=<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getNombre();?>
& extension=<?php echo $_smarty_tpl->tpl_vars['archivo']->value->getExtension();?>
">Descargar</a>

        </div>
    <?php } ?>
    <?php }?>

</div><?php }} ?>
