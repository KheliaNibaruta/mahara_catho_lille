<?php
/**
 * Pieforms: Advanced web forms made easy
 * @package    pieform
 * @subpackage renderer
 * @author     Nigel McNie <nigel@catalyst.net.nz>
 * @author     Catalyst IT Limited <mahara@catalyst.net.nz>
 * @license    https://www.gnu.org/licenses/gpl-3.0.html GNU GPL version 3 or later
 * @copyright  For copyright information on Mahara, please see the README file distributed with this software.
 *
 */

/**
 * Renders form elements inside <div>s.
 *
 * @param Pieform $form    The form the element is being rendered for
 * @param array   $element The element to be rendered
 * @return string          The element rendered inside an appropriate container
 */
function pieform_renderer_div(Pieform $form, $element) {/*{{{*/

    $formname = $form->get_name();
    // Set the class of the enclosing <div> to match that of the element
    $prefix = '';
    $suffix = '';
    $inner = '';

    // allow forms to be rendered without a wrapping div
    if (!isset($element['renderelementsonly'])) {

        $prefix = '<div';
        if (isset($element['name'])) {
            $prefix .= ' id="' . $formname . '_' .  Pieform::hsc($element['name']) . '_container"';
        }

        // all elements should be form groups by default except button
        if (!isset($element['isformgroup'])) {
            $element['isformgroup'] = true;
        }

        if (isset($element['type'])) {
            $element['isformgroup'] = $element['type'] === 'button' ? false : $element['isformgroup'];
        }

        // add form-group classes to all real form fields
        $formgroupclass = $element['isformgroup'] ? 'form-group' : '';

        if (isset($element['class'])) {

            // remove form-control class and btn class (these should be on the element only)
            $element['class'] = str_replace("btn-", " ", $element['class']);
            $element['class'] = str_replace("form-control ", "", $element['class']);


            $element['class'] = $element['class'] .' '. $formgroupclass;
        } else {
            $element['class'] = $formgroupclass;
        }

        if (isset($element['collapsible'])) {
            $element['class'] = $element['class'] . ' collapsible-group';
        }

        // add bootstrap has-error class to any error fields
        if (strpos($element['class'],'error') !== false) {
            $element['class'] = $element['class'] . ' has-error';
        }

        // add bootstrap has-error class to any error fields
        if (strpos($element['class'], 'oneof') !== false) {
            $element['class'] = $element['class'] . ' has-oneof';
        }

        $prefix .= ' class="' . Pieform::hsc($element['class']) . '"';

        $prefix .= '>';
    }



    if (isset($element['labelhtml'])) {
        $inner .= $element['labelhtml'];
    }

    if (isset($element['helphtml']) && $element['help'] === 'top') {
        $inner .= ' ' . $element['helphtml'];
    }

    if (isset($element['prehtml'])) {
        $inner .= '<span class="prehtml">' . $element['prehtml'] . '</span>';
    }

    if (isset($element['html'])) {
        $inner .= $element['html'];
    }

    if (isset($element['posthtml'])) {
        $inner .= '<span class="posthtml">' . $element['posthtml'] . '</span>';
    }

    if (isset($element['helphtml']) && $element['help'] !== 'top') {
        $inner .= ' ' . $element['helphtml'];
    }

    // Description - optional description of the element, or other note that should be visible
    // on the form itself (without the user having to hover over contextual help
    if ((!$form->has_errors() || $form->get_property('showdescriptiononerror')) && !empty($element['descriptionhtml'])) {
        $inner .= '<div class="description"> ' . $element['descriptionhtml'] . "</div>";
    }

    if (!empty($element['error'])) {
        $inner .= '<div class="errmsg">' . $element['errorhtml'] . '</div>';
    }

    if (!isset($element['renderelementsonly'])){
        $suffix .= "</div>\n";
    }

    $result = $prefix . $inner . $suffix;

    return $result;
}/*}}}*/
