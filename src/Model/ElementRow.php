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
    private $db = [
        'VerticalAlignmentXS' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'VerticalAlignmentSM' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'VerticalAlignmentMD' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'VerticalAlignmentLG' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'VerticalAlignmentXL' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'HorizontalAlignmentXS' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
        'HorizontalAlignmentSM' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
        'HorizontalAlignmentMD' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
        'HorizontalAlignmentLG' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
        'HorizontalAlignmentXL' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")',
    ];

    private static $icon = 'font-icon-menu';

    private static $table_name = 'ElementRow';

    private static $singular_name = 'row';

    private static $plural_name = 'rows';

    private static $description = 'Row element';

    private static $controller_class = ElementRowController::class;

    private static $block_type = 'full-width';

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('Title');
            $fields->addFieldToTab('Root.Main', TextField::create('Title'));
        });

        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Layout',
            new DropdownField(
              'VerticalAlignmentXS',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalAlignmentXS')->enumValues()
        ));

        $fields->addFieldToTab('Root.SmallLayout',
            new DropdownField(
              'VerticalAlignmentSM',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalAlignmentSM')->enumValues()
        ));

        $fields->addFieldToTab('Root.MediumLayout',
            new DropdownField(
              'VerticalAlignmentMD',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalAlignmentMD')->enumValues()
        ));

        $fields->addFieldToTab('Root.LargeLayout',
            new DropdownField(
              'VerticalAlignmentLG',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalAlignmentLG')->enumValues()
        ));

        $fields->addFieldToTab('Root.ExtraLargeLayout',
            new DropdownField(
              'VerticalAlignmentXL',
              'Vertical Alignment',
              singleton($this->ClassName)->dbObject('VerticalAlignmentXL')->enumValues()
        ));

        $fields->addFieldToTab('Root.Layout',
            new DropdownField(
              'HorizontalAlignmentXS',
              'Horizontal Alignement',
              singleton($this->ClassName)->dbObject('HorizontalAlignmentXS')->enumValues()
        ));

        $fields->addFieldToTab('Root.SmallLayout',
            new DropdownField(
              'HorizontalAlignmentSM',
              'Horizontal Alignement',
              singleton($this->ClassName)->dbObject('HorizontalAlignmentSM')->enumValues()
        ));

        $fields->addFieldToTab('Root.MediumLayout',
            new DropdownField(
              'HorizontalAlignmentMD',
              'Horizontal Alignement',
              singleton($this->ClassName)->dbObject('HorizontalAlignmentMD')->enumValues()
        ));

        $fields->addFieldToTab('Root.LargeLayout',
            new DropdownField(
              'HorizontalAlignmentLG',
              'Horizontal Alignement',
              singleton($this->ClassName)->dbObject('HorizontalAlignmentLG')->enumValues()
        ));

        $fields->addFieldToTab('Root.ExtraLargeLayout',
            new DropdownField(
              'HorizontalAlignmentXL',
              'Horizontal Alignement',
              singleton($this->ClassName)->dbObject('HorizontalAlignmentXL')->enumValues()
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
