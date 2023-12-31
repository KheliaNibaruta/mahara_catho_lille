@javascript @core @core_administration
Feature: TinyMCE mathslate plugin
In order to view mathslate plugin
As an admin
I need to be able to access mathslate in Tinymce

Background:
 Given the following "pages" exist:
  | title | description | ownertype | ownername |
  | Page mahara_01 | Page 01 | institution | mahara |

Scenario: Making adjustments to the mathslate plugin for mahara (Bug 1472446)
 Given I log in as "admin" with password "Kupuh1pa!"
 And I choose "Site options" in "Configure site" from administration menu
 And I click on "Site settings"
 And I enable the switch "Enable MathJax"
 And I click on "Update site options"
 And I choose "Portfolios" in "Configure site" from administration menu
 And I click on "Page mahara_01"
 # Tinymce field adding a math equation
 And I scroll to the id "feedbacktable"
 And I click on "Add comment"
 And I fill in "\\[\\alpha A\\beta B\\]" in editor "Comment"
 And I click on "Comment"
 And I choose "Portfolios" in "Configure site" from administration menu
 And I click on "Page mahara_01"
 And I wait "1" seconds
 And I click on "Comments"
 And I should see "αAβB"
