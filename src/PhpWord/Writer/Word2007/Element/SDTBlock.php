<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2016 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\Word2007\Element;

use PhpOffice\PhpWord\Element\SDTTextArea;

/**
 * SDTBlock element writer
 *
 */
class SDTBlock extends AbstractElement
{
    /**
     * Write list item element.
     *
     * @return void
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();
        $element   = $this->getElement();
        if (!$element instanceof \PhpOffice\PhpWord\Element\SDTBlock) {
            return;
        }

        $xmlWriter->startElement('w:sdt');

        $xmlWriter->startElement('w:sdtPr');
        $this->writeHeader($element, $xmlWriter);
        $xmlWriter->endElement(); // w:sdtPr

        $xmlWriter->startElement('w:sdtContent');
        $this->writeContent($xmlWriter, $element);
        $xmlWriter->endElement(); // w:sdtContent

        $xmlWriter->endElement(); // w:sdt
    }

    /**
     * @param $xmlWriter
     * @param $element
     */
    protected function writeContent($xmlWriter, $element)
    {
        $containerWriter = new Container($xmlWriter, $element);
        $containerWriter->write();
    }

    /**
     * @param $element
     * @param $xmlWriter
     */
    protected function writeHeader($element, $xmlWriter)
    {
        // write w:alias (Friendly Name)
        if ($element->getAlias()) {
            $xmlWriter->startElement('w:alias');
            $xmlWriter->writeAttribute('w:val', $element->getAlias());
            $xmlWriter->endElement();
        }

        // write w:tag (Programmatic Tag)
        if ($element->getTag()) {
            $xmlWriter->startElement('w:tag');
            $xmlWriter->writeAttribute('w:val', $element->getTag());
            $xmlWriter->endElement();
        }

        // write w:temporary (Remove Structured Document Tag When Contents Are Edited)
        if ($element->deleteOnEdit()) {
            $xmlWriter->writeElement('w:temporary');
        }

        // write w:lock (Locking Setting)
        if (!$element->canBeEdited() && !$element->canBeDeleted()) {
            $lock = "sdtContentLocked";
        } elseif (!$element->canBeEdited()) {
            $lock = "contentLocked";
        } elseif (!$element->canBeDeleted()) {
            $lock = "sdtLocked";
        } else {
            $lock = null;
        }
        if ($lock) {
            $xmlWriter->startElement('w:lock');
            $xmlWriter->writeAttribute('w:val', $lock);
            $xmlWriter->endElement(); // w:lock
        }
    }
}
