<?php

namespace PhpOffice\PhpWord\Element;

class SDTBlock extends AbstractContainer
{
    /**
     * @var string Container type
     */
    protected $container = 'SDTBlock';

    /**
     * @var string
     */
    private $tag = "";
    /**
     * @var string
     */
    private $alias = "";
    /**
     * if set to true, requires "canBeDeleted" to be true
     * @var bool
     */
    private $deleteOnEdit = false;
    /**
     * @var bool
     */
    private $canBeEdited = true;
    /**
     * if set to false, requires "deleteOnEdit" to be false
     * @var bool
     */
    private $canBeDeleted = false;

    /**
     * if set, this will be a "non-rich-text" multi-line text input
     * @var bool
     */
    private $isMultiLineText = false;

    /**
     * @return bool
     */
    public function isIsMultiLineText()
    {
        return $this->isMultiLineText;

    }

    /**
     * @param bool $isMultiLineText
     */
    public function setIsMultiLineText($isMultiLineText)
    {
        if (!$isMultiLineText || count($this->getElements()) == 0 || (count($this->getElements()) == 1 && $this->getElements()[0] instanceof TextRun)) {
            $this->isMultiLineText = $isMultiLineText;
        } else {
            throw new \BadMethodCallException('multi-line text inputs must contain exactly one TextRun and nothing else');
        }
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return bool
     */
    public function deleteOnEdit()
    {
        return $this->deleteOnEdit;
    }

    /**
     * @param bool $deleteOnEdit
     */
    public function setDeleteOnEdit($deleteOnEdit)
    {
        if ($deleteOnEdit && !$this->canBeDeleted) {
            throw new \LogicException("cannot be set to 'delete on edit' when 'can be deleted' is not set!");
        }
        $this->deleteOnEdit = $deleteOnEdit;
    }

    /**
     * @return bool
     */
    public function canBeEdited()
    {
        return $this->canBeEdited;
    }

    /**
     * @param bool $canBeEdited
     */
    public function setCanBeEdited($canBeEdited)
    {
        $this->canBeEdited = $canBeEdited;
    }

    /**
     * @return bool
     */
    public function canBeDeleted()
    {
        return $this->canBeDeleted;
    }

    /**
     * @param bool $canBeDeleted
     */
    public function setCanBeDeleted($canBeDeleted)
    {
        if (!$canBeDeleted && $this->deleteOnEdit) {
            throw new \LogicException("cannot be set to 'cannot be deleted' when 'delete on edit' is set!");
        }
        $this->canBeDeleted = $canBeDeleted;
    }

    protected function addElement($elementName)
    {
        if ($this->isIsMultiLineText()) {
            if ($elementName != 'TextRun' || count($this->getElements()) > 0) {
                throw new \BadMethodCallException('multi-line text inputs must contain exactly one TextRun and nothing else');
            }
        }

        return call_user_func_array('parent::addElement', func_get_args());
    }

}