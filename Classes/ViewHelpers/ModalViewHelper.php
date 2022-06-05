<?php
namespace Dagou\ExitPopup\ViewHelpers;

use TYPO3\CMS\Core\Page\AssetCollector;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ModalViewHelper extends AbstractViewHelper {
    /**
     * @var bool
     */
    protected $escapeChildren = FALSE;
    /**
     * @var bool
     */
    protected $escapeOutput = FALSE;
    /**
     * @var \TYPO3\CMS\Core\Page\AssetCollector
     */
    protected $assetCollector;

    /**
     * @param \TYPO3\CMS\Core\Page\AssetCollector $assetCollector
     */
    public function injectAssetCollector(AssetCollector $assetCollector) {
        $this->assetCollector = $assetCollector;
    }

    public function initializeArguments() {
        $this->registerArgument('target', 'string', 'Modal identifier', TRUE);
        $this->registerArgument('name', 'string', 'Cookie name', FALSE, 'expop');
        $this->registerArgument('expires', 'int', 'Expiring days', FALSE, 7);
    }

    /**
     * @return string
     */
    public function render(): string {
        if ($_COOKIE[$this->arguments['name']]) {
            return '';
        }

        $this->assetCollector->addJavaScript('exit_popup', 'EXT:exit_popup/Resources/Public/Javascript/main.js');
        $this->assetCollector->addInlineJavaScript('exit_popup-config', 'var expop = '.json_encode($this->arguments).';');

        return $this->renderChildren();
    }
}