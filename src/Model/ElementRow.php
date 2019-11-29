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
        'VerticalRowAlignmentXS' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'VerticalRowAlignmentSM' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'VerticalRowAlignmentMD' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'VerticalRowAlignmentLG' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'VerticalRowAlignmentXL' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'HorizontalRowAlignmentXS' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
        'HorizontalRowAlignmentSM' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
        'HorizontalRowAlignmentMD' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
        'HorizontalRowAlignmentLG' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
        'HorizontalRowAlignmentXL' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
    ];

    private static $icon = 'font-icon-menu';

    private static $table_name = 'ElementRow';

    private static $singular_name = 'row';

    private static $plural_name = 'rows';

    private static $description = 'Row element';

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

    public function getSummary()
    {
        return '';
    }

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Row');
    }
    
    public function RowClass()
    {
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
            $this->VerticalAlignment !== 'default' ? $this->VerticalAlignment : '',

        ];
        $verticalAlignment = $this->VerticalAlignment !== 'default' ? $this->VerticalAlignment : '';
        $horizontalAlignment = $this->HorizontalAlignment !== 'default' ? $this->VerticalAlignment : '';
    }

}
