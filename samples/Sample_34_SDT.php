<?php
include_once 'Sample_Header.php';

// New Word document
echo date('H:i:s'), ' Create new PhpWord object', EOL;
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// New section
$section = $phpWord->addSection();

$textrun = $section->addTextRun();
$textrun->addText('Combobox: ');
$textrun->addSDT('comboBox')->setListItems(array('1' => 'Choice 1', '2' => 'Choice 2'));

$textrun = $section->addTextRun();
$textrun->addText('Date: ');
$textrun->addSDT('date');
$textrun->addTextBreak(1);
$textrun->addText('Date with pre set value: ');
$textrun->addSDT('date')->setValue('03/30/2017');
$textrun->addTextBreak(1);
$textrun->addText('Date with pre set value: ');
$textrun->addSDT('date')->setValue('30.03.2017');

$textrun = $section->addTextRun();
$textrun->addText('Drop down list: ');
$textrun->addSDT('dropDownList')->setListItems(array('1' => 'Choice 1', '2' => 'Choice 2'))->setValue('Choice 1');


$textrun = $section->addTextRun();
$textrun->addText('Input field: ');
$sdt = $textrun->addSDT('textInput');
$sdt->setValue('textinput value');


// SDTBlocks are called "Rich Text Content Controls" in Word and can contain top-level items like TextRuns, ListItems or Tables.
$sdtBlock = $section->addSDTBlock();
$sdtBlock->setTag('SDTBlock Tag');
$sdtBlock->addListItem('First List Item', 0);
$sdtBlock->addListItem('Second List Item', 0);


// SDTTextAreas can be used for multi-line non-rich-text content controls within TextRuns:
$sdtBlock = $section->addSDTTextArea();
$sdtBlock->setIsMultiLineText(true);
$sdtBlock->addText('first line');
$sdtBlock->addTextBreak();
$sdtBlock->addText('second line');

// also, SDTTextAreas can be used for multi-line non-rich-text content controls outside of TextRuns:
$textrun = $section->addTextRun();
$textrun->addText('before');
$sdtBlock = $textrun->addSDTTextArea();
$sdtBlock->setIsMultiLineText(true);
$sdtBlock->addText('first line');
$sdtBlock->addTextBreak();
$sdtBlock->addText('second line');
$textrun->addText('after');


// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writers);
if (!CLI) {
    include_once 'Sample_Footer.php';
}
