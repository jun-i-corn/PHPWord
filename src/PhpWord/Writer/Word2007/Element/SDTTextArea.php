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

/**
 * SDTBlock element writer
 *
 */
class SDTTextArea extends SDTBlock
{
    protected function writeContent($xmlWriter, $element)
    {
        $this->startElementP();
        parent::writeContent($xmlWriter, $element);
        $this->endElementP();
    }

    protected function writeHeader($element, $xmlWriter)
    {
        parent::writeHeader($element, $xmlWriter);

        $xmlWriter->startElement('w:text');
        if ($element->isIsMultiLineText()) {
            $xmlWriter->writeAttribute('w:multiLine', 1);
        }
        $xmlWriter->endElement();
    }
}
