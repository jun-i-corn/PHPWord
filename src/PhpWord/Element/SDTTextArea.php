<?php

namespace PhpOffice\PhpWord\Element;

use PhpOffice\PhpWord\Style\Paragraph;

class SDTTextArea extends SDTBlock
{
    /**
     * @var string Container type
     */
    protected $container = 'SDTTextArea';

    /**
     * if set, this will be a "non-rich-text" multi-line text input
     * @var bool
     */
    private $isMultiLineText = false;

    /**
     * Paragraph style
     *
     * @var string|\PhpOffice\PhpWord\Style\Paragraph
     */
    protected $paragraphStyle;

    /**
     * Create new instance
     *
     * @param string|array|\PhpOffice\PhpWord\Style\Paragraph $paragraphStyle
     */
    public function __construct($paragraphStyle = null)
    {
        $this->paragraphStyle = $this->setNewStyle(new Paragraph(), $paragraphStyle);
    }

    /**
     * Get Paragraph style
     *
     * @return string|\PhpOffice\PhpWord\Style\Paragraph
     */
    public function getParagraphStyle()
    {
        return $this->paragraphStyle;
    }

    /**
     * @return bool
     */
    public function isIsMultiLineText()
    {
        return $this->isMultiLineText;

    }

    /**
     * a "non-rich-text" multi-line text input may not contain more than one textrun
     *
     * @param bool $isMultiLineText
     */
    public function setIsMultiLineText($isMultiLineText)
    {
        $this->isMultiLineText = $isMultiLineText;
    }
}