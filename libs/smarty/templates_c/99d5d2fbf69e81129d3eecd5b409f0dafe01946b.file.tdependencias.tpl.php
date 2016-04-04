<?php /* Smarty version Smarty-3.1.20, created on 2016-03-08 19:14:12
         compiled from "vistas\tdependencias.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102656df16608583b3-85827258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99d5d2fbf69e81129d3eecd5b409f0dafe01946b' => 
    array (
      0 => 'vistas\\tdependencias.tpl',
      1 => 1457460848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102656df16608583b3-85827258',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_56df166090f568_47377120',
  'variables' => 
  array (
    'dependencias' => 0,
    'formularios' => 0,
    'depen' => 0,
    'formula' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56df166090f568_47377120')) {function content_56df166090f568_47377120($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['dependencias']->value)) {?>
    <table border="1" class="table table-striped">
        <tr class="success">
            <td>Depende</td>
            <td>De</td>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['depen'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['depen']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dependencias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['depen']->key => $_smarty_tpl->tpl_vars['depen']->value) {
$_smarty_tpl->tpl_vars['depen']->_loop = true;
?>
            <tr >   <?php  $_smarty_tpl->tpl_vars['formula'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['formula']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formularios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['formula']->key => $_smarty_tpl->tpl_vars['formula']->value) {
$_smarty_tpl->tpl_vars['formula']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['depen']->value->getDepende()==$_smarty_tpl->tpl_vars['formula']->value->getId_form()) {?>
                <td><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['formula']->value->getNombre(), 'UTF-8');?>
</td> 
              <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['depen']->value->getDe()==$_smarty_tpl->tpl_vars['formula']->value->getId_form()) {?>
              <td><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['formula']->value->getNombre(), 'UTF-8');?>
</td> 
              <td class="campo1"><a style="cursor:pointer;"><input type="text" class="valor" value="<?php echo $_smarty_tpl->tpl_vars['depen']->value->getId();?>
" hidden="">Eliminar</a></td>
              <?php }?>
            <?php } ?> </tr>
         <?php } ?>   
    </table>
<?php }?><?php }} ?>
