<?php
/**
 *
 * @package    mahara
 * @subpackage form-element
 * @author     Catalyst IT Limited <mahara@catalyst.net.nz>
 * @license    https://www.gnu.org/licenses/gpl-3.0.html GNU GPL version 3 or later
 * @copyright  For copyright information on Mahara, please see the README file distributed with this software.
 *
 */

defined('INTERNAL') || die();

/**
 * Multiple file elements
 *
 * @param array    $element The element to render
 * @param Pieform  $form    The form to render the element for
 * @return string           The HTML for the element
 */
function pieform_element_files(Pieform $form, $element) {
    $smarty = smarty_core();

    $smarty->left_delimiter = '{{';
    $smarty->right_delimiter = '}}';

    $value = $form->get_value($element);

    if (!is_array($value) && isset($element['defaultvalue']) && is_array($element['defaultvalue'])) {
        $value = $element['defaultvalue'];
    }

    $smarty->assign('name', $form->get_name() . '_' . $element['name']);
    $smarty->assign('title', $element['title']);
    $smarty->assign('addattachment', $form->i18n('element', 'files', 'addattachment', $element));
    $maxfilesize = '';
    if (isset($element['maxfilesize']) && is_int($element['maxfilesize'])) {
        $smarty->assign('maxfilesize', $element['maxfilesize']);
        $maxfilesize = $element['maxfilesize'];
    }
    if (!$maxfilesize) {
        // not supplied by form element
        $maxfilesize = get_max_upload_size(false);
    }
    $smarty->assign('maxfilesizedesc', get_string('maxuploadsize', 'artefact.file') . ' ' . display_size($maxfilesize));
    // if validfiletypes set then only accept those types
    $accepts = get_config('validfiletypes') ? 'accept="' . Pieform::hsc('.' . str_replace(',', ',.', get_config('validfiletypes'))) . '"' : '';
    // if form element accept is set then only accept those types
    $accepts = isset($element['accept']) ? 'accept="' . Pieform::hsc($element['accept']) . '"' : $accepts;
    $smarty->assign('accepts', $accepts);

    return $smarty->fetch('form/files.tpl');
}

function pieform_element_files_get_value(Pieform $form, $element) {
    $name = $form->get_name() . '_' . $element['name'];

    $value = array();

    foreach ($_FILES as $k => $v) {
        if (preg_match('/^' . $name . '_files_\d+$/', $k) && !empty($v['name'])) {
            $value[] = $k;
        }
    }

    return $value;
}

function pieform_element_files_set_attributes($element) {/*{{{*/
    $element['needsmultipart'] = true;
    return $element;
}/*}}}*/
