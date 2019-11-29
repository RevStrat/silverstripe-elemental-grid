<?php

namespace TheWebmen\ElementalGrid\Models;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use TheWebmen\ElementalGrid\Controllers\ElementRowController;

class ElementRow extends BaseElement
{
    private static $db = [
        'VerticalRowAlignmentXS' => 'Enum("default,start,center,end,baseline,stretch", "default")',
        'VerticalRowAlignmentSM' => 'Enum("default,start,center,end,baseline,stretch", "default")',
        'VerticalRowAlignmentMD' => 'Enum("default,start,center,end,baseline,stretch", "default")',
        'VerticalRowAlignmentLG' => 'Enum("default,start,center,end,baseline,stretch", "default")',
        'VerticalRowAlignmentXL' => 'Enum("default,start,center,end,baseline,stretch", "default")',
        'HorizontalRowAlignmentXS' => 'Enum("default,start,center,end,around,between","default")',
        'HorizontalRowAlignmentSM' => 'Enum("default,start,center,end,around,between","default")',
        'HorizontalRowAlignmentMD' => 'Enum("default,start,center,end,around,between","default")',
        'HorizontalRowAlignmentLG' => 'Enum("default,start,center,end,around,between","default")',
        'HorizontalRowAlignmentXL' => 'Enum("default,start,center,end,around,between","default")',
    ];

    private static $icon = 'font-icon-menu';

    private static $table_name = 'ElementRow';

    private static $singular_name = 'row';

    private static $plural_name = 'rows';

    private static $description = 'Row';

    private static $controller_class = ElementRowController::class;

    private static $block_type = 'full-width';

    public function getCMSFields() {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('Title');
            $fields->addFieldToTab('Root.Main', TextField::create('Title'));
        });

        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Layout',
            new DropdownField(
              'VerticalRowAlignmentXS',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalRowAlignmentXS')->enumValues()
        ));

        $fields->addFieldToTab('Root.SmallLayout',
            new DropdownField(
              'VerticalRowAlignmentSM',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalRowAlignmentSM')->enumValues()
        ));

        $fields->addFieldToTab('Root.MediumLayout',
            new DropdownField(
              'VerticalRowAlignmentMD',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalRowAlignmentMD')->enumValues()
        ));

        $fields->addFieldToTab('Root.LargeLayout',
            new DropdownField(
              'VerticalRowAlignmentLG',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalRowAlignmentLG')->enumValues()
        ));

        $fields->addFieldToTab('Root.ExtraLargeLayout',
            new DropdownField(
              'VerticalRowAlignmentXL',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalRowAlignmentXL')->enumValues()
        ));

        $fields->addFieldToTab('Root.Layout',
            new DropdownField(
              'HorizontalRowAlignmentXS',
              'Horizontal Alignment',
              singleton($this->ClassName)->dbObject('HorizontalRowAlignmentXS')->enumValues()
        ));

        $fields->addFieldToTab('Root.SmallLayout',
            new DropdownField(
              'HorizontalRowAlignmentSM',
              'Horizontal Alignment',
              singleton($this->ClassName)->dbObject('HorizontalRowAlignmentSM')->enumValues()
        ));

        $fields->addFieldToTab('Root.MediumLayout',
            new DropdownField(
              'HorizontalRowAlignmentMD',
              'Horizontal Alignment',
              singleton($this->ClassName)->dbObject('HorizontalRowAlignmentMD')->enumValues()
        ));

        $fields->addFieldToTab('Root.LargeLayout',
            new DropdownField(
              'HorizontalRowAlignmentLG',
              'Horizontal Alignment',
              singleton($this->ClassName)->dbObject('HorizontalRowAlignmentLG')->enumValues()
        ));

        $fields->addFieldToTab('Root.ExtraLargeLayout',
            new DropdownField(
              'HorizontalRowAlignmentXL',
              'Horizontal Alignment',
              singleton($this->ClassName)->dbObject('HorizontalRowAlignmentXL')->enumValues()
        ));

        return $fields;
    }

    public function getSummary() {
        return '';
    }

    public function getType() {
        return _t(__CLASS__ . '.BlockType', 'Row');
    }
    
    public function RowClass() {
        switch (Config::forClass('TheWebmen\ElementalGrid')->get('cssFramework')){
            case 'bulma':
                return 'columns is-multiline';
                break;
            default:
                return 'row';
        }
    }

    public function AlignmentClasses() {
        $classes = [
            ($this->VerticalRowAlignmentXS !== 'default' && strlen($this->VerticalRowAlignmentXS) != 0) ? 'align-items-' . $this->VerticalRowAlignmentXS : '',
            ($this->VerticalRowAlignmentSM !== 'default' && strlen($this->VerticalRowAlignmentSM) != 0) ? 'align-items-sm-' . $this->VerticalRowAlignmentSM : '',
            ($this->VerticalRowAlignmentMD !== 'default' && strlen($this->VerticalRowAlignmentMD) != 0) ? 'align-items-md-' . $this->VerticalRowAlignmentMD : '',
            ($this->VerticalRowAlignmentLG !== 'default' && strlen($this->VerticalRowAlignmentLG) != 0) ? 'align-items-lg-' . $this->VerticalRowAlignmentLG : '',
            ($this->VerticalRowAlignmentXL !== 'default' && strlen($this->VerticalRowAlignmentXL) != 0) ? 'align-items-xl-' . $this->VerticalRowAlignmentXL : '',
            ($this->HorizontalRowAlignmentXS !== 'default' && strlen($this->HorizontalRowAlignmentXS) != 0) ? 'justify-content-' . $this->HorizontalRowAlignmentXS : '',
            ($this->HorizontalRowAlignmentSM !== 'default' && strlen($this->HorizontalRowAlignmentSM) != 0) ? 'justify-content-sm-' . $this->HorizontalRowAlignmentSM : '',
            ($this->HorizontalRowAlignmentMD !== 'default' && strlen($this->HorizontalRowAlignmentMD) != 0) ? 'justify-content-md-' . $this->HorizontalRowAlignmentMD : '',
            ($this->HorizontalRowAlignmentLG !== 'default' && strlen($this->HorizontalRowAlignmentLG) != 0) ? 'justify-content-lg-' . $this->HorizontalRowAlignmentLG : '',
            ($this->HorizontalRowAlignmentXL !== 'default' && strlen($this->HorizontalRowAlignmentXL) != 0) ? 'justify-content-xl' . $this->HorizontalRowAlignmentXL : '',
        ];
        return implode($classes, ' ');
    }

}
