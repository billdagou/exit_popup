<?php
namespace Dagou\ExitPopup\ViewHelpers;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class ModalViewHelper extends AbstractTagBasedViewHelper {
    /**
     * @var bool
     */
    protected $escapeChildren = FALSE;

    public function initializeArguments() {
        $this->registerArgument('target', 'string', 'Modal identifier', TRUE);
        $this->registerArgument('name', 'string', 'Cookie name', FALSE, 'expop');
        $this->registerArgument('expires', 'int', 'Expiring days', FALSE, 3);
        $this->registerArgument('footer', 'boolean', 'Add to footer or not.', FALSE, TRUE);
    }

    public function render() {
        if ($_COOKIE[$this->arguments['name']]) {
            return '';
        }

        $footer = $this->arguments['footer'];
        unset($this->arguments['footer']);

        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        if ($footer) {
            $pageRenderer->addJsFooterLibrary('exit_popup', 'EXT:exit_popup/Resources/Public/Javascript/main.js');
            $pageRenderer->addJsFooterInlineCode('exit_popup-config', 'var expop = '.json_encode($this->arguments).';');
        } else {
            $pageRenderer->addJsLibrary('exit_popup', 'EXT:exit_popup/Resources/Public/Javascript/main.js');
            $pageRenderer->addJsFooterInlineCode('exit_popup-config', 'var expop = '.json_encode($this->arguments).';');
        }

        return $this->renderChildren();
    }
}