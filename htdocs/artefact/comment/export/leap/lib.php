<?php
/**
 *
 * @package    mahara
 * @subpackage artefact-comment-export-leap
 * @author     Catalyst IT Limited <mahara@catalyst.net.nz>
 * @license    https://www.gnu.org/licenses/gpl-3.0.html GNU GPL version 3 or later
 * @copyright  For copyright information on Mahara, please see the README file distributed with this software.
 *
 */

defined('INTERNAL') || die();

class LeapExportElementComment extends LeapExportElement {

    public static function setup_links(&$links, $viewids, $artefactids, $includefeedback, $includeprivatefeedback) {
        $viewlist = join(',', array_map('intval', $viewids));
        $artefactlist = join(',', array_map('intval', $artefactids));
        if ($includeprivatefeedback && $includefeedback) {
            $feedback = 1;
        }
        else if ($includefeedback) {
            $feedback = 0;
        }
        else {
            $feedback = -1;
        }
        $records = get_records_select_array(
            'artefact_comment_comment',
            "artefact IN ($artefactlist) AND onview IN ($viewlist) AND private <= ?",
            array($feedback),
            '',
            'artefact,onview'
        );
        if ($records) {
            foreach ($records as &$r) {
                if (!isset($links->viewartefact[$r->onview][$r->artefact])) {
                    $links->viewartefact[$r->onview][$r->artefact] = array();
                }
                $links->viewartefact[$r->onview][$r->artefact][] = 'reflected_on_by';
                if (!isset($links->artefactview[$r->artefact][$r->onview])) {
                    $links->artefactview[$r->artefact][$r->onview] = array();
                }
                $links->artefactview[$r->artefact][$r->onview][] = 'reflects_on';
            }
        }

        $records = get_records_select_array(
            'artefact_comment_comment',
            "artefact IN ($artefactlist) AND onartefact IN ($artefactlist) AND private <= ?",
            array($feedback),
            '',
            'artefact,onartefact'
        );
        if ($records) {
            foreach ($records as &$r) {
                if (!isset($links->artefactartefact[$r->onartefact][$r->artefact])) {
                    $links->artefactartefact[$r->onartefact][$r->artefact] = array();
                }
                $links->artefactartefact[$r->onartefact][$r->artefact][] = 'reflected_on_by';
                if (!isset($links->artefactartefact[$r->artefact][$r->onartefact])) {
                    $links->artefactartefact[$r->artefact][$r->onartefact] = array();
                }
                $links->artefactartefact[$r->artefact][$r->onartefact][] = 'reflects_on';
            }
        }
    }

    public function get_content_type() {
        return 'html';
    }

    public function get_content() {
        return $this->artefact->render_self(array());
    }

    public function get_categories() {
        if ($this->artefact->get('private')) {
            return array(
                array(
                    'scheme' => 'audience',
                    'term'   => 'Private',
                )
            );
        }
        return array();
    }

    public function get_entry_author() {
        return get_string('importedfeedback', 'artefact.comment');
    }

}
