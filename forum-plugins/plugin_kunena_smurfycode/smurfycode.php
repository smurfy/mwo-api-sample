<?php
/** 
 * @Enterprise: Pearly Gates Software
 * @author: Rex "SaintPeter" Schrader
 * @url: http://1st-rangers.com
 * @copyright Copyright (C) 2005 - 2013 Rex Schrader, All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

jimport('joomla.plugin');

class plgkunenasmurfycode extends JPlugin
{
	     function plgSmurfyCode( &$subject ) {
                parent::__construct( $subject );
        }
	
	public function onKunenaBbcodeConstruct($bbcode) {
		$bbcode->AddRule('smurfy', array(
				'mode' => BBCODE_MODE_CALLBACK,
				'method' => 'plgkunenasmurfycode::DoSmurfy',
				'allow_in' => array('listitem', 'block', 'columns'),
				'content' => BBCODE_REQUIRED,
				'before_tag' => "sns",
				'after_tag' => "sns",
				'before_endtag' => "sns",
				'after_endtag' => "sns",
				'plain_start' => "\nSmurfy Mechlab:\n",
				'plain_end' => "\n")
			);
		return true;
	}
	
	static public function DoSmurfy($bbcode, $action, $name, $default, $params, $content) {
		if ($action == BBCODE_CHECK) {
			$bbcode->autolink_disable++;
			return true;
		}
		
		$bbcode->autolink_disable--;
		
		$html = '';
		$url = $bbcode->UnHTMLEncode ( strip_tags ( $content ) );
		$result = preg_match('/i=(\d+)&l=(\w+)/',$url, $matches);
		if($result === 1) {
			// Example URL: http://mwo.smurfy-net.de/tools/mechtooltip?i=17&l=6eb098ea1a7a393ed703be2f4761b072c0692766
			$html = '<iframe src="http://mwo.smurfy-net.de/tools/mechtooltip?i=' . $matches[1] . '&l=' . $matches[2] . '" width="100%" height="300"></iframe>';
		} 
		return $html;
	}
	
	public function onKunenaBbcodeEditorInit($editor) {
		//Add button
		$btn = new KunenaBbCodeEditorButton('smurfy', 'smurfy', 'smurfy', 'Smurfy Mech Loadout', '[smurfy]http://mwo.smurfy-net.de/mechlab#i=63&l=dbfcefd07fd2b1841e058a8dc8e56e776d365241[/smurfy]');
		//You need to call that to add an button action see below DisplayAction Topic or
		//  administrator/components/com_kunena/libraries/bbcode/editor.php
		$btn->addWrapSelectionAction();
		$editor->insertElement($btn, 'after', 'link');
		
		$document = &JFactory::getDocument();
		
		//Add image for the button
		$document->addStyleDeclaration("#Kunena #kbbcode-toolbar #smurfy {
		background-image: url(\"".JURI::base( true )."/plugins/kunena/smurfycode/images/smurfy.png\");
		}");
		
		//Add JS Code for preview
		$document->addScriptDeclaration("window.addEvent('domready', function() {
		preview = document.id('kbbcode-preview');
		preview.addEvent('updated', function(event){
		MathJax.Hub.Queue(['Typeset',MathJax.Hub,'kbbcode-preview']);
		});
		});");
	}
}